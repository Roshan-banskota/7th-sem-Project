<?php
   session_start();
 
if(@$_SESSION['user_id']){
	
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/header.php");
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/class.database.php");
   
   include_once("navbar.php");
   
	function GetSubjectInfo($subcode,$user_id){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->query("SELECT * FROM subject WHERE subject_code = '$subcode' AND user_id='$user_id'");
			$rowCount = $query->rowCount();
			if($rowCount ==1)
			{
				$result = $query->fetchAll();
				return $result;
			}
			else
			{
				return $rowCount;
			}
		}
	
	function add_subjects($teacher_id,$user_id,$code,$name,$lecture){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->prepare("INSERT INTO subject (teacher_id,user_id,subject_code,subject_name,l) VALUES(?,?,?,?,?)");
			$values = array ($teacher_id,$user_id,$code,$name,$lecture);
			$query->execute($values);
			$count = $query->rowCount();
			return $count;
		}
	
	if(isset($_POST['submit']))
	{
		$check_subject = GetSubjectInfo($_POST['subcode'],$_SESSION['user_id']);
		if($check_subject === 0)
		{
			$count= add_subjects($_POST['tname'],$_SESSION['user_id'],$_POST['subcode'],$_POST['name'],$_POST['l']);
			if($count){ 
			
			echo 	'<div class="alert alert-success">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Tada Success! </strong>Added Successfully.  
					</div>'; 
			}
			else{
				echo '<div class="alert alert-danger fade in">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Opps Error!</strong>Not Added.  
					</div>';  
			}
		}
		else
		{
			echo '<div class="alert alert-danger fade in">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Opps Error!</strong>Subject Already Exists.  
					</div>'; 			
		}
		
	}
	
}
else{
	session_destroy();
	header("location: ../index.php");
	exit();
}
?>


<div class="container-fluid"> 
  <div class="row">
    <div class="col-lg-4">
		<div class="jumbotron">

			<form class="form-horizontal" method= "post" action="">
				<fieldset>

				<!-- Form Name -->
				<legend>Add Subjects</legend>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="subcode">Subject Code</label>  
				  <input id="subcode" name="subcode" type="text" placeholder="" class="form-control input-md" required="">
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="name">Subject Name</label>  
				  <input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">	
				</div>

				<div class="form-group">
					  <label class="control-label" for="tname">Subject Teacher</label>
						<select id="tname" name="tname" class="form-control">
							<option value="" selected disabled hidden></option>
							<?php
							    $db_connection = new dbConnection();
								$link = $db_connection->connect(); 
								$user_id= $_SESSION['user_id'];
								$query = $link->query("SELECT * FROM teacher WHERE user_id= '$user_id'");
								$query->setFetchMode(PDO::FETCH_ASSOC); 				
								while($result = $query->fetch()){
								echo '<option value="'.$result['teacher_id'].'">'.$result['teacher_name'].'</option>';
						  	}?>
						</select>
					</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="l">Lectures per Week</label>  
				  <input id="l" name="l" type="text" placeholder="" class="form-control input-md" required="">
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="control-label" for="submit"></label>
					<button id="submit" name="submit" class="btn btn-primary">Add Subject</button>
				</div>

				</fieldset>
			</form>
		</div>		
    </div>


    <div class="col-lg-8">
		<?php
			if($_SESSION['user_id']){
				
				function deletesub($subject_id, $user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$link->query("DELETE FROM  `subject` WHERE  `subject_id` ='$subject_id' AND `user_id`='$user_id'");
				}
				if(isset($_GET['delete'])){
					 deletesub($_GET['id'],$_SESSION['user_id']);
					 echo 	'<div class="alert alert-success">  
							<a class="close" data-dismiss="alert">X</a>  
							<strong>Tada Success! </strong>Successfully Deleted.  
							</div>'; 
				}
				
				// This function lists all the timetable created till now.. with options like delete, edit
				function Subjectlist($user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$query = $link->query("SELECT * FROM subject WHERE user_id='$user_id'");
					$query->setFetchMode(PDO::FETCH_ASSOC);
					
					
					echo
						  "<h2>List of Subject Already Added</h2>".
						  "<table class='table table-bordered'>".          
							"<thead>".
							  "<tr>".
								"<th>Subject Id</th>".
								"<th>Teacher Id</th>".
								"<th>Subject Code</th>".
								"<th>Subject Name</th>".
								"<th>Total Lecture</th>".
								"<th>Options</th>".
							  "</tr>".
							"</thead>".
							"<tbody>";
							
							while($result = $query->fetch()){
							  echo "<tr>"
									 ."<td>".$result['subject_id']."</td>"
									 ."<td>".$result['teacher_id']."</td>"
									 ."<td>".$result['subject_code']."</td>"
									 ."<td>".$result['subject_name']."</td>"
									 ."<td>".$result['l']."</td>"
									 ."<td><a href='add.subject.php?delete=true&id=".$result['subject_id']."'>Delete</a></td>"
									 ."</tr>".
							  "</tr>";
							}  
					echo	"</tbody>".
						  "</table>".
						"</div>";
						
				}
				
				Subjectlist($_SESSION['user_id']);
			}
			else{
				session_destroy();
				header("location: ../index.php");
			}
		?>
		
    </div>
  </div>
  
</div>
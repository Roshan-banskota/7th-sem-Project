<?php
   session_start();
  
if(@$_SESSION['user_id']){
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/header.php");
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/class.database.php");
   include_once("navbar.php");
   
  
	
	function GetFacultyInfo($user_id,$facultycode){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->query("SELECT * FROM faculty WHERE faculty_code = '$facultycode' AND user_id='$user_id'");
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
	
	function add_faculty($user_id,$code,$name,$designation,$qualification){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->prepare("INSERT INTO faculty (user_id,faculty_code, faculty_name, designation, qualification) VALUES(?,?,?,?,?)");
			$values = array ($user_id,$code,$name,$designation,$qualification);
			$query->execute($values);
			$count = $query->rowCount();
			return $count;
		}
	
	if(isset($_POST['submit']))
	{
		$check_faculty = GetFacultyInfo($_SESSION['user_id'], $_POST['fcode']);
		if($check_faculty === 0){
			$count= add_faculty($_SESSION['user_id'],$_POST['fcode'],$_POST['name'],$_POST['d'],$_POST['q']);
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
		else{
			echo '<div class="alert alert-danger fade in">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Opps Error!</strong>Faculty Already Exists.  
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
				<legend>Add Faculty</legend>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="name">Faculty Code</label>  
				  <input id="fcode" name="fcode" type="text" placeholder="" class="form-control input-md" required="">	
			    </div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="name">Faculty Name</label>  
						<select id="name" name="name" class="form-control">
						  <option value="" selected disabled hidden></option>
						  <option value="Arts">Arts</option>
						  <option value="Classic">Classic</option>
						  <option value="Commerce">Commerce</option>
						  <option value="Education">Education</option>
						  <option value="Engineering">Engineering</option>
						  <option value="Humanities">Humanities</option>
						  <option value="Information Technology">Information Technology</option>
						  <option value="Law">Law</option>
						  <option value="Management Studies">Management Studies</option>
						  <option value="Music">Music</option>
						  <option value="Natural Science">Natural Science</option>
						</select>
				</div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="l">Designation</label>  
				  	<select id="d" name="d" type="text" class="form-control">
				  		<option value="" selected disabled hidden></option>
				  		<option value="professor">Professor</option>
					  	<option value="assistant professor">Assistant professor</option>
					  	<option value="associate professor">Associate professor</option>
					  	<option value="Lecturer">lecturer</option>
					  	<option value="teaching assistant">Teaching Assistant</option>
					  	<option value="instructor">Instructor</option>
					  	<option value="technical support">Technical support</option>
				  	</select>
				  </div>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="t">Qualification</label>  
				  <input id="q" name="q" type="text" placeholder="" class="form-control input-md" required="">
				  <span class="help-block"></span>  
			    </div>

				<!-- Button -->
				<div class="form-group">
				  <label class="control-label" for="submit"></label>
					<button id="submit" name="submit" class="btn btn-primary">Add Faculty</button>
				</div>
				</fieldset>
			</form>
		</div>		
    </div>
    <div class="col-lg-8">
		<?php
			if($_SESSION['user_id']){
				
				function deletefac($faculty_id, $user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$link->query("DELETE FROM `faculty` WHERE  `faculty_id` ='$faculty_id' AND `user_id`='$user_id'");
				}
				if(isset($_GET['delete'])){
					 deletefac($_GET['id'],$_SESSION['user_id']);
					 echo 	'<div class="alert alert-success">  
							<a class="close" data-dismiss="alert">X</a>  
							<strong>Tada Success! </strong>Successfully Deleted.  
							</div>'; 
				}
				
				// This function lists all the timetable created till now.. with options like delete, edit
				function Facultylist($user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$query = $link->query("SELECT * FROM faculty WHERE user_id='$user_id'");
					$query->setFetchMode(PDO::FETCH_ASSOC);
					
					
					echo
						  "<h2>List of Faculty Already Added</h2>".
						  "<table class='table table-bordered'>".          
							"<thead>".
							  "<tr>".
								"<th>Faculty Id</th>".
								"<th>Faculty Code</th>".
								"<th>Faculty Name</th>".
								"<th>Designation</th>".
								"<th>Qualification</th>".
								"<th>Options</th>".
							  "</tr>".
							"</thead>".
							"<tbody>";
							
							while($result = $query->fetch()){
							  echo "<tr>"
									 ."<td>".$result['faculty_id']."</td>"
									 ."<td>".$result['faculty_code']."</td>"
									 ."<td>".$result['faculty_name']."</td>"
									 ."<td>".$result['designation']."</td>"
									 ."<td>".$result['qualification']."</td>"
									 ."<td><a href='add.faculty.php?delete=true&id=".$result['faculty_id']."'>Delete</a></td>"
									 ."</tr>".
							  "</tr>";
							}  
					echo	"</tbody>".
						  "</table>".
						"</div>";
						
				}
				
				Facultylist($_SESSION['user_id']);
			}
			else{
				session_destroy();
				header("location: ../index.php");
			}
		?>
		
    </div>
  </div>
  
</div>
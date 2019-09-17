<?php  
 session_start();
  
if(@$_SESSION['user_id']){
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/header.php");
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/class.database.php");
   
   include_once("navbar.php");

 function GetTeacherInfo($user_id,$tcode){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->query("SELECT * FROM teacher WHERE user_id='$user_id' AND teacher_code = '$tcode'");
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


		  function add_teacher($user_id,$code,$name){
   			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->prepare("INSERT INTO teacher (user_id,teacher_code,teacher_name) VALUES(?,?,?)");
			$values = array ($user_id,$code,$name);
			$query->execute($values);
			$count = $query->rowCount();
			return $count;
		}


	if(isset($_POST['submit']))
	{
		$check_teacher = GetTeacherInfo($_SESSION['user_id'], $_POST['tcode']);
		if($check_teacher === 0){
			$count= add_teacher($_SESSION['user_id'],$_POST['tcode'],$_POST['name']);
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
					<strong>Opps Error!</strong>Teacher Already Exists.  
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

		<form class="form-horizontal" method= "POST" action="">
			<fieldset>

				<!-- Form Name -->
				<legend>Add Teacher</legend>

				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="name">Teacher code</label>  
				  	<input id="tcode" name="tcode" type="text" placeholder="" class="form-control input-md" required="">
				  </div>
				
				<!-- Text input-->
				<div class="form-group">
				  <label class="control-label" for="name">Teacher Name</label>  
				  	<input id="name" name="name" type="text" placeholder="" class="form-control input-md" required="">	
				</div>

				<!-- Button -->
				<div class="form-group">
				  <label class="control-label" for="submit"></label>
					<button id="submit" name="submit" class="btn btn-primary">Add Teacher</button>
				</div>
			</fieldset>
		</form>
	</div>
</div>

 <div class="col-lg-8">
		<?php
			if($_SESSION['user_id']){
				
				function deleteteach($teacher_id, $user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$link->query("DELETE FROM  `teacher` WHERE  `teacher_id` ='$teacher_id' AND `user_id`='$user_id'");
				}
				if(isset($_GET['delete'])){
					 deleteteach($_GET['id'],$_SESSION['user_id']);
					 echo 	'<div class="alert alert-success">  
							<a class="close" data-dismiss="alert">X</a>  
							<strong>Tada Success! </strong>Successfully Deleted.  
							</div>'; 
				}
				
				// This function lists all the timetable created till now.. with options like delete, edit
				function Subjectlist($user_id){
					$db_connection = new dbConnection();
					$link = $db_connection->connect(); 
					$query = $link->query("SELECT * FROM teacher WHERE user_id='$user_id'");
					$query->setFetchMode(PDO::FETCH_ASSOC);
					
					
					echo
						  "<h2>List of Teacher Already Added</h2>".
						  "<table class='table table-bordered'>".          
							"<thead>".
							  "<tr>".
								"<th>Teacher Id</th>".
								"<th>Teacher Code</th>".
								"<th>Teacher Name</th>".
								"<th>Options</th>".
							  "</tr>".
							"</thead>".
							"<tbody>";
							
							while($result = $query->fetch()){
							  echo "<tr>"
									 ."<td>".$result['teacher_id']."</td>"
									 ."<td>".$result['teacher_code']."</td>"
									 ."<td>".$result['teacher_name']."</td>"
									 ."<td><a href='add.teacher.php?delete=true&id=".$result['teacher_id']."'>Delete</a></td>"
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

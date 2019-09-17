<?php
session_start();
	if(@$_SESSION['user_id']){
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/header.php");
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/class.database.php");
   
   include_once("navbar.php");

  	function GetFreeTimeInfo($user_id,$time_id){
			$db_connection = new dbConnection();
			$link = $db_connection->connect(); 
			$query = $link->query("SELECT * FROM freetime WHERE time_id = '$time_id'AND user_id='$user_id'");
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

	if(isset($_POST['submit']))
	{
		$check_freetime = GetFreeTimeInfo($_SESSION['user_id'], $_POST['name']);
		if($check_freetime === 0){
		//to run PHP script on submit
		if(!empty($_POST['check_list']))
		{// Loop to store and display values of individual checked checkbox.
			foreach($_POST['check_list'] as $selected)
			{
				$user_id=$_SESSION['user_id'];
				$teacher_id=$_POST['name'];
				$sh= $_POST['sh'];
				$sm= $_POST['sm'];
				$eh= $_POST['eh'];
				$em= $_POST['em'];				

				$db_connection = new dbConnection();
				$link = $db_connection->connect(); 
				$query = $link->prepare("INSERT INTO freetime (user_id,teacher_id,day,start_hour,start_min,end_hour,end_min) VALUES(?,?,?,?,?,?,?)");
				$values = array($user_id,$teacher_id,$selected,$sh,$sm,$eh,$em);
				$query->execute($values);
				$count = $query->rowCount();
			}			
		}
		if($count)
		{ 				
			echo'<div class="alert alert-success">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Tada Success! </strong>Added Successfully.  
				</div>'; 
		}
		else{
			echo'<div class="alert alert-danger">  
					<a class="close" data-dismiss="alert">X</a>  
					<strong>Opps Error!</strong>Not Added.  
				</div>';  
		}
		}
	else
	{
		echo'<div class="alert alert-danger fade in">  
				<a class="close" data-dismiss="alert">X</a>  
				<strong>Opps Error!</strong>FreeTimeTime Already Exists.  
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
			<form action="" method="post">
				<fieldset>
					<!-- Form Name -->
					<legend>Add FreeTime</legend>			
					<!-- Text input-->
					<div class="form-group">
					  <label class="control-label" for="name">Teacher name</label>
						<select id="name" name="name" class="form-control">
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

					<div class="form-group">
						<label class="control-label">Day</label>  <br>
					  	<input type="checkbox" name="check_list[]" value="1">Sunday<br>
						<input type="checkbox" name="check_list[]" value="2">Monday<br>
						<input type="checkbox" name="check_list[]" value="3">Tuesday <br>
						<input type="checkbox" name="check_list[]" value="4">Wednesday<br>
						<input type="checkbox" name="check_list[]" value="5">Thursday <br>
						<input type="checkbox" name="check_list[]" value="6">Friday<br>
						<input type="checkbox" name="check_list[]" value="7">Saturday <br>
					</div>	

					<div class="form-group start-hr">
						<label class="control-label" for="t">Free Time</label>  
						<input id="sh" name="sh" type="text" placeholder=" start hour" class="form-control input-md" required=""> 
						<input id="sm" name="sm" type="text" placeholder=" start minute" class="form-control input-md" required=""> 
						<input id="eh" name="eh" type="text" placeholder=" end hour" class="form-control input-md" required=""> 
						<input id="em" name="em" type="text" placeholder=" end minute" class="form-control input-md" required=""> 
					</div>

					<div class="form-group">
						<label class="control-label" for="submit"></label>
						<button id="submit" name="submit" class="btn btn-primary">Add FreeTime</button>
					</div>
				</fieldset>
				</form>
			</div>
		</div>

		<div class="col-lg-8">
			<?php
				if($_SESSION['user_id']){
					
					function deletetime($time_id,$user_id){
						$db_connection = new dbConnection();
						$link = $db_connection->connect(); 
						$link->query("DELETE FROM `freetime` WHERE `time_id` = '$time_id' AND `user_id`='$user_id'");
					}
					if(isset($_GET['delete'])){
						 deletetime($_GET['id'],$_SESSION['user_id']);
						 echo 	'<div class="alert alert-success">  
								<a class="close" data-dismiss="alert">X</a>  
								<strong>Tada Success! </strong>Successfully Deleted.  
								</div>'; 
					}
					
					// This function lists all the timetable created till now.. with options like delete, edit
					function Timelist($user_id){
						$db_connection = new dbConnection();
						$link = $db_connection->connect(); 
						$query = $link->query("SELECT * FROM freetime WHERE user_id= '$user_id'");
						$query->setFetchMode(PDO::FETCH_ASSOC);
						
						
						echo
							  "<h2>List of FreeTime Already Added</h2>".          
							  "<table class='table table-bordered'>".
								"<thead>".
								  "<tr>".
									// "<th>Time Id</th>".
									"<th>Teacher Id</th>".
									"<th>Day</th>".
									"<th>Start Hour</th>".
									"<th>Start Min</th>".
									"<th>End Hour</th>".
									"<th>End Min</th>".
									"<th>Options</th>".
								  "</tr>".
								"</thead>".
								"<tbody>";
								
								while($result = $query->fetch()){
								  echo "<tr>"
										 // ."<td>".$result['time_id']."</td>"
										 ."<td>".$result['teacher_id']."</td>"
										 ."<td>".$result['day']."</td>"
										 ."<td>".$result['start_hour']."</td>"
										 ."<td>".$result['start_min']."</td>"
										 ."<td>".$result['end_hour']."</td>"
										 ."<td>".$result['end_min']."</td>"
										 ."<td><a href='add.freetime.php?delete=true&id=".$result['time_id']."'>Delete</a></td>"
										 ."</tr>".
								  "</tr>";
								}  
						echo	"</tbody>".
							  "</table>".
							"</div>";
							
					}
					
					Timelist($_SESSION['user_id']);
				}
				else{
					session_destroy();
					header("location: ../index.php");
				}
			?>
		</div>
	</div>
</div>



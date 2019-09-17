	<?php 
	   session_start();
	   if($_SESSION['user_id']){

	   $path = $_SERVER['DOCUMENT_ROOT'];
	   include_once("../cms/header.php");
	   
	   $path = $_SERVER['DOCUMENT_ROOT'];
	   include_once("../cms/class.database.php");
	   
	   include_once("navbar.php");	
		
		function add_course($user_id,$course_name,$course_full_name, $semester, $section, $subject_code, $faculty_code){
				$db_connection = new dbConnection();
				$link = $db_connection->connect(); 
				$query = $link->prepare("INSERT INTO course (user_id,course_name,course_full_name,semester,section,subject_id,faculty_id) VALUES(?,?,?,?,?,?,?)");
				$values = array ($user_id,$course_name,$course_full_name, $semester, $section, $subject_code, $faculty_code);
				$query->execute($values);
				$count = $query->rowCount();
				return $count;
			}
		
		if(isset($_POST['submit']))
		{
				$count= add_course($_SESSION['user_id'],$_POST['name'],$_POST['coursefullname'],$_POST['semester'],$_POST['section'],$_POST['subject'],$_POST['faculty']);
				if($count){ 
				
				echo 	'<div class="alert alert-success">  
						<a class="close" data-dismiss="alert">X</a>  
						<strong>Tada Success! </strong>Added Successfully.  
						</div>'; 
				}
				else{
					echo '<div class="alert alert-block">  
						<a class="close" data-dismiss="alert">X</a>  
						<strong>Opps Error!</strong>Not Added.  
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
			<form class="form-horizontal" method= "post" action = "">
				<fieldset>
				<!-- Form Name -->
				<legend>Add Course</legend>			
				<!-- Text input-->
					<div class="form-group">
					  <label class="control-label" for="name">Course Code</label>  
					  	<select id="name" name="name" class="form-control">
						  <option value="" selected disabled hidden></option>
						  <option value="BSc.CSIT">BSc.CSIT</option>
						  <option value="B.LAW">B.LAW</option>
						  <option value="B.A/B.S">B.A/B.S</option>
						  <option value="B.CA">B.CA</option>
						  <option value="B.Ec">B.Ec</option>
						  <option value="B.Ed">B.Ed</option>
						  <option value="BE.Civil">BE.Civil</option>
						  <option value="BE.computer">BE.computer</option>
						  <option value="BBA">BBA</option>
						  <option></option>
						</select>
					  </div>
					
				
				<!-- Text input-->
					<div class="form-group">
					  <label class="control-label" for="name">Course Name</label>  
					  	<select id="coursefullname" name="coursefullname" class="form-control">
					   	  <option value="" selected disabled hidden></option>
						  <option value="Information Technology & Computer Science">Information Technology & Computer Science</option>
						  <option value="Drama & Cinematics">Drama & Cinematics</option>
						  <option value="Art & Design">Art & Design</option>
						  <option value="Literature">Literature</option>
						  <option value="History">History</option>
						  <option value="Commerce">Commerce</option>
						  <option value="Education">Education</option>
						  <option value="Economics">Economics</option>					  
						  <option value="Law">Law</option>
						  <option value="Civil Engineering">Civil Engineering</option>
						  <option value="Computer Engineering">Computer Engineering</option>
						  <option value="Electronics Engineering">Electronics Engineering</option>
						  <option value="Management studies">Management studies</option>
						</select> 	
					  </div>
					

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="control-label" for="semester">In Semester</label>
					<select id="semester" name="semester" class="form-control">
					  <option value="" selected disabled hidden></option>
					  <option value="one">1</option>
					  <option value="two">2</option>
					  <option value="three">3</option>
					  <option value="four">4</option>
					  <option value="five">5</option>
					  <option value="six">6</option>
					  <option value="seven">7</option>
					  <option value="eight">8</option>
					</select>
				  </div>

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="control-label" for="section">In Section</label>
					<select id="section" name="section" class="form-control">
					  <option value="" selected disabled hidden></option>
					  <option value="a">A</option>
					  <option value="b">B</option>
					</select>
				</div>

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="control-label" for="subject">Subject Taught</label>
					<select id="subject" name="subject" class="form-control">
						<option value="" selected disabled hidden></option>
					<?php
					    $db_connection = new dbConnection();
						$link = $db_connection->connect(); 
						$user_id= $_SESSION['user_id'];
						$query = $link->query("SELECT * FROM subject WHERE user_id= '$user_id'");
						$query->setFetchMode(PDO::FETCH_ASSOC); 				
					while($result = $query->fetch()){
						echo '<option value="'.$result['subject_id'].'">'.$result['subject_name'].'</option>';
					  }?>
					</select>
				  </div>

				<!-- Select Basic -->
				<div class="form-group">
				  <label class="control-label" for="faculty">Faculty Teaching</label>
					<select id="faculty" name="faculty" class="form-control">
						<option value="" selected disabled hidden></option>
					  <?php
					    $db_connection = new dbConnection();
						$link = $db_connection->connect(); 
						$user_id= $_SESSION['user_id'];
						$query = $link->query("SELECT * FROM faculty WHERE user_id='$user_id'");
						$query->setFetchMode(PDO::FETCH_ASSOC); 				
					while($result = $query->fetch()){
						echo '<option value="'.$result['faculty_id'].'">'.$result['faculty_name'].'</option>';
					  }?>
					</select>
				  </div>

				<!-- Button -->
				<div class="form-group">
				  <label class="control-label" for="submit"></label>
					<button id="submit" name="submit" class="btn btn-primary">Add Course</button>
				  </div>

				</fieldset>
				</form>
			</div>		
	    </div>
	    <div class="col-lg-8">
			<?php
				if($_SESSION['user_id']){
					
					function deletecourse($course_id,$user_id){
						$db_connection = new dbConnection();
						$link = $db_connection->connect(); 
						$link->query("DELETE FROM `course` WHERE `course_id` = '$course_id' AND `user_id`='$user_id'");
					}
					if(isset($_GET['delete'])){
						 deletecourse($_GET['id'],$_SESSION['user_id']);
						 echo 	'<div class="alert alert-success">  
								<a class="close" data-dismiss="alert">X</a>  
								<strong>Tada Success! </strong>Successfully Deleted.  
								</div>'; 
					}
					
					// This function lists all the timetable created till now.. with options like delete, edit
					function Courselist($user_id){
						$db_connection = new dbConnection();
						$link = $db_connection->connect(); 
						$query = $link->query("SELECT * FROM course WHERE user_id= '$user_id'");
						$query->setFetchMode(PDO::FETCH_ASSOC);
						
						
						echo
							  "<h2>List of Course Already Added</h2>".          
							  "<table class='table table-bordered'>".
								"<thead>".
								  "<tr>".
									"<th>Course Code</th>".
									"<th>Semester</th>".
									"<th>Section</th>".
									"<th>Subject Id</th>".
									"<th>Faculty Id</th>".
									"<th>Options</th>".
								  "</tr>".
								"</thead>".
								"<tbody>";
								
								while($result = $query->fetch()){
								  echo "<tr>"
										 ."<td>".$result['course_name']."</td>"
										 ."<td>".$result['semester']."</td>"
										 ."<td>".$result['section']."</td>"
										 ."<td>".$result['subject_id']."</td>"
										 ."<td>".$result['faculty_id']."</td>"
										 ."<td><a href='add.course.php?delete=true&id=".$result['course_id']."'>Delete</a></td>"
										 ."</tr>".
								  "</tr>";
								}  
						echo	"</tbody>".
							  "</table>".
							"</div>";
							
					}
					
					Courselist($_SESSION['user_id']);
				}
				else{
					session_destroy();
					header("location: ../index.php");
				}
			?>
		</div>
	  </div>
	  
	</div>
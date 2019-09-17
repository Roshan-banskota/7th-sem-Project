<?php 
   session_start();
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/header.php");
   include_once("navbar.php");
   
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/class.database.php");
   if(@$_SESSION['name']){
		   $db_connection = new dbConnection();
		   $link = $db_connection->connect(); 
		   
		   function get_user_id($username){
			   $db_connection = new dbConnection();
			   $link = $db_connection->connect(); 
			   $query = $link->query("SELECT * FROM users WHERE username='$username'");
			   $query->setFetchMode(PDO::FETCH_ASSOC);
			  
			   while($result = $query->fetch()){
						$user_id =$result['user_id'];
					}
				return $user_id;
		   }
		   $_SESSION['user_id'] = get_user_id($_SESSION['name']);
		   $user_id = $_SESSION['user_id'];	   
		   
		   if(!empty($_POST['generate'])){
			   $course_full_name = $_POST['coursefullname'];
			   $year = $_POST['year'];
			   $semester = $_POST['semester'];
			   $course_code = $_POST['Coursecode'];
			   
			   // create session variable to send the current semester, course, branch, year being choosen to the page table.php 
			   
			   $_SESSION['semester'] = $semester;
			   $_SESSION['course_code'] = $course_code;
			   $_SESSION['course_full_name'] = $course_full_name;
			   $_SESSION['year'] = $year;
			   
			   // check to see if time table already exists..
			   $query = $link->query("SELECT * FROM timetable WHERE semester='$semester' AND course='$course_code' AND course_full_name= '$course_full_name' AND user_id='$user_id'");
			   $query->setFetchMode(PDO::FETCH_ASSOC);
			  
			   while($result = $query->fetch()){
						$id =$result['timetable_id'];
					}
					
					if($id){
							   echo '<div class="alert alert-success">  
										<a class="close" data-dismiss="alert">X</a>  
										<strong>OOPs! </strong>Time table already exists.   
									</div>';
						   }
						   else{
							   // INSERT the values of the form to make a new time table if time table doesn't already exits.. 
							   $query = $link->prepare("INSERT INTO timetable (user_id,course_full_name,year,semester,course) VALUES(?,?,?,?,?)");
							   $values = array ($user_id,$course_full_name,$year,$semester,$course_code);
							   $query->execute($values);
							   header('Location: ../cms/table.php');
						   }
			
		   }
   }
   else{
	   session_destroy();
	   header("location: ../index.php");
	   exit();
   }
			
?>

<SCRIPT TYPE="text/javascript">
var message="Sorry, right-click has been disabled";
///////////////////////////////////
function clickIE() {if (document.all) {(message);return false;}}
function clickNS(e) {if
(document.layers||(document.getElementById&&!document.all)) {
if (e.which==2||e.which==3) {(message);return false;}}}
if (document.layers)
{document.captureEvents(Event.MOUSEDOWN);document.onmousedown=clickNS;}
else{document.onmouseup=clickNS;document.oncontextmenu=clickIE;}
document.oncontextmenu=new Function("return false")

</SCRIPT>   
<body>
<div class="container-fluid"> 
  <div class="row">
    <div class="col-lg-4" >
    	<div class="jumbotron">		
			<form class="form-horizontal" method="post" action="scheduller.php">
			<fieldset>

			<!-- Form Name -->
			<legend>View Schedule</legend>
			<!-- Button -->
			<div class="form-group">
				<input type="submit" id="generate" name="viewschedule" class="btn btn-success" value="View Schedule">

			</div>

			</fieldset>
			</form>

		</div>
    </div>
    <div class="col-lg-8">
	

    </div>
  </div>
  
</div>


<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("../cms/footer.php");
?>
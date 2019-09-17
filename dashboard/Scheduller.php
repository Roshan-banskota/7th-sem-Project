<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	include_once("../cms/header.php");



?>
<link rel="stylesheet" href="../assets/CSS/timetablejs.css">
<script type="text/javascript" src="../assets/js/timetable.js"></script>
<script type="text/javascript" src="../assets/js/DisplayTable.js"></script>
<script type="text/javascript" src="../assets/js/TimeInstance.js"></script>
<script type="text/javascript" src="../assets/js/Teachers.js"></script>
<script type="text/javascript" src="../assets/js/Courses.js"></script>
<script type="text/javascript" src="../assets/js/WTA.js"></script>
<script type="text/javascript" src="../assets/js/Scheduller.js"></script>
<?php
$path = $_SERVER['DOCUMENT_ROOT'];
	include_once("navbar.php");

?>

<div>
	<div class="container-fluid">
	<h1 style="text-align: center;">Routine</h1>
	<div class="timetable"></div>
	</div>
</div>
<?php
	$path = $_SERVER['DOCUMENT_ROOT'];
	include_once("../cms/class.database.php");
	require '../phpmailer/class/class.phpmailer.php';

	// To load data data from Teacher DB;
	$db_connection = new dbConnection();
	$link = $db_connection->connect(); 

	if (isset($_GET['sendnotification'])){
		 $mailquery = $link->query("SELECT * FROM users");

		$mail = new PHPMailer(true);

		try{
	    $mail->isSMTP();                                            // Set mailer to use SMTP
	    $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
	    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
	    $mail->Username   = 'ro2052son@gmail.com';                     // SMTP username
	    $mail->Password   = 'Maheswari12';                               // SMTP password
	    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
		$mail->Port       = 587;  
		
		$mail->setFrom('ro2052son@gmail.com', 'Routine Management System');
			
		while($row = $mailquery->fetch()) {
		 
			$mail->addAddress($row["email"], $row["username"]); 
		}
		
		
		$mail->isHTML(true);                                  // Set email format to HTML
	    $mail->Subject = "test subject";
	    $mail->Body    = "<!DOCTYPE html>
							<html>
							<head>
							<title>Shchedule</title>
							</head>
							<body>

							<p>
							Routine has been update Successfully!!
							Click <a href='http://localhost/project/v.1.3/dashboard/scheduller.php' target='_blank'>here<a/> 
							to see your schedule.

							</p>

							</body>
							</html>";	

		$mailresult = $mail->Send();
 
		} catch(Exception $e) {
			echo $e;
		}
 
	}

	$query1 = $link->query("SELECT * FROM teacher");
	$query1->setFetchMode(PDO::FETCH_ASSOC);					
	
	while($result1 = $query1->fetch())
	{
		$id=$result1['teacher_id'];
		$name=$result1['teacher_name'];
?>

		<script type="text/javascript">
			var name = "<?php echo $name?>";
			var id = "<?php echo $id?>";
			id = Number(id);
			var teacher = new  Teacher(id,name);
			teacher.addTeacher();
		</script>

 <?php
		// To load data data from FreeTime DB;
		$query2 = $link->query("SELECT * FROM freetime where teacher_id = $id");
		$query2->setFetchMode(PDO::FETCH_ASSOC);					
		
		while($result2 = $query2->fetch())
		{
			$tid=$result2['teacher_id'];
			
			if($tid==$id)
			{
			 	$day=$result2['day'];
			 	$start_hour=$result2['start_hour'];
			 	$start_min=$result2['start_min'];
			 	$end_hour=$result2['end_hour'];
			 	$end_min=$result2['end_min'];
			}
?>

		<script type="text/javascript">
			var day = "<?php echo $day?>";
			var start_hour = "<?php echo $start_hour?>";
			var start_min = "<?php echo $start_min?>";
			var end_hour = "<?php echo $end_hour?>";
			var end_min = "<?php echo $end_min?>";
			day= Number(day);
			start_hour= Number(start_hour);
			start_min= Number(start_min);
			end_hour= Number(end_hour);
			end_min= Number(end_min);

			teacher.addFreeTime(day,start_hour,start_min,end_hour,end_min);
		</script>

 <?php
		}
	}

	// To load data data from Subject DB;
	$query3 = $link->query("SELECT * FROM subject");
	$query3->setFetchMode(PDO::FETCH_ASSOC);	
	while($result3 = $query3->fetch())
	{
		$cid=$result3['subject_id'];	
		$cname=$result3['subject_name'];
		$ctid=$result3['teacher_id'];
		$total = $result3['l'];
		$taken = $result3['c_taken'];
		$slack = $result3['slack'];
?>
		<script type="text/javascript">
			var cid = "<?php echo $cid?>";
			var cname = "<?php echo $cname?>";
			var ctid = "<?php echo $ctid?>";

			cid = Number(cid);
			ctid = Number(ctid);
			
			var teach;
			function getTeach()
			{
				for (var i = 0; i < teacherDB.length; i++) 
				{
					console.log(ctid,teacherDB[i].eid);
					if (teacherDB[i].eid === ctid) 
					{
						
						teach = teacherDB[i];
					}
				}
			}

			getTeach();
			var total = "<?php echo $total?>";
			var taken = "<?php echo $taken?>";
			var slack = "<?php echo $slack?>";
			var course = new Course(cid,cname,teach,total,taken,slack);
			course.addCourse();
		</script>
<?php  
	}
?>

<script type="text/javascript">
	initWTA(45);
	updateWTA();
	initRoutine();
	schedule();
	displayRoutine(); 
</script>

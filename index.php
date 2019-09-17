<?php 
   session_start();
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("cms/header.php"); 

   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("cms/class.ManageUsers.php");
   
   $users = new ManageUsers();
   
   
   if(isset($_POST['lgn']))
	{
		$username = $_POST['username'];
		$password = md5($_POST['password']);

		
		$count = $users->LoginUsers($username, $password);
		if($count ==0)
		{
			echo '<div class="alert alert-danger fade in">  
                    <a class="close" data-dismiss="alert">X</a>  
                    <strong>Opps !!! </strong>You are not Yet Registered.  
                    </div>';
		}
		else if($count == 1)
		{
			$make_sessions = $users->GetUserInfo($username);
				foreach($make_sessions as $userSessions)
				{
					$_SESSION['name'] = $userSessions['username'];
					if(isset($_SESSION['name']))
					{
						header("location: dashboard/dashboard.php");
					}
				}
		}
		
	}	

?>



<body id="back">


    <div class="container-fluid">
        <div id="MyClockDisplay" class="clock" onload="showTime()"></div>
        <div id="form" class="login">
            <form class="form-horizontal" method="post" action="" onsubmit="return validation()">
                <fieldset>

                    <!-- Form Name -->
                    <h1>Welcome</h1>

                    <!-- Text input-->
                    <div class="form-group">

                        <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md" required=""  aria-describedby="basic-addon1">

                    </div>

                    <!-- Password input-->
                    <div class="form-group">
                        <input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" required="">

                    </div>

                    <!-- Button -->
                    <div class="form-group">
                        <input type="submit" name="lgn" class="btn btn-login" value="Login">

                    </div>

                </fieldset>
                <span>
                        Are you new? <a href="cms/login.php">Register</a>
                    </span>
            </form>
        </div>
    </div>

</body>

<script type="text/javascript">
    function showTime() {
        var date = new Date();
        var h = date.getHours(); // 0 - 23
        var m = date.getMinutes(); // 0 - 59
        var s = date.getSeconds(); // 0 - 59
        var session = "AM";

        if (h == 0) {
            h = 12;
        }

        if (h > 12) {
            h = h - 12;
            session = "PM";
        }

        h = (h < 10) ? "0" + h : h;
        m = (m < 10) ? "0" + m : m;
        s = (s < 10) ? "0" + s : s;

        var time = h + ":" + m + ":" + s + " " + session;
        document.getElementById("MyClockDisplay").innerText = time;
        document.getElementById("MyClockDisplay").textContent = time;

        setTimeout(showTime, 1000);

    }

    showTime();

</script>

<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("cms/footer.php");
?>

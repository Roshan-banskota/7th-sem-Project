<?php 
   session_start();

   if (!isset($_POST["register"])){
    session_destroy();
   }

   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("header.php"); 	
?>
 
<script type="text/javascript">
    

        function validation(){
 
            var uname = document.getElementById('uname').value;
            var user = document.getElementById('username').value;
            var email = document.getElementById('email').value;
            var pass = document.getElementById('password').value;
           
             //clear the errors
            document.getElementById('luname').innerHTML = "";
            document.getElementById('lusername').innerHTML = "";
            document.getElementById('lemail').innerHTML ="";
            document.getElementById('lpass').innerHTML = "";

            if(uname == ""){ 
                document.getElementById('luname').innerHTML =" ** Please fill the university field";
                return false;
            }
            
            if(!isNaN(uname)){
                document.getElementById('luname').innerHTML =" ** Only characters are allowed";
                return false;
            }



             if(user == ""){
                document.getElementById('lusername').innerHTML =" ** Please fill the username field";
                return false;
            }
            if((user.length <= 4) || (user.length > 8)) {
                document.getElementById('lusername').innerHTML =" ** username name  lenght must be 6 characters";
                return false;   
            }
            if(!isNaN(user)){
                document.getElementById('lusername').innerHTML =" ** only characters are allowed";
                return false;
            }


             if(email == ""){
                document.getElementById('lemail').innerHTML =" ** Please fill the valid Email Address";
                return false;
            }
            if(email.indexOf('@') <= 0 ){
                document.getElementById('lemail').innerHTML ="  Invalid email address";
                return false;
            }

            if((email.charAt(email.length-4)!='.') && (email.charAt(email.length-3)!='.')){
                document.getElementById('lemail').innerHTML =" ** Invalid Email address";
                return false;
            }


            if(pass == ""){
                document.getElementById('lpass').innerHTML =" ** Please fill the password field";
                return false;
            }
            if((pass.length <= 4) || (pass.length > 20)) {
                document.getElementById('lpass').innerHTML =" ** Passwords lenght must be 5 character";
                return false;   
            }

            document.getElementById("regform").submit();
           
        }

</script>

<!-- <script> 
function validate()                                    
{ 
    var uname = document.forms["RegForm"]["uname"];               
    var name = document.forms["RegForm"]["username"];               
    var email = document.forms["RegForm"]["email"];    
    var password = document.forms["RegForm"]["password"];  
   
     if (uname.value == "")                                  
    { 
        window.alert("Please enter your university name."); 
        uname.focus(); 
        return false; 
    } 

    if (name.value == "")                                  
    { 
        window.alert("Please enter your name."); 
        name.focus(); 
        return false; 
    } 
  
    if (email.value == "")                                   
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 
   
    if (email.value.indexOf("", 0) < 0)                 
    { 
        window.alert("Please enter a valid e-mail address."); 
        email.focus(); 
        return false; 
    } 

    function ValidateEmail(inputText)
        {
        var email = /^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/;
        if(email.value.match(email))
        {
        email.focus();
        return true;
        }
        else
        {
        alert("You have entered an invalid email address!");
        document.form1.text1.focus();
        return false;
}
//     if(email.value.validateEmail(email))
//     {
//      window.alert(" /^(([^<>()[\]\\.,;:\s@\"]+(\.[^<>()[\]\\.,;:\s@\"]+)*)|(\".+\"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/");
//     return false;
// }
   
    // if (email.value.indexOf(".", 0) < 0)                 
    // { 
    //     window.alert("Please enter a valid e-mail address."); 
    //     email.focus(); 
    //     return false; 
    // } 
   
    if (password.value == "")                        
    { 
        window.alert("Please enter your password"); 
        password.focus(); 
        return false; 
    } 

   
    return true; 
}</script> -->

<body>
	<div id="content" class="register">
		<div id="form" class="container">
           
        
		<form name="RegForm" id="regform" class="form-horizontal" method="post" action="register.php" onsubmit="return validation()">
			 <?php 

                if(isset($_SESSION["error"])){

                    echo "<label class='error'>" .$_SESSION["error"]."</label>";
                   
                    unset($_SESSION["error"]);

                }

             ?>
           

            <fieldset>
			<!-- Form Name -->
			<legend><a href="../index.php"><span class="glyphicon glyphicon-menu-left" aria-hidden="true"></span></a><span>Registration Form</span></legend>
			
			<!-- Text input-->
			<div class="form-group">
          
			  <input id="uname" name="uname" type="text" placeholder="College Name" class="form-control input-md" >
				<label id="luname" class="error"></label>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <input id="username" name="username" type="text" placeholder="Username" class="form-control input-md">
			<label id="lusername" class="error"></label>
			</div>

			<!-- Text input-->
			<div class="form-group">
			  <input id="email" name="email" type="text" placeholder="E-Mail" class="form-control input-md" >
				<label id="lemail" class="error"></label>
			</div>

			<!-- Password input-->
			<div class="form-group">
				<input id="password" name="password" type="password" placeholder="Password" class="form-control input-md" >
				    <label id="lpass" class="error"></label>
			</div>

			<!-- Button -->
				<input type="submit" id="register" name="register" class="btn btn-login" value="Register">


			</fieldset>
		</form>
		</div>
	</div>
	


			
			


</body>
<?php 
   $path = $_SERVER['DOCUMENT_ROOT'];
   include_once("footer.php");
?>


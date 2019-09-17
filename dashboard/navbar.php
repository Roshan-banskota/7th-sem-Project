<nav class="navbar navbar-default">
  <div class="container-fluid">
    <div>
      <ul class="nav navbar-nav">
        <li><a href="dashboard.php"><span class="glyphicon glyphicon-home"></span> Home</a></li>
        <li><a href="add.teacher.php"><span class="glyphicon glyphicon-user"></span> Add Teacher</a></li>
        <li><a href="add.subject.php"><span class="glyphicon glyphicon-book"></span> Add Subjects</a></li>
        <li><a href="add.faculty.php"><span class="glyphicon glyphicon-user"></span> Add Faculty</a></li>  
        <li><a href="add.course.php"><span class="glyphicon glyphicon-education"></span> Add Course</a></li> 
        <li><a href="add.freetime.php"><span class="glyphicon glyphicon-time"></span> Add Free Time</a></li>
        <li>

          <a href="Scheduller.php?sendnotification=true"><span class="glyphicon glyphicon-bell"></span> Send Notification</a></li>


      </ul>
      <ul class="nav navbar-nav navbar-right btn-md">
        <li><a href="#"><span class="glyphicon glyphicon-user "></span> Welcome <?php if(@$_SESSION['name'])echo $_SESSION['name']; ?></a></li>
        <li><a href="logout.php"><span class="glyphicon glyphicon-log-in"></span> LogOut</a></li>
      </ul>
    </div>
  </div>
</nav>




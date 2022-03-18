<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
   

?>
<html>
    <head>
        <title>Add disease</title>
        <link href="hospital.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div id="workplace">
       <div id="menu">
       <img src="admin.png" height="200"width="200">
<b>Welcome to the Hospital</b>
<a href="admindashboard.php">
    <div class="menubtn" >
     Dashboard
    </div>
</a>
<a href="doctorlist.php">
    <div class="menubtn">
     Doctors Info.
    </div>
</a>
<a href="admitted.php">
    <div class="menubtn">
    Admits Info.
    </div>
</a>
<a href="bills.php">
    <div class="menubtn">
    Bills Info.
    </div>
</a>
<a href="visits.php">
    <div class="menubtn">
     Visits Info.
    </div>
</a>
<a href="patientlist.php">
    <div class="menubtn">
     Patient Info.
    </div>
</a>
<a href="rooms.php">
    <div class="menubtn" >
     Rooms Info.
    </div>
</a>
<a href="disease.php">
    <div class="menubtn" id="active">
     Disease Info.
    </div>
</a>
<a href="sessionkill.php">
    <div class="menubtn">
     Logout
    </div>
</a>
       </div>
      
       <div id="display">
           <div id="errorbox2" >Insertion failed! Try again
               <button onclick="none()">X</button>
           </div>
        <div class="form">
            <div id="caption">Add Disease</div>

          <div class="frmlable2">
              <span>Disease Name:</span>
         Details:
          </div>
          <div class="frmfield" >
              <!--Form here-->

            <form action="adddisease.php" method="POST">
                <input type="text" name="diss" value=""  required placeholder="Disease Name"><br><br>
                <input type="text" name="dtl" value="" placeholder="Details" required>

          </div>
         <div id="btn" style="margin-left: 200px;"> <button type="submit" name="sbtn">Add</button></div>
        </form>
        </div>
       </div> 
        </div>
    </body>
    <script>
        function none(){
            document.getElementById("errorbox2").setAttribute("style","display:none;");
        }
    </script>

<?php

if(isset($_POST['sbtn'])){
$diss=$_POST['diss'];
$dtl=$_POST['dtl'];


    $sql="INSERT into diseases values ('$diss','$dtl')";
    $result=mysqli_query($con,$sql);
    if($result)
    {
    header("Location:disease.php");
}
    else{
        ?>
<script>
    document.getElementById("errorbox2").setAttribute("style","display:block");
    
    </script>
    <?php
    }
}

}
else
header("Location:adminlogin.php");
?>
<span id="footer">&copy Footer</span>
</html>
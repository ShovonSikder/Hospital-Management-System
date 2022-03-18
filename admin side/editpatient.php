<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
   
    if(@$_GET['id']=="edit"){
        $_SESSION['ptid']=$_GET['ptid'];
    }
    $ptid=$_SESSION['ptid'];
    $sql2="SELECT * from patients where pt_id='$ptid'";
    $result=mysqli_query($con,$sql2);
    $data=mysqli_fetch_array($result);
?>
<html>
    <head>
        <title>Edit patient</title>
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
    <div class="menubtn" >
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
    <div class="menubtn"id="active">
     Patient Info.
    </div>
</a>
<a href="rooms.php">
    <div class="menubtn">
     Rooms Info.
    </div>
</a>
<a href="disease.php">
    <div class="menubtn">
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
        <div class="form2">
            <div id="caption">Edit Patient</div>

          <div class="frmlable2">
              <span>Patient ID:</span>
          <span>Patient Name:</span><span>Address:</span><span>Date of Birth:</span>
          <span>Phone:</span><span>Gmail:</span>Password:
          </div>
          <div class="frmfield" >
              <!--Form here-->

            <form action="editpatient.php" method="POST">
                <input type="text" name="pt_id" value="<?php echo $ptid;?>"  readonly><br><br>
                <input id="fname"type="text" name="f_name" value="<?php echo $data['first_name'];?>" placeholder="First Name" required>
                <input id="fname"type="text" name="l_name" value="<?php echo $data['last_name'];?>" placeholder="Last Name" required><br><br>
                <input type="text" name="addrs" value="<?php echo $data['address'];?>" placeholder="Address" required><br><br>
                <input type="date" name="dob" value="<?php echo $data['dob'];?>" required><br><br>
                

                <input type="text" name="phone" value="<?php echo $data['phone'];?>"  placeholder="Phone" required><br><br>
                <input type="text" name="gmail" value="<?php echo $data['gmail'];?>"  placeholder="Email address" required>
                <br><br>
                <input type="password" name="pass" value="<?php echo $data['password'];?>"  placeholder="Password" required>


          </div>
         <div id="btn" style="margin-left: 200px;"> <button type="submit" name="sbtn">Update</button></div>
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
$ptid=$_POST['pt_id'];
$fname=$_POST['f_name'];
$lname=$_POST['l_name'];
$addrs=$_POST['addrs'];
$dob=$_POST['dob'];
$phone=$_POST['phone'];
$gmail=$_POST['gmail'];
$pass=$_POST['pass'];

    $sql="UPDATE patients set first_name='$fname', last_name='$lname', address='$addrs',dob='$dob',phone='$phone',gmail='$gmail',password='$pass' where pt_id='$ptid'";
    $result=mysqli_query($con,$sql);
    if($result)
    {
    header("Location:patientlist.php?");
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
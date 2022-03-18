<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){

?>
<html>
    <head>
        <title>Add disease expert</title>
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
            <div id="caption">Add Disease Expert</div>

          <div class="frmlable2">
              <span>Doctor ID:</span>
        Disease Name:
          </div>
          <div class="frmfield" >
              <!--Form here-->

            <form action="adddiseaseexprt.php" method="POST">
                <select name="doc">
                <?php
                $result=mysqli_query($con,"SELECT doc_id from doctors");
                while($data=mysqli_fetch_array($result))
                {?>
                    <option value="<?php echo $data['doc_id'];?>"><?php echo $data['doc_id'];?></option>
                <?php}
                ?>
                </select>
                <br><br>
                <select name="diss">
                <?php
                $result=mysqli_query($con,"SELECT diss_name from diseases");
                while($data=mysqli_fetch_array($result))
                {?>
                    <option value="<?php echo $data['diss_name'];?>"><?php echo $data['diss_name'];?></option>
                <?php }
                ?>
                </select>

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
$doc=$_POST['doc'];


    $sql="INSERT into dissexprt values ('$diss','$doc')";
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
}
else
header("Location:adminlogin.php");
?>
<span id="footer">&copy Footer</span>
</html>
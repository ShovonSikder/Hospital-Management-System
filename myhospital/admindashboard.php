<?php
session_start();
if($_SESSION['ckadmin']=="true"){
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
?>
<html>
    <head>
        <title>Dashboard</title>
        <link href="hospital.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="workplace">
       <div id="menu">
           <img src="admin.png" height="200"width="200">
<b>Welcome to the Hospital</b>
<a href="admindashboard.php">
    <div class="menubtn" id="active">
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
      
       <div id="display" style="text-align: left;">
          <div class="win1" style="text-align: left;">
            <div id="caption">
                Admin Dashboard
                 </div>

                 <div class="doclist" style="width:680px;height:25px;">
                    <marquee direction="left" scrollamount="4"> <b style="font-size: larger;">Stay Home. Stay Safe</b>
                 Wear mask. Together we can defeat Covid-19.
                 </marquee>
                 </div>  
                    <hr>
                 <div class="box" >
                    <br>Total Admitted<br><br><b>
                        <?php
                            $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(pt_id) as c from admits"));
                            echo $data['c'];
                        ?></b>
                 </div>

                 <div class="box">
                    <br>Total Visits<br><br><b><?php
                            $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(visit_id) as c from visits"));
                            echo $data['c'];
                        ?></b>
                 </div>

                 <div class="box">
                    <br> Appointments <br><br><b><?php
                            $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(pt_id) as c from appointments"));
                            echo $data['c'];
                        ?></b>
                 </div>

                 <div class="box">
                    <br>Available Doctors<br><br><b><?php
                            $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(DISTINCT doc_id) as c from dissexprt"));
                            echo $data['c'];
                           
                     $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from doctors"));
                     echo " of ".$data['c'];
                     
            
                        ?></b>
                 </div>

                 <div class="box">
                    <br>Available Rooms<br><br><b><?php
                    $sqlroom="SELECT count(distinct rooms.room_no) as cn
                    FROM rooms
                    WHERE room_no NOT in(
                    SELECT rooms.room_no FROM rooms INNER join (SELECT admits.room_no as r, COUNT(admits.room_no) as c FROM admits GROUP by room_no) tt ON tt.r=rooms.room_no
                    WHERE rooms.capacity<=tt.c) AND rooms.capacity>0";
                            $data=mysqli_fetch_array(mysqli_query($con,$sqlroom));
                            echo $data['cn'];
                          
                            $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(room_no) as c from rooms"));
                            echo " of ".$data['c'];
                        
                        ?></b>
                 </div>

                 <div class="box">
                    <br>Total Reg.<br>Patients<br><br><b><?php
                            $data=mysqli_fetch_array(mysqli_query($con,"SELECT count(pt_id) as c from patients"));
                            echo $data['c'];
                        ?></b>
                 </div>
                 
                 
          </div>
        
          <div class="win2">
            <div id="caption">
                News
                 </div>
                 
                 <div class="doclist">
                    <marquee direction="up" scrollamount="1"> <b style="font-size: larger;">Stay Home. Stay Safe</b><br>
                 Wear mask. Together we can defeat Covid-19.
                 </marquee>
                 </div>  
          </div>
      
       </div> 
        </div>
    </body>
    <span id="footer">&copy Footer</span>
</html>
<?php
}
else
header("Location:adminlogin.php");
?>
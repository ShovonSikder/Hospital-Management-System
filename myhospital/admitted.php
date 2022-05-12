<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){

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
    <div class="menubtn"id="active">
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
          <div class="win1" style="text-align: left;width:900px">
            <div id="caption">
                All Admite Info.
                 </div>
                 <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                 
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(pt_id) as c from admits"));
                    if($data3['c']>0)
                    echo "Total admitted <b style=\"color:brown;font-size:20px\">".$data3['c']."</b> Patient";
                    else
                    echo "No admitted patient!!! <a href=\"newadmit.php\">Admit now</a>";
                  ?> 
                 
                </div> <hr>

                 <a href="newadmit.php" class="buttons"> <button>Admit Patient</button></a>
                
                 <br><br>
                <?php
                $sql="SELECT admits.pt_id,first_name,last_name,phone,admit_date,admits.room_no,room_type FROM admits NATURAL JOIN patients NATURAL JOIN rooms";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">Admitted Patients</caption>
                    <tr>
                        <th>Pt_ID</th>
                        <th>Name</th>
                        <th>Contact</th>
                        <th>Date</th>
                        <th>Room No.</th>
                        <th>Room Type</th>

                        <th>Action</th>
                        
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $data2['pt_id'];?></td>
                        <td><?php echo $data2['first_name']." ".$data2['last_name'];?></td>
                        
                        
                        <td><?php echo "Phone: ".$data2['phone'];?></td>
                        <td><?php echo $data2['admit_date']?></td>
                        <td><?php echo $data2['room_no'];?></td>
                        <td><?php 
                        echo $data2['room_type'];
                        ?></td>
                        
                        <td><a href="makebill.php?id=bill&ptid=<?php echo $data2['pt_id'];?>">Release</a> </td>
                    </tr>
                    <?php
                        }
                        
                    }
                   
                    ?>
                    
                </table>
                 
                 
          </div>
        
          <div class="win2"style="width: 226px;">
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
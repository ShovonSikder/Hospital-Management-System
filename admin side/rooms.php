<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){

?>
<html>
    <head>
        <title>Dashboard rooms</title>
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
    <div class="menubtn" >
     Patient Info.
    </div>
</a>
<a href="rooms.php">
    <div class="menubtn"id="active">
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
      
       <div id="display" style="width:1130px;height: 620px;text-align: left;">
          <div class="win1" >
            <div id="caption">
                All Rooms Info.
                 </div>
                 <a href="addroom.php" class="buttons"> <button>Add New Room</button></a><br><hr>
                
                <?php
                $sql="SELECT * from rooms";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">All Rooms</caption>
                    <tr>
                        <th>Room No</th>
                        <th>Type</th>
                        <th>Cost</th>
                        <th>Capacity</th>
                        <th>Rem. Seat</th>
                        <th>Action</th>
                        
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $data2['room_no'];?></td>
                        <td><?php echo $data2['room_type'];?></td>
                        
                        <td><?php echo $data2['cost_day'];?></td>
                        <td><?php echo $data2['capacity'];?></td>
                        <td><?php 
                        $room=$data2['room_no'];
                        $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(room_no) as c from admits where room_no='$room'"));
                        if($data2['capacity'] - $data3['c']>0)
                        echo $data2['capacity'] - $data3['c'];
                        else echo "<b style='color:brown'>No seat</b>";
                        ?></td>
                        
                        <td> 
                        <a href="editroom.php?id=edit&roomno=<?php echo $data2['room_no'];?>">Edit</a></td>
                    </tr>
                    <?php
                        }
                        
                    }
                    else{
                    ?>
                    <div class="doclist">
                        Hospital has no Room!!! 
                        
                    </div>
                    <?php
                    }
                    ?>
                    
                </table>
                 
                 
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

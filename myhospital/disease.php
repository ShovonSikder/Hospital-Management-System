<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){

?>
<html>
    <head>
        <title>Dashboard disease</title>
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
    <div class="menubtn">
     Rooms Info.
    </div>
</a>
<a href="disease.php">
    <div class="menubtn"id="active">
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
                All Diseases Info.
                 </div>
                 <a href="adddisease.php" class="buttons"> <button>Add New Disease</button></a>
                 <a href="adddiseaseexprt.php" class="buttons"> <button>Add Expert</button></a>
                 <br><hr>
                
                <?php
                $sql="SELECT * from diseases";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">All Disease</caption>
                    <tr>
                        <th>Disease Name</th>
                        <th>Disease Expert</th>
                        <th>Details</th>
                        <th>Action</th>
 
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $data2['diss_name'];?></td>
                        <td><?php 
                        $diss=$data2['diss_name'];
                        $result3=mysqli_query($con,"SELECT first_name,last_name from dissexprt natural join doctors where diss_name='$diss'");
                        while($data3=mysqli_fetch_array($result3))
                        echo $data3['first_name']." ".$data3['last_name'];?></td>
                        
                        <td><?php echo $data2['diss_details'];?></td>
                        
                        <td> 
                        <a href="editdisease.php?id=edit&dissname=<?php echo $data2['diss_name'];?>">Edit</a></td>
                    </tr>
                    <?php
                        }
                        
                    }
                    else{
                    ?>
                    <div class="doclist">
                        No disease added!!! <a href="adddisease.php">Add Disease</a>
                        
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

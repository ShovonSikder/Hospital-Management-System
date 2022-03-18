<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
//delete data
if(@$_GET['id']=="del"){
   
    $pt=$_GET['ptid'];
    $sql1="DELETE from visits where pt_id='$pt';";
    $sql2="DELETE from appointments where pt_id='$pt';";
    $sql3="DELETE from admits where pt_id='$pt';";
    $sql4="DELETE from bills where pt_id='$pt';";
    $sql5="DELETE from patients where pt_id='$pt'";
    mysqli_query($con,$sql1);
    mysqli_query($con,$sql2);
    mysqli_query($con,$sql3);
    mysqli_query($con,$sql4);
    mysqli_query($con,$sql5);
    header("Location:patientlist.php");
}

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
    <div class="menubtn" id="active">
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
      
       <div id="display" style="width:1130px;height: 620px;text-align: left;">
          <div class="win1" style="text-align: left;width:1000px">
            <div id="caption">
                All Patients Info.
                 </div>
                
                <?php
                $sql="SELECT * from patients";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">All Patients</caption>
                    <tr>
                        <th>Pt ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Password</th>
                        <th>Action</th>
                        
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $data2['pt_id'];?></td>
                        <td><?php echo $data2['first_name']." ".$data2['last_name'];?></td>
                        <td><?php $diff = date_diff(date_create($data2['dob']), date_create(date("Y-m-d")));
                echo $diff->format('%y')+1; ?></td>
                        
                        <td><?php echo $data2['gender'];?></td>
                        <td><?php echo "Phone: ".$data2['phone']."<br>Mail: ".$data2['gmail'];?></td>
                        <td><?php echo $data2['password'];?></td>
                        
                        <td><a href="patientlist.php?id=del&ptid=<?php echo $data2['pt_id'];?>">Delete</a> | 
                        <a href="editpatient.php?id=edit&ptid=<?php echo $data2['pt_id'];?>">Edit</a></td>
                    </tr>
                    <?php
                        }
                        
                    }
                    else{
                    ?>
                    <div class="doclist">
                        Hospital has no Patient!!! 
                        
                    </div>
                    <?php
                    }
                    ?>
                    
                </table>
                 
                 
          </div>
        
          <div class="win2"style="width: 126px;">
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

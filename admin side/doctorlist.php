<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
//delete data
if(@$_GET['id']=="del"){
   
    $doc=$_GET['docid'];
    $sql1="DELETE from visits where doc_id='$doc';";
    $sql2="DELETE from dissexprt where doc_id='$doc';";
    $sql3="DELETE from admits where doc_ref='$doc';";
    $sql4="DELETE from appointments where doc_id='$doc';";
    $sql5="DELETE from doctors where doc_id='$doc'";
    mysqli_query($con,$sql1);
    mysqli_query($con,$sql2);
    mysqli_query($con,$sql3);
    mysqli_query($con,$sql4);
    mysqli_query($con,$sql5);
    header("Location:doctorlist.php");
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
    <div class="menubtn" id="active">
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
      
       <div id="display" style="width:1130px;height: 620px;text-align: left;">
          <div class="win1" style="text-align: left;width:1000px">
            <div id="caption">
                All Doctors Info.
                 </div>
                 <a href="adddoctor.php" class="buttons"> <button>Add New Doctor</button></a>
                
                 <br><br>
                <?php
                $sql="SELECT * from doctors";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">All Doctors</caption>
                    <tr>
                        <th>Doc ID</th>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>Password</th>
                        <th>Exprt in</th>
                        <th>Action</th>
                        
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $docid=$data2['doc_id'];?></td>
                        <td><?php echo $data2['first_name']." ".$data2['last_name'];?></td>
                        <td><?php $diff = date_diff(date_create($data2['dob']), date_create(date("Y-m-d")));
                echo $diff->format('%y')+1; ?></td>
                        
                        <td><?php echo $data2['gender'];?></td>
                        <td><?php echo "Phone: ".$data2['phone']."<br>Mail: ".$data2['gmail'];?></td>
                        <td><?php echo $data2['password'];?></td>
                        <td><?php 
                        $result3=mysqli_query($con,"SELECT diss_name from dissexprt where doc_id='$docid'");
                        while($data3=mysqli_fetch_array($result3)){

                        echo $data3['diss_name'].", ";
                        }
                        ?></td>
                        
                        <td><a href="doctorlist.php?id=del&docid=<?php echo $docid;?>">Delete</a> | 
                        <a href="editdoctor.php?id=edit&docid=<?php echo $docid;?>">Edit</a></td>
                    </tr>
                    <?php
                        }
                        
                    }
                    else{
                    ?>
                    <div class="doclist">
                        Hospital has no doctor!!! 
                        <a href="adddocotr.php">Add Doctor</a>
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
<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckdoc']=="true"){
    $docid=$_SESSION['docid'];

    //delete data
if(@$_GET['id']=='del')
{   
  
    $ptid=$_GET['ptid'];
    $sql="delete from appointments where pt_id='$ptid' and doc_id='$docid'";
    mysqli_query($con,$sql);
    header("Location:appointmentdoctor.php");
   
}

    $sql="SELECT pt_id,first_name,last_name,dob,gender,ap_date
    FROM appointments NATURAL JOIN patients
    WHERE doc_id='$docid' order by ap_date";
    $result=mysqli_query($con,$sql);
    if($result){
        $count=mysqli_num_rows($result);
   
?>
<html>
    <head>
        <title>Dashboard appointmentdoctor</title>
        <link href="hospital.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="workplace">
       <div id="menu">
           <img src="doctor.jpeg" height="200"width="200">
<b><?php echo $_SESSION['name'];?><br>Welcome to the Hospital</b>
<a href="doctordashboard.php">
    <div class="menubtn" >
     Profile
    </div>
</a>
<a href="appointmentdoctor.php">
    <div class="menubtn"id="active">
     Appointments
    </div></a>

<a href="doctorserve.php">
    <div class="menubtn" >
         Serve info
    </div></a>
<a href="sessionkill.php">
    <div class="menubtn">
     Logout
    </div>
</a>
       </div>
      
       <div id="display"style="text-align: left;">
           <div class="win1">
       
            <div id="caption">Appoinments</div>
  
            <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                  $date=date("Y-m-d");
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from appointments where doc_id='$docid' and ap_date='$date'"));
                    if($data3['c']>0)
                    echo "You have <b style=\"color:brown;font-size:20px\">".$data3['c']."</b> appointments today";
                    else
                    echo "You have no appointment today!!!";
                  ?> 
                 
                </div>       
                <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                    
                    if($count>0)
                    echo "You have total <b style=\"color:brown;font-size:20px\">".$count."</b> appointments";
                    else
                    echo "You have no appointment yet!!!";
                ?> 
                </div>


                <hr>
               <a href="makevisitdoc.php" class="buttons"> <button>New Visit</button></a><br><br>

                <?php 
                    if($count>0){
                ?> 
                <table align="center">
                    <caption style="font-size:20px;font-weight:bold">Records of Appoinments</caption>
                    <tr>
                        <th>Pt_ID</th>
                        <th>Pt. Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>App. Date</th>
                        <th>Action</th>
                        
                    </tr>
                    <?php
                        while($data=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        
                    <td><?php echo $data['pt_id'];?></td>
                        <td><?php echo $data['first_name']." ".$data['last_name'];?></td>
                        <td><?php $diff = date_diff(date_create($data['dob']), date_create(date("Y-m-d")));
                echo $diff->format('%y')+1;?></td>
                        <td><?php echo $data['gender'];?></td>
                        <td><?php echo $data['ap_date'];?></td>
                        <td><a href="appointmentdoctor.php?id=del&ptid=<?php echo $data['pt_id'];?>">Delete</a><b> | </b>
                        <a href="makevisitdoc.php?id=vis&ptid=<?php echo $data['pt_id'];?>">Visit</a></td>
                    </tr>
                    <?php
                    }
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
    echo "Query error";
}
else
header("Location:doctorlogin.php");
?>
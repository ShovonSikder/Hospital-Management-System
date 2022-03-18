<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckdoc']=="true"){
    $docid=$_SESSION['docid'];
    $sql="SELECT visit_id,first_name,last_name,gender,visit_date,diss_name,suggestions
    FROM visits NATURAL JOIN patients
    WHERE doc_id='$docid' order by visit_date DESC";
    $result=mysqli_query($con,$sql);
    if($result){
        $count=mysqli_num_rows($result);
   
?>
<html>
    <head>
        <title>Dashboard doctor</title>
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
    <div class="menubtn">
     Appointments
    </div></a>

<a href="doctorserve.php">
    <div class="menubtn" id="active">
         Serve info
    </div></a>
<a href="sessionkill.php">
    <div class="menubtn">
     Logout
    </div>
</a>
       </div>
      
       <div id="display"style="width:1130px;height: 620px;text-align: left;">
           <div class="win1"style="width: 750px;">
       
            <div id="caption">Serve History</div>
            <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                  $date=date("Y-m-d");
                    $data5=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from visits where doc_id='$docid' and visit_date='$date'"));
                    if($data5['c']>0)
                    echo "Total serves Today <b style=\"color:brown;font-size:20px\">".$data5['c']."</b> patients";
                    else
                    echo "You didn't serve yet today!!!";
                  ?>        
                </div> 
                <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                    $data5=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from visits where doc_id='$docid'"));
                    if($data5['c']>0)
                    echo "Total served <b style=\"color:brown;font-size:20px\">".$data5['c']."</b> patients";
                    else
                    echo "You didn't serve any patients yet!!!";
                  ?>   </div>
                  <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                    $data5=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_ref) as c from admits where doc_ref='$docid'"));
                    if($data5['c']>0)
                    echo "Total admitted <b style=\"color:brown;font-size:20px\">".$data5['c']."</b> patients on you";
                    else
                    echo "No admitted patient on you yet!!!";
                  ?>     
                </div>
                <hr>
                <?php 
                    $sql2="SELECT first_name,last_name,dob,gender,admits.room_no as room,room_type,diss_name,admit_date
                    FROM admits NATURAL JOIN patients NATURAL JOIN rooms
                    WHERE doc_ref='$docid' order by admit_date";
                    $result2=mysqli_query($con,$sql2);
                    $count2=mysqli_num_rows($result2);
                    if($count2>0){
                ?> 
                
                <table align="center">
                    <caption style="font-size:20px;font-weight:bold">Records of Admitted patients on you</caption>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Gender</th>
                        <th>Disease</th>
                        <th>Room No.</th>
                        <th>Room Type</th>
                        <th>Admitted on</th>
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                        <td><?php echo $data2['first_name']." ".$data2['last_name'];?></td>
                        <td><?php $diff = date_diff(date_create($data2['dob']), date_create(date("Y-m-d")));
                echo $diff->format('%y')+1; ?></td>
                        <td><?php echo $data2['gender'];?></td>
                        <td><?php echo $data2['diss_name'];?></td>
                        <td><?php echo $data2['room'];?></td>
                        <td><?php echo $data2['room_type'];?></td>
                        <td><?php echo $data2['admit_date'];?></td>
                    </tr>
                    <?php
                    }
                    
                    }

                    ?>
                </table>

                <?php 
                    if($count2>0)
                    echo "<hr>";
                    if($count>0){
    
                ?> 
                <table align="center">
                    <caption style="font-size:20px;font-weight:bold">Records of Visits</caption>
                    <tr>
                        <th>Visit ID</th>
                        <th>Patient Name</th>
                        <th>Gender</th>
                        <th>Date</th>
                        <th>Desease</th>
                        <th>Suggestion</th>
                        
                    </tr>
                    <?php
                        while($data=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $data['visit_id'];?></td>
                        <td><?php echo $data['first_name']." ".$data['last_name'];?></td>
                        <td><?php echo $data['gender'];?></td>
                        <td><?php echo $data['visit_date'];?></td>
                        <td><?php echo $data['diss_name'];?></td>
                        <td><?php echo $data['suggestions'];?></td>
                    </tr>
                    <?php
                    }
                    }
                    ?>
                </table>
            </div>
            <div class="win2" style="width:376px">
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
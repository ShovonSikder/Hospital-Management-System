<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckpt']=="true"){
    $ptid=$_SESSION['pt_id'];

    
    $sql="SELECT * from visits where pt_id='$ptid' order by visit_date DESC";

    $result=mysqli_query($con,$sql);
    
    if($result){
       $count=mysqli_num_rows($result);
?>
<html>
    <head>
        <title>Dashboard visit</title>
        <link href="hospital.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div>
       <div id="menu" style="height: 610px;">
           <img src="patient.png" height="200"width="200">
<b><?php echo $_SESSION['name'];?><br>Welcome to the Hospital</b>
<a href="patientdashboard.php">
    <div class="menubtn" >
     Profile
    </div>
</a>
<a href="appointmentpatient.php">
    <div class="menubtn">
     Appointments
    </div></a>

<a href="visitpatient.php">
    <div class="menubtn" id="active">
         Visits info
    </div></a>
<a href="billpatient.php">
    <div class="menubtn">
        Bills info
    </div></a>

<a href="sessionkill.php">
    <div class="menubtn">
     Logout
    </div>
</a>
       </div>
      
       <div id="display" style="text-align: left;">
            <div class="win1">
                <div id="caption">Visits History</div>
                <?php
                if($count==0){
                ?>
                <div class="doclist">
                    <b style="font-size: larger;">You have no visit record yet. <a href="appointmentpatient.php">Make Appointments</a></b>
                </div>
                <?php
                }
                else{
                ?>
                <table align="center">
                    <tr>
                        <th>Visit ID</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Disease</th>
                        <th>Suggestions</th>
                        
                    </tr>
                    <?php
                        while($data=mysqli_fetch_array($result)){
                            $docid=$data['doc_id'];
                    ?>
                    <tr>
                        <td><?php echo $data['visit_id']?></td>
                        <td><?php 
                            $sql2="SELECT first_name,last_name from doctors where doc_id='$docid'";
                            $result2=mysqli_query($con,$sql2);
                            $data2=mysqli_fetch_array($result2);
                            echo $data2['first_name']." ".$data2['last_name'];
                        ?></td>
                        <td><?php echo $data['visit_date']?></td>
                        <td><?php echo $data['diss_name']?></td>
                        <td><?php echo $data['suggestions']?></td>
                        
                    </tr>
                    <?php
                        }?>
                   </table>
                   <div class="doclist" style="margin-top:10px">
                    <b style="font-size: larger;"><?php echo "Your Total Visits: ".$count;?></b>
                </div>
                        <?php
                    }
                    ?>
                
                
                
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
header("Location:patientlogin.php");
?>
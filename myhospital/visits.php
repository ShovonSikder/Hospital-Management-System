<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){

?>
<html>
    <head>
        <title>Dashboard visits</title>
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
    <div class="menubtn"id="active">
     Visits Info.
    </div>
</a>
<a href="patientlist.php">
    <div class="menubtn">
     Patient Info.
    </div>
</a>
<a href="disease.php">
    <div class="menubtn">
     Rooms Info.
    </div>
</a>
<a href="">
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
                All Visits Info.
                 </div>
                 <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                 
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(visit_id) as c from visits"));
                    if($data3['c']>0)
                    echo "Total Visits: <b style=\"color:brown;font-size:20px\">".$data3['c']."</b>";
                    else
                    echo "No Visit records";
                  ?> 
                 
                </div> 
                
                <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                    $date=date("Y-m-d");
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(visit_id) as c from visits where visit_date='$date'"));
                    if($data3['c']>0)
                    echo "Total Visits today: <b style=\"color:brown;font-size:20px\">".$data3['c']."</b>";
                    else
                    echo "No Visit today";
                  ?> 
                 
                </div> 
               
                <hr>

                
                 <br><br>
                <?php
               $sql = "SELECT visit_id,patients.first_name as pfname,patients.last_name as plname,doctors.first_name as dfname,doctors.last_name as dlname,visit_date,diss_name,suggestions\n"

               . "FROM visits INNER JOIN patients ON patients.pt_id=visits.pt_id INNER JOIN doctors ON visits.doc_id=doctors.doc_id order by visit_date DESC";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">All Visits</caption>
                    <tr>
                        <th>Visit_id</th>
                        <th>Patient Name</th>
                        <th>Doctor Name</th>
                        <th>Date</th>
                        <th>Disease</th>
                        <th>Suggestions</th>
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $data2['visit_id'];?></td>
                        <td><?php echo $data2['pfname']." ".$data2['plname'];?></td>
                        <td><?php echo $data2['dfname']." ".$data2['dlname'];?></td>
                        
                        <td><?php echo $data2['visit_date'];?></td>
                        <td><?php echo $data2['diss_name']?></td>
                        <td><?php echo $data2['suggestions'];?></td>
                        
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
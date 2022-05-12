<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
if(@$_GET['id']=="pay"){
    $billno=$_GET['billno'];
    $date=date("Y-m-d");
    mysqli_query($con,"UPDATE bills set statuss='Paid',paid_date='$date' where bill_no='$billno'");
    header("Location:bills.php");
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
    <div class="menubtn"id="active">
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
                All Bills Info.
                 </div>
                 <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                 
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(bill_no) as c from bills where statuss='Due'"));
                    if($data3['c']>0)
                    echo "Total Due Bills: <b style=\"color:brown;font-size:20px\">".$data3['c']."</b>";
                    else
                    echo "No Due Bills";
                  ?> 
                 
                </div> 
                
                <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                 
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT sum(amount) as c from bills where statuss='Paid'"));
                    
                    echo "Balance: <b style=\"color:green;font-size:20px\">".$data3['c']." tk</b>";
                  ?> 
                 
                </div>
                <div class="doclist"style="font-weight:bold;display:inline-block;">
                  <?php
                 
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT sum(amount) as c from bills where statuss='Due'"));
                    
                    echo "Due Balance: <b style=\"color:red;font-size:20px\">".$data3['c']." tk</b>";
                  ?> 
                 
                </div>
                <hr>

                
                 <br><br>
                <?php
                $sql="SELECT * from bills order by statuss";
                $result2=mysqli_query($con,$sql);
                $count=mysqli_num_rows($result2);

                if($count>0){
                ?>
                 <table align="center">
                    <caption style="font-size:20px;font-weight:bold">All Bills</caption>
                    <tr>
                        <th>Bill No.</th>
                        <th>Bill Name</th>
                        <th>Pt_ID</th>
                        <th>Amount</th>
                        <th>Date</th>
                        <th>Status</th>

                        <th>Action</th>
                        
                        
                    </tr>
                    <?php
                        while($data2=mysqli_fetch_array($result2)){
                    ?>
                    <tr>
                    <td><?php echo $data2['bill_no'];?></td>
                        <td><?php echo $data2['cause'];?></td>
                        
                        
                        <td><?php echo $data2['pt_id'];?></td>
                        <td><?php echo $data2['amount']." tk"?></td>
                        <td><?php echo $data2['paid_date'];?></td>
                        <?php if($data2['statuss']=="Due"){ ?>
                        <td style="font-weight:bold;color:red;"><?php 
                        echo $data2['statuss'];
                        ?></td>
                        <td><a href="bills.php?id=pay&billno=<?php echo $data2['bill_no'];?>">Pay Now</a> </td>
                        <?php } 
                        else
                        {
                        ?>
                        <td style="font-weight:bold;color:green;"><?php 
                        echo $data2['statuss'];
                        ?></td>
                        <td>Accepted</td>
                        
                        <?php } ?>
                        
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
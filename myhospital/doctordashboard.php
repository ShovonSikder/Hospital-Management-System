<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckdoc']=="true"){
    $docid=$_SESSION['docid'];
    $sql="select first_name,last_name,address,dob,gender,phone,gmail from doctors where doc_id='$docid'";
   
    $result=mysqli_query($con,$sql);
    if($result){
        $data=mysqli_fetch_array($result);
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
    <div class="menubtn" id="active">
     Profile
    </div>
</a>
<a href="appointmentdoctor.php">
    <div class="menubtn">
     Appoinments
    </div></a>

<a href="doctorserve.php">
    <div class="menubtn">
         Serve info
    </div></a>
<a href="sessionkill.php">
    <div class="menubtn">
     Logout
    </div>
</a>
       </div>
      
       <div id="display"style="width:1130px;height: 620px;text-align: left;">
           <div class="win1">
        <div class="form2">
            <div id="caption"><?php echo "$data[first_name]'s Info."?></div>

          <div class="frmlable2">
              <span>Doctor ID:</span>
          <span>Doctor Name:</span><span>Address:</span><span>Doctor Age:</span>
          <span>Gender:</span><span>Phone:</span><span>Gmail:</span>Specialist@:
          </div>
          <div class="frmfield" >
              <!--Form here-->

            <form >
                <input type="text" name="doc_id" value="<?php echo "$_SESSION[docid]"?>"  disabled><br><br>
                <input id="fname"type="text" name="f_name" value="<?php echo "$data[first_name]"?>" placeholder="First Name" disabled>
                <input id="fname"type="text" name="l_name" value="<?php echo "$data[last_name]"?>" placeholder="Last Name" disabled><br><br>
                <input type="text" name="addrs" value="<?php echo "$data[address]"?>" placeholder="Address" disabled><br><br>
                <input type="text" name="age" value="<?php            
                $diff = date_diff(date_create($data['dob']), date_create(date("Y-m-d")));
                echo $diff->format('%y')+1;
                ?>" disabled><br><br>
                <input type="text" name="phone" value="<?php echo "$data[gender]"?>"  placeholder="Gender" disabled>
                <br><br>

                <input type="text" name="phone" value="<?php echo "$data[phone]"?>"  placeholder="Phone" disabled><br><br>
                <input type="text" name="gmail" value="<?php echo "$data[gmail]"?>"  placeholder="Email address"  disabled><br><br>
                <input type="text" name="expt" value="<?php 
                $sql2="SELECT diss_name from dissexprt where doc_id='$docid'";
                $result=mysqli_query($con,$sql2);
                $row=mysqli_num_rows($result);
                if($row>0)
                {
                    while($data2=mysqli_fetch_array($result))
                        echo $data2['diss_name'].", ";
                }
                else
                 echo "Undefined";
                ?>"  placeholder="Expert in"  disabled>    
          </div>
         
        </form>
            </div></div>
            <div class="win2">
                <div id="caption">
               Overview
                </div>
                
                <div class="doclist"style="font-weight:bold">
                  <?php
                  $date=date("Y-m-d");
                    $data3=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from appointments where doc_id='$docid' and ap_date='$date'"));
                    if($data3['c']>0)
                    echo "You have <b style=\"color:brown;font-size:20px\">".$data3['c']."</b> appointments today";
                    else
                    echo "You have no appointment today!!!";
                  ?> 
                 
                </div>       
                <div class="doclist"style="font-weight:bold">
                  <?php
                    $data4=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from appointments where doc_id='$docid' "));
                    if($data4['c']>0)
                    echo "You have total <b style=\"color:brown;font-size:20px\">".$data4['c']."</b> appointments";
                    else
                    echo "You have no appointment yet!!!";
                ?> 
                </div>     
                <div class="doclist"style="font-weight:bold">
                  <?php
                    $data5=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from visits where doc_id='$docid' and visit_date='$date'"));
                    if($data5['c']>0)
                    echo "Total serves Today <b style=\"color:brown;font-size:20px\">".$data5['c']."</b> patients";
                    else
                    echo "You didn't serve yet today!!!";
                  ?>        
                </div> 
                <div class="doclist"style="font-weight:bold">
                  <?php
                    $data5=mysqli_fetch_array(mysqli_query($con,"SELECT count(doc_id) as c from visits where doc_id='$docid'"));
                    if($data5['c']>0)
                    echo "Total served <b style=\"color:brown;font-size:20px\">".$data5['c']."</b> patients";
                    else
                    echo "You didn't serve any patients yet!!!";
                  ?>        
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
<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckpt']=="true"){
    $ptid=$_SESSION['pt_id'];
    $sql="select first_name,last_name,address,dob,gender,phone,gmail from patients where pt_id='$ptid'";
    $sql2="select room_no from admits where pt_id='$ptid'";
    $result=mysqli_query($con,$sql);
    if($result){
        $result2=mysqli_query($con,$sql2);
        $data=mysqli_fetch_array($result);
        $admit="Not Admitted";
        $data2=mysqli_fetch_array($result2);
        if(@$data2['room_no']!=null)
        $admit=$data2['room_no'];
        
?>
<html>
    <head>
        <title>Dashboard</title>
        <link href="hospital.css" rel="stylesheet" type="text/css">
    </head>
    <body>
        <div id="workplace">
       <div id="menu">
           <img src="patient.png" height="200"width="200">
<b><?php echo $_SESSION['name']=$data['first_name']." ".$data['last_name'];?><br>Welcome to the Hospital</b>
<a href="patientdashboard.php">
    <div class="menubtn" id="active">
     Profile
    </div>
</a>
<a href="appointmentpatient.php">
    <div class="menubtn">
     Appoinments
    </div></a>

<a href="visitpatient.php">
    <div class="menubtn">
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
      
       <div id="display"style="text-align: left;">
           <div class="win1">
        <div class="form2">
            <div id="caption"><?php echo "$data[first_name]'s Info."?></div>

          <div class="frmlable2">
              <span>Patient ID:</span>
          <span>Patient Name:</span><span>Address:</span><span>Patient Age:</span>
          <span>Gender:</span><span>Phone:</span><span>Gmail:</span>Admit@Room:
          </div>
          <div class="frmfield" >
              <!--Form here-->

            <form >
                <input type="text" name="pt_id" value="<?php echo "$_SESSION[pt_id]"?>"  disabled><br><br>
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
                <input type="text" name="admit" value="<?php echo "$admit"?>"  placeholder="Not admitted" disabled>
                
          </div>
         
        </form>
            </div></div>
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
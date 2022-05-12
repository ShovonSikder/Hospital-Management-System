<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
    if(@$_GET['id']=="bill")
    {
        $_SESSION['ptid']=$_GET['ptid'];
    }
    $ptid=$_SESSION['ptid'];
    $sql1="SELECT admits.pt_id,first_name,last_name,dob,phone,gmail,admits.room_no,admit_date,cost_day
    FROM admits NATURAL JOIN patients NATURAL JOIN rooms 
    WHERE admits.pt_id='$ptid'";
    $result1=mysqli_query($con,$sql1);
    $data=mysqli_fetch_array($result1);
    
?>
<html>
    <head>
        <title>Make bill</title>
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
    <div class="menubtn"id="active">
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
      
       <div id="display" style="text-align: left;">
          <div class="win1" style="text-align: left;">
            
          <div id="errorbox" ><center>Bill making failed.
            <button onclick="none()">X</button></center>
        </div>
        <div class="form2">
            <div id="caption">Bills</div>
          <div class="frmlable">
              Patient ID:
              <span>Name:</span>
              <span>Age:</span>
              <span>Contact:</span>
              <span>Admitted@:</span>
              <span>Days:</span>
              <span>Amount Tk:</span>
              <span>Bill Name:</span>
          </div>
          <div class="frmfield">
              <!--Form here-->
            <form action="makebill.php" method="post">
                <input type="text" name="ptid"value="<?php echo $_SESSION['ptid']?>"  readonly required style="border:none;background-color: rgb(189, 189, 238);"><br><br>
                <input id="fname"type="text"  value="<?php echo $data['first_name'];?>"diabled style="width:100px;border:none;background-color: rgb(189, 189, 238);">
                <input id="fname"type="text"  value="<?php echo $data['last_name'];?>" disabled style="border:none;background-color: rgb(189, 189, 238);"><br><br>
                <input type="text" value="<?php 
                $diff = date_diff(date_create($data['dob']), date_create(date("Y-m-d")));
                echo $diff->format('%y')+1;
                ?>"  disabled style="margin-top:-5px;border:none;background-color: rgb(189, 189, 238);"><br><br>
                <input type="text" value="<?php echo "Phone: ".$data['phone']." Gmail: ".$data['gmail'];?>"  disabled style="border:none;background-color: rgb(189, 189, 238);"><br><br>
                <input type="text" value="<?php echo $data['room_no'];?>"  disabled style="margin-top:-2px;border:none;background-color: rgb(189, 189, 238);"><br><br>
                <input type="text" value="<?php 
                $diff = date_diff(date_create($data['admit_date']), date_create(date("Y-m-d")));
                echo $diff->format('%a')+1;
                echo "  From: ".$data['admit_date']." to ".date("Y-m-d");

               ?>"  disabled style="margin-top:-2px;border:none;background-color: rgb(189, 189, 238);"><br><br>
                <input type="text" name="amount" value="<?php 
                    $diff = date_diff(date_create($data['admit_date']), date_create(date("Y-m-d")));
                    echo ($diff->format('%a')+1)*$data['cost_day'] ;
                ?>"  readonly required style="margin-top:-2px;border:none;background-color: rgb(189, 189, 238);"><br><br>

                <input type="text" name="cos"value=""  placeholder="Bill's Cause" required >





                
          </div>
         <div id="btn"> <button type="submit" name="sbtn">Pay Now</button>
         <button type="submit" name="sbtn2">Pay Later</button>
         </div>
        </form></div>   
                 
          </div>
        
      
       </div> 
 </div>
    </body>
    <span id="footer">&copy Footer</span>

    <script>
        function none(){
            document.getElementById("errorbox").setAttribute("style","display:none;");
        }</script>
</html>
<?php
if(isset($_POST['sbtn'])||isset($_POST['sbtn2'])){
    $ptid=$_POST['ptid'];
    $date=date("Y-m-d");
    
    $amount=$_POST['amount'];
    $cos=$_POST['cos'];
    if(isset($_POST['sbtn']))
    $sql="INSERT INTO `bills`( `pt_id`, `amount`, `paid_date`, `statuss`, `cause`) VALUES ('$ptid','$amount','$date','Paid','$cos')";
    elseif(isset($_POST['sbtn2']))
    $sql="INSERT INTO `bills`( `pt_id`, `amount`, `paid_date`, `cause`) VALUES ('$ptid','$amount','$date','$cos')";

    $result=mysqli_query($con,$sql);
    if($result){
        mysqli_query($con,"DELETE from admits where pt_id='$ptid'");
        unset($_SESSION['ptid']);
    header("Location:admitted.php");
    }
    else{

        ?>
        <script>
document.getElementById("errorbox").setAttribute("style","display:block");
</script>
    <?php
    }

}
}
else
header("Location:adminlogin.php");
?>
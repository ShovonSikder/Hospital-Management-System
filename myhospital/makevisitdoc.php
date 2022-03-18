<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckdoc']=="true"){
    $docid=$_SESSION['docid'];

    //add data
    $ptid="";
if(@$_GET['id']=="vis")
{
    $ptid=$_GET['ptid'];
   $_SESSION['del']="true";
    
}


?>
<html>
    <head>
        <title>Make visit</title>
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
      
       <div id="display"style="width:1130px;height: 620px;text-align: left;">
           <div class="win1">

           <div id="errorbox" ><center>Insertion failed. Enter valid Patient ID
            <button onclick="none()">X</button></center>
        </div>
        <div class="form">
            <div id="caption">Add to Visit</div>
          <div class="frmlable">
              Patient ID:
              <span>Disease:</span>
              <span>Suggestions:</span>
          </div>
          <div class="frmfield">
              <!--Form here-->
            <form action="makevisitdoc.php" method="post">
                <input type="text" name="ptid"value="<?php echo $ptid;?>" placeholder="Enter valid patient id" required><br><br>
                <select name="diss" required>
                <?php
                $result=mysqli_query($con,"SELECT diss_name from dissexprt where doc_id='$docid'");
                    while($data=mysqli_fetch_array($result)){
                ?>
                <option value="<?php echo $data['diss_name'];?>"><?php echo $data['diss_name'];?></option>
                <?php } ?>
                </select><br><br>
                <input type="text" name="sug"value=" " placeholder="Add suggestions" >
               
          </div>
         <div id="btn"> <button type="submit" name="sbtn">Add Visit</button></div>
        </form></div>

            
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
    <script>
        function none(){
            document.getElementById("errorbox").setAttribute("style","display:none;");
        }</script>
</html>
<?php
    if(isset($_POST['sbtn'])){
        $ptid=$_POST['ptid'];
        $date=date("Y-m-d");
        $diss=$_POST['diss'];
        $sug=$_POST['sug'];
        $sql="INSERT INTO `visits`(`pt_id`, `doc_id`, `visit_date`, `diss_name`, `suggestions`) VALUES ('$ptid','$docid','$date','$diss','$sug')";
        $result=mysqli_query($con,$sql);
        if($result){
            if($_SESSION['del']=="true"){
            $sql="delete from appointments where pt_id='$ptid' and doc_id='$docid'";
             mysqli_query($con,$sql);
             $_SESSION['del']="false";
            }
        header("Location:appointmentdoctor.php");
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
header("Location:doctorlogin.php");
?>
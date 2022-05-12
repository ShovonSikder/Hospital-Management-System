<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckadmin']=="true"){
    
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
            
          <div id="errorbox" ><center>Insertion failed. Patient may admitted before
            <button onclick="none()">X</button></center>
        </div>
        <div class="form">
            <div id="caption">Add to Admits</div>
          <div class="frmlable">
              Patient ID:
              <span>Room NO.:</span>
              <span>Doctor:</span>
              <span>Disease:</span>
          </div>
          <div class="frmfield">
              <!--Form here-->
            <form action="newadmit.php" method="post">
                <input type="text" name="ptid"value="" placeholder="Enter valid patient id" required><br><br>
                <select name="roomno" required>
                <?php
                $sqlroom="SELECT  rooms.room_no
                FROM rooms
                WHERE room_no NOT in(
                SELECT rooms.room_no FROM rooms INNER join (SELECT admits.room_no as r, COUNT(admits.room_no) as c FROM admits GROUP by room_no) tt ON tt.r=rooms.room_no
                WHERE rooms.capacity<=tt.c) AND rooms.capacity>0";
                $result=mysqli_query($con,$sqlroom);
                    while($data=mysqli_fetch_array($result)){
                ?>
                <option value="<?php echo $data['room_no'];?>"><?php echo $data['room_no'];?></option>
                <?php } ?>
                </select><br><br>
                <select name="doc" required>
                <?php
                $result2=mysqli_query($con,"SELECT Distinct doc_id from dissexprt ");
                    while($data=mysqli_fetch_array($result2)){
                ?>
                <option value="<?php echo $data['doc_id'];?>"><?php echo $data['doc_id'];?></option>
                <?php } ?>
                </select><br><br>
                <select name="diss" required>
                <?php
                $result3=mysqli_query($con,"SELECT distinct diss_name from dissexprt");
                    while($data=mysqli_fetch_array($result3)){
                ?>
                <option value="<?php echo $data['diss_name'];?>"><?php echo $data['diss_name'];?></option>
                <?php } ?>
                </select>
                
               
          </div>
         <div id="btn"> <button type="submit" name="sbtn">Admit</button></div>
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
if(isset($_POST['sbtn'])){
    $ptid=$_POST['ptid'];
    $date=date("Y-m-d");
    $room=$_POST['roomno'];
    $diss=$_POST['diss'];
    $doc=$_POST['doc'];
    $sql="INSERT INTO admits VALUES ('$ptid','$room','$date','$doc','$diss')";
    $result=mysqli_query($con,$sql);
    if($result){
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
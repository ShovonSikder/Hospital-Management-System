<!--Doctor login verify page-->
<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
?>
<html>
    <head>
        <title>Login Doctor</title>
        <link href="hospital.css" rel="stylesheet" type="text/css">
        
    </head>
    <body>
        <div id="workplace">
       <div id="menu">
           <img src="firstaid.png" height="200"width="200">
<b>Welcome to the Hospital</b>
<a href="sessionkill.php">
    <div class="menubtn">
     Home
    </div>
</a>
       </div>
      
       <div id="display"style="text-align: left;">
           <div class="win1">
        <div id="errorbox" ><center>Invalid gmail or password
            <button onclick="none()">X</button></center>
        </div>
        <div class="form">
            <div id="caption">Doctors Login</div>
          <div class="frmlable">
              Gmail:
              <span>Password:</span>
          </div>
          <div class="frmfield">
              <!--Form here-->
            <form action="doctorlogin.php" method="post">
                <input type="gmail" name="gmail"value="" placeholder="Enter your gmail" required><br><br>
                <input type="password" name="pass"value="" placeholder="Enter your password" required>
          </div>
         <div id="btn"> <button type="submit" name="sbtn">Login</button></div>
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
    </body>
    <span id="footer">&copy Footer</span>
    <script>
        function none(){
            document.getElementById("errorbox").setAttribute("style","display:none;");
        }</script>
</html>
<!--PHP codes-->

<?php

if(isset($_POST['sbtn'])){
    $gmail=$_POST['gmail'];
    $pass=$_POST['pass'];
    $sql="select doc_id,first_name,last_name from doctors where gmail='$gmail' and password='$pass'";
    $result=mysqli_query($con,$sql);
    if($result){
    $count=mysqli_num_rows($result);
    if($count==1){
        $data=mysqli_fetch_array($result);
        $_SESSION['ckdoc']="true";
        $_SESSION['docid']=$data['doc_id'];
        $_SESSION['name']=$data['first_name']." ".$data['last_name'];
        header("Location:doctordashboard.php");
    }
    else
    {?>
<script>
    document.getElementById("errorbox").setAttribute("style","display:block");
    </script>
<?php
}
    }
else
echo "query result error";

}
?>
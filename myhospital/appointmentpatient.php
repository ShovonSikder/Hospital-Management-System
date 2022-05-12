<?php
session_start();
@$con=mysqli_connect("localhost","root","","hospital");
if(!$con)
die("Database connection failed");
if($_SESSION['ckpt']=="true"){
    $ptid=$_SESSION['pt_id'];
//delete data
if(@$_GET['id']=='del')
{
    $docid=$_GET['docid'];
    $sql="delete from appointments where pt_id='$ptid' and doc_id='$docid'";
    mysqli_query($con,$sql);
    header("Location:appointmentpatient.php");
}
//make appointment
if(isset($_GET['apdoc']))
{
    $docid=$_GET['apdoc'];
    $date=$_GET['apdate'];
    $sql="insert into appointments values('$ptid','$docid','$date')";
    mysqli_query($con,$sql);
    header("Location:appointmentpatient.php");
}

    
    $sql="SELECT doctors.doc_id as docid,first_name,last_name,gender,phone,gmail,ap_date FROM doctors,appointments WHERE doctors.doc_id=appointments.doc_id AND appointments.pt_id='$ptid' ORDER BY ap_date DESC";
    $sql2="SELECT doc_id,first_name,last_name FROM doctors WHERE doc_id NOT IN
        (SELECT doc_id FROM appointments WHERE pt_id='$ptid')";

        //filter sql here
        if(isset($_GET['sbtn']))
        {
            $search=$_GET['search'];
            $sql2="SELECT doc_id,first_name,last_name FROM doctors WHERE doc_id NOT IN
            (SELECT doc_id FROM appointments WHERE pt_id='$ptid') AND doc_id IN
                ( select doc_id from dissexprt where diss_name IN
                 ( SELECT diss_name
                         FROM diseases
                         WHERE diss_name like '%$search%' OR diss_details LIKE '%$search%'
                     ))";
        }
    
    $result=mysqli_query($con,$sql);
    $result2=mysqli_query($con,$sql2);
    if($result || $result2){
       $count=mysqli_num_rows($result);
       $count2=mysqli_num_rows($result2);
    
?>
<html>
    <head>
        <title>Dashboard appointments</title>
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
    <div class="menubtn"id="active">
     Appointments
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
      
       <div id="display" style="text-align: left;">
            <div class="win1">
                <div id="caption">My Appointments</div>
                <?php
                if($count==0){
                ?>
                <div class="doclist">
                    <b style="font-size: larger;">You have no Appointments</b>
                </div>
                <?php
                }
                else{
                ?>
                <table align="center">
                    <tr>
                        <th>Doctor Name</th>
                        <th>Gender</th>
                        <th>Contact</th>
                        <th>App. Date</th>
                        <th>Action</th>
                    </tr>
                    <?php
                        while($data=mysqli_fetch_array($result)){
                    ?>
                    <tr>
                        <td><?php echo $data['first_name']." ".$data['last_name'];?></td>
                        <td><?php echo $data['gender'];?></td>
                        <td>Phone: <?php echo $data['phone'];?><br>Mail: <?php echo $data['gmail'];?></td>
                        <td><?php echo $data['ap_date'];?></td>
                        <td><a href="appointmentpatient.php?id=del&docid=<?php echo $data['docid'];?>">Delete</a></td>
                    </tr>
                    <?php
                        }
                    }
                    ?>
                </table>
                
                
            </div>
            <div class="win2">
                <div id="caption" style="text-align: left;padding: 5px 0px 1px 10px;height: 69px;">
                <form action="appointmentpatient.php">
                    <input type="text"name="search" placeholder="Search by dsease name">
                    <input type="submit" name="sbtn" value="Filter">
                    <br>Available Doctors
                </form>
                </div>
                <?php
                    if($count2==0){
                ?>
                <div class="doclist">
                    <b style="font-size: larger;">No Doctor Available</b>
                </div>
                <?php
                }
                else{
                    while($data2=mysqli_fetch_array($result2)){
                ?>
                <div class="doclist">
                   <div style="display:inline-block;width:350px"> <b style="font-size: larger;"><?php echo $data2['first_name']." ".$data2['last_name'];?></b><br>
                    <?php
                    $did=$data2['doc_id'];
                    $sql3="select diss_name from dissexprt where doc_id='$did'";
                    
                        $result3=mysqli_query($con,$sql3);
                        echo "Expert in: ";
                        while($data3=mysqli_fetch_array($result3)){
                            echo $data3['diss_name'].", ";
                        }
                    ?></div>
                    <form  acttion="appointmentpatient.php">
                        <div class="apt"><input  type="date" name="apdate" required>
                        <button type="submit" name="apdoc" value="<?php echo $did;?>">Make an Appointment</button>
                    </div>
                    </form>
                </div>
               <?php
               }
            }
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
header("Location:patientlogin.php");
?>
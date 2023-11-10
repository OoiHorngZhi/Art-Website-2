<?php
//including the database connection file
include("config.php");

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

$result = mysqli_query($mysqli, "SELECT * FROM timer ORDER BY id DESC");
while($res = mysqli_fetch_array($result)) { 
$date = $res['date'];
$h = $res['h'];
$m = $res['m'];
$s = $res['s'];
}
?>

<?php
 include_once("config.php");

if(isset($_POST['update']))
{	
$date=$_POST['date'];
$h= $_POST['h'];
$m= $_POST['m'];
$s= $_POST['s'];
		//updating the table
$result = mysqli_query($mysqli, "UPDATE timer SET date='$date' WHERE id=1");
$result = mysqli_query($mysqli, " UPDATE timer SET h='$h' WHERE id=1");
$result = mysqli_query($mysqli, "UPDATE timer SET m='$m' WHERE id=1");
$result = mysqli_query($mysqli, "UPDATE timer SET s='$s' WHERE id=1");	
//redirectig to the display page. In our case, 
//echo "Timer Updated";
}
?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Countdown Timer
                        
                    </h3>
                </div>
                <div class="card-body">

                   <div class="col-md-3 mb-4">
                       <div class="card card-body p-3">
                           <p class="text-sm mb-0 text-capitalize font-weight-bold" id="demo"></p>
                       </div>
                </div>
                    
                           <p class="text-sm mb-0 text-capitalize font-weight-bold">
                               <form method="POST" action="#">
                                  <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Date</label>
                                                <input type="date" name="date" value="<?php echo $date;?>">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Hour</label>
                                                <input type="number" name="h" value="<?php echo $h;?>">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Minute</label>
                                                <input type="number" name="m" value="<?php echo $m;?>">
                                            </div>
                                        </div>
                                      
                                      <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Second</label>
                                                <input type="number" name="s" value="<?php echo $s;?>">
                                            </div>
                                        </div>
                            
                                         
                                        <div class="col-md-6">
                                            <div class="mb-3 text-end">
                                                <br/>
                                                <button type="submit" name="update" class="btn btn-success btn-sm">Update</button>
                                            </div>
                                        </div>  
                                    </div>
                           </form>
                           </p>
                       
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>



<script>
 var countDownDate = <?php 
echo strtotime("$date $h:$m:$s" ) ?> * 1000;
var now = <?php echo time() ?> * 1000;

// Update the count down every 1 second
var x = setInterval(function() {
now = now + 1000;
// Find the distance between now an the count down date
var distance = countDownDate - now;
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
// Output the result in an element with id="demo"
document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
minutes + "m " + seconds + "s ";
// If the count down is over, write some text 
if (distance < 0) {
clearInterval(x);
 document.getElementById("demo").innerHTML = "EXPIRED";
}
    
}, 1000);

    </script>
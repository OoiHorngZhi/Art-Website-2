<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        All Messages
                        
                    </h3>
                </div>
                <div class="card-body">

                    
                    <table class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Number</th>
                                <th>Message</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            $select_messages = $conn->prepare("SELECT * FROM `timer`");
                            $select_messages->execute();
                            if($select_messages->rowCount() > 0){
                                while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                        <tr>
                                            <td><?= $fetch_message['id']; ?></td>
                                            <td><?= $fetch_message['date']; ?></td>
                                            <td><?= $fetch_message['h']; ?></td>
                                            <td><?= $fetch_message['m']; ?></td>
                                            <td><?= $fetch_message['s']; ?></td>
                                            <td>
                                                
                                                <a href="index.php?update=<?= $fetch_message['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <a href="users_accounts.php?delete=<?= $fetch_message['id']; ?>"
                                                   class="btn btn-danger btn-sm mx-2"
                                                   onclick="return confirm('delete this account? the user related information will also be delete!')"
                                                   >Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo '<div class= "alert alert-success">
                                <h4>No messages available</h4>
                                </div>';
                            }
                            ?>
                        
                        </tbody>
                        
                    </table>
                </div>
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
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `review_table` WHERE review_id = ?");
   $delete_message->execute([$delete_id]);
   header('location:bid_comment.php');
}

if(isset($_GET['delete_all'])){
  
   $delete_table = $conn->prepare("TRUNCATE TABLE review_table");
   $delete_table->execute();
    
    if($delete_table !== FALSE)
    {
        echo'<div class= "alert alert-success">
                                <h4>All rows have been deleted</h4>
                                </div>';
    }
    else
    {
        echo'<div class= "alert alert-success">
                                <h4>No rows have been deleted</h4>
                                </div>';
    }
    
    header('location:bid_comment.php');
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        All Bid Comments
                       <a href="bid_comment.php?delete_all" class="btn btn-danger float-end" onclick="return confirm('confirm delete all data?')">Delete All</a>
            
                        <a href="countdown/countdown-timer.php" class="btn btn-success float-end">Change Countdown Timer</a>
                    </h3>
                </div>
                <div class="card-body">
                        
                    
                    <table class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                
                                <th>Name</th>
                                <th>Email</th>
                                <th>Review</th>
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            $select_messages = $conn->prepare("SELECT * FROM `review_table` ORDER BY review_id DESC");
                            $select_messages->execute();
                            if($select_messages->rowCount() > 0){
                                while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                        <tr>
                                            
                                            <td><?= $fetch_message['user_name']; ?></td>
                                            <td><?= $fetch_message['email']; ?></td>
                                            <td><?= $fetch_message['user_review']; ?></td>
                                            
                                            <td>
                                                
                                                <a href="bid_email.php?update=<?= $fetch_message['review_id']; ?>" class="btn btn-success btn-sm">Reply</a>
                                                <a href="bid_comment.php?delete=<?= $fetch_message['review_id']; ?>"
                                                   class="btn btn-danger btn-sm mx-2"
                                                   onclick="return confirm('delete this comment? ')"
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
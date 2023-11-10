<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_message = $conn->prepare("DELETE FROM `messages` WHERE id = ?");
   $delete_message->execute([$delete_id]);
   header('location:messages.php');
}

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
                            $select_messages = $conn->prepare("SELECT * FROM `messages`");
                            $select_messages->execute();
                            if($select_messages->rowCount() > 0){
                                while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                        <tr>
                                            <td><?= $fetch_message['id']; ?></td>
                                            <td><?= $fetch_message['name']; ?></td>
                                            <td><?= $fetch_message['email']; ?></td>
                                            <td><?= $fetch_message['number']; ?></td>
                                            <td><?= $fetch_message['message']; ?></td>
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
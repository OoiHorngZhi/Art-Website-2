<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $id = $_POST['id'];
}
?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Reply thorugh Email
                        <a href="messages.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    
                    
                    <form action="send.php" method="post">
                        
                                        
                                <?php
                       $message_id = $_GET['update'];
                    $select_messages = $conn->prepare("SELECT * FROM `messages` WHERE id = ?");
                        $select_messages->execute([$message_id]);
                        if($select_messages->rowCount() > 0){
                            while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                        
                                        <input type="hidden" name="id" value="<?= $fetch_message['id']; ?>">
                        
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?= $fetch_message['email']; ?>" required class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Subject</label>
                                            <input type="text" name="subject" value="" required class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Message</label>
                                            <textarea name="message" required class="form-control" value="" rows="10"></textarea>
                                        </div>
                                       
                                        
                        
                        
                        
                                        <div class="mb-3 text-end">
                                            <button type="submit" name="update" class="btn btn-primary">Send Email</button>
                                        </div>
                        
                        
                         <?php
                                    }
                                        }else{
                                        echo '<h5>no message found!<h5>';
                                    }
                                    ?>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

 

    
<?php include('includes/footer.php'); ?>

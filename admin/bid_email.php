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
                        Reply Winner thorugh Email
                        <a href="bid_comment.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    
                    
                    <form action="bid_send.php" method="post">
                        
                                        
                                <?php
                       $message_id = $_GET['update'];
                    $select_messages = $conn->prepare("SELECT * FROM `review_table` WHERE review_id = ?");
                        $select_messages->execute([$message_id]);
                        if($select_messages->rowCount() > 0){
                            while($fetch_message = $select_messages->fetch(PDO::FETCH_ASSOC)){
                            ?>
                        
                                        <input type="hidden" name="review_id" value="<?= $fetch_message['review_id']; ?>">
                        
                                        <div class="mb-3">
                                            <label>Email</label>
                                            <input type="email" name="email" value="<?= $fetch_message['email']; ?>" required class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Subject</label>
                                            <input type="text" name="subject" value="Winner of the current auction product" required class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Message</label>
                                            <textarea name="message" required class="form-control" value="" rows="10">Congratulations Mr/Mrs <?= $fetch_message['user_name']; ?> in being the winner of the current bidding section, please reply the current email in the next 24 hours to confirm the transcaction method and discuss transfer process. Failure to do so will result in canclled bidding process. </textarea>
                                        </div>
                                       
                                        
                        
                        
                        
                                        <div class="mb-3 text-end">
                                            <button type="submit" name="update" class="btn btn-primary">Send Email</button>
                                        </div>
                        
                        
                         <?php
                                    }
                                        }else{
                                        echo '<h5>no email found!<h5>';
                                    }
                                    ?>
                        
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

 

    
<?php include('includes/footer.php'); ?>

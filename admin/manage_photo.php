<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_image = $conn->prepare("DELETE FROM `user_photo` WHERE id = ?");
   $delete_image->execute([$delete_id]);
    $fetch_delete_image = $delete_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   
   header('location:manage_photo.php');
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        User photos
                        
                    </h3>
                </div>
                <div class="card-body">

                    
                    <table class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Details</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            $select_accounts = $conn->prepare("SELECT * FROM `user_photo`");
                            $select_accounts->execute();
                            if($select_accounts->rowCount() > 0){
                                while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
                            ?>
                                        <tr>
                                            <td><?= $fetch_accounts['id']; ?></td>
                                            <td><?= $fetch_accounts['name']; ?></td>
                                            <td><?= $fetch_accounts['details']; ?></td>
                                            <td>
                                                <a href="manage_photo.php?delete=<?= $fetch_accounts['id']; ?>"
                                                   class="btn btn-danger btn-sm mx-2"
                                                   onclick="return confirm('delete this photo?')"
                                                   >Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo '<div class= "alert alert-success">
                                <h4>No accounts available</h4>
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
<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_admins = $conn->prepare("DELETE FROM `admins` WHERE id = ?");
   $delete_admins->execute([$delete_id]);
   header('location:admin_accounts.php');
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Admin Accounts
                        <a href="register_admin.php" class="btn btn-primary float-end">Add New Admin</a>
                    </h3>
                </div>
                <div class="card-body">

                    
                    <table class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            $select_accounts = $conn->prepare("SELECT * FROM `admins`");
                            $select_accounts->execute();
                            if($select_accounts->rowCount() > 0){
                                while($fetch_accounts = $select_accounts->fetch(PDO::FETCH_ASSOC)){   
                            ?>
                                        <tr>
                                            <td><?= $fetch_accounts['id']; ?></td>
                                            <td><?= $fetch_accounts['name']; ?></td>
                                            
                                            <td>
                                                <?php
                                    if($fetch_accounts['id'] == $admin_id){
                                        echo '<a href="update_profile.php" class="btn btn-success btn-sm">Edit</a>';
                                        
                                    
                                    }
                                                ?>
                                                <a href="admin_accounts.php?delete=<?= $fetch_accounts['id']; ?>" 
                                                   class="btn btn-danger btn-sm mx-2"
                                                   onclick="return confirm('Are you sure you want to delete this data?')"
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
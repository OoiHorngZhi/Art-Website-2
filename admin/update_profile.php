<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);

   $update_profile_name = $conn->prepare("UPDATE `admins` SET name = ? WHERE id = ?");
   $update_profile_name->execute([$name, $admin_id]);

   $empty_pass = 'da39a3ee5e6b4b0d3255bfef95601890afd80709';
   $prev_pass = $_POST['prev_pass'];
   $old_pass = sha1($_POST['old_pass']);
   $old_pass = filter_var($old_pass, FILTER_SANITIZE_STRING);
   $new_pass = sha1($_POST['new_pass']);
   $new_pass = filter_var($new_pass, FILTER_SANITIZE_STRING);
   $confirm_pass = sha1($_POST['confirm_pass']);
   $confirm_pass = filter_var($confirm_pass, FILTER_SANITIZE_STRING);

   if($old_pass == $empty_pass){
      $message[] = '<div class= "alert alert-success">
            <h4>please enter old password</h4>
            </div>';
   }elseif($old_pass != $prev_pass){
      $message[] = '<div class= "alert alert-success">
            <h4>old password not matched</h4>
            </div>';
   }elseif($new_pass != $confirm_pass){
      $message[] = '<div class= "alert alert-success">
            <h4>confirm password not match</h4>
            </div>';
   }else{
      if($new_pass != $empty_pass){
         $update_admin_pass = $conn->prepare("UPDATE `admins` SET password = ? WHERE id = ?");
         $update_admin_pass->execute([$confirm_pass, $admin_id]);
         $message[] = '<div class= "alert alert-success">
            <h4>password updated successfully</h4>
            </div>';
      }else{
         $message[] = '<div class= "alert alert-success">
            <h4>Please enter a new password</h4>
            </div>';
      }
   }
   
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Current Admin
                        <a href="admin_accounts.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    
                    
                    <form action="" method="post">
                        
                            <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
                        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Name</label>
                                                <input type="text" name="name" value="<?= $fetch_profile['name']; ?>" required class="form-control" 
                                                oninput="this.value = this.value.replace(/\s/g, '')">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Old Password</label>
                                                <input type="password" name="old_pass" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter New Password</label>
                                                <input type="password" name="new_pass" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Confirm New Password</label>
                                                <input type="password" name="confirm_pass" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>
                            
                                         
                                        <div class="col-md-6">
                                            <div class="mb-3 text-end">
                                                <br/>
                                                <button type="submit" name="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>  
                                    </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

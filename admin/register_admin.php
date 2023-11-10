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
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ?");
   $select_admin->execute([$name]);

   if($select_admin->rowCount() > 0){
      $message[] = 'username already exist!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_admin = $conn->prepare("INSERT INTO `admins`(name, password) VALUES(?,?)");
         $insert_admin->execute([$name, $cpass]);
         $message[] = 'new admin registered successfully!';
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
                        Register New Admin
                        <a href="admin_accounts.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    
                    
                    <form action="" method="post">
                        
                            <input type="hidden" name="prev_pass" value="<?= $fetch_profile['password']; ?>">
                        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Username</label>
                                                <input type="text" name="name"  required class="form-control" 
                                                oninput="this.value = this.value.replace(/\s/g, '')">
                                                
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Enter Password</label>
                                                <input type="password" name="pass" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Confirm Password</label>
                                                <input type="password" name="cpass" required class="form-control" oninput="this.value = this.value.replace(/\s/g, '')">
                                            </div>
                                        </div>
                            
                                         
                                        <div class="col-md-6">
                                            <div class="mb-3 text-end">
                                                <br/>
                                                <button type="submit" name="submit" class="btn btn-primary">Register</button>
                                            </div>
                                        </div>  
                                    </div>
                        
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

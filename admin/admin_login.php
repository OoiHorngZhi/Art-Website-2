<?php

include '../components/connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}

?>



<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="UTF-8">
    <title> Login and Registration Form </title>
    <link rel="stylesheet" href="../css/login_style.css">
    <!-- Fontawesome CDN Link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
   </head>
<body>
    
  <div class="container">
    <div class="cover">
      <div class="front">
        <img src="../images/backImg.jpg" alt="">
        <div class="text">
          <span class="text-1">Login as Admin</span>
          
        </div>
      </div>
    </div>
    <div class="forms">
        <div class="form-content">
          <div class="login-form">
            <div class="title">Admin Login</div>
              
              <?php
              if(isset($message)){
                  foreach($message as $message){
                      echo '
                      <div class="message">
                      <span class="error-msg">'.$message.'</span>
                      <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
                      </div>
                      ';
                  }
              }
              ?>

              
          <form action="#" method="post">
            <div class="input-boxes">
              <div class="input-box">
                <i class="fa fa-user-circle"></i>
                <input type="name" name="name" required placeholder="Enter your name" required oninput="this.value = this.value.replace(/\s/g, '')">
              </div>
              <div class="input-box">
                <i class="fas fa-lock"></i>
                <input type="password" name="pass" required placeholder="Enter your password" required oninput="this.value = this.value.replace(/\s/g, '')">
              </div>
              <div class="text"><a href="../user_login.php">Back to user login?</a></div>
              <div class="button input-box">
                <input type="submit" name="submit" value="Submit">
              </div>
              
            </div>
        </form>
      </div>
    </div>
    </div>
  </div>
</body>
</html>
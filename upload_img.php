<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';



 if(isset($_POST['add_art'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = 'uploaded_img/'.$image_01;
    
    


   $select_products = $conn->prepare("SELECT * FROM `user_photo` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = 'please change the name';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `user_photo`(user_id, name, details, image_01) VALUES(?,?,?,?)");
      $insert_products->execute([$user_id, $name, $details, $image_01]);

      if($insert_products){
         if($image_size_01 > 2000000 ){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
    
            $message[] = 'new art added';
         }

      }

   }  

}

if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `user_photo` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('uploaded_img/'.$fetch_delete_image['image_01']);
   $delete_product = $conn->prepare("DELETE FROM `user_photo` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   
   header('location:upload_img.php');
 }

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>user photos</title>
   
   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.css">

</head>
<body>
   
<?php include 'components/user_header.php'; ?>
    
    <div class="heading-title" style="background:url(images/heading-img-1.jpg) no-repeat">
        <h1>user photos</h1>
    </div>
    
    <section class="products">

   <h1 class="heading">all photos</h1>

   <div class="box-container">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `user_photo` WHERE user_id = ?"); 
     $select_products->execute([$user_id]);
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      
      
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
       <div class="flex">
         <div class="price"><span>Artists: </span><?= $fetch_product['details']; ?><span></span></div>
      </div>
      
       <a href="upload_img.php?delete=<?= $fetch_product['id']; ?>" 
        class="btn" onclick="return confirm('Are you sure you want to delete this data?')">Delete</a>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>

<section class="checkout-orders">

   <form action="" method="POST" enctype="multipart/form-data">

      <h3>upload your arts</h3>

      <div class="flex">
         <div class="inputBox">
            <span>name :</span>
            <input type="text" name="name" placeholder="enter your name" class="box" maxlength="20" required>
         </div>
          
           <div class="inputBox">
            <span>artist :</span>
            <input type="text" name="details" placeholder="enter artist name" class="box" maxlength="20" required>
         </div>
         
         <div class="inputBox">
            <span>your image :</span>
            <input type="file" name="image_01" placeholder="upload your photo" class="box" maxlength="50" required>
         </div>
         
      </div>

      <input type="submit" name="add_art" class="btn" value="upload art">

   </form>

</section>













<?php include 'components/footer.php'; ?>

<script src="js/script.js"></script>

</body>
</html>
<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>auction</title>
    
    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- css file link -->
    <link rel="stylesheet" href="css/style.css">
    
    
</head>
<body>
    
    <!-- header start -->
    
    <?php include 'components/user_header.php'; ?>
    <!-- header end -->
    
    <div class="heading-title" style="background:url(images/heading-img-1.jpg) no-repeat">
        <h1>auction</h1>
    </div>
    
    <!-- gallery section starts -->
    
     <section class="products">

   <h1 class="heading">auction products</h1>

   <div class="box-container">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `auction_table` WHERE `isActive` = 0"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="box">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      
      
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>Artists: </span><?= $fetch_product['artists']; ?><span></span></div>
      </div>
      <a href="quick_view_auction.php?pid=<?= $fetch_product['id']; ?>" class="btn">Know more</a>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products found!</p>';
   }
   ?>

   </div>

</section>

    <!-- gallery section ends -->
    

<section class="home-news">
        <div class="content">
            <h3>Here's the Timer for the next available product</h3>
            <p>To avoid confusion and ensure continous attraction, products will be shown one by one based on the timer given. Every product will be available for 24 hours </p>
            <a href="countdown.php" class="btn">show countdown</a>
        </div>
    </section>
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- footer section starts -->
  <?php include 'components/footer.php'; ?>
    
    <!-- footer section ends -->
    
    
    
    <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- js file link -->
    <script src="js/script.js"></script>
    

</body>
</html>
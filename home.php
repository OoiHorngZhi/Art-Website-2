<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

include 'components/wishlist_cart.php';

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    
    <!-- swiper css      link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- css file link -->
    <link rel="stylesheet" href="css/basic_style.css">
    
    
</head>
<body>
    
    <!-- header start -->
    
    <?php include 'components/user_header.php'; ?>
    
    <!-- header end -->
    
    <!-- home starts -->
    
    <section class="home">
        
        
    
        <div class="swiper home-slider">
        
            <div class="swiper-wrapper">
            
                <div class="swiper-slide slide" style="background:url(images/home-slide-1.jpg) no-repeat">
                    <div class="content">
                        <span>discover and obtain as your own</span>
                        <h3>arts gathered from various types of artstyle</h3>
                        <a href="shop.php" class="btn">discover more</a>
                    </div>
                </div>
                
                <div class="swiper-slide slide" style="background:url(images/home-slide-2.jpg) no-repeat">
                    <div class="content">
                        <span>discover and obtain as your own</span>
                        <h3>arts to fulfil your heartfelt desires</h3>
                        <a href="shop.php" class="btn">discover more</a>
                    </div>
                </div>
                
                <div class="swiper-slide slide" style="background:url(images/home-slide-3.jpg) no-repeat">
                    <div class="content">
                        <span>discover and obtain as your own</span>
                        <h3>supports and services to fulfill your needs and desires</h3>
                        <a href="shop.php" class="btn">discover more</a>
                    </div>
                </div>
                
            </div>
            
            <div class="swiper-button-next"></div>
            <div class="swiper-button-prev"></div>
        
        </div>
    
    </section>
    
    <!-- home end -->
    
    <!-- section starts -->
    
    <section class="services">
    
        <h1 class="heading-title"> our services </h1>
        
        <div class="box-container">
        
            <div class="box">
                <img src="images/icon-1.png" alt="">
                <h3>posting</h3>
            </div>
            
            <div class="box">
                <img src="images/icon-2.png" alt="">
                <h3>ecommerce</h3>
            </div>
            
            <div class="box">
                <img src="images/icon-3.png" alt="">
                <h3>auction</h3>
            </div>
            
            <div class="box">
                <img src="images/icon-4.png" alt="">
                <h3>communication</h3>
            </div>
        
        </div>
    
    </section>
    
    <!-- section end -->
    
    <!-- home about section end -->
    
    <section class="home-about">
    
        <div class="image">
            <img src="images/about-img.jpg" alt="">
        </div>
        
        <div class="content">
            <h3>about us</h3>
            <p>Welcome to Z.Art! We are an online art marketplace dedicated to bringing together artists and art enthusiasts in a seamless platform. Our mission is to make art accessible to all and helping art lovers discover and own beautiful artworks that resonate with their hearts and homes.</p>
            <a href="about.php" class="btn">read more</a>
        </div>
        
    </section>
    
    <!-- home about section end -->
    
    <!-- home gallery section end -->
    
    <section class="home-products">

   <h1 class="heading-title"> our gallery </h1>

   <div class="swiper products-slider">

   <div class="swiper-wrapper">

   <?php
     $select_products = $conn->prepare("SELECT * FROM `products` WHERE `isActive` = 0 LIMIT 6"); 
     $select_products->execute();
     if($select_products->rowCount() > 0){
      while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
   ?>
   <form action="" method="post" class="swiper-slide slide">
      <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
      <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
      <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
      <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
      
      
      <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">
      <div class="name"><?= $fetch_product['name']; ?></div>
      <div class="flex">
         <div class="price"><span>RM</span><?= $fetch_product['price']; ?><span>/-</span></div>
         
      </div>
      <a href="quick_view.php?pid=<?= $fetch_product['id']; ?>" class="btn">Know more</a>
   </form>
   <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

   </div>

   <div class="swiper-pagination"></div>

   </div>

</section>
    
    <!-- home gallery section end -->
    
    <!-- home special news section end -->
    
    
    <!-- home special news section end -->
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- footer section starts -->
    
   <?php include 'components/footer.php'; ?>
    
    <!-- footer section ends -->
    
    
    
    <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- js file link -->
    <script src="js/script.js"></script>
    <script src="assets/js/core/bootstrap.min.js"></script>
    
    <script>
    
        
var swiper = new Swiper(".products-slider", {
   loop:true,
   spaceBetween: 20,
   pagination: {
      el: ".swiper-pagination",
      clickable:true,
   },
   breakpoints: {
      550: {
        slidesPerView: 2,
      },
      768: {
        slidesPerView: 2,
      },
      1024: {
        slidesPerView: 3,
      },
   },
});

    
    </script>
    

</body>
</html>
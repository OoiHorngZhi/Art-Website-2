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
    
    <!-- home end -->
    
    <!-- section starts -->
    
    <section class="services">
    
        <h1 class="heading-title"> shop by category  </h1>
        
        <div class="box-container">
        
            <div class="box">
                <img src="images/painting1.png" alt="">
                <a href="category.php?category=painting" class="btn">paintings</a>
            </div>
            
            <div class="box">
                <img src="images/prints1.png" alt="">
                <a href="category.php?category=prints" class="btn">prints</a>
            </div>
            
            <div class="box">
                <img src="images/digital-arts1.png" alt="">
                <a href="category.php?category=digitalart" class="btn">digital arts</a>
            </div>
            
            
        
        </div>
    
    </section>
    
    <!-- section end -->
    
    <!-- home about section end -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
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
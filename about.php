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
    <title>about us</title>
    
    <!-- swiper css link -->
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
    
    <div class="heading" style="background:url(images/heading-img-1.jpg) no-repeat">
        <h1>about us</h1>
    </div>
    
    <!--about section starts -->
    
    <section class="about">
    
        <div class="image">
            <img src="images/about-img.jpg" alt="">
        </div>
        
        <div class="content">
            <h3>why choose us?</h3>
            <p>Curated Selection: We take pride in offering a carefully curated selection of artworks from emerging and established artists. Each piece is handpicked for its artistic merit, uniqueness, and ability to evoke emotions.</p>
            <p>Available Contact Services: We encourage you to reach out to us with any questions, comments, or inquiries. Feel free to contact us at by using the contact us section of the website. We're always eager to hear from fellow art lovers.</p>
            <div class="icons-container">
                
                <div class="icons">
                    <i class="fas fa-hand-holding-usd"></i>
                    <span>affordable prices</span>
                </div>
                <div class="icons">
                    <i class="fa fa-headset"></i>
                    <span>24/7 help services</span>
                </div>
            </div>
        </div>
    
    </section>
    
    <!-- about secion ends -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- footer section starts -->
    
   <?php include 'components/footer.php'; ?>
    
    <!-- footer section ends -->
    
    
    
    <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- js file link -->
    <script src="js/script.js"></script>
    

</body>
</html>

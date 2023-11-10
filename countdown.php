<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};


     $result = $conn->prepare("SELECT * FROM timer ORDER BY id DESC"); 
     $result->execute();
      while($res = $result->fetch(PDO::FETCH_ASSOC)){
          $date = $res['date'];
          $h = $res['h'];
          $m = $res['m'];
          $s = $res['s'];
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>countdown</title>
    
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
        <h1>countdown</h1>
    </div>
    
    <!--about section starts -->
    
    <section class="about">
    
        <div class="image">
            <img src="images/countdown-img.png" alt="">
        </div>
        
        <div class="content">
            <h3>Countdown Timer for Next Product</h3>
            <p id="demo" style="font-size:5rem"></p>
            
            <div class="icons-container">
                <div class="icons">
                    <i class="fa fa-users"></i>
                    <span>prevent confusion</span>
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
    
    
<script>
 var countDownDate = <?php 
echo strtotime("$date $h:$m:$s" ) ?> * 1000;
var now = <?php echo time() ?> * 1000;

// Update the count down every 1 second
var x = setInterval(function() {
now = now + 1000;
// Find the distance between now an the count down date
var distance = countDownDate - now;
// Time calculations for days, hours, minutes and seconds
var days = Math.floor(distance / (1000 * 60 * 60 * 24));
var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
var seconds = Math.floor((distance % (1000 * 60)) / 1000);
// Output the result in an element with id="demo"
document.getElementById("demo").innerHTML = days + "d " + hours + "h " +
minutes + "m " + seconds + "s ";
// If the count down is over, write some text 
if (distance < 0) {
clearInterval(x);
 document.getElementById("demo").innerHTML = "EXPIRED";
}
    
}, 1000);

    </script>
    

</body>
</html>

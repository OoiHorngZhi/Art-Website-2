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

<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>


<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Title -->
    <title>Product Details page</title>
    
    <!-- Title -->
    <link rel="stylesheet" href="css/quick-view-style.css">
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
<body>
    
    <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?"); 
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
    
    <div class="product-page-container" method="post">
        <span class="link-route">
            <a href="shop.php">Gallery</a> > <a href="quick-view.php"><?= $fetch_product['name']; ?></a>
        </span>
        
        <form action="" method="post">
        
        <section id="product-page">
            <div class="product-page-img">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="pid" value="<?= $fetch_product['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_product['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_product['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_product['image_01']; ?>">
                <img src="uploaded_img/<?= $fetch_product['image_01']; ?>" alt="">

                
            </div>
            <div class="product-page-details">
                <strong><?= $fetch_product['name']; ?></strong>
                
                <span class="price">RM <?= $fetch_product['price']; ?></span>
                <p class="small-description"><?= $fetch_product['artists']; ?></p>
                
                <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                
                <div class="cart-btn">
                    <input type="submit" value="add to cart" class="btn" name="add_to_cart">
                    <input class="btn" type="submit" name="add_to_wishlist" value="add to wishlist">
                </div>
                
            </div>
        </section>
        
        <section class="product-all-info">
            <ul class="product-info-menu">
                <li class="p-info-list active" data-filter="ld">Product Details</li>
                <li class="p-info-list" data-filter="md">Artist Details</li>
            </ul>
            
            <div class="info-container ld active">
                <p><?= $fetch_product['details']; ?></p>
            </div>
            <div class="info-container md">
                <p><?= $fetch_product['artist_details']; ?></p>
            </div>
            
            <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>

            
        </section>
        
        </form>
        
        
    </div>
    
    
    
    <!-- JQuery -->
    <script type="text/javascript" src="js/jquery-3.6.0.js"></script>
    
    
    <script type="text/javascript">
        $(document).on('click','.product-info-menu li', function(){
            $(this).addClass('active').siblings().removeClass('active')
        });
        
        $(document).ready(function(){
            $('.p-info-list').click(function(){
                const value = $(this).attr('data-filter');
                if(value == 'all'){
                    $('.info-container').filter('.'+value).show('1000');
                }else{
                    $('.info-container').not('.'+value).hide('1000');
                     $('.info-container').filter('.'+value).show('1000');
                }
            });
        });
    </script>
    

</body>
    
</head>
</html>
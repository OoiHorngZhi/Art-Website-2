<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

include 'components/wishlist_cart.php';

if(isset($_POST['delete'])){
   $wishlist_id = $_POST['wishlist_id'];
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE id = ?");
   $delete_wishlist_item->execute([$wishlist_id]);
}

if(isset($_GET['delete_all'])){
   $delete_wishlist_item = $conn->prepare("DELETE FROM `wishlist` WHERE user_id = ?");
   $delete_wishlist_item->execute([$user_id]);
   header('location:wishlist.php');
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>wishlist</title>
    
    <!-- swiper css link -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    
    <!-- font awesome cdn link -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    
    <!-- css file link -->
    <link rel="stylesheet" href="css/cart-page.css">
    
    
</head>
<body>
    
    <!-- header start -->
    
    <?php include 'components/user_header.php'; ?>
    <!-- header end -->
    
    <div class="heading" style="background:url(images/heading-img-1.jpg) no-repeat">
        <h1>wishlist</h1>
    </div>
    
    <!-- cart section starts -->
    
    <div class="wrapper">
        <h1>Shopping Cart</h1>
        
        <?php
        $grand_total = 0;
        $select_wishlist = $conn->prepare("SELECT * FROM `wishlist` WHERE user_id = ?");
        $select_wishlist->execute([$user_id]);
        if($select_wishlist->rowCount() > 0){
            while($fetch_wishlist = $select_wishlist->fetch(PDO::FETCH_ASSOC)){
                $grand_total += $fetch_wishlist['price'];  
        ?>
        
        <div class="project">
            <form action="" method="post">
            
            <div class="shop">
                
                <input type="hidden" name="pid" value="<?= $fetch_wishlist['pid']; ?>">
                <input type="hidden" name="wishlist_id" value="<?= $fetch_wishlist['id']; ?>">
                <input type="hidden" name="name" value="<?= $fetch_wishlist['name']; ?>">
                <input type="hidden" name="price" value="<?= $fetch_wishlist['price']; ?>">
                <input type="hidden" name="image" value="<?= $fetch_wishlist['image']; ?>">
                
                <div class="cart-box">
                    <img src="uploaded_img/<?= $fetch_wishlist['image']; ?>" alt="">
                    <div class="content">
                        <h3><?= $fetch_wishlist['name']; ?></h3>
                        <h4>RM <?= $fetch_wishlist['price']; ?></h4>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="1">
                        
                        <br/>
                        <p class="btn-area">
                            <i class="fa fa-trash"></i>
                            <input type="submit" value="delete item"  onclick="return confirm('delete this from cart?');" class="btn2" name="delete">
                        </p>
                        <p class="btn-area2">
                            <i class="fas fa-eye"></i>
                            <a href="quick_view.php?pid=<?= $fetch_wishlist['pid']; ?>" >Quick View</a>
                        </p>
                        <p class="btn-area3">
                            <i class="fas fa-shopping-cart"></i>
                            <input type="submit" value="add to cart" class="btn2" name="add_to_cart">
                        </p>
                    </div>
                </div>
                
                <?php
                }
            }else{
                echo '<p class="empty">your wishlist is empty</p>';
            }
                ?>
                
            </div>
                
            </form>
            
            <div class="right-bar">
                
                <p><span>Tax and Shipping included</span></p>
            
                <p><span>Grand total</span> <span>RM <?= $grand_total; ?></span></p>
                
                <a href="shop.php">continue</a>
                
                <a href="wishlist.php?delete_all" class="btn2 <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from wishlist?');">delete all item</a>
    
            </div>
            
        </div>
    </div>
   
    <!-- cart section ends -->
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    
    <!-- footer section starts -->
  <?php include 'components/footer.php'; ?>
    
    <!-- footer section ends -->
    
    
    
    <!-- swiper js link -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.js"></script>
    
    <!-- js file link -->
    <script src="js/script.js"></script>
    

</body>
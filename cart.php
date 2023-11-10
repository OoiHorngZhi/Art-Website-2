<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
   header('location:user_login.php');
};

if(isset($_POST['delete'])){
   $cart_id = $_POST['cart_id'];
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE id = ?");
   $delete_cart_item->execute([$cart_id]);
}

if(isset($_GET['delete_all'])){
   $delete_cart_item = $conn->prepare("DELETE FROM `cart` WHERE user_id = ?");
   $delete_cart_item->execute([$user_id]);
   header('location:cart.php');
}

if(isset($_POST['update_qty'])){
   $cart_id = $_POST['cart_id'];
   $qty = $_POST['qty'];
   $qty = filter_var($qty, FILTER_SANITIZE_STRING);
   $update_qty = $conn->prepare("UPDATE `cart` SET quantity = ? WHERE id = ?");
   $update_qty->execute([$qty, $cart_id]);
   $message[] = 'cart quantity updated';
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>shopping cart</title>
    
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
        <h1>shopping cart</h1>
    </div>
    
    <!-- cart section starts -->
    
    <div class="wrapper">
        <h1>Shopping Cart</h1>
        
        <?php
            $grand_total = 0;
            $select_cart = $conn->prepare("SELECT * FROM `cart` WHERE user_id = ?");
            $select_cart->execute([$user_id]);
            if($select_cart->rowCount() > 0){
                while($fetch_cart = $select_cart->fetch(PDO::FETCH_ASSOC)){
            ?>
        
        <div class="project">
            <form action="" method="post">
            
            <div class="shop">
                
                <input type="hidden" name="cart_id" value="<?= $fetch_cart['id']; ?>">
                
                <div class="cart-box">
                    <img src="uploaded_img/<?= $fetch_cart['image']; ?>" alt="">
                    <div class="content">
                        <h3><?= $fetch_cart['name']; ?></h3>
                        <h4>RM <?= $fetch_cart['price']; ?></h4>
                        <h4>
                            <span>Subtotal: </span> <span>RM<?= $sub_total = ($fetch_cart['price'] * $fetch_cart['quantity']); ?></span>
                        </h4>
                        <input type="number" name="qty" class="qty" min="1" max="99" onkeypress="if(this.value.length == 2) return false;" value="<?= $fetch_cart['quantity']; ?>">
                        <button type="submit" class="fas fa-edit" name="update_qty"></button>
                        
                        
                        
                        <br/>
                        <p class="btn-area">
                            <i class="fa fa-trash"></i>
                            <input type="submit" value="delete item"  onclick="return confirm('delete this from cart?');" class="btn2" name="delete">
                        </p>
                        <p class="btn-area2">
                            <i class="fas fa-eye"></i>
                            <a href="quick_view.php?pid=<?= $fetch_cart['pid']; ?>" >Quick View</a>
                        </p>
                    </div>
                </div>
            </div>
                
            </form>
            
            <?php
                    $grand_total += $sub_total;
                    }
                }else{
                echo '<p class="empty">your cart is empty</p>';
                }
                ?>
            
            <div class="right-bar">
        
                
                <p><span>Tax and Shipping included</span></p>
            
                <p><span>Grand total</span> <span>RM <?= $grand_total; ?></span></p>
                
                <a href="shop.php">continue</a>
                
                <a href="cart.php?delete_all" class="btn2 <?= ($grand_total > 1)?'':'disabled'; ?>" onclick="return confirm('delete all from cart?');">delete all item</a>
                
                <a href="checkout.php" class="btn2 <?= ($grand_total > 1)?'':'disabled'; ?>">Checkout</a>
    
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
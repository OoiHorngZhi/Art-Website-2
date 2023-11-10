<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">welcome!</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $fetch_profile['name']; ?>
                    </h5>
                    <a href="update_profile.php" class="btn btn-success btn-sm">Update profile</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
              $total_pendings = 0;
              $select_pendings = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
              $select_pendings->execute(['pending']);
              if($select_pendings->rowCount() > 0){
                  while($fetch_pendings = $select_pendings->fetch(PDO::FETCH_ASSOC)){
                   $total_pendings += $fetch_pendings['total_price'];
                  }
              }
              ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">total pendings</p>
                    <h5 class="font-weight-bolder mb-0">
                      <span>RM</span><?= $total_pendings; ?><span>/-</span>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See orders</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
            $total_completes = 0;
            $select_completes = $conn->prepare("SELECT * FROM `orders` WHERE payment_status = ?");
            $select_completes->execute(['completed']);
            if($select_completes->rowCount() > 0){
               while($fetch_completes = $select_completes->fetch(PDO::FETCH_ASSOC)){
                  $total_completes += $fetch_completes['total_price'];
               }
            }
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">completed orders</p>
                    <h5 class="font-weight-bolder mb-0">
                      <span>RM</span><?= $total_completes; ?><span>/-</span>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See orders</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
               <?php
            $select_orders = $conn->prepare("SELECT * FROM `orders`");
            $select_orders->execute();
            $number_of_orders = $select_orders->rowCount()
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">orders placed</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $number_of_orders; ?>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See orders</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
            $select_products = $conn->prepare("SELECT * FROM `products`");
            $select_products->execute();
            $number_of_products = $select_products->rowCount()
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">products added</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $number_of_products; ?>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See products</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
            $select_users = $conn->prepare("SELECT * FROM `users`");
            $select_users->execute();
            $number_of_users = $select_users->rowCount()
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">normal users</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $number_of_users; ?>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See users</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
            $select_admins = $conn->prepare("SELECT * FROM `admins`");
            $select_admins->execute();
            $number_of_admins = $select_admins->rowCount()
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">admin users</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $number_of_admins; ?>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See admins</a>
                    
          </div>
        </div>
       
       <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
            $select_messages = $conn->prepare("SELECT * FROM `messages`");
            $select_messages->execute();
            $number_of_messages = $select_messages->rowCount()
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">new messages</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $number_of_messages; ?>
                    </h5>
                    <a href="placed_orders.php" class="btn btn-success btn-sm">See messages</a>
                    
          </div>
        </div>
        
        <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Auction Products</p>
                    <br/>
                    <a href="auction_product.php" class="btn btn-success btn-sm">See product</a>
                    
          </div>
        </div>
        
        <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
              <?php
            $select_messages = $conn->prepare("SELECT * FROM `review_table`");
            $select_messages->execute();
            $number_of_comments = $select_messages->rowCount()
         ?>
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">total bid comments</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $number_of_comments; ?>
                    </h5>
                    <a href="bid_comment.php" class="btn btn-success btn-sm">See comments</a>
                    
          </div>
        </div>
        
        <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Sales Graph</p>
                    <br/>
                    <a href="countdown/chart.php" class="btn btn-success btn-sm">See graph</a>
                    
          </div>
        </div>
        
        <div class="col-md-3 mb-4">
          <div class="card card-body p-3">
              
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Countdown Timer</p>
                    <br/>
                    <a href="countdown/countdown-timer.php" class="btn btn-success btn-sm">Edit Countdown</a>
                    
          </div>
        </div>



      

   </div>

<?php include('includes/footer.php'); ?>
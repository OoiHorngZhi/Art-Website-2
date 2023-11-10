<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){
   $order_id = $_POST['order_id'];
   $payment_status = $_POST['payment_status'];
   $payment_status = filter_var($payment_status, FILTER_SANITIZE_STRING);
   $update_payment = $conn->prepare("UPDATE `orders` SET payment_status = ? WHERE id = ?");
   $update_payment->execute([$payment_status, $order_id]);
   $message[] = 'payment status updated!';
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Payment Method
                        <a href="placed_orders.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php
      $update_id = $_GET['update'];
      $select_orders = $conn->prepare("SELECT * FROM `orders` WHERE id = ?");
      $select_orders->execute([$update_id]);
      if($select_orders->rowCount() > 0){
         while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){ 
   ?>
                    
                    <form action="" method="post" enctype="multipart/form-data">
                        
                            
                        
                        
                            <input type="hidden" name="order_id" value="<?= $fetch_orders['id']; ?>">
                        
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Placed On</label>
                                                <span class="form-control"><?= $fetch_orders['placed_on']; ?></span>
                                                
                                            </div>
                                        </div>
                            
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Name</label>
                                                <span class="form-control"><?= $fetch_orders['name']; ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Number</label>
                                                <span class="form-control"><?= $fetch_orders['number']; ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Address</label>
                                                <span class="form-control"><?= $fetch_orders['address']; ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Total Products Added</label>
                                                <span class="form-control"><?= $fetch_orders['total_products']; ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Total Price</label>
                                                <span class="form-control"><?= $fetch_orders['total_price']; ?></span>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-6">
                                            <div class="mb-3">
                                                <label>Update Payment Status</label>
                                                
                                                <select name="payment_status" class="form-select">
                                                    <option selected disabled><?= $fetch_orders['payment_status']; ?></option>
                                                    <option value="pending">Pending</option>
                                                    <option value="completed">Completed</option>
                                                    
                                                </select>
                                            </div>
                                        </div>
                            
                                         
                                        <div class="col-md-6">
                                            <div class="mb-3 text-end">
                                                <br/>
                                                <button type="submit" name="update" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>  
                                    </div>
                        
                        
                    </form>
                </div>
                
                <?php
         }
      }else{
         echo '<p class="empty">no orders placed yet!</p>';
      }
   ?>
                
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

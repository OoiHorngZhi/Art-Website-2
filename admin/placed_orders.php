<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_GET['delete'])){
   $delete_id = $_GET['delete'];
   $delete_order = $conn->prepare("DELETE FROM `orders` WHERE id = ?");
   $delete_order->execute([$delete_id]);
   header('location:placed_orders.php');
}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Placed Orders
                    </h3>
                </div>
                <div class="card-body">

                    
                    <table class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                <th>Placed on</th>
                                <th>Name</th>
                                <th>Products</th>
                                <th>Price</th>
                                <th>Payment Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            $select_orders = $conn->prepare("SELECT * FROM `orders`");
                            $select_orders->execute();
                            if($select_orders->rowCount() > 0){
                                while($fetch_orders = $select_orders->fetch(PDO::FETCH_ASSOC)){
                            ?>
                                        <tr>
                                            <td><?= $fetch_orders['placed_on']; ?></td>
                                            <td><?= $fetch_orders['name']; ?></td>
                                            <td><?= $fetch_orders['total_products']; ?></td>
                                            <td><?= $fetch_orders['total_price']; ?></td>
                                            <td><?= $fetch_orders['payment_status']; ?></td>
                                            <td>
                                                
                                                <a href="update_payment.php?update=<?= $fetch_orders['id']; ?>" class="btn btn-success btn-sm">Update</a>
                                                
                                                <a href="placed_orders.php?delete=<?= $fetch_orders['id']; ?>"
                                                   class="btn btn-danger btn-sm mx-2"
                                                   onclick="return confirm('delete this order?')"
                                                   >Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo '<div class= "alert alert-success">
                                <h4>no orders placed yet</h4>
                                </div>';
                            }
                            ?>
                        
                        </tbody>
                        
                    </table>
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>
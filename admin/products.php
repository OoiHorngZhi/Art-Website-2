<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}


 if(isset($_GET['delete'])){

   $delete_id = $_GET['delete'];
   $delete_product_image = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
   $delete_product_image->execute([$delete_id]);
   $fetch_delete_image = $delete_product_image->fetch(PDO::FETCH_ASSOC);
   unlink('../uploaded_img/'.$fetch_delete_image['image_01']);
   
   $delete_product = $conn->prepare("DELETE FROM `products` WHERE id = ?");
   $delete_product->execute([$delete_id]);
   $delete_cart = $conn->prepare("DELETE FROM `cart` WHERE pid = ?");
   $delete_cart->execute([$delete_id]);
   $delete_wishlist = $conn->prepare("DELETE FROM `wishlist` WHERE pid = ?");
   $delete_wishlist->execute([$delete_id]);
   header('location:products.php');
 }
?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Products
                        <a href="products-create.php" class="btn btn-primary float-end">Add Products</a>
                    </h3>
                </div>
                <div class="card-body">

                    
                    <table class="table table-bordered table-striped">
                    
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Status</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        
                        <tbody>
                            
                            <?php
                            $select_products = $conn->prepare("SELECT * FROM `products`");
                            $select_products->execute();
                            if($select_products->rowCount() > 0){
                                while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                            ?>
                                        <tr>
                                            <td><?= $fetch_products['id']; ?></td>
                                            <td><?= $fetch_products['name']; ?></td>
                                            <td>
                                                RM<span><?= $fetch_products['price']; ?></span>
                                            </td>
                                            <td>
                                                <?php
                                                    if($fetch_products['isActive'] == 1){
                                                        echo '<span class="badge bg-danger text-white">Hidden</span>';
                                                    }else{
                                                        echo '<span class="badge bg-success text-white">Visible</span>';
                                                    }
                                                ?>
                                            </td>
                                            <td>
                                                <a href="update_product.php?update=<?= $fetch_products['id']; ?>" class="btn btn-success btn-sm">Edit</a>
                                                <a href="products.php?delete=<?= $fetch_products['id']; ?>" 
                                                   class="btn btn-danger btn-sm mx-2"
                                                   onclick="return confirm('Are you sure you want to delete this data?')"
                                                   >Delete</a>
                                            </td>
                                        </tr>
                                    <?php
                                }
                            }else{
                                echo '<div class= "alert alert-success">
                                <h4>No products added yet</h4>
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
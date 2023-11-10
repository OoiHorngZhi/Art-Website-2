<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
}

if(isset($_POST['update'])){

   $pid = $_POST['pid'];
   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);
    $artists = $_POST['artists'];
   $artists = filter_var($details, FILTER_SANITIZE_STRING);
    $artist_details = $_POST['artist_details'];
   $artist_details = filter_var($details, FILTER_SANITIZE_STRING);


   $update_product = $conn->prepare("UPDATE `products` SET name = ?, price = ?, details = ?, artists = ?, artist_details = ? WHERE id = ?");
   $update_product->execute([$name, $price, $details, $artists, $artist_details, $pid]);

   $message[] = '<div class= "alert alert-success">
            <h4>product updated successfully</h4>
            </div>';

   $old_image_01 = $_POST['old_image_01'];
   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;

   if(!empty($image_01)){
      if($image_size_01 > 2000000){
         $message[] = '<div class= "alert alert-success">
            <h4>image size is too large</h4>
            </div>';
      }else{
         $update_image_01 = $conn->prepare("UPDATE `products` SET image_01 = ? WHERE id = ?");
         $update_image_01->execute([$image_01, $pid]);
         move_uploaded_file($image_tmp_name_01, $image_folder_01);
         unlink('../uploaded_img/'.$old_image_01);
         $message[] = '<div class= "alert alert-success">
            <h4>image updated sucessfully</h4>
            </div>';
      }
   }

   

}

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Edit Products
                        <a href="products.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <?php
                    $update_id = $_GET['update'];
                    $select_products = $conn->prepare("SELECT * FROM `products` WHERE id = ?");
                    $select_products->execute([$update_id]);
                    if($select_products->rowCount() > 0){
                        while($fetch_products = $select_products->fetch(PDO::FETCH_ASSOC)){ 
                    ?>
                    
                    <form action="" method="post" enctype="multipart/form-data">
                        
                       
                        
                                        <input type="hidden" name="pid" value="<?= $fetch_products['id']; ?>">
                                        <input type="hidden" name="old_image_01" value="<?= $fetch_products['image_01']; ?>">
                
                                        <div class="mb-3">
                                            <label>Product Name</label>
                                            <input type="text" name="name" value="<?= $fetch_products['name']; ?>" required class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Product Description</label>
                                            <textarea name="details" required class="form-control" rows="10"><?= $fetch_products['details']; ?></textarea>
                                        </div>
                                        <div class="mb-3">
                                            <label>Product Price</label>
                                            <input type="number" name="price" required class="form-control" min="0" max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" value="<?= $fetch_products['price']; ?>">
                                        </div>
                                        
                                        <div class="mb-3">
                                            <label>Upload Service Image</label>
                                            <input type="file" name="image_01" accept="image/jpg, image/jpeg, image/png, image/webp" class="form-control">
                                            <img src="../uploaded_img/<?= $fetch_products['image_01']; ?>" style="width:150px;height:130px;" alt="">
                                        </div>
                        
                        
                                        <h5>Artist Tags</h5>
                                        <div class="mb-3">
                                            <label>Artist Name</label>
                                            <input type="text" name="artists" value="<?= $fetch_products['artists']; ?>" required class="form-control">
                                        </div>
                                        <div class="mb-3">
                                            <label>Artist Bio</label>
                                            <textarea name="artist_details" required class="form-control" rows="3"><?= $fetch_products['artist_details']; ?></textarea>
                                        </div>
                                        
                        
                        
                        
                                       
                        
                                        <div class="mb-3 text-end">
                                            <button type="submit" name="update" class="btn btn-primary">Update Product</button>
                                        </div>
                                    <?php
                                    }
                                        }else{
                                        echo '<h5>no product found!<h5>';
                                    }
                                    ?>
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

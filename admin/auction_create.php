<?php

include '../components/connect.php';

session_start();

$admin_id = $_SESSION['admin_id'];

if(!isset($admin_id)){
   header('location:admin_login.php');
};

if(isset($_POST['add_product'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $price = $_POST['price'];
   $price = filter_var($price, FILTER_SANITIZE_STRING);
   $details = $_POST['details'];
   $details = filter_var($details, FILTER_SANITIZE_STRING);

   $image_01 = $_FILES['image_01']['name'];
   $image_01 = filter_var($image_01, FILTER_SANITIZE_STRING);
   $image_size_01 = $_FILES['image_01']['size'];
   $image_tmp_name_01 = $_FILES['image_01']['tmp_name'];
   $image_folder_01 = '../uploaded_img/'.$image_01;
    
    $artists = $_POST['artists'];
   $artists = filter_var($artists, FILTER_SANITIZE_STRING);
    $artist_details = $_POST['artist_details'];
   $artist_details = filter_var($artist_details, FILTER_SANITIZE_STRING);


   $select_products = $conn->prepare("SELECT * FROM `auction_table` WHERE name = ?");
   $select_products->execute([$name]);

   if($select_products->rowCount() > 0){
      $message[] = '<div class= "alert alert-success">
            <h4>product name already exist!</h4>
            </div>';
   }else{

      $insert_products = $conn->prepare("INSERT INTO `auction_table`(name, details, price, image_01, artists, artist_details) VALUES(?,?,?,?,?,?)");
      $insert_products->execute([$name, $details, $price, $image_01, $artists, $artist_details]);

      if($insert_products){
         if($image_size_01 > 2000000 ){
            $message[] = 'image size is too large!';
         }else{
            move_uploaded_file($image_tmp_name_01, $image_folder_01);
    
            $message[] = '<div class= "alert alert-success">
            <h4>new product added!</h4>
            </div>';
         }

      }

   }  

};

?>

<?php include('includes/header.php'); ?>

    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h3>
                        Add Auction Products
                        <a href="auction_product.php" class="btn btn-danger float-end">Back</a>
                    </h3>
                </div>
                <div class="card-body">
                    
                    <form action="" method="post" enctype="multipart/form-data">
                    
                        <div class="mb-3">
                            <label>Product Name</label>
                            <input type="text" name="name" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Product Description</label>
                            <textarea name="details" required class="form-control" rows="10"></textarea>
                        </div>
                        <div class="mb-3">
                            <label>Set Starting Price</label>
                            <input type="number" min="0" class="form-control" required max="9999999999" placeholder="enter product price" onkeypress="if(this.value.length == 10) return false;" name="price">

                        </div>
                        
                        <div class="mb-3">
                            <label>Upload Product Image</label>
                            <input type="file" name="image_01" required class="form-control">
                        </div>
                        
                        
                        <h5>Artist Tags</h5>
                        <div class="mb-3">
                            <label>Artist name</label>
                            <input type="text" name="artists" required class="form-control">
                        </div>
                        <div class="mb-3">
                            <label>Artist Bio</label>
                            <textarea name="artist_details" required class="form-control" rows="3"></textarea>
                        </div>

                        
                        
                        
                        <div class="mb-3 text-end">
                            <button type="submit" name="add_product" class="btn btn-primary">Save Product</button>
                        </div>
                    
                    </form>
                    
                </div>
            </div>
        </div>
    </div>

<?php include('includes/footer.php'); ?>

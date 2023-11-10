<?php

include 'components/connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};



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


<!DOCTYPE html>
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
    
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    
<body>
    
    <?php
        $pid = $_GET['pid'];
        $select_products = $conn->prepare("SELECT * FROM `auction_table` WHERE id = ?"); 
        $select_products->execute([$pid]);
        if($select_products->rowCount() > 0){
            while($fetch_product = $select_products->fetch(PDO::FETCH_ASSOC)){
        ?>
    
    <div class="product-page-container" method="post">
        <span class="link-route">
            <a href="auction.php">Auction</a> > <a href="quick_view_auction.php"><?= $fetch_product['name']; ?></a>
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
                
                <span class="price">Starting Price: RM <?= $fetch_product['price']; ?></span>
                <p class="small-description"><?= $fetch_product['artists']; ?></p>
                
                
                <div class="container">
    	
    	<div class="card">
    		
    		<div class="card-body">
    			<div class="row">
    				<div class="col-sm-4 text-center">
    					<h1 class="text-warning mt-4 mb-4">
    						
    					</h1>
    					<div class="mb-3">
    						
	    				</div>
    					<h3><span id="total_review">0</span> Total Bids</h3>
    				</div>
    				
    				<div class="col-sm-4 text-center">
    					<h3 class="mt-4 mb-3">Place Your Bid Here</h3>
    					<button type="button" name="add_review" id="add_review" class="btn btn-primary">Bid</button>
    				</div>
    			</div>
    		</div>
    	</div>
    	
    </div>
                
                
            </div>
        </section>
        
        <section class="product-all-info">
            <ul class="product-info-menu">
                <li class="p-info-list active" data-filter="ld">Product Details</li>
                <li class="p-info-list" data-filter="md">Artist Details</li>
                <li class="p-info-list" data-filter="mk">Bidding Comments</li>
                
            </ul>
            
            <div class="info-container ld active">
                <p><?= $fetch_product['details']; ?></p>
            </div>
            <div class="info-container md">
                <p><?= $fetch_product['artist_details']; ?></p>
            </div>
            <div class="info-container mk">
                <p>
                
                <div class="container">
    	
    	<div class="card">
    		
    		
    	</div>
                    
    	<div class="mt-5" id="review_content">
                    <input type="hidden" name="pid" id="pid" value="<?= $fetch_product['id']; ?>">
                    </div>
    </div>
    
    
    
    </p>
            
            
            </div>
            
           

            
        </section>
        
        </form>
        
        
    </div>
    
    <div id="review_modal" class="modal" tabindex="-1" role="dialog">
  	<div class="modal-dialog" role="document">
    	<div class="modal-content">
	      	<div class="modal-header">
	        	<h5 class="modal-title">Submit Bidding Amount</h5>
	        	<button type="button" class="close" data-dismiss="modal" aria-label="Close">
	          		<span aria-hidden="true">&times;</span>
	        	</button>
	      	</div>
	      	<div class="modal-body">
                
                <input type="hidden" name="pid" id="pid" value="<?= $fetch_product['id']; ?>">
	      		
	        	<div class="form-group">
	        		<input type="text" name="user_name" id="user_name" class="form-control" placeholder="Enter Your Name" />
	        	</div>
                <div class="form-group">
	        		<input type="text" name="email" id="email" class="form-control" placeholder="Enter Your Email" />
	        	</div>
	        	<div class="form-group">
	        		<textarea name="user_review" id="user_review" class="form-control" placeholder="Type Review Here"></textarea>
	        	</div>
	        	<div class="form-group text-center mt-4">
	        		<button type="button" class="btn btn-primary" id="save_review">Submit</button>
	        	</div>
	      	</div>
    	</div>
  	</div>
</div>
    
     <?php
      }
   }else{
      echo '<p class="empty">no products added yet!</p>';
   }
   ?>
    
<style>
.progress-label-left
{
    float: left;
    margin-right: 0.5em;
    line-height: 1em;
}
.progress-label-right
{
    float: right;
    margin-left: 0.3em;
    line-height: 1em;
}
.star-light
{
	color:#e9ecef;
}
</style>
    
    <!-- JQuery -->
    
    
    
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

<script>

$(document).ready(function(){

	var rating_data = 0;

    $('#add_review').click(function(){

        $('#review_modal').modal('show');

    });

    $(document).on('mouseenter', '.submit_star', function(){

        var rating = $(this).data('rating');

        reset_background();

        for(var count = 1; count <= rating; count++)
        {

            $('#submit_star_'+count).addClass('text-warning');

        }

    });

    function reset_background()
    {
        for(var count = 1; count <= 5; count++)
        {

            $('#submit_star_'+count).addClass('star-light');

            $('#submit_star_'+count).removeClass('text-warning');

        }
    }

    $(document).on('mouseleave', '.submit_star', function(){

        reset_background();

        for(var count = 1; count <= rating_data; count++)
        {

            $('#submit_star_'+count).removeClass('star-light');

            $('#submit_star_'+count).addClass('text-warning');
        }

    });

    $(document).on('click', '.submit_star', function(){

        rating_data = $(this).data('rating');

    });

    $('#save_review').click(function(){
        
        var pid = $('#pid').val();

        var user_name = $('#user_name').val();

        var user_review = $('#user_review').val();
        
        var email = $('#email').val();

        if(user_name == '' || user_review == '' || email == '')
        {
            alert("Please Fill All Fields");
            return false;
        }
        else
        {
            $.ajax({
                url:"submit_rating.php",
                method:"POST",
                data:{pid:pid, rating_data:rating_data, user_name:user_name, user_review:user_review, email:email},
                success:function(data)
                {
                    $('#review_modal').modal('hide');

                    load_rating_data();

                    alert(data);
                }
            })
        }

    });

    load_rating_data();

    function load_rating_data()
    {
        $.ajax({
            url:"submit_rating.php",
            method:"POST",
            data:{action:'load_data'},
            dataType:"JSON",
            success:function(data)
            {
                
                $('#average_rating').text(data.average_rating);
                $('#total_review').text(data.total_review);

                var count_star = 0;

                $('.main_star').each(function(){
                    count_star++;
                    if(Math.ceil(data.average_rating) >= count_star)
                    {
                        $(this).addClass('text-warning');
                        $(this).addClass('star-light');
                    }
                });

                $('#total_five_star_review').text(data.five_star_review);

                $('#total_four_star_review').text(data.four_star_review);

                $('#total_three_star_review').text(data.three_star_review);

                $('#total_two_star_review').text(data.two_star_review);

                $('#total_one_star_review').text(data.one_star_review);

                $('#five_star_progress').css('width', (data.five_star_review/data.total_review) * 100 + '%');

                $('#four_star_progress').css('width', (data.four_star_review/data.total_review) * 100 + '%');

                $('#three_star_progress').css('width', (data.three_star_review/data.total_review) * 100 + '%');

                $('#two_star_progress').css('width', (data.two_star_review/data.total_review) * 100 + '%');

                $('#one_star_progress').css('width', (data.one_star_review/data.total_review) * 100 + '%');

                if(data.review_data.length > 0)
                {
                    var html = '';

                    for(var count = 0; count < data.review_data.length; count++)
                    {
                        html += '<div class="row mb-3">';
                        

                        html += '<div class="col-sm-1"><div class="rounded-circle bg-danger text-white pt-2 pb-2"><h3 class="text-center">'+data.review_data[count].user_name.charAt(0)+'</h3></div></div>';

                        html += '<div class="col-sm-11">';

                        html += '<div class="card">';

                        html += '<div class="card-header"><b>'+data.review_data[count].user_name+'</b></div>';

                        html += '<div class="card-body">';

                        for(var star = 1; star <= 5; star++)
                        {
                            var class_name = '';

                            if(data.review_data[count].rating >= star)
                            {
                                class_name = 'text-warning';
                            }
                            else
                            {
                                class_name = 'star-light';
                            }

                           // html += '<i class="fas fa-star '+class_name+' mr-1"></i>';
                        }

                        html += '<br />';

                        html += data.review_data[count].user_review;


                        html += '</div>';

                        html += '<div class="card-footer text-right">On '+data.review_data[count].datetime+'</div>';

                        html += '</div>';

                        html += '</div>';

                        html += '</div>';
                    }

                    $('#review_content').html(html);
                }
            }
        })
    }

});

</script>
    

</body>
    
</head>
</html>


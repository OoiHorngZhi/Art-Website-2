<?php

//submit_rating.php

$connect = new PDO("mysql:host=localhost;dbname=artweb_db", "root", "");

//if(isset($_SESSION['pid'])){
 //  $pid = $_SESSION['pid'];

if(isset($_POST["rating_data"]))
{

	$data = array(
        ':pid'		=>	$_POST["pid"],
		':user_name'		=>	$_POST["user_name"],
		
		':user_review'		=>	$_POST["user_review"],
		':datetime'			=>	time(),
        ':email'		=>	$_POST["email"]
	);

	$query = "
	INSERT INTO `review_table`
	(pid, user_name, user_review, email, datetime) 
	VALUES (:pid, :user_name, :user_review, :email, :datetime)
	";

	$statement = $connect->prepare($query);

	$statement->execute($data);

	echo "Your Bidding Comment Successfully Submitted";

}

if(isset($_POST["action"]))
{
	$average_rating = 0;
	$total_review = 0;
	$five_star_review = 0;
	$four_star_review = 0;
	$three_star_review = 0;
	$two_star_review = 0;
	$one_star_review = 0;
	$total_user_rating = 0;
    
     
	$review_content = array();
    
	$query = "
	SELECT * FROM review_table 
	ORDER BY review_id DESC
	";

   //$query->execute([$pid]);

	$result = $connect->query($query, PDO::FETCH_ASSOC);
    
    date_default_timezone_set("Asia/Singapore");

	foreach($result as $row)
	{
		$review_content[] = array(
         
			'user_name'		=>	$row["user_name"],
			'user_review'	=>	$row["user_review"],
			'datetime'		=>	date('l jS, F Y h:i:s A', $row["datetime"])
		);

		//if($row["user_rating"] == '5')
		//{
		//	$five_star_review++;
		//}

		//if($row["user_rating"] == '4')
		//{
		//	$four_star_review++;
		//}

		//if($row["user_rating"] == '3')
		//{
		//	$three_star_review++;
		//}

		//if($row["user_rating"] == '2')
		//{
		//	$two_star_review++;
		//}

		//if($row["user_rating"] == '1')
		//{
		//	$one_star_review++;
		//}

		$total_review++;

		//$total_user_rating = $total_user_rating + $row["user_rating"];

	}

	//$average_rating = $total_user_rating / $total_review;

	$output = array(
		//'average_rating'	=>	number_format($average_rating, 1),
		'total_review'		=>	$total_review,
		//'five_star_review'	=>	$five_star_review,
		//'four_star_review'	=>	$four_star_review,
		//'three_star_review'	=>	$three_star_review,
		//'two_star_review'	=>	$two_star_review,
		//'one_star_review'	=>	$one_star_review,
		'review_data'		=>	$review_content
	);

	echo json_encode($output);

}

?>
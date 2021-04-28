<?php 
 include ('connection.php');
 // select records from database

 $select = "SELECT username,email,message ,id FROM user_details ORDER BY created_date DESC LIMIT 10" ;

 $result = mysqli_query($conn,$select);

 $comments = mysqli_fetch_all($result, MYSQLI_ASSOC);

 mysqli_free_result($result);

 mysqli_close($conn);


 ?>


 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8">
 	<meta http-equiv="X-UA-Compatible" content="IE=edge">
 	<title></title>
 	<link rel="stylesheet" href="styles.css">
 </head>
 <body>
 	<div class="container">
 	
 	<div class="comments">
 		<h1>Welcome To my page</h1>
 		<button><a href="add.php"> create a comment :-)</a></button>
 	<h3>What People say about us</h3>

 	<?php 	if(count($comments)> 0 ) { ?>

 	<?php foreach($comments as $comment):?>

 		<h4> <?php echo htmlspecialchars($comment['username']);?> </h4>
 		<p> <?php echo htmlspecialchars($comment['message']) ;?> </p>

 		<a href="details.php?id=<?php echo $comment['id']; ?> ">More info</a>


 	<?php endforeach; ?>

 <?php 	} else{ ?>

 	<?php 	echo 'no records found!'; ?>

 <?php 	} ?>



 	</div>

 	<?php include('footer.php') ?>

 	</div>
 	
 </body>
 </html>
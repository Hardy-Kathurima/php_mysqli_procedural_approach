<?php 
include('connection.php');

if(isset($_POST['delete'])){

	$delete_comment = mysqli_real_escape_string($conn,$_POST['delete_comment']);

	$delete = "DELETE FROM user_details WHERE id = $delete_comment";

	 if(mysqli_query($conn,$delete)){
	 	header('Location:index.php');
	 }else{
	 	echo "could not delete the comment" . mysqli_error($conn);
	 }
}

if(isset($_GET['id'])){

	$id = mysqli_real_escape_string($conn, $_GET['id']);

	$select = " SELECT * FROM user_details WHERE id = $id";

	// get the result

	$result = mysqli_query($conn,$select);

	// fetch result in associative array

	$comment = mysqli_fetch_assoc($result);

	mysqli_free_result($result);


	mysqli_close($conn);

	
}


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
 		
 		<h3>Details page</h3>

 		<?php if($comment): ?>

 			<h4> <?php echo  htmlspecialchars($comment['username'] ) ;?> </h4>
 			<span> <?php echo htmlspecialchars($comment['email']) ; ?> </span>

 			<div> <?php echo htmlspecialchars($comment['message']);?></div>

 			<span> <?php echo date($comment['created_date']); ?> </span>

 			<!-- delete comment -->

 			<form action="details.php" method="POST" onsubmit="return confirm_delete()"; >
 				
 				<input type="hidden" name="delete_comment" value="<?php echo $comment['id']; ?>">

 				<input type="submit" name="delete"  value="Delete">
 			</form>

 			<?php else: ?>

 			<h4> <?php echo "comment does not exist :-(" ;?> </h4>

 		<?php endif; ?>
 		<div> <a href="index.php"><<< Home</a></div>

 		
 		</div>
 		<?php include('footer.php') ?>
 	</div>
 </body>
 </html>
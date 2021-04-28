<?php 
 include ('connection.php');
 $username=$email=$message='';
 $errors =array('username'=>'','email'=>'', 'message'=>'');


 if(isset($_POST['submit'])){
 	$username = htmlspecialchars(trim($_POST['username']));
 	$email = htmlspecialchars(trim($_POST['email']));
 	$message = htmlspecialchars(trim($_POST['message']));

 	if(empty($username)){
 		$errors['username'] ='username is required';
 	}else{
 		$username = trim($_POST['username']);

 		if(!preg_match('/^[a-z\d_\s]{2,20}$/i',$username)){
         $errors['username'] = 'enter a valid username';
 		}
 	}

 	if(empty($email)){
 		$errors['email']='email is required';
 	}else{
 		$email = trim($_POST['email']);

 		if(!filter_var($email,FILTER_VALIDATE_EMAIL)){
         $errors['email']='Please enter a valid email';
 		}
 	}

 	if(empty($message)){
 		$errors['message']  ='comment is required';
 	}else{
 		$message = trim($_POST['message']);

 		if(str_word_count($_POST['message'])>20){
         $errors['message'] = 'comment cannot exceed 20 words';
 		}
 	}


 if(array_filter($errors)){

 	  

 }else{
 	    $email= mysqli_real_escape_string($conn,$email);
 		$username = mysqli_real_escape_string($conn,$username);
 		$message = mysqli_real_escape_string($conn,$message);
 		// insert query 

 		$insert = "INSERT INTO user_details(`username`,`email`,`message`) VALUES('$username','$email','$message')";
 		mysqli_query($conn,$insert);	
 		header('Location:index.php');
 }

 	
 }




 // select records from database

 $select = "SELECT username,email,message  FROM user_details ORDER BY created_date DESC";

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

 		<h2>Please Leave a comment :-)</h2>

 	<form action="add.php" method="POST">
 		<div class="input-field">
 			<label > Username:</label>
 			<input type="text" name="username" value=" <?php echo $username; ?>"   >
 		</div>

 		<div class="errors"> <?php echo $errors['username'] ;?> </div>

 		<div class="input-field">
 			<label >Email:</label>
 			<input type="text" name="email" value=" <?php echo $email; ?>"   >
 		</div>
 		<div class="errors"> <?php echo $errors['email'] ;?> </div>
 		<div class="input-field">
 			<label >Comment:</label>
 			<textarea name="message"  cols="25" rows="5"  ><?php echo $message; ?></textarea>
 			<span>2/50 Words</span>
 		</div>
 		<div class="errors"> <?php echo $errors['message'] ;?> </div>

 		<div class="input-field">
 			
 			<input type="submit" name="submit" value="submit" id='submit' >
 		</div>


 	</form>
 	

 	<p class="error"> <?php echo $error; ?></p>
 	

 	
 	
<div>
	<a href="index.php"><<< Home</a>
</div>

<?php include('footer.php') ?>
 	</div>
 	
 </body>
 </html>
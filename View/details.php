<?php
include_once('../Model/connection.php');
if (isset($_POST['delete'])) {
	$delete_comment = mysqli_real_escape_string($conn, $_POST['delete_comment']);
	$delete = "DELETE FROM user_details WHERE id = $delete_comment";
	if (mysqli_query($conn, $delete)) {
		header('Location:../index.php');
	} else {
		echo "could not delete the comment" . mysqli_error($conn);
	}
}

if (isset($_GET['id'])) {
	$id = mysqli_real_escape_string($conn, $_GET['id']);
	$select = " SELECT * FROM user_details WHERE id = $id";
	$result = mysqli_query($conn, $select);
	$comment = mysqli_fetch_assoc($result);
	mysqli_free_result($result);
	mysqli_close($conn);
}
?>

<?php include('../Html/header.php'); ?>


<div class="container">

	

    <div class="comments">

        <h3>Details page</h3>

        <?php if ($comment) : ?>

        <h4> <?php echo  htmlspecialchars($comment['username']); ?> </h4>
        <span> <?php echo htmlspecialchars($comment['email']); ?> </span>

        <div> <?php echo htmlspecialchars($comment['message']); ?></div>

        <span> <?php echo date($comment['created_date']); ?> </span>

        <!-- delete comment -->

        <a href="edit.php?id=<?php echo $comment['id']; ?> ">Edit Comment</a>
        <div>
            <form action="details.php" method="POST" onsubmit="return confirm_delete()" ;>

                <input type="hidden" name="delete_comment" value="<?php echo $comment['id']; ?>">

                <input class="btn btn-danger" type="submit" name="delete" value="Delete"
                    onclick="return confirm(' Are you sure you want to delete this comment?')">
            </form>

        </div>
        <?php else : ?>
        <h4> <?php echo "comment does not exist :-("; ?> </h4>
        <?php endif; ?>
        <div> <a href="index.php">
                <<< Home</a>
        </div>
    </div> <?php include('../Html/footer.php'); ?>
</div>




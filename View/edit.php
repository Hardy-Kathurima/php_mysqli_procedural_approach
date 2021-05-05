<?php
include_once('../Model/connection.php');

if (isset($_POST['edit'])) {
    $edit_comment = mysqli_real_escape_string($conn, $_POST['edit_comment']);
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $message = mysqli_real_escape_string($conn, $_POST['message']);

    $update = "UPDATE user_details  SET username='$username', email='$email', message = '$message' WHERE id = $edit_comment ";

    if (mysqli_query($conn, $update)) {
        header('Location:../index.php');
    } else {
        echo "could not edit the comment" . mysqli_error($conn);
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
        <h3>Edit a comment</h3>
        <?php if ($comment) : ?>
        <form action="edit.php" method="POST">
            <input type="hidden" name="edit_comment" value="<?php echo $comment['id']; ?>">
            <div class="input-field">
                <label> Username:</label>
                <input type="text" name="username" value=" <?php echo  htmlspecialchars($comment['username']); ?>">
            </div>
            <div class="input-field">
                <label>Email:</label>
                <input type="text" name="email" value=" <?php echo htmlspecialchars($comment['email']); ?> ">
            </div>
            <div class="input-field">
                <label>Comment:</label>
                <textarea name="message" cols="25"
                    rows="5"><?php echo htmlspecialchars($comment['message']); ?></textarea>
                <span>2/50 Words</span>
            </div>
            <div class="input-field">
                <input class="btn btn-primary" type="submit" name="edit" value="Update comment" id='submit'>
            </div>
        </form>
        <?php else : ?>
        <h4> <?php echo "comment does not exist :-("; ?> </h4>
        <?php endif; ?>
        <div> <a href="../index.php">
                <<< Home</a>
        </div>
    </div> <?php include('../Html/footer.php') ?>
</div>
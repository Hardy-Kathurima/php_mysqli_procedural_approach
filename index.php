<?php
include('Model/connection.php');
$select = "SELECT username,email,message ,id FROM user_details ORDER BY created_date DESC LIMIT 10";
$result = mysqli_query($conn, $select);
$comments = mysqli_fetch_all($result, MYSQLI_ASSOC);
mysqli_free_result($result);
mysqli_close($conn);
?>

<?php include('Html/header.php'); ?>

<div class="container">
    <div class="comments">
        <h1>Welcome To my page</h1>
        <a class="btn btn-primary mt-3 mb-3" href="View/add.php"> Add a comment </a>
        <?php if (count($comments) > 0) : ?>
        <?php foreach ($comments as $comment) : ?>
        <h4><?php echo htmlspecialchars($comment['username']); ?></h4>
        <p><?php echo htmlspecialchars($comment['message']); ?></p>
        <a href="View/details.php?id=<?php echo $comment['id']; ?>">Read more</a>
        <?php endforeach; ?>
        <?php else : ?>
        <?php echo 'no records found!'; ?>
        <?php endif; ?>
    </div>
    <?php include('Html/footer.php') ?>
</div>
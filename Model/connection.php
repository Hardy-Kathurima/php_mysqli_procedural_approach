<?php
$conn = mysqli_connect('localhost', 'Hardy', 'Test1234', 'user');
if (!$conn) {
	die('cannot connect to the database');
}
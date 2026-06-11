<?php

session_start();

$conn = new mysqli("localhost","root","","wellness_plate");

if($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}

$query_id = $_POST['query_id'];
$feedback = $_POST['feedback'];

$sql = "UPDATE queries SET feedback='$feedback' WHERE id='$query_id'";

$conn->query($sql);

header("Location: view_replies.php");
exit();

?>
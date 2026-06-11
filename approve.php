<?php

$conn = new mysqli("localhost","root","","wellness_plate");

if($conn->connect_error){
die("Connection failed: ".$conn->connect_error);
}

$id = $_GET['id'];

$conn->query("UPDATE nutritionists SET status='approved' WHERE id='$id'");

header("Location: verify_nutritionists.php");
exit();

?>
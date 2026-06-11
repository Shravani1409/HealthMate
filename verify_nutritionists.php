<?php
session_start();

if(!isset($_SESSION['admin'])){
header("Location: admin_login.php");
exit();
}

$conn = new mysqli("localhost","root","","wellness_plate");

if($conn->connect_error){
die("Connection failed: ".$conn->connect_error);
}

$sql="SELECT * FROM nutritionists WHERE status='pending'";
$result=$conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Verify Nutritionists</title>
<link rel="stylesheet" href="styles.css">
<style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Poppins', sans-serif;
            scroll-behavior: smooth;
        }
        body {
            background-color: #f4f4f4;
            color: #333;
        }
        header {
            background: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #2c3e50;
        }
        nav {
            display: flex;
            align-items: center;
            width: 100%;
            justify-content: space-between;
        }
        .nav-links {
            list-style: none;
            display: flex;
            gap: 20px;
        }
        .nav-links li {
            display: inline;
        }
        .nav-links a {
            text-decoration: none;
            color: #333;
            font-weight: bold;
        }
        .auth-buttons a {
            text-decoration: none;
            padding: 10px 15px;
            background: #27ae60;
            color: white;
            border-radius: 5px;
            margin-left: 10px;
        }
        #hero {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 40px;
            background: white;
        }
        .hero-content {
            max-width: 50%;
        }
        .hero-content h1 {
            font-size: 36px;
            font-weight: bold;
            color: #333;
        }
        .hero-content p {
            font-size: 18px;
            margin: 10px 0;
            color: #555;
        }
        .hero-content .btn {
            display: inline-block;
            margin-top: 20px;
            padding: 10px 20px;
            background: #27ae60;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-weight: bold;
        }
        .hero-content .btn:hover {
            background: #219150;
        }
        .hero-image {
            max-width: 45%;
            border-radius: 10px;
        }
        .section-container {
            padding: 40px;
            background: white;
            margin: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .section-item {
            padding: 20px;
            margin: 20px 0;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
        .stress-management {
            background: #ffcc80;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }
        .stress-management .text-content {
            max-width: 50%;
        }
        .stress-management img {
            max-width: 45%;
            border-radius: 10px;
        }
        .healthy-recipes {
            background: #81c784;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }
        .healthy-recipes .text-content {
            max-width: 50%;
        }
        .healthy-recipes img {
            max-width: 45%;
            border-radius: 10px;
        }
        .fitness-basics {
            background: #64b5f6;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 20px;
        }
        .fitness-basics .text-content {
            max-width: 50%;
        }
        .fitness-basics img {
            max-width: 45%;
            border-radius: 10px;
        }
        .life-essentials {
            background: #ba68c8;
        }
        .scroll-target {
            padding-top: 20px;
            transition: all 0.5s ease-in-out;
        }
        footer {
            text-align: center;
            padding: 20px;
            background: #2c3e50;
            color: white;
            margin-top: 40px;
        }
    </style>

</head>

<body>

<header>
<nav>
<div class="logo">HealthMate</div>
<ul class="nav-links">
<li><a href="admin_login.php">Admin Home</a></li>
</ul>
</nav>
</header>

<div style="max-width:900px;margin:60px auto;">

<h2 style="margin-bottom:30px;">Nutritionist Verification Requests</h2>

<?php

if($result->num_rows==0){
echo "<div style='background:white;padding:20px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);'>
No pending nutritionist registrations.
</div>";
}

while($row=$result->fetch_assoc()){
?>

<div style="background:white;padding:25px;margin-bottom:25px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);">

<h3 style="margin-bottom:10px;"><?php echo $row['name']; ?></h3>

<p><b>Qualification:</b> <?php echo $row['qualification']; ?></p>

<p><b>Experience:</b> <?php echo $row['experience']; ?> years</p>

<br>

<a href="../uploads/<?php echo $row['certificate']; ?>" target="_blank">
View Certificate
</a>
<br>

<a href="../uploads/<?php echo $row['id_proof']; ?>" target="_blank">
View ID Proof
</a>

<br><br>

<a href="approve.php?id=<?php echo $row['id']; ?>"
style="background:#27ae60;color:white;padding:10px 18px;border-radius:6px;text-decoration:none;">
Approve
</a>

</div>

<?php
}
?>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
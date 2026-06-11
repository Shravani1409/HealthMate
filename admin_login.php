<?php
session_start();

$error = "";

if(isset($_POST['login'])){

$username = $_POST['username'];
$password = $_POST['password'];

// Hardcoded admin credentials
if($username == "admin" && $password == "admin123"){

$_SESSION['admin'] = true;

// IMPORTANT: no echo before header
header("Location: verify_nutritionists.php");
exit();

}else{
$error = "Invalid admin login";
}

}
?>
<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Admin Login</title>
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
</nav>
</header>

<div style="max-width:500px;margin:60px auto;background:white;padding:30px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);">

<h2>Admin Login</h2>

<form method="POST">

<label>Username</label><br>
<input type="text" name="username" style="width:100%;padding:10px;margin-bottom:15px;"><br>

<label>Password</label><br>
<input type="password" name="password" style="width:100%;padding:10px;margin-bottom:15px;"><br>

<button name="login" style="background:#27ae60;color:white;padding:10px 20px;border:none;border-radius:5px;">
Login
</button>

</form>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
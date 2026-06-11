<?php
session_start();

$conn = new mysqli("localhost","root","","wellness_plate");

$error = "";

if(isset($_POST['login'])){

$email = $_POST['email'];
$password = $_POST['password'];

$sql="SELECT * FROM nutritionists
WHERE email='$email'
AND password='$password'
AND status='approved'";

$result=$conn->query($sql);

if($result->num_rows==1){

$row = $result->fetch_assoc();   // FETCH DATA

$_SESSION['nutritionist_id'] = $row['id'];
$_SESSION['nutritionist'] = $row['name'];

header("Location: nutritionist_dashboard.php");
exit();

}else{
$error = "Account not approved or wrong login.";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Nutritionist Login</title>
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
<style>

.login-container {
  max-width: 500px;
  margin: 60px auto;
  background: #ffffff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.login-container h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #2c3e50;
}

.login-container label {
  font-weight: 600;
  color: #34495e;
}

.login-container input {
  width: 100%;
  padding: 12px;
  margin-top: 6px;
  margin-bottom: 18px;
  border-radius: 8px;
  border: 1px solid #dcdde1;
  font-size: 14px;
  transition: border 0.3s ease, box-shadow 0.3s ease;
}

.login-container input:focus {
  border-color: #27ae60;
  box-shadow: 0 0 6px rgba(39, 174, 96, 0.2);
  outline: none;
}

.login-btn {
  width: 100%;
  padding: 12px;
  background: #27ae60;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.3s ease;
}

.login-btn:hover {
  background: #1e874b;
}

.error-message {
  background: #fdecea;
  color: #e74c3c;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 15px;
  text-align: center;
}

</style>
</head>

<body>

<header>
<nav>
<div class="logo">HealthMate</div>
<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="nutritionist_register.php">Register</a></li>
</ul>
</nav>
</header>

<div class="login-container">

<h2>Nutritionist Login</h2>

<?php if($error != ""){ ?>
<div class="error-message">
<?php echo $error; ?>
</div>
<?php } ?>

<form method="POST">

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<button name="login" class="login-btn">Login</button>

</form>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
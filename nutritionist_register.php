<?php
session_start();

$conn = new mysqli("localhost","root","","wellness_plate");

$message = "";

if(isset($_POST['register'])){

$name = $_POST['name'];
$email = $_POST['email'];
$password = $_POST['password'];
$qualification = $_POST['qualification'];
$experience = $_POST['experience'];

$certificate = $_FILES['certificate']['name'];
$idproof = $_FILES['idproof']['name'];

move_uploaded_file($_FILES['certificate']['tmp_name'],
"../uploads/".$certificate);

move_uploaded_file($_FILES['idproof']['tmp_name'],
"../uploads/".$idproof);

$sql="INSERT INTO nutritionists
(name,email,password,qualification,experience,certificate,id_proof,status)

VALUES
('$name','$email','$password','$qualification','$experience','$certificate','$idproof','pending')";

if($conn->query($sql)){
$message = "Registration submitted. Waiting for admin approval.";
}else{
$message = "Something went wrong. Please try again.";
}

}
?>

<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Nutritionist Registration</title>
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
<li><a href="index.html">Home</a></li>
<li><a href="nutritionist_login.php">Login</a></li>
</ul>
</nav>
</header>
<style>

  .register-container {
    max-width: 600px;
    margin: 50px auto;
    background: #ffffff;
    padding: 30px;
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
    transition: all 0.3s ease;
  }

  .register-container h2 {
    text-align: center;
    color: #2c3e50;
    margin-bottom: 25px;
  }

  .register-container label {
    font-weight: 600;
    color: #34495e;
  }

  .register-container input[type="text"],
  .register-container input[type="email"],
  .register-container input[type="password"],
  .register-container input[type="number"],
  .register-container input[type="file"] {
    width: 100%;
    padding: 12px;
    margin-top: 6px;
    margin-bottom: 18px;
    border-radius: 8px;
    border: 1px solid #dcdde1;
    font-size: 14px;
    transition: border 0.3s ease, box-shadow 0.3s ease;
  }

  .register-container input:focus {
    border-color: #27ae60;
    box-shadow: 0 0 6px rgba(39, 174, 96, 0.2);
    outline: none;
  }

  .register-btn {
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

  .register-btn:hover {
    background: #1e874b;
  }

  .success-message {
    background: #eafaf1;
    color: #27ae60;
    padding: 12px;
    border-radius: 8px;
    margin-bottom: 20px;
    text-align: center;
    font-weight: 500;
  }

</style>
<div class="register-container">

<h2>Become a Nutritionist</h2>

<?php if($message != ""){ ?>
<div class="success-message">
<?php echo $message; ?>
</div>
<?php } ?>

<form method="POST" enctype="multipart/form-data">

<label>Name</label>
<input type="text" name="name" required>

<label>Email</label>
<input type="email" name="email" required>

<label>Password</label>
<input type="password" name="password" required>

<label>Qualification</label>
<input type="text" name="qualification">

<label>Experience (years)</label>
<input type="number" name="experience">

<label>Upload Certificate</label>
<input type="file" name="certificate" required>

<label>Upload ID Proof</label>
<input type="file" name="idproof" required>

<button name="register" class="register-btn">
Register
</button>

</form>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
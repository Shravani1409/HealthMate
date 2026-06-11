<?php
session_start();

if(!isset($_SESSION['user'])){
header("Location: login_process.php");
exit();
}

$conn = new mysqli("localhost","root","","wellness_plate");

if($conn->connect_error){
die("Connection failed: " . $conn->connect_error);
}

$user_email = $_SESSION['user'];
$message = "";

/* -------------------------------------------------
   1️⃣ Get user_id from users table
---------------------------------------------------*/
$user_query = $conn->query("SELECT id FROM users WHERE email='$user_email'");
$user_row = $user_query->fetch_assoc();
$user_id = $user_row['id'];

/* -------------------------------------------------
   2️⃣ Fetch only approved nutritionists
---------------------------------------------------*/
$nutritionists = $conn->query("SELECT id, name FROM nutritionists WHERE status='approved'");

if(!$nutritionists){
die("Error fetching nutritionists: " . $conn->error);
}

/* -------------------------------------------------
   3️⃣ Handle Question Submit
---------------------------------------------------*/
if(isset($_POST['ask'])){
    $question = isset($_POST['question']) ? $_POST['question'] : '';
    $nutritionist_id = isset($_POST['nutritionist_id']) ? $_POST['nutritionist_id'] : '';
    $sql="INSERT INTO queries(user_email,nutritionist_id,question)
    VALUES('$user_email','$nutritionist_id','$question')";
    if($conn->query($sql)){
        $message = "Question sent successfully!";
    }
    else{
        $message = "Something went wrong. Please try again.";
    }
}   
?>
<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Ask Nutritionist</title>
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
<style>

.ask-container {
  max-width: 600px;
  margin: 60px auto;
  background: #ffffff;
  padding: 30px;
  border-radius: 12px;
  box-shadow: 0 4px 15px rgba(0, 0, 0, 0.08);
}

.ask-container h2 {
  text-align: center;
  margin-bottom: 25px;
  color: #2c3e50;
}

.ask-container textarea {
  width: 100%;
  padding: 14px;
  border-radius: 8px;
  border: 1px solid #dcdde1;
  font-size: 14px;
  resize: none;
  transition: border 0.3s ease, box-shadow 0.3s ease;
}

.ask-container textarea:focus {
  border-color: #27ae60;
  box-shadow: 0 0 6px rgba(39, 174, 96, 0.2);
  outline: none;
}

.ask-btn {
  width: 100%;
  padding: 12px;
  background: #27ae60;
  color: white;
  border: none;
  border-radius: 8px;
  font-size: 16px;
  font-weight: 600;
  cursor: pointer;
  margin-top: 20px;
  transition: background 0.3s ease;
}

.ask-btn:hover {
  background: #1e874b;
}

.success-message {
  background: #eafaf1;
  color: #27ae60;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 20px;
  text-align: center;
}

.error-message {
  background: #fdecea;
  color: #e74c3c;
  padding: 10px;
  border-radius: 8px;
  margin-bottom: 20px;
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
<li><a href="view_plan.php">My Plans</a></li>
</ul>
</nav>
</header>

<div class="ask-container">

<h2>Ask a Nutritionist</h2>

<?php if($message != ""){ ?>
<div class="<?php echo strpos($message, 'successfully') !== false ? 'success-message' : 'error-message'; ?>">
<?php echo $message; ?>
</div>
<?php } ?>

<form method="POST">

<select name="nutritionist_id" required style="width:100%;padding:12px;border-radius:8px;margin-bottom:15px;">
<option value="">Select Nutritionist</option>

<?php while($row = $nutritionists->fetch_assoc()){ ?>
<option value="<?php echo $row['id']; ?>">
Dr. <?php echo $row['name']; ?>
</option>
<?php } ?>

</select>

<textarea name="question" rows="5"
placeholder="Ask your health question here..." required></textarea>

<button name="ask" class="ask-btn">Send Question</button>
<div style="margin-top:20px;text-align:center;">
    <a href="view_replies.php"
    style="padding:12px 18px;background:#3498db;color:white;border-radius:8px;text-decoration:none;">
    View Replies
    </a>
</div>

</form>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
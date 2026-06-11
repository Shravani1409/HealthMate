<?php
session_start();

if(!isset($_SESSION['nutritionist'])){
header("Location: nutritionist_login.php");
exit();
}

$conn = new mysqli("localhost","root","","wellness_plate");

if($conn->connect_error){
die("Connection failed: ".$conn->connect_error);
}

/* HANDLE REPLY */
if(isset($_POST['send'])){
$id = $_POST['id'];
$reply = $_POST['reply'];

$conn->query("UPDATE queries SET reply='$reply', status='answered' WHERE id='$id'");
}
?>

<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Nutritionist Dashboard</title>
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
        .welcome-message{
            background:#e8f8f0;
            padding:15px;
            margin:25px auto;
            max-width:900px;
            border-radius:10px;
            font-size:18px;
            text-align:center;
            box-shadow:0 4px 12px rgba(0,0,0,0.08);
}   
        header {
            background: #fff;
            padding: 20px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .dashboard-title{
            font-size:18px;
            font-weight:600;
            color:#27ae60;
            text-align:center;
            flex-grow:1;
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
</head>

<body>
<div class="welcome-message">
Welcome, <strong>Dr. <?php echo htmlspecialchars($_SESSION['nutritionist']); ?></strong> 🩺
</div>
<header>
<nav>
<div class="logo">HealthMate</div>
<div class="dashboard-title">Your Dashboard</div>
<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="logout.php">Logout</a></li>
</ul>
</nav>
</header>

<div style="max-width:1000px;margin:60px auto;">

<!-- ================= USER QUESTIONS ================= -->

<h2 style="margin-bottom:30px;">User Questions</h2>

<?php
$nutritionist_id = $_SESSION['nutritionist_id'];

$sql = "SELECT * FROM queries WHERE nutritionist_id='$nutritionist_id'";
$result = $conn->query($sql);

if($result->num_rows == 0){
echo "<div style='background:white;padding:20px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);margin-bottom:30px;'>
No questions from users yet.
</div>";
}

while($row = $result->fetch_assoc()){
?>

<div style="background:white;padding:25px;margin-bottom:25px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);">

<p><b>User:</b> <?php echo $row['user_email']; ?></p>

<p><b>Question:</b><br><?php echo $row['question']; ?></p>
<?php if(!empty($row['feedback'])){ ?>

<div style="
margin-top:10px;
background:#f0f8ff;
padding:10px;
border-radius:6px;
">

<b>User Feedback:</b><br>
<?php echo $row['feedback']; ?>

</div>

<?php } ?>
<br>

<?php if(!empty($row['reply'])){ ?>

<p style="color:green;"><b>Your Reply:</b><br><?php echo $row['reply']; ?></p>

<?php } else { ?>

<form method="POST">

<input type="hidden" name="id" value="<?php echo $row['id']; ?>">

<textarea name="reply" rows="4" style="width:100%;padding:10px;border-radius:6px;"></textarea>

<br><br>

<button name="send" style="background:#27ae60;color:white;padding:10px 18px;border:none;border-radius:6px;">
Send Reply
</button>

</form>

<?php } ?>

</div>

<?php } ?>


<!-- ================= SAVED DIET PLANS ================= -->

<h2 style="margin:50px 0 30px;">User Saved Diet Plans</h2>

<?php
$sql2 = "SELECT diet_plans.*, users.name
FROM diet_plans
JOIN users ON diet_plans.user_id = users.id";

$result2 = $conn->query($sql2);

if($result2->num_rows == 0){
echo "<div style='background:white;padding:20px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);'>
No saved diet plans yet.
</div>";
}

while($row = $result2->fetch_assoc()){
?>

<div style="background:white;padding:25px;margin-bottom:25px;border-radius:10px;box-shadow:0 4px 15px rgba(0,0,0,0.1);">

<p><b>User:</b> <?php echo $row['name']; ?></p>
<p><b>Goal:</b> <?php echo $row['goal']; ?></p>
<p><b>Activity:</b> <?php echo $row['activity_level']; ?></p>
<p><b>Food Preference:</b> <?php echo $row['food_preference']; ?></p>

<br>

<p><b>Diet Plan:</b></p>

<div style="background:#f4f4f4;padding:15px;border-radius:8px;">
<?php echo $row['plan_html']; ?>
</div>

</div>

<?php } ?>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>

<?php
$conn->close();
?>
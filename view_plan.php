<?php
$planHTML = "";  // Always define first
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db = "wellness_plate";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

$planHTML = "";

// Check if user is logged in
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];

  // Get the latest diet plan for the logged-in user
  $stmt = $conn->prepare("SELECT plan_html FROM diet_plans WHERE user_id = ? ORDER BY id DESC LIMIT 1");
  $stmt->bind_param("i", $userId);
  $stmt->execute();
  $result = $stmt->get_result();

  if ($result && $row = $result->fetch_assoc()) {
    $planHTML = $row['plan_html'];
  } else {
    $planHTML = "<p>No diet plan saved yet.</p>";
  }

  $stmt->close();
} else {
  $planHTML = "<p>Please log in to view your diet plan.</p>";
}

$conn->close();
?>

<!DOCTYPE html>
<html>
<head>
  <title>HealthMate - Your Diet Plan</title>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background: #f4f4f4;
      color: #333;
    }

    header {
      background: #ffffff;
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
      width: 100%;
      display: flex;
      justify-content: space-between;
      align-items: center;
    }

    .nav-links {
      list-style: none;
      display: flex;
      gap: 20px;
    }

    .nav-links a {
      text-decoration: none;
      color: #333;
      font-weight: bold;
    }

    .nav-links a:hover {
      color: #27ae60;
    }

    .container {
      padding: 40px 20px;
    }

    .page-title {
      text-align: center;
      margin-bottom: 30px;
      font-size: 28px;
      color: #2c3e50;
    }

    #plans-container {
      background-color: #ffffff;
      border-radius: 12px;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      padding: 30px;
      max-width: 900px;
      margin: auto;
    }

    #plans-container h4 {
      color: #2c3e50;
      font-size: 1.5rem;
      border-bottom: 2px solid #27ae60;
      padding-bottom: 8px;
      margin-bottom: 16px;
    }

    #plans-container ul {
      list-style: none;
      padding: 0;
    }

    #plans-container li {
      background-color: #ecf0f1;
      margin: 10px 0;
      padding: 12px 15px;
      border-left: 5px solid #27ae60;
      border-radius: 8px;
    }

    #plans-container li:hover {
      background-color: #dfe6e9;
    }

    footer {
      text-align: center;
      padding: 20px;
      background: #2c3e50;
      color: white;
      margin-top: 50px;
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
      <li><a href="ask_nutritionist.php">Ask Nutritionist</a></li>
    </ul>
  </nav>
</header>

<div class="container">
  <h2 class="page-title">Your Personalized Diet Plan</h2>

  <div id="plans-container">
    <?php echo $planHTML; ?>
  </div>
</div>

<footer>
  <p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
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

$sql = "SELECT * FROM queries WHERE user_email='$user_email'";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
<title>HealthMate - Your Queries</title>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
background:#f4f4f4;
color:#333;
}

header{
background:#fff;
padding:20px;
display:flex;
justify-content:space-between;
align-items:center;
box-shadow:0 4px 6px rgba(0,0,0,0.1);
}

.logo{
font-size:24px;
font-weight:bold;
color:#2c3e50;
}

nav{
display:flex;
align-items:center;
width:100%;
justify-content:space-between;
}

.nav-links{
list-style:none;
display:flex;
gap:20px;
}

.nav-links a{
text-decoration:none;
color:#333;
font-weight:bold;
}

.container{
max-width:700px;
margin:60px auto;
}

.card{
background:white;
padding:25px;
margin-bottom:20px;
border-radius:12px;
box-shadow:0 4px 15px rgba(0,0,0,0.08);
}

.question{
font-weight:bold;
margin-bottom:10px;
}

.reply{
margin-top:10px;
padding:10px;
background:#eafaf1;
border-radius:8px;
color:#27ae60;
}

.waiting{
color:#999;
}

.feedback-box textarea{
width:100%;
padding:10px;
margin-top:10px;
border-radius:8px;
border:1px solid #ddd;
}

.feedback-btn{
margin-top:10px;
background:#27ae60;
color:white;
padding:8px 15px;
border:none;
border-radius:6px;
cursor:pointer;
}

footer{
text-align:center;
padding:20px;
background:#2c3e50;
color:white;
margin-top:40px;
}

</style>
</head>

<body>

<header>
<nav>
<div class="logo">HealthMate</div>

<ul class="nav-links">
<li><a href="index.php">Home</a></li>
<li><a href="ask_nutritionist.php">Ask Nutritionist</a></li>
</ul>

</nav>
</header>

<div class="container">

<h2 style="margin-bottom:25px;text-align:center;">Your Questions & Replies</h2>

<?php
if($result->num_rows==0){
echo "<div class='card'>You have not asked any questions yet.</div>";
}

while($row = $result->fetch_assoc()){
?>

<div class="card">

<div class="question">
Your Question:
</div>

<p><?php echo $row['question']; ?></p>

<?php if(!empty($row['reply'])){ ?>

<div class="reply">
<b>Nutritionist Reply:</b><br>
<?php echo $row['reply']; ?>
</div>

<div class="feedback-box">

<form method="POST" action="save_feedback.php">

<input type="hidden" name="query_id" value="<?php echo $row['id']; ?>">

<textarea name="feedback" placeholder="Give your feedback..." required></textarea>

<button class="feedback-btn">Submit Feedback</button>

</form>

</div>

<?php } else { ?>

<p class="waiting">Waiting for nutritionist reply...</p>

<?php } ?>

</div>

<?php } ?>

</div>

<footer>
<p>&copy; 2026 HealthMate. All Rights Reserved.</p>
</footer>

</body>
</html>
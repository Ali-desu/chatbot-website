<?php
//start session
session_start();
require_once 'dbconn.php';
require 'user.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'C:\xampp\htdocs\chatbot\PHPMailer-master\src\Exception.php';
require 'C:\xampp\htdocs\chatbot\PHPMailer-master\src\PHPMailer.php';
require 'C:\xampp\htdocs\chatbot\PHPMailer-master\src\SMTP.php';

function sendMail($to , $subject , $body){
    $mail = new PHPMailer(true);

    try {
        $mail->isSMTP();
        $mail->Host = 'localhost:4306';
        $mail->SMTPAuth = true;
        $mail->Username = 'root';
        $mail->Password = '';
        $mail->Port = 587;

        $mail->setFrom('aliadnani056@gmail.com', 'Ali');
        $mail->addAddress($to);
        $mail->Subject = $subject;
        $mail->Body = $body;

        $mail->send();
        return true; // Email sent successfully
    } catch (Exception $e) {
        return false; // Email sending failed
    }
}


// Function to generate a verification token
function generateVerificationToken() {
    return md5(uniqid(mt_rand(), true)); 
}

$email_err = $name_err = $pwd_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter your username.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate password
    if (empty(trim($_POST["pwd"]))) {
        $pwd_err = "Please enter a password.";
    } else {
        $pwd =md5(trim($_POST["pwd"]));
    }

    // If no errors, proceed with database insertion
    if (empty($email_err) && empty($name_err) && empty($pwd_err)) {
        //save infos in session
        $_SESSION['email'] = $email;

        // Create a new user object
        $user = new user($email, $name, $pwd, 0, 0, 0);
        $db = new connexion($servername, $username, $password, $dbname);

        $result = $db->insertUser($user);
        if($result){
            //redirect to homepage
            header("location: homepage.php");
        }
}
}
?>






<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>inscription</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>



<div class="login-box">
  <h2>Inscription</h2>
  <form action = "inscription.php" method="POST">
  <div class="user-box">
      <input type="email" name="email" required="">
      <label>Email</label>
        <span class = "error_msg" ><?php echo $email_err ?></span>
    </div>
    <div class="user-box">
      <input type="text" name="name" required="" value = <?php $name ?>>
      <label>Username</label>
      <span class = "error_msg" ><?php echo $name_err ?></span>
    </div>
    <div class="user-box">
      <input type="password" name="pwd" required="">
      <label>Password</label>
        <span class = "error_msg"  class = "error_msg"><?php echo $pwd_err ?></span>
    </div>
    <button href="#">
      <span></span>
      <span></span>
      <span></span>
      <span></span>
      Submit
</button>
    <p>already have an account ?<a href="login.php"> Login here</a>.</p>
  </form>
</div>

</body>
</html>
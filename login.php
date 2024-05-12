<?php

require_once 'dbconn.php';

$email_err = $pwd_err = "";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    

    // Validate email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter your email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate password
    if (empty(trim($_POST["pwd"]))) {
        $pwd_err = "Please enter a password.";
    } else {
        $pwd = md5(trim($_POST["pwd"])); 
    }

    // If no errors, proceed with database insertion
    if (empty($email_err) && empty($pwd_err)) {
        try{
            $db = new connexion($servername, $username, $password, $dbname);
            $result = $db->verifyUser($email, $pwd);
            if ($result) {
                echo " Login successful";
                //redirect to homepage
                header("location: homepage.php");
            } else {
                echo " Login failed";
            }
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    }

}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
<div class="login-box">
  <h2>Login</h2>
  <form action = "login.php" method="POST">
    <div class="user-box">
      <input type="email" name="email" required="" value = <?php $email ?>>
      <label>Email</label>
      <span class = "error_msg" ><?php echo $email_err ?></span>
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
  </form>
</div>
</body>
</html>
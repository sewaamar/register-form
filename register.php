<?php 
include "config.php";
session_start();
error_reporting(0);

if (isset($_SESSION['user,id'])) {
  header("location: welcome.php");
}

if (isset($_POST['submit'])){
  $fullname = mysqli_real_escape_string($conn,$_POST['singup_fullname']);
  $email = mysqli_real_escape_string($conn,$_POST['singup_email']);
  $password = mysqli_real_escape_string($conn,md5($_POST['singup_password']));
  $cpassword = mysqli_real_escape_string($conn,md5($_POST['singup_cpassword']));
  $token = bin2hex(random_bytes(15));

  $check_email = mysqli_num_rows(mysqli_query($conn, "SELECT email FROM users WHERE email ='$email'"));

 if ($password !== $cpassword) {
    ?>
    <script>
      alert('Password did not matched');
    </script>
    <?php
    }elseif($check_email > 0){
      ?>
    <script>
      alert('Email already exists');
    </script>
    <?php
    }else{
      $sql = "INSERT INTO users(full_name,email,password,token,status) VALUES('$fullname','$email','$password','$token','inactive')";
      $result = mysqli_query($conn,$sql);
      if ($result) {
        $_POST['singup_fullname'] = "";
        $_POST['singup_email'] = "";
        $_POST['singup_password'] = "";
        $_POST['singup_cpassword'] = "";
        
        $subject = "Email Activation";
        $body = "Hi, $username. Click here too activate your account 
                 http://localhost/New%20folder/activate.php?token=$token ";
        $sender = "From: vikash.kumar114260@gmail.com";
          if (mail($email,$subject,$body,$sender)) { 
              $_SESSION['msg'] = "check your mail to activate your account $email";
              header('location: register.php');
          }else{
            echo "Email sending failed...";
          }

      }else{
          ?>
          <script>
            alert('User Registration Failed');
          </script>
          <?php
      }
    }
 }

?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title></title>
  <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body>
	<div class="form">
  <h1>User Registration</h1>
  <form method="POST">
    <div class="form-item">
      <input type="text" name="singup_fullname" <?php $_POST["singup_fullname"]; ?> required>
      <label>Username</label>
    </div>

    <div class="form-item">
      <input type="email"  name="singup_email" <?php $_POST["singup_email"]; ?> required>
      <label>Email</label>
    </div>

    <div class="form-item">
      <input type="password"  name="singup_password" <?php $_POST["singup_password"]; ?> required>
      <label>Password</label>
    </div>
    <div class="form-item">
      <input type="password"  name="singup_cpassword" <?php $_POST["singup_cpassword"]; ?> required>
      <label>Confirm Password</label>
    </div>
      <p style="margin-left: 20px;">Have an account?   <input type="submit" class="btn"  name="submit" value="Register">
      <a href="index.php" class="btn">Log In</a></p>

  </form>


</div>
</body>
</html>
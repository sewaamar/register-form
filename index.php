<?php 
include "config.php";
session_start();
error_reporting(0);

if (isset($_POST['submit'])){
  $email = mysqli_real_escape_string($conn,$_POST['email']);
  $password = mysqli_real_escape_string($conn,md5($_POST['password']));
  $check_email = mysqli_query($conn, "SELECT id FROM users WHERE email ='$email' AND password='$password'");
  
  if (mysqli_num_rows($check_email) > 0){
    $row =mysqli_fetch_assoc($check_email);
    $_SESSION['user,id'] = $row['id'];
    header("location: welcome.php");
  }else{
    ?>
    <script>
      alert('Login details is incorrect. Please try again.');
    </script>
    <?php
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
	<form method="POST">
  <h1>User Log In</h1>
  <div class="form-item">
    <input type="text" name="email" value="<?php echo $_POST['email']; ?>" required>
    <label>Username</label>
  </div>

  <div class="form-item">
    <input type="password"  name="password" value="<?php echo $_POST['password']; ?>" required>
    <label>Password</label>
  </div>
  <p style="margin-left: 20px;">Have an account?   <input type="submit" class="btn"  name="submit" value="Log In">
      <a href="index.php" class="btn">Register</a></p>
</form>
</div>
  

</body>
</html>
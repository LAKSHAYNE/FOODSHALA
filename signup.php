<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
include "navbar.php";
?>
<?php
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    $cpass=$_POST['cpass'];
    $user_type=$_POST['type-user'];
    if(!$email or !$pass){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Invalid email or password.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    else if($cpass!=$pass){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Password doesn't Match.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    else{
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
        <strong>Registered.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
        $hash=password_hash($pass, PASSWORD_DEFAULT);
        $sql="INSERT INTO `users` (`Sno`, `email`, `password`,`user_type`, `timestamp`) VALUES (NULL, '$email', '$hash', '$user_type',current_timestamp())";
        $result=mysqli_query($conn, $sql);
        header("Location:/lakshay/login.php");
        exit;
    }
}
?>
<div style="margin-top:20px; display:flex; flex-direction:column; justify-Content:center; align-items:center;">
<h1>Register</h1>
<form action="/lakshay/signup.php" method="Post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name='pass' id="password">
  </div>
  <div class="mb-3">
    <label for="cpassword" class="form-label">Confirm Password</label>
    <input type="password" class="form-control" name='cpass' id="password">
  </div>
  <div class="mb-3">
  <label for="type-user" class="form-label">User Type</label>
  <select name="type-user" class="form-select" aria-label="Default select example">
    <option selected value="Customer">Customer</option>
    <option value="Restaurant">Restaurant</option>
    <option value="Admin">Admin</option>
  </select>
</div>
  <button type="submit" class="btn btn-primary">Register</button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
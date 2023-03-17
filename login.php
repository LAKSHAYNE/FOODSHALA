<?php
    $login = false;
    $showError = false;
if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $email=$_POST['email'];
    $pass=$_POST['pass'];
    if(!$email or !$pass){
        echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
        <strong>Invalid email or password.
        <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
      </div>";
    }
    else{
        $sql="SELECT * from users WHERE email='$email'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);
        if ($num == 1){
            while($row=mysqli_fetch_assoc($result)){
                if (password_verify($pass, $row['password'])){ 
                    $login = true;
                    session_start();
                    $_SESSION['loggedin'] = true;
                    $_SESSION['email'] = $email;
                    $_SESSION['user_id'] = $row['Sno'];
                    $_SESSION['user_type'] = $row['user_type'];
                    //echo var_dump($_SESSION['loggedin']);
                    header("Location:/lakshay/restaurants.php");
                    exit;
                } 
                else{
                    $showError = "Invalid Credentials";
                }
            }  
    } 
    else{
        $showError = "Invalid Credentials";
    }
}
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
</head>
<body>
<?php
include "navbar.php";
?>
<?php
    if($login){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> You are logged in
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div> ';
    }
    if($showError){
    echo "<div class='alert alert-danger alert-dismissible fade show' role='alert'>
    <strong>Error!! ".$showError."
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
  </div>";
    }
    ?>
<div style="margin-top:20px; display:flex; flex-direction:column; justify-Content:center; align-items:center;">
<h1>LOGIN</h1>
<form action="/lakshay/login.php" method="Post">
  <div class="mb-3">
    <label for="exampleInputEmail1" class="form-label">Email address</label>
    <input type="email" name='email' class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
    <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
  </div>
  <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input type="password" class="form-control" name='pass' id="password">
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
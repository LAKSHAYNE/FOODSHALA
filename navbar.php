<?php
error_reporting(E_ALL ^ E_NOTICE);
session_start();
//echo var_dump($_SESSION);
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  //echo var_dump($loggedin);
}
else{
  $loggedin = false;
  //echo var_dump($loggedin);
}
if(!$loggedin){
    echo '<nav style="margin-bottom:20px;" class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/lakshay/restaurants.php">Foodshala</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/lakshay/login.php">SignIn</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/lakshay/Signup.php">Signup</a>
          </li>
        </ul>
      </div>
    </div>
    </nav>';
}
    else{
        echo '<nav style="margin-bottom:20px;" class="navbar navbar-expand-lg bg-body-tertiary" data-bs-theme="dark">
    <div class="container-fluid">
      <a class="navbar-brand" href="/lakshay/restaurants.php">Foodshala</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="/lakshay/Logout.php">Logout</a>
          </li>';
          if(isset($_SESSION["user_type"]) && $_SESSION["user_type"]=="Customer" || $_SESSION["user_type"]=="Admin"){
            echo
            '<li class="nav-item">
              <a class="nav-link active" aria-current="page" href="/lakshay/cart.php">Cart</a>
            </li>';
          }
        echo'</ul>
      </div>
    </div>
    </nav>';
    }

?>
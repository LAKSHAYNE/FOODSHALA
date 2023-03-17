<?php
session_start();
//echo var_dump($_SESSION);
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  if($_SERVER['REQUEST_METHOD']=='POST'){
    include 'dbconnect.php';
    $restname=$_POST['rest_name'];
    $restadd=$_POST['rest_add'];
    $sql="INSERT INTO `restaurants` (`rest_id`, `rest_name`, `address`, `timestamp`) VALUES (NULL, '$restname', '$restadd', current_timestamp())";
    $result = mysqli_query($conn, $sql);
  }
  //echo var_dump($loggedin);
}
else{
  $loggedin = false;
  //header("Location:/lakshay/login.php");
  //echo var_dump($loggedin);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Restaurants</title>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>
    <?php
    session_start();
    if(isset($_SESSION['user_type']) && $_SESSION['user_type']=="Admin"){
        echo
        '<div style="padding:20px;">
        <form action="/lakshay/restaurants.php" method="post">
            <div class="mb-3">
                <label for="rest_name" class="form-label">Restaurant Name</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="rest_name">
            </div>
            <div class="mb-3">
                <label for="rest_add" class="form-label">Address</label>
                <input type="text" class="form-control" name="rest_add" id="rest_add">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
        </div>';
    }
    ?>
    <div style="text-align:center;">
    <table class="table caption-top table-responsive">
    <h3>List of Restaurants</h3>
    <thead>
      <tr>
        <th scope="col">Sno</th>
        <th scope="col">Name</th>
        <th scope="col">Address</th>
      </tr>
    </thead>
    <tbody>
        <?php
        include 'dbconnect.php';
        $sql="SELECT * from restaurants";
        $result1 = mysqli_query($conn, $sql);
        $i=0;
        foreach($result1 as $item){
            $i=$i+1;
            echo '<tr>
            <th scope="row">'.$i.'</th>
            <td><a href="/lakshay/menu.php?restaurant='.$item["rest_id"].'">'.$item["rest_name"].'</td>
            <td>'.$item['address'].'</td>
        </tr>';
        }  
        ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
<!-- INSERT INTO `orders` (`order_id`, `user_id`, `item`, `price`, `timestamp`) VALUES (NULL, '3', 'chilli potato', '120', current_timestamp()); -->

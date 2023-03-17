<?php
session_start();
//echo var_dump($_SESSION);
if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
  $loggedin= true;
  include 'dbconnect.php';
  if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['form_button'])){
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $rest_id=$queries['restaurant'];
        $dish=$_POST['dish'];
        $type=$_POST['type'];
        $price=$_POST['price'];
        //echo var_dump($_POST);
        $sql="INSERT INTO `menu` (`sno`, `rest_id`, `dish`, `type`, `price`, `timestamp`) VALUES (NULL, '$rest_id', '$dish', '$type', '$price', current_timestamp());";
        $result = mysqli_query($conn, $sql);
    }
    
    if(isset($_POST['order_button'])){
        if(isset($_SESSION['user_id']) && $_SESSION['user_type']=='Customer' || $_SESSION['user_type']=='Admin'){
            $userId=$_SESSION['user_id'];
            $dish=$_POST['dish'];
            $price=$_POST['price'];
            $type=$_POST['type'];
            //echo var_dump($_POST);
            $sql="INSERT INTO `orders` (`order_id`, `user_id`, `item`, `price`,`type`, `timestamp`) VALUES (NULL, '$userId', '$dish', '$price', '$type',current_timestamp())";        
            $result = mysqli_query($conn, $sql);
        }
        else{
            header("Location:/lakshay/login.php");
        }
    }
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
    <title>Menu</title>
</head>
<body>
<?php
    include 'navbar.php';
    ?>
    <?php
    //echo var_dump($_SESSION['user_type']);
    if(isset($_SESSION['user_type']) && ($_SESSION['user_type']=="Restaurant" || $_SESSION['user_type']=="Admin")){
        $queries = array();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $rest_id=$queries['restaurant'];
        echo
        '<div style="padding:20px;">
        <form action="/lakshay/menu.php?restaurant='.$rest_id.'" method="post">
            <div class="mb-3">
                <label for="Dish" class="form-label">Dish</label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="dish">
            </div>
            <div class="mb-3">
                <label for="Type" class="form-label">Type</label>
                <input type="text" class="form-control" name="type" id="type">
            </div>
            <div class="mb-3">
                <label for="Type" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" >
            </div>
            <button name="form_button" type="submit" class="btn btn-primary">Submit</button>
        </form>
    </div>';
    }
    ?>
    <div style="text-align:center;">
    <table class="table caption-top table-responsive">
        <h3>Menu</h2>
    <thead>
      <tr>
        <th scope="col">Sno</th>
        <th scope="col">Dish</th>
        <th scope="col">Type</th>
        <th scope="col">Price</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        <?php
        include 'dbconnect.php';
        $queries = array();
        session_start();
        parse_str($_SERVER['QUERY_STRING'], $queries);
        $rest_id=$queries['restaurant'];
        $sql="SELECT * from menu where rest_id='$rest_id'";
        $result1 = mysqli_query($conn, $sql);
        $i=0;
        $disabled=true;
        //$nottLogin=true;
        //echo var_dump($_SESSION['user_type']);
        if(!isset($_SESSION['user_type'])){
            echo "<h5 style='color:red;'>PLEASE LOGIN TO PLACE YOUR ORDER</h5>";
        }
        if(isset($_SESSION['user_type']) && ($_SESSION['user_type']=="Customer" or $_SESSION['user_type']=="Admin")){
            $disabled=false;
        }

        foreach($result1 as $item){
            $i=$i+1;
            echo '
            <form action="/lakshay/menu.php?restaurant='.$rest_id.'" method="post">
            <tr>
            <th scope="row">'.$i.'</th>
            <td><input type="hidden" name="dish" value="'.$item["dish"].'">'.$item["dish"].'</td>
            <td><input type="hidden" name="price" value='.$item["price"].'>'.$item["price"].'</td>
            <td><input type="hidden" name="type" value='.$item["type"].'>'.$item["type"].'</td>';
            if($disabled){
                echo '<td><button disabled name="order_button" type="submit" class="btn btn-primary">Order</button><td>';
            }
            else{
                echo '<td><button name="order_button" type="submit" class="btn btn-primary">Order</button><td>';
            }
        echo '</tr>
        </form>';
        }  
        ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
</body>
</html>
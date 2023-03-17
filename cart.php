<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <title>Cart</title>
</head>
<body>
    <?php
    include 'navbar.php';
    ?>
<div style="text-align:center;">
    <table class="table caption-top table-responsive">
    <h3>Your Cart</h3>
    <thead>
      <tr>
        <th scope="col">Sno</th>
        <th scope="col">Item</th>
        <th scope="col">Type</th>
        <th scope="col">Price</th>
      </tr>
    </thead>
    <tbody>
        <?php
        include 'dbconnect.php';
        $total=0;
        session_start();
        $user_id=$_SESSION['user_id'];
        $i=0;
        $sql="SELECT * from orders where user_id='$user_id'";
        $result1 = mysqli_query($conn, $sql);
        //echo var_dump($result1);
        //echo var_dump($user_id);
        foreach($result1 as $item){
            $i=$i+1;
            $total=$total+$item['price'];
            echo '<tr>
            <th scope="row">'.$i.'</th>
            <td>'.$item["item"].'</td>
            <td>'.$item["type"].'</td>
            <td>'.$item["price"].'</td>
        </tr>';
        }  
        echo'
        <tr>
            <th scope="row"></th>
            <td>-</td>
            <th>TOTAL</th>
            <td>'.$total.'</td>
        </tr>';
        ?>
    </tbody>
  </table>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>   
</body>
</html>
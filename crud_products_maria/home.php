<?php
session_start();
require_once 'components/db_connect.php';

// if admin will redirect to dashboard
if (isset($_SESSION['admin'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['admin']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$resUser = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$rowUser = mysqli_fetch_array($resUser, MYSQLI_ASSOC);

$sql = "SELECT * FROM products";
$result = mysqli_query($connect ,$sql);
$tbody=''; //this variable will hold the body for the table
if(mysqli_num_rows($result)  > 0) {     
     while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){         
        $tbody .= "<tr>
            <td><img class='img-thumbnail' height='100px' src='pictures/" .$row['picture']."'</td>
            
            <td>" .$row['name']."</td>
            <td>" .$row['price']."</td>
            <td><a href='/update.php?id=" .$row['id']."'><button class='btn btn-info btn-sm' type='button'>Detail</button></a></td>
         </tr>";
     };
} else  {
    $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
}

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Welcome - <?php echo $rowUser['first_name']; ?></title>
        <?php require_once 'components/boot.php'?>
        <link rel='stylesheet' type='text/css' href='styles.css'>
    </head>
    <body>
        <?php include 'navbar.php' ?>
        <div class="container w-75 mt-3">
            <div class="hero">
                <img class="userImage img-thumbnail" src="pictures/<?php echo $rowUser['picture']; ?>" alt="<?php echo $rowUser['first_name']; ?>">
                <span class="text-white" >Hi <?php echo $rowUser['first_name']; ?>.</span>
            </div>
            <div>
            <div class="manageProduct">    
                <p class='h2'>Products</p>
                
                <table class='table table-striped'>
                    <thead class='table-success'>
                        <tr class="text-start">
                            <th>Picture</th>
                            <th>Name</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?= $tbody; ?>
                    </tbody>
                </table>
            </div>
        </table>
        </div>
    </body>
</html>
<?php
session_start();
require_once 'components/db_connect.php';

// if adm will redirect to dashboard
if (isset($_SESSION['adm'])) {
    header("Location: dashboard.php");
    exit;
}
// if session is not set this will redirect to login page
if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: index.php");
    exit;
}

// select logged-in users details - procedural style
$res = mysqli_query($connect, "SELECT * FROM user WHERE id=" . $_SESSION['user']);
$row = mysqli_fetch_array($res, MYSQLI_ASSOC);

// select product  details
$res2 = mysqli_query($connect, "SELECT * FROM products");
$row2 = mysqli_fetch_all($res2, MYSQLI_ASSOC);

$resultSup = mysqli_query($connect, "SELECT * FROM supplier");
$row3 = $resultSup->fetch_all(MYSQLI_ASSOC);

$connect->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome - <?php echo $row['first_name']; ?></title>
    <?php require_once 'components/boot.php' ?>
    <style>
        .userImage {
            width: 200px;
            height: 200px;
        }

        .hero {
            background: rgb(2, 0, 36);
            background: linear-gradient(24deg, rgba(2, 0, 36, 1) 0%, rgba(0, 212, 255, 1) 100%);
        }
    </style>
</head>

<body>
    <?php include 'navbar.php' ?>

    <div class="container d-flex flex-wrap p-2">
        <?php

        $i = 0;
        while ($i < count($row2)) {

            $row2[$i]['sup_name'] = '';
            $j = 0;
            while ($j < count($row3)) {

                if ($row3[$j]['supplierId'] == $row2[$i]['fk_supplierId']) {
                    $row2[$i]['sup_name'] = $row3[$j]['sup_name'];
                }

                $j++;
            }


            echo "<div class='card m-2 border' style='width: 12rem;'>
                    <img src='pictures/" . $row2[$i]['picture'] . "' class='card-img-top' height=70%>
                    <div class='card-body d-flex flex-column'>
                        <h5 class='card-title'>" . $row2[$i]['name'] . "</h5>
                        <p class='card-text'>" . $row2[$i]['info'] . "</p>
                        <p class='card-text'>€ " . $row2[$i]['price'] . "</p>
                        <p class='card-text'>From: " . $row2[$i]['sup_name'] . "</p>
                        <a href='#' class='btn btn-primary'>Order</a>                        
                    </div>
                </div>";

            $i++;
        }
        ?>

    </div>

</body>

</html>
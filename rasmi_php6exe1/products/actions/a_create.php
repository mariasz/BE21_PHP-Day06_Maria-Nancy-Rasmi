<?php
session_start();

if (isset($_SESSION['user']) != "") {
    header("Location: ../../home.php");
    exit;
}

if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
    header("Location: ../../index.php");
    exit;
}

require_once '../../components/db_connect.php';
require_once '../../components/file_upload.php';

if ($_POST) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $info = $_POST['info'];
    $supplier = $_POST['supplier'];
    $uploadError = '';
    //this function exists in the service file upload.
    $picture = file_upload($_FILES['picture'], 'product');

    if ($supplier == 'none') {
        //checks if the supplier is undefined and insert null in the DB
        $sql = "INSERT INTO products (name, price, info, picture, fk_supplierId) VALUES ('$name', $price,'$info', '$picture->fileName', null)";
    } else {
        $sql = "INSERT INTO products (name, price, info, picture, fk_supplierId) VALUES ('$name', $price, '$info','$picture->fileName', $supplier)";
    }
    if ($connect->query($sql) === true) {

        $class = "success";
        $message = "The entry below was successfully created <br>
                        <table class='table w-50'><tr>
                        <td>Name:  $name <br>
                        Price: $price <br>
                        Info: $info</td>
                        </tr></table><hr>
                        ";
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    } else {
        $class = "danger";
        $message = "Error while creating record. Try again: <br>" . $connect->error;
        $uploadError = ($picture->error != 0) ? $picture->ErrorMessage : '';
    }
    $connect->close();
} else {
    header("location: ../error.php");
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Update</title>
    <?php require_once '../../components/boot.php' ?>
</head>

<body>
    <div class="container">
        <div class="mt-3 mb-3">
            <h1>Create request response</h1>
        </div>
        <div class="alert alert-<?= $class; ?>" role="alert">
            <p><?php echo ($message) ?? ''; ?></p>
            <p><?php echo ($uploadError) ?? ''; ?></p>
            <a href='../index.php'><button class="btn btn-primary" type='button'>Home</button></a>
        </div>
    </div>
</body>

</html>
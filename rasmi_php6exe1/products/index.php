 <?php
    session_start();
    require_once '../components/db_connect.php';


    if (isset($_SESSION['user']) != "") {
        header("Location: ../home.php");
        exit;
    }

    if (!isset($_SESSION['adm']) && !isset($_SESSION['user'])) {
        header("Location: ../index.php");
        exit;
    }

    $sql = "SELECT * FROM products";
    $result = mysqli_query($connect, $sql);
    $tbody = ''; //this variable will hold the body for the table
    if (mysqli_num_rows($result)  > 0) {
        while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $tbody .= "<tr>
            <td class='text-center'><img class='img-thumbnail' src='../pictures/" . $row['picture'] . "'</td>
            <td >" . $row['name'] . "</td>
            <td >" . $row['info'] . "</td>
            <td class='text-center'>" . $row['price'] . "</td>
            <td><a href='update.php?id=" . $row['id'] . "'><button class='btn btn-primary btn-sm' type='button'>Edit</button></a>
            <a href='delete.php?id=" . $row['id'] . "'><button class='btn btn-danger btn-sm' type='button'>Delete</button></a></td>
         </tr>";
        };
    } else {
        $tbody =  "<tr><td colspan='5'><center>No Data Available </center></td></tr>";
    }

    $connect->close();


    ?>

 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>PHP CRUD</title>
     <?php require_once '../components/boot.php' ?>
     <style type="text/css">
         .manageProduct {
             margin: auto;
         }

         .img-thumbnail {
             width: 70px !important;
             height: 70px !important;
         }

         td {
             text-align: left;
             vertical-align: middle;
         }

         tr {
             text-align: center;
         }

         .userImage {
             width: 100px;
             height: auto;
         }
     </style>
 </head>

 </head>

 <body>
     <div class="container">
         <div class="row">
             <div class="col-2">
                 <img class="userImage" src="../pictures/admavatar.png" alt="Adm avatar">
                 <p class="">Administrator</p>
                 <a href="../dashBoard.php">User List</a><br>
                 <a href="#">&#8226 Product List</a><br>
                 <a href="logout.php?logout">Sign Out</a>
             </div>
             <div class="col-8 mt-2">
                 <p class='h2'>Product Management <a href="create.php"><button class='btn btn-primary' type="button">Add Product</button></a></p>
                 <table class='table table-striped'>
                     <thead class='table-success'>
                         <tr>
                             <th>Picture</th>
                             <th text-align: 'left'>Name</th>
                             <th text-align: 'left'>Info</th>
                             <th>Price</th>
                             <th>Action</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?= $tbody ?>
                     </tbody>
                 </table>
             </div>
         </div>
     </div>


 </body>

 </html>
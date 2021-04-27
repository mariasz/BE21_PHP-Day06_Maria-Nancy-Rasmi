<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #769c8b;">
<div class="container">
    <a class="navbar-brand" href="/php/06_php-exercises/crud_products/home.php">Products</a>
    
    <ul class="navbar-nav ml-3">
        <?php
            $isAdmin = false;
            $currentUser = "";
            if (isset($_SESSION['user']) != "") {
                $currentUser = $_SESSION['user'];
            }
            if (isset($_SESSION['admin']) != "") {
                $currentUser = $_SESSION['admin'];   
                $isAdmin = true; 
            }
            
            $menuItems = "";
            if ($currentUser != "") {
                $menuItems = "<li class='nav-item active'>
                                    <a class='navbar-brand' href='/php/06_php-exercises/crud_products/home.php'>Home</a>
                                </li>";
                if ($isAdmin) {
                    $menuItems .= "<li class='nav-item'>
                                    <a class='navbar-brand' href='/php/06_php-exercises/crud_products/products/index.php'>Products</a>
                                        </li>
                                    <li class='nav-item'>
                                        <a class='navbar-brand' href='/php/06_php-exercises/crud_products/dashboard.php'>Manage User</a>
                                    </li>";
                }
                $menuItems .= "<li class='nav-item'>
                                    <a class='navbar-brand' href='/php/06_php-exercises/crud_products/update.php?id=".$currentUser."'>Profile</a>
                                </li>
                                
                                <li class='nav-item'>
                                    <div class='text-white' >ID: ".$currentUser."</div>
                                    <a href='/php/06_php-exercises/crud_products/logout.php?logout'>Sign Out</a>
                                </li>";                                    
            }
            // var_dump($_SESSION) //=> array(1) { ["user"]=> int(2) }
            //<div class='text-white' >Hi ".$rowUser['first_name']."</div>
            /*
            <li>
                <img class='userImage img-thumbnail' src='/php/06_php-exercises/crud_products/pictures/".$rowUser['picture']." alt='".$rowUser['first_name'].";>
            </li>
            */
            
            echo $menuItems;
        ?>
    </ul>
    </div>
</nav>
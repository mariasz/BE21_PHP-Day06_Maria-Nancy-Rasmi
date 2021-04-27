<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #769c8b;">
<div class="container">
    <a class="navbar-brand" href="/php/06_php-exercises/BE21_PHP-Day06_Maria-Nancy-Rasmi/crud_products_maria/home.php">Products</a>
    
    <ul class="navbar-nav ml-3">
        <?php
            $base_path = "/php/06_php-exercises/BE21_PHP-Day06_Maria-Nancy-Rasmi/crud_products_maria/";
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
                $menuItems = "<li class='nav-item'>
                                    <a class='navbar-brand' href='".$base_path."home.php'>Home</a>
                                </li>";
                if ($isAdmin) {
                    $menuItems .= "<li class='nav-item'>
                                        <a class='navbar-brand' href='".$base_path."products/index.php'>Products</a>
                                    </li>
                                    <li class='nav-item'>
                                        <a class='navbar-brand' href='".$base_path."dashboard.php'>Manage User</a>
                                    </li>";
                }
                $menuItems .= "<li class='nav-item'>
                                    <a class='navbar-brand' href='".$base_path."update.php?id=".$currentUser."'>
                                        ".$_SESSION['first_name']."'s Profile        
                                        <img class='img-thumbnail rounded-circle menu-avatar' src='".$base_path."pictures/".$_SESSION['picture']."' alt='".$_SESSION['first_name'].";>
                                            
                                    </a>
                                </li>
                                <li class='nav-item'>
                                    <a href='".$base_path."logout.php?logout'>Sign Out</a>
                                </li>";                                    
            }
            
            echo $menuItems;
        ?>
    </ul>
    </div>
</nav>
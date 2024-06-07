<?php
ob_start();
require('connectioninc.php');
require('functionsinc.php');
require('add_to_cart_inc.php');
$cat_res= mysqli_query($con,"SELECT * FROM categories WHERE status=1 ORDER BY categories ASC");
$cat_arr= array();
while($row=mysqli_fetch_assoc($cat_res)){
    $cat_arr[] = $row;
}
$obj=new add_to_cart();
$totalProduct=$obj->totalProduct();
ob_end_flush();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Toy Mart</title>

    <link rel="stylesheet" href="plugins/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css"
        integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/contact.css">
    <link rel="stylesheet" href="css/login.css">
    <link rel="stylesheet" href="plugins/owlcarousel/assets/owl.carousel.min.css">
    <link rel="stylesheet" href="plugins/owlcarousel/assets/owl.theme.default.min.css">

    <style>
          .badge:after{
        content:attr(value);
        font-size:16px;
        color: #fff;
        background: red;
        border-radius:50%;
        padding: 0 5px;
        position:relative;
        left:-8px;
        top:-10px;
        opacity:0.9;
        }

        .navbar .hide-dropdown .dropdown-toggle::after {
	        display: none;
        }

        .user_hover:hover{
            color: #eb4d4b;
            size: 28px;
        }
        .navbar .collapse .nav-item .user_hover a:hover{
            color: #eb4d4b;
        }
        .navbar .collapse .nav-item a:hover{
            color: #eb4d4b;
            
        }
       
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-light py-3 fixed-top">
        <div class="container">
            <a class="navbar-brand logo" href="index.php"><i class="fas fa-shopping-cart"></i> Toy
                <span>Mart</span></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span><i id="bar" class="fas fa-bars"></i></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <?php
                    foreach($cat_arr as $list){
                        ?>
                        <li class="nav-item">
                        <a class="nav-link" href="categories.php?id=<?php echo $list['id']?>"><?php echo $list['categories']?></a>
                        </li>
                        <?php
                    }
                    ?>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a href="cart.php"><i class="fa badge fa-lg htc_qua" style="color:black;" value=<?php echo $totalProduct?>>&#xf07a;</i></a>
                    </li>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown hide-dropdown">
                        <a style="padding: 0 5px!important" class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="icons/person.svg" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <?php
                            ob_start();
                            if(isset($_SESSION['USER_LOGIN'])){ ?>
                                <li style="text-align: center;"><a style="text-decoration: none;" href="my_order.php">My Order</a></li><hr style="width: 100%; height: 1px !important; background-color: #000;" class="dropdown-divider"></li>
                                <li style="text-align: center;"><a style="text-decoration: none;" href="user_profile.php">Profile</a></li><hr style="width: 100%; height: 1px !important; background-color: #000;" class="dropdown-divider"></li>
                                <li style="text-align: center;"><a style="text-decoration: none;" href="logout.php">Logout</a></li><li>
                            <?php
                            }else{ ?>
                                <li class="user_hover" style="text-align: center;"><a style="text-decoration: none;" href="login_page.php">Login</a></li>
                            <?php
                            }
                            ob_end_flush();
                            ?>
                        </ul>
                    </li>
                    </ul>
                    <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown hide-dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="icons/search.svg" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" style="background: transparent; border: none;">
                            <li style="width: 350px;">
                            <form action="search.php" method="get" class="input-group mb-3 search">
                                <input type="text" name="str" class="form-control" placeholder="Search toys..." style="width: 80%;" aria-label="Search" autocomplete="off" aria-describedby="button-addon2">
                                <button style="padding: 5px 10px; background: grey; border: none;" type="submit" id="button-addon2"><img src="icons/search.svg" alt=""></button>
                            </form>
                            </li>
                        </ul>
                    </li>
                    </ul>
            </div>
        </div>
    </nav>
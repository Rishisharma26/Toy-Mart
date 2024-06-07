<style>
    .navbar-dark .navbar-nav .nav-link a:hover{
        color: orangered;
    }
</style>
<?php

require('connectioninc.php');
require('functionsinc.php');
if(isset($_SESSION['ADMIN_LOGIN']) && $_SESSION['ADMIN_LOGIN']!=''){

}
else{
    header('location:login.php');
    die();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/bootstrap.min.css">
    <link rel="stylesheet" href="style2.css">
    <title>Dashboard</title>
</head>

<body>
    <!-- navbar starts -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
        <div class="container-fluid">
            <!-- off canvas-trigger -->
            <button class="navbar-toggler me-2" type="button" data-bs-toggle="offcanvas"
                data-bs-target="#offcanvasExample" aria-controls="offcanvasExample">
                <span class="navbar-toggler-icon" data-bs-target="#offcanvasExample"></span>
            </button>
            <!-- off canvas-trigger -->
            <a class="navbar-brand fw-bold me-auto" href="#" style="color: #0db8de;">Toy Mart</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <form class="d-flex ms-auto">
                </form>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="icons/person-fill.svg" alt="">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-dark">
                            <li><a href="logout.php" style="text-decoration:none"><button class="dropdown-item" type="button" style="color: #0db8de;">
                                    <img src="icons/power.svg" alt=""> Logout</button></a></li>
                        </ul>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
    <!-- navbar ends -->

    <!-- offcanvas start -->
    <div class="offcanvas offcanvas-start sidebar-nav bg-dark text-white" tabindex="-1" id="offcanvasExample"
        aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-body p-0">
            <nav class="navbar-dark">
                <ul class="navbar-nav">
                    <li class="my-2">
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="#" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/speedometer2.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Dashboard</span>
                        </a>
                    </li>
                    <li class="my-2">
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="categories.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/category.svg" alt="">
                            </span>
                            <span class="a-nav" style="color: #0db8de;">Categories Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="product.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/product.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Product Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="order_master.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/cart-fill.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Order Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="banner.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/display.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Banner Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="character.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/emoji-laughing.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Character Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="users.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/person-circle.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">User Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="contact_us.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/telephone-fill.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Contact Master</span>
                        </a>
                    </li>
                    <li>
                        <a href="coupon_code.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/cash-coin.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Coupon Master</span>
                        </a>
                    </li>
                    <li class="my-2">
                        <hr class="dropdown-divider">
                    </li>
                    <li>
                        <a href="logout.php" class="nav-link px-3 active">
                            <span class="me-2">
                                <img src="icons/power.svg" alt="">
                            </span>
                            <span style="color: #0db8de;">Logout</span>
                        </a>
                    </li>
                </ul>
            </nav>
        </div>
    </div>
    <!-- offcanvas end -->


    <script src="plugins/js/bootstrap.min.js"></script>
    <script src="plugins/js/jquery.js"></script>
</body>

</html>
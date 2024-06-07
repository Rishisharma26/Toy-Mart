<?php

session_start();
$con = mysqli_connect("localhost", "root", "", "toymartdb");

define('SERVER_PATH',$_SERVER['DOCUMENT_ROOT'].'/Toy Mart/Admin_Panel/');
define('SITE_PATH','http://localhost/Toy%20Mart/Admin_Panel/');

define('PRODUCT_IMAGE_SERVER_PATH',SERVER_PATH.'media/product/');
define('PRODUCT_IMAGE_SITE_PATH',SITE_PATH.'media/product/');

define('BANNER_IMAGE_SERVER_PATH',SERVER_PATH.'media/banner/');
define('BANNER_IMAGE_SITE_PATH',SITE_PATH.'media/banner/');

?>
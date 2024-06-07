<?php

function pr($arr){
    echo '<pre>';
    print_r($arr);
}

function prx($arr){
    echo '<pre>';
    print_r($arr);
    die;
}

function get_safe_value($con,$str){
    if($str!='')
    {
        $str = trim($str);
        return mysqli_real_escape_string($con,$str);
    }
}

function productsold($con,$pid){
    $sql= "SELECT sum(`order_detail`.qty) AS qty FROM `order_detail`,`orders` WHERE `orders`.id=`order_detail`.order_id AND `order_detail`.product_id=$pid AND `orders`.order_status!=4 AND `orders`.payment_status!='pending'";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    return $row['qty'];
}

?>
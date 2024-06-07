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

function get_product($con,$limit='',$cat_id='',$product_id='',$search_str=''){
    $sql="SELECT * FROM `product` WHERE status=1";
    if($cat_id!='')
    {
        $sql.=" and categories_id=$cat_id ";
    }
    if($product_id!='')
    {
        $sql.=" and id=$product_id ";
    }
    if($search_str!='')
    {
        $sql.=" and name LIKE '%$search_str%' OR description LIKE '%$search_str%'";
    }
    $sql.=" ORDER BY id DESC";
    if($limit!='')
    {
        $sql.=" limit $limit";
    }
    $res = mysqli_query($con,$sql);
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }
    return $data;
}

function get_product_character($con,$str=''){
    $sql="SELECT * FROM `product` WHERE status=1 AND `character` LIKE '%$str%'";
    $res = mysqli_query($con,$sql);
    $data = array();
    while($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }
    return $data;
}


// product sold by product Id
function productsold($con,$pid){
    $sql= "SELECT sum(`order_detail`.qty) AS qty FROM `order_detail`,`orders` WHERE `orders`.id=`order_detail`.order_id AND `order_detail`.product_id=$pid AND `orders`.order_status!=4 and ((`orders`.payment_type='razarpay' AND `orders`.payment_status='success') OR (`orders`.payment_type='cod' AND `orders`.payment_status!=''))";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    return $row['qty'];
}

function productqty($con,$pid){
    $sql= "SELECT qty FROM product WHERE id=$pid";
    $res = mysqli_query($con,$sql);
    $row = mysqli_fetch_assoc($res);
    return $row['qty'];
}

?>
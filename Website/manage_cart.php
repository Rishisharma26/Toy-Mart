<?php
require('connectioninc.php');
require('functionsinc.php');
require('add_to_cart_inc.php');
$pid=get_safe_value($con,$_POST['pid']);
$qty=get_safe_value($con,$_POST['qty']);
$type=get_safe_value($con,$_POST['type']);

$productsold = productsold($con,$pid);
$productqty = productqty($con,$pid);

$qty_available = $productqty-$productsold;

$obj=new add_to_cart();
if($type=='add'){
    $obj->addProduct($pid,$qty);
}
if($type=='remove'){
    $obj->removeProduct($pid);
}
if($type=='update'){
    $obj->updateProduct($pid,$qty);
}
echo $obj->totalProduct();
?>
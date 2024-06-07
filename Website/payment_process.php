<?php 
require('connectioninc.php');
if(isset($_POST['payment_id']) && isset($_SESSION['OID'])){
    $payment_id= $_POST['payment_id'];
    $payment_status= "success";
    // $user_id= $_SESSION['OID'];
    mysqli_query($con,"UPDATE `orders` SET `payment_status`='$payment_status',`txnid`='$payment_id' WHERE id='".$_SESSION['OID']."'");
    unset($_SESSION['cart']);
}
?>
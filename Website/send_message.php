<?php
require('connectioninc.php');
require('functionsinc.php');
$name=get_safe_value($con,$_POST['name']);
$email=get_safe_value($con,$_POST['email']);
$mobile=get_safe_value($con,$_POST['mobile']);
$comment=get_safe_value($con,$_POST['message']);
$added_on=date('Y-m-d h:i:s');

mysqli_query($con,"INSERT INTO `contact_us`(`name`, `email`, `mobile`, `comment`, `added_on`) VALUES ('$name', '$email', '$mobile', '$comment', '$added_on')");
echo "Thank You";
?>
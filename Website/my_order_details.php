<?php
require('top.php');

if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']!=''){

}
else{
    header('location:index.php');
    die();
}

$order_id = get_safe_value($con,$_GET['id']);
?>

<section id="" class="pt-5 mt-2 container">
    <h2 class="font-weight-bold pt-5">My Order Details</h2>
    <hr>
</section>

<section id="cart-container" class="container my-5">
    <table width="100%" class="myorder">
        <thead>
            <tr>
                <td>Product Name</td>
                <td>Product Image</td>
                <td>Qty</td>
                <td>Price</td>
                <td>Total Price</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $uid = $_SESSION['USER_ID'];
            $res = mysqli_query($con,"SELECT distinct(`order_detail`.id),`order_detail`.*,`product`.name,`product`.image FROM `order_detail`,`product`,`orders` WHERE `order_detail`.order_id='$order_id' and `orders`.user_id='$uid' and `order_detail`.product_id=`product`.id");
            $total_price=0;
            while($row = mysqli_fetch_assoc($res))
            {
                $total_price=$total_price+($row['price']*$row['qty']); 
            ?>
            <tr>
                <td><?php echo $row['name']?></td>
                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>" alt=""></td>
                <td><?php echo $row['qty']?></br></td>
                <td>₹<?php echo $row['price']?></td>
                <td>₹<?php echo $row['price']*$row['qty']?></td>
            </tr>
            <?php
            }
            ?>
            <tr>
                <td colspan="4">Sub Total Price (Minus coupon value (If Any))</td>
                <td>₹<?php 
                    $res2 = mysqli_query($con,"SELECT * FROM `orders` WHERE id='$order_id'");
                    $row2 = mysqli_fetch_assoc($res2);
                    
                    echo $row2['total_price'];
                ?></td>
            </tr>
        </tbody>
    </table>
</section>


<?php require('footer.php') ?>
<?php
require('top.php');
$display=0;

if(isset($_SESSION['USER_ID']) && $_SESSION['USER_ID']!=''){

}
else{
    header('location:index.php');
    die();
}
?>

<section id="" class="pt-5 mt-2 container">
    <h2 class="font-weight-bold pt-5">My Order</h2>
    <hr>
</section>

<section id="cart-container" class="container my-5">
    <div style="margin: 0 0 20px 0; font-size: 24px; color: #eb4d4b; font-weight: bold;">
        Hii <?php echo $_SESSION['USER_NAME']?>
    </div>
    <table width="100%" class="myorder">
        <thead>
            <tr>
                <td>Action</td>
                <td>Order Id</td>
                <td>Order Date</td>
                <td>Address</td>
                <td>Payment Type</td>
                <td>Payment Status</td>
                <td>Order Status</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $uid = $_SESSION['USER_ID'];
            $res = mysqli_query($con,"SELECT `orders`.*, `order_status`.name as order_status_str FROM `orders`,`order_status` WHERE `orders`.user_id='$uid' and `order_status`.id=`orders`.order_status");
            while($row = mysqli_fetch_assoc($res))
            {
            ?>
            <tr>
                <td><a href="my_order_details.php?id=<?php echo $row['id']?>"><button type="button" class="btn btn-info" style="padding:5px;">See Details</button></a></td>
                <td><?php echo $row['id']?></td>
                <td><?php echo $row['added_on']?></td>
                <td>
                    <?php echo $row['address']?></br>
                    <?php echo $row['city']?></br>
                    <?php echo $row['pincode']?>
                </td>
                <td><?php echo $row['payment_type']?></td>
                <td><?php echo $row['payment_status']?></td>
                <td><?php echo $row['order_status_str']?></td>
            </tr>
            <?php
            $display=1;
            }
            ?>
        </tbody>
    </table>
    <?php
        if($display==0){
            ?>
            <div class="alert alert-info text-center" role="alert">
                No Order
            </div>
        <?php
        }
    ?>
</section>


<?php require('footer.php') ?>
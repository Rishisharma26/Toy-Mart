<?php
require('topinc.php');
$order_id = get_safe_value($con,$_GET['id']);

if(isset($_POST['update_order_status'])){
    $update_order_status = $_POST['update_order_status'];
    mysqli_query($con,"UPDATE `orders` SET order_status='$update_order_status' WHERE id='$order_id'");
}
?>
<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-md-12 fw-bold fs-3">Order Detail</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product Name</th>
                            <th>Product Image</th>
                            <th>Qty</th>
                            <th>Price</th>
                            <th>Total Price</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                        $res = mysqli_query($con,"SELECT distinct(`order_detail`.id),`order_detail`.*,`product`.name,`product`.image FROM `order_detail`,`product`,`orders` WHERE `order_detail`.order_id='$order_id' and `order_detail`.product_id=`product`.id");
                        $total_price=0;
                        while($row = mysqli_fetch_assoc($res))
                        {
                            $total_price=$total_price+($row['price']*$row['qty']); 
                        ?>
                        <tr>
                            <td>
                                <?php echo $row['name']?>
                            </td>
                            <td><img style="height: 100px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$row['image']?>"
                                    alt=""></td>
                            <td>
                                <?php echo $row['qty']?></br>
                            </td>
                            <td>₹
                                <?php echo $row['price']?>
                            </td>
                            <td>₹
                                <?php echo $row['price']*$row['qty']?>
                            </td>
                        </tr>
                        <?php
                        }
                        ?>
                        <tr>
                            <td colspan="3"></td>
                            <td>Total Price</td>
                            <td>₹
                                <?php 
                                $res2 = mysqli_query($con,"SELECT * FROM `orders` WHERE id='$order_id'");
                                $row2 = mysqli_fetch_assoc($res2);
                                
                                echo $row2['total_price']?>
                            </td>
                        </tr>
                    </tbody>
                    </tbody>
                </table>
                <div class="row my-3 pt-5">
                    <label style="font-size: 22px;">Order Id : <span style="color: white;">
                            <?php echo $order_id?>
                        </span></label>
                    <label style="font-size: 22px;">Order Status :
                        <span style="color: white;">
                            <?php 
                        $order_status_arr=mysqli_fetch_assoc(mysqli_query($con,"SELECT order_status.name FROM order_status,`orders` WHERE `orders`.id='$order_id' and `orders`.order_status=order_status.id"));
                        echo $order_status_arr['name'];
                    ?>
                        </span>
                    </lable>
                    <form method="post">
                        <?php
                        $res1=mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM `orders` WHERE id='$order_id'"));
                        $payment_status=$res1['payment_status'];
                        
                        if($payment_status!="pending")
                        {
                        ?>
                            <div>
                                <label style="font-size: 22px;" class="form-label">Update Order Status : </label>
                                <select name="update_order_status" class="select_option" style="margin-top: 15px;" required>
                                    <option value="">Select Order Status</option>
                                    <?php
                                    $res=mysqli_query($con,"SELECT * from order_status");
                                    while($row= mysqli_fetch_assoc($res))
                                    {
                                        if($row['id']==$categories_id)
                                        {
                                            echo "<option selected value=".$row['id'].">".$row['name']."</option>";
                                        }
                                        else
                                        {
                                            echo "<option value=".$row['id'].">".$row['name']."</option>";
                                        }
                                    }
                                    ?>
                                </select>
                                <input type="submit" style="background: #0db8de; color: white; padding: 5px 10px; border:none; border-radius:5px;">
                            </div>
                        <?php
                        }
                        else{
                            ?><label style="font-size: 22px;" class="form-label">Payment Status : <span style="color: white;"> Pending</span></label><?php
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
</main>
<?php
require('top.php');
error_reporting(E_ERROR | E_PARSE);

$msg='';
$msg1='';
$cname='';
$value='0';
$_SESSION['coupon_value']='0';
if(isset($_GET['submit']))
{
    $code_name = get_safe_value($con, $_GET['code_name']);
    $res = mysqli_query($con, "SELECT * FROM `coupon` WHERE cname='$code_name'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($res);
        $cname = $row['cname'];
        $value = $row['value'];
        $_SESSION['coupon_value']=$value;
        $msg1="Coupon Applied";
    }
    else
    {
        $msg="Invalid Coupon";
    }
}
?>
<section id="" class="pt-5 mt-2 container">
    <h2 class="font-weight-bold pt-5">Shopping Cart</h2>
    <hr>
</section>

<section id="cart-container" class="container my-5">
    <table width="100%">
        <thead>
            <tr>
                <td>Remove</td>
                <td>Image</td>
                <td>Product</td>
                <td>Price</td>
                <td>Quantity</td>
                <td>Total</td>
            </tr>
        </thead>
        <tbody>
            <?php 
            $cart_total=0;
            $_SESSION['cart_value']=0;
            foreach($_SESSION['cart'] as $key=>$val)
            {
                $productArr=get_product($con,'','',$key);
                $pname=$productArr[0]['name'];
                $price=$productArr[0]['price'];
                $image=$productArr[0]['image'];
                $qty=$val['qty'];
                $cart_total=$cart_total+($price*$qty);
                $productsold = productsold($con,$productArr[0]['id']);
                $qty_available = $productArr[0]['qty']-$productsold;
                if($qty_available>10){
                    $qty_available='10';
                }
                $_SESSION['cart_value']++;
            ?>
            <tr>
                <td><a href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','remove')"><i class="fas fa-trash-alt"></i></a></td>
                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>" alt=""></td>
                <td>
                    <h5 style="overflow: hidden; padding: 0 5px;"><?php echo $pname?></h5>
                </td>
                <td>
                    <h5>₹<?php echo $price?></h5>
                </td>
                <td>
                    <h5><input class="w-25 pl-1" id="<?php echo $key?>qty" value="<?php echo $qty?>" type="number" min="1" max="<?php echo $qty_available?>"></h5>
                    <a style="text-decoration:none;" href="javascript:void(0)" onclick="manage_cart('<?php echo $key?>','update')">Update</a>
                </td>
                <td>
                    <h5>₹<?php echo $qty*$price?></h5>
                </td>
            </tr>
            <?php
            }?>
        </tbody>
    </table>
    <?php
            if($_SESSION['cart_value']>0){

            }
            else{?>
                <div class="alert alert-info text-center" role="alert">
                    Your Cart Is Empty
                </div>
            <?php
            }
            ?>
    <?php
        if(isset($_SESSION['empty_msg'])){
            ?>
            <div class="alert alert-warning text-center" role="alert">
            <?php echo $_SESSION['empty_msg']; ?>
            </div>
            <?php
            unset($_SESSION['empty_msg']);
        }
    ?>
</section>

<section id="cart-bottom" class="container mb-5">
    <div class="row">
        <div class="coupon col-lg-6 col-md-6 col-12 mb-4">
            <div>
                <form method="get">
                    <h5>COUPON</h5>
                    <p>Enter Your Coupon Code If You Have One.</p>
                    <input type="text" name="code_name" placeholder="Enter Code">
                    <!-- <button class="btn btn-danger">Apply Code</button> -->
                    <input style="background: #eb4d4b; color: white; border: none;" type="submit" name="submit" value="submit">
                </form>
                <?php
                if($code_name==''){

                }
                else{
                    ?><span style="color: red; padding: 0 0 5px 10px;"><?php echo $msg;?></span><?php
                    ?><span style="color: green; padding: 0 0 5px 5px;"><?php echo $msg1;?></span><?php
                }
                ?>
            </div>
        </div>
        <div class="total col-lg-6 col-md-6 col-12">
            <div>
                <h5>CART TOTAL</h5>
                <div class="d-flex justify-content-between">
                    <h6>Subtotal</h6>
                    <p>₹<?php echo $cart_total?></p>
                </div>
                <div class="d-flex justify-content-between">
                    <h6>Coupon Value</h6>
                    <?php
                    if($value!='' && $value!='0'){
                        ?><p style="color: green;">- ₹<?php echo $value?></p><?php
                    }
                    else{
                        ?><p>₹<?php echo $value?></p><?php
                    }
                    ?>
                </div>
                <hr class="second-hr">
                <div class="d-flex justify-content-between">
                    <h6>Total</h6>
                    <p>₹<?php echo $cart_total-$value?></p>
                </div>
                <a href="checkout.php"><button class="btn btn-danger m-2">Proceed To CheckOut</button></a>
            </div>
        </div>
    </div>
</section>

<?php require('footer.php') ?>
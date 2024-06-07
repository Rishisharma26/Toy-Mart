<?php
ob_start();
require('top.php');

if($_SESSION['cart_value']>0){
    if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){

    }
    else{
        $_SESSION['login_msg']="Please Login First before Checkout";
        header('location:login_page.php');
        die();
    }
}
else{
    $_SESSION['empty_msg']="Please Add Product To Your Cart";
    header('location:cart.php');
    die();
}

$cart_total=0;

if(isset($_POST['submit'])){
    $address = get_safe_value($con,$_POST['address']);
    $city = get_safe_value($con,$_POST['city']);
    $pincode = get_safe_value($con,$_POST['pincode']);
    $payment_type = get_safe_value($con,$_POST['payment_type']);
    $address = get_safe_value($con,$_POST['address']);
    $user_id = $_SESSION['USER_ID'];
    foreach($_SESSION['cart'] as $key=>$val)
    {
        $productArr=get_product($con,'','',$key);
        $price=$productArr[0]['price'];
        $qty=$val['qty'];
        $cart_total=$cart_total+($price*$qty);
    }
    $total_price = $cart_total-$_SESSION['coupon_value'];
    $payment_status = 'pending';
    if($payment_type=='cod'){
        $payment_status = 'success';
    
        $order_status = '1';
        $added_on = date('y-m-d h:i:s');

        mysqli_query($con,"INSERT INTO `orders`(`user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES ('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");

        $order_id = mysqli_insert_id($con);
        foreach($_SESSION['cart'] as $key=>$val)
        {
            $productArr=get_product($con,'','',$key);
            $price=$productArr[0]['price'];
            $qty=$val['qty'];

            mysqli_query($con,"INSERT INTO `order_detail`(`order_id`, `product_id`, `qty`, `price`) VALUES ('$order_id','$key','$qty','$price')");
        }
    }   
    if($payment_type=='razarpay'){
        $payment_status = 'pending';
    
        $order_status = '1';
        $added_on = date('y-m-d h:i:s');

        mysqli_query($con,"INSERT INTO `orders`(`user_id`, `address`, `city`, `pincode`, `payment_type`, `total_price`, `payment_status`, `order_status`, `added_on`) VALUES ('$user_id','$address','$city','$pincode','$payment_type','$total_price','$payment_status','$order_status','$added_on')");
        $_SESSION['OID']=mysqli_insert_id($con);
        $_SESSION['total_price_razar']=$total_price;

        $order_id = mysqli_insert_id($con);
        foreach($_SESSION['cart'] as $key=>$val)
        {
            $productArr=get_product($con,'','',$key);
            $price=$productArr[0]['price'];
            $qty=$val['qty'];

            mysqli_query($con,"INSERT INTO `order_detail`(`order_id`, `product_id`, `qty`, `price`) VALUES ('$order_id','$key','$qty','$price')");
        }
        ?>
        <script>
            window.location.href="razarpay.php";
        </script>
        <?php
    }
    else{
        unset($_SESSION['cart']);
        ?>
        <script>
            window.location.href="thankyou.php";
        </script>
        <?php
    }
}
ob_end_flush();
?>

<head>
    <style>
        @import url(https://fonts.googleapis.com/css?family=Lato:400,300,700);

        .checkout{
            height:100%;
            margin:0;
            font-family:lato;
            margin: 100px 0;
        }

        .checkout .ScrollStyle
        {
            max-height: 420px;
            overflow-y: scroll;
            margin-top: 20px;
        }

        .checkout .container {
        height:100%;
        -webkit-box-pack:center;
        -webkit-justify-content:center;
            -ms-flex-pack:center;
                justify-content:center;
        -webkit-box-align:center;
        -webkit-align-items:center;
            -ms-flex-align:center;
                align-items:center;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        }

        .checkout .window {
        height:540px;
        width:800px;
        background:#fff;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        box-shadow: 0px 15px 50px 10px rgba(0, 0, 0, 0.2);
        border-radius:30px;
        z-index:10;
        }
        .checkout .order-info {
        height:100%;
        width:50%;
        padding-left:25px;
        padding-right:25px;
        box-sizing:border-box;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        -webkit-box-pack:center;
        -webkit-justify-content:center;
            -ms-flex-pack:center;
                justify-content:center;
        position:relative;
        }
        .price {
        bottom:0px;
        position:absolute;
        right:0px;
        color:#4488dd;
        padding-right: 20px;
        }
        .order-table td:first-of-type {
        width:25%;
        }
        .order-table {
            position:relative;
        }
        .line2 {
        height:1px;
        width:100%;
        margin-top:10px;
        margin-bottom:10px;
        background:#ddd;
        }
        .order-table td:last-of-type {
        vertical-align:top;
        padding-left:25px;
        padding-right: 25px;
        }
        .order-info-content {
        table-layout:fixed;

        }

        .full-width {
        width:100%;
        }


        .total {
        margin-top:25px;
        font-size:20px;
        font-size:1.3rem;
        position:absolute;
        bottom:30px;
        right:27px;
        left:35px;
        }
        .dense {
        line-height:1.2em;
        font-size:16px;
        font-size:1rem;
        }
        .input-field {
        background:rgba(255,255,255,0.1);
        margin-bottom:10px;
        margin-top:3px;
        line-height:1.5em;
        font-size:20px;
        font-size:1.3rem;
        border:none;
        padding:5px 10px 5px 10px;
        color:#fff;
        box-sizing:border-box;
        width:100%;
        margin-left:auto;
        margin-right:auto;
        }
        .credit-info {
        background:#eb4d4b;
        height:100%;
        width:50%;
        color:#eee;
        -webkit-box-pack:center;
        -webkit-justify-content:center;
            -ms-flex-pack:center;
                justify-content:center;
        font-size:14px;
        font-size:.9rem;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        box-sizing:border-box;
        padding-left:25px;
        padding-right:25px;
        border-top-right-radius:30px;
        border-bottom-right-radius:30px;
        position:relative;
        }
        .dropdown-btn {
        background:rgba(255,255,255,0.1);
        width:100%;
        border-radius:5px;
        text-align:center;
        line-height:1.5em;
        cursor:pointer;
        position:relative;
        -webkit-transition:background .2s ease;
                transition:background .2s ease;
        }
        .dropdown-btn:after {
        content: '\25BE';
        right:8px;
        position:absolute;
        }
        .dropdown-btn:hover {
        background:rgba(255,255,255,0.2);
        -webkit-transition:background .2s ease;
                transition:background .2s ease;
        }
        .dropdown-select {
        display:none;
        }
        .credit-card-image {
        display:block;
        max-height:80px;
        margin-left:auto;
        margin-right:auto;
        margin-top:35px;
        margin-bottom:15px;
        }
        .credit-info-content {
        margin-top:25px;
        -webkit-flex-flow:column;
            -ms-flex-flow:column;
                flex-flow:column;
        display:-webkit-box;
        display:-webkit-flex;
        display:-ms-flexbox;
        display:flex;
        width:100%;
        }

        .ck_btn{
            width: 100%;
            border: none;
            background-color: #ee7793;
            color: white;
            border-radius: 20px;
            font-size: 18px;
            margin-top: 30px;
        }
       

        .ck_btn:hover{
            width: 100%;
            border: none;
            background-color: #fff;
            color: #eb4d4b;
        }

        .added{
            margin: 7px 0;
            font-size: 16px;
        }

        .line1 {
            display: flex;
            flex-direction: row;
        }

        .line1:before, .line1:after{
            content: "";
            flex: 1 1;
            border-bottom: 1px solid;
            margin: auto;
        }

        .line1:before {
            margin-right: 10px
        }

        .line1:after {
            margin-left: 10px
        }

        @media (max-width: 600px) {
            .checkout .window {
            width: 100%;
            height: 100%;
            display:block;
            border-radius:0px;
        }
        .checkout .order-info {
            width:100%;
            height:auto;
            padding-bottom:100px;
            border-radius:0px;
        }
        .checkout .credit-info {
            width:100%;
            height:auto;
            padding-bottom:100px;
            border-radius:0px;
        }
        .checkout .pay-btn {
            border-radius:0px;
        }
        }
        .hidee{
            display: none;
        }
    </style>
</head>

<section id="" class="pt-5 mt-2 container">
    <h2 class="font-weight-bold pt-5">CheckOut</h2>
    <hr>
</section>

<div class="checkout">
    <div class='container'>
        <div class='window'>
            <div class='order-info'>
                <div class='order-info-content ScrollStyle'>
                    <?php 
                        $cart_total=0;
                        foreach($_SESSION['cart'] as $key=>$val)
                        {
                            $productArr=get_product($con,'','',$key);
                            $pname=$productArr[0]['name'];
                            $price=$productArr[0]['price'];
                            $image=$productArr[0]['image'];
                            $qty=$val['qty'];
                            $cart_total=$cart_total+($price*$qty);
                    ?>
                    <div class='line2'></div>
                    <table class='order-table'>
                        <tbody>
                            <tr>
                                <td><img src="<?php echo PRODUCT_IMAGE_SITE_PATH.$image?>"
                                        class='full-width'></img>
                                </td>
                                <td>
                                    <br> <span class='thin'><?php echo $pname?></span>
                                    <br> <span class='thin'>Quantity: <?php echo $qty?></span>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <div class='price'>₹<?php echo $price?></div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class='line2'></div>
                    <?php 
                    }
                    ?>
                </div>
                <div class='total mt-5'>
                    <span style='float:left;'>
                        <div class='thin dense'>Coupon</div>
                        TOTAL
                    </span>
                    <span style='float:right; text-align:right;'>
                        <div class='thin dense'>₹<?php echo $_SESSION['coupon_value']?></div>
                        ₹<?php echo $cart_total-$_SESSION['coupon_value']?>
                    </span>
                </div>
            </div>
            <div class='credit-info'>
                <form method="post" style="width: 80%; padding-top: 30px;">
                    <div class="form-group py-2">
                        <label for="exampleInputEmail1" class="added">Address</label>
                        <input type="text-area" class="form-control" id="address" name="address" placeholder="Enter Address"
                            required>
                    </div>
                    <div class="form-group py-2">
                        <label for="exampleInputEmail1" class="added">City</label>
                        <input type="text-area" class="form-control" id="city" name="city" placeholder="Enter City" required>
                    </div>
                    <div class="form-group py-2">
                        <label for="exampleInputEmail1" class="added">Pincode</label>
                        <input type="text-area" class="form-control" id="pincode" name="pincode" placeholder="Enter Pincode" minlength="6" maxlength="6" required>
                    </div>
                    <div class="form-group pt-4" style="text-align: center;">
                        <label for="exampleInputEmail1" class="added line1">Payment Option</label><br>
                        <input type="radio" id="x" name="payment_type" value="cod" required>
                        <label for="html" style="margin: 0 30px 0 2px;">COD</label>
                        <input type="radio" id="y" name="payment_type" value="razarpay" required>
                        <label for="html" style="margin: 0 5px 0 2px;">Razar Pay</label>
                    </div>
                    <input id="but" type="submit" name="submit" class="ck_btn py-2"  value="submit">
                </form>
            </div>
        </div>
    </div>
</div>


<?php require('footer.php') ?>
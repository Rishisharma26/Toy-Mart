<?php 
require('connectioninc.php');
?>

<style>
    .razarpay_btn{
        padding: 20px 40px;
        background: #348ceb;
        color: white;
        border: none;
        outline: none;
        border-radius: 15px;
        display: block;
        margin-right: auto;
        margin-left: auto;
        cursor: pointer;
    }

    .razarpay_btn:hover{
        padding: 20px 40px;
        background: White;
        color: #348ceb;
        font-weight: bold;
        outline: 2px solid #348ceb;
    }

    .razarpay_img{
        width: 60%;
        height: 400px;
        display: block;
        margin-left: auto;
        margin-right: auto;
        margin-top: 50px;
        margin-bottom: 30px;
    }

    .razarpay_title{
        text-align: center;
        color: #348ceb;
    }
</style>

</div class="razarpay">
    <img src="image/owl/Razorpay2.jpg" alt="" class="razarpay_img"><br>
    <h3 class="razarpay_title">Pay With Razarpay Now</h3>
    <input id="but" type="submit" name="submit" class="razarpay_btn"  value="Pay Now" onclick="pay_now();">
</div>

<script src="plugins/js/jquery.js"></script>
<script src="https://checkout.razorpay.com/v1/checkout.js"></script>
<script>
    function pay_now(){
        
        var user_id = '';
        user_id = '<?php echo $_SESSION['USER_ID']?>';
        var amount = '';
        amount = '<?php echo $_SESSION['total_price_razar']?>'
        var payment_type = 'razarpay';

        var options = {
            "key": "rzp_test_BYmHESpT99JdCP",
            "amount": amount*100,
            "currency": "INR",
            "name": "Toy Mart",
            "description": "Test Transaction",
            "image": "image/owl/Logo.png",
            "handler": function (response){
                // alert(response.razorpay_payment_id);
                // alert(response.razorpay_order_id);
                // alert(response.razorpay_signature)
                jQuery.ajax({
                    type: 'post',
                    url: 'payment_process.php',
                    data: 'payment_id='+response.razorpay_payment_id+'&user_id='+user_id,
                    success: function(result){
                        window.location.href="thankyou.php";
                    }
                });
            }
        };
        var rzp1 = new Razorpay(options);
    
    rzp1.open();
    }
</script>
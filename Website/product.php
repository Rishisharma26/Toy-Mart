<?php
require('top.php');
$product_id = mysqli_real_escape_string($con,$_GET['id']);
if($product_id>0){
    $get_product = get_product($con,'','',$product_id);
}
else{
    ?>
    <script>
        window.location.href="index.php";
    </script>
    <?php
}
?>
<!-- details start -->
<section class="container sproduct my-5 pt-5">
    <div class="row mt-5">
        <div class="col-lg-5 col-md-12 col-12">
            <img class="img-fluid product_img" style="width: 100%; height:500px;" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$get_product['0']['image']?>" alt="">
        </div>
        <div class="col-lg-6 col-md-12 col-12">
            <h6><?php echo $get_product['0']['short_desc']?></h6>
            <h3 class="py-4"><?php echo $get_product['0']['name']?></h3>
            <s><h4>₹<?php echo $get_product['0']['mrp']?></h4></s>
            <h2>₹<?php echo $get_product['0']['price']?></h2>
            <?php
                $productsold = productsold($con,$get_product['0']['id']);
                $qty_available = $get_product['0']['qty']-$productsold;
                $cart_show= 'yes';
                if($get_product['0']['qty']>$productsold)
                {
                    $stock= 'In Stock';
                }else{
                    $stock= 'Not In Stock';
                    $cart_show= '';
                }
            ?>
            <div>
                <p><strong>Availability: </strong><?php echo $stock?></p>
            </div>
            <?php if($cart_show!=''){ ?>
            <div class="pb-3">
                <strong>Quantity</strong>
                <select id="qty">
                    <?php
                        if($qty_available<11){
                            for($i=1;$i<=$qty_available;$i++)
                            {
                                echo "<option>$i</option>";
                            }
                        }
                        else
                        {
                            for($i=1;$i<=10;$i++)
                            {
                                echo "<option>$i</option>";
                            }
                        } 
                    ?>
                </select>
            </div>
            <a href="javascript:void(0)" onclick="manage_cart('<?php echo $get_product['0']['id']?>','add')"><button class="btn btn-danger">Add To Cart</button></a>
            <?php }?>
            <h4 class="my-5">Product Detail</h4>
            <span><?php echo $get_product['0']['description']?></span>
        </div>
    </div>
</section>
<!-- details ends -->

<!-- latest products starts -->
<section id="Latest" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Related Category Toys</h3>
        <hr class="mx-auto">
        <p></p>
    </div>
    <div class="row mx-auto container-fluid">
        <?php 
        $cat_id = $get_product['0']['categories_id'];
        $get_product = get_product($con,4,$cat_id);
        foreach($get_product as $list)
        {
        ?>
        <div class="product text-center col-lg-3 col-md-4 col-12">
            <a style="text-decoration: none" href="product.php?id=<?php echo $list['id']?>"><img class="img-fluid p-img mb-3" src="<?php echo PRODUCT_IMAGE_SITE_PATH.$list['image']?>">
            <div class="star">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
            </div>
            <h5 class="p-name"><?php echo $list['name']?></h5>
            <s><h5 class="p-price" style="color: black">₹<?php echo $list['mrp']?></h5></s>
            <h4 class="p-price">₹<?php echo $list['price']?></h4>
            <button class="buy-btn">Buy Now</button>
            </a>
        </div>
        <?php 
        } ?>
    </div>
</section>
<!-- latest products ends -->

<?php require('footer.php') ?>
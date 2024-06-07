<?php
require('top.php');
$str = mysqli_real_escape_string($con,$_GET['str']);
if($str!=''){
    $get_product = get_product_character($con,$str);
}
else{
    ?>
    <script>
        window.location.href="index.php";
    </script>
    <?php
}
?>


<section id="featured" class="my-5 py-5">
    <div class="container mt-5 py-5">
        <span  style="font-size:32px;" class="font-weight-bold">Our Products</span>
        <hr>
        <p>Best Toys for Your Child</p>
    </div>
    <div class="row mx-auto container">
        <?php
        if(count($get_product)>0)
        {
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
        <?php 
        }
        else{
            echo "Sorry Product is Not Available in This Categories";
        }
        ?>
    </div>
</section>
<?php require('footer.php') ?>

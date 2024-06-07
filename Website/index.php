<?php require('top.php'); 
$resBanner= mysqli_query($con,"SELECT * FROM `banner` WHERE status='1'");
$resCharacter= mysqli_query($con,"SELECT * FROM `characters` WHERE status='1'");
?>

<!-- Slider starts -->
<div class="main">
    <?php 
    $active_class=0;
    $class='';
    if(mysqli_num_rows($resBanner)>0)
    {
    ?>
    <div id="myCarousel" class="carousel slide carousel-fade" data-bs-ride="carousel">
        <div class="carousel-inner">
            <?php while($rowBanner=mysqli_fetch_assoc($resBanner))
            {
                $active_class++;
                if($active_class==1){
                    $class='active';
                }
                else{
                    $class='';
                }
            ?>
            <div class="carousel-item <?php echo $class?>" style="background-image: url(<?php echo BANNER_IMAGE_SITE_PATH.$rowBanner['image'] ?>);">
                <div class="container">
                    <div class="carousel-caption text-start">
                        <h1><?php echo $rowBanner['heading1'] ?></h1>
                        <p><?php echo $rowBanner['heading2'] ?></p>
                        <?php if($rowBanner['btn_text']!='' && $rowBanner['btn_link']!=''){?>
                        <p><a class="btn btn-lg btn-danger" href="<?php echo $rowBanner['btn_link'] ?>"><?php echo $rowBanner['btn_text'] ?></a></p>
                        <?php }?>
                    </div>
                </div>
            </div>
            <?php }?>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="visually-hidden">Next</span>
        </button>
    </div>
    <?php }?>
</div>
<!-- Slider ends -->

<!-- owl section start -->
<div class="container text-center mt-5 py-5">
    <h3>Shop By Characters</h3>
    <hr class="mx-auto">
</div>
<div class="owl-carousel owl-theme owl-category">
    <?php while($rowCharacter=mysqli_fetch_assoc($resCharacter))
    {?>
    <a style="text-decoration: none;" href="character.php?str=<?php echo $rowCharacter['byname'] ?>">
    <div class="item">
        <img src="<?php echo BANNER_IMAGE_SITE_PATH.$rowCharacter['image'] ?>" alt="">
        <h3><?php echo $rowCharacter['heading'] ?></h3>
    </div>
    </a>
    <?php
    }
    ?>
</div>
<!-- owl section end -->

<!-- latest products starts -->
<section id="Latest" class="my-5">
    <div class="container text-center mt-5 py-5">
        <h3>Latest Toys</h3>
        <hr class="mx-auto">
        <p></p>
    </div>
    <div class="row mx-auto container-fluid">
        <?php 
        $get_product = get_product($con,8);
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

<!-- banner section starts -->
<section id="banner" class="my-5 py-5" style="background-image: url('image/owl/blog-4.jpg');">
<div class="container">
        <h4>Sale Upto 40%</h4>
        <h1>Super Cartoon Character Toys</h1>
        <button class="btn btn-danger">Shop Now</button>
    </div>
</section>
<!-- banner section ends -->

<!-- Feature product starts -->
<section id="featured" class="my-5 pb-5">
    <div class="container text-center mt-5 py-5">
        <h3>Baby Product</h3>
        <hr class="mx-auto">
        <p></p>
    </div>
    <div class="row mx-auto container-fluid">
        <?php 
        $get_product = get_product($con,8,36);
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
<!-- Feature product ends -->
<?php require('footer.php') ?>

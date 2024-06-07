<?php

ob_start();
require('topinc.php');
$categories_id='';
$name='';
$mrp='';
$price='';
$qty='';
$image='';
$short_desc='';
$description='';
$character='';
$status='';

$msg='';
$image_required='required';
if(isset($_GET['id']) && $_GET['id']!='')
{
    $image_required='';
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM product WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($res);
        $categories_id = $row['categories_id'];
        $name = $row['name'];
        $mrp = $row['mrp'];
        $price = $row['price'];
        $qty = $row['qty'];
        $short_desc = $row['short_desc'];
        $description = $row['description'];
        $character = $row['character'];
    }
    else
    {
        header('location:product.php');
        die();
    }
}

if(isset($_POST['submit']))
{
    $categories_id = get_safe_value($con, $_POST['categories_id']);
    $name = get_safe_value($con, $_POST['name']);
    $mrp = get_safe_value($con, $_POST['mrp']);
    $price = get_safe_value($con, $_POST['price']);
    $qty = get_safe_value($con, $_POST['qty']);
    $image = get_safe_value($con, $_POST['image']);
    $short_desc = get_safe_value($con, $_POST['short_desc']);
    $description = get_safe_value($con, $_POST['description']);
    $character = get_safe_value($con, $_POST['character']);

    $res = mysqli_query($con, "SELECT * FROM product WHERE name='$name'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        if(isset($_GET['id']) && $_GET['id']!='')
        {
            $getData = mysqli_fetch_assoc($res);
            if($id==$getData['id'])
            {

            }
            else
            {
                $msg = "Product Already Exist";
            }
        }
        else
        {
            $msg = "Product Already Exist";
        }
    }

    if($_FILES['image']['type']!='' &&  $_FILES['image']['type']!='image/png' && $_FILES['image']['type']!='image/jpg' && $_FILES['image']['type']!='image/jpeg'){
        $msg = "Please select only PNG/JPG/JPEF Image format";
    }

    if($msg=='')
    {
        if(isset($_GET['id']) && $_GET['id']!='')
        {
            if($_FILES['image']['name']!='')
            {
                $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
                move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
                $update_sql = "UPDATE `product` SET `categories_id`='$categories_id',`name`='$name',`mrp`='$mrp',`price`='$price',`qty`='$qty',`image`='$image',`short_desc`='$short_desc',`description`='$description',`character`='$character' WHERE id='$id'";
            }
            else{
                $update_sql = "UPDATE `product` SET `categories_id`='$categories_id',`name`='$name',`mrp`='$mrp',`price`='$price',`qty`='$qty',`short_desc`='$short_desc',`description`='$description',`character`='$character' WHERE id='$id'";
            }
            mysqli_query($con, $update_sql);
        }
        else{
            $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],PRODUCT_IMAGE_SERVER_PATH.$image);
            mysqli_query($con, "INSERT INTO `product`(`categories_id`, `name`, `mrp`, `price`, `qty`, `image`, `short_desc`, `description`, `character`, `status`) VALUES ('$categories_id', '$name', '$mrp', '$price', '$qty', '$image', '$short_desc', '$description', '$character', '1')");
        }
        header('location:product.php');
        die();
    }
}


ob_end_flush();
?>

<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-12 fw-bold fs-3">Product</div>
        </div>
        <div class="row">
            <div class="col-lg-10 col-md-10 col-12 my-3">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="categories" class="form-label">Select Categories</label>
                        <select name="categories_id" class="select_option" required>
                            <option value="">Select Category</option>
                            <?php
                            $res=mysqli_query($con,"SELECT id,categories from categories ORDER BY categories");
                            while($row= mysqli_fetch_assoc($res))
                            {
                                if($row['id']==$categories_id)
                                {
                                    echo "<option selected value=".$row['id'].">".$row['categories']."</option>";
                                }
                                else
                                {
                                    echo "<option value=".$row['id'].">".$row['categories']."</option>";
                                }
                            }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Product Name</label>
                        <input type="text" class="form-control" name="name" placeholder="Enter Product Name" value="<?php echo $name?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">MRP</label>
                        <input type="text" class="form-control" name="mrp" placeholder="Enter Product MRP" value="<?php echo $mrp?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Price</label>
                        <input type="text" class="form-control" name="price" placeholder="Enter Product Price" value="<?php echo $price?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Quantity</label>
                        <input type="text" class="form-control" name="qty" placeholder="Enter Quantity" value="<?php echo $qty?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" <?php echo $image_required?>>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Short Description</label>
                        <textarea name="short_desc" placeholder="Enter Short Description" class="form-control" required><?php echo $short_desc?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Description</label>
                        <textarea name="description" placeholder="Enter Product Description" class="form-control" required><?php echo $description?></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Character</label>
                        <input type="text" class="form-control" name="character" placeholder="Enter Character Name" value="<?php echo $character?>" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <div class="py-4 text-center" style="color:red"><?php echo $msg ?></div>
                </form>
            </div>
        </div>
    </div>
</main>
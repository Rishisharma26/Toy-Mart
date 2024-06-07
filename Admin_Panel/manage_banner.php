<?php

ob_start();
require('topinc.php');
$heading1='';
$heading2='';
$btn_text='';
$btn_link='';
$image='';
$msg='';
$image_required='required';

if(isset($_GET['id']) && $_GET['id']!='')
{
    $id = get_safe_value($con, $_GET['id']);
    $image_required='';
    $res = mysqli_query($con, "SELECT * FROM banner WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($res);
        $heading1 = $row['heading1'];
        $heading2 = $row['heading2'];
        $btn_text = $row['btn_text'];
        $btn_link = $row['btn_link'];
        $image = $row['image'];
    }
    else
    {
        header('location:banner.php');
        die();
    }
}

if(isset($_POST['submit']))
{
    $heading1 = get_safe_value($con, $_POST['heading1']);
    $heading2 = get_safe_value($con, $_POST['heading2']);
    $btn_text = get_safe_value($con, $_POST['btn_text']);
    $btn_link = get_safe_value($con, $_POST['btn_link']);
    $image = get_safe_value($con, $_POST['image']);
    $msg=='';
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
                move_uploaded_file($_FILES['image']['tmp_name'],BANNER_IMAGE_SERVER_PATH.$image);
                mysqli_query($con, "UPDATE banner SET heading1='$heading1', heading2='$heading2', btn_text='$btn_text', btn_link='$btn_link', image='$image' WHERE id='$id'");
            }else{
                mysqli_query($con, "UPDATE banner SET heading1='$heading1', heading2='$heading2', btn_text='$btn_text', btn_link='$btn_link' WHERE id='$id'");
            }
        }
        else{
            $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],BANNER_IMAGE_SERVER_PATH.$image);
            mysqli_query($con, "INSERT INTO banner(heading1, heading2, btn_text, btn_link, image, status) values('$heading1', '$heading2', '$btn_text', '$btn_link', '$image', '1')");
        }
        header('location:banner.php');
        die();
    }
}


ob_end_flush();
?>

<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-12 fw-bold fs-3">Banner</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="heading1" class="form-label">Heading 1</label>
                        <input type="text" class="form-control" name="heading1" placeholder="Enter Heading 1" value="<?php echo $heading1?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="heading2" class="form-label">Heading 2</label>
                        <input type="text" class="form-control" name="heading2" placeholder="Enter Heading 2" value="<?php echo $heading2?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="btn_text" class="form-label">Button Text</label>
                        <input type="text" class="form-control" name="btn_text" placeholder="Enter Button Text" value="<?php echo $btn_text?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label for="btn_link" class="form-label">Button link</label>
                        <input type="text" class="form-control" name="btn_link" placeholder="Enter Button link" value="<?php echo $btn_link?>" autocomplete="off">
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Image</label>
                        <input type="file" class="form-control" name="image" <?php echo $image_required?>>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <div class="pt-4 text-center" style="color:red"><?php echo $msg ?></div>
                </form>
            </div>
        </div>
    </div>
</main>
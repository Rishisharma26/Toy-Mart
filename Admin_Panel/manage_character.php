<?php

ob_start();
require('topinc.php');
$heading='';
$byname='';
$image='';
$msg='';
$image_required='required';

if(isset($_GET['id']) && $_GET['id']!='')
{
    $id = get_safe_value($con, $_GET['id']);
    $image_required='';
    $res = mysqli_query($con, "SELECT * FROM `characters` WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($res);
        $heading = $row['heading'];
        $byname = $row['byname'];
        $image = $row['image'];
    }
    else
    {
        header('location:character.php');
        die();
    }
}

if(isset($_POST['submit']))
{
    $heading = get_safe_value($con, $_POST['heading']);
    $byname = get_safe_value($con, $_POST['byname']);
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
                mysqli_query($con, "UPDATE `characters` SET heading='$heading', byname='$byname', image='$image' WHERE id='$id'");
            }else{
                mysqli_query($con, "UPDATE `characters` SET heading='$heading', byname='$byname' WHERE id='$id'");
            }
        }
        else{
            $image = rand(111111111,999999999).'_'.$_FILES['image']['name'];
            move_uploaded_file($_FILES['image']['tmp_name'],BANNER_IMAGE_SERVER_PATH.$image);
            mysqli_query($con, "INSERT INTO `characters`(`heading`, `byname`, `image`, `status`) VALUES ('$heading','$byname','$image','1')");
        }
        header('location:character.php');
        die();
    }
}


ob_end_flush();
?>

<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-12 fw-bold fs-3">Character</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <form method="post" enctype="multipart/form-data">
                    <div class="mb-3">
                        <label for="heading" class="form-label">Heading</label>
                        <input type="text" class="form-control" name="heading" placeholder="Enter Heading" value="<?php echo $heading?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="byname" class="form-label">By Name</label>
                        <input type="text" class="form-control" name="byname" placeholder="Enter Search by Name" value="<?php echo $byname?>" autocomplete="off">
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
<?php

ob_start();
require('topinc.php');
$cname='';
$value='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!='')
{
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM `coupon` WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($res);
        $cname = $row['cname'];
        $value = $row['value'];
    }
    else
    {
        header('location:coupon_code.php');
        die();
    }
}

if(isset($_POST['submit']))
{
    $cname = get_safe_value($con, $_POST['cname']);
    $value = get_safe_value($con, $_POST['value']);
    $res = mysqli_query($con, "SELECT * FROM `coupon` WHERE cname='$cname'");
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
                $msg = "Coupon Already Exist";
            }
        }
        else
        {
            $msg = "Coupon Already Exist";
        }
    }
    if($msg=='')
    {
        if(isset($_GET['id']) && $_GET['id']!='')
        {
            mysqli_query($con, "UPDATE `coupon` SET `cname`='$cname',`value`='$value' WHERE id='$id'");
        }
        else{
            mysqli_query($con, "INSERT INTO `coupon`(cname,value) values('$cname','$value')");
        }
        header('location:coupon_code.php');
        die();
    }
}


ob_end_flush();
?>

<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-12 fw-bold fs-3">Coupon code</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <form method="post">
                    <div class="mb-3">
                        <label for="categories" class="form-label">Coupon Name</label>
                        <input type="text" class="form-control" name="cname" placeholder="Enter Coupon Name" value="<?php echo $cname?>" autocomplete="off" required>
                    </div>
                    <div class="mb-3">
                        <label for="categories" class="form-label">Value</label>
                        <input type="text" class="form-control" name="value" placeholder="Enter Coupon Value" value="<?php echo $value?>" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <div class="pt-4 text-center" style="color:red"><?php echo $msg ?></div>
                </form>
            </div>
        </div>
    </div>
</main>
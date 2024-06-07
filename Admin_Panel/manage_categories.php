<?php

ob_start();
require('topinc.php');
$categories='';
$msg='';
if(isset($_GET['id']) && $_GET['id']!='')
{
    $id = get_safe_value($con, $_GET['id']);
    $res = mysqli_query($con, "SELECT * FROM categories WHERE id='$id'");
    $check = mysqli_num_rows($res);
    if($check>0)
    {
        $row = mysqli_fetch_assoc($res);
        $categories = $row['categories'];
    }
    else
    {
        header('location:categories.php');
        die();
    }
}

if(isset($_POST['submit']))
{
    $categories = get_safe_value($con, $_POST['categories']);
    $res = mysqli_query($con, "SELECT * FROM categories WHERE categories='$categories'");
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
                $msg = "Category Already Exist";
            }
        }
        else
        {
            $msg = "Category Already Exist";
        }
    }
    if($msg=='')
    {
        if(isset($_GET['id']) && $_GET['id']!='')
        {
            mysqli_query($con, "UPDATE categories SET categories='$categories' WHERE id='$id'");
        }
        else{
            mysqli_query($con, "INSERT INTO categories(categories,status) values('$categories','1')");
        }
        header('location:categories.php');
        die();
    }
}


ob_end_flush();
?>

<main class="mt-5 pt-2">
    <div class="container-fluid">
        <div class="row my-3">
            <div class="col-12 fw-bold fs-3">Categories</div>
        </div>
        <div class="row">
            <div class="col-12 my-3">
                <form method="post">
                    <div class="mb-3">
                        <label for="categories" class="form-label">Categories</label>
                        <input type="text" class="form-control" name="categories" placeholder="Enter Categories Name" value="<?php echo $categories?>" autocomplete="off" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Submit</button>
                    <div class="pt-4 text-center" style="color:red"><?php echo $msg ?></div>
                </form>
            </div>
        </div>
    </div>
</main>
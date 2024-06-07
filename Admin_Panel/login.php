<?php

require('connectioninc.php');
require('functionsinc.php');
$msg='';

if(isset($_POST['submit']))
{
    $username = get_safe_value($con, $_POST['username']);
    $password = get_safe_value($con, $_POST['password']);
    $sql = "SELECT * FROM `admin_users` where username='$username' and password='$password'";
    $res = mysqli_query($con, $sql);
    $count = mysqli_num_rows($res);

    if($count>0){
        $_SESSION['ADMIN_LOGIN']='yes';
        $_SESSION['ADMIN_USERNAME']=$username;
        header('location:categories.php');
    }
    else{
        $msg = "Please enter correct Details";
    }
    

}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="plugins/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <title>Login</title>
</head>

<body>
    <div class="global-container">
        <div class="card login-form">
            <div class="card-body">
                <h1 class="card-title text-center">LOGIN</h1>
                <div class="card-text">
                    <form method="post" action="">
                        <div class="form-group">
                            <label for="inputemail">User Name</label>
                            <input type="text" name="username" class="form-control form-control-sm input-text" id="inputname" autocomplete="off" required>
                        </div>
                        <div class="form-group">
                            <label for="inputpassword">Password</label>
                            <input type="password" name="password" class="form-control form-control-sm" id="inputpassword" required>
                            <!-- <a href="forgetpassword.html" style="float:right; font: size 12px;">Forget Password?</a> -->
                        </div>
                        <button type="submit" name="submit" class="btn btn-primary btn-block mt-3">Login</button>
                    </form>
                    <div class="pt-4 text-center" style="color:red"><?php echo $msg ?></div>
                </div>
            </div>
        </div>
    </div>
    <script src="plugins/js/jquery.js"></script>
    <script src="plugins/js/bootstrap.min.js"></script>
</body>

</html>
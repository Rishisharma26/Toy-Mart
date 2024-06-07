<?php
require('top.php');

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
    if(isset($_SESSION['USER_ID']))
    {
        $uid = $_SESSION['USER_ID'];
        $res = mysqli_query($con,"SELECT * FROM `users` WHERE id='$uid'");
        $row = mysqli_fetch_assoc($res);
        $name = $row['name'];
        $password = $row['password'];
        $email = $row['email'];
        $mobile = $row['mobile'];
    }

    if(isset($_POST['submit']))
    {
        $pass = get_safe_value($con, $_POST['pass']);
        $uid = $_SESSION['USER_ID'];
        mysqli_query($con,"UPDATE `users` SET `password`='$pass' WHERE id='$uid'");
        ?>
    <script>
        window.location.href="user_profile.php";
    </script>
    <?php
    }
}
else{
    ?>
    <script>
        window.location.href="index.php";
    </script>
    <?php
}

?>

<style>
    body {
    background-color: #f9f9fa;
    }

    .update_btn{
        background: linear-gradient(to right, #ee5a6f, #f29263);
        padding: 3px 9px;
        border: none;
        border-radius: 5px;
        color: white;
    }

    .pass_input{
        border: 1px solid grey;
    }

    .pass_input:focus {
        border: 1px solid #f29263!important;
    }

    .padding {
        padding: 3rem !important;
    }

    .user-card-full {
        overflow: hidden;
    }

    .card {
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        box-shadow: 0 1px 20px 0 rgba(69, 90, 100, 0.08);
        border: none;
        margin-bottom: 30px;
    }

    .m-r-0 {
        margin-right: 0px;
    }

    .m-l-0 {
        margin-left: 0px;
    }

    .user-card-full .user-profile {
        border-radius: 5px 0 0 5px;
    }

    .bg-c-lite-green {
        background: -webkit-gradient(linear, left top, right top, from(#f29263), to(#ee5a6f));
        background: linear-gradient(to right, #ee5a6f, #f29263);
    }

    .user-profile {
        padding: 20px 0;
    }

    .card-block {
        padding: 1.25rem;
    }

    .m-b-25 {
        margin-bottom: 25px;
    }

    .img-radius {
        border-radius: 5px;
    }

    h6 {
        font-size: 14px;
    }

    .card .card-block p {
        line-height: 25px;
    }

    @media only screen and (max-width: 600px) {
        .row>*{
            padding-right: 0; 
            /* padding-left: 0; */
        }

        .padding {
            padding: 1.5rem !important;
        }
    }

    @media only screen and (min-width: 1400px) {
        p {
            font-size: 14px;
        }
    }

    .card-block {
        padding: 1.25rem;
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0;
    }

    .m-b-20 {
        margin-bottom: 20px;
    }

    .p-b-5 {
        padding-bottom: 5px !important;
    }

    .card .card-block p {
        line-height: 25px;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .text-muted {
        color: #919aa3 !important;
    }

    .b-b-default {
        border-bottom: 1px solid #e0e0e0;
    }

    .f-w-600 {
        font-weight: 600;
    }

    .m-b-20 {
        margin-bottom: 20px;
    }

    .m-t-40 {
        margin-top: 20px;
    }

    .p-b-5 {
        padding-bottom: 5px !important;
    }

    .m-b-10 {
        margin-bottom: 10px;
    }

    .m-t-40 {
        margin-top: 20px;
    }

    .user-card-full .social-link li {
        display: inline-block;
    }

    .user-card-full .social-link li a {
        font-size: 20px;
        margin: 0 10px 0 0;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
    }
</style>

<div class="page-content page-container" style="margin-top: 110px;" id="page-content">
    <div class="padding">
        <div class="row container d-flex justify-content-center">
            <div class="col-xl-6 col-md-12">
                <div class="card user-card-full">
                    <div class="row m-l-0 m-r-0">
                        <div class="col-sm-4 bg-c-lite-green user-profile">
                            <div class="card-block text-center text-white">
                                <div class="m-b-25"> <img src="https://img.icons8.com/bubbles/100/000000/user.png" class="img-radius" alt="User-Profile-Image"> </div>
                                <h6 class="f-w-600"><?php echo $_SESSION['USER_NAME']?></h6>
                            </div>
                        </div>
                        <div class="col-sm-8">
                            <div class="card-block">
                                <h6 class="m-b-20 p-b-5 b-b-default f-w-600">Information</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Email</p>
                                        <h6 class="text-muted f-w-400"><?php echo $email?></h6>
                                    </div>
                                    <div class="col-sm-6">
                                        <p class="m-b-10 f-w-600">Phone</p>
                                        <h6 class="text-muted f-w-400"><?php echo $mobile?></h6>
                                    </div>
                                    <div class="col-sm-6 mt-2">
                                        <p class="m-b-10 f-w-600">Password</p>
                                        <h6 class="text-muted f-w-400"><?php echo $password?></h6>
                                    </div>
                                </div>
                                <h6 class="m-b-20 m-t-40 p-b-5 b-b-default f-w-600">Update Password</h6>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <form method="post">
                                            <p class="m-b-10 f-w-600"><input class="pass_input" id="pass" name="pass" type="text"></p>
                                            <h6 class="text-muted f-w-400"><input class="update_btn" name="submit" type="submit" value="Update"></h6>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php
require('footer.php');
?>
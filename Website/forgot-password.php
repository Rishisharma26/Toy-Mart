<?php require_once "controllerUserData.php"; ?>
<?php require('top.php');

if(isset($_SESSION['USER_LOGIN']) && $_SESSION['USER_LOGIN']!=''){
	header('location:index.php');
    die();
}
?>

<head>
	<style>
		body .loginpage {
			margin: 0;
			padding: 0;
			display: inline-block;
			justify-content: center;
			align-items: center;
			min-height: 100vh;
			font-family: 'Jost', sans-serif;
			background: linear-gradient(to bottom, #ee4e04, #e0a38a, #ee0101);
			/* background-image: url('image/banner2.jpg'); */
			background-image: url('image/login/login_background.jpg');
			background-repeat: no-repeat;
			width: 100%;
			background-position: center;
			background-attachment: fixed;

		}

		.loginpage .main {
			width: 350px;
			height: 700px;
			background: red;
			overflow: hidden;
			background: url("https://doc-08-2c-docs.googleusercontent.com/docs/securesc/68c90smiglihng9534mvqmq1946dmis5/fo0picsp1nhiucmc0l25s29respgpr4j/1631524275000/03522360960922298374/03522360960922298374/1Sx0jhdpEpnNIydS4rnN4kHSJtU1EyWka?e=view&authuser=0&nonce=gcrocepgbb17m&user=03522360960922298374&hash=tfhgbs86ka6divo3llbvp93mg4csvb38") no-repeat center/ cover;
			border-radius: 10px;
			box-shadow: 5px 20px 50px #000;
			position: relative;
		}

		.loginpage .main #chk {
			display: none;
		}

		.loginpage .main .signup {
			position: relative;
			width: 100%;
			height: 100%;

		}

		.loginpage label {
			color: rgb(252, 81, 2);
			font-size: 2.3em;
			justify-content: center;
			display: flex;
			margin: 60px;
			font-weight: bold;
			cursor: pointer;
			transition: .5s ease-in-out;
		}

		.loginpage input {
			width: 60%;
			height: 20px;
			background: #e0dede;
			justify-content: center;
			display: flex;
			margin: 20px auto;
			padding: 10px;
			border: none;
			outline: none;
			border-radius: 25px;
		}

		.loginpage .field_error {
			color: #F70D1A;
			text-align: center;
			background: #FDCDD0;
		}

		.loginpage .field_error1 {
			color: #9E9800;
			background: #FBF9C9;
			font-size: 22px;
			text-align: center;
		}

		.loginpage .field_error2 {
			color: #F70D1A;
			background: #FDCDD0;
			font-size: 22px;
			text-align: center;
			margin-top: 30px;
		}

		.loginpage button {
			width: 60%;
			height: 40px;
			margin: 10px auto;
			justify-content: center;
			display: block;
			color: #fff;
			background: rgb(252, 81, 2);
			font-size: 1em;
			font-weight: bold;
			margin-top: 20px;
			outline: none;
			border: none;
			border-radius: 5px;
			transition: .2s ease-in;
			cursor: pointer;
		}

		.loginpage button:hover {
			background: #fff;
			color: rgb(252, 81, 2);
		}

		.loginpage .login {
			height: 660px;
			background: #eee;
			border-radius: 60% / 10%;
			transform: translateY(-180px);
			transition: .8s ease-in-out;

		}

		.loginpage .login label {
			color: rgb(252, 81, 2);
			transform: scale(.6);
		}

		.loginpage #chk:checked~.login {
			transform: translateY(-700px);
		}

		.loginpage #chk:checked~.login label {
			transform: scale(1);
		}

		.loginpage #chk:checked~.signup label {
			transform: scale(.6);
		}
		
		a:hover{
			color: red;
		}
		a {
    color: #0d6efd;
    padding-left: 100px;
    text-decoration: underline;
}
.chk-email .button{
    width: 60%;
    height: 40px;
    margin: 10px auto;
    justify-content: center;
    display: block;
    color: #fff;
    background: rgb(252, 81, 2);
    font-size: 1em;
    font-weight: bold;
    margin-top: 20px;
    outline: none;
    border: none;
    border-radius: 5px;
    transition: .2s ease-in;
    cursor: pointer;
}

	</style>
</head>

<body>
	<div class="loginpage mt-5 py-5">
		<div class="main mx-auto">
		

			<div class="login">
				<form method="post" autocomplete="" action="forgot-password.php">
					<label for="chk" aria-hidden="true">Login</label>
					<?php
                    if(count($errors) > 0){
                        ?>
                        <div class="alert alert-danger text-center">
                            <?php
                            foreach($errors as $showerror){
                                echo $showerror;
                            }
                            ?>
                        </div>
                        <?php
                    }
                    ?>
					<div class="chk-email my-5 py-5">
                    <input style="padding: 15px;" type="email" name="login_email" id="login_email" placeholder="Email" autocomplete="off" required="">
					<div class="field_error" id="login_email_error"></div>
                    <input class="button" type="submit" name="check-email" value="Continue">
					<div class="field_error2 login_msg" id="form_message"></div>
                    </div>
                    
				</form>
			</div>
		</div>
	</div>
	</div>
</body>

</html>
<?php require('footer.php') ?>
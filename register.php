<?php
include_once('db/connect.php');
?>
<?php
if(isset($_POST['register'])) {
    $number = $_POST['number'];
    $pass = $_POST['pass'];
    $name = $_POST['name'];
    $sql_register = mysqli_query($con, "insert into tbl_account(phone_number, password, name) values('$number', '$pass', '$name')");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Đăng Ký</title>
</head>
<body>
    <div class='login-layout'>
        <div class='wrapper'>
            <div class='form-login-wrapper'>
                <h2 class='login-title'>ĐĂNG KÝ</h2>
                <div class='login-inf-wrapper'>
                    <form action="" method="POST">
                        <div class='inner'>
                            <input type="text" name="name" class='input-login' placeholder='Họ và tên'></input>
                        </div>
                        <div class='inner'>
                            <input type="text" name="number" class='input-login' placeholder='Số điện thoại'></input>
                        </div>
                        <div class='inner'>
                            <input type="password" name="pass" class='input-login' placeholder='Mật khẩu'></input>
                        </div>
                        <a class='forgot-password'>Quên mật khẩu?</a>
                        <input type="submit" name="register" class='btn-login' value="ĐĂNG KÝ">
                    </form>
                </div>
                <div class='social-media-options'>
                    <span class='divider'></span>
                    <span class='divider-text'>Hoặc đăng ký bằng</span>
                    <span class='divider'></span>
                </div>
                <div class='login-method'>
                    <button class='btn-wrapper'>
                        <img src='img/facebook.jpg' class='btn-icon'/>
                        Facebook
                    </button>
                    <button class='btn-wrapper'>
                        <img src='img/google.jpg' class='btn-icon'/>
                        Google
                    </button>
                    <button class='btn-wrapper'>
                        <img src='img/apple.jpg' class='btn-icon'/>
                        Apple ID
                    </button>
                </div>
                <div class='footer'>
                    Chưa có tài khoản?
                    <a class='register-option'>Đăng ký tài khoản mới</a>
                </div>
            </div>
        </div>
    </div>
</body>
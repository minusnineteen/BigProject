<?php
include_once('../db/connect.php');
session_start();
?>
<?php
if(isset($_POST['login_admin'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    if($user == '' || $pass == '') {
        echo '<p>Nhập đầy đủ!<p>';
    } else {
        $sql_admin = mysqli_query($con, "select * from tbl_admin where user = '$user' and pass = '$pass' limit 1");
        $count_admin = mysqli_num_rows($sql_admin);
        $row_admin = mysqli_fetch_array($sql_admin);
        if($count_admin > 0) {
            $_SESSION['admin_id'] = $row_admin['id'];
            $_SESSION['login_admin'] = $row_admin['user'];
            header('Location: dashboard.php');
        } else {
            echo '<p>Lỗi đăng nhập!<p>';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Đăng Nhập</title>
</head>
<body>
    <h1 align="center">Đăng Nhập Admin</h1>
    <div class="from-group" align="center">
        <form action="" method="POST">
            <label>Tài khoản (ad)</label><br>
            <input type="text" name="user" placeholder="Nhập id" class="from-control"><br>
            <label>Mật khẩu (123)</label><br>
            <input type="password" name="pass" placeholder="Nhập mật khẩu" class="from-control"><br>
            <input type="submit" name="login_admin" value="Đăng nhập admin">
        </form>
    </div>
</body>
</html>
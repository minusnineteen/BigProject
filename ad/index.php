<?php
session_start();
include_once('../db/connect.php');
?>
<?php
if(isset($_POST['login'])) {
    $user = $_POST['user'];
    $pass = md5($_POST['pass']);
    if($user == '' || $pass == '') {
        echo '<p>Error!<p>';
    } else {
        $sql_admin = mysqli_query($con, "select * from tbl_admin where user = '$user' and pass = '$pass' limit 1");
        $count = mysqli_num_rows($sql_admin);
        $row_login = mysqli_fetch_array($sql_admin);
        if($count > 0) {
            $_SESSION['login'] = $row_login['name'];
            $_SESSION['admin_id'] = $row_login['id'];
            header('Location: dashboard.php');
        } else {
            echo '<p>Error!<p>';
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
            <label>Tài khoản</label><br>
            <input type="text" name="user" placeholder="Nhập id" class="from-control"><br>
            <label>Mật khẩu</label><br>
            <input type="password" name="pass" placeholder="Nhập mật khẩu" class="from-control"><br>
            <input type="submit" name="login" value="Đăng nhập admin">
        </form>
    </div>
</body>
</html>
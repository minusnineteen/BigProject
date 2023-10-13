<?php
include_once('db/connect.php');
session_start();
?>
<?php
if(isset($_GET['status'])) {
    $logout = $_GET['status'];
} else {
    $logout = '';
}
if($logout == 'logout') {
    unset($_SESSION['login']);
    header('Location: index.php');
}
?>
<?php
if(isset($_POST['search'])) {
    $key = $_POST['search'];
    $sql_search = mysqli_query($con, "select * from tbl_information where title like '%$key%' order by information_code limit 10");
    $title = $key;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="grid.css">
    <link rel="stylesheet" href="style.css">
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Trang Chủ</title>
</head>
<body>
<header>
    <div class="logo">
    	<img src="" alt="Logo">
    </div>
    <div class="type">
        <li>
            <a><i class="bx bx-menu"></i>Danh Mục</a>
            <ul class="sub-type">
                <li><a href="">Mua Bán</a></li>
                <li><a href="">Cho Thuê</a></li>
            </ul>
        </li>
    </div>
    <div class="search">
        <form action="" method="POST"><input placeholder=" Tìm Kiếm... " name="search" type="text"><i class="bx bx-search" name="button" type="submit"></i></form>
    </div>
    <div class="heart">
        <a href="save.php" class="bx bx-heart"></a>
    </div>
    <div class="massage">
        <a href="" class="bx bx-message-rounded-dots"></a>
    </div>
    <div class="user">
        <a href="" class="bx bx-user"></a>
        <ul class="sub-user">
            <li><a href="upload.php">Đăng tin</a></li>
            <!-- <li><a href="">Đơn mua</a></li>
            <li><a href="">Đơn bán</a></li> -->
            <li><a href="register.php">Đăng ký</a></li>
            <li><a href="login.php">Đăng nhập</a></li>
            <li><a href="?status=logout">Đăng xuất</a></li>
            <li><a href=""><?php echo $_SESSION['login'] ?></a></li>
        </ul>
    </div>
</header>
<section id="save">
    <h1>Tìm kiếm</h1>
    <div class="save row">
        <?php
        while($row_info = mysqli_fetch_array($sql_search)) {
        ?>
        <div class="save-left">
            <a href="post.php?id=<?php echo $row_info['information_code'] ?>"><img src="up/<?php echo $row_info['picture'] ?>" width="100px" height="100px"></a>
        </div>
        <div class="save-right">
            <div class="save-right-top">
                <p><?php echo $row_info['title'] ?></p>
                <p><?php echo $row_info['acreage'] ?> m<sup>2</sup> - <?php echo $row_info['room'] ?> phòng</p>
                <p><?php echo $row_info['price'] ?> tỷ</p>
            </div>
            <div class="save-right-bottom">
                <p></p>
                <i class='bx bxs-heart'></i>
            </div>
        </div>
        <?php
        }
        ?>
    </div>
</section>
</body>
<script>
        const search = document.getElementById('search');
        document.addEventListener('click', function(event) {
        if (!search.contains(event.target)) {
            const openSearchBox = document.getElementById('key');
            openSearchBox.checked = false;
        }
    });
</script>
</html>
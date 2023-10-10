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
        <a href="" class="bx bx-heart"></a>
    </div>
    <div class="massage">
        <a href="" class="bx bx-message-rounded-dots"></a>
    </div>
    <div class="user">
        <a href="" class="bx bx-user"></a>
        <ul class="sub-user">
            <li><a href=""><?php echo $_SESSION['login'] ?></a></li>
            <li><a href="upload.php">Đăng tin</a></li>
            <li><a href="">Đơn mua</a></li>
            <li><a href="">Đơn bán</a></li>
            <li><a href="login.php">Đăng nhập</a></li>
            <li><a href="?status=logout">Đăng xuất</a></li>
        </ul>
    </div>
</header>
<section id="slider">
    <div class="slider-show">
        <div class="slider">
            <img src="1.webp" width="100%" alt="">
            <!-- <img src="2.webp" width="100%" alt=""> -->
        </div>
        <!-- <div class="arrow">
            <div class="prev control"><i class='bx bx-chevron-left-circle'></i></div>
            <div class="next control"><i class='bx bx-chevron-right-circle'></i></div>
        </div>
        <div class="index">
            <div class="index-item index-item-0 active"></div>
            <div class="index-item index-item-1"></div>
            <div class="index-item index-item-2"></div>
            <div class="index-item index-item-3"></div>
        </div> -->
    </div>
</section> 
<section id="type">
    <div class="row">
        <div class="button col l-3">
            <img src="3.png" width="100px" height="100px">
            <h1>Mua Bán</h1>
        </div>
        <div class="button col l-3">
            <img src="4.webp" width="100px" height="100px">
            <h1>Cho Thuê</h1>
        </div>
        <div class="button col l-3">
            <img src="5.png" width="100px" height="100px">
            <h1>Biểu Đồ</h1>
        </div>
        <div class="button col l-3">
            <img src="6.webp" width="100px" height="100px">
            <h1>Vay Mua</h1>
        </div>
    </div>
</section>
<section id="sell">
    <div class="sell-top">
        <h1>Mua bán Bất Động Sản:</h1>
    </div>
    <div class="row">
        <?php
        $sql_sell = mysqli_query($con, "select * from tbl_information where business_code = 1 order by information_code desc limit 6");
        while($row_sell = mysqli_fetch_array($sql_sell)) {
        ?>
        <div class="item col l-2">
            <img src="<?php echo $row_sell['picture']?>" width="150px" height="150px">
            <h1><?php echo $row_sell['title']?></h1>
            <p><?php echo $row_sell['acreage']?>m2 - <?php echo $row_sell['room']?> phòng</p>
            <p><?php echo $row_sell['price']?> tỷ</p>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="sell-bottom">
        <h3>Xem thêm</h3>
    </div>
</section>
<section id="rent">
    <div class="rent-top">
        <h1>Cho thuê Bất Động Sản:</h1>
    </div>
    <div class="row">
        <?php
        $sql_rent = mysqli_query($con, "select * from tbl_information where business_code = 2 order by information_code desc limit 6");
        while($row_rent = mysqli_fetch_array($sql_rent)) {
        ?>
        <div class="item col l-2">
            <img src="<?php echo $row_rent['picture']?>" width="150px" height="150px">
            <h1><?php echo $row_rent['title']?></h1>
            <p><?php echo $row_rent['acreage']?>m2 - <?php echo $row_rent['room']?> phòng</p>
            <p><?php echo $row_rent['price']?> tỷ</p>
        </div>
        <?php
        }
        ?>
    </div>
    <div class="rent-bottom">
        <h3>Xem thêm</h3>
    </div>
</section>
<section id="chart"></section>
<!-- <div id="backtop">
    <i class='bx bx-chevron-up'></i>
</div> -->
<footer>
    <div class="contact">
        <div class="footer-left">
            <img src="" alt="Logo"/>
            <h1>TÊN CÔNG TY</h1>
            <p>Địa Chỉ<br>
            (024) 1234 1234</p>
        </div>
        <div class="footer-right">
            <div class="hotline">
                <i class='bx bxs-phone-call'> Hotline </i>
                <p>1900 1234</p>
            </div>
            <div class="support">
                <i class='bx bxs-user-voice'> Hỗ trợ khách hàng </i>
                <p>hotro@email.com</p>
            </div>
            <div class="care">
            </div>
                <i class='bx bx-support'> Chăm sóc khách hàng </i>
                <p>chamsoc@email.com</p>
            </div>
        </div>
    </div>
</footer>
</body>
</html>
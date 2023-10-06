<?php
include_once('db/connect.php');
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
    <title>Tin Đăng</title>
</head>
<body>
<style>
    body {
        border-left: 100px solid #ccc;
        border-right: 100px solid #ccc;
    }
</style>
<section id="post">
    <div class="post row">
        <div class="post-left row">
            <div class="post-big">
                <?php
                // $id = $_GET['id'];
                $sql_info = mysqli_query($con, 'select * from tbl_information');
                while($row_info = mysqli_fetch_array($sql_info)) {
                    // if($row_info['information_code'] == $id) {
                ?>
                <img src= "<?php echo $row_info['picture'] ?>" width="500px" height="500px">
                <?php
                    // }
                }
                ?>
            </div>
            <!-- <div class="post-small">                
                <img src="7.webp" width="100px" height="100px">
                <img src="7.webp" width="100px" height="100px">
                <img src="7.webp" width="100px" height="100px">
                <img src="7.webp" width="100px" height="100px">
                <div class="zoom">
                    <p>More</p>
                </div>
            </div> -->
        </div>
        <div class="post-right">
            <div class="post-title">
                <h1>Tiêu Đề</h1>
                <p>Địa chỉ</p>
            </div>
            <div class="post-price">
                <div class="post-price-left">
                    <p>1 tỷ</p>
                    <p>- 100 m<sup>2</sup></p>
                </div>
                <div class="post-price-right">
                    <i class='bx bx-share'></i>
                    <i class='bx bx-heart'></i>
                </div>
            </div>
            <div class="post-info">
                <div class="post-info-left">
                    <p>Diện tích: ...</p>
                    <p>Số phòng: ...</p>
                </div>
                <div class="post-info-right">
                    <p>Chiều ngang: ...</p>
                    <p>Chiều dài: ...</p>
                </div>
            </div>
            <div class="post-more">
                <p>Mô tả từ người đăng<br>...<br>...</p>
            </div>
            <div class="account">
                <div class="account-top row">
                    <img src="8.jpg" width="50px" height="50px">
                    <div class="account-info">
                        <p>Tên</p>
                        <a href="">Xem trang</a>
                    </div>
                    <i class='bx bxs-show'></i>
                </div>
                <div class="account-bottom">
                    <div class="account-call">
                        <i class='bx bx-phone-call'> Liên hệ </i>
                    </div>
                    <div class="account-chat">
                        <i class='bx bx-conversation'> Nhắn tin </i>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section id="account"></section>
<section id="sell">
    <div class="sell-top">
        <h1>Tin Mới Bất Động Sản:</h1>
    </div>
    <div class="row">
        <div class="item col l-2">
            <img src="7.webp" width="150px" height="150px">
            <h1>Tiêu Đề</h1>
            <p>m2 - phòng</p>
            <p>giá</p>
        </div>
        <div class="item col l-2">
            <img src="7.webp" width="150px" height="150px">
            <h1>Tiêu Đề</h1>
            <p>m2 - phòng</p>
            <p>giá</p>
        </div>
        <div class="item col l-2">
            <img src="7.webp" width="150px" height="150px">
            <h1>Tiêu Đề</h1>
            <p>m2 - phòng</p>
            <p>giá</p>
        </div>
        <div class="item col l-2">
            <img src="7.webp" width="150px" height="150px">
            <h1>Tiêu Đề</h1>
            <p>m2 - phòng</p>
            <p>giá</p>
        </div>
        <div class="item col l-2">
            <img src="7.webp" width="150px" height="150px">
            <h1>Tiêu Đề</h1>
            <p>m2 - phòng</p>
            <p>giá</p>
        </div>
        <div class="item col l-2">
            <img src="7.webp" width="150px" height="150px">
            <h1>Tiêu Đề</h1>
            <p>m2 - phòng</p>
            <p>giá</p>
        </div>
    </div>
    <div class="sell-bottom">
        <h3>Xem thêm</h3>
    </div>
</section>
</body>
</html>
<?php
include_once('db/connect.php');
session_start();
?>
<?php
if(isset($_POST['save'])) {
    $id = $_GET['id'];
    $number = $_SESSION['id'];
    $sql_save = mysqli_query($con, "insert into tbl_favorite(information_code, phone_number) values('$id', '$number')");
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
            <?php
            $id = $_GET['id'];
            $sql_info = mysqli_query($con, 'select * from tbl_information order by information_code');
            while($row_info = mysqli_fetch_array($sql_info)) {
                if($row_info['information_code'] == $id) {
            ?>
            <div class="post-big">    
                <img src= "up/<?php echo $row_info['picture'] ?>" width="500px" height="500px">
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
                <h1><?php echo $row_info['title'] ?></h1>
                <p><?php echo $row_info['address'] ?></p>
            </div>
            <div class="post-price">
                <div class="post-price-left">
                    <p><?php echo $row_info['price'] ?> tỷ</p>
                    <p>- <?php echo $row_info['acreage'] ?> m<sup>2</sup></p>
                </div>
                <div class="post-price-right">
                    <i class='bx bx-share'></i>
                    <i class='bx bx-heart'></i>
                    <form method="POST">
                        <input type="submit" name="save" value="Lưu">
                    </form>
                </div>
            </div>
            <div class="post-info">
                <div class="post-info-left">
                    <p>Diện tích: <?php echo $row_info['acreage'] ?></p>
                    <p>Số phòng: <?php echo $row_info['room'] ?></p>
                </div>
                <div class="post-info-right">
                    <p>Chiều ngang: <?php echo $row_info['width'] ?></p>
                    <p>Chiều dài: <?php echo $row_info['length'] ?></p>
                </div>
            </div>
            <div class="post-more">
                <p>Mô tả:<br><?php echo $row_info['description'] ?></p>
            </div>
            <?php
                }
            }
            ?>
            <div class="account">
                <div class="account-top row">
                    <img src="8.jpg" width="50px" height="50px">
                    <div class="account-info">
                        <?php
                        $id = $_GET['id'];
                        $sql_account = mysqli_query($con, 'select * from tbl_information inner join tbl_account on tbl_information.phone_number = tbl_account.phone_number');
                        while($row_account = mysqli_fetch_array($sql_account)) {
                            if($row_account['information_code'] == $id) {
                        ?>
                        <p><?php echo $row_account['name'] ?></p>
                        <a href="">Xem trang</a>
                        <?php
                            }
                        }
                        ?>
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
<section id="hot">
    <div class="hot-top">
        <h1>Tin Mới Bất Động Sản:</h1>
    </div>
    <div class="row">
        <?php
        $sql_rent = mysqli_query($con, "select * from tbl_information order by information_code desc limit 6");
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
    <div class="hot-bottom">
        <h3>Xem thêm</h3>
    </div>
</section>
</body>
</html>
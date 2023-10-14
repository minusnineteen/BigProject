<?php
include_once('db/connect.php');
session_start();
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
<section id="save">
    <?php
    $phone_number = isset($_GET['phone_number']) ? $_GET['phone_number'] : $_SESSION['id'];
    $sql_info = mysqli_query($con, "select * from tbl_information where phone_number = " .$phone_number);
    while($row_info = mysqli_fetch_array($sql_info)) {
    ?>
    <div class='save row'>
        <div class="save-left">
            <a href="post.php?id=<?php echo $row_info['information_code'] ?>"><img src="up/<?php echo $row_info['picture'] ?>" width="100px" height="100px"></a>
        </div>
        <div class="save-right">
            <div class="save-right-top">
                <p><?php echo $row_info['title']?></p>
                <p><?php echo $row_info['acreage']?> m<sup>2</sup> - <?php echo $row_info['room']?> phòng</p>
                <p><?php echo $row_info['price']?> tỷ</p>
            </div>
            <div class="save-right-bottom">
                <p></p>
                <i class='bx bx-heart'></i>
                <form method="POST">
                    <input type="submit" name="edit" value="Sửa">
                    <input type="submit" name="del" value="Xóa">
                </form>
            </div>
        </div>
    </div>
    <?php 
    }
    ?>
</section>
</body>
</html>
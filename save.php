<?php
include_once('db/connect.php');
session_start();
?>
<?php
if(isset($_SESSION['id'])) {

} else {
    header('Location: login.php');
}
?>
<?php
if(isset($_POST['del'])) {
    $id = $_POST['id'];
    $sql_del = mysqli_query($con, "delete from tbl_favorite where favorite_code = $id");
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
    <title>Lưu Tin</title>
</head>
<body>
    <?php
    include('incl/header.php');
    ?>
    <section id="save">
        <div class="bg">
            <div class="save row">
                <?php
                $number = $_SESSION['id'];
                $sql_info = mysqli_query($con, "select * from tbl_information 
                    inner join tbl_account on tbl_information.phone_number = tbl_account.phone_number
                    inner join tbl_favorite on tbl_information.information_code = tbl_favorite.information_code");
                while($row_info = mysqli_fetch_array($sql_info)) {
                    if($row_info['phone_number'] == $number) {
                ?>
                <div class="save-left">
                    <a href="post.php?id=<?php echo $row_info['information_code'] ?>">
                        <img src="up/<?php echo $row_info['picture'] ?>" width="100px" height="100px">
                    </a>
                </div>
                <div class="save-right">
                    <div class="save-right-top">
                        <p><?php echo $row_info['title'] ?></p>
                        <p><?php echo $row_info['acreage'] ?> m<sup>2</sup> - <?php echo $row_info['room'] ?> phòng</p>
                        <p><?php echo $row_info['price'] ?> tỷ</p>
                    </div>
                    <div class="save-right-bottom">
                        <p><?php echo $row_info['name'] ?></p>
                        <form method="POST">
                            <input type="hidden" name="id" value="<?php echo $row_info['favorite_code'] ?>">
                            <input type="submit" name="del" value="Bỏ Lưu">
                        </form>
                    </div>
                </div>
                <?php
                    }
                }
                ?>
            </div>
        </div>
    </section>
    <?php
    include('incl/footer.php');
    ?>
</body>
</html>
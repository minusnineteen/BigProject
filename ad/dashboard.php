<?php
include_once('../db/connect.php');
?>
<?php
session_start();
if(!isset($_SESSION['login'])) {
    header('Location: index.php');
}
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
    <style>
        .row {
            display: flex;
            flex-wrap: wrap;
        }
        table {
            border: 1px solid black;
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            text-align: center;
            border: 1px solid black;
        }
    </style>
    <title>Chào Mừng</title>
</head>
<body>
    <h1 align="center"><?php echo $_SESSION['login'] ?></h1>
    <p align="center"><a href="?status=logout">Đăng xuất</a></p>
    <div class="row">
    <div>
        <h3>Danh sách tin đăng</h3>
        <?php
        $sql_select = mysqli_query($con, "select * from tbl_information, tbl_business, tbl_category, tbl_account 
            where tbl_information.business_code = tbl_business.business_code
            and tbl_information.category_code = tbl_category.category_code
            and tbl_information.phone_number = tbl_account.phone_number
            order by information_code desc");
        ?>
        <table>
            <tr>
                <th>STT</th>
                <th>Loại kinh doanh</th>
                <th>Loại bất động sản</th>
                <th>Hình ảnh</th>
                <th>Tiêu đề</th>
                <th>Địa chỉ</th>
                <th>Giá</th>
                <th>Diện tích</th>
                <th>Số phòng</th>
                <th>Người đăng</th>
                <th>Quản lý</th>
            </tr>
            <?php
            $i = 0;
            while($row_post = mysqli_fetch_array($sql_select)) {
                $i++;
            ?>
            <tr>
                <td><?php echo $i ?></td>
                <td><?php echo $row_post['business_name'] ?></td>
                <td><?php echo $row_post['category_name'] ?></td>
                <td><img src="../up/<?php echo $row_post['picture'] ?>" height="50" width="50"></td>
                <td><?php echo $row_post['title'] ?></td>
                <td><?php echo $row_post['address'] ?></td>
                <td><?php echo $row_post['price'] ?></td>
                <td><?php echo $row_post['acreage'] ?></td>
                <td><?php echo $row_post['room'] ?></td>
                <td><?php echo $row_post['name'] ?></td>
                <td><a href="?edit=<?php echo $row_post['information_code'] ?>">Xem</a> | <a href="?del=<?php echo $row_post['information_code'] ?>">Xóa</a></td>
            </tr>
            <?php
            }
            ?>
        </table>
    </div>
</body>
</html>
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
    <?php
    include('incl/header.php');
    ?>
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
    <?php
    include('incl/footer.php');
    ?>
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
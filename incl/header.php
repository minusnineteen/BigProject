<header>
    <div class="logo">
    	<img src="" alt="Logo">
    </div>
    <div class="type">
        <li>
            <a><i class="bx bx-menu"></i>Danh Mục</a>
            <ul class="sub-type">
                <li><a href="list_purchase.php">Mua Bán</a></li>
                <li><a href="list_lease.php">Cho Thuê</a></li>
            </ul>
        </li>
    </div>
    <div class="search">
        <form action="search.php" method="POST"><input placeholder=" Tìm Kiếm... " name="search" type="text"><i class="bx bx-search" name="button" type="submit"></i></form>
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
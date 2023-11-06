<header>
    <div class="logo">
    	<a href="index.php"><img src="logo.png" alt="Logo" width="100px"></a>
    </div>
    <div class="type">  
        <div class="row">
            <i class="bx bx-menu"></i>
            <p>Danh Mục</p>
        </div>
        <ul class="sub-type">
            <li><a href="list_purchase.php">Mua Bán</a></li>
            <li><a href="list_lease.php">Cho Thuê</a></li>
        </ul>
    </div>
    <div class="search">
        <form action="search.php" method="POST"><input placeholder=" Tìm Kiếm... " name="search" type="text"><i class="bx bx-search" name="button" type="submit"></i></form>
    </div>
    <div class="heart">
        <a href="save.php" class="bx bx-heart"></a>
    </div>
    <div class="message">
        <a href="#" class="bx bx-message-rounded-dots"></a>
    </div>
    <div class="user">
        <a class="bx bx-user" id="user"></a>
        <ul class="sub-user" id="sub-user">
            <li><a href="upload.php">Đăng tin</a></li>
            <li><a href="register.php">Đăng ký</a></li>
            <li><a href="login.php">Đăng nhập</a></li>
            <li><a href="?status=logout">Đăng xuất</a></li>
            <li><a href="personal.php?phone_number=<?php echo $_SESSION['id'] ?>"><?php echo $_SESSION['login'] ?></a></li>
        </ul>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
    $(document).ready(function() {
        $("#user").click(function() {
            $("#sub-user").toggle();
        });
    });
    </script>
</header>
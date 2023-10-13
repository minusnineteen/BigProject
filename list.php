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
    <title>Trang Chủ</title>
</head>
<body>
<section id="filter" class='list-container'>
    <div class="body-wrapper">
        <div class="body-left">
            <div class="body-left-top">
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=2" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="house.jpg" class="quick-filter-item-icon">
                                <span>Nhà ở</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=1" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="land.jpg" class="quick-filter-item-icon">
                                <span>Đất</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=3" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="realestate.jpg" class="quick-filter-item-icon">
                                <span>Căn hộ/Chung cư</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=4" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="businesspremises.jpg" class="quick-filter-item-icon">
                                <span>Văn phòng kinh doanh</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="arrange-wrapper">
                <span>Bộ lọc</span>
                <a href="?filter=1">Dưới 2 tỷ</a>
                <a href="?filter=2">2 tỷ - 4 tỷ</a>
                <a href="?filter=3">4 tỷ - 10 tỷ</a>
                <a href="?filter=4">Trên 10 tỷ</a>
                <?php
                    $filter = isset($_GET['filter']) ? $_GET['filter'] : 1;
                ?>
                <a href="?filter=<?php echo $filter; ?>&arrange=1">Tăng dần</a>
                <a href="?filter=<?php echo $filter; ?>&arrange=2">Giảm dần</a>
            </div>
            <div class="save-wrapper">
                <div>
                    <?php
                    session_start();
                    $item_per_page = isset($_GET['per_page']) ? $_GET['per_page'] : 10;
                    $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
                    $offset = ($current_page - 1) * $item_per_page;
                    $filter = isset($_GET['filter']) ? $_GET['filter'] : 5;
                    $arrange = isset($_GET['arrange']) ? $_GET['arrange'] : 1;
                    $category = isset($_GET['category']) ? $_GET['category'] : 1;
                    $_SESSION['filter'] = $filter;
                    $value_left = 0.0;
                    $value_right = 10000.0;
                    if($filter == 1){
                        $value_right = 2.0;
                    } else if($filter == 2){
                        $value_left = 2.0;
                        $value_right = 4.0;
                    }
                    else if($filter == 3){
                        $value_left = 4.0;
                        $value_right = 10.0;
                    }
                    else if($filter == 4){
                        $value_left = 10.0;
                        $value_right = 999999.0;
                    }
                    if ($arrange == 1) {
                        $orderByClause = " ORDER BY price ASC";
                    } elseif ($arrange == 2) {
                        $orderByClause = " ORDER BY price DESC";
                    }
                    
                    $sql_info = mysqli_query($con, "select * from tbl_information where category_code = ". $category ."
                    and price > ".$value_left." and price <= ".$value_right." ".$orderByClause." ,information_code asc
                    limit ". $item_per_page ." offset ". $offset);                    
                        while($row_info = mysqli_fetch_array($sql_info)) {
                    ?>
                        <div class='save-row-wrapper'>
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
                                </div>
                            </div>
                        </div>
                        <?php 
                        }
                        ?>
                </div>
            </div>
            <div class='paging-container'>
                <div class='paging-wrapper'>
                    <?php
                    if($current_page != 1)
                    {
                    ?>
                        <div class='paging-item'>
                        <a href="?per_page=10&page=<?php echo ($current_page > 1) ? ($current_page - 1) : 1; ?>" class='paging-text'>
                            <i class='bx bx-chevron-left'></i>
                        </a>
                    </div>
                    <?php
                    }
                    ?>
                    
                    <?php
                    
                    $category = isset($_GET['category']) ? $_GET['category'] : 1;
                    $sql_info = mysqli_query($con, "select count(*) AS total_rows from tbl_information
                    where category_code = ".$category." and price > ".$value_left." and price <= ".$value_right);
                    $row = mysqli_fetch_assoc($sql_info);
                    $total_rows = $row['total_rows'];
                    $page_number = $total_rows/10;
                    if($total_rows % 10 != 0){
                        $page_number += 1;
                    }
                    $i = 1;
                    while($i <= $page_number) {
                        
                    ?>
                    <div class='paging-item'><a href="?per_page=10&page=<?php echo $i; ?>
                    &filter=<?php echo $filter; ?>&arrange=<?php echo $arrange; ?>" class='paging-text'><?php echo $i ?></a></div>
                    <?php
                    $i++;
                    }
                    ?>
                    <?php
                    if($current_page < ($page_number - 1))
                    {
                    ?>
                        <div class='paging-item'>
                            <a href="?per_page=10&page=<?php echo ($current_page < $page_number) ? ($current_page + 1) : $current_page; ?>" class='paging-text'>
                                <i class='bx bx-chevron-right'></i>
                            </a>
                        </div>
                    <?php
                    }
                    ?>
                    
                </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

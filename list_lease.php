<?php
ini_set('session.cookie_lifetime', 86400); // 86400 seconds (1 day)
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <title>Cho thuê</title>
</head>
<?php
session_start();
?>
<body>
    <?php
    include('incl/header.php');
    ?>
<script>
    $(document).ready(function() {
        $("#select").change(function() {
            var selectedValue = $(this).val();
            $.ajax({
                type: "POST",
                url: "get_area_id.php",
                data: { area_id: selectedValue },
                success: function(data) {
                    selectedValue = JSON.parse(data);
                }
            });
        });
    });
</script>
<section id="filter" class='list-container'>
    <div class="body-wrapper">
        <div class="body-left">
            <div class="body-left-top">
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=2" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="img/house.jpg" class="quick-filter-item-icon">
                                <span>Nhà</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=1" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="img/land.jpg" class="quick-filter-item-icon">
                                <span>Đất</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=3" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="img/apartment.jpg" class="quick-filter-item-icon">
                                <span>Chung cư</span>
                            </div>
                        </a>
                    </div>
                </div>
                <div class="quick-filter-wrapper">
                    <div class="quick-filter-content">
                        <a href="?category=4" class="quick-filter-link">
                            <div class="quick-filter-item">
                                <img src="img/business.jpg" class="quick-filter-item-icon">
                                <span>Mặt bằng</span>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
            <div class="arrange-wrapper" style='height: 40px'>
            <select class='form-control province' id='select' style='width: 90px;' onchange="reloadPage(this)">
                <option>Khu vực</option>
                <?php
                    $sql_info = mysqli_query($con, "select * from tbl_area");
                    $i = 1; 
                    while($row_info = mysqli_fetch_array($sql_info)){
                ?>
                    <option value="<?php echo $i; ?>"><?php echo $row_info['area_name']; ?></option>  
                <?php
                    $i++;
                    }
                ?>
            </select>
            <script>
            function reloadPage(selectElement) {
                // Get the selected value from the <select>
                var selectedValue = selectElement.value;
                
                // Reload the page
                location.reload();
            }
            </script>
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
                    
                    $_SESSION['area_id'] = isset($_SESSION['area_id']) ? $_SESSION['area_id'] : 0;
                    if($_SESSION['area_id'] == 0){
                        $area = "";
                    }else{
                        $area = "and area_code = ".$_SESSION['area_id'];
                    }
                    $sql_info = mysqli_query($con, "select * from tbl_information where category_code = ". $category ."
                    and business_code = 2 ".$area." and price > ".$value_left." and price <= ".$value_right." ".$orderByClause." ,
                    information_code asc limit ". $item_per_page ." offset ". $offset);                    
                        while($row_info = mysqli_fetch_array($sql_info)) {
                    ?>
                        <div class='save-row-wrapper'>
                            <div class="save-left">
                                <a href="post.php?id=<?php echo $row_info['information_code'] ?>">
                                <img src="up/<?php echo $row_info['picture'] ?>" width="100px" height="100px"></a>
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
                    where category_code = ".$category." ".$area." and business_code = 2 and price > ".$value_left."
                    and price <= ".$value_right);
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
                    $_SESSION['area_id'] = 0;
                    ?>
                    
                </div>
                </div>
            </div>
        </div>
    </section>
    <?php
    include('incl/footer.php');
    ?>
</body>
</html>

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
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>Biểu Đồ</title>
</head>
<body>
    
    <section id="chart">
        <div class="chart row">
            <div class="chart-left">
                <p>Biểu đồ giá Bất Động Sản:</p>
            </div>
            <div class="chart-right">
                <select class="form-control province" id="select" style="height: 25px;">
                    <option value="0">---Chọn khu vực---</option>
                    <?php
                    $sql_info = mysqli_query($con, "select * from tbl_area");
                    $i = 1;
                    while ($row_info = mysqli_fetch_array($sql_info)) {
                    ?>
                    <option value="<?php echo $i; ?>" <?php echo ($i == 1) ? "selected" : ""; ?>>
                        <?php echo $row_info['area_name']; ?>
                    </option>
                    <?php
                    $i++;
                    }
                    ?>
                </select>
            </div>
        </div>

        <!-- <div style='margin: 100px 30px 10px; height: 25px;'>
            <select class='form-control province' id='select' style='height: 25px;'>
                <option value="0">---Chọn khu vực---</option>
                <?php
                $sql_info = mysqli_query($con, "select * from tbl_area");
                $i = 1;
                while ($row_info = mysqli_fetch_array($sql_info)) {
                ?>
                <option value="<?php echo $i; ?>">
                    <?php echo $row_info['area_name']; ?>
                </option>
                <?php
                $i++;
                }
                ?>
            </select>
        </div> -->
        
        <div id="myfirstchart" style="height: 250px;"></div>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <script type="text/javascript">
            var chartData;

            function loadDefaultChartData() {
                var area_code = $(".province").val();
                $.ajax({
                    type: 'POST',
                    url: 'get_chart_data.php',
                    data: {
                        select_national: area_code
                    },
                    success: function (data) {
                        chartData = JSON.parse(data);
                        char.setData(chartData);
                    }
                });
            }

            $(document).ready(function () {
                $(".province").change(function () {
                    loadDefaultChartData();
                });

                // Initialize the chart with default data
                char = new Morris.Area({
                    element: 'myfirstchart',
                    data: chartData,
                    xkey: 'year',
                    ykeys: ['value'],
                    labels: ['Giá'],
                    parseTime: false, // Tắt tự động định dạng thời gian
                    xLabelAngle: 0, // Đặt góc xoay về 0 độ (ngang)
                    padding: 60,
                    hoverCallback: function (index, options, content, row) {
                        var formattedValue = '<span style="font-size: 16px;">Giá: ' + row.value + ' Tỷ</span>'; // Đặt font-size ở đây
                        return formattedValue;
                    },
                });

                // Load default chart data when the page loads
                loadDefaultChartData();
            });
        </script>
    </section>

</body>
</html>
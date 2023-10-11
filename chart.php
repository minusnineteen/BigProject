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
    <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
    <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
    <title>Chart</title>
</head>
<body>
    <div style='margin:10px 15px; height: 25px;' >
        <select class='form-control province' id='select' style='height: 25px;'>
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
    </div>
    <div id="myfirstchart" style="height: 250px;"></div>
    <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
    
    
    <script type="text/javascript">
         $(document).ready(function(){
            var char;
            var chartData;

            $(".province").change(function(){
                var area_code = $(".province").val();
                alert(area_code);

                // Fetch data from the server based on the selected option
                $.ajax({
                    type: 'POST',
                    url: 'get_chart_data.php', // Replace with the actual URL
                    data: { select_national: area_code },
                    success: function(data) {
                        chartData = JSON.parse(data);
                        char.setData(chartData);
                    }
                });
            });

            // Initialize the chart with default data
            char = new Morris.Area({
                element: 'myfirstchart',
                data: chartData,
                xkey: 'year',
                ykeys: ['value'],
                labels: ['Giá']
            });
        });

    </script>
</body>
</html>
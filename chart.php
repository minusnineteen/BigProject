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
    <script src="ajax.js" type="text/javascript"></script>
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
            $(document).ready(function(){
            $(".province").change(function(){
            var id = $(".province").val();
            alert(id);
        });
        });
        var chartData = [
            <?php
            
            $area_code = isset($_POST['select-national']) ? $_POST['select-national']: 1;
            $sql_info = mysqli_query($con, "select * from tbl_information where area_code = ".$area_code);
            while($row_info = mysqli_fetch_array($sql_info)){
            ?>
            { year: '<?php echo $row_info['date_time']?>', value: '<?php echo $row_info['price']?>' },
            
            <?php
            }
            ?>
        ];

        var char = new Morris.Area({
            element: 'myfirstchart',
            data: chartData,
            xkey: 'year',
            ykeys: ['value'],
            labels: ['Giá']
        });

        $('#select-national').on('change', function() {
            $area_code = $(this).val();
            console.log($area_code);
            char.setData(chartData);
        });
    });

    </script>
</body>
</html>
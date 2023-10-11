<?php
// Include your database connection file here
include_once('db/connect.php');

if (isset($_POST['select_national'])) {
    $area_code = $_POST['select_national'];
    $data = array();

    $sql_info = mysqli_query($con, "select * from tbl_information where area_code = " . $area_code);

    while ($row_info = mysqli_fetch_array($sql_info)) {
        $data[] = array(
            'year' => $row_info['date_time'],
            'value' => $row_info['price'],
        );
    }
}
echo $data = json_encode($data);
?>

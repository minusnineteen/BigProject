<?php
include_once('db/connect.php');
session_start();
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
    <title>Chat box</title>
</head>
<script>
    function goBack() {
        window.history.back();
    }
</script>
<body class="chat-box">
    <div class='chat-box-wrapper'>
        <section class='chat-area'>
            <div class='header-chat-box'>
                <?php
                if (isset($_SESSION['id'])) {
                    $id = $_SESSION['id'];
                } else {
                    header("Location: http://localhost/land/login.php");
                    exit;
                }
                $sql_message = mysqli_query($con, "select * from tbl_account where phone_number = " . $_SESSION['id']);
                $row_message = mysqli_fetch_array($sql_message);
                $_SESSION['message_outgoing'] = $row_message['message_id'];
                $_SESSION['phone_number'] = isset($_GET['phone_number']) ? $_GET['phone_number'] : $_SESSION['phone_number'];
                $sql = mysqli_query($con, "select * from tbl_account where phone_number = " . $_SESSION['phone_number']);
                $row = mysqli_fetch_array($sql);
                $_SESSION['message_id'] = $row['message_id'];
                ?>
                <a href="#" onclick="goBack();"><i class='bx bx-arrow-back'></i></a>
                <a href="personal.php?phone_number=<?php echo $_SESSION['phone_number'] ?>" class='name-tag'>
                    <?php echo $row['name'] ?>
                </a>
            </div>
            <div class='chat-content'>
            </div>
            <form action="#" class='typing-area'>
                <input type="text" name='incoming_id' class='incoming_id' value='<?php echo $_SESSION['message_id'] ?>'
                    id='' hidden>
                <input type="text" name='message' class='input-field' placeholder='Nhập nội dung ở đây...'
                    autocomplete='off'>
                <button class='send-btn'>
                    <i class='bx bxl-telegram'></i>
                </button>
            </form>
        </section>
    </div>
    <script src='chat-event.js'></script>
</body>
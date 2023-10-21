<?php
include_once('db/connect.php');
?>
<?php
    class ChatController{
        public class getUserByID($message_id){
            $sql = mysqli_query($con, "select * from tbl_account where message_id = ".$message_id);
            if(mysqli_num_rows($sql) > 0){
                return mysqli_fetch_assoc($sql);
            }
        }
    }
?>

<!-- xóa user -->
<?php
session_start();
include_once('modules/connect/connect.php');
if (isset($_SESSION['mail']) && isset($_SESSION['pass'])) {
    $id = $_GET['id'];
    $sql = "DELETE FROM user WHERE id='$id'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=user');
} else {
    die('ban can dang nhap truoc!');
}
?>
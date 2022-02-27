<!-- xóa nhiệm vụ (không sử dụng) -->
<?php
session_start();
include_once('modules/connect/connect.php');
if(isset($_SESSION['mail'])&& isset($_SESSION['pass'])){
    $id=$_GET['id'];
    $sql="DELETE FROM congviec WHERE IDCV='$id'";
    mysqli_query($conn, $sql);
    header('location: index.php?page_layout=nhiemvu');
}
?>
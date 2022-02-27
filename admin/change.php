<!-- trang đổi mật khẩu của nhân viên khi mới tạo tài khoản hoặc mới bị reset mật khẩu -->
<?php
ob_start();
include_once("modules/connect/connect.php");
// define('nhanvien', true);
session_start();
if(isset($_SESSION['mail'])&&isset($_SESSION['pass'])){
    $mail = $_SESSION['mail'];
    $pass = $_SESSION['pass'];
    $sql = "SELECT*FROM user WHERE username='$mail' AND password='$pass'";
    $query = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($query);
    $ID = $row['ID'];
    // update mật khẩu khi nhấn submit
    if(isset($_POST['sbm'])){
        $p1 = $_POST['pass'];
        $p2 = $_POST['repass'];
        if(empty($p1)){ //kiểm tra không để trống mật khẩu
            $error =  "<div class='form-group ab' id='warning'><strong>Không được để trống mật khẩu!</strong></div>";
        } else if ($p1==$p2){
            $pass = $p1;
            $sql_UPDATE = "UPDATE user SET password='$pass', kiemtra=1 WHERE ID='$ID' ";
            $query = mysqli_query($conn, $sql_UPDATE);
            $_SESSION['mail'] = $mail;
            $_SESSION['pass'] = $pass;
                header('location: index.php');
        } else {
            $error =  "<div class='form-group ab' id='warning'><strong>Mật khẩu không khớp, vui lòng nhập lại!</strong></div>";
        }
        
    }
} ?>
<!-- giao diện -->
<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Change password</title>
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/datepicker3.css" rel="stylesheet">
    <link href="css/bootstrap-table.css" rel="stylesheet">
    <link href="css/styles.css" rel="stylesheet">
</head>
<body>
    <div class="row">
        <div class="col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2 col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">Change password</div>
                <div class="panel-body">
                    <?php if (isset($error)) {
                        echo $error;
                    }; ?>
                    <form role="form" method="post">
                        <fieldset>
                            <div class="form-group">
                                <p lass="form-control c">Tài khoản</p>
                                <p class="form-control" placeholder="E-mail" name="mail" type="text" autofocus><?php echo $row['username']; ?></p>
                            </div>
                            <div class="form-group">
                                <p lass="form-control">Mật khẩu</p>
                                <input class="form-control" placeholder="Nhập mật khẩu mới" name="pass" type="password" value="">
                            </div>
                            <div class="form-group">
                                <input class="form-control" placeholder="Nhập lại mật khẩu" name="repass" type="password" value="">
                            </div>
                            <button name="sbm" type="submit" class="btn btn-primary a">Xác nhận</button>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<style type="text/css">
    body{
        background-color: #1b2a49;
    }
    .row{
        margin-top: 10%;
    }
    .panel-heading{
        background: rgba(0, 0, 0, 0.5) !important;
        color: black !important;
        font-size: 31px;
        text-align: center;
        font-family: cursive;
    }
    .panel-body{
        background: rgba(0, 0, 0, 0.5);
    }
    .can{
        color: #8f0000;
        padding-left: 62%;
    }
    .ab{
        color: #7a1d1d;
    }
    .a{
        width: -webkit-fill-available;
    }
    p{
        color: black !important;
    }
</style>
</html>
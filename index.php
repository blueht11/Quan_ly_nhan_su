<!-- trang mở đầu -->
<!DOCTYPE html>
<html>
    <head>
        <title>Home</title>
    </head>
    <body>
        <h1 class="the">CHÀO MỪNG ĐẾN VỚI TRANG WEB QUẢN LÝ NHÂN VIÊN</h1>
        <!-- <a class="thea">VUI LÒNG ĐĂNG NHẬP</a> -->
         <a class="button1" href="admin/index.php">
            <span class="btn1">Log in</span>
         </a>
    </body>
<style type="text/css">
    *{
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      flex-direction: column;
  }
 body{
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
      background: #1b2a49;
  }
 .button1 {
   background-image: linear-gradient(135deg, #008aff, #86d472);
   border-radius: 6px;
   box-sizing: border-box;
   color: #ffffff;
   display: block;
   height: 50px;
   font-size: 2.2em;
   font-weight: 600;
   padding: 4px;
   position: relative;
   text-decoration: none;
   width: 7em;
   z-index: 2;
 }
.button1:hover {
   color: #fff;
 }
.button1 .btn1 {
   align-items: center;
   background: #0e0e10;
   border-radius: 6px;
   display: flex;
   justify-content: center;
   height: 100%;
   transition: background 0.5s ease;
   width: 100%;
 }
.button1:hover .btn1 {
   background: transparent;
 }
 .the{
    padding-bottom: 50px;
    font-size: 80px;
    text-align: center;
    color: silver;
 }
</style>
</html>
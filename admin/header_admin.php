<?php
  include '../connect_db.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookStore Admin</title>
  <link rel="stylesheet" type="text/css" href="../css/bootstrap.css">
  <link rel="stylesheet" href="../css/admin.css">
  <link rel="stylesheet" href="../font-awesome/css/all.css">

</head>

<body data-spy="scroll" data-target="#myScrollspy" data-offset="1">
  <div class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="../image/logo.png" alt="..." width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="Main.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="listsanpham();">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="listdonhang()" ;>Đơn Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#" onclick="listkhachhang();">Khách Hàng</a>
            </li>
          </ul>

          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Xin Chào Quản Trị Viên</a>
            </li>
            <li class="nav-item text-nowrap">
              <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="dangkyvadangnhap.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>
  <!-- Navbar -->
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-4 col-lg-3" id="myScrollspy">
        <nav class="navbar navbar-light bg-light flex-column mt-4">
          <nav class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="#themsanpham" onclick="addproduct();">Thêm sản phẩm</a>
              <a class="nav-link" href="#suasanpham" onclick="suasanpham();">Sửa sản phẩm</a>
              <a class="nav-link" href="#danhsachsanpham" onclick="cacsanpham();">Danh sách sản phẩm</a>
            </li>
          </nav>
        </nav>
      </div>
    </div>
  </div>
</body>
</html>
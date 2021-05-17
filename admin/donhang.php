<?php
session_start();
include '../connect_db.php';
include '../hienidnguoidung.php';
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
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 60px;
      height: 34px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 26px;
      width: 26px;
      left: 4px;
      bottom: 4px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(26px);
      -ms-transform: translateX(26px);
      transform: translateX(26px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }
  </style>
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
              <a class="nav-link active" aria-current="page" href="../index.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="../admin.php" onclick="listsanpham();">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./donhang.php" onclick="listdonhang()" ;>Đơn Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./quanlyuser.php" onclick="listkhachhang();">Khách Hàng</a>
            </li>
          </ul>

          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Xin Chào Quản Trị Viên</a>
            </li>
            <li class="nav-item text-nowrap">
              <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="../dangxuat.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>
  <div class="container">
    <h1 class="text-center" style="margin-top: 20px;">Quản lý đơn hàng</h1>
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Mã đơn hàng</th>
          <th scope="col">Tên khách hàng</th>
          <th scope="col">SĐT</th>
          <th scope="col">Địa chỉ</th>
          <th scope="col">Ghi chú</th>
          <th scope="col">Tổng tiền</th>
          <th scope="col">Trạng thái</th>
          <th scope="col">In đơn hàng</th>
          <th scope="col">Xử lý</th>


        </tr>
      </thead>
      <tbody>
        <?php
        date_default_timezone_set("Asia/Ho_Chi_Minh");
        $sql = "SELECT * FROM `orders`";
        $sql_query = mysqli_query($con, $sql);
        while ($row = mysqli_fetch_assoc($sql_query)) { ?>
          <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['phone']; ?></td>
            <td><?php echo $row['address']; ?></td>
            <td><?php echo $row['notes']; ?></td>
            <td><?php echo $row['total']; ?></td>
            <?php $status = $row['status'];
            if ($status == 0) {
              $trangthai = '<p style="color: red;">Chưa xử lý</p>';
            } else {
              $trangthai = '<p style="color: green;">Đã giao</p>';
            }

            echo "<td>" . $trangthai . " </td>"; ?>


            <td><a href="./indonhang.php?id=<?= $row['id'] ?>">Hiện</a></td>

            <?php
            if ($status == 0) {
              $active = "<a href=./xulychuagiao.php?id=" . $row['id'] . ">Giao hàng</a>";
            } else {
              $active = "<a href=./xulygiaohang.php?id=" . $row['id'] . ">Hoàn tác</a>";
            }
            echo "<td>" . $active . "</td>";
            ?>


          </tr>
        <?php    } ?>

      </tbody>
    </table>
  </div>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
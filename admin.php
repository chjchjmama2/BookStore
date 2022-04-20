<?php session_start();
include './connect_db.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>BookStore Admin</title>
  <link rel="stylesheet" type="text/css" href="./css/bootstrap.css">
  <link rel="stylesheet" href="./css/admin.css">
  <link rel="stylesheet" href="./font-awesome/css/all.css">

  <script>
    function xoasanpham() {
      confirm("Bạn chắc chắn muốn xóa sản phẩm này ?");
    }
  </script>

</head>

<body style="background-color: #F0F0F0;" data-spy="scroll" data-target="#myScrollspy" data-offset="1">
  <?php
  include './connect_db.php';
  include './hienidnguoidung.php';
  ?>
  <div class="menu">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
      <div class="container">
        <a class="navbar-brand" href="#"><img src="image/logo.png" alt="..." width="100px"></a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav me-auto mb-2 mb-lg-0">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="index.php">Trang chủ</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin.php" onclick="listsanpham();">Sản Phẩm</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin/donhang.php" onclick="listdonhang()" ;>Đơn Hàng</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="./admin/quanlyuser.php" onclick="listkhachhang();">Khách Hàng</a>
            </li>
          </ul>

          <ul class="navbar-nav px-3">
            <li class="nav-item text-nowrap">
              <a class="nav-link" href="">Xin Chào Quản Trị Viên</a>
            </li>
            <li class="nav-item text-nowrap">
              <!-- Nếu chưa đăng nhập thì hiển thị nút Đăng nhập -->
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="./dangxuat.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>
  <!-- Navbar -->
  <div class="container">
    <div class="row">
      <div class="col-sm-2 col-lg-2" id="myScrollspy">
        <nav class="navbar navbar-light flex-column mt-4">
          <nav class="nav nav-pills flex-column">
            <li class="nav-item">
              <a class="nav-link" href="./admin.php">Danh sách sản phẩm</a>
              <a class="nav-link" href="./admin/themsanpham.php">Thêm sản phẩm</a>
            </li>
          </nav>
        </nav>
      </div>
      <div class="container-fluid" style="width: 100%;">
        <div class="col">
          <!-- Xử lý thêm sản phẩm -->

          <?php


          if (isset($_POST['sbm'])) {
            $id_product = $_POST['id_product'];
            $name_product = $_POST['name_product'];
            $price = $_POST['price'];

            if (isset($_FILES['image'])) {
              $file = $_FILES['image'];
              $file_name = $file['name'];
              move_uploaded_file($file['tmp_name'], 'image/' . $file_name);
            }

            $describe_product = $_POST['describe_product'];
            $id_category = $_POST['id_category'];

            $sql = "INSERT INTO products(id_product,name_product,price,image,describe_product,id_category) VALUES ('" . $id_product . "','" . $name_product . "','" . $price . "','" . $file_name . "','" . $describe_product . "','" . $id_category . "')";
            $query = mysqli_query($con, $sql);

            if ($query) {
              header('location: ./admin.php');
            } else {
              echo "Lỗi";
            }
          }
          ?>
          <!-- Xử lý thêm sản phẩm -->

          <form method="POST" enctype="multipart/form-data">
            <div class="container-fluid" id="addproduct" style="display: none;">
              <div class="card-header">
                <h2>Thêm sản phẩm</h2>
              </div>
              <div class="form-group">
                <label for="">ID sản phẩm</label>
                <input type="text" name="id_product" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="">Tên sản phẩm</label>
                <input type="text" name="name_product" class="form-control" required>
              </div>

              <div class="form-group">
                <label for="">Giá sản phẩm</label>
                <input type="number" min="0" name="price" class="form-control" required>
              </div>
              <div class="form-group">
                <label for="" style="margin-top: 2%;">Hình ảnh sản phẩm</label> <br>
                <input type="file" name="image" style="margin-top: -1222%;">
              </div>
              <div class="form-group">
                <label for="">Mô tả sản phẩm</label> <br>
                <input type="text" name="describe_product" class="form-control">
              </div>
              <div class="form-group" style="width: 25%;">
                <label for="">Thể loại:</label>
                <?php
                $sql = "SELECT * FROM category";
                $query_sql = mysqli_query($con, $sql);
                ?>
                <select class="form-control" name="id_category">
                  <?php
                  $sql_category = "SELECT * FROM category ORDER BY id_category DESC";
                  $query_category = mysqli_query($con, $sql_category);
                  while ($rows = mysqli_fetch_array($query_category)) {
                  ?>
                    <option value="<?= $rows['id_category'] ?>"><?= $rows['category_name'] ?></option>
                  <?php } ?>
                </select>
              </div>

              <button name="sbm" class="btn btn-primary" type="submit" style="margin-left :inherit;">Thêm sản phẩm</button>
            </div>
          </form>

          <!-- Xử lý sửa sản phẩm -->

          <!-- Xử lý sửa sản phẩm -->

          <form>
            <?php

            $sosanphamtrongtrang = 12;
            $tranghientai = !empty($_GET['page']) ? $_GET['page'] : 1;
            $offset = ($tranghientai - 1) * $sosanphamtrongtrang;

            $sanpham = mysqli_query($con, "SELECT * FROM products inner join category on products.id_category = category.id_category ORDER BY products.id_product DESC LIMIT " . $sosanphamtrongtrang . " OFFSET " . $offset);
            $tongsotrang = mysqli_query($con, "SELECT * FROM products");

            $tongsosp = mysqli_num_rows($tongsotrang);
            $sotrang = ceil($tongsosp / $sosanphamtrongtrang);

            ?>



            <div class="container-fluid" id="cacsanpham">
              <div class="card">
                <div class="card-header">
                  <h2>Danh sách sản phẩm</h2>
                </div>
                <div class="card-body">
                  <table class="table">
                    <thead class="thead-dark">
                      <tr>
                        <th>#</th>
                        <th>Tên sản phẩm</th>
                        <th>Hình ảnh</th>
                        <th>Thể loại</th>
                        <th>Giá</th>
                        <th>Sửa</th>
                        <th>Xóa</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      while ($row = mysqli_fetch_assoc($sanpham)) { ?>
                        <tr>
                          <td><?php echo $row['id_product']; ?></td>
                          <td><?php echo $row['name_product']; ?></td>
                          <td>
                            <img src="./image/<?php echo $row['image']; ?>" style="width: 222px;">
                          </td>
                          <td><?php echo $row['category_name']; ?></td>

                          <td><?php echo $row['price']; ?></td>
                          <td><a href="admin/suasanpham.php?id=<?php echo $row['id_product']; ?>">Sửa</a></td>
                          <td><a href="admin/xoasanpham.php?id=<?php echo $row['id_product']; ?>" onclick="xoasanpham()">Xóa</a></td>
                        </tr>
                      <?php } ?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </form>

        </div>
        <nav aria-label="Page navigation example">
          <ul class="pagination justify-content-center" id="Pagination">
            <?php

            if ($tranghientai > 1) { ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?= $tranghientai - 1 ?>" tabindex="-1" aria-disabled="true">Trước</a>
              </li>
            <?php } ?>
            <?php for ($num = 1; $num <= $sotrang; $num++) { ?>
              <?php if ($num != $tranghientai) { ?>
                <?php if ($num > $tranghientai - 3 && $num < $tranghientai + 3) { ?>
                  <li class="page-item"><a class="page-link" href="?page=<?= $num ?>"><?= $num ?></a></li>
                <?php } ?>
              <?php } else { ?>
                <li class="page-item"><strong class="page-link" href=""><?= $num ?></strong></li>
              <?php } ?>
            <?php } ?>
            <?php if ($tranghientai < $sotrang) { ?>
              <li class="page-item">
                <a class="page-link" href="?page=<?= $tranghientai + 1 ?>">Sau</a>
              </li>
            <?php } ?>
          </ul>
          </form>
        </nav>
      </div>
    </div>
    <script type="text/javascript" src="js/bootstrap.js"></script>
    <script src="js/script.js"></script>
</body>

</html>
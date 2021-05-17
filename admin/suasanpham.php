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
              <a type="button" class="btn btn-outline-info btn-md btn-rounded btn-navbar waves-effect waves-light" href="dangkyvadangnhap.php">Đăng Xuất</a>
            </li>
          </ul>
        </div>
    </nav>
  </div>

  <?php
  include '../connect_db.php';
  $id = $_GET['id'];
  $sql_up = "SELECT * FROM products where id_product = $id";
  $query_up = mysqli_query($con, $sql_up);
  $row_up = mysqli_fetch_assoc($query_up);
  if (isset($_POST['sbm'])) {
    $id_product = $_POST['id_product'];
    $name_product = $_POST['name_product'];
    $price = $_POST['price'];

    if ($_FILES['image']['name'] == '') {
      $image = $row_up['image'];
    } else {
      $image = $_FILES['image']['name'];
      $image_tmp = $_FILES['image']['tmp_name'];
      move_uploaded_file($image_tmp, '../image/' . $image);
      $sql = "UPDATE products SET img = '$image' where id = $id ";
      mysqli_query($con, $sql);
    }
    $describe_product = $_POST['describe_product'];
    $id_category = $_POST['id_category'];

    $sql = "UPDATE products SET id_product = '" . $id_product . "', name_product = '" . $name_product . "', price = '" . $price . "', image = '" . $image . "', describe_product = '" . $describe_product . "', id_category = '" . $id_category . "' WHERE id_product = $id  ";
    $query = mysqli_query($con, $sql);
    header('location: ../admin.php');
  }
  ?>

  <div class="container" id="addproduct">
    <div class="card">
      <div class="card-header">
        <h2 onclick="addproduct();">Sửa sản phẩm</h2>
      </div>
      <div class="card-body">
        <form method="POST" enctype="multipart/form-data">
          <div class="form-group">
            <label for="">ID sản phẩm</label>
            <input type="text" name="id_product" class="form-control" required value="<?php echo $row_up['id_product']; ?>">
          </div>
          <div class="form-group">
            <label for="">Tên sản phẩm</label>
            <input type="text" name="name_product" class="form-control" required value="<?php echo $row_up['name_product']; ?>">
          </div>
          <div class="form-group">
            <label for="">Giá sản phẩm</label>
            <input type="number" name="price" class="form-control" required value="<?php echo $row_up['price']; ?>">
          </div>
          <div class="form-group">
            <label for="">Hình ảnh sản phẩm</label> <br>
            <input type="file" name="image" value="<?php echo $row_up['image']; ?>">
          </div>
          <div class="form-group">
            <label for="">Mô tả sản phẩm</label> <br>
            <input type="text" name="describe_product" class="form-control" value="<?php echo $row_up['describe_product']; ?>">
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
          <button name="sbm" class="btn btn-primary" type="submit">Sửa sản phẩm</button>
        </form>
      </div>
    </div>
  </div>
</body>
</html>
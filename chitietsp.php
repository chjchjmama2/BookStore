<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Book Store</title>
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="font-awesome/css/all.css">
  <link rel="stylesheet" href="font-awesome/css/fontawesome.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

  <!-- Header -->
  <?php
  include './connect_db.php';
  $chitiet = isset($_GET['sanpham']) ? $_GET['sanpham'] : "";
  $sql = mysqli_query($con, "SELECT * FROM products WHERE id_product = $chitiet");
  ?>
  <!-- Container -->
  <?php if (mysqli_num_rows($sql) > 0) {
    $result = mysqli_fetch_array($sql);
  ?>
    <div class="container my-5 py-5 z-depth-1">


      <!--Section: Content-->
      <section class="text-center">

        <!-- Section heading -->
        <div class="row">
          <div class="col-lg-6">

            <!--Carousel Wrapper-->
            <div id="carousel-thumb1" class="carousel slide carousel-fade carousel-thumbnails mb-5 pb-4" data-ride="carousel">

              <!--Slides-->
              <div class="carousel-inner text-center text-md-left" role="listbox">
                <div class="carousel-item active">
                  <img src="./image/<?= $result['image'] ?>" alt="First slide" class="img-fluid" height="500px" width="500px">
                </div>
              </div>
              <!--/.Slides-->

              <!--Thumbnails-->
              <a class="carousel-control-prev" href="#carousel-thumb1" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
              </a>
              <a class="carousel-control-next" href="#carousel-thumb1" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
              </a>
              <!--/.Thumbnails-->

            </div>

          </div>

          <div class="col-lg-5 text-center text-md-left">

            <h2 class="h2-responsive text-center text-md-left product-name font-weight-bold dark-grey-text mb-1 ml-xl-0 ml-4">Thay Đổi Cuộc Sống Với Nhân Số Học</h2>
            <span class="badge badge-danger product mb-4 ml-xl-0 ml-4">bestseller</span>
            <span class="badge badge-success product mb-4 ml-2">SALE</span>

            <h3 class="h3-responsive text-center text-md-left mb-5 ml-xl-0 ml-4">
              <span class="red-text font-weight-bold">
                <strong><?= $result['price'] ?> VNĐ</strong>
              </span>
              <span class="grey-text blockquote">
                <small>
                  <s><?= $result['price'] + 15000 ?> VNĐ</s>
                </small>

              </span>
            </h3>

            <div class="font-weight-normal">

              <p class="ml-xl-0 ml-4"><?= $result['describe_product'] ?></p>

              <p class="ml-xl-0 ml-4">
                <strong>Ngày xuất bản: </strong>10-2020
              </p>
              <p class="ml-xl-0 ml-4">
                <strong>Kích thước: </strong>16 x 24 cm
              </p>
              <!-- <p class="ml-xl-0 ml-4">
                <strong>Dịch Giả: </strong>Lê Đỗ Quỳnh Hương
              </p>
              <p class="ml-xl-0 ml-4">
                <strong>Số trang: </strong>342
              </p> -->
              <p class="ml-xl-0 ml-4">
                <strong>Nhà xuất bản: </strong>Nhà Xuất Bản Tổng hợp TP.HCM
              </p>
              <p class="ml-xl-0 ml-4">
                <?php
                $tmp = $result['id_category'];

                $query = mysqli_query($con, "SELECT * FROM category WHERE id_category = $tmp");

                $namecategory = mysqli_fetch_array($query);

                if (mysqli_num_rows($query) > 0) {
                ?>
                  <strong>Thể loại: </strong><?= $namecategory['category_name'] ?>
                <?php } ?>
              </p>
              <div class="mt-5">
                <p class="grey-text">
                  <strong>Số lượng :</strong>
                </p>
                <form action="giohang.php?action=add" method="POST">
                  <div class="form-group">
                    <input min="1" type="number" value="1" name="quanlity[<?= $result['id_product'] ?>]">
                  </div>
                  <div class="row mt-3 mb-4">
                    <div class="col-md-12 text-center text-md-left text-md-right">
                      <button class="btn btn-primary btn-rounded">
                        <i class="fas fa-cart-plus mr-2" aria-hidden="true"></i> Add to cart</button>
                    </div>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
      </section>
      <!--Section: Content-->


    </div>
  <?php } else { ?>
    <h2>Không có thông tin để hiển thị </h2>
  <?php } ?>
  <!-- Footer -->
  <footer class="bg-dark text-center text-white">
    <!-- Grid container -->
    <div class="container p-4 pb-0">
      <!-- Section: Social media -->
      <section class="mb-4">
        <!-- Facebook -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-facebook-f"></i></a>

        <!-- Twitter -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-twitter"></i></a>

        <!-- Google -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-google"></i></a>

        <!-- Instagram -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-instagram"></i></a>

        <!-- Linkedin -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-linkedin-in"></i></a>

        <!-- Github -->
        <a class="btn btn-outline-light btn-floating m-1" href="#!" role="button"><i class="fab fa-github"></i></a>
      </section>
      <!-- Section: Social media -->
    </div>
    <!-- Grid container -->

    <!-- Copyright -->
    <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2);">
      © 2020 Copyright:
      <a class="text-white" href="https://www.facebook.com/profile.php?id=100008172966669">Quang Trường</a>
    </div>
    <!-- Copyright -->
  </footer>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>

</html>
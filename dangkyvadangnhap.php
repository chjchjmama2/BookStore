<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>BookStore Đăng Ký & Đăng Nhập</title>
	<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
	<link rel="stylesheet" href="css/dangkyvadangnhap.css">
	<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
</head>

<body>
	<!-- Open Header -->
	<!-- <div class="menu">
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
                </ul>
              </div>
            </div>
          </nav>
    </div> -->
	<!-- End Header -->
	<!-- Dang ky va dang nhap -->
	<div class="container">
		<div class="row">
			<div class="col-md-6 col-md-offset-3">
				<div class="panel panel-login">
					<div class="panel-heading">
						<div class="row">
							<div class="col-xs-6">
								<a href="#" class="active" id="login-form-link">Login</a>
							</div>
							<div class="col-xs-6">
								<a href="#" id="register-form-link">Register</a>
							</div>
						</div>
						<hr>
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-12">
								<form id="login-form" action="?action=login" method="post" role="form" style="display: block; ">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<?php
									session_start();
									include 'connect_db.php';
									if (isset($_GET['action']) && $_GET['action'] == "login" && isset($_POST['login-submit'])) {
										//kiểm tra tên tài khoản đã điền vào chưa
										if (!empty($_POST['username']) && !empty($_POST['password'])) {
											$username = $_POST['username'];
											$password = $_POST['password'];
											$password = md5($password);
											$querysql = mysqli_query($con, "SELECT * FROM user WHERE username = '$username' AND passworduser = '$password'");
											if (mysqli_num_rows($querysql) > 0) {
												$result = mysqli_fetch_assoc($querysql);
											
												if ($result['status'] != 1) {
													$_SESSION["user"] = $username;
													mysqli_close($con);
													header('location:index.php');
												} else {
													echo "<script type='text/javascript'>alert('Tài khoản của bạn đang bị khóa vui lòng liên hệ với quản trị viên');</script>";
												}
											} else {
												echo "<span>*Bạn đã nhập sai tài khoản hoặc mật khẩu</span>";
											}
										} else {
											echo "<span>*Xin mới điền vào thông tin đăng nhập</span>";
										}
									}
									?>
									<div class="form-group text-center">
										<!-- <input type="checkbox" tabindex="3" class="" name="remember" id="remember"> -->
										<!-- <label for="remember"> Remember Me</label> -->
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="login-submit" id="login-submit" tabindex="4" class="form-control btn btn-login" value="Log In">
											</div>
										</div>
									</div>
									<div class="form-group">
										<div class="row">
											<div class="col-lg-12">
												<div class="text-center">
													<!-- <a href="https://phpoll.com/recover" tabindex="5" class="forgot-password">Forgot Password?</a> -->
												</div>
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="text-center">
													<a href="index.php" tabindex="5">Trở về trang chủ</a>
												</div>
											</div>
										</div>
									</div>
								</form>
								<form id="register-form" action="?action=register" method="post" role="form" style="display: none;">
									<div class="form-group">
										<input type="text" name="username" id="username" tabindex="1" class="form-control" placeholder="Username" value="">
									</div>
									<div class="form-group">
										<input type="email" name="email" id="email" tabindex="1" class="form-control" placeholder="Email Address" value="">
									</div>
									<div class="form-group">
										<input type="password" name="password" id="password" tabindex="2" class="form-control" placeholder="Password">
									</div>
									<div class="form-group">
										<input type="password" name="confirm-password" id="confirm-password" tabindex="2" class="form-control" placeholder="Confirm Password">
									</div>
									<?php
									include 'connect_db.php';
									if (isset($_GET['action']) && $_GET['action'] == "register" && isset($_POST['register-submit'])) {
										if (empty($_POST['username']) || empty($_POST['email']) || empty($_POST['password']) || empty($_POST['confirm-password'])) {
											echo "Xin điền đầy đủ thông tin";
										} else {
											if ($_POST['password'] == $_POST['confirm-password']) {
												$usernamerg = $_POST['username'];
												$email = $_POST['email'];
												$passwordrg = $_POST['password'];
												$passwordrg = md5($passwordrg);
												$query = mysqli_query($con, "SELECT username FROM user WHERE username = '$usernamerg'");
												if (mysqli_num_rows($query) > 0) {
													echo "Tên đăng nhập đã có người sử dụng";
												} else {
													$queryrg = mysqli_query($con, "INSERT INTO user VALUES ('NULL','$usernamerg','$email','$passwordrg',0,0,'NULL')");
													if (!$queryrg) {
														echo 'Tạo không thành công!!!';
													} else {
														mysqli_close($con);
														echo "<script type='text/javascript'>alert('Chúc mừng bạn đã tạo tài khoản thành công');</script>";
													}
												}
											} else {
												echo "Password không trùng nhau";
											}
										}
									}
									?>
									<div class="form-group">
										<div class="row">
											<div class="col-sm-6 col-sm-offset-3">
												<input type="submit" name="register-submit" id="register-submit" tabindex="4" class="form-control btn btn-register" value="Register Now">
											</div>
										</div>
										<div class="row">
											<div class="col-lg-3">
												<div class="text-center">
													<a href="index.php" tabindex="5">Trở về trang chủ</a>
												</div>
											</div>
										</div>
									</div>
								</form>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- dong dang ky va dang nhap -->
	<script src="js/bootstrap.js"></script>
	<script src="js/dangkyvadangnhap.js"></script>
</body>

</html>
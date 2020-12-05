<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: /CNPM/signIn.php');
    exit();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/CNPM/db.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Thêm mới nhân viên</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href='./css/style.css'>
</head>

<body>
    <?php 
        if(isset($_POST['fullname']) && isset($_POST['email']) && isset($_POST['position']) && isset($_POST['phone']) && isset($_POST['address']) && isset($_POST['gender'])){
                $fullname = $_POST['fullname'];
                $phone = $_POST['phone'];
                $email = $_POST['email'];
                $address = $_POST['address'];
                $position = $_POST['position'];
                $gender = $_POST['gender'];

                $result = add_staff($fullname, $phone, $email, $address, $position, $gender);
                if($result){
                    unset($_POST);
                    header('Location: user-list.php');
                    exit;
                }
                else{
                    echo "ERROR";
                }
        }
    ?>

    <div class="d-flex justify-content-between">
        <!-- SIDE BAR -->
        <div id="side-bar">
            <div class="logo">QUẢN LÝ CỬA HÀNG</div>
            <ul class="list-group rounded-0">
                <li class="dashboard">
                    <a href="index.php">
                        <i class="fa fa-home" aria-hidden="true"></i> TRANG CHỦ
                    </a>
                </li>
                <li>
                    <a href="user-list.php">
                        <i class="fa fa-user mr-2"></i> Quản lý nhân viên
                    </a>
                </li>
                <li>
                    <a href="role-list.php">
                        <i class="fa fa-book mr-2"></i> Quản lý sản phẩm
                    </a>
                </li>
                <li>
                    <a href="bill-list.php">
                        <i class="fa fa-cogs mr-2"></i> Quản lý hoá đơn
                    </a>
                </li>
                <li>
                    <a href="stock-list.php">
                        <i class="fa fa-slack mr-2"></i> Quản lý kho
                    </a>
                </li>
            </ul>
        </div>

        <div id="admin-wrapper">
            <!-- HEADER -->
            <nav class="navbar navbar-expand-sm navbar-light bg-light w-100">
                <a class="navbar-brand" href="#"><i class="fa fa-align-justify"></i></a>
                <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
                <div class="collapse navbar-collapse" id="collapsibleNavId">
                    <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                        <li class="nav-item dropdown"><a class="nav-link dropdown-toggle" href="#" id="dropdownId" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Cửa hàng bán đồ chơi
                            </a>
                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownId">
                                <a class="dropdown-item" href="">Thông tin</a>
                                <a class="dropdown-item" href="logout.php">Thoát</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>

            <!-- CONTENT -->
            <section id="admin-content" class="p-3">
                <h3 class="mb-4">Thêm mới nhân viên</h3>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Họ tên</label>
                                <input type="text" name="fullname" class="form-control" placeholder="Nguyễn A" />
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="text" name="email" class="form-control" placeholder="abc@gmail.com" />
                            </div>
                            <div class="form-group">
                                <label>Chức vụ</label>
                                <input type="text" name="position" class="form-control" placeholder="Nhân Viên" />
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label>Số điện thoại</label>
                                <input type="text" name="phone" class="form-control" placeholder="0123456789" />
                            </div>
                            <div class="form-group">
                                <label>Địa chỉ</label>
                                <input type="text" name="address" class="form-control" placeholder="1/1 Đường 1, P.1, Q.1" />
                            </div>
                            <div class="form-group">
                                <label>Giới tính
                                    <span>
                                        <label class="container">Nam
                                            <input type="radio" checked="checked" name="gender" value="Nam">
                                            <span class="checkmark"></span>
                                        </label>
                                    </span>

                                    <span>
                                        <label class="container">Nữ
                                            <input type="radio" name="gender" value="Nữ">
                                            <span class="checkmark"></span>
                                        </label>
                                    </span>
                                </label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <button type="submit" class="btn btn-success">Lưu lại</button>
                            <a class="btn btn-secondary" href="user-list.php">Quay lại</a>
                        </div>
                    </div>
                </form>
            </section>
        </div>
    </div>
    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
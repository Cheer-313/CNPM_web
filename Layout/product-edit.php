<?php
session_start();
if(!isset($_SESSION['username'])){
    header('Location: CNPM/signIn.php');
    exit();
}
require_once $_SERVER['DOCUMENT_ROOT'].'/CNPM/db.php';
?>
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Chỉnh sửa thông tin sản phẩm</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href='./css/style.css'>
</head>

<body>
    <!-- Submit Data PHP -->
    <?php 
        $id_product = $_GET['id'];
        if(isset($_POST['pruduct_name']) && isset($_POST['product_type']) && isset($_POST['price']) && isset($_POST['producer'])){
                $pruduct_name = $_POST['pruduct_name'];
                $product_type = $_POST['product_type'];
                $price = $_POST['price'];
                $producer = $_POST['producer'];
                $img = '';

                $result = update_product($pruduct_name, $product_type, $price, $producer, $img, $id_product);
                if($result){
                    unset($_POST);
                    header('Location: product-list.php');
                    exit;
                }
                else{
                    echo "ERROR";
                }
        }
    ?>
    <!-- Submit Data PHP -->

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
                    <a href="product-list.php">
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
                <h3 class="mb-4 text-center">Chỉnh sửa thông tin sản phẩm</h3>
                <form method="post" action="">
                    <div class="row">
                        <div class="col-md-6 m-auto">
                            <div class="form-group">
                                <label>Tên sản phẩm</label>
                                <input type="text" name="pruduct_name" class="form-control" placeholder="Tên sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Loại sản phẩm</label>
                                <input type="text" name="product_type" class="form-control" placeholder="Loại sản phẩm" />
                            </div>
                            <div class="form-group">
                                <label>Giá</label>
                                <input type="text" name="price" class="form-control" placeholder="Giá" />
                            </div>
                            <div class="form-group">
                                <label>Hãng sản xuất</label>
                                <input type="text" name="producer" class="form-control" placeholder="Hãng sản xuất" />
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-success">Lưu lại</button>
                                <a class="btn btn-secondary" href="product-list.php">Quay lại</a>
                            </div>
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
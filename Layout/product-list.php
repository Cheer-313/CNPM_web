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
    <title>Danh sách sản phẩm</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href='./css/style.css'>
</head>

<body>

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
                <h3 class="mb-3">Danh sách sản phẩm</h3>
                <div class="row">
                    <div class="col-md-8">
                        <a href="product-add.php" class="btn btn-primary">Thêm mới</a>
                    </div>
                    <div class="col-md-4">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Tìm kiếm...">
                            <div class="input-group-append">
                                <span class="input-group-text" id="basic-addon2"><i class="fa fa-search"></i></span>
                            </div>
                        </div>
                    </div>
                </div>
                <table class="table table-bordered table-hover mt-3">
                    <thead>
                        <tr>
                            <th>ID sản phẩm</th>
                            <th>Tên sản phẩm</th>
                            <th>Loại sản phẩm</th>
                            <th>Giá</th>
                            <th>Hãng sản xuất</th>
                            <th>#</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                            $result = load_table_product();
                            if(!empty($result)){
                                while ($row = $result->fetch_assoc()) {
                                    # code...
                                    $id_product = $row['MaSP'];
                                    $pruduct_name = $row['TenSP'];
                                    $product_type = $row['LoaiSP'];
                                    $price = $row['GiaSP'];
                                    $producer = $row['HangSX'];
                        ?>
                        <tr>
                            <td><?= $id_product ?></td>
                            <td><?= $pruduct_name ?></td>
                            <td><?= $product_type ?></td>
                            <td><?= $price ?></td>
                            <td><?= $producer ?></td>
                            <td>
                                <a href="product-edit.php?id=<?=$id_product?>" class="btn btn-sm btn-info">
                                    <i class="fa fa-pencil-square-o"></i>
                                </a>
                                <a href="product-remove.php?id=<?=$id_product?>" class="btn btn-sm btn-danger">
                                    <i class="fa fa-trash-o"></i>
                                </a>
                            </td>
                        </tr>
                        <?php
                                }
                            }
                         ?>
                    </tbody>
                </table>
            </section>
        </div>
    </div>
    <script src="./js/jquery.slim.min.js"></script>
    <script src="./js/popper.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
</body>

</html>
-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 05, 2020 at 09:05 AM
-- Server version: 10.4.16-MariaDB
-- PHP Version: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `web`
--
CREATE DATABASE IF NOT EXISTS `web` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `web`;

-- --------------------------------------------------------

--
-- Table structure for table `hoadon`
--

DROP TABLE IF EXISTS `hoadon`;
CREATE TABLE `hoadon` (
  `MaHD` int(11) NOT NULL,
  `MaNV` int(11) NOT NULL,
  `MaKH` int(11) NOT NULL,
  `NgayNhap` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TongTien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `hoadon`
--

INSERT INTO `hoadon` (`MaHD`, `MaNV`, `MaKH`, `NgayNhap`, `TongTien`) VALUES
(1, 1, 3, '11/11/2020', 574072);

-- --------------------------------------------------------

--
-- Table structure for table `kho`
--

DROP TABLE IF EXISTS `kho`;
CREATE TABLE `kho` (
  `MaKho` int(11) NOT NULL,
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `SLTonKho` int(11) NOT NULL,
  `SLBan` int(11) DEFAULT NULL,
  `NgayNhap` varchar(12) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `TrangThai` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kho`
--

INSERT INTO `kho` (`MaKho`, `MaSP`, `TenSP`, `SLTonKho`, `SLBan`, `NgayNhap`, `TrangThai`) VALUES
(2, 1, 'Gấu bông', 1, 20, '1/12/2020', 'Hết hàng'),
(4, 1, 'Legoa', 10, 20, '20/12/2000', 'Còn hàng');

-- --------------------------------------------------------

--
-- Table structure for table `nhanvien`
--

DROP TABLE IF EXISTS `nhanvien`;
CREATE TABLE `nhanvien` (
  `MaNV` int(11) NOT NULL,
  `TenNV` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SDT` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Email` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DiaChi` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `ChucVu` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `GioiTinh` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `nhanvien`
--

INSERT INTO `nhanvien` (`MaNV`, `TenNV`, `SDT`, `Email`, `DiaChi`, `ChucVu`, `GioiTinh`) VALUES
(7, 'Nguyễn Hưng', '0120727271', 'nhh31@gmail.com', '1/1/1/1/1/1/1', 'Trưởng phòng', 'Nam'),
(8, 'Hung Nguyen', '0104050604', 'nhh3103@gmail.com', '1/1/2/6', 'Nhân viên', 'Nam');

-- --------------------------------------------------------

--
-- Table structure for table `reset_token`
--

DROP TABLE IF EXISTS `reset_token`;
CREATE TABLE `reset_token` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `expire_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `reset_token`
--

INSERT INTO `reset_token` (`email`, `token`, `expire_on`) VALUES
('blightmedison313@gmail.com', '27003566b8e32588b9db5bc8026ef320', 1606623243);

-- --------------------------------------------------------

--
-- Table structure for table `sanpham`
--

DROP TABLE IF EXISTS `sanpham`;
CREATE TABLE `sanpham` (
  `MaSP` int(11) NOT NULL,
  `TenSP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LoaiSP` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `GiaSP` int(11) NOT NULL,
  `HangSX` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `HinhAnh` text COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sanpham`
--

INSERT INTO `sanpham` (`MaSP`, `TenSP`, `LoaiSP`, `GiaSP`, `HangSX`, `HinhAnh`) VALUES
(1, 'Gấu bông', 'Gấu bông', 100000, 'Lượm', ''),
(2, 'Lego', 'Xếp hình', 500000, 'Lego', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `username` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(300) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hoten` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `sdt` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `permission` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `hoten`, `ngaysinh`, `email`, `sdt`, `token`, `permission`) VALUES
('hoanghung', '$2y$10$rF5xkMMitjYm4TgaVetxPO0LtFXhk2XNfVaTqUj5dhOosFkaL/hSS', 'Nguyễn Hoàng Hưng', '25/05/1999', 'blightmedison313@gmail.com', '0968030739', '8be9ccd0c29230bf228df8bdeed4d3d0', 1),
('dangdang', '$2y$10$/zwc5g9wH3reSMPgG3fUkeAPxbDKNI8Lz.PGdXc0TdB9b2yOvjXh2', 'Phạm Hồng Hải Đăng', '25/05/1999', 'dang1212asd@gmail.com', '0968030739', '00849a563cb4f25ea49f16243962ef0a', 2),
('minhhung', '$2y$10$xGN0gqSK5.3C34cxsN5YduRoS/P27/fkDAj8JO5nfmabDCeK0fYuy', 'Trương Minh Hưng', '25/05/1999', 'hungt2766@gmail.com', '0968030739', '058639030e4b651984247865b376fc1f', 2),
('nhunhu', '$2y$10$UutMppkzzN5gIERvvlwTKuKaAmnoLpclA8aZEgfgK9ZNikodXRxw.', 'Nguyễn Trần Quỳnh Như', '25/05/1999', 'nguyentranquynhnhu2505@gmail.com', '0968030739', '5835de49859f6b282e0719b2728416a9', 1),
('Admin', '$2y$10$S1nSU5SDYD4en8IaJ5NAxu5ImiJzd48HLfjO9Bs.muhwz7Iu7Y/im', 'Admin', '25/05/1999', 'nguyentranquynhnhu25051999@gmail.com', '0968030739', 'f636a6d959d8646220b4681a4cac4bdb', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `hoadon`
--
ALTER TABLE `hoadon`
  ADD PRIMARY KEY (`MaHD`);

--
-- Indexes for table `kho`
--
ALTER TABLE `kho`
  ADD PRIMARY KEY (`MaKho`);

--
-- Indexes for table `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`MaNV`);

--
-- Indexes for table `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `sanpham`
--
ALTER TABLE `sanpham`
  ADD PRIMARY KEY (`MaSP`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `hoadon`
--
ALTER TABLE `hoadon`
  MODIFY `MaHD` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kho`
--
ALTER TABLE `kho`
  MODIFY `MaKho` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `MaNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `sanpham`
--
ALTER TABLE `sanpham`
  MODIFY `MaSP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

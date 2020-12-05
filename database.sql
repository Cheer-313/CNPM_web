-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th12 02, 2020 lúc 04:47 PM
-- Phiên bản máy phục vụ: 10.4.16-MariaDB
-- Phiên bản PHP: 7.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `web`
--
CREATE DATABASE IF NOT EXISTS `web` DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci;
USE `web`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `classroom`
--

DROP TABLE IF EXISTS `classroom`;
CREATE TABLE `classroom` (
  `id` int(11) NOT NULL,
  `classname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `subject` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `room` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `img` text COLLATE utf8_unicode_ci NOT NULL,
  `date_create` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `classroom`
--

INSERT INTO `classroom` (`id`, `classname`, `subject`, `room`, `email`, `img`, `date_create`, `token`) VALUES
(1, 'Lap trinh web t4c3', 'Lap trinh web', 'C401', 'hhung@gmail.com', '/img.png', '27-11-2020', '84afc38080c24e9c6fa22f799470586d'),
(2, 'Cong nghe phan mem t2c2', 'CNPM', 'C601', 'blightmedison313@gmail.com', 'images/img_violin2.jpg', '27-11-2020', '9901211752466b008b809382d37ba719'),
(3, 'Công nghệ phần mềm n2tt2', 'Công nghệ phần mềm', 'C202', 'blightmedison313@gmail.com', 'images/img_learnlanguage.jpg', '28-11-2020', '623f458a975fbad5770e78226fcdb503');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE `comment` (
  `id` int(10) NOT NULL,
  `post_id` int(10) NOT NULL,
  `content` text NOT NULL,
  `email` varchar(30) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Đang đổ dữ liệu cho bảng `comment`
--

INSERT INTO `comment` (`id`, `post_id`, `content`, `email`, `date_created`) VALUES
(1, 17, 'sdfasdfs', 'hoangvanle@gmail.com', '2020-12-02 04:13:28'),
(2, 17, 'sdfasdfsfsdfsdf', 'hoangvanle@gmail.com', '2020-12-02 04:13:28'),
(3, 17, 'sdfasdfsfsdfsdffd', 'hoangvanle@gmail.com', '2020-12-02 04:13:28'),
(4, 17, 'sdfasdfsfsdfsdffddsf', 'hoangvanle@gmail.com', '2020-12-02 04:13:28'),
(5, 17, 'sdfasdfsfsdfsdffddsfdsfsd', 'hoangvanle@gmail.com', '2020-12-02 04:13:28'),
(6, 17, 'sdfasdfsfsdfsdffddsfdsfsddsfds', 'hoangvanle@gmail.com', '2020-12-02 04:13:33'),
(7, 17, 'NEW', 'hoangvanle@gmail.com', '2020-12-02 04:18:49'),
(8, 17, 'NEW sdsf', 'hoangvanle@gmail.com', '2020-12-02 04:21:34'),
(9, 17, 'sdfsdfaasdf', 'hoangvanle@gmail.com', '2020-12-02 04:23:03'),
(10, 17, 'sdfsdfaasdfsdfdsf', 'hoangvanle@gmail.com', '2020-12-02 04:23:30'),
(11, 17, 'sdfsdfaasdfsdfdsfdsfsf', 'hoangvanle@gmail.com', '2020-12-02 04:23:45'),
(12, 17, 'sdfsdfaasdfsdfdsfdsfsfdsfs', 'hoangvanle@gmail.com', '2020-12-02 04:23:52'),
(13, 17, 'sdfsdf', 'hoangvanle@gmail.com', '2020-12-02 04:25:15'),
(14, 17, 'sadfsf', 'hoangvanle@gmail.com', '2020-12-02 04:25:46'),
(15, 17, 'sadfsfsdf', 'hoangvanle@gmail.com', '2020-12-02 04:26:15'),
(16, 17, 'ewrw', 'hoangvanle@gmail.com', '2020-12-02 04:26:49'),
(38, 18, '', 'hoangvanle@gmail.com', '2020-12-02 13:02:07'),
(39, 18, '', 'hoangvanle@gmail.com', '2020-12-02 13:02:12'),
(40, 18, 'adfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:05:36'),
(41, 18, 'adfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:05:38'),
(42, 18, 'adfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:05:38'),
(43, 18, 'adfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:05:42'),
(44, 18, 'adfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:05:42'),
(45, 18, 'adfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:05:42'),
(46, 18, 'asdfsdfdsf', 'hoangvanle@gmail.com', '2020-12-02 13:08:00'),
(47, 18, 'asdfsdfdsfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:08:03'),
(48, 18, 'asdfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:08:23'),
(49, 17, 'adsfsdf', 'hoangvanle@gmail.com', '2020-12-02 13:08:28');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `news`
--

DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `user_email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` text COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `file` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` int(1) NOT NULL,
  `date_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `news`
--

INSERT INTO `news` (`id`, `user_email`, `title`, `content`, `file`, `type`, `date_created`) VALUES
(10, 'hoangvanle@gmail.com', 'gdf', 'gdfgfdgfdd', 'uploads/file_5fc7051c46e46', 2, '2020-12-02 03:08:12'),
(11, 'hoangvanle@gmail.com', 'rfgd', 'fgfdgd', 'uploads/file_5fc705a39e9b0', 2, '2020-12-02 03:10:27'),
(17, 'hoangvanle@gmail.com', 'fgdgdf', 'dfgfdg', 'uploads/file_5fc707aa31c08file_5fc7051c46e46.png', 0, '2020-12-02 03:19:06'),
(18, 'hoangvanle@gmail.com', 'asdfasdf', 'asdfsadf', 'uploads/file_5fc7903fb8d88main.js (1).txt', 0, '2020-12-02 13:01:51');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `reset_token`
--

DROP TABLE IF EXISTS `reset_token`;
CREATE TABLE `reset_token` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL,
  `expire_on` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `reset_token`
--

INSERT INTO `reset_token` (`email`, `token`, `expire_on`) VALUES
('blightmedison313@gmail.com', '27003566b8e32588b9db5bc8026ef320', 1606623243);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
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
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`username`, `password`, `hoten`, `ngaysinh`, `email`, `sdt`, `token`, `permission`) VALUES
('hoanghung', '$2y$10$rF5xkMMitjYm4TgaVetxPO0LtFXhk2XNfVaTqUj5dhOosFkaL/hSS', 'Nguyễn Hoàng Hưng', '25/05/1999', 'blightmedison313@gmail.com', '0968030739', '8be9ccd0c29230bf228df8bdeed4d3d0', 1),
('dangdang', '$2y$10$/zwc5g9wH3reSMPgG3fUkeAPxbDKNI8Lz.PGdXc0TdB9b2yOvjXh2', 'Phạm Hồng Hải Đăng', '25/05/1999', 'dang1212asd@gmail.com', '0968030739', '00849a563cb4f25ea49f16243962ef0a', 2),
('minhhung', '$2y$10$xGN0gqSK5.3C34cxsN5YduRoS/P27/fkDAj8JO5nfmabDCeK0fYuy', 'Trương Minh Hưng', '25/05/1999', 'hungt2766@gmail.com', '0968030739', '058639030e4b651984247865b376fc1f', 2),
('nhunhu', '$2y$10$UutMppkzzN5gIERvvlwTKuKaAmnoLpclA8aZEgfgK9ZNikodXRxw.', 'Nguyễn Trần Quỳnh Như', '25/05/1999', 'nguyentranquynhnhu2505@gmail.com', '0968030739', '5835de49859f6b282e0719b2728416a9', 1),
('Admin', '$2y$10$S1nSU5SDYD4en8IaJ5NAxu5ImiJzd48HLfjO9Bs.muhwz7Iu7Y/im', 'Admin', '25/05/1999', 'nguyentranquynhnhu25051999@gmail.com', '0968030739', 'f636a6d959d8646220b4681a4cac4bdb', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user_classroom`
--

DROP TABLE IF EXISTS `user_classroom`;
CREATE TABLE `user_classroom` (
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(300) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user_classroom`
--

INSERT INTO `user_classroom` (`email`, `token`) VALUES
('blightmedison313@gmail.com', '9901211752466b008b809382d37ba719'),
('hhung@gmail.com', '84afc38080c24e9c6fa22f799470586d'),
('hhung@gmail.com', '9901211752466b008b809382d37ba719');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `classroom`
--
ALTER TABLE `classroom`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`),
  ADD KEY `type` (`type`);

--
-- Chỉ mục cho bảng `reset_token`
--
ALTER TABLE `reset_token`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`email`);

--
-- Chỉ mục cho bảng `user_classroom`
--
ALTER TABLE `user_classroom`
  ADD PRIMARY KEY (`email`,`token`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `classroom`
--
ALTER TABLE `classroom`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `comment`
--
ALTER TABLE `comment`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT cho bảng `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

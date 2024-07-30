-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th5 23, 2024 lúc 04:10 PM
-- Phiên bản máy phục vụ: 10.4.28-MariaDB
-- Phiên bản PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `asmphp2`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(37, 'Milk Tea'),
(38, 'Fast Food'),
(40, 'test');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `detailorders`
--

CREATE TABLE `detailorders` (
  `id` int(11) NOT NULL,
  `id_product` int(11) NOT NULL,
  `id_order` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `image` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `option_content` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `detailorders`
--

INSERT INTO `detailorders` (`id`, `id_product`, `id_order`, `name`, `image`, `quantity`, `price`, `option_content`) VALUES
(68, 63, 116, 'Ô Long Tuyết Lê Khổng Lồ', 'O-long-tuyet-le-khong-lo.png', 2, '33.000đ', 'sugar:less, ice:less'),
(69, 64, 116, 'Trà chanh mật ong', 'z4925614520640_1babe5daea83472f4784ceb3cd206979.jpg', 3, '24.000đ', 'sugar:normal, ice:normal'),
(70, 66, 117, 'Kem ly vani dâu', 'z4617754537982_689908f83d0785da485d70d0307e5130.jpg', 1, '34.000đ', 'sugar:normal, ice:normal'),
(71, 61, 117, 'fried chicken thighs', 'dui-ga-ran-tai-ben-tre.png', 1, '11.000đ', 'sugar:normal, ice:normal'),
(72, 62, 118, 'Kem ly dâu sữa', 'kem-ly-dau-sua-TEA.png', 1, '28.000đ', 'sugar:normal, ice:normal'),
(73, 64, 119, 'Trà chanh mật ong', 'z4925614520640_1babe5daea83472f4784ceb3cd206979.jpg', 1, '24.000đ', 'sugar:normal, ice:normal'),
(74, 63, 119, 'Ô Long Tuyết Lê Khổng Lồ', 'O-long-tuyet-le-khong-lo.png', 1, '33.000đ', 'sugar:normal, ice:normal');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `id_user` varchar(50) NOT NULL,
  `phonenumber` int(11) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'unconfirm',
  `note` text NOT NULL,
  `price` decimal(10,3) NOT NULL,
  `address` varchar(255) NOT NULL,
  `type` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `name`, `id_user`, `phonenumber`, `date`, `status`, `note`, `price`, `address`, `type`) VALUES
(116, 'admin', 'admin', 918279105, '2024-02-29', 'cancel', '', 138.000, 'kjkhjkhgdghdgh - Note: nonono', 'deliver'),
(117, 'admin', 'admin', 346074020, '2024-02-29', 'unconfirm', '', 45.000, '', 'store'),
(118, 'Võ Văn Khang', 'KhangVo2k4', 346074020, '2024-03-03', 'unconfirm', '', 28.000, 'Trong tym em - Note: ', 'deliver'),
(119, 'admin', 'admin', 1234567890, '2024-02-29', 'unconfirm', '', 57.000, 'dsafgf - Note: ', 'deliver');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int(255) NOT NULL,
  `id_category` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `price` decimal(10,0) NOT NULL,
  `discount` int(11) NOT NULL,
  `image` varchar(255) NOT NULL,
  `display` varchar(20) NOT NULL DEFAULT 'show',
  `view` bigint(20) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `id_category`, `name`, `price`, `discount`, `image`, `display`, `view`) VALUES
(61, 38, 'fried chicken thighs', 12, 11, 'dui-ga-ran-tai-ben-tre.png', 'show', 0),
(62, 37, 'Kem ly dâu sữa', 32, 12, 'kem-ly-dau-sua-TEA.png', 'show', 4),
(63, 37, 'Ô Long Tuyết Lê Khổng Lồ', 35, 5, 'O-long-tuyet-le-khong-lo.png', 'show', 9),
(64, 37, 'Trà chanh mật ong', 25, 5, 'z4925614520640_1babe5daea83472f4784ceb3cd206979.jpg', 'show', 9),
(65, 37, 'Ô Long Sữa Trân Châu Ngũ Cốc', 25, 1, 'z4925614515113_5bdf67d7e4b3ee98215ea11da9b303e9.jpg', 'show', 2),
(66, 37, 'Kem ly vani dâu', 37, 7, 'z4617754537982_689908f83d0785da485d70d0307e5130.jpg', 'show', 5),
(71, 38, 'test', 78, 0, 'code.png', 'hide', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `users`
--

CREATE TABLE `users` (
  `username` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `image` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `phonenumber` int(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `role` varchar(64) NOT NULL,
  `active` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `users`
--

INSERT INTO `users` (`username`, `fullname`, `password`, `image`, `email`, `phonenumber`, `address`, `role`, `active`) VALUES
('admin', 'admin', 'admin', 'z4802922020534_451fd456f4da1e6cfe6dec46bcbf152e.jpg', '', 0, '', 'staff', 'active'),
('chenguyetgialai', 'haha', '12345', 'dui-ga-ran-tai-ben-tre.png', 'khanglaiedit@gmail.com', 346074020, 'Lũh Yố, Iahru, Chư Pưh, Gia Lai', 'staff', 'active'),
('chenguyetgialai3', '', '131231', '', 'shutup2k4@gmail.com', 346074020, '', 'user', 'non-active'),
('DiemQuynh', '', '131231', 'Screenshot (44).png', 'nguyendspd09199@fpt.edu.vn', 346074020, '', 'user', 'active'),
('KhangVo2k4', 'Võ Văn Khang', '12345', 'z5198391318773_6be394aa2c824337dcc42a2690a7b64d.jpg', 'gaumc2k4@gmail.com', 346074020, 'Trong tym em', 'user', 'non-active'),
('NgocTrang', '', '12345', '', '', 0, '', 'user', 'non-active'),
('trangiuanh', '', '12345', '', '', 0, '', '', 'non-active');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `detailorders`
--
ALTER TABLE `detailorders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `detail_product` (`id_product`),
  ADD KEY `detail_order` (`id_order`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_user` (`id_user`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_category` (`id_category`);

--
-- Chỉ mục cho bảng `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT cho bảng `detailorders`
--
ALTER TABLE `detailorders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=120;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `detailorders`
--
ALTER TABLE `detailorders`
  ADD CONSTRAINT `detail_order` FOREIGN KEY (`id_order`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `detail_product` FOREIGN KEY (`id_product`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `order_user` FOREIGN KEY (`id_user`) REFERENCES `users` (`username`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `product_category` FOREIGN KEY (`id_category`) REFERENCES `categories` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

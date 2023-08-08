-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th8 02, 2023 lúc 01:21 PM
-- Phiên bản máy phục vụ: 10.4.27-MariaDB
-- Phiên bản PHP: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `project1`
--
CREATE DATABASE IF NOT EXISTS `project1` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `project1`;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_category`
--

CREATE TABLE `tbl_category` (
  `cate_id` int(11) NOT NULL,
  `cate_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_category`
--

INSERT INTO `tbl_category` (`cate_id`, `cate_name`) VALUES
(1, 'manga'),
(2, 'truyện trinh thám'),
(3, 'Truyện'),
(4, 'câu truyện cuộc sống');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_custommer`
--

CREATE TABLE `tbl_custommer` (
  `cus_id` int(11) NOT NULL,
  `cus_username` varchar(255) NOT NULL,
  `cus_pass` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `cus_phone` varchar(60) NOT NULL,
  `cus_message` varchar(6000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_custommer`
--

INSERT INTO `tbl_custommer` (`cus_id`, `cus_username`, `cus_pass`, `cus_address`, `cus_phone`, `cus_message`) VALUES
(1, 'vinhmoi', '202cb962ac59075b964b07152d234b70', 'daothanhvinh2004@gmail.com', '0982660369', '');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_orders`
--

CREATE TABLE `tbl_orders` (
  `ord_id` int(11) NOT NULL,
  `customer_id` int(11) NOT NULL,
  `staff_id` int(11) NOT NULL,
  `prd_name` varchar(255) NOT NULL,
  `prd_price` int(11) NOT NULL,
  `prd_quantity` int(11) NOT NULL,
  `prd_image` varchar(6000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_order_detail`
--

CREATE TABLE `tbl_order_detail` (
  `ordd_id` int(11) NOT NULL,
  `cus_id` int(11) NOT NULL,
  `cus_name` varchar(255) NOT NULL,
  `cus_number` int(11) NOT NULL,
  `cus_email` varchar(255) NOT NULL,
  `cus_method` varchar(255) NOT NULL,
  `cus_address` varchar(255) NOT NULL,
  `total_products` varchar(255) NOT NULL,
  `prd_id` int(11) NOT NULL,
  `prd_name` varchar(255) NOT NULL,
  `prd_quantity` int(255) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_product`
--

CREATE TABLE `tbl_product` (
  `prd_id` int(11) NOT NULL,
  `prd_name` varchar(255) NOT NULL,
  `prd_price` decimal(8,0) NOT NULL,
  `prd_quantity` int(11) NOT NULL,
  `prd_image` varchar(255) DEFAULT NULL,
  `cate_id` int(11) NOT NULL,
  `prd_description` varchar(6000) DEFAULT NULL,
  `pubc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_product`
--

INSERT INTO `tbl_product` (`prd_id`, `prd_name`, `prd_price`, `prd_quantity`, `prd_image`, `cate_id`, `prd_description`, `pubc_id`) VALUES
(1, 'Detective conan vol 100', '100000', 100, '100---db_a84b9c5d7d2e47d09bfc246d7b94ea30_master.jpg', 1, '<p>conan tập 100</p>\r\n', 1),
(2, 'harry protter 7 bộ', '100000', 97, 'harry-post-ter.jpg', 3, '<p>fdha</p>\r\n', 2),
(3, 'Yêu trên từng ngón tay', '150000', 199, 'img2.jpg', 3, '<p>của</p>\r\n', 1),
(4, 'Vì em gặp anh', '120000', 1230, 'img3.jpg', 1, '', 6),
(5, 'Từ bến sông nhùng', '1500000', 100, 'img4.jpg', 3, '<p>của: Phạm Quốc To&agrave;n</p>\r\n', 6),
(123, '5 Centimet trên giây', '100000', 100, 'img5.jpg', 2, '<p>Của Shinkai Makoto</p>\r\n', 1),
(127, 'Nói nhiều, làm ít', '100000', 100, 'img8.jpg', 1, '<p>sdas</p>\r\n', 6),
(1211, 'Người phụ nữ đằng sau ống kính', '130000', 100, 'img7.jpg', 3, '<p>asd</p>\r\n', 1),
(1212, 'Liên hoa yêu cốt', '100000', 100, 'img6.jpg', 4, '', 8);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_pubc`
--

CREATE TABLE `tbl_pubc` (
  `pubc_id` int(11) NOT NULL,
  `pubc_name` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_pubc`
--

INSERT INTO `tbl_pubc` (`pubc_id`, `pubc_name`) VALUES
(1, 'Nhà Xuất Bản Kim Đồng'),
(2, 'Nhà Xuất Bản giáo dục việt nam'),
(3, 'Nhà xuất bản trẻ'),
(6, 'Nhà xuất bản văn hóa văn nghệ'),
(7, 'Nhà xuất bản văn hóa'),
(8, 'Nhà xuất bản thời đại');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tbl_user`
--

CREATE TABLE `tbl_user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `user_pass` varchar(255) NOT NULL,
  `fulname` varchar(255) DEFAULT NULL,
  `user_level` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `tbl_user`
--

INSERT INTO `tbl_user` (`user_id`, `username`, `user_pass`, `fulname`, `user_level`) VALUES
(1, 'Trường Giang', 'c4ca4238a0b923820dcc509a6f75849b', 'Truongjeng', 1),
(2, 'vinhdao', 'c4ca4238a0b923820dcc509a6f75849b', 'daothanhvinh', 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  ADD PRIMARY KEY (`cate_id`);

--
-- Chỉ mục cho bảng `tbl_custommer`
--
ALTER TABLE `tbl_custommer`
  ADD PRIMARY KEY (`cus_id`);

--
-- Chỉ mục cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD PRIMARY KEY (`ord_id`),
  ADD KEY `'customer_id'` (`customer_id`),
  ADD KEY `'staff_id'` (`staff_id`);

--
-- Chỉ mục cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD PRIMARY KEY (`ordd_id`),
  ADD KEY `'prd_id'` (`prd_id`);

--
-- Chỉ mục cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD PRIMARY KEY (`prd_id`),
  ADD KEY `'cate_id'` (`cate_id`);

--
-- Chỉ mục cho bảng `tbl_pubc`
--
ALTER TABLE `tbl_pubc`
  ADD PRIMARY KEY (`pubc_id`);

--
-- Chỉ mục cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `tbl_category`
--
ALTER TABLE `tbl_category`
  MODIFY `cate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tbl_custommer`
--
ALTER TABLE `tbl_custommer`
  MODIFY `cus_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  MODIFY `ord_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  MODIFY `ordd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  MODIFY `prd_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1213;

--
-- AUTO_INCREMENT cho bảng `tbl_pubc`
--
ALTER TABLE `tbl_pubc`
  MODIFY `pubc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT cho bảng `tbl_user`
--
ALTER TABLE `tbl_user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `tbl_orders`
--
ALTER TABLE `tbl_orders`
  ADD CONSTRAINT `'customer_id'` FOREIGN KEY (`customer_id`) REFERENCES `tbl_custommer` (`cus_id`),
  ADD CONSTRAINT `'staff_id'` FOREIGN KEY (`staff_id`) REFERENCES `tbl_user` (`user_id`);

--
-- Các ràng buộc cho bảng `tbl_order_detail`
--
ALTER TABLE `tbl_order_detail`
  ADD CONSTRAINT `'ordd_id'` FOREIGN KEY (`ordd_id`) REFERENCES `tbl_orders` (`ord_id`),
  ADD CONSTRAINT `'prd_id'` FOREIGN KEY (`prd_id`) REFERENCES `tbl_product` (`prd_id`);

--
-- Các ràng buộc cho bảng `tbl_product`
--
ALTER TABLE `tbl_product`
  ADD CONSTRAINT `'cate_id'` FOREIGN KEY (`cate_id`) REFERENCES `tbl_category` (`cate_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

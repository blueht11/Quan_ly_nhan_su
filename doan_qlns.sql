-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th1 11, 2022 lúc 05:19 PM
-- Phiên bản máy phục vụ: 10.4.14-MariaDB
-- Phiên bản PHP: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `doan_qlns`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `congviec`
--

CREATE TABLE `congviec` (
  `IDCV` int(11) NOT NULL,
  `tencv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `motacv` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `danhgia` varchar(30) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 1,
  `IDNV` int(11) NOT NULL,
  `IDTP` int(11) NOT NULL,
  `deadline` date DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ngaynop` date DEFAULT NULL,
  `ghichu` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `congviec`
--

INSERT INTO `congviec` (`IDCV`, `tencv`, `motacv`, `danhgia`, `trangthai`, `IDNV`, `IDTP`, `deadline`, `file`, `ngaynop`, `ghichu`) VALUES
(80, 'Thêm chức năng tìm kiếm 01', 'Thêm chức năng tìm kiếm trong dự án H340 để tìm thông tin nhanh hơn', NULL, 2, 217, 46, '2022-01-18', 'avt2.png', NULL, NULL),
(81, 'Fix bug Web 177', 'Fix bug Web quản lý, không tìm được data khách hàng dù khách đã nhập data rồi', NULL, 1, 205, 46, '2022-01-27', 'avt5.png', NULL, NULL),
(82, 'Lỗi giao diện 01', 'Lỗi giao diện khi khách hàng lần đầu tiên vào trang web', NULL, 1, 217, 46, '2022-01-13', 'avt3.png', NULL, NULL),
(83, 'Lỗi giao diện 02', 'Màn hình đăng nhập chưa đủ đẹp', NULL, 4, 205, 46, '2022-01-30', 'avt2.png', '2022-01-11', NULL),
(84, 'Tạo quảng cáo A1', 'Quảng cáo clip bánh kem cho công ty ABC Vina', NULL, 1, 209, 45, '2022-01-20', 'text.txt', NULL, NULL),
(85, 'Tạo quảng cáo A2', 'Quảng cáo clip 30s trị nám cho công ty LFC-335', NULL, 1, 214, 45, '2022-01-31', 'avt4.jfif', NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ngaynghi`
--

CREATE TABLE `ngaynghi` (
  `IDNN` int(11) NOT NULL,
  `IDNV` int(11) NOT NULL,
  `IDND` int(11) NOT NULL,
  `ngay` date NOT NULL,
  `lydo` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `trangthai` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `ngaynghi`
--

INSERT INTO `ngaynghi` (`IDNN`, `IDNV`, `IDND`, `ngay`, `lydo`, `trangthai`) VALUES
(71, 208, 1, '2022-01-15', 'Tiêm mũi 3 phòng Covid', 0),
(72, 205, 208, '2022-01-16', 'Đi sửa điện thoại', 0),
(73, 217, 208, '2022-01-20', 'Chở vợ đi đẻ', 0),
(74, 217, 208, '2022-01-16', 'Về quê', 3),
(75, 219, 1, '2022-01-28', 'Về quê ăn Tết', 0),
(76, 219, 1, '2022-01-13', 'Sửa nhà', 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `nhanvien`
--

CREATE TABLE `nhanvien` (
  `IDNV` int(11) NOT NULL,
  `hoten` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `anhdaidien` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `quequan` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ngaysinh` date NOT NULL,
  `gioitinh` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `songaynghi` int(11) NOT NULL,
  `IDPB` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `nhanvien`
--

INSERT INTO `nhanvien` (`IDNV`, `hoten`, `anhdaidien`, `quequan`, `ngaysinh`, `gioitinh`, `email`, `songaynghi`, `IDPB`) VALUES
(1, 'admin', 'avatar.png', 'TP HCM', '2000-01-10', 'Nam', 'admin', 0, 0),
(204, 'Lê Thị Diệp', 'avt2.png', 'Cà Mau', '1995-12-30', 'Nữ', 'lethidiep@gmail.com', 0, 42),
(205, 'Đoàn Dự', 'avt1.png', 'Thừa Thiên Huế', '2000-01-12', 'Nam', 'doandu@gmail.com', 0, 47),
(206, 'Nguyễn Ngọc Bảo', 'avt5.png', 'Cần Thơ', '1999-12-31', 'Nam', 'nguyenngocbao@gmail.com', 0, 42),
(207, 'Trần Bình Trọng', 'avt5.png', 'Cần Thơ', '1998-12-29', 'Nam', 'tranbinhtrong@gmail.com', 0, 42),
(208, 'Trần Ngọc Dũng', 'avt1.png', 'Cà Mau', '2000-01-06', 'Nam', 'tranngocdung@gmail.com', 0, 47),
(209, 'Minh Minh Trí', 'avt4.jfif', 'Đà Nẵng', '2001-12-29', 'Nam', 'minhminhtri@gmail.com', 0, 46),
(210, 'Đoàn Giỏi', 'avt1.png', 'Hà Tây', '2003-01-24', 'Nam', 'doangioi@gmail.com', 0, 42),
(211, 'Nguyễn Phú An', 'avt5.png', 'Thừa Thiên Huế', '2000-01-06', 'Nam', 'nguyenphuan@gmail.com', 0, 44),
(212, 'Đào Minh Phúc', 'avt3.png', 'Hà Tây', '2000-01-07', 'Nam', 'daominhphuc@gmail.com', 0, 43),
(213, 'Lê Thị Đào', 'avt2.png', 'Cà Mau', '2002-12-29', 'Nữ', 'lethidao@gmail.com', 0, 43),
(214, 'Lê Thị Mai Anh', 'avt2.png', 'Cần Thơ', '2001-01-05', 'Nữ', 'lethimaianh@gmail.com', 0, 46),
(215, 'Lê Minh Trí', 'avt3.png', 'Hà Nội', '2002-03-23', 'Nam', 'leminhtri@gmail.com', 0, 45),
(216, 'Trần Văn Việt', 'avt1.png', 'Đà Nẵng', '2001-01-07', 'Nam', 'tranvanviet@gmail.com', 0, 45),
(217, 'Nguyễn Minh Đăng Khoa', 'avt5.png', 'Hà Nội', '2000-01-06', 'Nam', 'nguyenminhdangkhoa@gmail.com', 1, 47),
(218, 'Phạm Vũ Long Khải', 'avt1.png', 'Thừa Thiên Huế', '2000-01-06', 'Nam', 'phamvulongkhai@gmail.com', 0, 43),
(219, 'Phạm Thị Hương Trà', 'avt2.png', 'Lâm Đồng', '2000-01-01', 'Nữ', 'phamthihuongtra@gmail.com', 0, 46),
(220, 'Nguyễn Xuân', 'avt4.jfif', 'Hà Nội', '1999-01-01', 'Nữ', 'nguyenxuan@gmail.com', 0, 44),
(221, 'Phan Văn Trường', 'avt1.png', 'Lâm Đồng', '2000-01-14', 'Nam', 'phanvantruong@gmail.com', 0, 44);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `phongban`
--

CREATE TABLE `phongban` (
  `IDPB` int(11) NOT NULL,
  `tenphong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sophong` int(11) NOT NULL,
  `motaphong` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `phongban`
--

INSERT INTO `phongban` (`IDPB`, `tenphong`, `sophong`, `motaphong`) VALUES
(42, 'Kế toán', 3, 'Hạch toán đầy đủ, chính xác và kịp thời vốn và nợ. Hạch toán các khoản thu chi và hiệu quả kinh doanh theo chính sách của công ty. Lên kế hoạch tài chính, kinh doanh theo tháng, quý, năm.'),
(43, 'Nhân sự', 4, 'Đảm bảo nhân viên của công ty được quản lý đầy đủ, đãi ngộ thích hợp và đào tạo hiệu quả. Bộ phận này cũng chịu trách nhiệm tuyển dụng, tuyển dụng, sa thải và quản lý các quyền lợi.'),
(44, 'Tài chính', 2, 'Chịu trách nhiệm quản lý nguồn tài chính sao cho hiệu quả và kiểm soát nguồn tài chính cần thiết cho tất cả mọi hoạt động kinh doanh trong doanh nghiệp'),
(45, 'Kinh doanh', 5, 'Hướng dẫn, chỉ đạo các hoạt động nghiên cứu và phát triển các loại sản phẩm, dịch vụ mới hoặc là nghiên cứu cải tiến các sản phẩm, dịch vụ đã có để đáp ứng nhu cầu của thị trường'),
(46, 'Marketing', 6, 'Xây dựng chiến lược marketing cho doanh nghiệp; điều hành việc triển khai chiến lược marketing; theo dõi, giám sát quá trình thực hiện, kịp thời điều chỉnh và đánh giá, báo cáo kết quả chiến lược marketing'),
(47, 'IT', 6, 'Làm các công việc liên quan đến phần mềm máy tính, thu thập thông tin, tiến hành sửa chữa, khắc phục lỗi khi cần thiết… Nhờ đó có thể quản lý và sử dụng dữ liệu một cách dễ dàng và hiệu quả.');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `truongphong`
--

CREATE TABLE `truongphong` (
  `IDTP` int(11) NOT NULL,
  `IDNV` int(11) NOT NULL,
  `IDPB` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `truongphong`
--

INSERT INTO `truongphong` (`IDTP`, `IDNV`, `IDPB`) VALUES
(42, 206, 42),
(43, 213, 43),
(44, 211, 44),
(45, 219, 46),
(46, 208, 47);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `IDNV` int(11) NOT NULL,
  `username` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `role` int(1) NOT NULL,
  `kiemtra` int(1) NOT NULL,
  `repass` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `user`
--

INSERT INTO `user` (`ID`, `IDNV`, `username`, `password`, `role`, `kiemtra`, `repass`) VALUES
(1, 1, 'admin', 'admin', 1, 10, 'admin'),
(188, 204, 'lethidiep@gmail.com', 'lethidiep@gmail.com', 3, 0, 'lethidiep@gmail.com'),
(189, 205, 'doandu@gmail.com', '1', 3, 1, 'doandu@gmail.com'),
(190, 206, 'nguyenngocbao@gmail.com', 'nguyenngocbao@gmail.com', 2, 0, 'nguyenngocbao@gmail.com'),
(191, 207, 'tranbinhtrong@gmail.com', 'tranbinhtrong@gmail.com', 3, 0, 'tranbinhtrong@gmail.com'),
(192, 208, 'tranngocdung@gmail.com', '1', 2, 1, 'tranngocdung@gmail.com'),
(193, 209, 'minhminhtri@gmail.com', 'minhminhtri@gmail.com', 3, 0, 'minhminhtri@gmail.com'),
(194, 210, 'doangioi@gmail.com', 'doangioi@gmail.com', 3, 0, 'doangioi@gmail.com'),
(195, 211, 'nguyenphuan@gmail.com', 'nguyenphuan@gmail.com', 2, 0, 'nguyenphuan@gmail.com'),
(196, 212, 'daominhphuc@gmail.com', 'daominhphuc@gmail.com', 3, 0, 'daominhphuc@gmail.com'),
(197, 213, 'lethidao@gmail.com', 'lethidao@gmail.com', 2, 0, 'lethidao@gmail.com'),
(198, 214, 'lethimaianh@gmail.com', 'lethimaianh@gmail.com', 3, 0, 'lethimaianh@gmail.com'),
(199, 215, 'leminhtri@gmail.com', 'leminhtri@gmail.com', 3, 0, 'leminhtri@gmail.com'),
(200, 216, 'tranvanviet@gmail.com', 'tranvanviet@gmail.com', 3, 0, 'tranvanviet@gmail.com'),
(201, 217, 'nguyenminhdangkhoa@gmail.com', '1', 3, 1, 'nguyenminhdangkhoa@gmail.com'),
(202, 218, 'phamvulongkhai@gmail.com', 'phamvulongkhai@gmail.com', 3, 0, 'phamvulongkhai@gmail.com'),
(203, 219, 'phamthihuongtra@gmail.com', '1', 2, 1, 'phamthihuongtra@gmail.com'),
(204, 220, 'nguyenxuan@gmail.com', 'nguyenxuan@gmail.com', 3, 0, 'nguyenxuan@gmail.com'),
(205, 221, 'phanvantruong@gmail.com', 'phanvantruong@gmail.com', 3, 0, 'phanvantruong@gmail.com');

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD PRIMARY KEY (`IDCV`),
  ADD KEY `IDNV` (`IDNV`),
  ADD KEY `IDTP` (`IDTP`);

--
-- Chỉ mục cho bảng `ngaynghi`
--
ALTER TABLE `ngaynghi`
  ADD PRIMARY KEY (`IDNN`),
  ADD KEY `IDNV` (`IDNV`);

--
-- Chỉ mục cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  ADD PRIMARY KEY (`IDNV`);

--
-- Chỉ mục cho bảng `phongban`
--
ALTER TABLE `phongban`
  ADD PRIMARY KEY (`IDPB`);

--
-- Chỉ mục cho bảng `truongphong`
--
ALTER TABLE `truongphong`
  ADD PRIMARY KEY (`IDTP`),
  ADD KEY `IDNV` (`IDNV`),
  ADD KEY `IDPB` (`IDPB`);

--
-- Chỉ mục cho bảng `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `user_mail` (`username`),
  ADD KEY `IDNV` (`IDNV`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `congviec`
--
ALTER TABLE `congviec`
  MODIFY `IDCV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=86;

--
-- AUTO_INCREMENT cho bảng `ngaynghi`
--
ALTER TABLE `ngaynghi`
  MODIFY `IDNN` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=77;

--
-- AUTO_INCREMENT cho bảng `nhanvien`
--
ALTER TABLE `nhanvien`
  MODIFY `IDNV` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=222;

--
-- AUTO_INCREMENT cho bảng `phongban`
--
ALTER TABLE `phongban`
  MODIFY `IDPB` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT cho bảng `truongphong`
--
ALTER TABLE `truongphong`
  MODIFY `IDTP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT cho bảng `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `congviec`
--
ALTER TABLE `congviec`
  ADD CONSTRAINT `congviec_ibfk_1` FOREIGN KEY (`IDNV`) REFERENCES `nhanvien` (`IDNV`),
  ADD CONSTRAINT `congviec_ibfk_2` FOREIGN KEY (`IDTP`) REFERENCES `truongphong` (`IDTP`);

--
-- Các ràng buộc cho bảng `ngaynghi`
--
ALTER TABLE `ngaynghi`
  ADD CONSTRAINT `ngaynghi_ibfk_1` FOREIGN KEY (`IDNV`) REFERENCES `nhanvien` (`IDNV`);

--
-- Các ràng buộc cho bảng `truongphong`
--
ALTER TABLE `truongphong`
  ADD CONSTRAINT `truongphong_ibfk_1` FOREIGN KEY (`IDNV`) REFERENCES `nhanvien` (`IDNV`);

--
-- Các ràng buộc cho bảng `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`IDNV`) REFERENCES `nhanvien` (`IDNV`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

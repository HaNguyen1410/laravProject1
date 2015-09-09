-- MySQL dump 10.13  Distrib 5.6.25, for Win32 (x86)
--
-- Host: localhost    Database: qlnienluan_ktpm
-- ------------------------------------------------------
-- Server version	5.6.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `chia_nhom`
--

DROP TABLE IF EXISTS `chia_nhom`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chia_nhom` (
  `mssv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `manhomhp` int(11) NOT NULL,
  `manhomthuchien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nhomtruong` tinyint(1) DEFAULT NULL,
  `nhanxet` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`mssv`,`manhomhp`),
  KEY `manhomhp` (`manhomhp`),
  CONSTRAINT `chia_nhom_ibfk_1` FOREIGN KEY (`mssv`) REFERENCES `sinh_vien` (`mssv`),
  CONSTRAINT `chia_nhom_ibfk_2` FOREIGN KEY (`manhomhp`) REFERENCES `nhom_hocphan` (`manhomhp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chia_nhom`
--

LOCK TABLES `chia_nhom` WRITE;
/*!40000 ALTER TABLE `chia_nhom` DISABLE KEYS */;
INSERT INTO `chia_nhom` VALUES ('1111222',6,'NTH05',0,''),('1111223',6,'NTH05',0,''),('1111271',6,'NTH01',0,''),('1111306',6,'NTH01',1,''),('1111308',6,'NTH02',0,''),('1111317',1,'NTH02',0,''),('1111324',6,'NTH02',1,''),('1111333',6,'',0,''),('1111342',6,'NTH03',1,''),('1111359',6,'NTH01',0,''),('1111366',6,'',NULL,''),('1111432',6,'NTH04',1,''),('1113456',6,'NTH04',0,''),('1211234',6,'',0,''),('21321',6,' ',0,''),('21322',7,'',0,''),('21323',7,'',0,'');
/*!40000 ALTER TABLE `chia_nhom` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `chitiet_diem`
--

DROP TABLE IF EXISTS `chitiet_diem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `chitiet_diem` (
  `matc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mssv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `diem` float DEFAULT NULL,
  PRIMARY KEY (`matc`,`mssv`),
  KEY `mssv` (`mssv`),
  CONSTRAINT `chitiet_diem_ibfk_1` FOREIGN KEY (`matc`) REFERENCES `tieu_chi_danh_gia` (`matc`),
  CONSTRAINT `chitiet_diem_ibfk_2` FOREIGN KEY (`mssv`) REFERENCES `sinh_vien` (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chitiet_diem`
--

LOCK TABLES `chitiet_diem` WRITE;
/*!40000 ALTER TABLE `chitiet_diem` DISABLE KEYS */;
INSERT INTO `chitiet_diem` VALUES ('1','1111271',3),('1','1111306',4),('1','1111308',4),('1','1111317',3.5),('1','1111324',3),('1','1111359',3.5),('2','1111271',1),('2','1111306',0.5),('2','1111308',0.5),('2','1111317',0.5),('2','1111324',1),('2','1111359',1),('3','1111271',2.5),('3','1111306',2),('3','1111308',3),('3','1111317',2),('3','1111324',3),('3','1111359',3),('4','1111271',2),('4','1111306',1.5),('4','1111308',0.5),('4','1111317',1.5),('4','1111324',2),('4','1111359',2);
/*!40000 ALTER TABLE `chitiet_diem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cong_viec`
--

DROP TABLE IF EXISTS `cong_viec`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cong_viec` (
  `macv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `congviec` text COLLATE utf8_unicode_ci,
  `giaocho` text COLLATE utf8_unicode_ci NOT NULL,
  `ngaybatdau_kehoach` date DEFAULT NULL,
  `ngayketthuc_kehoach` date DEFAULT NULL,
  `sogio_kehoach` int(11) NOT NULL,
  `ngaybatdau_thucte` datetime DEFAULT NULL,
  `ngayketthuc_thucte` datetime DEFAULT NULL,
  `sogio_thucte` int(11) DEFAULT NULL,
  `phuthuoc_cv` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `uutien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `trangthai` text COLLATE utf8_unicode_ci,
  `tiendo` int(11) NOT NULL,
  `noidungthuchien` text COLLATE utf8_unicode_ci,
  `ngaytao` date NOT NULL,
  PRIMARY KEY (`macv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cong_viec`
--

LOCK TABLES `cong_viec` WRITE;
/*!40000 ALTER TABLE `cong_viec` DISABLE KEYS */;
INSERT INTO `cong_viec` VALUES ('1','Phân tích yêu cầu','Cả nhóm',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('1.1','Thu thập yêu cầu, phân loại các yêu cầu','Lê Giang Anh',NULL,NULL,0,NULL,NULL,0,'1','','Sắp làm',0,'Viết mẫu câu hỏi phổng vấn, xem các tài liệu sẵn có','0000-00-00'),('1.2','Viết tài liệu yêu cầu ','Nguyễn Hoàng Long',NULL,NULL,0,NULL,NULL,0,'1','','Sắp làm',0,'Định nghĩa các yêu cầu, đặc tả các yêu cầu.','0000-00-00'),('1.3','Thẩm tra và công nhận hợp lệ ','',NULL,NULL,0,NULL,NULL,0,'1','','Sắp làm',0,'-Kiểm tra xem đặc tả yêu cầu có phù hợp với định nghĩa yêu cầu;   -Xác nhận-kiểm tra xem định nghĩa các yêu cầu có phản ánh chính xác nhu cầu của khách hàng.','0000-00-00'),('2','Thiết kế phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('2.1','Thiết kế kiến trúc ','',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',0,'Liên kế các thành phần của hệ thống với các khả năng đã được xác định trong đặc tả yêu cầu','0000-00-00'),('2.2','Thiếu kế dữ liệu ','',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',0,'Các thành phần dữ liệu và bảng để tạo CSDL','0000-00-00'),('2.3','Thiết kế giao diện ','',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',0,'Các form nhập liệu, các báo cáo và kết xuất mà hệ thống phải sinh ra','0000-00-00'),('2.4','Thiết kế thủ tục','',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',0,' -Giải thích quá trình xử lý từ input đến output.\r\n -Biểu diễn bằng: lưu đồ giải thuật.','0000-00-00'),('3','Lập trình phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('4','Kiểm thử phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('4.1','Kiểm thử chương trình và lập kế hoạch kiểm thử','',NULL,NULL,0,NULL,NULL,0,'4','','Sắp làm',0,'Các lỗi phần mềm, kiểm thử đơn vị, kiểm thử tích hợp,lập kế hoạch kiểm thử, công cụ kiểm thử','0000-00-00'),('4.2','Kiểm thử chương trình và viết tài liệu các trường hợp kiểm thử','',NULL,NULL,0,NULL,NULL,0,'4','','Sắp làm',0,' -Kiểm thử chức năng: hệ thống có thực hiện như cam kế trong đặc tả yêu cầu?   -Kiểm thử thực hiện: các yếu tố phi chức năng có được đáp ứng? -Kiểm thử chấp nhận: hệ thống có đạt được cái ma khách hàng mong muốn? -Kiểm thử sự cài đặt: hệ thống có vận hành ở chỗ khách hàng tốt không?','0000-00-00'),('5','Triển khai hệ thống','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('5.1','Cài đặt hệ thống cho khách hàng, viết tài liệu hướng dẫn sử dụng hệ thống.','',NULL,NULL,0,NULL,NULL,0,'5','','Sắp làm',0,NULL,'0000-00-00'),('6','Bảo trì phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('6.1','Lập kế hoạch bảo trì','',NULL,NULL,0,NULL,NULL,0,'6','','Sắp làm',0,NULL,'0000-00-00'),('CV1','Phân tích đề tài và thiết kế CSDL','Cả nhóm','2014-02-09','2013-06-22',0,'2014-01-07 00:00:00','2014-02-21 00:00:00',10,'0','cao','đang làm',10,'Phải phân tích cấu trúc lưu CSDL và các chức năng chình cần thực hiện','0000-00-00'),('CV1.1','Thiết kế CSDL','Võ Thành Luân','2014-02-09','2014-02-21',0,'2014-02-11 00:00:00','2014-02-15 00:00:00',10,'CV1','Cao','Sắp làm',0,'<p>\r\n	Phải ph&acirc;n t&iacute;ch cấu tr&uacute;c lưu CSDL, x&aacute;c định c&aacute;c thực thể cần lưu</p>\r\n','0000-00-00'),('CV1.2','Vẽ sơ đồ CDM','Nguyễn Hoàng Long',NULL,NULL,0,'2014-02-11 00:00:00','2014-02-18 00:00:00',20,'CV1','','đang làm',0,'Dựa vào các thực thể đã phân tích để vẽ sơ đồ CDM và sơ đồ usecase','0000-00-00'),('CV2','Thiết kế giao diện','Võ Thành Luân','2014-02-09','2014-02-22',0,'2013-02-11 00:00:00',NULL,20,'0','trung bình','Hoàn thành',10,'Thiết kế chi tiết các chức năng theo CSDL đã phân tích, cập nhật lại CDM khi thiết kế','0000-00-00'),('CV3','Lập trình phần mềm','Cả nhóm','2014-01-06','2014-02-10',0,'2014-01-07 00:00:00',NULL,0,'0','cao','đang làm',10,'Lập trình các chức năng như đã thiết kế.','0000-00-00'),('CV3.1','Lập trình đăng nhập','Võ Thành Luân',NULL,NULL,0,NULL,NULL,NULL,'CV3','','đang làm',30,'Lập trình chức năng đăng nhập, phân quyền người dùng bình thường và admin. Sử dụng SESSION và COOKIE','0000-00-00'),('CV3.2','Lập trình đăng ký người dùng','Phạm Thúy Ngọc',NULL,NULL,0,NULL,NULL,NULL,'CV3','','đang làm',50,'Viết chức năng cho phép người dùng đăng ký tài khoản để có những ưu đãi riêng, thực hiện bình luận.','0000-00-00'),('CV3.3','Lập trình quản lý câu đố trong game','Đoàn Ái Ngọc',NULL,NULL,0,NULL,NULL,NULL,'CV3','','đang làm',25,'Lập trình chức năng thêm, xóa, sửa khi ra các gói câu đố trong game.','0000-00-00'),('CV3.4','Lập trình quản lý người dùng','Phạm Thúy Ngọc',NULL,NULL,0,NULL,NULL,NULL,'CV3','','đang làm',35,'Lập trình các chức năng thêm, xóa, sửa thông tin của người dùng.','0000-00-00'),('CV4','Kiểm thử','Phạm Thúy Ngọc','2014-02-09','2014-03-28',0,'2014-02-10 00:00:00',NULL,0,'0','trung bình','sắp làm',0,'Thực hiện kiểm thử các chức năng chính, quan trọng','0000-00-00'),('CV4.1','Kế hoạch kiểm thử','Đoàn Ái ngọc','2014-02-09','2014-03-28',0,'2014-02-10 00:00:00',NULL,0,'CV4','cao','sắp làm',0,'Viết kế hoạch chi tiết thực hiện kiểm thử, theo mẫu có sẳn','0000-00-00'),('CV4.2','Xác định các trường hợp kiểm thử','Võ Thành Luân','2015-07-02','2015-07-02',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,'CV4','Thấp','sắp làm',20,'Xác định công cụ để kiểm thử, viết tài liệu chi tiết các trường hợp kiểm thử','0000-00-00'),('CV5','Nhóm đang bàn luận','1111308','2015-08-01','2015-08-26',0,'2015-08-05 13:30:00','2015-08-05 13:30:00',43,'0','Cao','1',44,'<p>\r\n	L&agrave;m g&igrave; nhỉ?</p>\r\n','0000-00-00'),('CV5.1','Đang bàn','Võ Thành Luân','2015-08-01','2015-08-26',0,'2015-08-05 00:00:00','2015-08-31 00:00:00',12,'CV5','Cao','1',32,'<p>\r\n	đang suy nghĩ n&ocirc;i dung</p>\r\n','0000-00-00');
/*!40000 ALTER TABLE `cong_viec` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `danh_gia`
--

DROP TABLE IF EXISTS `danh_gia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `danh_gia` (
  `matl` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `macb` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nd_danhgia` text COLLATE utf8_unicode_ci,
  `ngaydanhgia` date DEFAULT NULL,
  PRIMARY KEY (`matl`,`macb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `danh_gia`
--

LOCK TABLES `danh_gia` WRITE;
/*!40000 ALTER TABLE `danh_gia` DISABLE KEYS */;
/*!40000 ALTER TABLE `danh_gia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `de_tai`
--

DROP TABLE IF EXISTS `de_tai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `de_tai` (
  `madt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `macb` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tendt` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `motadt` text COLLATE utf8_unicode_ci,
  `congnghe` text COLLATE utf8_unicode_ci,
  `taptindinhkem` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `songuoitoida` int(11) DEFAULT NULL,
  `trangthai` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ngaytao` date NOT NULL,
  `ghichudt` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`madt`),
  KEY `fk_ra_de_tai` (`macb`),
  CONSTRAINT `fk_ra_de_tai` FOREIGN KEY (`macb`) REFERENCES `giang_vien` (`macb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `de_tai`
--

LOCK TABLES `de_tai` WRITE;
/*!40000 ALTER TABLE `de_tai` DISABLE KEYS */;
INSERT INTO `de_tai` VALUES ('1','2134','Website bán đồ nội thất','Thiết kế một website cho phép người dùng xem, tìm kiếm, đặt mua các vật dụng gia đình như bàn, ghế,tủ,...','Thực hiện bằng framework bootstrap','',2,'Hoàn thành','0000-00-00','Phải thực hiện được chức năng đặt hàng trực tuyến, trang giới thiệu phải thật sinh động, đẹp mắt.'),('10','2134','Đang đợi có ý tưởng','Đang đợi &yacute; tưởng n&ecirc;n chưa biết l&agrave;m g&igrave;!','T&igrave;m hiểu c&ocirc;ng nghệ phổ biến hiện nay','',3,'Chưa làm','2015-09-04','Hiều được c&ocirc;ng nghệ mới v&agrave; thực hiện được chức năng nổi bật của phần m&ecirc;m'),('2','5431','Phần mềm quản lý nghiên cứu khoa học','<p>\r\n	- Đầy đủ t&iacute;nh năng của một quy tr&igrave;nh quản l&yacute; đề t&agrave;i: từ đề xuất, giải tr&igrave;nh th&ocirc;ng tin, x&eacute;t duyệt đến qu&aacute; tr&igrave;nh nghiệm thu. - Quản l&yacute; th&ocirc;ng tin l&yacute; lịch khoa học c&aacute;n bộ nghi&ecirc;n cứu một c&aacute;ch chi tiết. - T&igrave;m kiếm th&ocirc;ng tin nhanh gọnch&iacute;nh x&aacute;c, hỗ trợ lập b&aacute;o c&aacute;o nhanh theo y&ecirc;u cầu l&atilde;nh đạo - Hỗ trợ in ấn, b&aacute;o c&aacute;o c&aacute;cmẫu biểu theo đ&uacute;ng mẫu biểu hiện h&agrave;nh được sử dụng. - Ph&acirc;n quyền, ph&acirc;n cấp tớitừng chức năng của chương tr&igrave;nh.</p>\r\n','<p>\r\n	- Sử dụng C&ocirc;ng nghệ Dotnet: ng&ocirc;n ngữlập tr&igrave;nh C#, Net FrameWork 2.0 - RDBMS: MS SQL Server 2000 trở l&ecirc;n</p>\r\n','',3,'Chưa làm','2015-07-18','<p>\r\n	- Quản l&yacute; cơ sở dữ liệu tập trung - Thiết kế theo m&ocirc; h&igrave;nh kh&aacute;ch&ndash; chủ, dữ liệu sẽ được xử l&yacute; nhanh hơn</p>\r\n'),('3','2134','Game học anh văn trên Androi','Thiết kế một trò chơi cho trẻ em, vừa học vừa chơi','Chạy trên hệ điều hành Androi','',2,'Đang làm','0000-00-00','Giao diện phải thật sinh động, đẹp mắt.'),('4','5431','Phần mềm quản lý hàng hóa siêu thị','- Đầy đủ tính năng của một quy trình quản lý đề tài: từ đề xuất, giải trình thông tin, xét duyệt đến quá trình nghiệm thu.\r\n- Quản lý thông tin lý lịch khoa học cán bộ nghiên cứu một cách chi tiết.\r\n- Tìm kiếm thông tin nhanh gọnchính xác, hỗ trợ lập báo cáo nhanh theo yêu cầu lãnh đạo\r\n- Hỗ trợ in ấn, báo cáo cácmẫu biểu theo đúng mẫu biểu hiện hành được sử dụng.\r\n- Phân quyền, phân cấp tớitừng chức năng của chương trình.','- Sử dụng Công nghệ Dotnet: ngôn ngữlập trình C#, Net FrameWork 2.0\r\n- RDBMS: MS SQL Server 2000 trở lên','',3,'Chưa làm','0000-00-00','- Quản lý cơ sở dữ liệu tập trung \r\n- Thiết kế theo mô hình khách– chủ, dữ liệu sẽ được xử lý nhanh hơn'),('5','2134','Phần mềm quản lý nghiên cứu khoa học','Đầy đủ t&iacute;nh năng của một quy tr&igrave;nh quản l&yacute; đề t&agrave;i: từ đề xuất, giải tr&igrave;nh th&ocirc;ng tin, x&eacute;t duyệt đến qu&aacute; tr&igrave;nh nghiệm thu. - Quản l&yacute; th&ocirc;ng tin l&yacute; lịch khoa học c&aacute;n bộ nghi&ecirc;n cứu một c&aacute;ch chi tiết. - T&igrave;m kiếm th&ocirc;ng tin nhanh gọnch&iacute;nh x&aacute;c, hỗ trợ lập b&aacute;o c&aacute;o nhanh theo y&ecirc;u cầu l&atilde;nh đạo - Hỗ trợ in ấn, b&aacute;o c&aacute;o c&aacute;cmẫu biểu theo đ&uacute;ng mẫu biểu hiện h&agrave;nh được sử dụng. - Ph&acirc;n quyền, ph&acirc;n cấp tớitừng chức năng của chương tr&igrave;nh.','<p>\r\n	Sử dụng C&ocirc;ng nghệ Dotnet: ng&ocirc;n ngữlập tr&igrave;nh C#, Net FrameWork 2.0 - RDBMS: MS SQL Server 2000 trở l&ecirc;n</p>\r\n','',3,'Chưa làm','2015-09-04','<p>\r\n	&nbsp;Quản l&yacute; cơ sở dữ liệu tập trung - Thiết kế theo m&ocirc; h&igrave;nh kh&aacute;ch&ndash; chủ, dữ liệu sẽ được xử l&yacute; nhanh hơn</p>\r\n'),('6','2134','Phần mềm quản lý hóa đơn','Thiết kế các chức năng tính tiền, thống kê doanh thu theo hóa đơn','Sử dụng ngôn ngữ lập trình Java hoặc C#','',2,'Chưa làm','2014-01-01',NULL),('7','2134','Game pikachu trên Androi',NULL,NULL,'',3,'Chưa làm','0000-00-00',NULL),('8','2134','Đang đợi có ý tưởng','Chưa c&oacute; m&ocirc; tả.','D&ugrave;ng những c&ocirc;ng nghệ, ng&ocirc;n ngữ lập tr&igrave;nh phổ biến hiện nay','',3,'Chưa làm','2015-09-04','Phần mềm phải c&oacute; chức năng nổi bật, hiểu r&otilde; c&ocirc;ng nghệ thực hiện'),('9','2134','Phần mềm hỗ trợ thiết kế bài giảng cho tiểu học','Tạo c&aacute;c chức năng để hỗ trợ gi&aacute;o vi&ecirc;n tiểu học thiết kế b&agrave;i giảng thật đẹp mắt v&agrave; sinh động. Cần c&aacute;c c&ocirc;ng cụ đồ họa. Cần c&aacute;c chức năng hỗ trợ tạo c&aacute;c hiệu ứng đẹp mắt','Java v&agrave; Framework SpringMVC','',4,'Chưa làm','2015-09-04','');
/*!40000 ALTER TABLE `de_tai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `giang_vien`
--

DROP TABLE IF EXISTS `giang_vien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `giang_vien` (
  `macb` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  `gioitinh` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` date NOT NULL,
  `email` varchar(60) CHARACTER SET utf8 DEFAULT NULL,
  `sdt` int(11) NOT NULL,
  `hinhdaidien` text COLLATE utf8_unicode_ci NOT NULL,
  `matkhau` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ngaytao` date NOT NULL,
  `khoa` tinyint(1) NOT NULL,
  `quantri` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`macb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `giang_vien`
--

LOCK TABLES `giang_vien` WRITE;
/*!40000 ALTER TABLE `giang_vien` DISABLE KEYS */;
INSERT INTO `giang_vien` VALUES ('1234','Pham Tâm An','Nữ','2015-09-30','an@gmail.com',2147483647,'','fcea920f7412b5da7be0cf42b8c93759','2015-09-06',0,0),('2134','Cao Thanh Tao','Nam','2015-07-21','tao@cit.ctu.edu.vn',923456789,'Tao2134.png','e10adc3949ba59abbe56e057f20f883e','2015-07-27',0,0),('2345','Trung Thành','Nam','0000-00-00','thanh@gmail.com',2147483647,'','e10adc3949ba59abbe56e057f20f883e','2015-07-14',0,1),('3718','Đào Mai','Nữ','0000-00-00','mai@gmail.com',876543221,'','e10adc3949ba59abbe56e057f20f883e','2015-07-14',0,1),('4718','Mới Tạo','Nam','2015-08-24','tao@gmail.com',2147483647,'','e10adc3949ba59abbe56e057f20f883e','0000-00-00',0,0),('5431','Phạm Ngọc Thạch','Nữ','0000-00-00','thach@cit.ctu.edu.vn',987654323,'',NULL,'0000-00-00',1,0),('9876','Mai Tú Cầu','Nam','0000-00-00','cau@gmail.com',2147483647,'','e10adc3949ba59abbe56e057f20f883e','2015-07-14',0,1),('9877','àdsfád','Nữ','2015-09-01','ai@student.ctu.edu.vn',1234567890,'','e10adc3949ba59abbe56e057f20f883e','2015-09-04',0,NULL);
/*!40000 ALTER TABLE `giang_vien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhan_thong_bao`
--

DROP TABLE IF EXISTS `nhan_thong_bao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhan_thong_bao` (
  `manhomthuchien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`manhomthuchien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhan_thong_bao`
--

LOCK TABLES `nhan_thong_bao` WRITE;
/*!40000 ALTER TABLE `nhan_thong_bao` DISABLE KEYS */;
/*!40000 ALTER TABLE `nhan_thong_bao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhom_hocphan`
--

DROP TABLE IF EXISTS `nhom_hocphan`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhom_hocphan` (
  `manhomhp` int(11) NOT NULL,
  `macb` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `tennhomhp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `mank` int(11) NOT NULL,
  `siso` int(11) DEFAULT NULL,
  PRIMARY KEY (`manhomhp`),
  KEY `mank` (`mank`),
  CONSTRAINT `nhom_hocphan_ibfk_1` FOREIGN KEY (`mank`) REFERENCES `nien_khoa` (`mank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhom_hocphan`
--

LOCK TABLES `nhom_hocphan` WRITE;
/*!40000 ALTER TABLE `nhom_hocphan` DISABLE KEYS */;
INSERT INTO `nhom_hocphan` VALUES (1,'5431','01',1,30),(2,'9876','01',2,20),(3,'3718','02',2,25),(4,'2345','01',3,25),(5,'5431','01',4,50),(6,'2134','01',5,20),(7,'1234','02',5,20),(8,'2134','03',5,25),(9,'','04',5,20),(10,'','05',5,20);
/*!40000 ALTER TABLE `nhom_hocphan` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhom_thuc_hien`
--

DROP TABLE IF EXISTS `nhom_thuc_hien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhom_thuc_hien` (
  `manhomthuchien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `lichhop` text COLLATE utf8_unicode_ci,
  `tochucnhom` text COLLATE utf8_unicode_ci NOT NULL,
  `ngaybatdau_kehoach` date DEFAULT NULL,
  `ngayketthuc_kehoach` date DEFAULT NULL,
  `ngaybatdau_thucte` datetime DEFAULT NULL,
  `ngayketthuc_thucte` datetime DEFAULT NULL,
  `sogio_thucte` int(11) DEFAULT NULL,
  `tiendo` int(11) NOT NULL,
  `hoanthanh` tinyint(1) DEFAULT NULL,
  `phamvi_detai` text COLLATE utf8_unicode_ci,
  `congnghethuchien` text COLLATE utf8_unicode_ci,
  `nhanxet` text COLLATE utf8_unicode_ci,
  `ngaytao` date NOT NULL,
  PRIMARY KEY (`manhomthuchien`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhom_thuc_hien`
--

LOCK TABLES `nhom_thuc_hien` WRITE;
/*!40000 ALTER TABLE `nhom_thuc_hien` DISABLE KEYS */;
INSERT INTO `nhom_thuc_hien` VALUES ('NTH01','S2','Tổ chức ma trận (các nhóm bộ phận có chuyên môn sâu, các nhóm bộ phận tham gia bán thời gian vào dự án khác, người quản lý dự án chịu trách nhiệm cho sự thành công của toàn bộ dụe án và nâng cao kiến thức chuyên môn)',NULL,NULL,NULL,NULL,20,20,NULL,NULL,NULL,NULL,'0000-00-00'),('NTH02','S2, S3, S4, C2, C3, C4','Nh&oacute;m lập tr&igrave;nh vi&ecirc;n ch&iacute;nh (Nh&oacute;m trưởng-thiết kế v&agrave; c&agrave;i đặt phần ch&iacute;nh của hệ thống, trợ l&yacute;-gi&uacute;p việc nh&oacute;m trưởng, người quản l&yacute; t&agrave;i liệu) ',NULL,NULL,NULL,NULL,30,10,NULL,'Đang nghi&ecirc;n cứu phạm vi đề t&agrave;i','<p>\r\n	PHP v&agrave; Framework của php</p>\r\n',NULL,'0000-00-00'),('NTH03','s6','Nhóm lập trình nhanh(làm việc theo cặp trên một máy tính đơn-người chính, người phụ đổi vai trò)',NULL,NULL,NULL,NULL,0,5,NULL,NULL,NULL,NULL,'0000-00-00'),('NTH04','C4','',NULL,NULL,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'0000-00-00'),('NTH05',NULL,'','2015-09-01','2015-09-30',NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'2015-09-06');
/*!40000 ALTER TABLE `nhom_thuc_hien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nien_khoa`
--

DROP TABLE IF EXISTS `nien_khoa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nien_khoa` (
  `mank` int(11) NOT NULL,
  `nam` varchar(9) CHARACTER SET utf8 DEFAULT NULL,
  `hocky` int(11) DEFAULT NULL,
  PRIMARY KEY (`mank`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nien_khoa`
--

LOCK TABLES `nien_khoa` WRITE;
/*!40000 ALTER TABLE `nien_khoa` DISABLE KEYS */;
INSERT INTO `nien_khoa` VALUES (1,'2012-2013',1),(2,'2012-2013',2),(3,'2012-2013',3),(4,'2013-2014',1),(5,'2013-2014',2);
/*!40000 ALTER TABLE `nien_khoa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `quy_dinh`
--

DROP TABLE IF EXISTS `quy_dinh`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `quy_dinh` (
  `macb` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matc` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`macb`,`matc`),
  KEY `fk_quy_dinh2` (`matc`),
  CONSTRAINT `fk_quy_dinh` FOREIGN KEY (`macb`) REFERENCES `giang_vien` (`macb`),
  CONSTRAINT `fk_quy_dinh2` FOREIGN KEY (`matc`) REFERENCES `tieu_chi_danh_gia` (`matc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quy_dinh`
--

LOCK TABLES `quy_dinh` WRITE;
/*!40000 ALTER TABLE `quy_dinh` DISABLE KEYS */;
INSERT INTO `quy_dinh` VALUES ('2134','1'),('2134','2'),('2134','3'),('2134','4'),('3718','5'),('3718','6'),('3718','7');
/*!40000 ALTER TABLE `quy_dinh` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ra_de_tai`
--

DROP TABLE IF EXISTS `ra_de_tai`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ra_de_tai` (
  `madt` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `manhomthuchien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ghichu` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`madt`),
  KEY `manhomthuchien` (`manhomthuchien`),
  CONSTRAINT `ra_de_tai_ibfk_1` FOREIGN KEY (`madt`) REFERENCES `de_tai` (`madt`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ra_de_tai`
--

LOCK TABLES `ra_de_tai` WRITE;
/*!40000 ALTER TABLE `ra_de_tai` DISABLE KEYS */;
INSERT INTO `ra_de_tai` VALUES ('1','NTH03',''),('10','NTH05',''),('3','NTH02',''),('6','NTH01',''),('7','NTH04','');
/*!40000 ALTER TABLE `ra_de_tai` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sinh_vien`
--

DROP TABLE IF EXISTS `sinh_vien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sinh_vien` (
  `mssv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hoten` varchar(30) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `gioitinh` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ngaysinh` date NOT NULL,
  `khoahoc` int(11) DEFAULT NULL,
  `email` varchar(60) CHARACTER SET utf32 COLLATE utf32_unicode_ci DEFAULT NULL,
  `sdt` int(11) DEFAULT '0',
  `hinhdaidien` text COLLATE utf8_unicode_ci NOT NULL,
  `kynangcongnghe` text COLLATE utf8_unicode_ci,
  `kienthuclaptrinh` text COLLATE utf8_unicode_ci,
  `kinhnghiem` text COLLATE utf8_unicode_ci,
  `matkhau` varchar(100) CHARACTER SET utf8 DEFAULT NULL,
  `ngaytao` date NOT NULL,
  `khoa` tinyint(1) NOT NULL,
  PRIMARY KEY (`mssv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sinh_vien`
--

LOCK TABLES `sinh_vien` WRITE;
/*!40000 ALTER TABLE `sinh_vien` DISABLE KEYS */;
INSERT INTO `sinh_vien` VALUES ('1111222','Hoàng Hậu','Nữ','1992-08-04',66,'hau@gmail.com',NULL,'',NULL,NULL,NULL,'fcea920f7412b5da7be0cf42b8c93759','2015-09-04',0),('1111223','Cindy Candy','nữ','1992-08-04',36,'candy@gmail.com',NULL,'',NULL,NULL,NULL,NULL,'0000-00-00',0),('1111271','Lê Giang Anh','nam','1993-03-11',37,'anh111271@student.ctu.edu.vn',0,'',NULL,NULL,NULL,NULL,'0000-00-00',0),('1111306','Nguyễn Hoàng Long','Nữ','1993-08-18',37,'long111206@student.ctu.edu.vn',54645635,'','                                                        Mô hình MVC                                                                                                                                        ','                                                         Đã học C/C++, Java, PHP                                                                                                                                        ','                                                        Chưa được thực hiện 1 phần mềm nào                                                                                                                        ','e10adc3949ba59abbe56e057f20f883e','2015-07-14',0),('1111308','Võ Thành Luân','nam','1993-09-22',37,'luan111308@student.ctu.edu.vn',0,'','	',NULL,NULL,NULL,'0000-00-00',0),('1111317','Nguyễn Thiên Lý','Nữ','1993-06-03',36,'ngoc111319@student.ctu.edu.vn',123456789,'Ngoc1111317.jpg','                                                - Thiết kế CSDL, Thiết kế và phát triển phần mềm, phân tích số liệu.                                                                                                                                                                      ','                                                 - Biết về ngôn ngữ lập trình C/C++, Lập trình java, ngôn ngữ lập trình php.                                                                                                                          ','                                                - Đã từng làm phần mềm quản lý hóa đơn bằng ngôn ngữ lập trình java.                                                                                                                             ','fcea920f7412b5da7be0cf42b8c93759','2015-09-06',0),('1111324','Đoàn Ái Ngọc','nữ','1992-02-01',37,'dngoc111324@student.ctu.edu.vn',0,'',NULL,NULL,NULL,NULL,'0000-00-00',0),('1111333','Mật Mã','nam','1992-11-01',36,'ma@gmail.com',NULL,'',NULL,NULL,NULL,NULL,'0000-00-00',0),('1111342','Lê Trương Quốc Thắng','nam','1993-03-18',37,'thang111342@student.ctu.edu.vn',0,'','	\r\n',NULL,NULL,NULL,'0000-00-00',0),('1111359','Nguyễn Châu Thiên Tú','nam','1992-08-21',37,'tu111359@student.ctu.edu.vn',0,'','',NULL,NULL,NULL,'0000-00-00',0),('1111366','Ngô Hải Vân','nam','1993-08-10',37,'van111366@student.ctu.edu.vn',0,'','\r\n',NULL,NULL,NULL,'0000-00-00',0),('1111432','Lâm Thành Đồng','Nam','0000-00-00',36,'dong@gmail.com',0,'Dong1111432.jpg','','','','d41d8cd98f00b204e980','0000-00-00',0),('1113456','Cẩm Tú cầu','Nữ','1995-12-01',39,'cau113456@gmail.com',NULL,'','','','','e10adc3949ba59abbe56','2015-07-14',0),('1211234','La Trịnh Nhân Ái','Nữ','2015-07-01',38,'ai233234@student.ctu.edu.vn',0,'','','','','d41d8cd98f00b204e980','2015-07-27',0),('21321','Chưa Biết','Nam','2015-08-04',40,'biet@gmail.com',NULL,'',NULL,NULL,NULL,'123456','0000-00-00',0),('21322','sdsdfsdf','Nữ','2015-08-03',22,'ai@student.ctu.edu.vn',0,'',NULL,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e','2015-08-31',0),('21323','Hoa Phát Tài','Nữ','2015-09-21',21,'phattai@gmail.com',0,'',NULL,NULL,NULL,'e10adc3949ba59abbe56e057f20f883e','2015-09-04',0);
/*!40000 ALTER TABLE `sinh_vien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tai_lieu`
--

DROP TABLE IF EXISTS `tai_lieu`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tai_lieu` (
  `matl` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `macv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tentl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kichthuoc` float NOT NULL,
  `mota` text COLLATE utf8_unicode_ci,
  `ngaycapnhat` datetime DEFAULT NULL,
  `dieuchinh` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`matl`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tai_lieu`
--

LOCK TABLES `tai_lieu` WRITE;
/*!40000 ALTER TABLE `tai_lieu` DISABLE KEYS */;
INSERT INTO `tai_lieu` VALUES ('TL01','CV1','thucte .doc',33.48,'','2015-08-08 16:15:04','');
/*!40000 ALTER TABLE `tai_lieu` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thong_bao`
--

DROP TABLE IF EXISTS `thong_bao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thong_bao` (
  `macb` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matb` varchar(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noidungtb` text COLLATE utf8_unicode_ci,
  `batdautb` date DEFAULT NULL,
  `ketthuctb` date DEFAULT NULL,
  `donghethong` tinyint(1) DEFAULT NULL,
  `ngaytao` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thong_bao`
--

LOCK TABLES `thong_bao` WRITE;
/*!40000 ALTER TABLE `thong_bao` DISABLE KEYS */;
/*!40000 ALTER TABLE `thong_bao` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `thuc_hien`
--

DROP TABLE IF EXISTS `thuc_hien`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `thuc_hien` (
  `manhomthuchien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `macv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`manhomthuchien`,`macv`),
  KEY `macv` (`macv`),
  CONSTRAINT `thuc_hien_ibfk_1` FOREIGN KEY (`manhomthuchien`) REFERENCES `nhom_thuc_hien` (`manhomthuchien`),
  CONSTRAINT `thuc_hien_ibfk_2` FOREIGN KEY (`macv`) REFERENCES `cong_viec` (`macv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thuc_hien`
--

LOCK TABLES `thuc_hien` WRITE;
/*!40000 ALTER TABLE `thuc_hien` DISABLE KEYS */;
INSERT INTO `thuc_hien` VALUES ('NTH01','1'),('NTH01','1.1'),('NTH01','1.2'),('NTH01','1.3'),('NTH01','2'),('NTH01','2.1'),('NTH01','2.2'),('NTH01','2.3'),('NTH01','2.4'),('NTH01','3'),('NTH01','4'),('NTH01','4.1'),('NTH01','4.2'),('NTH01','5'),('NTH01','5.1'),('NTH01','6'),('NTH01','6.1'),('NTH02','CV1'),('NTH02','CV1.1'),('NTH02','CV1.2'),('NTH02','CV2'),('NTH02','CV3'),('NTH02','CV3.1'),('NTH02','CV3.2'),('NTH02','CV3.3'),('NTH02','CV3.4'),('NTH02','CV4'),('NTH02','CV4.1'),('NTH02','CV4.2'),('NTH02','CV5'),('NTH02','CV5.1');
/*!40000 ALTER TABLE `thuc_hien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tieu_chi_danh_gia`
--

DROP TABLE IF EXISTS `tieu_chi_danh_gia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tieu_chi_danh_gia` (
  `matc` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `noidungtc` text COLLATE utf8_unicode_ci,
  `heso` float DEFAULT NULL,
  `ngaytao` date NOT NULL,
  PRIMARY KEY (`matc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tieu_chi_danh_gia`
--

LOCK TABLES `tieu_chi_danh_gia` WRITE;
/*!40000 ALTER TABLE `tieu_chi_danh_gia` DISABLE KEYS */;
INSERT INTO `tieu_chi_danh_gia` VALUES ('1','Đánh giá về sự hoàn thành của dự án',4,'2015-02-28'),('2','Kỹ năng làm việc nhóm',1,'2015-07-18'),('3','Tài liệu báo cáo',3,'2015-03-31'),('4','Phần Demo dự án',2,'2015-03-31'),('5','Tính sáng tạo',1,'2014-06-30'),('6','Phần mềm dự án',5,'2014-06-30'),('7','Tài liệu dự án',4,'2014-06-30');
/*!40000 ALTER TABLE `tieu_chi_danh_gia` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-09-09 15:59:43

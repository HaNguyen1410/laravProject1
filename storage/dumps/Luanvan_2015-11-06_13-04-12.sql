-- MySQL dump 10.13  Distrib 5.6.26, for Win32 (x86)
--
-- Host: localhost    Database: qlnienluan_ktpm
-- ------------------------------------------------------
-- Server version	5.6.26

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
  CONSTRAINT `chia_nhom_ibfk_2` FOREIGN KEY (`manhomhp`) REFERENCES `nhom_hocphan` (`manhomhp`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chia_nhom`
--

LOCK TABLES `chia_nhom` WRITE;
/*!40000 ALTER TABLE `chia_nhom` DISABLE KEYS */;
INSERT INTO `chia_nhom` VALUES ('1111222',6,' ',0,''),('1111223',6,' ',0,''),('1111224',6,' ',0,''),('1111225',7,'NTH05',1,''),('1111226',7,'NTH05',0,''),('1111227',7,'',0,''),('1111271',6,'NTH01',0,'Lười họp nhóm'),('1111306',6,'NTH01',1,'Chịu khó tìm hiểu và thảo luận'),('1111308',6,'NTH02',0,'Hoàn thành tốt công việc, có tích cực trong việc tham gia thảo luận nhóm.'),('1111317',6,'NTH02',0,''),('1111324',6,'NTH02',1,''),('1111333',6,' ',0,''),('1111342',8,'NTH03',1,''),('1111359',6,'NTH01',0,''),('1111366',6,' ',0,''),('1111432',8,'NTH04',1,''),('1113456',8,'NTH04',0,''),('1211234',6,' ',0,'');
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
  CONSTRAINT `chitiet_diem_ibfk_1` FOREIGN KEY (`matc`) REFERENCES `tieu_chi_danh_gia` (`matc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `chitiet_diem`
--

LOCK TABLES `chitiet_diem` WRITE;
/*!40000 ALTER TABLE `chitiet_diem` DISABLE KEYS */;
INSERT INTO `chitiet_diem` VALUES ('4','1111222',NULL),('4','1111223',NULL),('4','1111224',NULL),('4','1111271',0.6),('4','1111306',0.5),('4','1111308',0),('4','1111317',1),('4','1111324',0),('4','1111333',NULL),('4','1111342',0),('4','1111359',1),('4','1111366',NULL),('4','1111432',0),('4','1113456',0),('4','1211234',NULL),('5','1111222',NULL),('5','1111223',NULL),('5','1111271',1.8),('5','1111306',1.5),('5','1111308',0),('5','1111317',2),('5','1111324',0),('5','1111333',NULL),('5','1111342',0),('5','1111359',1),('5','1111366',NULL),('5','1111432',0),('5','1113456',0),('5','1211234',NULL),('5','21321',NULL),('6','1111222',NULL),('6','1111223',NULL),('6','1111271',1.67),('6','1111306',2.5),('6','1111308',0),('6','1111317',2.6),('6','1111324',0),('6','1111333',NULL),('6','1111342',0),('6','1111359',2),('6','1111366',NULL),('6','1111432',0),('6','1113456',0),('6','1211234',NULL),('6','21321',NULL),('7','1111222',NULL),('7','1111223',NULL),('7','1111224',NULL),('7','1111271',0),('7','1111306',0),('7','1111308',0),('7','1111317',0),('7','1111324',0),('7','1111333',NULL),('7','1111342',0),('7','1111359',0),('7','1111366',NULL),('7','1111432',0),('7','1113456',0),('7','1211234',NULL);
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
  `sotuan_kehoach` int(11) NOT NULL,
  `ngaybatdau_thucte` datetime DEFAULT NULL,
  `ngayketthuc_thucte` datetime DEFAULT NULL,
  `sotuan_thucte` int(11) DEFAULT NULL,
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
INSERT INTO `cong_viec` VALUES ('1','Phân tích yêu cầu','Nguyễn Hoàng Long, Nguyễn Châu Thiên Tú','2015-09-01','2015-09-05',0,'2015-09-01 00:00:00','2015-09-01 00:00:00',0,'0','Cao','Đang làm',20,'Ph&acirc;n t&iacute;ch nội dung đề t&agrave;i','2015-10-28'),('1.1','Thu thập yêu cầu, phân loại các yêu cầu','Lê Giang Anh',NULL,NULL,0,NULL,NULL,0,'1','','Đang làm',50,'Viết mẫu câu hỏi phổng vấn, xem các tài liệu sẵn có','0000-00-00'),('1.2','Viết tài liệu yêu cầu ','Nguyễn Châu Thiên Tú',NULL,NULL,0,NULL,NULL,0,'1','','Đang làm',40,'Định nghĩa các yêu cầu, đặc tả các yêu cầu.','0000-00-00'),('1.3','Thẩm tra và công nhận hợp lệ ','Nguyễn Hoàng Long',NULL,NULL,0,NULL,NULL,0,'1','','Sắp làm',0,'-Kiểm tra xem đặc tả yêu cầu có phù hợp với định nghĩa yêu cầu;   -Xác nhận-kiểm tra xem định nghĩa các yêu cầu có phản ánh chính xác nhu cầu của khách hàng.','0000-00-00'),('1.4','Viết tài liệu kế hoạch thực hiện dự án','Lê Giang Anh','2015-10-01','2015-10-10',0,NULL,NULL,NULL,'1','Cao','Đang làm',12,'Viết kế hoạch chi tiết ph&acirc;n c&ocirc;ng v&agrave; thực hiện dự &aacute;n','2015-10-07'),('2','Thiết kế phần mềm','Cả nhóm',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',10,NULL,'0000-00-00'),('2.1','Thiết kế kiến trúc ','Lê Giang Anh',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',17,'Liên kế các thành phần của hệ thống với các khả năng đã được xác định trong đặc tả yêu cầu','0000-00-00'),('2.2','Thiếu kế dữ liệu ','Nguyễn Hoàng Long',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',30,'Các thành phần dữ liệu và bảng để tạo CSDL','0000-00-00'),('2.3','Thiết kế giao diện ','',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',15,'Các form nhập liệu, các báo cáo và kết xuất mà hệ thống phải sinh ra','0000-00-00'),('2.4','Thiết kế thủ tục','',NULL,NULL,0,NULL,NULL,0,'2','','Sắp làm',5,' -Giải thích quá trình xử lý từ input đến output.\r\n -Biểu diễn bằng: lưu đồ giải thuật.','0000-00-00'),('3','Lập trình phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('4','Kiểm thử phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('4.1','Kiểm thử chương trình và lập kế hoạch kiểm thử','',NULL,NULL,0,NULL,NULL,0,'4','','Sắp làm',0,'Các lỗi phần mềm, kiểm thử đơn vị, kiểm thử tích hợp,lập kế hoạch kiểm thử, công cụ kiểm thử','0000-00-00'),('4.2','Kiểm thử chương trình và viết tài liệu các trường hợp kiểm thử','',NULL,NULL,0,NULL,NULL,0,'4','','Sắp làm',0,' -Kiểm thử chức năng: hệ thống có thực hiện như cam kế trong đặc tả yêu cầu?   -Kiểm thử thực hiện: các yếu tố phi chức năng có được đáp ứng? -Kiểm thử chấp nhận: hệ thống có đạt được cái ma khách hàng mong muốn? -Kiểm thử sự cài đặt: hệ thống có vận hành ở chỗ khách hàng tốt không?','0000-00-00'),('5','Triển khai hệ thống','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('5.1','Cài đặt hệ thống cho khách hàng, viết tài liệu hướng dẫn sử dụng hệ thống.','',NULL,NULL,0,NULL,NULL,0,'5','','Sắp làm',0,NULL,'0000-00-00'),('6','Bảo trì phần mềm','',NULL,NULL,0,NULL,NULL,0,'0','','Sắp làm',0,NULL,'0000-00-00'),('6.1','Lập kế hoạch bảo trì','',NULL,NULL,0,NULL,NULL,0,'6','','Sắp làm',0,NULL,'0000-00-00'),('CV1','Phân tích đề tài và thiết kế CSDL','Cả nhóm','2014-02-09','2013-06-22',0,'2014-01-07 00:00:00','2014-01-07 00:00:00',10,'0','cao','Hoàn thành',100,'Phải ph&acirc;n t&iacute;ch cấu tr&uacute;c lưu CSDL v&agrave; c&aacute;c chức năng ch&igrave;nh cần thực hiện','2015-09-28'),('CV1.1','Thiết kế CSDL','Võ Thành Luân','2014-02-09','2014-02-21',0,'2014-02-04 00:00:00','2014-02-19 00:00:00',10,'CV1','Cao','Đang làm',0,'Phải ph&acirc;n t&iacute;ch cấu tr&uacute;c lưu CSDL, x&aacute;c định c&aacute;c thực thể cần lưu ','2015-09-28'),('CV1.2','Vẽ sơ đồ CDM','',NULL,NULL,0,'2014-02-11 00:00:00','2014-02-18 00:00:00',20,'CV1','','Đang làm',0,'Dựa vào các thực thể đã phân tích để vẽ sơ đồ CDM và sơ đồ usecase','0000-00-00'),('CV1.3','fdsfdsa','Đoàn Ái Ngọc','2015-09-01','2015-09-01',0,'2015-09-02 00:00:00','2015-09-02 00:00:00',1,'CV1','Cao','Hoàn thành',100,'fds&agrave;','2015-09-28'),('CV2','Thiết kế giao diện','Võ Thành Luân','2014-02-09','2014-02-22',0,'2013-02-11 00:00:00',NULL,20,'0','trung bình','Đang làm',10,'Thiết kế chi tiết các chức năng theo CSDL đã phân tích, cập nhật lại CDM khi thiết kế','0000-00-00'),('CV3','Lập trình phần mềm','Cả nhóm','2014-01-06','2014-02-10',0,'2014-01-07 00:00:00',NULL,0,'0','cao','Đang làm',10,'Lập trình các chức năng như đã thiết kế.','0000-00-00'),('CV3.1','Lập trình đăng nhập','Võ Thành Luân',NULL,NULL,0,NULL,NULL,NULL,'CV3','','Đang làm',30,'Lập trình chức năng đăng nhập, phân quyền người dùng bình thường và admin. Sử dụng SESSION và COOKIE','0000-00-00'),('CV3.2','Lập trình đăng ký người dùng','Nguyễn Thiên Lý',NULL,NULL,0,NULL,NULL,NULL,'CV3','','Đang làm',50,'Viết chức năng cho phép người dùng đăng ký tài khoản để có những ưu đãi riêng, thực hiện bình luận.','0000-00-00'),('CV3.3','Lập trình quản lý câu đố trong game','Đoàn Ái Ngọc',NULL,NULL,0,NULL,NULL,NULL,'CV3','','Đang làm',25,'Lập trình chức năng thêm, xóa, sửa khi ra các gói câu đố trong game.','0000-00-00'),('CV3.4','Lập trình quản lý người dùng','Nguyễn Thiên Lý',NULL,NULL,0,NULL,NULL,NULL,'CV3','','đang làm',35,'Lập trình các chức năng thêm, xóa, sửa thông tin của người dùng.','0000-00-00'),('CV4','Kiểm thử','Nguyễn Thiên Lý','2014-02-09','2014-03-28',0,'2014-02-10 00:00:00',NULL,0,'0','trung bình','sắp làm',0,'Thực hiện kiểm thử các chức năng chính, quan trọng','0000-00-00'),('CV4.1','Kế hoạch kiểm thử','Đoàn Ái ngọc','2014-02-09','2014-03-28',0,'2014-02-10 00:00:00',NULL,0,'CV4','cao','sắp làm',0,'Viết kế hoạch chi tiết thực hiện kiểm thử, theo mẫu có sẳn','0000-00-00'),('CV4.2','Xác định các trường hợp kiểm thử','Võ Thành Luân','2015-07-02','2015-07-02',0,'0000-00-00 00:00:00','0000-00-00 00:00:00',2,'CV4','Thấp','sắp làm',20,'Xác định công cụ để kiểm thử, viết tài liệu chi tiết các trường hợp kiểm thử','0000-00-00'),('CV5','Nhóm đang bàn luận','1111308','2015-08-01','2015-08-26',0,'2015-08-05 13:30:00','2015-08-05 13:30:00',43,'0','Cao','Đang làm',44,'L&agrave;m g&igrave; nhỉ?','2015-09-13'),('CV5.1','Đang bàn','Võ Thành Luân','2015-08-01','2015-08-26',0,'2015-08-05 00:00:00','2015-08-31 00:00:00',12,'CV5','Cao','1',32,'<p>\r\n	đang suy nghĩ n&ocirc;i dung</p>\r\n','0000-00-00'),('CV6','Viết báo cáo','Cả nhóm','2015-09-01','2015-09-30',0,NULL,NULL,2,'0','Cao','Đang làm',5,'Viết b&aacute;o c&aacute;o &nbsp;tr&ecirc;n Powerpoint','2015-10-22'),('CV7','ádfdsf','Cả nhóm','2015-11-05','2015-11-06',0,NULL,NULL,NULL,'0','Cao','Đang làm',0,'dsf&aacute;dfsd','2015-11-04'),('CV7.1','đọc đề tài','Hoa Phát Tài','2015-11-01','2015-11-07',0,NULL,NULL,NULL,'CV7','Cao','Đang làm',0,'sdfsdfsd','2015-11-04');
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
INSERT INTO `danh_gia` VALUES ('TL01','2134','vẫn chưa rõ ràng','2015-09-28'),('TL02','',NULL,NULL),('TL03','',NULL,NULL),('TL04','',NULL,NULL),('TL05','',NULL,NULL),('TL06','',NULL,NULL);
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
  `ngaysua` date NOT NULL,
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
INSERT INTO `de_tai` VALUES ('1','2134','Website bán đồ nội thất','Thiết kế một website cho ph&eacute;p người d&ugrave;ng xem, t&igrave;m kiếm, đặt mua c&aacute;c vật dụng gia đ&igrave;nh như b&agrave;n, ghế,tủ,...','Thực hiện bằng framework bootstrap','CTU_Slide.ppt',2,'Đang làm','0000-00-00','2015-10-07','Phải thực hiện được chức năng đặt h&agrave;ng trực tuyến, trang giới thiệu phải thật sinh động, đẹp mắt.'),('10','2134','Game học tiếng anh trên Android','&nbsp;Ứng dụng tạo ra một m&ocirc;i trường học tiếng Anh tương t&aacute;c d&agrave;nh cho thiếu nhi th&ocirc;ng qua c&aacute;c chủ đề như: m&agrave;u sắc, tr&aacute;i c&acirc;y, rau quả, động vật, h&igrave;nh vẽ, thể thao, số đếm, sinh vật... .H&igrave;nh ảnh, nội dung v&agrave; ph&aacute;t &acirc;m cần kết hợp gi&uacute;p b&eacute; vừa chơi, học v&agrave; n&acirc;ng cao tr&iacute; tuệ. Đ&acirc;y kh&ocirc;ng chỉ l&agrave; một c&ocirc;ng cụ cho b&eacute; học tiếng Anh, m&agrave; n&oacute; c&ograve;n gi&uacute;p cho người học tiếng Anh n&oacute;i chung tăng hiểu biết về c&aacute;c chủ đề từ vựng th&ocirc;ng dụng trong cuộc sống. Hệ thống hỗ trợ đa cấp độ. Giao diện trực quan, s&aacute;ng tạo, sinh động','','Dacta_Thietke_Kiemthu.pdf',2,'Chưa làm','2015-09-28','2015-10-23',''),('11','1234','Phần mềm vẽ hình',NULL,NULL,'detai.docx',NULL,'Đang làm','2015-11-04','0000-00-00',NULL),('2','5431','Phần mềm quản lý nghiên cứu khoa học','\n	- Đầy đủ t&iacute;nh năng của một quy tr&igrave;nh quản l&yacute; đề t&agrave;i: từ đề xuất, giải tr&igrave;nh th&ocirc;ng tin, x&eacute;t duyệt đến qu&aacute; tr&igrave;nh nghiệm thu. - Quản l&yacute; th&ocirc;ng tin l&yacute; lịch khoa học c&aacute;n bộ nghi&ecirc;n cứu một c&aacute;ch chi tiết. - T&igrave;m kiếm th&ocirc;ng tin nhanh gọnch&iacute;nh x&aacute;c, hỗ trợ lập b&aacute;o c&aacute;o nhanh theo y&ecirc;u cầu l&atilde;nh đạo - Hỗ trợ in ấn, b&aacute;o c&aacute;o c&aacute;cmẫu biểu theo đ&uacute;ng mẫu biểu hiện h&agrave;nh được sử dụng. - Ph&acirc;n quyền, ph&acirc;n cấp tớitừng chức năng của chương tr&igrave;nh.\n','\n	- Sử dụng C&ocirc;ng nghệ Dotnet: ng&ocirc;n ngữlập tr&igrave;nh C#, Net FrameWork 2.0 - RDBMS: MS SQL Server 2000 trở l&ecirc;n\n','',3,'Chưa làm','2015-07-18','0000-00-00','\n	- Quản l&yacute; cơ sở dữ liệu tập trung - Thiết kế theo m&ocirc; h&igrave;nh kh&aacute;ch&ndash; chủ, dữ liệu sẽ được xử l&yacute; nhanh hơn\n'),('3','2134','Game học anh văn trên Androi','Thiết kế một tr&ograve; chơi cho trẻ em, vừa học vừa chơi.','Chạy tr&ecirc;n hệ điều h&agrave;nh Androi.','CTU_Slide.ppt',2,'Đang làm','0000-00-00','2015-10-11','Giao diện phải thật sinh động, đẹp mắt.'),('4','5431','Phần mềm quản lý hàng hóa siêu thị','- Đầy đủ tính năng của một quy trình quản lý đề tài: từ đề xuất, giải trình thông tin, xét duyệt đến quá trình nghiệm thu.\r\n- Quản lý thông tin lý lịch khoa học cán bộ nghiên cứu một cách chi tiết.\r\n- Tìm kiếm thông tin nhanh gọnchính xác, hỗ trợ lập báo cáo nhanh theo yêu cầu lãnh đạo\r\n- Hỗ trợ in ấn, báo cáo cácmẫu biểu theo đúng mẫu biểu hiện hành được sử dụng.\r\n- Phân quyền, phân cấp tớitừng chức năng của chương trình.','Sử dụng Công nghệ Dotnet: ngôn ngữlập trình C#, Net FrameWork 2.0 - RDBMS: MS SQL Server 2000 trở lên','',3,'Chưa làm','0000-00-00','0000-00-00','- Quản lý cơ sở dữ liệu tập trung \r\n- Thiết kế theo mô hình khách– chủ, dữ liệu sẽ được xử lý nhanh hơn'),('5','2134','Phần mềm quản lý nghiên cứu khoa học','Đầy đủ t&iacute;nh năng của một quy tr&igrave;nh quản l&yacute; đề t&agrave;i: từ đề xuất, giải tr&igrave;nh th&ocirc;ng tin, x&eacute;t duyệt đến qu&aacute; tr&igrave;nh nghiệm thu. - Quản l&yacute; th&ocirc;ng tin l&yacute; lịch khoa học c&aacute;n bộ nghi&ecirc;n cứu một c&aacute;ch chi tiết. - T&igrave;m kiếm th&ocirc;ng tin nhanh gọnch&iacute;nh x&aacute;c, hỗ trợ lập b&aacute;o c&aacute;o nhanh theo y&ecirc;u cầu l&atilde;nh đạo - Hỗ trợ in ấn, b&aacute;o c&aacute;o c&aacute;cmẫu biểu theo đ&uacute;ng mẫu biểu hiện h&agrave;nh được sử dụng. - Ph&acirc;n quyền, ph&acirc;n cấp tớitừng chức năng của chương tr&igrave;nh.','Sử dụng Công nghệ Dotnet: ngôn ngữlập trình C#, Net FrameWork 2.0 - RDBMS: MS SQL Server 2000 trở lên','',3,'Đang làm','2015-09-04','2015-10-11','Quản lý cơ sở dữ liệu tập trung - Thiết kế theo mô hình khách– chủ, dữ liệu sẽ được xử lý nhanh hơn'),('6','2134','Phần mềm quản lý hóa đơn','Thiết kế c&aacute;c chức năng t&iacute;nh tiền, thống k&ecirc; doanh thu theo h&oacute;a đơn','Sử dụng ng&ocirc;n ngữ lập tr&igrave;nh Java hoặc C#','',2,'Đang làm','2014-01-01','2015-10-07',''),('7','2134','Game pikachu trên Androi','','','',3,'Đang làm','0000-00-00','2015-10-07',''),('8','2134','Website quản lý của hàng bán máy tính và các thiết bị máy vi tính, laptop.','Quản l&yacute; c&aacute;c h&oacute;a đơn, h&agrave;ng h&oacute;a trong cửa h&agrave;ng.','D&ugrave;ng những c&ocirc;ng nghệ, ng&ocirc;n ngữ lập tr&igrave;nh phổ biến hiện nay v&agrave; c&aacute;c framework.','',3,'Chưa làm','2015-09-04','2015-10-23','C&oacute; thể l&agrave;m bằng c&aacute;c ng&ocirc;n ngữ lập tr&igrave;nh PHP.'),('9','2134','Phần mềm hỗ trợ thiết kế bài giảng cho tiểu học','Tạo c&aacute;c chức năng để hỗ trợ gi&aacute;o vi&ecirc;n tiểu học thiết kế b&agrave;i giảng thật đẹp mắt v&agrave; sinh động. Cần c&aacute;c c&ocirc;ng cụ đồ họa. Cần c&aacute;c chức năng hỗ trợ tạo c&aacute;c hiệu ứng đẹp mắt','Java v&agrave; Framework SpringMVC','',4,'Chưa làm','2015-09-04','0000-00-00','');
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
  `nguoitao` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `giang_vien` VALUES ('1234','Pham Tâm An','Nữ','2015-09-30','an@gmail.com',2147483647,'','$2y$10$iAEVUzNHsLK4lPpg5MHaluv3Wjp4n7s6vMKo3MdcMhNKFwzSs0duG','','2015-09-28',0,0),('2134','Cao Thanh Tao','Nam','2015-07-21','tao@cit.ctu.edu.vn',923456789,'Tao2134.png','$2y$10$TktUn3GqSN0IycOaaiuko.apcrGjkQ9sMJJEhq4tzmwuHjEL3Vp7u','','2015-09-28',0,0),('2345','Đỗ Hồng Phúc','Nam','2015-09-01','thanh@gmail.com',2147483647,'','$2y$10$Fc4Mm8vtYlbmUzYGiETaNO.OHIBC0xdwe0gNUkZIiGrtCxE7Te6bC','','2015-11-06',0,0),('3718','Đào Mai','Nữ','2015-09-01','mai@gmail.com',876543221,'','e10adc3949ba59abbe56e057f20f883e','','2015-09-28',0,0),('4718','Vũ Văn Tạo','Nam','2015-08-24','moitao@gmail.com',2147483647,'','$2y$10$67ZTamWYGTSIbp4PakrmGOQ83NEkIxrRgrnJpeY/QUkOBtNm3Cnhu','','2015-11-06',0,0),('5431','Phạm Ngọc Thạch','Nữ','2015-09-01','thach@cit.ctu.edu.vn',987654323,'',NULL,'','2015-09-28',1,0),('9876','Mai Tú Cầu','Nam','2015-09-09','cau@gmail.com',2147483647,'Cau9876.png','$2y$10$fAlqsWTgenFAkx4J7zqLE.Pi87aSmW0jVlT8yDuHbkZ/ouZ.Z43y6','','2015-09-28',0,1),('9877','Lê Hồng Hà','Nữ','2015-09-01','hongha@gmail.com',2147483647,'','$2y$10$BiSUt7qvvfp./0vYxHml3.GHjkKfNIOGc6Nea7VwGZ7a9GVDu.Uva','','2015-09-28',0,NULL),('9878','Ly An Nhiên','Nữ','2015-11-01','nhien@gmail.com',2147483647,'','$2y$10$njB7ZJkOvS6jgyzo123jqeD9NH3YyNOTt98WlvgBQaTXA.7fvsXtG','Mai Tú Cầu','2015-11-02',0,NULL);
/*!40000 ALTER TABLE `giang_vien` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `nhan_thong_bao`
--

DROP TABLE IF EXISTS `nhan_thong_bao`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `nhan_thong_bao` (
  `manhomthuchien` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `matb` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`matb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `nhan_thong_bao`
--

LOCK TABLES `nhan_thong_bao` WRITE;
/*!40000 ALTER TABLE `nhan_thong_bao` DISABLE KEYS */;
INSERT INTO `nhan_thong_bao` VALUES ('Tất cả','TB01'),('NTH01','TB02'),('Tất cả','TB03'),('NTH02','TB04');
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
  `sotuan_kehoach` int(11) NOT NULL,
  `ngaybatdau_thucte` datetime DEFAULT NULL,
  `ngayketthuc_thucte` datetime DEFAULT NULL,
  `sotuan_thucte` int(11) DEFAULT NULL,
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
INSERT INTO `nhom_thuc_hien` VALUES ('NTH01','S2','Tổ chức ma trận (các nhóm bộ phận có chuyên môn sâu, các nhóm bộ phận tham gia bán thời gian vào dự án khác, người quản lý dự án chịu trách nhiệm cho sự thành công của toàn bộ dụe án và nâng cao kiến thức chuyên môn)','2015-09-01','2015-12-01',18,NULL,NULL,17,20,NULL,NULL,NULL,NULL,'0000-00-00'),('NTH02','S2, S7, C3','Nh&oacute;m lập tr&igrave;nh vi&ecirc;n ch&iacute;nh (Nh&oacute;m trưởng-thiết kế v&agrave; c&agrave;i đặt phần ch&iacute;nh của hệ thống, trợ l&yacute;-gi&uacute;p việc nh&oacute;m trưởng, người quản l&yacute; t&agrave;i liệu) ','2015-09-01','2015-12-01',18,'2015-09-01 00:00:00','2016-02-29 00:00:00',1,10,NULL,'Đang nghi&ecirc;n cứu phạm vi đề t&agrave;i','<p>\r\n	PHP v&agrave; Framework của php</p>\r\n',NULL,'0000-00-00'),('NTH03','s6','Nhóm lập trình nhanh(làm việc theo cặp trên một máy tính đơn-người chính, người phụ đổi vai trò)',NULL,NULL,18,NULL,NULL,18,5,NULL,NULL,NULL,NULL,'0000-00-00'),('NTH04','C4','',NULL,NULL,18,NULL,NULL,7,0,NULL,NULL,NULL,NULL,'0000-00-00'),('NTH05',NULL,'','2015-11-01','2016-02-29',10,NULL,NULL,NULL,0,NULL,NULL,NULL,NULL,'2015-11-04');
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
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  KEY `password_resets_email_index` (`email`),
  KEY `password_resets_token_index` (`token`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
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
  KEY `fk_quy_dinh2` (`matc`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `quy_dinh`
--

LOCK TABLES `quy_dinh` WRITE;
/*!40000 ALTER TABLE `quy_dinh` DISABLE KEYS */;
INSERT INTO `quy_dinh` VALUES ('3718','1'),('3718','2'),('3718','3'),('2134','4'),('2134','5'),('2134','6'),('2134','7');
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
INSERT INTO `ra_de_tai` VALUES ('1','NTH03',''),('11','NTH05',''),('3','NTH02',''),('6','NTH01',''),('7','NTH04','');
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
  `nguoitao` varchar(60) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `sinh_vien` VALUES ('1111222','Hoàng Hậu','Nữ','1992-08-04',66,'hau@gmail.com',NULL,'',NULL,NULL,NULL,'$2y$10$RtMI2BO.Dx.K6H8qPkBOkOx8sr4HNWqvAKzL0eXGAkCrRuMaULwSW','','2015-11-02',0),('1111223','Cindy Candy','Nữ','1992-08-04',36,'candy@gmail.com',NULL,'',NULL,NULL,NULL,'$2y$10$rpMoBtOFTpQmoAhC18L7suYFtsV3EUw6RR7rfMVhffMmRb9dBF4dS','','2015-11-02',0),('1111224','Chưa Biết','Nam','2015-08-04',40,'biet@gmail.com',NULL,'',NULL,NULL,NULL,'$2y$10$W7ZbjERhf0Tj/3cRZurzQud9K1V.xf1YN0UYCwVDkW88HMkiPfKLy','','2015-11-02',0),('1111225','Lý Văn Thông','Nữ','2015-08-03',22,'thong@student.ctu.edu.vn',0,'',NULL,NULL,NULL,'$2y$10$WfhU8aQc1o6B2TZzZo4ZLOmc3yTYYHpOwisx7xKwaJHJCX7yI6F1O','','2015-11-04',0),('1111226','Hoa Phát Tài','Nữ','2015-09-21',21,'phattai@gmail.com',0,'',NULL,NULL,NULL,'$2y$10$3oRq9/9s7TBypdSYdifKcezwkbOznEp834.939FcKE74UcY7d5Eju','','2015-11-02',0),('1111227','Hoa Mộc Lan','Nữ','2015-09-30',22,'moclan111227@gmail.com',NULL,'',NULL,NULL,NULL,'$2y$10$oyk.EURD521MmEaI1XakD.Np4yPBr1Qp6tS1kHdBWXH7gonilERCi','','2015-11-02',0),('1111271','Lê Giang Anh','Nam','1993-03-11',37,'anh111271@student.ctu.edu.vn',0,'',NULL,NULL,NULL,NULL,'','2015-09-28',0),('1111306','Nguyễn Hoàng Long','Nữ','1993-08-18',37,'long111206@student.ctu.edu.vn',54645635,'','Mô hình MVC                                                                                                                                        ',' Đã học C/C++, Java, PHP                                                                                                                                        ',' Chưa được thực hiện 1 phần mềm nào                                                                                                                        ','e10adc3949ba59abbe56e057f20f883e','','2015-09-28',0),('1111308','Võ Thành Luân','Nam','1993-09-22',37,'luan111308@student.ctu.edu.vn',0,'','	',NULL,NULL,NULL,'','2015-09-28',0),('1111317','Nguyễn Thiên Lý','Nữ','1993-06-03',36,'ly111317@student.ctu.edu.vn',123456789,'Ly1111317.png',' - Thiết kế CSDL, Thiết kế và phát triển phần mềm, phân tích số liệu. \r\n- Sử dụng phần mềm kiểm thử.                                                                                                                                                                      ','- Biết về ngôn ngữ lập trình C/C++, Lập trình java, ngôn ngữ lập trình php.                                                                                                                          ',' - Đã từng làm phần mềm quản lý hóa đơn bằng ngôn ngữ lập trình java.                                                                                                                             ','$2y$10$ln29wP86JQ4ekGUBEcIUzeABLkjd/IfPW/nB94OAEBgS.OQpzqiMO','','2015-09-28',0),('1111324','Đoàn Ái Ngọc','Nữ','1992-02-01',37,'ngoc111324@student.ctu.edu.vn',0,'',NULL,NULL,NULL,'$2y$10$C84Ic5oA8JCBeqYxSWEyLumgGWtcsSOujZC8hxdUW9UWhZPiJruxC','','2015-09-28',0),('1111333','Mật Mã','Nam','1992-11-01',36,'ma@gmail.com',NULL,'',NULL,NULL,NULL,'$2y$10$efuGbXmtcoWsEfklcFmCVOBBMxrXnIj/PJftdmLR0Gz1DyZX/yIKe','','2015-11-02',1),('1111342','Lê Trương Quốc Thắng','Nam','1993-03-18',37,'thang111342@student.ctu.edu.vn',0,'','	\r\n',NULL,NULL,NULL,'','2015-09-28',0),('1111359','Nguyễn Châu Thiên Tú','Nam','1992-08-21',37,'tu111359@student.ctu.edu.vn',0,'','',NULL,NULL,NULL,'','2015-09-28',0),('1111366','Ngô Hải Vân','Nam','1993-08-10',37,'van111366@student.ctu.edu.vn',0,'','\r\n',NULL,NULL,'$2y$10$izY4FUNh/NIDAstM455cy.MdRVL8WGFzLspIn7K7M.tHNoyzBIRH6','','2015-11-02',0),('1111432','Lâm Thành Đồng','Nam','2015-09-01',36,'dong@gmail.com',0,'Dong1111432.jpg','','','','d41d8cd98f00b204e980','','2015-09-28',0),('1113456','Cẩm Tú cầu','Nữ','1995-12-01',39,'cau113456@gmail.com',NULL,'','','','','e10adc3949ba59abbe56','','2015-09-28',0),('1211234','La Trịnh Nhân Ái','Nữ','2015-07-01',38,'ai233234@student.ctu.edu.vn',0,'','','','','$2y$10$6u5i9vT8vbsiRLT.5v7PfefVcBNYp/ZGix/JzTS8nJoGHRNG1s3Vy','','2015-11-02',0);
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
  `mssv` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `tentl` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `kichthuoc` float NOT NULL,
  `mota` text COLLATE utf8_unicode_ci,
  `ngaycapnhat` datetime DEFAULT NULL,
  `dieuchinh` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`matl`,`macv`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tai_lieu`
--

LOCK TABLES `tai_lieu` WRITE;
/*!40000 ALTER TABLE `tai_lieu` DISABLE KEYS */;
INSERT INTO `tai_lieu` VALUES ('TL01','CV1','1111317','DacTa.doc',62,'cdsấ','2015-09-13 09:32:28',''),('TL02','CV2','1111317','DacTaSoBo.docx',62,'','2015-09-13 09:33:53',''),('TL03','CV1.1','1111317','CTU_Slide.ppt',275.5,'đá','2015-09-13 09:37:14',''),('TL04','CV1.2','1111317','03-DSSV-TTTT-05-05-2015_Chinh thuc.pdf',558.996,'fsfsfsdf','2015-09-13 09:37:36',''),('TL05','2','1111317','Dacta_Thietke_Kiemthu.pdf',565.209,'dsfad','2015-09-13 09:38:06',''),('TL06','1','1111306','DacTaSoBo.docx',62,'đặc tả các yêu cầu chức năng và phi chức năng','2015-09-28 19:26:55','');
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
  `matb` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `noidungtb` text COLLATE utf8_unicode_ci,
  `dinhkemtb` text COLLATE utf8_unicode_ci NOT NULL,
  `batdautb` date DEFAULT NULL,
  `ketthuctb` date DEFAULT NULL,
  `donghethong` tinyint(1) DEFAULT NULL,
  `ngaytao` date NOT NULL,
  `ngaysua` date NOT NULL,
  PRIMARY KEY (`matb`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `thong_bao`
--

LOCK TABLES `thong_bao` WRITE;
/*!40000 ALTER TABLE `thong_bao` DISABLE KEYS */;
INSERT INTO `thong_bao` VALUES ('2134','TB01','Nộp Tài liệu đặc tả sơ bộ','','2015-11-01','2015-11-13',NULL,'2015-11-02','0000-00-00'),('2134','TB02','Chưa nộp tài liệu đặt tả sơ bộ','DacTaSoBo.docx','2015-09-13','2015-09-19',0,'2015-09-13','2015-09-13'),('2134','TB03','Nộp tài liệu thiết kế','','2015-09-01','2015-09-08',0,'2015-09-13','2015-11-02'),('2134','TB04','Xem lại sơ đồ và giao diện thiết kế','Dacta_Thietke_Kiemthu.pdf','2015-09-01','2015-09-22',1,'2015-09-13','2015-10-11');
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
  `tuan` varchar(11) COLLATE utf8_unicode_ci NOT NULL DEFAULT '0',
  `tuan_lamlai` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
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
INSERT INTO `thuc_hien` VALUES ('NTH01','1','1-2','5'),('NTH01','1.1','1-2',''),('NTH01','1.2','1-2',''),('NTH01','1.3','1-2',''),('NTH01','1.4','5','5'),('NTH01','2','3-4',''),('NTH01','2.1','3-4',''),('NTH01','2.2','3-4',''),('NTH01','2.3','3-4',''),('NTH01','2.4','3-4',''),('NTH01','3','4-8',''),('NTH01','4','9-10',''),('NTH01','4.1','9-10',''),('NTH01','4.2','9-10',''),('NTH01','5','11',''),('NTH01','5.1','11',''),('NTH01','6','12-13',''),('NTH01','6.1','12-13',''),('NTH01','CV6','13-17',''),('NTH02','CV1','0',''),('NTH02','CV1.1','0',''),('NTH02','CV1.2','0',''),('NTH02','CV1.3','1',''),('NTH02','CV2','0',''),('NTH02','CV3','0',''),('NTH02','CV3.1','0',''),('NTH02','CV3.2','0',''),('NTH02','CV3.3','0',''),('NTH02','CV3.4','0',''),('NTH02','CV4','0',''),('NTH02','CV4.1','0',''),('NTH02','CV4.2','0',''),('NTH02','CV5','0',''),('NTH02','CV5.1','0',''),('NTH05','CV7','1',''),('NTH05','CV7.1','1','');
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
INSERT INTO `tieu_chi_danh_gia` VALUES ('1','Tính sáng tạo',1,'2014-06-30'),('2','Phần mềm dự án',5,'2014-06-30'),('3','Tài liệu dự án',4,'2014-06-30'),('4','Kỹ năng làm việc nhóm',1,'2015-09-24'),('5','Đánh giá về sự hoàn thành của dự án',2,'2015-09-24'),('6','Tài liệu báo cáo',3,'2015-09-24'),('7','demo',4,'2015-10-28');
/*!40000 ALTER TABLE `tieu_chi_danh_gia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `taikhoan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `quyen` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'9877','Lê Hồng Hà','hongha@gmail.com','$2y$10$teG5phunIfFnK92h58ge0ew3xrk..WIvY2sAf.dyLBOjCHYRyTfqa','gv','5yghaKqsaanJ7Fsvmhfm2xCElDOWIvwWbZbEN1HbBmCIkS5CzjeJh2vdMH3E','2015-09-28 13:04:12','2015-09-28 12:27:12'),(2,'21325','Hoa Mộc Lan','moclan@gmail.com','$2y$10$PxtT5y9bf465E7G7H1ZmJOwjTEkKjVWHxseiM2kNdPHegCC1u32aS','sv','sHtfjSD14IQPQOGfC8p1HCMnaXeotI6hsPy4BBJU','2015-09-28 13:08:28','2015-09-28 13:08:28'),(3,'1234','Pham Tâm An','an@gmail.com','$2y$10$b4urMZIXhd/hyFAMZJgdQe7bQPX8IlL9akA4cCY1aJyRnhkjbQn4i','gv','S50kflyCK8IkyIQN2XsJvB3kuNLkq2lhGaIEa3HUBgfD0onA7bj6SDB999iX','2015-09-28 13:03:22','2015-11-04 08:02:49'),(4,'2134','Cao Thanh Tao','tao@cit.ctu.edu.vn','$2y$10$TktUn3GqSN0IycOaaiuko.apcrGjkQ9sMJJEhq4tzmwuHjEL3Vp7u','gv','4kmMnp3HaK7cMRxljhwVTfZzpZt1WFTbsw4cTb8zUpFczdSIYOGRkASC85X9','2015-09-28 13:03:43','2015-11-04 07:40:59'),(5,'2345','Đỗ Hồng Phúc','thanh@gmail.com','$2y$10$L9s2PjIThUwPLiZ2T2yqZ.A06rvvBtaS1Q5hY/qXm0bB9RxAcOCYm','gv','FHYma7WwamzYgomZznqSdZl56muQrJv10slEzcV0','2015-09-28 13:04:24','2015-11-06 06:03:34'),(6,'3718','Đào Mai','mai@gmail.com','$2y$10$fNcoDh5tUJkUBiJ4WnlVOei9sa1S3fjZ8DGzEKGWu4gm92GXgHK/G','gv','sHtfjSD14IQPQOGfC8p1HCMnaXeotI6hsPy4BBJU','2015-09-28 13:04:49','2015-09-28 13:04:49'),(7,'4718','Vũ Văn Tạo','moitao@gmail.com','$2y$10$16vsGjymIPwxOylO8qPURu.VXvwYS7xEqqFmfXqtO4ffH0laXAPIu','gv','FHYma7WwamzYgomZznqSdZl56muQrJv10slEzcV0','2015-09-28 13:04:58','2015-11-06 06:03:54'),(8,'5431','Phạm Ngọc Thạch','thach@cit.ctu.edu.vn','$2y$10$B4FTy5QkBftOTKSg0f96RusDz6qv3x8GH/iQYsCSbheOcrTUM0UHe','gv','6fqOwLrXDRUenfhzNsJjLqWdykB8C3IPzFKAJYcAEYl7Es3XyB25mOh8XHTb','2015-09-28 13:05:19','2015-09-28 12:58:20'),(9,'9876','Mai Tú Cầu','cau@gmail.com','$2y$10$fAlqsWTgenFAkx4J7zqLE.Pi87aSmW0jVlT8yDuHbkZ/ouZ.Z43y6','qt','HmPDQvDFTxyhyGljrUI33RDw2I23k0xR4R7SJjISlR9KTLSCf8vtFft7tq5Y','2015-09-28 13:05:32','2015-11-04 08:02:18'),(10,'1113456','Cẩm Tú cầu','cau113456@gmail.com','$2y$10$abAb/2CbovetHi96PO3preCjpz4nnGsygqWwhi0Q4E1uAaXSKj8uy','sv','sHtfjSD14IQPQOGfC8p1HCMnaXeotI6hsPy4BBJU','2015-09-28 13:21:17','2015-09-28 13:21:17'),(11,'1111432','Lâm Thành Đồng','dong@gmail.com','$2y$10$GohLvUGCtwl6FEQYmnGyveA3Fntzw.tL613rxBloQu36EhNqzrFBa','sv','sHtfjSD14IQPQOGfC8p1HCMnaXeotI6hsPy4BBJU','2015-09-28 13:22:20','2015-09-28 13:22:20'),(12,'1111342','Lê Trương Quốc Thắng','thang111342@student.ctu.edu.vn','$2y$10$EKSt5cZIYgt10DMB175lr.vrDS7XQ4i/UCOTAY/P7axnod5oLPzAG','sv','zbPGkBrEuN8oDqK7iRky1veSIdaIvsLp06o5hu3zjQ27ZjRZyURsdfG5X1Vy','2015-09-28 12:22:38','2015-09-28 13:10:37'),(14,'1111324','Đoàn Ái Ngọc','ngoc111324@student.ctu.edu.vn','$2y$10$C84Ic5oA8JCBeqYxSWEyLumgGWtcsSOujZC8hxdUW9UWhZPiJruxC','sv','jvL2DH47Y2YUGs7rNqpOdjXrgwJCjpsViHmidg21vED4Nd2x0zewY8m6XnxI','2015-09-28 13:09:49','2015-09-28 13:08:56'),(15,'1111308','Võ Thành Luân','luan111308@student.ctu.edu.vn','$2y$10$H/dtSeJA7mWWXcIQAy59v.ndWiBaS3uxeGwSVENNAkG1PmztnuvIG','sv','sHtfjSD14IQPQOGfC8p1HCMnaXeotI6hsPy4BBJU','2015-09-28 13:09:59','2015-09-28 13:09:59'),(16,'1111317','Nguyễn Thiên Lý','ly111317@student.ctu.edu.vn','$2y$10$ln29wP86JQ4ekGUBEcIUzeABLkjd/IfPW/nB94OAEBgS.OQpzqiMO','sv','JBmAlOJNuhK3Vw0fvhTS2qvBzT3nXVEZ5MrKjEL4xOxtj85jfNhkp1sbpK9C','2015-09-28 13:11:24','2015-10-11 00:46:16'),(17,'1111359','Nguyễn Châu Thiên Tú','tu111359@student.ctu.edu.vn','$2y$10$ghTv2TKxA24D6uPmtiD0teOtQLhBcEf7Sgz0d7XDsNEwotRxFO9L6','sv','KNn47z9LcKuPTju3GqwBVEqe2VInaPvxAczDnl309HEtXC795dQyl9hNZ74p','2015-09-28 13:15:22','2015-10-11 01:05:05'),(20,'1111271','Lê Giang Anh','anh111271@student.ctu.edu.vn','$2y$10$XjPsvI4OTNS91nbIo.O6Du7n.5lo5iSZHhO30/ioCip7DrRJbIjd.','sv','NnXHnRFRDlPscLj4yqqG1VoSrcbB1bSzWkkppBq8F7IZvUc0ve0Sijb0b72E','2015-09-28 13:21:53','2015-10-22 01:00:00'),(23,'1111306','Nguyễn Hoàng Long','long111206@student.ctu.edu.vn','$2y$10$02a2CybQPRsnOt/GZ2p1gu6jXmTbq6uM6fG12otCxGMdPP/8609ku','sv','pDFXLiWmKn8kxqUF85xgOhbk8cIRw2TGzro3dEalC98hWjyFq2NOT6sUTEiM','2015-09-28 12:23:12','2015-11-02 06:53:02'),(25,'1211234','La Trịnh Nhân Ái','ai233234@student.ctu.edu.vn','$2y$10$bKMY1Bx6tqUGN13GLGUbbeORsaZbqHIHGr9h9sfn/M2VdpSJ.oyiC','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:50:17'),(26,'1111366','Ngô Hải Vân','van111366@student.ctu.edu.vn','$2y$10$tRbs6Jci9IV8hAuptp3q6./iAPtGHlVnOzUzTH2787IRTCnSN9u0y','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:55:32'),(27,'1111224','Chưa Biết','biet@gmail.com','$2y$10$4b55MgHsol9FA5Wceb5uk.hwmkzXIdUI.Qxkg.GpLaEfkdutKRTW6','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:55:45'),(28,'1111333','Mật Mã','ma@gmail.com','$2y$10$KTXkbpeO2hZ/sZydzZfyeO0Pju8zA3wslkzVTwyBwXrDYa5iET4Ze','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:55:58'),(29,'1111223','Cindy Candy','candy@gmail.com','$2y$10$O3G3NTnmOiKToZ5aU1ozYePH1MY8PioGSqSVYcZfpLHuxexygKAAO','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:56:22'),(30,'1111222','Hoàng Hậu','hau@gmail.com','$2y$10$ciN7c8fOw6LT0ZZwm8NBH.Aonc/Y.lf.apkoieMZ8cOkjYdkyzmVK','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:56:49'),(31,'1111225','Lý Văn Thông','thong@student.ctu.edu.vn','$2y$10$detPuQGFwo.JlBVp/Ykauuv7VF4Z4mYLXqtemcJFCXlvC/zeo0Xk2','sv','Ca91kWYUjkGUWKGGMgOJJ4CMrjfUzr6Q3kWSsquUeCW2iVqnKd5IVa1WVDDK','0000-00-00 00:00:00','2015-11-04 08:14:13'),(36,'1111227','Hoa Mộc Lan','moclan111227@gmail.com','$2y$10$IywxgYwZDj44AATDl.teDe3VQxW1JsKYPgAUum7Z2ymEOBgimtOgG','sv','40xLUxFphKUrzMKBGvesmEIxwl6YbK5TCHCRgW5H','0000-00-00 00:00:00','2015-11-02 06:57:33'),(37,'1111226','Hoa Phát Tài','phattai@gmail.com','$2y$10$Ru/.ZDaFIWKoku0Ykukineyf4VbsEVQKrPHKYnBK3wKKfkFELmxQW','sv','RkZjSae87kAZF5fWINLJ8eZMik8OKLnWosHvfUEoWBIadyJpzvhLdk1OuDd2','0000-00-00 00:00:00','2015-11-04 08:14:37'),(38,'9878','Ly An Nhiên','nhien@gmail.com','$2y$10$8k0vOFByE/q8Yl.qyVdXp.Wkm8eQnf03H8M1.HW3KCHn0zEv0oyW2','gv','Jwm1UVFHcYosBk2fssiEuVIU9PZDfV9LeVOm231lK86YK70rxlN9xhrj3lqn','2015-11-02 06:32:15','2015-11-04 07:48:08');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-06 20:04:14

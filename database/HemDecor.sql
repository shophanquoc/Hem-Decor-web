
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Hẻm Decor`
--

DROP DATABASE IF EXISTS HemDecor;
CREATE DATABASE HemDecor;
USE HemDecor;




-- --------------------------------------------------------
--
-- Table structure for table `Account`
--
CREATE TABLE IF NOT EXISTS `Account`(
AccountID INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
AccName VARCHAR(30) NOT NULL,
AccPassword  VARCHAR(20) NOT NULL,
AccPhoneNo VARCHAR(10) NOT NULL UNIQUE KEY,
AccEmail VARCHAR(50) NOT NULL UNIQUE KEY
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Account`
--
INSERT INTO `Account`(AccName, AccPassword, AccPhoneNo, AccEmail) VALUES
("Ngọc Yến", 'Ngocyen*2102', '0963566858', 'ngocyen210201@gmail.com'),
("Hoài Thu", 'Hoaithu*2811', '0962370612', 'hoaithu281101@gmail.com'),
("Hiền Thanh", 'Hienthanh*1903', '0962156842', 'hienthanh190301@gmail.com'),
("lapnguyen", "lapnguyen", "1234123412", "lapvp01@gmail.com");

-- --------------------------------------------------------
--
-- Table structure for table `Admin`
--
CREATE TABLE IF NOT EXISTS `Categories`(
CategoryID VARCHAR(10) NOT NULL PRIMARY KEY,
CategoryName VARCHAR(200) NOT NULL,
ThumbnailImage VARCHAR(20) NOT NULL,
  AddPic1 VARCHAR(20),
  AddPic2 VARCHAR(20),
  AddPic3 VARCHAR(20),
  AddPic4 VARCHAR(20),
Material  VARCHAR(50),
`Description` VARCHAR(5000),
CreateDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP
)
ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Categories`
--
INSERT INTO `Categories` (CategoryID, CategoryName, ThumbnailImage, AddPic1, AddPic2, AddPic3, AddPic4, Material, `Description` ) VALUES
('K/C01','Khay Chữ Nhật', 'hem0-0001.jpg', 'hem1-0001.jpg', 'hem2-0001.jpg', 'hem3-0001.jpg', 'hem4-0001.jpg', 'Keo', 
'Khay gỗ rất thích hợp cho những buổi tiệc ngoài trời, buổi dã ngoại hay picnic vì không lo bị vỡ, lại nhẹ hơn đồ gốm. Bát salad gỗ keo thích hợp với các món như thịt nướng, salad, đồ nguội. Tránh các món đồ ăn quá nóng (sẽ dễ gây hiện tượng nứt nở gỗ). 
Bạn cũng có thể đựng hoa quả, các loại bánh, các loại hạt, đồ ăn nhẹ trên bàn. Cực kỳ thích hợp khi nhà có trẻ nhỏ vì rất an toàn cho bé.
- Màu sắc: Màu gỗ tự nhiên.
- Nguồn gốc: Việt Nam'),
('OC/C01','Khay Chữ Nhật', 'hem0-0002.jpg', 'hem1-0002.jpg', 'hem2-0002.jpg', 'hem3-0002.jpg', 'hem4-0002.jpg', 'Óc Chó', 
'Khay gỗ rất thích hợp cho những buổi tiệc ngoài trời, buổi dã ngoại hay picnic vì không lo bị vỡ, lại nhẹ hơn đồ gốm. Bát salad gỗ keo thích hợp với các món như thịt nướng, salad, đồ nguội. Tránh các món đồ ăn quá nóng (sẽ dễ gây hiện tượng nứt nở gỗ). 
Bạn cũng có thể đựng hoa quả, các loại bánh, các loại hạt, đồ ăn nhẹ trên bàn. Cực kỳ thích hợp khi nhà có trẻ nhỏ vì rất an toàn cho bé.
- Màu sắc: Màu gỗ tự nhiên.
- Nguồn gốc: Việt Nam'),
('TB/T01','Khay Tròn', 'hem0-0003.jpg', 'hem1-0003.jpg', 'hem2-0003.jpg', 'hem3-0003.jpg', 'hem4-0003.jpg', 'Tần Bì',
'Khay gỗ rất thích hợp cho những buổi tiệc ngoài trời, buổi dã ngoại hay picnic vì không lo bị vỡ, lại nhẹ hơn đồ gốm. Bát salad gỗ keo thích hợp với các món như thịt nướng, salad, đồ nguội. Tránh các món đồ ăn quá nóng (sẽ dễ gây hiện tượng nứt nở gỗ). 
Bạn cũng có thể đựng hoa quả, các loại bánh, các loại hạt, đồ ăn nhẹ trên bàn. Cực kỳ thích hợp khi nhà có trẻ nhỏ vì rất an toàn cho bé.
- Màu sắc: Màu gỗ tự nhiên.
- Nguồn gốc: Việt Nam'),
('K/T01','Khay Tròn', 'hem0-0004.jpg', 'hem1-0004.jpg', 'hem2-0004.jpg', 'hem3-0004.jpg', '', 'Keo', 
'Khay gỗ rất thích hợp cho những buổi tiệc ngoài trời, buổi dã ngoại hay picnic vì không lo bị vỡ, lại nhẹ hơn đồ gốm. Bát salad gỗ keo thích hợp với các món như thịt nướng, salad, đồ nguội. Tránh các món đồ ăn quá nóng (sẽ dễ gây hiện tượng nứt nở gỗ). 
Bạn cũng có thể đựng hoa quả, các loại bánh, các loại hạt, đồ ăn nhẹ trên bàn. Cực kỳ thích hợp khi nhà có trẻ nhỏ vì rất an toàn cho bé.
- Màu sắc: Màu gỗ tự nhiên.
- Nguồn gốc: Việt Nam'),
('OC/D02','Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn', 'hem0-0005.jpg', 'hem1-0005.jpg', 'hem2-0005.jpg', 'hem3-0005.jpg', '', 'Óc Chó', 
'Khay gỗ rất thích hợp cho những buổi tiệc ngoài trời, buổi dã ngoại hay picnic vì không lo bị vỡ, lại nhẹ hơn đồ gốm. Bát salad gỗ keo thích hợp với các món như thịt nướng, salad, đồ nguội. Tránh các món đồ ăn quá nóng (sẽ dễ gây hiện tượng nứt nở gỗ). 
Bạn cũng có thể đựng hoa quả, các loại bánh, các loại hạt, đồ ăn nhẹ trên bàn. Cực kỳ thích hợp khi nhà có trẻ nhỏ vì rất an toàn cho bé.
- Màu sắc: Màu gỗ tự nhiên.
- Nguồn gốc: Việt Nam'),
('OC/E06','Khay Ovan 2 Tay Cầm To', 'hem0-0006.jpg', 'hem1-0006.jpg', 'hem2-0006.jpg', 'hem3-0006.jpg', '', '', ''),
('TB/E02','Khay Ovan Bo 2 Đầu', 'hem0-0007.jpg', 'hem1-0007.jpg', 'hem2-0007.jpg', 'hem3-0007.jpg', '', 'Tần Bì', ''),
('TB/KL01','Khay Lá', 'hem0-0008.jpg', 'hem1-0008.jpg', 'hem2-0008.jpg', 'hem3-0008.jpg', 'hem4-0008.jpg', 'Tần Bì', ''),
('TB/D01','Khay Dài Có Tay Cầm', 'hem0-0009.jpg', 'hem1-0009.jpg', 'hem2-0009.jpg', 'hem3-0009.jpg', '', 'Tần Bì', ''),
('OC/D01','Khay Dài Có Tay Cầm', 'hem0-0010.jpg', 'hem1-0010.jpg', 'hem2-0010.jpg', 'hem3-0010.jpg', '', 'Óc Chó', ''),
('TB/TD05','Thớt Sẻ Rãnh Tay Cành Cây', 'hem0-0011.jpg', 'hem1-0011.jpg', 'hem2-0011.jpg', 'hem3-0011.jpg', '', 'Tần Bì', ''),
('TB/D02','Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn', 'hem0-0012.jpg', 'hem1-0012.jpg', 'hem2-0012.jpg', 'hem3-0012.jpg', '', 'Tần Bì', ''),
('K/T04','Thớt Tròn Tay Cầm Có Rãnh', 'hem0-0013.jpg', 'hem1-0013.jpg', 'hem2-0013.jpg', 'hem3-0013.jpg', '', 'Keo', ''),
('DG/LLT','Lót Ly Tròn', 'hem0-0014.jpg', 'hem1-0014.jpg', 'hem2-0014.jpg', '', '', 'Dẻ Gai', ''),
('TH01', 'Thìa Gỗ', 'hem0-0015.jpg', '', '', '', '', '', '');
-- --------------------------------------------------------
--
-- Table structure for table `Product`
--

CREATE TABLE IF NOT EXISTS Product(
CategoryID VARCHAR(10) NOT NULL,
ProductID VARCHAR(10) NOT NULL PRIMARY KEY,
ProductName VARCHAR(255) NOT NULL,
Size VARCHAR(10),
Price INT UNSIGNED NOT NULL,
ProductQuantity INT UNSIGNED NOT NULL,
CreateDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
FOREIGN KEY (CategoryID) REFERENCES Categories(CategoryID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;
--
-- Dumping data for table `Product`
--
INSERT INTO Product (CategoryID, ProductID, ProductName, Size, Price, ProductQuantity) VALUES
('K/C01','K/C01', 'Khay Chữ Nhật Gỗ Keo','15x20', 115000, 8),
('K/C01','K/C01-01', 'Khay Chữ Nhật Gỗ Keo','15x25', 120000, 5),
('K/C01','K/C01-02', 'Khay Chữ Nhật Gỗ Keo','13x30', 125000, 7),
('K/C01','K/C01-03', 'Khay Chữ Nhật Gỗ Keo','20x30', 135000, 5),
('K/C01','K/C01-04', 'Khay Chữ Nhật Gỗ Keo','25x35', 145000, 8),
('K/C01','K/C01-05', 'Khay Chữ Nhật Gỗ Keo','30x40', 120000, 6),
('OC/C01','OC/C01', 'Khay Chữ Nhật Gỗ Óc Chó','15x20', 180000, 2),
('OC/C01','OC/C01-01', 'Khay Chữ Nhật Gỗ Óc Chó','15x25', 220000, 18),
('OC/C01','OC/C01-02', 'Khay Chữ Nhật Gỗ Óc Chó','13x30', 260000, 5),
('OC/C01','OC/C01-03', 'Khay Chữ Nhật Gỗ Óc Chó','20x30', 280000, 6),
('OC/C01','OC/C01-04', 'Khay Chữ Nhật Gỗ Óc Chó','25x35', 295000, 5),
('TB/T01','TB/T01', 'Khay Tròn Gỗ Tần Bì', '20x20', 155000, 5),
('TB/T01','TB/T01-01', 'Khay Tròn Gỗ Tần Bì', '25x25', 180000, 11),
('K/T01','K/T01', 'Khay Tròn Gỗ Teak', '20x20', 140000, 4),
('K/T01','K/T01-01', 'Khay Tròn Gỗ Teak', '25x25', 155000, 7),
('K/T01','K/T01-02','Khay Tròn Gỗ Teak', '30x30', 170000, 9),
('OC/D02', 'OC/D02', 'Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn Gỗ Óc Chó', '16x26', 225000, 3),
('OC/D02', 'OC/D02-1', 'Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn Gỗ Óc Chó', '20x33', 295000, 5),
('OC/D02', 'OC/D02-2', 'Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn Gỗ Óc Chó', '13x45', 310000, 7),
('OC/D02', 'OC/D02-3', 'Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn Gỗ Óc Chó', '17x39', 295000, 9),
('OC/E06', 'OC/E06', 'Khay Ovan 2 Tay Cầm To', '18x32', 310000, 6),
('TB/E02', 'TB/E02', 'Khay Ovan Bo 2 Đầu Gỗ Tần Bì', '13x32', 135000, 0),
('TB/KL01', 'TB/KL01', 'Khay Lá Gỗ Tần Bì', '16x34', 210000, 8),
('TB/D01', 'TB/D01', 'Khay Dài Có Tay Cầm Gỗ Tần Bì', '15x40', 160000, 14),
('TB/D01', 'TB/D01-01', 'Khay Dài Có Tay Cầm Gỗ Tần Bì', '15x50', 185000, 13),
('TB/D01', 'TB/D01-02', 'Khay Dài Có Tay Cầm Gỗ Tần Bì', '20x50', 215000, 7),
('OC/D01', 'OC/D01', 'Khay Dài Có Tay Cầm Gỗ Óc Chó', '15x40', 250000, 5),
('OC/D01', 'OC/D01-01', 'Khay Dài Có Tay Cầm Gỗ Óc Chó', '15x50', 310000, 6),
('TB/TD05', 'TB/TD05', 'Thớt Sẻ Rãnh Tay Cành Cây Gỗ Tần Bì', '20x42', 240000, 9),
('TB/D02', 'TB/D02', 'Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn Gỗ Tần Bì', '16x26', 160000, 6),
('TB/D02', 'TB/D02-01','Thớt Chữ Nhật Có Tay Cầm Bo Góc Tròn Gỗ Tần Bì', '20x33', 185000, 5),
('K/T04', 'K/T04', 'Thớt Tròn Tay Cầm Có Rãnh Gỗ Keo', '25x35', 180000, 9),
('DG/LLT', 'DG/LLT', 'Lót Ly Tròn Gỗ Dẻ Gai', '9x9', 35000, 15),
('TH01', 'TH01', 'Thìa Gỗ', '', 45000, 10);
-- --------------------------------------------------------
--
-- Table structure for table `Order`
--
CREATE TABLE IF NOT EXISTS `Order` (
  OrderID VARCHAR(6) NOT NULL PRIMARY KEY,
  AccountID INT NOT NULL,
  OrderDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
  OrderStatus ENUM('Chờ Xác Nhận','Đang Chuẩn Bị Hàng','Đang Giao Hàng', 'Đã Hoàn Thành', 'Đã Hủy') NOT NULL,
  PaymentStatus ENUM('Đang Xử Lý', 'Đã Hoàn Thành')NOT NULL,
  
  TotalOrder DOUBLE DEFAULT '0',
  FOREIGN KEY (AccountID) REFERENCES `Account` (AccountID) ON UPDATE CASCADE ON DELETE CASCADE)
  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `Order`
--


INSERT INTO `Order` (`OrderID`,`AccountID`, `OrderStatus`, `PaymentStatus`,`TotalOrder`) VALUES
('ab01cd', 1,'Chờ Xác Nhận','Đã Hoàn Thành','790000'),
('ab02cd',1,'Đang Chuẩn Bị Hàng','Đang Xử Lý','735000'),
('ab03cd',2,'Đã Hoàn Thành','Đã Hoàn Thành','280000'),
('ab04cd',3,'Đang Giao Hàng','Đã Hoàn Thành','240000'),
('ab05cd',2,'Đang Giao Hàng','Đang Xử Lý','510000'),
('osh124', 3,'Chờ Xác Nhận','Đang Xử Lý','205000');

-- --------------------------------------------------------
--
-- Table structure for table `Order_Details`
--
CREATE TABLE IF NOT EXISTS `Order_Details` (
  OrderID VARCHAR(6) NOT NULL,
  CustomerName VARCHAR(30) NOT NULL,
  CustomerAddress VARCHAR(200) NOT NULL,
  CustomerPhoneNo VARCHAR(10) NOT NULL,
  PaymentMethod ENUM('COD','Banking'),
  Note VARCHAR (5000),
  FOREIGN KEY (OrderID) REFERENCES `Order` (OrderID) ON UPDATE CASCADE ON DELETE CASCADE)
  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `Order_Details`
--
INSERT INTO `Order_Details` (`OrderID`, `CustomerName`, `CustomerAddress`,`CustomerPhoneNo`,`PaymentMethod`) VALUES
('ab03cd','Lý Hoài Thu','Thanh Xuân, Hà Nội','0962370612','COD'),
('ab05cd','Lý Hoài Thu','Thanh Xuân, Hà Nội','0962370612','COD'),
('ab04cd','Dương Hiền Thanh','Hoàng Mai, Hà Nội','0962370612','Banking'),
('osh124','Dương Hiền Thanh','Hoàng Mai, Hà Nội','0962370612','COD'),
('ab01cd','Nguyễn Thị Ngọc Yến','Long Biên, Hà Nội','0963566858','Banking'),
('ab02cd','Lý Hoài Thu','Long Biên, Hà Nội','0963566858','COD');

-- --------------------------------------------------------
--
-- Table structure for table `Order_Product`
--
CREATE TABLE IF NOT EXISTS `Order_Product` (
  OrderID VARCHAR(6) NOT NULL,
  ProductID VARCHAR(10) NOT NULL,
  OrderQuantity TINYINT NOT NULL,
  QuantityPrice INT NOT NULL,
  FOREIGN KEY (OrderID) REFERENCES `Order` (OrderID) ON UPDATE CASCADE ON DELETE CASCADE,
  FOREIGN KEY (ProductID) REFERENCES `Product` (ProductID) ON UPDATE CASCADE ON DELETE CASCADE)
  ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4 ;

--
-- Dumping data for table `Order_Product`
--
INSERT INTO `Order_Product` (`OrderID`, `ProductID`, `OrderQuantity`, `QuantityPrice`) VALUES
('ab01cd','TH01','03', 135000),
('ab01cd','K/C01-02','05', 625000),
('ab02cd','K/C01','01', 115000),
('ab02cd','OC/D02-1','02', 590000),
('ab03cd','K/C01','01', 115000),
('ab03cd','TB/E02','01', 135000),
('ab04cd','TB/KL01','01', 210000),
('ab05cd','K/C01-05', '04', 480000),
('osh124','DG/LLT', '05', 175000);
-- --------------------------------------------------------
--
-- Table structure for table `Cart`
--
CREATE TABLE IF NOT EXISTS `Cart`(
CartID VARCHAR(10) NOT NULL PRIMARY KEY,
AccountID INT NOT NULL,
FOREIGN KEY (AccountID) REFERENCES `Account` (AccountID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Cart`
--
INSERT INTO `Cart` (`CartID`,`AccountID`) VALUES
('cart00001',1),
('cart00002',2),
('cart00003',3);

-- --------------------------------------------------------
--
-- Table structure for table `Product_Cart`
--
CREATE TABLE IF NOT EXISTS `Product_Cart`(
ProductID VARCHAR(10) NOT NULL,
CartID VARCHAR(10) NOT NULL,
Quantity INT,
AddedDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
FOREIGN KEY (ProductID) REFERENCES PRODUCT (ProductID) ON UPDATE CASCADE ON DELETE CASCADE,
FOREIGN KEY (CartID) REFERENCES CART (CartID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product_Cart`
--
INSERT INTO `Product_Cart` (`ProductID`,`CartID`,`Quantity`) VALUES
('K/T01-02','cart00001','1'),
('K/T01-01','cart00001','1'),
('OC/C01','cart00001','1'),
('TB/T01','cart00002','1');

CREATE TABLE IF NOT EXISTS `Anon_Cart`(
CartID VARCHAR(10) NOT NULL,
ProductID VARCHAR(10) NOT NULL,
Quantity INT,
AddedDate timestamp NOT NULL default CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP,
FOREIGN KEY (ProductID) REFERENCES PRODUCT (ProductID) ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Product_Cart`
--
INSERT INTO `Anon_Cart` (`CartID`,`ProductID`,`Quantity`) VALUES
('anon00001','K/T01-02','1'),
('anon00002','K/T01-01','2'),
('anon00003','OC/C01','3');

-- --------------------------------------------------------
--
-- Table structure for table `Admin`
--
CREATE TABLE IF NOT EXISTS `Admin`(
AdminID VARCHAR(6) NOT NULL PRIMARY KEY,
AdminName VARCHAR(30) NOT NULL,
AdminPassword  VARCHAR(20),
AdminLogInName VARCHAR(20) NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `Admin`
--
INSERT INTO `Admin` VALUES
('ADM01', 'Hẻm Decor', 'HemDecor*1234', 'HemDecor');

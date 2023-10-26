-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 26, 2023 at 08:48 AM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlyoneearth`
--

-- --------------------------------------------------------

--
-- Table structure for table `carts`
--

CREATE TABLE `carts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `prod_qty` int(11) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`) VALUES
(1, 'กระเป๋า', '2023-09-13 16:42:44'),
(5, 'ของขวัญ', '2023-09-13 16:42:44'),
(6, 'เสียงและเทคโนโลยี', '2023-09-13 16:42:44'),
(7, 'อุปกรณ์ความงามและการดูแล', '2023-09-13 16:42:44'),
(8, 'ผลิตภัณฑ์สําหรับเด็กและทารก', '2023-09-13 16:42:44'),
(10, 'บ้าน ผลิตภัณฑ์และอุปกรณ์ใช้', '2023-09-13 16:42:44'),
(11, 'อุปกรณ์และผลิตภัณฑ์สัตว์เลี้ยง', '2023-09-13 16:42:44'),
(12, 'กีฬาและกิจกรรมกลางแจ้ง', '2023-09-13 16:42:44'),
(15, 'อุปกรณ์การเดินทาง', '2023-09-19 17:54:25'),
(16, 'เครื่องครัวไรอะ', '2023-09-26 15:58:01'),
(18, 'ผลิตภัณฑ์การเดินทางเพื่อความยั่งยืน', '2023-10-10 17:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `category_logs`
--

CREATE TABLE `category_logs` (
  `cat_logs_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `cat_id` int(11) DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `category_logs`
--

INSERT INTO `category_logs` (`cat_logs_id`, `user_id`, `cat_id`, `event`, `created_at`) VALUES
(76, 2, NULL, 'ลบหมวดหมู่', '2023-08-18 14:08:59'),
(77, 2, 61, 'เพิ่มหมวดหมู่:two', '2023-08-18 14:09:22'),
(78, 2, 62, 'เพิ่มหมวดหมู่:พลาสติกฟางข้าวสาลี', '2023-08-19 14:32:15'),
(79, 2, 63, 'เพิ่มหมวดหมู่:ไม้คอร์ก (Cork) หรือ ไม้ก๊อก', '2023-08-19 14:32:25'),
(80, 2, NULL, 'เพิ่มหมวดหมู่:สินค้าวัสดุรีไซเคิล อื่น ๆ', '2023-08-19 14:32:32'),
(81, 2, 1, 'เพิ่มหมวดหมู่:กระเป๋า', '2023-08-19 14:35:26'),
(82, 2, 2, 'เพิ่มหมวดหมู่:พลาสติกฟางข้าวสาลี', '2023-08-19 14:35:52'),
(83, 2, 3, 'เพิ่มหมวดหมู่:ไม้คอร์ก (Cork) หรือ ไม้ก๊อก', '2023-08-19 14:36:00'),
(84, 2, 4, 'เพิ่มหมวดหมู่:ผลิตจากไม้ไผ่', '2023-08-19 14:37:05'),
(85, 2, 5, 'เพิ่มหมวดหมู่:ของขวัญ', '2023-08-19 14:42:09'),
(86, 2, 6, 'เพิ่มหมวดหมู่:เสียงและเทคโนโลยี', '2023-08-19 14:42:48'),
(87, 2, 7, 'เพิ่มหมวดหมู่:อุปกรณ์ความงามและการดูแล', '2023-08-19 14:43:10'),
(88, 2, 8, 'เพิ่มหมวดหมู่:ผลิตภัณฑ์สําหรับเด็กและทารก', '2023-08-19 14:43:29'),
(89, 2, 9, 'เพิ่มหมวดหมู่:เสื้อผ้า รองเท้า และอุปกรณ์เสริม', '2023-08-19 14:43:46'),
(90, 2, 10, 'เพิ่มหมวดหมู่:บ้าน ผลิตภัณฑ์ & อุปกรณ์ใช้', '2023-08-19 14:43:59'),
(91, 2, 11, 'เพิ่มหมวดหมู่:อุปกรณ์และผลิตภัณฑ์สัตว์เลี้ยง', '2023-08-19 14:44:18'),
(92, 2, 12, 'เพิ่มหมวดหมู่:กีฬาและกิจกรรมกลางแจ้ง', '2023-08-19 14:44:30'),
(93, 2, NULL, 'เพิ่มหมวดหมู่:อุปกรณ์การเดินทาง', '2023-08-19 14:44:42'),
(94, 2, NULL, 'เพิ่มหมวดหมู่:อื่นๆ', '2023-08-19 14:45:06'),
(95, 2, 10, 'อัปเดตชื่อหมวดหมู่:บ้าน ผลิตภัณฑ์และอุปกรณ์ใช้', '2023-08-19 16:06:31'),
(96, 2, NULL, 'ลบหมวดหมู่', '2023-09-13 16:59:31'),
(97, 2, NULL, 'ลบหมวดหมู่', '2023-09-13 17:49:55'),
(98, 2, 15, 'เพิ่มหมวดหมู่:สัตว์เลี้ยง', '2023-09-19 17:54:25'),
(99, 2, 16, 'เพิ่มหมวดหมู่:เครื่องครัว', '2023-09-26 15:58:01'),
(100, 2, 16, 'อัปเดตชื่อหมวดหมู่:เครื่องครัวไรอะ', '2023-10-02 14:40:48'),
(101, 2, 17, 'เพิ่มหมวดหมู่:ทดสอบ', '2023-10-02 14:41:15'),
(102, 2, 2, 'ลบหมวดหมู่', '2023-10-10 16:04:37'),
(103, 2, 4, 'ลบหมวดหมู่', '2023-10-10 16:04:40'),
(104, 2, 3, 'ลบหมวดหมู่', '2023-10-10 16:04:44'),
(105, 2, 9, 'ลบหมวดหมู่', '2023-10-10 17:03:23'),
(106, 2, 15, 'อัปเดตชื่อหมวดหมู่:อุปกรณ์การเดินทาง', '2023-10-10 17:26:56'),
(107, 2, 18, 'เพิ่มหมวดหมู่:ผลิตภัณฑ์การเดินทางเพื่อความยั่งยืน', '2023-10-10 17:32:12');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `sellerId` int(11) DEFAULT NULL,
  `tracking_no` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `address` mediumtext NOT NULL,
  `pincode` varchar(255) NOT NULL,
  `total_price` double NOT NULL,
  `payment_mode` varchar(255) NOT NULL,
  `payment_id` varchar(255) DEFAULT NULL,
  `comment` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `sellerId`, `tracking_no`, `name`, `email`, `phone`, `address`, `pincode`, `total_price`, `payment_mode`, `payment_id`, `comment`, `status`, `created_at`) VALUES
(5, 40, 2, 'Somtuy796142130133', 'two', '2@g2.com', '0642130133', '1', '10200', 540, 'COD', '', '', 1, '2023-09-16 08:08:14'),
(6, 40, 10, 'Somtuy562042130133', 'two', '2@g2.com', '0642130133', '1', '10170', 1080, 'COD', '', '', 0, '2023-09-16 08:19:10'),
(7, 40, 2, 'Somtuy327442130133', 'two', '2@g2.com', '0642130133', '1', '10170', 1080, 'COD', '', '', 0, '2023-09-16 08:19:10'),
(8, 40, 2, 'Somtuy784842130133', 'เจฟ', 'jaffry159@gmail.com', '0642130133', 'อัษฎาวุธ แปลกลำยอง  หอพักในเชียงยืน มมส 65/20  ต.ขามเรียง อ.กันทรวิชัย ห้อง111  จ. มหาสารคาม 44150 0642130133', '10150', 900, 'COD', '', '', 0, '2023-09-25 08:49:59'),
(9, 40, 2, 'Somtuy136542130133', 'qqqqq', 'jaffry8426@gmail.com', '0642130133', 'qwweqweqweqw', '10310', 1200, 'จ่ายโดย PayPal', '8DU85309YL8360423', '', 1, '2023-09-26 14:02:12'),
(12, 40, 2, 'Somtuy211642130133', 'qqqqq', 'jaffry8426@gmail.com', '0642130133', 'qwweqweqweqw', '10120', 1200, 'COD', '', '', 0, '2023-09-30 03:54:37'),
(13, 40, 2, 'Somtuy885142130133', 'admin', 'admin@gmail.com', '0642130133', '1', '10600', 1200, 'COD', '', 'แพ็คดีๆ', 0, '2023-10-04 06:54:05'),
(14, 40, 49, 'Somtuy171842130133', 'อัษฎาวุธ แปลกลำยอง', 'jaffry159@gmail.com', '0642130133', 'ฟอเรสเพลสขามเรียง เลขที่ 235 หมู่.15\r\nขามเรียง', '10150', 280, 'COD', '', 'ขอเพิ่มอีก', 0, '2023-10-04 06:58:29'),
(15, 40, 49, 'Somtuy303842130133', 'autsadawut plaglamyong', 'jaffry159@gmail.com', '0642130133', 'อัษฎาวุธ แปลกลำยอง  หอพักในเชียงยืน มมส 65/20  ต.ขามเรียง อ.กันทรวิชัย ห้อง111  จ. มหาสารคาม 44150 0642130133', '10150', 280, 'จ่ายโดย PayPal', '17S53918GH9762044', '', 0, '2023-10-18 10:06:14'),
(16, 40, 2, 'Somtuy737042130133', 'อัษฎาวุธ แปลกลำยอง', 'jaffry159@gmail.com', '0642130133', 'ฟอเรสเพลสขามเรียง เลขที่ 235 หมู่.15\nขามเรียง', '10600', 555, 'จ่ายโดย PayPal', '9DJ45832YY6781055', 'ทดสอบคอมเม้นเพย์พาว', 0, '2023-10-18 10:12:50'),
(17, NULL, 49, 'Somtuy753691278840', 'jaffrybanrai', 'kiattisakjanjam@gmail.com', '0891278840', '85/71 ถ.พญาดำดิน ต.นางรอง อ.นางรอง จ.บุรีรัมย์ 31110\r\n', '10170', 280, 'COD', '', 'ขอสวยๆนะครับ', 0, '2023-10-22 06:13:24'),
(18, 40, 55, 'Somtuy826942130166', 'autsadawut plaglamyong', 'jaffry159@gmail.com', '0642130166', 'อัษฎาวุธ แปลกลำยอง  หอพักในเชียงยืน มมส 65/20  ต.ขามเรียง อ.กันทรวิชัย ห้อง111  จ. มหาสารคาม 44150 0642130133', '10310', 500, 'COD', '', 'ขอสวยๆครับ ', 1, '2023-10-24 14:23:30'),
(19, 40, 2, 'Somtuy541742130166', 'autsadawut plaglamyong', 'jaffry159@gmail.com', '0642130166', 'ฟอเรสเพลสขามเรียง เลขที่ 235 หมู่.15\nขามเรียง', '10170', 1110, 'จ่ายโดย PayPal', '68C85012G42263106', 'ขอสวยๆนะครับ', 1, '2023-10-25 02:16:20'),
(20, 40, 49, 'Somtuy786242130155', 'autsadawut plaglamyong', 'jaffry159@gmail.com', '0642130155', 'อัษฎาวุธ แปลกลำยอง  หอพักในเชียงยืน มมส 65/20  ต.ขามเรียง อ.กันทรวิชัย ห้อง111  จ. มหาสารคาม 44150 0642130133', '10310', 840, 'COD', '', 'ทดสอบถอนเงินอิอิ', 1, '2023-10-25 02:31:05'),
(21, 40, 49, 'Somtuy133642130155', 'autsadawut plaglamyong', 'jaffry159@gmail.com', '0642130155', 'อัษฎาวุธ แปลกลำยอง (c113) หอพัก อัครฉัตร เรสซิเดนซ์ 543\r\nอัษฎาวุธ แปลกลำยอง (c113) หอพัก อัครฉัตร เรสซิเดนซ์ 543', '10170', 560, 'COD', '', 'อิอิอิอิอิอิ', 1, '2023-10-26 06:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `orders_logs`
--

CREATE TABLE `orders_logs` (
  `or_logs_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `ord_id` int(11) DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `orders_logs`
--

INSERT INTO `orders_logs` (`or_logs_id`, `u_id`, `ord_id`, `event`, `created_at`) VALUES
(5, 2, 5, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-09-16 15:09:12'),
(6, 49, 11, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-09-29 14:40:16'),
(7, 2, 9, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-23 22:56:33'),
(8, NULL, 18, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-24 21:23:57'),
(9, 2, 19, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-25 09:17:45'),
(10, 49, 20, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-25 09:31:28'),
(11, 49, 20, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-25 09:32:04'),
(12, 49, 20, 'อัปเดตออเดอร์: อยู่ระหว่างดำเนินการ', '2023-10-25 09:33:44'),
(13, 49, 20, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-25 09:33:54'),
(14, 49, 21, 'อัปเดตออเดอร์: ดำเนินการแล้ว', '2023-10-26 13:45:12');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `prod_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `qty` int(11) NOT NULL,
  `price` double NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `prod_id`, `user_id`, `qty`, `price`, `created_at`) VALUES
(5, 5, NULL, 2, 1, 540, '2023-09-16 08:08:14'),
(6, 6, NULL, NULL, 2, 540, '2023-09-16 08:19:10'),
(7, 7, NULL, 2, 2, 540, '2023-09-16 08:19:10'),
(8, 8, NULL, 2, 1, 900, '2023-09-25 08:49:59'),
(9, 9, 47, 2, 1, 1200, '2023-09-26 14:02:12'),
(10, 10, 59, 49, 1, 280, '2023-09-27 07:37:33'),
(11, 11, 59, 49, 4, 280, '2023-09-29 07:39:44'),
(12, 12, 47, 2, 1, 1200, '2023-09-30 03:54:37'),
(13, 13, 47, 2, 1, 1200, '2023-10-04 06:54:05'),
(14, 14, 59, 49, 1, 280, '2023-10-04 06:58:29'),
(15, 15, 59, 49, 1, 280, '2023-10-18 10:06:14'),
(16, 16, 48, 2, 1, 555, '2023-10-18 10:12:50'),
(17, 17, 59, 49, 1, 280, '2023-10-22 06:13:24'),
(18, 18, NULL, NULL, 1, 500, '2023-10-24 14:23:30'),
(19, 19, 48, 2, 2, 555, '2023-10-25 02:16:20'),
(20, 20, 59, 49, 3, 280, '2023-10-25 02:31:05'),
(21, 21, 59, 49, 2, 280, '2023-10-26 06:44:52');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `users_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `price` double NOT NULL,
  `num` int(11) NOT NULL,
  `trending` tinyint(4) NOT NULL COMMENT '0 = no 1= yes',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `users_id`, `name`, `detail`, `price`, `num`, `trending`, `created_at`) VALUES
(47, 1, 2, 'MINI RUBBER BAG (LIME GREEN)', '• พกพาสะดวก สำหรับไว้พกของสัมภาระเล็กๆ เช่น โทรศัพท์มือถือ กระเป๋าสตางค์ เครื่องสำอาง ฯลฯ \r\n• มีแม่เหล็กป้องกันสัมภาระร่วงหล่น แถม\r\n• กันน้ำ ล้างทำความสะอาดได้ง่าย \r\n• ผลิตจากวัสดุยางรีไซเคิล', 1200, 0, 1, '2023-09-19 17:11:17'),
(48, 1, 2, 'RUBBER BAG PASTEL EDITION (PINK)', '• สีชมพูพาสเทล Light Pink\r\n• ขนาดถุงประมาณ 30x37 ซม.\r\n• ความยาวของสายสะพาย 25 ซม.\r\n• ความหนาประมาณ 1 มม.\r\n• น้ำหนักถุงประมาณ 300 ก.\r\n• รับน้ำหนักของได้ 10 กก.', 555, 7, 0, '2023-09-19 17:13:58'),
(49, 1, 2, 'RUBBER BAG PASTEL EDITION (YELLOW)', '• สีชมพูพาสเทล Light Pink\r\n• ขนาดถุงประมาณ 30x37 ซม.\r\n• ความยาวของสายสะพาย 25 ซม.\r\n• ความหนาประมาณ 1 มม.\r\n• น้ำหนักถุงประมาณ 300 ก.\r\n• รับน้ำหนักของได้ 10 กก.', 545, 10, 0, '2023-09-19 17:31:49'),
(53, 1, 2, 'RUBBER BAG NATURAL RECYCLE COLOR', '• ขนาดถุงประมาณ 30x37 ซม.\r\n• ความยาวของสายสะพาย 25 ซม.\r\n• ความหนาประมาณ 1 มม.\r\n• น้ำหนักถุงประมาณ 300 ก.\r\n• รับน้ำหนักของได้ 10 กก.', 495, 5, 1, '2023-09-19 17:49:31'),
(59, 16, 49, 'Silicone Lunchbox (1section)', 'กล่องข้าวซิลิโคน Food grade ปราศจากสาร BPA ซิลิโคนหนาคงตัว ใช้งานง่าย ไม่หก ไม่รั่ว พร้อมช้อนส้อมในตัว  \r\n• ขนาด 10 x 16 x 6 cm (บรรจุ 750 ml) พับแล้วสูง 3 cm\r\n• เข้าไมโครเวฟได้\r\n• ทนอุณหภูมิ- 20 ถึง 120 องศาเซลเซียส\r\n• มีจุกระบายอากาศเวลาเข้าไมโครเวฟ', 280, 0, 0, '2023-09-27 14:37:00'),
(60, 5, 2, 'Finger Paint ', '* สีธรรมชาติ\r\n* สัมผัสที่นุ่มนวล\r\n* ใช้กับนิ้วมือหรือแปรงทาสี\r\n* 4 ภาชนะบรรจุเม็ดสีสีสนุก', 700, 5, 0, '2023-10-10 16:27:49'),
(64, 6, 2, 'NIMBLE WALLY Wall Charger', '* กําลังขับสูงสุด 65W\r\n* รองรับการชาร์จอย่างรวดเร็วของ Apple และ Samsung, Qualcomm Quick Charge และ USB-C     Power Delivery สําหรับการชาร์จความเร็วสูงไปยังอุปกรณ์ USB-C แทบทุกชนิด\r\n* สามารถชาร์จ MacBook ที่ 65w หรือแยกการชาร์จข้ามพอร์ตสําหรับการชาร์จเร็ว', 1800, 5, 0, '2023-10-10 16:39:54'),
(69, 7, 2, 'Zero Waste Pure Silk Dental Floss', '* ด้ายไหมบริสุทธิ์เคลือบด้วยขี้ผึ้งแคนเดลิลลาเรียบ\r\n* ไม่ปรุงแต่งรส\r\n* รีฟิลประกอบด้วยไหมขัดฟัน 2 เส้น\r\n* 33 yrds ต่อหลอด', 360, 5, 0, '2023-10-10 16:53:10'),
(70, 8, 2, 'Submarine', '* ปลอดสาร BPA\r\n* สินค้าที่ไม่ได้ใช้ไม่เสียหายและในบรรจุภัณฑ์เดิมสามารถส่งคืนได้ภายใน 30 วันนับจากวันที่ซื้อ\r\n* 4.88 นิ้ว x 3.86 นิ้ว x 2.36 นิ้ว', 700, 5, 0, '2023-10-10 17:02:31'),
(71, 10, 2, 'ZipTuck ถุงขนมขบเคี้ยวแบบใช้ซ้ําได้ - 2 แพ็ค', '* ถุงเก็บอาหารปลอดสาร BPA แบบใช้ซ้ําได้ 2 แพ็ค\r\n* การออกแบบที่ป้องกันการรั่วซึมและสุญญากาศ\r\n* เก็บแบนเพื่อการจัดเก็บง่ายเครื่องล้างจานและตู้แช่แข็งที่ปลอดภัย\r\n* ความจุ 1.5 ถ้วยต่อถ้วย\r\n* รวมกระเป๋าขนาด 7 x 4.6 นิ้ว จํานวน <> ใบ', 250, 5, 0, '2023-10-10 17:07:49'),
(72, 11, 2, 'TUGZ TOY ( PASTEL GREEN )', '* ของเล่นที่จะมาปลดปล่อยให้สุนัขสุดที่รักของคุณ \r\n* มีความสุขกับการเล่นแบบไร้ขีดจำกัด ทนทานต่อการกัด เคี้ยว คาบ งับ แทะ \r\n* ผลิตจากยางรีไซเคิลที่มีความแข็งแรงเป็นพิเศษ \r\n* ยางที่นำมาใช้ทำของเล่นปราศจากสารเคมี ไม่เป็นอันตรายต่อสัตว์เลี้ยง \r\n* มีทั้งหมด 3 ส', 400, 5, 0, '2023-10-10 17:09:54'),
(73, 12, 2, 'Stainless Steel Camping Plate', '* ปราศจากพลาสติก 100%, ถาดตั้งแคมป์สแตนเลสไม่แตกหัก\r\n* 3  ส่วนสําหรับของว่างที่แตกต่างกัน\r\n* สมบูรณ์แบบสําหรับขยะเป็นศูนย์ในระหว่างการเดินทาง\r\n* น้ำาหนักภาชนะ 8 oz\r\n* ช่องเล็ก: 2.4 oz. / 1/3 cup\r\n* ช่องกลาง: 4.8 oz. / 2/3 cup\r\n* ช่องขนาดใหญ่: 12 oz. / 1.5', 550, 5, 0, '2023-10-10 17:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `products_logs`
--

CREATE TABLE `products_logs` (
  `p_logs_id` int(11) NOT NULL,
  `u_id` int(11) DEFAULT NULL,
  `p_id` int(11) DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products_logs`
--

INSERT INTO `products_logs` (`p_logs_id`, `u_id`, `p_id`, `event`, `created_at`) VALUES
(250, 49, 59, 'เพิ่มสินค้าใหม่: Silicone Lunchbox (1section)', '2023-09-27 14:37:00'),
(251, 49, 59, 'แก้ไขสินค้า', '2023-09-29 14:29:58'),
(252, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:31:21'),
(253, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:02'),
(254, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:17'),
(255, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:26'),
(256, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:29'),
(257, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:39'),
(258, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:43'),
(259, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:33:50'),
(260, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:12'),
(261, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:21'),
(262, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:25'),
(263, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:36'),
(264, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:44'),
(265, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:51'),
(266, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:34:56'),
(267, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:35:01'),
(268, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:35:07'),
(269, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:35:13'),
(270, 2, 59, 'แก้ไขสินค้า', '2023-09-29 14:36:19'),
(271, 49, 59, 'แก้ไขสินค้า', '2023-09-29 14:37:26'),
(272, 2, NULL, 'แก้ไขสินค้า', '2023-09-30 10:57:56'),
(273, 2, 53, 'แก้ไขสินค้า', '2023-10-02 13:47:23'),
(274, 2, 53, 'แก้ไขสินค้า', '2023-10-02 13:51:41'),
(275, 2, 53, 'แก้ไขสินค้า', '2023-10-02 13:52:38'),
(276, 2, 53, 'แก้ไขสินค้า', '2023-10-02 13:52:48'),
(277, 2, 53, 'แก้ไขสินค้า', '2023-10-02 13:52:55'),
(278, 2, 53, 'แก้ไขสินค้า', '2023-10-02 13:59:05'),
(279, 2, NULL, 'แก้ไขสินค้า', '2023-10-02 14:42:38'),
(280, 2, NULL, 'ลบสินค้า:ทดสอบ', '2023-10-02 14:43:36'),
(281, 2, 47, 'แก้ไขสินค้า', '2023-10-04 18:37:30'),
(282, 2, 47, 'แก้ไขสินค้า', '2023-10-04 18:43:10'),
(283, 2, NULL, 'ลบสินค้า:testttttttttttttttttttttttttttttttttttttttt', '2023-10-10 16:00:21'),
(284, 2, NULL, 'ลบสินค้า:SPIKY LAPTOP COOLER', '2023-10-10 16:11:03'),
(285, 2, NULL, 'ลบสินค้า:TEA4TWO ชุดรองถ้วยชา ลาย TERRAZZO', '2023-10-10 16:11:06'),
(286, 2, 60, 'เพิ่มสินค้าใหม่: Finger Paint ', '2023-10-10 16:27:49'),
(287, 2, 64, 'เพิ่มสินค้าใหม่: NIMBLE WALLY Wall Charger', '2023-10-10 16:39:54'),
(288, 2, 69, 'เพิ่มสินค้าใหม่: Zero Waste Pure Silk Dental Floss', '2023-10-10 16:53:10'),
(289, 2, 70, 'เพิ่มสินค้าใหม่: Submarine', '2023-10-10 17:02:31'),
(290, 2, 71, 'เพิ่มสินค้าใหม่: ZipTuck ถุงขนมขบเคี้ยวแบบใช้ซ้ําได้ - 2 แพ็ค', '2023-10-10 17:07:49'),
(291, 2, 72, 'เพิ่มสินค้าใหม่: TUGZ TOY ( PASTEL GREEN )', '2023-10-10 17:09:54'),
(292, 2, 73, 'เพิ่มสินค้าใหม่: Stainless Steel Camping Plate', '2023-10-10 17:18:17'),
(293, 2, NULL, 'ลบสินค้า:TUGZ TOY ( PASTEL GREEN )', '2023-10-10 17:27:33'),
(294, 2, 47, 'แก้ไขสินค้า', '2023-10-16 16:28:51'),
(295, 2, 53, 'แก้ไขสินค้า', '2023-10-16 16:30:05'),
(296, 2, 47, 'แก้ไขสินค้า', '2023-10-22 13:54:08'),
(297, NULL, NULL, 'เพิ่มสินค้าใหม่: ทดสอบสินค้าครับ', '2023-10-24 20:47:56'),
(298, 2, NULL, 'ลบสินค้า:ทดสอบสินค้าครับ', '2023-10-24 21:27:58'),
(299, 49, 59, 'แก้ไขสินค้า', '2023-10-25 09:25:30'),
(300, 49, 59, 'แก้ไขสินค้า', '2023-10-25 09:27:18');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` int(11) NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `image_filename` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_filename`, `created_at`) VALUES
(215, 47, '1696419790_0.jpg', '2023-09-19 17:11:17'),
(216, 47, '1696419790_1.jpg', '2023-09-19 17:11:17'),
(217, 47, '1696419790_2.jpg', '2023-09-19 17:11:17'),
(218, 47, '1696419790_3.jpg', '2023-09-19 17:11:17'),
(219, 47, '1696419790_4.jpg', '2023-09-19 17:11:17'),
(220, 48, '1695119826_0.jpg', '2023-09-19 17:13:58'),
(221, 48, '1695119826_1.jpg', '2023-09-19 17:13:58'),
(222, 48, '1695119826_2.jpg', '2023-09-19 17:13:58'),
(223, 48, '1695119826_3.jpg', '2023-09-19 17:13:58'),
(224, 48, '1695119826_4.jpg', '2023-09-19 17:13:58'),
(225, 49, '1695119509_0.jpg', '2023-09-19 17:31:49'),
(226, 49, '1695119509_1.jpg', '2023-09-19 17:31:49'),
(227, 49, '1695119509_2.jpg', '2023-09-19 17:31:49'),
(228, 49, '1695119509_3.jpg', '2023-09-19 17:31:49'),
(229, 49, '1695119509_4.jpg', '2023-09-19 17:31:49'),
(241, 53, '1695120571_0.jpg', '2023-09-19 17:49:31'),
(242, 53, '1695120571_1.jpg', '2023-09-19 17:49:31'),
(243, 53, '1695120571_2.jpg', '2023-09-19 17:49:31'),
(264, 59, '1695800220_0.png', '2023-09-27 14:37:00'),
(265, 59, '1695800220_1.png', '2023-09-27 14:37:00'),
(266, 59, '1695800220_2.png', '2023-09-27 14:37:00'),
(267, 60, '1696930069_0.jpg', '2023-10-10 16:27:49'),
(268, 60, '1696930069_1.jpg', '2023-10-10 16:27:49'),
(269, 60, '1696930069_2.jpg', '2023-10-10 16:27:49'),
(270, 60, '1696930069_3.jpg', '2023-10-10 16:27:49'),
(271, 64, '1696930794_0.jpg', '2023-10-10 16:39:54'),
(272, 64, '1696930794_1.jpg', '2023-10-10 16:39:54'),
(273, 64, '1696930794_2.jpg', '2023-10-10 16:39:54'),
(274, 64, '1696930794_3.jpg', '2023-10-10 16:39:54'),
(275, 64, '1696930794_4.jpg', '2023-10-10 16:39:54'),
(276, 64, '1696930794_5.jpg', '2023-10-10 16:39:54'),
(277, 64, '1696930794_6.jpg', '2023-10-10 16:39:54'),
(278, 69, '1696931590_0.jpg', '2023-10-10 16:53:10'),
(279, 69, '1696931590_1.jpg', '2023-10-10 16:53:10'),
(280, 69, '1696931590_2.jpg', '2023-10-10 16:53:10'),
(281, 69, '1696931590_3.jpg', '2023-10-10 16:53:10'),
(282, 69, '1696931590_4.jpg', '2023-10-10 16:53:10'),
(283, 70, '1696932151_0.jpg', '2023-10-10 17:02:31'),
(284, 70, '1696932151_1.jpg', '2023-10-10 17:02:31'),
(285, 70, '1696932151_2.jpg', '2023-10-10 17:02:31'),
(286, 70, '1696932151_3.jpg', '2023-10-10 17:02:31'),
(287, 70, '1696932151_4.jpg', '2023-10-10 17:02:31'),
(288, 71, '1696932469_0.jpg', '2023-10-10 17:07:49'),
(289, 71, '1696932469_1.jpg', '2023-10-10 17:07:49'),
(290, 71, '1696932469_2.jpg', '2023-10-10 17:07:49'),
(291, 71, '1696932469_3.jpg', '2023-10-10 17:07:49'),
(292, 71, '1696932469_4.jpg', '2023-10-10 17:07:49'),
(293, 72, '1696932594_0.jpg', '2023-10-10 17:09:54'),
(294, 72, '1696932594_1.jpg', '2023-10-10 17:09:54'),
(295, 72, '1696932594_2.jpg', '2023-10-10 17:09:54'),
(296, 72, '1696932594_3.jpg', '2023-10-10 17:09:54'),
(297, 73, '1696933097_0.jpg', '2023-10-10 17:18:17'),
(298, 73, '1696933097_1.jpg', '2023-10-10 17:18:17'),
(299, 73, '1696933097_2.jpg', '2023-10-10 17:18:17'),
(300, 73, '1696933097_3.jpg', '2023-10-10 17:18:17'),
(301, 73, '1696933097_4.jpg', '2023-10-10 17:18:17'),
(302, 73, '1696933097_5.jpg', '2023-10-10 17:18:17'),
(303, 73, '1696933097_6.jpg', '2023-10-10 17:18:17');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `subject` varchar(50) NOT NULL,
  `details` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `google_id` varchar(150) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verify_token` varchar(255) NOT NULL,
  `verify_status` tinyint(2) NOT NULL DEFAULT 0 COMMENT '	0=no 1=yes',
  `role_as` tinyint(4) NOT NULL DEFAULT 0 COMMENT '0=user\r\n1=admin\r\n2=seller',
  `img` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `google_id`, `name`, `email`, `phone`, `password`, `verify_token`, `verify_status`, `role_as`, `img`, `created_at`) VALUES
(2, '', 'admin', 'admin@gmail.com', '1150', '1', '', 0, 1, '1694782249.jpg', '2023-07-19 15:37:14'),
(40, '', 'starloadjaf', 'jaffry159@gmail.com', '0642130133', '1', '', 0, 0, '1695806827.jpg', '2023-08-26 06:40:25'),
(49, '', 'sellerJaf', 'jaffry8426@gmail.com', '0842516155', '1', '750ac9345e2238e359278b613a00f8c7', 1, 2, '1697954784.jpg', '2023-09-26 14:10:32'),
(57, '109419178408449820945', 'อัษฎาวุธ แปลกลํายอง', '63011211056@msu.ac.th', '', '', '', 0, 0, 'https://lh3.googleusercontent.com/a/ACg8ocKr8g3fWejxsHux6IUSOaKEXAUKkYqTvvss6PMY6pIRHQo=s96-c', '2023-10-24 14:39:38');

-- --------------------------------------------------------

--
-- Table structure for table `users_logs`
--

CREATE TABLE `users_logs` (
  `u_logs_id` int(11) NOT NULL,
  `a_id` int(11) DEFAULT NULL,
  `u_id` int(11) DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users_logs`
--

INSERT INTO `users_logs` (`u_logs_id`, `a_id`, `u_id`, `event`, `created_at`) VALUES
(1, 2, 40, 'แก้ไขผู้ใช้', '2023-08-31 17:46:51'),
(2, 2, 40, 'แก้ไขผู้ใช้: Jaffrykikik', '2023-08-31 17:53:05'),
(3, 2, 43, 'ลบผู้ใช้: ', '2023-08-31 17:57:02'),
(4, 2, 40, 'แก้ไขผู้ใช้: Jaffrybanjaf', '2023-09-08 15:02:23'),
(5, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:38:32'),
(6, 2, 49, 'แก้ไขผู้ใช้: sellerJaf', '2023-09-27 15:39:40'),
(7, 2, 49, 'แก้ไขผู้ใช้: sellerJaf', '2023-09-27 15:39:56'),
(8, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:42:09'),
(9, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:44:07'),
(10, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:50:25'),
(11, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:52:14'),
(12, 2, 40, 'แก้ไขผู้ใช้: starloadjaf', '2023-09-27 15:53:41'),
(13, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:54:59'),
(14, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:55:37'),
(15, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:56:17'),
(16, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:56:50'),
(17, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 15:59:56'),
(18, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 16:03:16'),
(19, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 16:03:38'),
(20, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 16:10:05'),
(21, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 16:11:24'),
(22, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 16:12:38'),
(23, 2, 40, 'แก้ไขผู้ใช้: starload', '2023-09-27 16:14:49'),
(24, 2, 40, 'แก้ไขผู้ใช้: starloadjaf', '2023-09-27 16:18:06'),
(25, 2, 40, 'แก้ไขผู้ใช้: starloadeiei', '2023-09-27 16:23:30'),
(26, 2, 40, 'แก้ไขผู้ใช้: starloadjaf', '2023-09-27 16:23:37'),
(27, 2, 40, 'แก้ไขผู้ใช้: starloadjaf', '2023-09-27 16:24:32'),
(28, 2, 40, 'แก้ไขผู้ใช้: starloadjafaa', '2023-09-27 16:24:38'),
(29, 2, 40, 'แก้ไขผู้ใช้: starloadjafaa', '2023-09-27 16:26:55'),
(30, 2, 40, 'แก้ไขผู้ใช้: starloadeiei', '2023-09-27 16:27:02'),
(31, 2, 40, 'แก้ไขผู้ใช้: starloadeiei', '2023-09-27 16:27:07'),
(32, 2, 40, 'แก้ไขผู้ใช้: starloadeiei', '2023-10-02 14:39:35');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawals`
--

CREATE TABLE `withdrawals` (
  `id` int(11) NOT NULL,
  `seller_id` int(11) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `numbank` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `namebank` varchar(255) NOT NULL,
  `numdraw` decimal(10,2) NOT NULL,
  `status` tinyint(4) NOT NULL COMMENT '0 = รอการยืนยัน \r\n1 = ยืนยันแล้ว ',
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `withdrawals`
--

INSERT INTO `withdrawals` (`id`, `seller_id`, `email`, `numbank`, `name`, `namebank`, `numdraw`, `status`, `created_at`) VALUES
(17, 49, 'jaffry159@gmail.com', '4320048114', 'autsadawut plaglamyong', 'autsadawut plaglamyong', '500.00', 1, '2023-10-25 09:47:36'),
(18, 49, 'jaffry159@gmail.com', '4320048114', 'autsadawut plaglamyong', 'autsadawut plaglamyong', '200.00', 0, '2023-10-26 13:45:50');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw_logs`
--

CREATE TABLE `withdraw_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `wd_id` int(11) DEFAULT NULL,
  `event` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `withdraw_logs`
--

INSERT INTO `withdraw_logs` (`id`, `user_id`, `wd_id`, `event`, `created_at`) VALUES
(4, 2, NULL, 'ได้ทำการยืนยันการถอนเงิน', '2023-10-02 09:56:34'),
(5, 2, 9, 'ได้ทำการยืนยันการถอนเงิน', '2023-10-03 09:47:19'),
(6, 2, 17, 'ได้ทำการยืนยันการถอนเงิน', '2023-10-25 04:48:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carts`
--
ALTER TABLE `carts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_user_cart` (`user_id`),
  ADD KEY `FK_product_id_cart` (`prod_id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category_logs`
--
ALTER TABLE `category_logs`
  ADD PRIMARY KEY (`cat_logs_id`),
  ADD KEY `FK_cat_id_category` (`cat_id`),
  ADD KEY `FK_user_id_user` (`user_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_user` (`user_id`);

--
-- Indexes for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD PRIMARY KEY (`or_logs_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `ord_id` (`ord_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_ord_id_order` (`order_id`),
  ADD KEY `FK_proid_product` (`prod_id`),
  ADD KEY `FK_user_id_users` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_id_users` (`users_id`),
  ADD KEY `FK_product_category` (`category_id`);

--
-- Indexes for table `products_logs`
--
ALTER TABLE `products_logs`
  ADD PRIMARY KEY (`p_logs_id`),
  ADD KEY `u_id` (`u_id`),
  ADD KEY `FK_product_id_products` (`p_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_ibfk_1` (`product_id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `google_id` (`google_id`);

--
-- Indexes for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD PRIMARY KEY (`u_logs_id`),
  ADD KEY `FK_admin_id_user` (`a_id`);

--
-- Indexes for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `seller_id` (`seller_id`);

--
-- Indexes for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `wd_id` (`wd_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carts`
--
ALTER TABLE `carts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `category_logs`
--
ALTER TABLE `category_logs`
  MODIFY `cat_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=108;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `orders_logs`
--
ALTER TABLE `orders_logs`
  MODIFY `or_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `products_logs`
--
ALTER TABLE `products_logs`
  MODIFY `p_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=301;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=308;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `users_logs`
--
ALTER TABLE `users_logs`
  MODIFY `u_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `withdrawals`
--
ALTER TABLE `withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `carts`
--
ALTER TABLE `carts`
  ADD CONSTRAINT `FK_product_id_cart` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_user_cart` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `category_logs`
--
ALTER TABLE `category_logs`
  ADD CONSTRAINT `FK_user_id_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `FK_id_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `orders_logs`
--
ALTER TABLE `orders_logs`
  ADD CONSTRAINT `orders_logs_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `orders_logs_ibfk_2` FOREIGN KEY (`ord_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `FK_ord_id_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_proid_product` FOREIGN KEY (`prod_id`) REFERENCES `products` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_user_id_users` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `FK_id_users` FOREIGN KEY (`users_id`) REFERENCES `users` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_product_category` FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `products_logs`
--
ALTER TABLE `products_logs`
  ADD CONSTRAINT `FK_product_id_products` FOREIGN KEY (`p_id`) REFERENCES `products` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `products_logs_ibfk_1` FOREIGN KEY (`u_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `reports`
--
ALTER TABLE `reports`
  ADD CONSTRAINT `reports_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `users_logs`
--
ALTER TABLE `users_logs`
  ADD CONSTRAINT `FK_admin_id_user` FOREIGN KEY (`a_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `withdrawals`
--
ALTER TABLE `withdrawals`
  ADD CONSTRAINT `withdrawals_ibfk_1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `withdraw_logs`
--
ALTER TABLE `withdraw_logs`
  ADD CONSTRAINT `withdraw_logs_ibfk_1` FOREIGN KEY (`wd_id`) REFERENCES `withdrawals` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `withdraw_logs_ibfk_2` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

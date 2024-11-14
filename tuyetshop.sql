-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2024 at 12:28 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tuyetshop`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin_note`
--

CREATE TABLE `tbladmin_note` (
  `ID` int(9) NOT NULL,
  `code_module` varchar(20) NOT NULL,
  `node_id` int(9) NOT NULL,
  `content` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbanner`
--

CREATE TABLE `tblbanner` (
  `ID` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `cateid` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` varchar(20) NOT NULL,
  `width` int(4) NOT NULL,
  `height` int(4) NOT NULL,
  `target` varchar(7) NOT NULL DEFAULT '_blank',
  `type` varchar(10) NOT NULL DEFAULT '''images''',
  `script` longtext NOT NULL,
  `url` varchar(255) NOT NULL,
  `expired_date` int(20) NOT NULL DEFAULT 0,
  `started_date` int(20) NOT NULL DEFAULT 0,
  `t_index` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblbanner_group`
--

CREATE TABLE `tblbanner_group` (
  `ID` int(10) NOT NULL,
  `title` varchar(100) NOT NULL,
  `position` varchar(20) NOT NULL,
  `width` int(4) NOT NULL,
  `height` int(4) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `static` int(1) NOT NULL DEFAULT 1,
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblbanner_group`
--

INSERT INTO `tblbanner_group` (`ID`, `title`, `position`, `width`, `height`, `t_status`, `static`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Header - Banner Slider', 'header', 1920, 864, 1, 1, 0, 0, 0, 0),
(2, 'Footer Banner', 'footer', 1920, 600, 1, 1, 0, 0, 0, 0),
(3, 'Popup Banner', 'popup', 800, 600, 1, 2, 0, 0, 0, 0),
(4, 'Banner góc phải màn hình', 'popup_right', 300, 300, 1, 2, 0, 0, 0, 0),
(5, 'Banner cột bên phải', 'right', 300, 300, 1, 1, 0, 0, 0, 0),
(6, 'Banner cột bên trái', 'left', 300, 300, 1, 1, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblbranch`
--

CREATE TABLE `tblbranch` (
  `ID` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `website` varchar(255) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `pinterest` varchar(255) NOT NULL,
  `embedgooglemap` text NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'vn',
  `t_index` int(9) NOT NULL,
  `created_by` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblbranch`
--

INSERT INTO `tblbranch` (`ID`, `t_status`, `name`, `address`, `phone`, `email`, `website`, `facebook`, `twitter`, `youtube`, `instagram`, `linkedin`, `pinterest`, `embedgooglemap`, `lang`, `t_index`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(1, 1, 'Tổng công ty ABC', '159 Điện Biên Phủ, P. 15, Q. Bình Thạnh', '0808080808', 'abc@gmail.com', 'abc.com', 'facebook', 'twitter', 'youtube', 'instagram', 'linkedin', 'pinterest', 'caw', 'vn', 1, 1, 1711967304, 1711967304, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblbrand`
--

CREATE TABLE `tblbrand` (
  `ID` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `urlseo` varchar(255) NOT NULL,
  `imgURL` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `t_index` int(9) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'vn',
  `created_by` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblbrand`
--

INSERT INTO `tblbrand` (`ID`, `t_status`, `title`, `urlseo`, `imgURL`, `intro`, `t_index`, `lang`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(1, 1, 'Laura Sunrise', '', '', '', 1, 'vn', 1, 1714643737, 1714643737, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(9) NOT NULL,
  `code` varchar(20) NOT NULL,
  `code_module` varchar(20) NOT NULL,
  `title` varchar(255) NOT NULL,
  `title_search` varchar(255) NOT NULL,
  `urlseo` varchar(255) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 2,
  `position` int(9) NOT NULL DEFAULT 1,
  `left` int(4) NOT NULL,
  `right` int(4) NOT NULL,
  `level` int(2) NOT NULL,
  `parent_id` int(9) NOT NULL,
  `intro` text NOT NULL,
  `description` longtext NOT NULL,
  `imgURL` text NOT NULL,
  `menu` varchar(255) NOT NULL,
  `url` text NOT NULL,
  `lang` varchar(3) NOT NULL DEFAULT 'vn',
  `created_by` int(9) NOT NULL DEFAULT 0,
  `created_date` int(20) NOT NULL DEFAULT 0,
  `updated_date` int(20) NOT NULL DEFAULT 0,
  `updated_by` int(9) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `code`, `code_module`, `title`, `title_search`, `urlseo`, `t_status`, `position`, `left`, `right`, `level`, `parent_id`, `intro`, `description`, `imgURL`, `menu`, `url`, `lang`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(1, '_ROOT', 'ROOT', 'ROOT', 'root', '', 1, 0, 1, 28, 0, 0, '', '', '', '', '', 'vn', 1, 0, 0, 1),
(2, 'VN', '_LANGUAGE', 'Vietnamese', '', '', 1, 1, 2, 21, 1, 1, '', '', '', '', '', 'vn', 1, 0, 0, 1),
(3, 'EN', '_LANGUAGE', 'English', '', '', 2, 2, 22, 25, 1, 1, '', '', '', '', '', 'en', 1, 0, 0, 1),
(5, '_CONTENT', 'RSCMS', 'Nội dung', '', '', 2, 5, 3, 10, 2, 2, '', '', '', '', '', 'vn', 1, 0, 0, 1),
(6, '_PRODUCT', 'RSPRODUCT', 'Sản phẩm', '', '', 1, 6, 11, 20, 2, 2, '', '', '', '', '', 'vn', 1, 0, 0, 1),
(8, '_PRODUCT', 'RSPRODUCT', 'Cà phê', 'Ca phe', 'ca-phe', 1, 8, 12, 15, 3, 6, '', '', '', '', '', 'vn', 1, 0, 1692174406, 1),
(9, '_PRODUCT', 'RSPRODUCT', 'Nước hoa', 'Nuoc hoa', 'nuoc-hoa', 1, 8, 16, 19, 3, 6, '', '', '', '', '', 'vn', 1, 0, 1692173691, 1),
(10, '_PRODUCT', 'RSPRODUCT', 'Nước hoa Pháp', 'Nuoc hoa Phap', 'nuoc-hoa-phap', 1, 8, 17, 18, 4, 9, '', '', '', '', '', 'vn', 1, 0, 1692173705, 1),
(11, '_CONTENT', 'RSCMS', 'Content', '', '', 1, 2, 23, 24, 2, 3, '', '', '', '', '', 'en', 1, 0, 0, 1),
(13, '_PRODUCT', 'RSPRODUCT', 'Laura Sunshine', 'Laura Sunshine', 'laura-sunshine', 1, 12, 13, 14, 4, 8, '', '', '', '', '', 'vn', 1, 1692173746, 1695197219, 1),
(14, '_NEWS', 'RSCMS', 'Tin tức', 'Tin tuc', 'tin-tuc', 1, 13, 4, 5, 3, 5, '', '', '', '', '', 'vn', 1, 1692178633, 1692178633, 1),
(15, '_CONTENT', 'RSCMS', 'Video', 'Video', 'video', 1, 14, 6, 7, 3, 5, '', '', '', '', '', 'vn', 1, 1694426575, 1694426595, 1),
(16, '_CONTACT', 'RSCMS', 'Liên hệ', 'Lien he', 'lien-he', 1, 100, 8, 9, 3, 5, '', '', '', '', '', 'vn', 1, 1695197183, 1695197183, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcolor`
--

CREATE TABLE `tblcolor` (
  `ID` int(9) NOT NULL,
  `title_vn` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `code` varchar(20) NOT NULL DEFAULT '#ffffff',
  `t_status` int(1) NOT NULL DEFAULT 1,
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblcolor`
--

INSERT INTO `tblcolor` (`ID`, `title_vn`, `title_en`, `code`, `t_status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'Đen', 'Black', '#000000', 1, 1715250259, 1, 1715250362, 1),
(2, 'Đỏ', 'Red', '#ff0000', 1, 1715250843, 1, 1715250843, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblcompany`
--

CREATE TABLE `tblcompany` (
  `ID` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `copyright` varchar(255) NOT NULL,
  `brand` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `logo_footer` varchar(255) NOT NULL,
  `logo_favicon` varchar(255) NOT NULL,
  `website` varchar(255) NOT NULL,
  `fax` varchar(32) NOT NULL,
  `hotline` varchar(32) NOT NULL,
  `phone` varchar(32) NOT NULL,
  `email` varchar(50) NOT NULL,
  `facebook` varchar(255) NOT NULL,
  `twitter` varchar(255) NOT NULL,
  `youtube` varchar(255) NOT NULL,
  `instagram` varchar(255) NOT NULL,
  `linkedin` varchar(255) NOT NULL,
  `pinterest` varchar(255) NOT NULL,
  `embedgooglemap` text NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'vn',
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblcompany`
--

INSERT INTO `tblcompany` (`ID`, `t_status`, `name`, `address`, `copyright`, `brand`, `logo`, `logo_footer`, `logo_favicon`, `website`, `fax`, `hotline`, `phone`, `email`, `facebook`, `twitter`, `youtube`, `instagram`, `linkedin`, `pinterest`, `embedgooglemap`, `lang`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 'Tổng công ty ABC', '159 Điện Biên Phủ, P. 15, Q. Bình Thạnh', 'Copyright 2003', 'ABC Group', 'resources/upload/company/1/logo/logo_rf.png', 'resources/upload/company/1/footer/logo-framework.png', 'resources/upload/company/1/favicon/logo4.png', 'abc.com', '02873015631', '02873015630', '0909090909', 'abc@gmail.com', 'facebook', 'twitter', 'youtube', 'instagram', 'linkedin', 'pinterest', '', 'vn', 1711963980, 1, 1712048901, 1),
(2, 1, 'ABC Group', '159 Điện Biên Phủ, P. 15, Q. Bình Thạnh', 'Copyright 2003', 'ABC Group', '', '', '', 'abc.com', '02873015631', '02873015630', '0909090909', 'abc@gmail.com', 'facebook', 'twitter', 'youtube', 'instagram', 'linkedin', 'pinterest', '', 'en', 1711964204, 1, 1711964204, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblconfig`
--

CREATE TABLE `tblconfig` (
  `ID` int(9) NOT NULL,
  `code` varchar(50) NOT NULL,
  `value` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblconfig`
--

INSERT INTO `tblconfig` (`ID`, `code`, `value`) VALUES
(1, 'smtp_hostname', 'mail.redsun.vn'),
(2, 'smtp_port', '25'),
(3, 'smtp_mail', 'developer@redsun.vn'),
(4, 'smtp_password', 'R!bk16u5'),
(5, 'smtp_auth', '1'),
(6, 'mail_contact', 'minhnhat@redsun.vn'),
(7, 'mail_order', 'minhnhat@redsun.vn'),
(8, 'head_tag', 'Head tag'),
(9, 'body_tag', 'Body tag'),
(10, 'google_analytic', 'Google Analytic'),
(11, 'google_adwords', 'Google Adwords re-marketing'),
(12, 'facebook_code_tracking', 'Facebook Code Tracking'),
(13, 'facebook_adwords', 'Facebook Adwords re-marketing'),
(14, 'embed_livechat', 'Embed Livechat'),
(15, 'javascript_other', 'Mã javascript khác');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact_form`
--

CREATE TABLE `tblcontact_form` (
  `ID` int(9) NOT NULL,
  `name` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `subject` varchar(255) NOT NULL,
  `message` text NOT NULL,
  `lang` varchar(2) NOT NULL,
  `t_index` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tblcontent`
--

CREATE TABLE `tblcontent` (
  `ID` int(9) NOT NULL,
  `cateid` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `title` varchar(255) NOT NULL,
  `title_search` varchar(255) NOT NULL,
  `urlseo` varchar(255) NOT NULL,
  `url` varchar(511) NOT NULL,
  `imgURL` varchar(511) NOT NULL,
  `intro` varchar(1023) NOT NULL,
  `content` longtext NOT NULL,
  `type_art` varchar(20) NOT NULL DEFAULT 'content',
  `t_index` int(9) NOT NULL DEFAULT 0,
  `most_view` int(9) NOT NULL DEFAULT 0,
  `lang` varchar(3) NOT NULL DEFAULT 'vn',
  `publish_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblcontent`
--

INSERT INTO `tblcontent` (`ID`, `cateid`, `t_status`, `title`, `title_search`, `urlseo`, `url`, `imgURL`, `intro`, `content`, `type_art`, `t_index`, `most_view`, `lang`, `publish_date`, `created_by`, `created_date`, `updated_date`, `updated_by`) VALUES
(1, 12, 1, 'Ma thú kiếm thánh, dị giới tung hoành', 'Ma thu kiem thanh di gioi tung hoanh', 'ma-thu-kiem-thanh-di-gioi-tung-hoanh', '', '', 'intro', '&lt;p&gt;content content&lt;/p&gt;', 'content', 1, 0, 'vn', 1691773200, 1, 1689669637, 1692593082, 1),
(2, 5, 1, 'Bài viết 1', 'Bai viet 1', 'bai-viet-1', '', '', '', '', 'content', 2, 0, 'vn', 0, 1, 1721882888, 1721882888, 1),
(3, 14, 1, 'Tin tức 1', 'Tin tuc 1', 'tin-tuc-1', '', '', '', '', 'news', 3, 0, 'vn', 0, 1, 1721882912, 1721882912, 1),
(4, 14, 1, 'Tin tức 2', 'Tin tuc 2', 'tin-tuc-2', '', '', '', '', 'news', 4, 0, 'vn', 0, 1, 1721882966, 1721882966, 1),
(5, 14, 1, 'Tin tức 3', 'Tin tuc 3', 'tin-tuc-3', '', '', '', '', 'news', 5, 0, 'vn', 0, 1, 1721883085, 1721883085, 1),
(6, 14, 1, 'Tin tức 4', 'Tin tuc 4', 'tin-tuc-4', '', '', '', '', 'news', 6, 0, 'vn', 0, 1, 1721883147, 1721883147, 1),
(7, 14, 1, 'Tin tức 5', 'Tin tuc 5', 'tin-tuc-5', '', '', '', '', 'news', 7, 0, 'vn', 0, 1, 1721883160, 1721883160, 1),
(8, 14, 1, 'Tin tức 6', 'Tin tuc 6', 'tin-tuc-6', '', '', '', '', 'news', 8, 0, 'vn', 0, 1, 1721883168, 1721883168, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldeliverymethod`
--

CREATE TABLE `tbldeliverymethod` (
  `ID` int(9) NOT NULL,
  `title_vn` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `t_index` int(5) NOT NULL DEFAULT 1,
  `created_date` int(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'vn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbldeliverymethod`
--

INSERT INTO `tbldeliverymethod` (`ID`, `title_vn`, `title_en`, `t_status`, `t_index`, `created_date`, `created_by`, `updated_date`, `updated_by`, `lang`) VALUES
(1, 'Giao hàng trực tiếp', 'Direct delivery', 1, 1, 1706260572, 'admin', 1706609921, 'admin', 'vn'),
(2, 'Khách đến kho lấy hàng', 'Customers come to the warehouse to pick up goods', 1, 1, 1706260582, 'admin', 1706609944, 'admin', 'vn'),
(5, 'Đơn vị giao hàng Logistic?', 'Logistic delivery unit?', 1, 1, 1706260651, 'admin', 1706609953, 'admin', 'vn'),
(6, 'Giao hàng tiêu chuẩn', 'Standard delivery', 1, 1, 1706599659, 'admin', 1711351468, '1', 'vn');

-- --------------------------------------------------------

--
-- Table structure for table `tbllibrary`
--

CREATE TABLE `tbllibrary` (
  `ID` int(9) NOT NULL,
  `nodeid` int(9) NOT NULL,
  `code_module` varchar(20) NOT NULL,
  `source` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `intro` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  `t_index` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tbllibrary`
--

INSERT INTO `tbllibrary` (`ID`, `nodeid`, `code_module`, `source`, `title`, `intro`, `link`, `t_index`, `created_date`, `created_by`) VALUES
(1, 2, 'RSPRODUCT', 'resources/upload/product/slider/2/cap-nhat-dong-gop.jpg', '', '', '', 0, 1695187642, 1),
(3, 1, 'RSPRODUCT', 'resources/upload/product/slider/1/huong-dan-dong-gop.jpg', '', '', '', 0, 1695187651, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblmember`
--

CREATE TABLE `tblmember` (
  `ID` int(9) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `salt` varchar(10) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 2,
  `cus_code` varchar(20) NOT NULL,
  `firstname` varchar(30) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `fullname` varchar(50) NOT NULL,
  `name_search` varchar(50) NOT NULL,
  `gender` int(1) NOT NULL DEFAULT 1,
  `birthdate` int(20) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `t_index` int(4) NOT NULL,
  `last_login` int(20) NOT NULL DEFAULT 0,
  `created_date` int(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblmember`
--

INSERT INTO `tblmember` (`ID`, `username`, `password`, `salt`, `t_status`, `cus_code`, `firstname`, `lastname`, `fullname`, `name_search`, `gender`, `birthdate`, `phone`, `email`, `address`, `avatar`, `t_index`, `last_login`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'minhnhat', '3a0dd49931123fdb96ab47e251f46399', '2u3U', 1, 'TMN-1', 'Minh Nhật', 'Tuyết', 'Tuyết Minh Nhật', 'tuyet minh nhat', 1, 689014800, '0909090909', 'minhnhat@redsun.vn', '159 Điện Biên Phủ, P. 15, Q. Bình Thạnh', '', 0, 0, 1708399940, 'admin', 1708414790, 'admin'),
(2, 'nhungho', 'b06953d02a235fba4266aa979f60698a', 'F0zi', 3, 'HTAN-2', 'Ái Nhung', 'Hồ Thị', 'Hồ Thị Ái Nhung', 'ho thi Ai nhung', 2, 791744400, '0808080808', 'nhungho@redsun.vn', '159 Điện Biên Phủ, P. 15, Q. Bình Thạnh', '', 0, 0, 1708399976, 'admin', 1708404661, 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder`
--

CREATE TABLE `tblorder` (
  `ID` int(9) NOT NULL,
  `code` varchar(50) NOT NULL,
  `date` int(20) NOT NULL,
  `total` float(15,2) NOT NULL,
  `t_status` varchar(30) NOT NULL DEFAULT 'pending',
  `delivery_method` int(11) NOT NULL DEFAULT 1,
  `delivery_status` varchar(30) NOT NULL DEFAULT 'not_yet_delivered',
  `payment_method` int(9) NOT NULL DEFAULT 1,
  `payment_status` varchar(30) NOT NULL DEFAULT 'unpaid',
  `delivery_fee` float(15,2) NOT NULL DEFAULT 0.00,
  `note` text NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `t_index` int(11) NOT NULL DEFAULT 1,
  `lang` varchar(2) NOT NULL DEFAULT 'VN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblorder`
--

INSERT INTO `tblorder` (`ID`, `code`, `date`, `total`, `t_status`, `delivery_method`, `delivery_status`, `payment_method`, `payment_status`, `delivery_fee`, `note`, `updated_date`, `updated_by`, `t_index`, `lang`) VALUES
(1, '1721375949_1', 1721375924, 3710000.00, 'pending', 6, 'not_yet_delivered', 1, 'unpaid', 0.00, '', 1721384355, '1', 1, 'vn'),
(2, '1721376023_2', 1721375960, 2010000.00, 'pending', 6, 'not_yet_delivered', 1, 'unpaid', 15000.00, '', 1721381876, '1', 1, 'vn');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_buyer`
--

CREATE TABLE `tblorder_buyer` (
  `ID` int(9) NOT NULL,
  `order_id` int(9) NOT NULL DEFAULT 0,
  `member_id` int(9) NOT NULL DEFAULT 0,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblorder_buyer`
--

INSERT INTO `tblorder_buyer` (`ID`, `order_id`, `member_id`, `fullname`, `phone`, `email`, `address`) VALUES
(1, 1, 0, 'Mr Snow', '0909090909', 'minhnhat@redsun.vn', '158 Điện Biên Phủ, Phường 15, Q. Bình Thạnh 1'),
(2, 2, 0, 'Tuyet Minh Nhat', '0909090909', 'nganle@redsun.vn', 'Phạm Viết Chánh, Bình Thạnh 2');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_detail`
--

CREATE TABLE `tblorder_detail` (
  `ID` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `product_id` int(9) NOT NULL,
  `product_price_id` int(9) NOT NULL,
  `color` varchar(50) NOT NULL,
  `size` varchar(50) NOT NULL,
  `product_name` varchar(255) NOT NULL,
  `price` float(10,2) NOT NULL,
  `reduced_price` float(10,2) NOT NULL,
  `quantity` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblorder_detail`
--

INSERT INTO `tblorder_detail` (`ID`, `order_id`, `product_id`, `product_price_id`, `color`, `size`, `product_name`, `price`, `reduced_price`, `quantity`) VALUES
(1, 1, 1, 5, '', '4 hộp', 'Cà phê đông trùng hạ thảo, Combo 4 hộp', 360000.00, 350000.00, 1),
(2, 2, 2, 3, 'Đỏ', '300ml', 'Nước hoa Pháp, Chai nhỏ', 1200000.00, 1000000.00, 1),
(3, 2, 1, 2, '', '2 hộp', 'Cà phê đông trùng hạ thảo, Combo 2 hộp', 160000.00, 135000.00, 1),
(4, 2, 3, 6, '', '', 'Cà phê Nấm linh chi', 75000.00, 75000.00, 3),
(5, 2, 1, 5, '', '4 hộp', 'Cà phê đông trùng hạ thảo, Combo 4 hộp', 360000.00, 350000.00, 1),
(6, 2, 3, 4, 'Đen', '2 hộp', 'Cà phê Nấm linh chi, Combo 2 hộp', 170000.00, 150000.00, 2),
(7, 1, 1, 2, '', '2 hộp', 'Cà phê đông trùng hạ thảo, Combo 2 hộp', 160000.00, 135000.00, 1),
(8, 1, 2, 3, 'Đỏ', '300ml', 'Nước hoa Pháp, Chai nhỏ', 1200000.00, 1000000.00, 3),
(9, 1, 3, 4, 'Đen', '2 hộp', 'Cà phê Nấm linh chi, Combo 2 hộp', 170000.00, 150000.00, 1),
(10, 1, 3, 6, '', '', 'Cà phê Nấm linh chi', 75000.00, 75000.00, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_note`
--

CREATE TABLE `tblorder_note` (
  `ID` int(9) NOT NULL,
  `order_id` int(9) NOT NULL,
  `note` mediumtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblorder_note`
--

INSERT INTO `tblorder_note` (`ID`, `order_id`, `note`) VALUES
(1, 1, '&lt;div&gt;19/07/2024 | 17:19 - &lt;strong&gt;admin&lt;/strong&gt; : &lt;em&gt;(5) [ORDER] Email - Thông báo đã gói hàng&lt;/em&gt; - &lt;/div&gt;<div>19/07/2024 | 17:16 - <strong>admin</strong> : <em>(1) [ORDER] Email - Thông báo đơn hàng mới đặt cho người mua</em> - </div><div>19/07/2024 | 17:07 - <strong>admin</strong> : <em>(3) [ORDER] Email - Thông báo đã xác nhận đơn hàng</em> - </div><div>19/07/2024 | 17:00 - <strong>admin</strong> : <em>(1) [ORDER] Email - Thông báo đơn hàng mới đặt cho người mua</em> - </div><div>19/07/2024 | 16:59 - <strong>admin</strong> : <em>(1) [ORDER] Email - Thông báo đơn hàng mới đặt cho người mua</em> - </div><div>19/07/2024 | 16:53 - <strong>admin</strong> : <em>(1) [ORDER] Email - Thông báo đơn hàng mới đặt cho người mua</em> - </div><div>19/07/2024 | 14:59 - <strong>admin</strong> : Thêm mới thủ công</div>'),
(2, 2, '&lt;div&gt;19/07/2024 | 16:37 - &lt;strong&gt;admin&lt;/strong&gt; : &lt;/div&gt;<div>19/07/2024 | 15:00 - <strong>admin</strong> : Thêm mới thủ công</div>');

-- --------------------------------------------------------

--
-- Table structure for table `tblorder_receiver`
--

CREATE TABLE `tblorder_receiver` (
  `ID` int(9) NOT NULL,
  `order_id` int(9) NOT NULL DEFAULT 0,
  `member_id` int(9) NOT NULL DEFAULT 0,
  `fullname` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblorder_receiver`
--

INSERT INTO `tblorder_receiver` (`ID`, `order_id`, `member_id`, `fullname`, `phone`, `email`, `address`) VALUES
(1, 1, 0, 'Mr Snow', '0909090909', 'minhnhat@redsun.vn', '158 Điện Biên Phủ, Phường 15, Q. Bình Thạnh 1'),
(2, 2, 0, 'Tuyet Minh Nhat', '0909090909', 'nganle@redsun.vn', 'Phạm Viết Chánh, Bình Thạnh 2');

-- --------------------------------------------------------

--
-- Table structure for table `tblpaymentmethod`
--

CREATE TABLE `tblpaymentmethod` (
  `ID` int(11) NOT NULL,
  `title_vn` varchar(255) NOT NULL,
  `title_en` varchar(255) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `t_index` int(5) NOT NULL DEFAULT 1,
  `created_date` int(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'vn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblpaymentmethod`
--

INSERT INTO `tblpaymentmethod` (`ID`, `title_vn`, `title_en`, `t_status`, `t_index`, `created_date`, `created_by`, `updated_date`, `updated_by`, `lang`) VALUES
(1, 'Thanh toán khi nhận hàng', 'Payment on delivery', 1, 1, 1706256491, 'admin', 1706256491, 'admin', 'vn'),
(2, 'Thanh toán Momo', 'Momo payment', 1, 2, 1706256533, 'admin', 1711353156, '1', 'vn');

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct`
--

CREATE TABLE `tblproduct` (
  `ID` int(9) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `cateid` int(9) NOT NULL,
  `url` varchar(511) NOT NULL,
  `code` varchar(50) NOT NULL,
  `title` varchar(255) NOT NULL,
  `urlseo` varchar(511) NOT NULL,
  `title_search` varchar(255) NOT NULL,
  `imgURL` varchar(511) NOT NULL,
  `introduction` text NOT NULL,
  `content` longtext NOT NULL,
  `price` float(12,2) NOT NULL DEFAULT 0.00,
  `reduced_price` float(12,2) NOT NULL DEFAULT 0.00,
  `unit_id` int(9) NOT NULL,
  `brand_id` int(9) NOT NULL,
  `most_view` int(9) NOT NULL DEFAULT 0,
  `lang` varchar(2) NOT NULL DEFAULT 'vn',
  `t_index` int(9) NOT NULL DEFAULT 0,
  `publish_date` int(20) NOT NULL,
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblproduct`
--

INSERT INTO `tblproduct` (`ID`, `t_status`, `cateid`, `url`, `code`, `title`, `urlseo`, `title_search`, `imgURL`, `introduction`, `content`, `price`, `reduced_price`, `unit_id`, `brand_id`, `most_view`, `lang`, `t_index`, `publish_date`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 1, 13, '', 'SPV1', 'Cà phê đông trùng hạ thảo', 'ca-phe-dong-trung-ha-thao', 'Ca phe dong trung ha thao', '', '', '', 75000.00, 75000.00, 6, 1, 0, 'vn', 1, 1692464400, 1692248592, 1, 1714644334, 1),
(2, 1, 10, '', 'SPV2', 'Nước hoa Pháp', 'nuoc-hoa-phap', 'Nuoc hoa Phap', 'resources/upload/product/2/p3.png', '', '', 100000.00, 85000.00, 7, 0, 0, 'vn', 2, -28800, 1695187642, 1, 1714644355, 1),
(3, 1, 13, '', 'SPV3', 'Cà phê Nấm linh chi', 'ca-phe-nam-linh-chi', 'Ca phe Nam linh chi', '', '', '', 80000.00, 60000.00, 6, 1, 0, 'vn', 3, 1711472400, 1711526533, 1, 1714644367, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblproduct_price`
--

CREATE TABLE `tblproduct_price` (
  `ID` int(9) NOT NULL,
  `product_id` int(9) NOT NULL DEFAULT 0,
  `color_id` int(9) NOT NULL DEFAULT 0,
  `size_id` int(9) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL,
  `price` float(9,2) NOT NULL DEFAULT 0.00,
  `reduced_price` float(9,2) NOT NULL DEFAULT 0.00,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `created_by` int(9) NOT NULL,
  `created_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblproduct_price`
--

INSERT INTO `tblproduct_price` (`ID`, `product_id`, `color_id`, `size_id`, `title`, `price`, `reduced_price`, `t_status`, `created_by`, `created_date`, `updated_by`, `updated_date`) VALUES
(2, 1, 0, 4, 'Combo 2 hộp', 160000.00, 135000.00, 1, 1, 1715323286, 1, 1717742102),
(3, 2, 2, 2, 'Chai nhỏ', 1200000.00, 1000000.00, 1, 1, 1715323464, 1, 1717742064),
(4, 3, 1, 4, 'Combo 2 hộp', 170000.00, 150000.00, 1, 1, 1715324228, 1, 1717742046),
(5, 1, 0, 7, 'Combo 4 hộp', 360000.00, 350000.00, 1, 1, 1717744031, 1, 1717744063),
(6, 3, 0, 0, '', 75000.00, 75000.00, 1, 1, 1717744889, 1, 1717744889);

-- --------------------------------------------------------

--
-- Table structure for table `tblseo`
--

CREATE TABLE `tblseo` (
  `ID` int(9) NOT NULL,
  `nodeid` int(9) NOT NULL,
  `title` varchar(255) NOT NULL,
  `keywords` varchar(511) NOT NULL,
  `description` text NOT NULL,
  `code_module` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblseo`
--

INSERT INTO `tblseo` (`ID`, `nodeid`, `title`, `keywords`, `description`, `code_module`) VALUES
(2, 10, 'Áo Phông', 'Áo phông, ao phong', '', 'RSCATEGORY'),
(3, 5, 'Nội dung', 'nội dung, noi dung', '', 'RSCATEGORY'),
(4, 8, 'Cà phê', 'cà phê, ca phe', '', 'RSCATEGORY'),
(5, 10, 'Nước hoa Pháp', 'nước hoa pháp, nuoc hoa phap', '', 'RSCATEGORY'),
(6, 1, 'Xem phim', 'xem phim, xem phim', 'intro content content', 'RSCMS'),
(7, 9, 'Nước hoa', 'nước hoa, nuoc hoa', '', 'RSCATEGORY'),
(8, 13, 'Laura Sunshine', 'laura sunshine, laura sunshine', '', 'RSCATEGORY'),
(9, 14, 'Tin tức', 'tin tức, tin tuc', '', 'RSCATEGORY'),
(10, 1, 'Cà phê đông trùng hạ thảo', 'cà phê đông trùng hạ thảo, ca phe dong trung ha thao', ' ', 'RSPRODUCT'),
(17, 15, 'Video', 'video, video', '', 'RSCATEGORY'),
(18, 2, 'Nước hoa Pháp', 'nước hoa pháp, nuoc hoa phap', ' ', 'RSPRODUCT'),
(19, 16, 'Liên hệ', 'liên hệ, lien he', '', 'RSCATEGORY'),
(20, 3, 'Cà phê Nấm linh chi', 'cà phê nấm linh chi, ca phe nam linh chi', ' ', 'RSPRODUCT'),
(21, 2, 'Bài viết 1', 'bài viết 1, bai viet 1', ' ', 'RSCMS'),
(22, 3, 'Tin tức 1', 'tin tức 1, tin tuc 1', ' ', 'RSCMS'),
(23, 4, 'Tin tức 2', 'tin tức 2, tin tuc 2', ' ', 'RSCMS'),
(24, 5, 'Tin tức 3', 'tin tức 3, tin tuc 3', ' ', 'RSCMS'),
(25, 6, 'Tin tức 4', 'tin tức 4, tin tuc 4', ' ', 'RSCMS'),
(26, 7, 'Tin tức 5', 'tin tức 5, tin tuc 5', ' ', 'RSCMS'),
(27, 8, 'Tin tức 6', 'tin tức 6, tin tuc 6', ' ', 'RSCMS');

-- --------------------------------------------------------

--
-- Table structure for table `tblsize`
--

CREATE TABLE `tblsize` (
  `ID` int(9) NOT NULL,
  `title_vn` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblsize`
--

INSERT INTO `tblsize` (`ID`, `title_vn`, `title_en`, `t_status`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(2, '300ml', '300ml', 1, 1715313391, 1, 1716453849, 1),
(3, '40x30', '40x30', 2, 1715313406, 1, 1715313406, 1),
(4, '2 hộp', '2 box', 1, 1715323219, 1, 1715323219, 1),
(5, 'Ngẫu nhiên', 'Ramdom', 1, 1715323250, 1, 1715323250, 1),
(6, 'Size 41', 'Size 41', 1, 1716453706, 1, 1716453782, 1),
(7, '4 hộp', '4 box', 1, 1717744049, 1, 1717744049, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbltemplate`
--

CREATE TABLE `tbltemplate` (
  `ID` int(11) NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `title` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `content` mediumtext CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `code` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `t_group` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'email',
  `lang` varchar(2) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT 'vn',
  `t_status` int(1) NOT NULL DEFAULT 1,
  `mask` varchar(20) NOT NULL,
  `t_index` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tbltemplate`
--

INSERT INTO `tbltemplate` (`ID`, `name`, `title`, `content`, `code`, `t_group`, `lang`, `t_status`, `mask`, `t_index`, `updated_date`, `updated_by`) VALUES
(1, '[ORDER] Email - Thông báo đơn hàng mới đặt cho người mua', '[COMPANY_BRANDNAME] đã nhận Đơn hàng #[ORDER_CODE]', '&amp;lt;div style=&amp;quot;color:rgb(32,32,32);font-size:14px;&amp;quot;&amp;gt;&amp;lt;div style=&amp;quot;border-left:10px solid #f0f0f0;border-right:10px solid #f0f0f0;border-top:10px solid #f0f0f0;margin:auto;max-width:750px;&amp;quot;&amp;gt;&amp;lt;figure class=&amp;quot;table&amp;quot;&amp;gt;&amp;lt;table style=&amp;quot;max-width:750px;&amp;quot; border=&amp;quot;0&amp;quot; cellpadding=&amp;quot;0&amp;quot; cellspacing=&amp;quot;0&amp;quot; width=&amp;quot;100%&amp;quot;&amp;gt;&amp;lt;tbody&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;padding-top:30px;text-align:center;&amp;quot;&amp;gt;[COMPANY_LOGO]&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;div style=&amp;quot;color:#0f146d;font-size:23px;padding:0 15px 30px;text-align:center;&amp;quot;&amp;gt;Cám ơn bạn đã đặt hàng tại [COMPANY_BRANDNAME]!&amp;lt;/div&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;Xin chào [BUYER_NAME],&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;[BRAND_NAME] đã nhận được yêu cầu đặt hàng của bạn và đang xử lý nhé. Bạn sẽ nhận được thông báo tiếp theo khi đơn hàng đã sẵn sàng được giao.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;&amp;lt;strong&amp;gt;*Lưu ý nhỏ cho bạn:&amp;lt;/strong&amp;gt; Bạn chỉ nên nhận hàng khi trạng thái đơn hàng là “&amp;lt;strong&amp;gt;Đang giao hàng&amp;lt;/strong&amp;gt;” và nhớ kiểm tra Mã đơn hàng, Thông tin người gửi và Mã vận đơn để nhận đúng kiện hàng nhé.&amp;lt;/p&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Sản phẩm&amp;lt;/strong&amp;gt;&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;[PRODUCT_LIST]&amp;lt;/p&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;figure class=&amp;quot;table&amp;quot;&amp;gt;&amp;lt;table style=&amp;quot;margin-bottom:15px;&amp;quot; cellpadding=&amp;quot;8&amp;quot; width=&amp;quot;100%&amp;quot;&amp;gt;&amp;lt;tbody&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;strong&amp;gt;Tổng số lượng:&amp;lt;/strong&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:center;&amp;quot;&amp;gt;&amp;amp;nbsp;&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;[TOTAL_QUANTITY]&amp;lt;/strong&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;strong&amp;gt;Tổng thành tiền:&amp;lt;/strong&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:center;&amp;quot;&amp;gt;VND&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;[TOTAL_AMOUNT]&amp;lt;/strong&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;strong&amp;gt;Phí vận chuyển:&amp;lt;/strong&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:center;&amp;quot;&amp;gt;VND&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[DELIVERY_FEE]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;span style=&amp;quot;color:#f27c24;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Tổng cộng:&amp;lt;/strong&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:center;&amp;quot;&amp;gt;&amp;lt;span style=&amp;quot;color:#f27c24;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;VND&amp;lt;/strong&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;&amp;lt;span style=&amp;quot;color:#f27c24;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;[TOTAL_ORDER]&amp;lt;/strong&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;/tbody&amp;gt;&amp;lt;/table&amp;gt;&amp;lt;/figure&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:1px solid #f0f0f0;height:0;margin-bottom:15px;&amp;quot;&amp;gt;&amp;amp;nbsp;&amp;lt;/div&amp;gt;&amp;lt;figure class=&amp;quot;table&amp;quot;&amp;gt;&amp;lt;table cellpadding=&amp;quot;8&amp;quot; width=&amp;quot;100%&amp;quot;&amp;gt;&amp;lt;tbody&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Trạng thái đơn hàng:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[ORDER_STATUS]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Phương thức thanh toán:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[ORDER_PAYMENT_METHOD]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Trạng thái thanh toán:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[ORDER_PAYMENT_STATUS]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Tùy chọn giao hàng:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[ORDER_DELIVERY_METHOD]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Trạng thái giao hàng:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[ORDER_DELIVERY_STATUS]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;/tbody&amp;gt;&amp;lt;/table&amp;gt;&amp;lt;/figure&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Ngày đặt hàng:&amp;lt;/strong&amp;gt; [ORDER_DATE]&amp;lt;/h3&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Ghi chú đơn hàng:&amp;lt;/strong&amp;gt;&amp;lt;/h3&amp;gt;&amp;lt;div&amp;gt;[ORDER_NOTE]&amp;lt;/div&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Thông tin người mua&amp;lt;/strong&amp;gt;&amp;lt;/h3&amp;gt;&amp;lt;figure class=&amp;quot;table&amp;quot;&amp;gt;&amp;lt;table width=&amp;quot;100%&amp;quot;&amp;gt;&amp;lt;tbody&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Tên người mua:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[BUYER_NAME]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Số điện thoại:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[BUYER_PHONE]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Email:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[BUYER_EMAIL]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Địa chỉ:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[BUYER_ADDRESS]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;/tbody&amp;gt;&amp;lt;/table&amp;gt;&amp;lt;/figure&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Thông tin người nhận&amp;lt;/strong&amp;gt;&amp;lt;/h3&amp;gt;&amp;lt;figure class=&amp;quot;table&amp;quot;&amp;gt;&amp;lt;table width=&amp;quot;100%&amp;quot;&amp;gt;&amp;lt;tbody&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Tên người nhận:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[RECEIVER_NAME]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Số điện thoại:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[RECEIVER_PHONE]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Email:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[RECEIVER_EMAIL]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;Địa chỉ:&amp;lt;/td&amp;gt;&amp;lt;td style=&amp;quot;text-align:right;&amp;quot;&amp;gt;[RECEIVER_ADDRESS]&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;/tbody&amp;gt;&amp;lt;/table&amp;gt;&amp;lt;/figure&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;tr&amp;gt;&amp;lt;td&amp;gt;&amp;lt;div style=&amp;quot;border-bottom:10px solid #f0f0f0;padding:30px;&amp;quot;&amp;gt;&amp;lt;h3 style=&amp;quot;margin-top:0;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;Có phải bạn thắc mắc?&amp;lt;/strong&amp;gt;&amp;lt;/h3&amp;gt;&amp;lt;p&amp;gt;Liên hệ hotline [COMPANY_HOTLINE] của chúng tôi hoặc gửi email đến hòm thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ lúc nào.&amp;lt;/p&amp;gt;&amp;lt;p&amp;gt;[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.&amp;lt;/p&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/td&amp;gt;&amp;lt;/tr&amp;gt;&amp;lt;/tbody&amp;gt;&amp;lt;/table&amp;gt;&amp;lt;/figure&amp;gt;&amp;lt;/div&amp;gt;&amp;lt;/div&amp;gt;', 'order_info', 'email', 'vn', 1, 'order_email', 1, 1712112780, 1),
(2, '[ORDER] Email - Thông báo đơn hàng mới đặt cho người mua', '[COMPANY_BRANDNAME] Order Received #[ORDER_CODE]', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\n	<tbody>\n		<tr>\n			<td>\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\n\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\n\n			<p>Your order has been received and is being processed. We will notify you when the parcel is ready.</p>\n\n			<p>Please only agree to receive the package if the order&rsquo;s status has been updated to &quot;Out for Delivery&quot;. Don&rsquo;t forget to double check your Order number, Sender information and Tracking number to ensure you receive the right package.</p>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\n			[PRODUCT_LIST]</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td><b>Total quantity:</b></td>\n						<td align=\"center\">&nbsp;</td>\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\n					</tr>\n					<tr>\n						<td><b>Total amount:</b></td>\n						<td align=\"center\">VND</td>\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\n					</tr>\n					<tr>\n						<td><b>Delivery fee:</b></td>\n						<td align=\"center\">VND</td>\n						<td align=\"right\">[DELIVERY_FEE]</td>\n					</tr>\n					<tr>\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\n					</tr>\n				</tbody>\n			</table>\n\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\n\n			<table cellpadding=\"8\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td>Order status:</td>\n						<td align=\"right\">[ORDER_STATUS]</td>\n					</tr>\n					<tr>\n						<td>Payment method:</td>\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\n					</tr>\n					<tr>\n						<td>Payment status:</td>\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\n					</tr>\n					<tr>\n						<td>Delivery method:</td>\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\n					</tr>\n					<tr>\n						<td>Delivery status:</td>\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\n					</tr>\n				</tbody>\n			</table>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\n\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\n\n			<div>[ORDER_NOTE]</div>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\n\n			<table width=\"100%\">\n				<tbody>\n					<tr>\n						<td>Buyer name:</td>\n						<td align=\"right\">[BUYER_NAME]</td>\n					</tr>\n					<tr>\n						<td>Phone:</td>\n						<td align=\"right\">[BUYER_PHONE]</td>\n					</tr>\n					<tr>\n						<td>Email:</td>\n						<td align=\"right\">[BUYER_EMAIL]</td>\n					</tr>\n					<tr>\n						<td>Address:</td>\n						<td align=\"right\">[BUYER_ADDRESS]</td>\n					</tr>\n				</tbody>\n			</table>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\n\n			<table width=\"100%\">\n				<tbody>\n					<tr>\n						<td>Recipient&#39;s name:</td>\n						<td align=\"right\">[RECEIVER_NAME]</td>\n					</tr>\n					<tr>\n						<td>Phone:</td>\n						<td align=\"right\">[RECEIVER_PHONE]</td>\n					</tr>\n					<tr>\n						<td>Email:</td>\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\n					</tr>\n					<tr>\n						<td>Address:</td>\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\n					</tr>\n				</tbody>\n			</table>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\n\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\n\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\n			</div>\n			</td>\n		</tr>\n	</tbody>\n</table>\n</div>\n</div>\n', 'order_info', 'email', 'en', 1, 'order_email', 2, 1711706375, 1),
(3, '[ORDER] Email - Thông báo đã xác nhận đơn hàng', 'Đơn hàng #[ORDER_CODE] đã được xác nhận', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] th&ocirc;ng b&aacute;o với bạn rằng: Đơn h&agrave;ng <strong>#[ORDER_CODE]</strong> đ&atilde; được x&aacute;c nhận.</p>\r\n\r\n			<p><b>*Lưu &yacute; nhỏ cho bạn:</b> Bạn chỉ n&ecirc;n nhận h&agrave;ng khi trạng th&aacute;i đơn h&agrave;ng l&agrave; &ldquo;<b>Đang giao h&agrave;ng</b>&rdquo; v&agrave; nhớ kiểm tra M&atilde; đơn h&agrave;ng, Th&ocirc;ng tin người gửi v&agrave; M&atilde; vận đơn để nhận đ&uacute;ng kiện h&agrave;ng nh&eacute;.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_confirmed', 'email', 'vn', 1, 'order_email', 3, 0, 0),
(4, '[ORDER] Email - Thông báo đã xác nhận đơn hàng', 'Order #[ORDER_CODE] has been confirmed', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] informs you that: Order #[ORDER_CODE] has been confirmed.</p>\r\n\r\n			<p>Please only agree to receive the package if the order&rsquo;s status has been updated to &quot;Out for Delivery&quot;. Don&rsquo;t forget to double check your Order number, Sender information and Tracking number to ensure you receive the right package.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_confirmed', 'email', 'en', 1, 'order_email', 4, 0, 0),
(5, '[ORDER] Email - Thông báo đã gói hàng', 'Đơn hàng #[ORDER_CODE] đã được gói hàng', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\n	<tbody>\n		<tr>\n			<td>\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\n\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\n\n			<p>[BRAND_NAME] th&ocirc;ng b&aacute;o với bạn rằng: Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; được đ&oacute;ng g&oacute;i v&agrave; chờ giao h&agrave;ng.</p>\n\n			<p><b>*Lưu &yacute; nhỏ cho bạn:</b> Bạn chỉ n&ecirc;n nhận h&agrave;ng khi trạng th&aacute;i đơn h&agrave;ng l&agrave; &ldquo;<b>Đang giao h&agrave;ng</b>&rdquo; v&agrave; nhớ kiểm tra M&atilde; đơn h&agrave;ng, Th&ocirc;ng tin người gửi v&agrave; M&atilde; vận đơn để nhận đ&uacute;ng kiện h&agrave;ng nh&eacute;.</p>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\n			[PRODUCT_LIST]</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td><b>Tổng số lượng:</b></td>\n						<td align=\"center\">&nbsp;</td>\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\n					</tr>\n					<tr>\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\n						<td align=\"center\">VND</td>\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\n					</tr>\n					<tr>\n						<td><b>Ph&iacute; vận chuyển:</b></td>\n						<td align=\"center\">VND</td>\n						<td align=\"right\">[DELIVERY_FEE]</td>\n					</tr>\n					<tr>\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\n					</tr>\n				</tbody>\n			</table>\n\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\n\n			<table cellpadding=\"8\" width=\"100%\">\n				<tbody>\n					<tr>\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\n						<td align=\"right\">[ORDER_STATUS]</td>\n					</tr>\n					<tr>\n						<td>Phương thức thanh to&aacute;n:</td>\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\n					</tr>\n					<tr>\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\n					</tr>\n					<tr>\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\n					</tr>\n					<tr>\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\n					</tr>\n				</tbody>\n			</table>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\n\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\n\n			<div>[ORDER_NOTE]</div>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\n\n			<table width=\"100%\">\n				<tbody>\n					<tr>\n						<td>T&ecirc;n người mua:</td>\n						<td align=\"right\">[BUYER_NAME]</td>\n					</tr>\n					<tr>\n						<td>Số điện thoại:</td>\n						<td align=\"right\">[BUYER_PHONE]</td>\n					</tr>\n					<tr>\n						<td>Email:</td>\n						<td align=\"right\">[BUYER_EMAIL]</td>\n					</tr>\n					<tr>\n						<td>Địa chỉ:</td>\n						<td align=\"right\">[BUYER_ADDRESS]</td>\n					</tr>\n				</tbody>\n			</table>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\n\n			<table width=\"100%\">\n				<tbody>\n					<tr>\n						<td>T&ecirc;n người nhận:</td>\n						<td align=\"right\">[RECEIVER_NAME]</td>\n					</tr>\n					<tr>\n						<td>Số điện thoại:</td>\n						<td align=\"right\">[RECEIVER_PHONE]</td>\n					</tr>\n					<tr>\n						<td>Email:</td>\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\n					</tr>\n					<tr>\n						<td>Địa chỉ:</td>\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\n					</tr>\n				</tbody>\n			</table>\n			</div>\n			</td>\n		</tr>\n		<tr>\n			<td>\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\n\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\n\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\n			</div>\n			</td>\n		</tr>\n	</tbody>\n</table>\n</div>\n</div>\n', 'order_packed', 'email', 'vn', 1, 'order_email', 5, 0, 0),
(6, '[ORDER] Email - Thông báo đã gói hàng', 'Order #[ORDER_CODE] has been packaged', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] informs you that: Order #[ORDER_CODE] has been packaged and awaiting delivery.</p>\r\n\r\n			<p>Please only agree to receive the package if the order&rsquo;s status has been updated to &quot;Out for Delivery&quot;. Don&rsquo;t forget to double check your Order number, Sender information and Tracking number to ensure you receive the right package.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_packed', 'email', 'en', 1, 'order_email', 6, 0, 0),
(7, '[ORDER] Email - Thông báo đơn hàng đang được giao', 'Đơn hàng #[ORDER_CODE] đang được giao', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] th&ocirc;ng b&aacute;o với bạn rằng: Đơn h&agrave;ng <strong>#[ORDER_CODE]</strong> đang được giao.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_delivering', 'email', 'vn', 1, 'order_email', 7, 0, 0),
(8, '[ORDER] Email - Thông báo đơn hàng đang được giao', 'Order #[ORDER_CODE] is being delivered', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] informs you that: Order #[ORDER_CODE] is being delivered.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_delivering', 'email', 'en', 1, 'order_email', 8, 0, 0);
INSERT INTO `tbltemplate` (`ID`, `name`, `title`, `content`, `code`, `t_group`, `lang`, `t_status`, `mask`, `t_index`, `updated_date`, `updated_by`) VALUES
(9, '[ORDER] Email - Thông báo giao hàng thành công', 'Đơn hàng #[ORDER_CODE] đã được giao thành công', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] đ&atilde; giao cho bạn đầy đủ với c&aacute;c sản phẩm được liệt k&ecirc; b&ecirc;n dưới theo đơn h&agrave;ng #[ORDER_CODE] của bạn, [BRAND_NAME] hi vọng bạn h&agrave;i l&ograve;ng với c&aacute;c sản phẩm n&agrave;y!</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_delivery_success', 'email', 'vn', 1, 'order_email', 9, 0, 0),
(10, '[ORDER] Email - Thông báo giao hàng thành công', 'Order #[ORDER_CODE] has been delivered successfully', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] has fully delivered to you the products listed below according to your order #[ORDER_CODE], [BRAND_NAME] hope you are satisfied with these products</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_delivery_success', 'email', 'en', 1, 'order_email', 10, 0, 0),
(11, '[ORDER] Email - Thông báo giao hàng không thành công', 'Đơn hàng #[ORDER_CODE] đã không giao thành công', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] rất tiếc v&igrave; bạn đ&atilde; kh&ocirc;ng nhận được kiện h&agrave;ng v&agrave;o h&ocirc;m nay. [BRAND_NAME] rất tiếc v&igrave; bạn đ&atilde; kh&ocirc;ng nhận được kiện h&agrave;ng giao.</p>\r\n\r\n			<p>[BRAND_NAME] sẽ sắp xếp lịch giao h&agrave;ng mới để thực hiện gửi kiện h&agrave;ng đến bạn trong thời gian sớm nhất. Bạn vui l&ograve;ng kiểm tra cuộc gọi từ ph&iacute;a nh&acirc;n vi&ecirc;n giao h&agrave;ng để cập nhật lịch giao h&agrave;ng mới nhất nh&eacute;.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_delivery_not_success', 'email', 'vn', 1, 'order_email', 11, 0, 0),
(12, '[ORDER] Email - Thông báo giao hàng không thành công', 'Order #[ORDER_CODE] was not delivered successfully', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] regrets that you did not receive your package today. [BRAND_NAME] regrets that you have not received your package.</p>\r\n\r\n			<p>[BRAND_NAME] will arrange a new delivery schedule to send the package to you as soon as possible. Please check the call from the delivery staff to update the latest delivery schedule.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_delivery_not_success', 'email', 'en', 1, 'order_email', 12, 0, 0),
(13, '[ORDER] Email - Thông báo hủy giao hàng', 'Đơn hàng #[ORDER_CODE] đã Hủy giao hàng', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; hủy giao h&agrave;ng.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_cancel_delivery', 'email', 'vn', 1, 'order_email', 13, 0, 0),
(14, '[ORDER] Email - Thông báo hủy giao hàng', 'Order #[ORDER_CODE] has been Canceled delivery', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] has been Canceled delivery</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_cancel_delivery', 'email', 'en', 1, 'order_email', 14, 0, 0),
(15, '[ORDER] Email - Thông báo giao hàng lại', 'Đơn hàng #[ORDER_CODE] đang được giao lại', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đang được giao lại. H&atilde;y ch&uacute; &yacute; đến điện thoại của bạn, người giao h&agrave;ng của ch&uacute;ng t&ocirc;i sẽ li&ecirc;n hệ với bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_redelivery', 'email', 'vn', 1, 'order_email', 15, 0, 0),
(16, '[ORDER] Email - Thông báo giao hàng lại', 'Order #[ORDER_CODE] is being redelivered', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] is being redelivered. Please pay attention to your phone, our delivery person will contact you.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_redelivery', 'email', 'en', 1, 'order_email', 16, 0, 0),
(17, '[ORDER] Email - Thông báo đơn hàng hoàn trả', 'Đơn hàng #[ORDER_CODE] đang được tiến hành hoàn trả', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] đang tiến h&agrave;nh <strong>ho&agrave;n trả</strong> cho đơn h&agrave;ng #[ORDER_CODE] của bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_rejected', 'email', 'vn', 1, 'order_email', 17, 0, 0);
INSERT INTO `tbltemplate` (`ID`, `name`, `title`, `content`, `code`, `t_group`, `lang`, `t_status`, `mask`, `t_index`, `updated_date`, `updated_by`) VALUES
(18, '[ORDER] Email - Thông báo đơn hàng hoàn trả', 'Order #[ORDER_CODE] is being refunded', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>[BRAND_NAME] is processing a <strong>refund</strong> for your order #[ORDER_CODE].</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_rejected', 'email', 'en', 1, 'order_email', 18, 0, 0),
(19, '[ORDER] Email - Thông báo kết thúc đơn hàng', 'Đơn hàng #[ORDER_CODE] đã bị dừng/kết thúc', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; bị dừng/kết th&uacute;c.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_ended', 'email', 'vn', 1, 'order_email', 19, 0, 0),
(20, '[ORDER] Email - Thông báo kết thúc đơn hàng', 'Đơn hàng #[ORDER_CODE] has been terminated', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] has been stopped/ended.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_ended', 'email', 'en', 1, 'order_email', 20, 0, 0),
(21, '[ORDER] Email - Thông báo đơn hàng lỗi', 'Đơn hàng #[ORDER_CODE] đã bị lỗi', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; bị lỗi.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_fraud', 'email', 'vn', 1, 'order_email', 21, 0, 0),
(22, '[ORDER] Email - Thông báo đơn hàng lỗi', 'Order #[ORDER_CODE] has failed', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] has failed.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_fraud', 'email', 'en', 1, 'order_email', 22, 0, 0),
(23, '[ORDER] Email - Thông báo đơn hàng hoàn thành', 'Đơn hàng #[ORDER_CODE] đã hoàn thành', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; ho&agrave;n th&agrave;nh. [COMPANY_BRANDNAME] sẽ kết th&uacute;c đơn h&agrave;ng tại đ&acirc;y.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_completed', 'email', 'vn', 1, 'order_email', 23, 0, 0),
(24, '[ORDER] Email - Thông báo đơn hàng hoàn thành', 'Order #[ORDER_CODE] has been completed.', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] has been completed. [COMPANY_BRANDNAME] will end the order here.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_completed', 'email', 'en', 1, 'order_email', 24, 0, 0),
(25, '[ORDER] Email - Thông báo đơn hàng đã bị hủy', 'Đơn hàng #[ORDER_CODE] đã hủy thành công', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; hủy th&agrave;nh c&ocirc;ng</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_canceled', 'email', 'vn', 1, 'order_email', 25, 0, 0),
(26, '[ORDER] Email - Thông báo đơn hàng đã bị hủy', 'Order #[ORDER_CODE] has been successfully canceled', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] has been successfully canceled</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_canceled', 'email', 'en', 1, 'order_email', 26, 0, 0);
INSERT INTO `tbltemplate` (`ID`, `name`, `title`, `content`, `code`, `t_group`, `lang`, `t_status`, `mask`, `t_index`, `updated_date`, `updated_by`) VALUES
(27, '[ORDER] Email - Thông báo đơn hàng đã thanh toán thành công', 'Đơn hàng #[ORDER_CODE] đã đã thanh toán thành công', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">C&aacute;m ơn bạn đ&atilde; đặt h&agrave;ng tại [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [BUYER_NAME],</h3>\r\n\r\n			<p>Đơn h&agrave;ng #[ORDER_CODE] đ&atilde; đ&atilde; thanh to&aacute;n th&agrave;nh c&ocirc;ng.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Sản phẩm</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Tổng số lượng:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Tổng th&agrave;nh tiền:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Ph&iacute; vận chuyển:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Tổng cộng:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Trạng th&aacute;i đơn h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phương thức thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i thanh to&aacute;n:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>T&ugrave;y chọn giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Trạng th&aacute;i giao h&agrave;ng:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Ng&agrave;y đặt h&agrave;ng:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Ghi ch&uacute; đơn h&agrave;ng:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người mua</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người mua:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Th&ocirc;ng tin người nhận</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>T&ecirc;n người nhận:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Số điện thoại:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Địa chỉ:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_payment_success', 'email', 'vn', 1, 'order_email', 27, 0, 0),
(28, '[ORDER] Email - Thông báo đơn hàng đã thanh toán thành công', 'Order #[ORDER_CODE] has been successfully paid', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Thank you for ordering at [COMPANY_BRANDNAME]!</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Hello [BUYER_NAME],</h3>\r\n\r\n			<p>Order #[ORDER_CODE] has been successfully paid.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Products</b></h3>\r\n			[PRODUCT_LIST]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<table cellpadding=\"8\" style=\"margin-bottom: 15px;\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td><b>Total quantity:</b></td>\r\n						<td align=\"center\">&nbsp;</td>\r\n						<td align=\"right\"><b>[TOTAL_QUANTITY]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Total amount:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\"><b>[TOTAL_AMOUNT]</b></td>\r\n					</tr>\r\n					<tr>\r\n						<td><b>Delivery fee:</b></td>\r\n						<td align=\"center\">VND</td>\r\n						<td align=\"right\">[DELIVERY_FEE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td><span style=\"color: #f27c24;\"><b>Total:</b></span></td>\r\n						<td align=\"center\"><span style=\"color: #f27c24;\"><b>VND</b></span></td>\r\n						<td align=\"right\"><span style=\"color: #f27c24;\"><b>[TOTAL_ORDER]</b></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<div style=\"margin-bottom: 15px;border-bottom:1px solid #f0f0f0;height:0\">&nbsp;</div>\r\n\r\n			<table cellpadding=\"8\" width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Order status:</td>\r\n						<td align=\"right\">[ORDER_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment method:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Payment status:</td>\r\n						<td align=\"right\">[ORDER_PAYMENT_STATUS]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery method:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_METHOD]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Delivery status:</td>\r\n						<td align=\"right\">[ORDER_DELIVERY_STATUS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Order date:</b> [ORDER_DATE]</h3>\r\n\r\n			<h3 style=\"margin-top: 0;\"><b>Order notes:</b></h3>\r\n\r\n			<div>[ORDER_NOTE]</div>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Buyer infomation</b></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Buyer name:</td>\r\n						<td align=\"right\">[BUYER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[BUYER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[BUYER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[BUYER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><strong>Receiver&#39;s information</strong></h3>\r\n\r\n			<table width=\"100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>Recipient&#39;s name:</td>\r\n						<td align=\"right\">[RECEIVER_NAME]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Phone:</td>\r\n						<td align=\"right\">[RECEIVER_PHONE]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Email:</td>\r\n						<td align=\"right\">[RECEIVER_EMAIL]</td>\r\n					</tr>\r\n					<tr>\r\n						<td>Address:</td>\r\n						<td align=\"right\">[RECEIVER_ADDRESS]</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'order_payment_success', 'email', 'en', 1, 'order_email', 28, 0, 0),
(29, '[Member] Email - Thông báo thông tin tài khoản thành viên', 'Thông báo thông tin tài khoản thành viên: [MEMBER_FULLNAME]', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Th&ocirc;ng b&aacute;o th&ocirc;ng tin t&agrave;i khoản th&agrave;nh vi&ecirc;n</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Xin ch&agrave;o [MEMBER_FULLNAME],</h3>\r\n\r\n			<p>[COMPANY_BRANDNAME] gửi bạn th&ocirc;ng tin th&agrave;nh vi&ecirc;n tại website của ch&uacute;ng t&ocirc;i:</p>\r\n\r\n			<p>Username: [MEMBER_USERNAME]</p>\r\n\r\n			<p>Password: [MEMBER_PASSWORD]</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>C&oacute; phải bạn thắc mắc?</b></h3>\r\n\r\n			<p>Li&ecirc;n hệ hotline [COMPANY_HOTLINE] của ch&uacute;ng t&ocirc;i hoặc gửi email đến h&ograve;m thư [COMPANY_EMAIL] (8-21h both T7, CN), đội ngũ [COMPANY_BRANDNAME] sẽ hỗ trợ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] một lần nữa cảm ơn bạn.</p>\r\n\r\n			<p><span style=\"color:#FF0000;\"><span style=\"font-size: 12px;\"><em>Đ&acirc;y l&agrave; hộp thư tự động, vui l&ograve;ng kh&ocirc;ng trả lời email n&agrave;y.</em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'account_info', 'email', 'vn', 1, '', 29, 0, 0),
(30, '[Member] Email - Thông báo thông tin tài khoản thành viên', 'Notice of member account information: [MEMBER_FULLNAME]', '<div style=\"color:rgb(32,32,32);font-size:14px;\">\r\n<div style=\"max-width: 750px;margin: auto;border-top: 10px solid #f0f0f0;border-left: 10px solid #f0f0f0;border-right: 10px solid #f0f0f0;\">\r\n<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"max-width:750px\" width=\"100%\">\r\n	<tbody>\r\n		<tr>\r\n			<td>\r\n			<div style=\"text-align:center; padding-top: 30px;\">[COMPANY_LOGO]</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<div style=\"text-align:center;color: #0f146d;padding: 0 15px 30px 15px;font-size: 23px;\">Notice of member account information</div>\r\n\r\n			<h3 style=\"margin-top: 0;\">Dear [MEMBER_FULLNAME],</h3>\r\n\r\n			<p>[COMPANY_BRANDNAME] sends you member information at our website:</p>\r\n\r\n			<p>Username: [MEMBER_USERNAME]</p>\r\n\r\n			<p>Password: [MEMBER_PASSWORD]</p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n		<tr>\r\n			<td>\r\n			<div style=\"border-bottom: 10px solid #f0f0f0;padding: 30px;\">\r\n			<h3 style=\"margin-top: 0;\"><b>Are you wondering?</b></h3>\r\n\r\n			<p>Contact our hotline [COMPANY_HOTLINE] or send an email to the mailbox [COMPANY_EMAIL] (8-9pm both Saturday and Sunday), the [COMPANY_BRANDNAME] team will support you at any time.</p>\r\n\r\n			<p>[COMPANY_BRANDNAME] thank you again.</p>\r\n\r\n			<p><span style=\"color:#FF0000;\"><span style=\"font-size: 12px;\"><em>This is an automated mailbox, please do not reply to this email.</em></span></span></p>\r\n			</div>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n</div>\r\n</div>\r\n', 'account_info', 'email', 'en', 1, '', 30, 0, 0),
(31, '[Member] Email - Thông báo đăng ký tài khoản thành công', 'Chúc mừng bạn đã đăng ký thành công tài khoản của mình tại [COMPANY_BRANDNAME]', '<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid rgb(204, 204, 204);  width:90%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align: center;\">[LOGO]</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"1\">\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<p>Ch&agrave;o mừng <strong>[MEMBER_FULLNAME] </strong>đến với [BRAND_NAME].</p>\r\n\r\n						<p>T&agrave;i khoản của bạn đ&atilde; được đăng k&yacute; th&agrave;nh c&ocirc;ng. ạn c&oacute; thể bắt đầu sử dụng t&agrave;i khoản của m&igrave;nh bằng c&aacute;ch nhấp v&agrave;o li&ecirc;n kết dưới đ&acirc;y v&agrave; nhập th&ocirc;ng tin t&agrave;i khoản của bạn:</p>\r\n\r\n						<p>Trang đăng nhập: <a href=\"[LOGIN_URL]\">[LOGIN_URL]</a></p>\r\n\r\n						<div>User ID: <strong>[MEMBER_EMAIL]</strong></div>\r\n\r\n						<div>Password: <strong>[MEMBER_PASSWORD]</strong></div>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<p>Tr&ecirc;n trang t&agrave;i khoản n&agrave;y, bạn c&oacute; thể quản l&yacute; th&ocirc;ng tin c&aacute; nh&acirc;n, xem lại h&oacute;a đơn dịch vụ, lịch sử thanh to&aacute;n của bạn .</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<p>Tr&acirc;n trọng,</p>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<p>Bạn cần hỗ trợ ngay b&acirc;y giờ? Chỉ cần gửi một email đến [SUPPORT_EMAIL] (8-21h cả T7, CN). Đội ngũ hỗ trợ của [BRAND_NAME] sẵn s&agrave;ng gi&uacute;p đỡ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n						<h3 style=\"color: rgb(70, 70, 70); font-family: Arial;\"><span style=\"font-size:12px;\">[BRAND_NAME]</span></h3>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td colspan=\"1\"><span style=\"color:#FF0000;\"><span style=\"font-size: 12px;\"><em>Đ&acirc;y l&agrave; hộp thư tự động, vui l&ograve;ng kh&ocirc;ng trả lời email n&agrave;y.</em></span></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'active_account', 'email', 'vn', 1, '', 31, 0, 0),
(32, '[Member] Email - Thông báo đăng ký tài khoản thành công', 'Congratulations on successfully registering your account at [COMPANY_BRANDNAME]', '<table align=\"center\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"border:1px solid rgb(204, 204, 204);  width:90%\">\r\n	<tbody>\r\n		<tr>\r\n			<td style=\"text-align: center;\">[LOGO]</td>\r\n		</tr>\r\n		<tr>\r\n			<td colspan=\"1\">\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<p>Ch&agrave;o mừng <strong>[MEMBER_FULLNAME] </strong>đến với [BRAND_NAME].</p>\r\n\r\n						<p>T&agrave;i khoản của bạn đ&atilde; được đăng k&yacute; th&agrave;nh c&ocirc;ng. ạn c&oacute; thể bắt đầu sử dụng t&agrave;i khoản của m&igrave;nh bằng c&aacute;ch nhấp v&agrave;o li&ecirc;n kết dưới đ&acirc;y v&agrave; nhập th&ocirc;ng tin t&agrave;i khoản của bạn:</p>\r\n\r\n						<p>Trang đăng nhập: <a href=\"[LOGIN_URL]\">[LOGIN_URL]</a></p>\r\n\r\n						<div>User ID: <strong>[MEMBER_EMAIL]</strong></div>\r\n\r\n						<div>Password: <strong>[MEMBER_PASSWORD]</strong></div>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td>\r\n						<p>Tr&ecirc;n trang t&agrave;i khoản n&agrave;y, bạn c&oacute; thể quản l&yacute; th&ocirc;ng tin c&aacute; nh&acirc;n, xem lại h&oacute;a đơn dịch vụ, lịch sử thanh to&aacute;n của bạn .</p>\r\n						</td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n\r\n			<p>Tr&acirc;n trọng,</p>\r\n\r\n			<table border=\"0\" cellpadding=\"0\" cellspacing=\"0\" style=\"width:100%\">\r\n				<tbody>\r\n					<tr>\r\n						<td>\r\n						<p>Bạn cần hỗ trợ ngay b&acirc;y giờ? Chỉ cần gửi một email đến [SUPPORT_EMAIL] (8-21h cả T7, CN). Đội ngũ hỗ trợ của [BRAND_NAME] sẵn s&agrave;ng gi&uacute;p đỡ bạn bất cứ l&uacute;c n&agrave;o.</p>\r\n\r\n						<h3 style=\"color: rgb(70, 70, 70); font-family: Arial;\"><span style=\"font-size:12px;\">[BRAND_NAME]</span></h3>\r\n						</td>\r\n					</tr>\r\n					<tr>\r\n						<td colspan=\"1\"><span style=\"color:#FF0000;\"><span style=\"font-size: 12px;\"><em>Đ&acirc;y l&agrave; hộp thư tự động, vui l&ograve;ng kh&ocirc;ng trả lời email n&agrave;y.</em></span></span></td>\r\n					</tr>\r\n				</tbody>\r\n			</table>\r\n			</td>\r\n		</tr>\r\n	</tbody>\r\n</table>\r\n', 'active_account', 'email', 'en', 1, '', 32, 0, 0),
(33, 'Thông báo đăng ký tài khoản thành công', '', '<h4>Cám ơn bạn đã đăng kí thành công tài khoản tại [BRAND_NAME]!</h4>\n\n\n\n<p>Để được hỗ trợ trực tiếp xin liên hệ [BRAND_NAME] qua số điện thoại&nbsp;<span><em><span style=\"line-height: 16px;\">[HOTLINE]</span></em></span> (7-22h cả T7,CN) hoặc Email:<span><em><span style=\"line-height: 16px;\"> [SUPPORT_EMAIL]</span></em></span></p>\n\n\n\n<p style=\"\">Bạn cần được hỗ trợ ngay? Chỉ cần email <span><em><span style=\"line-height: 16px;\">[SUPPORT_EMAIL]</span></em></span>, hoặc gọi số điện thoại <span><em><span style=\"line-height: 16px;\">[HOTLINE]</span></em></span> (8-21h cả T7,CN). Đội ngũ <span>[BRAND_NAME]</span> luôn sẵn sàng hỗ trợ bạn bất kì lúc nào.</p>\n\n\n\n<p>[BRAND_NAME]</p>\n\n\n\n<p>&nbsp;</p>\n\n\n\n<p>&nbsp;</p>\n\n', 'signup_success', 'template', 'vn', 1, '', 56, 0, 0),
(34, '[Member] Email xác nhận thay đổi mật khẩu', 'Thông báo thay đổi mật khẩu tại [SITE_NAME]', '<p>[MEMBER_FULLNAME] thân mếm,</p>\n\n\n\n<p>Bạn đã thực hiện chức năng thay đổi mật khẩu tại [BRAND_NAME]</p>\n\n\n\n<p>Vui lòng bấm vào đường dẫn dưới đây:</p>\n\n\n\n<p>Path: <a href=\"[PATH]\">[PATH]</a></p>\n\n\n\n<p>Chúc bạn có những trải nghiệm thú vị với [BRAND_NAME].</p>\n\n\n\n<p>Bạn cần hỗ trợ ngay bây giờ? Chỉ cần gửi một email đến [SUPPORT_EMAIL] (8-21h cả T7, CN). Đội ngũ hỗ trợ của [BRAND_NAME] sẵn sàng giúp đỡ bạn bất cứ lúc nào.<br />\n\n&nbsp;</p>\n\n\n\n<p>[BRAND_NAME]</p>\n\n\n\n<p><span style=\"color:#FF0000;\"><span style=\"font-size: 12px;\"><em>Đây là hộp thư tự động, vui lòng không trả lời email này.</em></span></span></p>\n\n', 'confirm_change_pass', 'email', 'vn', 1, '', 57, 0, 0),
(35, 'Thông báo yêu cầu thay đổi mật khẩu', '', '<p>Xin chào quý khách,</p>\n\n\n\n<p>Chúng tôi vừa gửi link khởi tạo mật khẩu mới qua email của bạn. Vui lòng kiểm tra email để cập nhật thông tin.</p>\n\n\n\n<p>Thân,</p>\n\n\n\n<p>[BRAND_NAME]</p>\n\n', 'forgotpw', 'template', 'vn', 1, '', 50, 0, 0),
(36, 'Account registration successful', '', '<h4>Thank you successfully register an account at [BRAND_NAME]!</h4>\n\n\n\n<p>For assistance, please contact directly [BRAND_NAME] by phone number <span><em><span style=\"line-height: 16px;\">[HOTLINE]</span></em></span> (7-22h both T7,CN) or via email:<span><em><span style=\"line-height: 16px;\"> [SUPPORT_EMAIL]</span></em></span></p>\n\n\n\n<p style=\"\">You need support right now? Just send an email <span><em><span style=\"line-height: 16px;\">[SUPPORT_EMAIL]</span></em></span>, or call toll <span><em><span style=\"line-height: 16px;\">[HOTLINE]</span></em></span> (8-21h both T7, CN). <span>[BRAND_NAME]</span> team always ready to assist you at any time.</p>\n\n\n\n<p style=\"\">[BRAND_NAME]</p>\n\n', 'signup_success', 'template', 'en', 0, '', 51, 0, 0),
(37, 'Notice of password change request', '', '<p>Hello Guys,</p>\n\n\n\n<p>We just sent a new password to your email. Please check your email for updates.</p>\n\n\n\n<p>Regards,</p>\n\n\n\n<p>[BRAND_NAME]</p>\n\n', 'forgotpw', 'template', 'en', 0, '', 52, 0, 0),
(38, '[Thành viên] Biểu mẫu Mail chứng thực việc thay đổi mật khẩu', '', '', 'confirm_change_pass', 'email', 'en', 0, '', 55, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `tblunit`
--

CREATE TABLE `tblunit` (
  `ID` int(9) NOT NULL,
  `title_vn` varchar(50) NOT NULL,
  `title_en` varchar(50) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `t_index` int(5) NOT NULL DEFAULT 0,
  `created_date` int(20) NOT NULL,
  `created_by` varchar(20) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` varchar(20) NOT NULL,
  `lang` varchar(2) NOT NULL DEFAULT 'vn'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblunit`
--

INSERT INTO `tblunit` (`ID`, `title_vn`, `title_en`, `t_status`, `t_index`, `created_date`, `created_by`, `updated_date`, `updated_by`, `lang`) VALUES
(1, 'Gói', 'Package', 1, 1, 1706000694, 'admin', 1711341316, '1', 'vn'),
(4, 'Lít', 'Liter', 1, 2, 1706001817, 'admin', 1706001817, 'admin', 'vn'),
(5, 'Kg', 'Kg', 1, 3, 1706001823, 'admin', 1706001823, 'admin', 'vn'),
(6, 'Hộp', 'Box', 1, 4, 1711341330, '1', 1711341330, '1', 'vn'),
(7, 'Chai', 'Bottle', 1, 5, 1711342251, '1', 1711342251, '1', 'vn');

-- --------------------------------------------------------

--
-- Table structure for table `tblwebmaster`
--

CREATE TABLE `tblwebmaster` (
  `ID` tinyint(3) NOT NULL,
  `username` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `password` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `fullname` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `email` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `level` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT 'admin' COMMENT 'root, admin, staff',
  `t_status` tinyint(1) DEFAULT 1,
  `module_access` text CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `permit_access` varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `salt` varchar(10) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `avatar` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `created_date` int(15) NOT NULL,
  `created_by` tinyint(3) NOT NULL,
  `updated_date` int(15) NOT NULL,
  `updated_by` tinyint(3) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tblwebmaster`
--

INSERT INTO `tblwebmaster` (`ID`, `username`, `password`, `fullname`, `phone`, `email`, `address`, `level`, `t_status`, `module_access`, `permit_access`, `salt`, `avatar`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'admin', '194685ae20e13ebf9c234492c7939635', 'Snower', '', 'minhnhat@redsun.vn', '', 'root', 1, 'ALL', 'F', 'krmP', '', 1681465013, 1, 1681723082, 1),
(2, 'minhnhat', 'c2bf6cbc8f0f2862823c9c41d566d16c', 'Redsun Support', '02873015630 (ext: 5)', 'nhungho@redsun.vn', '', 'admin', 1, 'ALL', 'F', 'UxMH', '', 1681465013, 1, 1689214219, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblwidget`
--

CREATE TABLE `tblwidget` (
  `ID` int(9) NOT NULL,
  `module_code` varchar(20) NOT NULL,
  `w_code` varchar(50) NOT NULL,
  `w_type` varchar(20) NOT NULL,
  `w_name` varchar(255) NOT NULL,
  `w_max_item` int(4) NOT NULL DEFAULT 0,
  `w_filter_sql` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `intro` text NOT NULL,
  `content` text NOT NULL,
  `imgURL` varchar(255) NOT NULL,
  `imgURL_bg` varchar(255) NOT NULL,
  `link_1` varchar(255) NOT NULL,
  `link_2` varchar(255) NOT NULL,
  `item_id` varchar(255) NOT NULL,
  `t_status` int(1) NOT NULL DEFAULT 1,
  `t_index` int(9) NOT NULL,
  `lang` varchar(3) NOT NULL DEFAULT 'vn',
  `created_date` int(20) NOT NULL,
  `created_by` int(9) NOT NULL,
  `updated_date` int(20) NOT NULL,
  `updated_by` int(9) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `tblwidget`
--

INSERT INTO `tblwidget` (`ID`, `module_code`, `w_code`, `w_type`, `w_name`, `w_max_item`, `w_filter_sql`, `title`, `position`, `intro`, `content`, `imgURL`, `imgURL_bg`, `link_1`, `link_2`, `item_id`, `t_status`, `t_index`, `lang`, `created_date`, `created_by`, `updated_date`, `updated_by`) VALUES
(1, 'RSCMS', '_NEWS', 'object', '[VN] - Tin tức nè', 5, 'and type_art=&#039;news&#039;', 'Tin mới nhất', 'Trang chủ', 'Tin tức trong ngày', '&amp;lt;p&amp;gt;Nội dung chưa có &amp;lt;span style=&amp;quot;color:red;&amp;quot;&amp;gt;&amp;lt;strong&amp;gt;CKEditor&amp;lt;/strong&amp;gt;&amp;lt;/span&amp;gt;&amp;lt;/p&amp;gt;', 'resources/upload/widget/1/banner-1.jpg', 'resources/upload/widget/1/bg/banner-2.jpg', 'http://localhost/tuyetshop.net/html', 'http://localhost/tuyetshop.net/web', '5@6@7@4', 1, 0, 'vn', 1721812524, 1, 1721901868, 1),
(2, 'RSCMS', '_CATES', 'category', 'Danh mục', 3, '', '', 'menu trái', '', '', '', '', '', '', '', 1, 2, 'vn', 1721901894, 1, 1721901906, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin_note`
--
ALTER TABLE `tbladmin_note`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbanner`
--
ALTER TABLE `tblbanner`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbanner_group`
--
ALTER TABLE `tblbanner_group`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbranch`
--
ALTER TABLE `tblbranch`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbrand`
--
ALTER TABLE `tblbrand`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcolor`
--
ALTER TABLE `tblcolor`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcompany`
--
ALTER TABLE `tblcompany`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblconfig`
--
ALTER TABLE `tblconfig`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontact_form`
--
ALTER TABLE `tblcontact_form`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontent`
--
ALTER TABLE `tblcontent`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldeliverymethod`
--
ALTER TABLE `tbldeliverymethod`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbllibrary`
--
ALTER TABLE `tbllibrary`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorder`
--
ALTER TABLE `tblorder`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorder_buyer`
--
ALTER TABLE `tblorder_buyer`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorder_detail`
--
ALTER TABLE `tblorder_detail`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorder_note`
--
ALTER TABLE `tblorder_note`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblorder_receiver`
--
ALTER TABLE `tblorder_receiver`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpaymentmethod`
--
ALTER TABLE `tblpaymentmethod`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblproduct`
--
ALTER TABLE `tblproduct`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblproduct_price`
--
ALTER TABLE `tblproduct_price`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblseo`
--
ALTER TABLE `tblseo`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblsize`
--
ALTER TABLE `tblsize`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbltemplate`
--
ALTER TABLE `tbltemplate`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblunit`
--
ALTER TABLE `tblunit`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwebmaster`
--
ALTER TABLE `tblwebmaster`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblwidget`
--
ALTER TABLE `tblwidget`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin_note`
--
ALTER TABLE `tbladmin_note`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblbanner`
--
ALTER TABLE `tblbanner`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `tblbanner_group`
--
ALTER TABLE `tblbanner_group`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblbranch`
--
ALTER TABLE `tblbranch`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblbrand`
--
ALTER TABLE `tblbrand`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tblcolor`
--
ALTER TABLE `tblcolor`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcompany`
--
ALTER TABLE `tblcompany`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblconfig`
--
ALTER TABLE `tblconfig`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `tblcontact_form`
--
ALTER TABLE `tblcontact_form`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tblcontent`
--
ALTER TABLE `tblcontent`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tbldeliverymethod`
--
ALTER TABLE `tbldeliverymethod`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbllibrary`
--
ALTER TABLE `tbllibrary`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `tblorder`
--
ALTER TABLE `tblorder`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblorder_buyer`
--
ALTER TABLE `tblorder_buyer`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblorder_detail`
--
ALTER TABLE `tblorder_detail`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `tblorder_note`
--
ALTER TABLE `tblorder_note`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblorder_receiver`
--
ALTER TABLE `tblorder_receiver`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblpaymentmethod`
--
ALTER TABLE `tblpaymentmethod`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblproduct`
--
ALTER TABLE `tblproduct`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblproduct_price`
--
ALTER TABLE `tblproduct_price`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblseo`
--
ALTER TABLE `tblseo`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `tblsize`
--
ALTER TABLE `tblsize`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbltemplate`
--
ALTER TABLE `tbltemplate`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `tblunit`
--
ALTER TABLE `tblunit`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tblwebmaster`
--
ALTER TABLE `tblwebmaster`
  MODIFY `ID` tinyint(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tblwidget`
--
ALTER TABLE `tblwidget`
  MODIFY `ID` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

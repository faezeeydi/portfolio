-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 20, 2023 at 12:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_shop`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `AdminLogin` (IN `email` VARCHAR(255), IN `pass` VARCHAR(255))   BEGIN
select count(*) as count from admin where a_email=email AND a_password=pass;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `alldiscounts` ()   BEGIN
SELECT * FROM product WHERE p_discount != 0 ORDER BY p_id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `allproducts` ()   BEGIN
SELECT  p_id,p_title,p_price,p_discount,p_image FROM product ORDER BY p_id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `category` ()   BEGIN
SELECT c_id , c_name FROM category;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckCart` (IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
SELECT COUNT(*) AS rowcount FROM cart WHERE p_id=id AND u_ip=ip ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckTotal` (IN `ip` VARCHAR(255))   BEGIN
SELECT count(*) as count FROM total WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckUser` (IN `email` VARCHAR(100))   BEGIN
SELECT count(*) AS count FROM user WHERE u_email=email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CheckWhishlist` (IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
SELECT COUNT(*) AS rowcount FROM whishlist WHERE p_id=id AND u_ip=ip ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `comments` ()   SELECT * FROM comment$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ConfirmUser` (IN `ip` VARCHAR(255))   BEGIN
SELECT * FROM user WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `CountComment` (IN `id` INT)   BEGIN
SELECT COUNT(*) AS count FROM comment WHERE p_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteAccount` (IN `email` VARCHAR(100))   BEGIN
DELETE FROM user WHERE u_email=email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteCart` (IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
DELETE FROM cart WHERE p_id=id AND u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteCartuser` (IN `ip` VARCHAR(255))   BEGIN
DELETE FROM cart WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteCategory` (IN `id` INT(10))   BEGIN
DELETE FROM category WHERE c_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteComment` (IN `id` INT)   BEGIN
DELETE FROM comment WHERE com_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteOrdercat` (IN `id` INT(10))   BEGIN
DELETE FROM order_cat WHERE o_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteProduct` (IN `id` INT)   BEGIN
DELETE FROM product WHERE p_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteUser` (IN `id` INT(10))   BEGIN
DELETE FROM user WHERE u_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `DeleteWhishlist` (IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
DELETE FROM whishlist WHERE p_id=id AND u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `getDiscounts` ()   BEGIN
SELECT * FROM product where p_discount != 0  LIMIT 4 ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCart` (IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
INSERT INTO cart (p_id , u_ip , qty) VALUES (id,ip,1) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertCategory` (IN `name` TEXT)   BEGIN
INSERT INTO category(c_name,a_id) VALUES (name,1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertComment` (IN `name` CHAR(100), IN `email` VARCHAR(100), IN `com_text` TEXT, IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
INSERT INTO comment (com_name , com_email , com_text , com_status , p_id , u_ip , a_id) VALUES (name, email, com_text, 0, id, ip,1) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertOrder` (IN `total` DECIMAL, IN `email` VARCHAR(100))   BEGIN
INSERT INTO u_order (total_price,order_status,u_email) VALUES (total,"false",email);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertOrdercat` (IN `name` TEXT, IN `id` INT(10))   BEGIN
INSERT INTO order_cat(o_name , c_id , a_id) VALUES (name,id,1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertProduct` (IN `title` VARCHAR(255), IN `price` TEXT, IN `discount` TEXT, IN `description` TEXT, IN `image` TEXT, IN `id` INT(10))   BEGIN
INSERT INTO product (p_title, p_price, p_discount, p_description, p_image,o_id,a_id) VALUES (title , price , discount , description, image ,id,1);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertTotal` (IN `ip` VARCHAR(255), IN `price` DECIMAL)   BEGIN
INSERT INTO total (u_ip,total_price)VALUES(ip,price);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertUser` (IN `ip` VARCHAR(255), IN `name` CHAR(30), IN `lastname` CHAR(50), IN `email` VARCHAR(100), IN `pass` VARCHAR(100), IN `province` TEXT, IN `city` TEXT, IN `address` VARCHAR(255), IN `phone` VARCHAR(255), IN `confirmcode` INT)   BEGIN
INSERT INTO user (u_ip,u_name,u_lastname,u_email,u_password,u_province,u_city,u_address,u_phone,u_confirmed,u_confirmcode) VALUES (ip,name,lastname,email,pass,province,city,address,phone,0,confirmcode);
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `InsertWhishlist` (IN `id` INT, IN `ip` VARCHAR(255))   BEGIN
INSERT INTO whishlist (p_id , u_ip) VALUES (id,ip) ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NewestCategories` (IN `name` TEXT)   BEGIN
SELECT p_id,p_title,p_price,p_discount,p_image FROM category JOIN order_cat on category.c_id=order_cat.c_id JOIN product ON order_cat.o_id=product.o_id WHERE c_name=name ORDER BY p_id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NewestCategory` (IN `name` TEXT)   BEGIN
SELECT p_id,p_title,p_price,p_discount,p_image FROM order_cat JOIN product ON order_cat.o_id=product.o_id WHERE o_name=name ORDER BY p_id DESC;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `NewProducts` ()   BEGIN
SELECT p_id,p_title,p_price,p_discount,p_image FROM product ORDER BY p_id DESC LIMIT 4 ; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `OrderCat` (IN `id` INT(10))   BEGIN
SELECT o_id, o_name FROM order_cat WHERE c_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `ordercategory` ()   BEGIN
SELECT * FROM order_cat JOIN category ON category.c_id=order_cat.c_id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `orders` ()   BEGIN
SELECT * FROM u_order;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `order_id` (IN `email` VARCHAR(100))   BEGIN
SELECT order_id FROM u_order where u_email=email ORDER BY order_id DESC limit 1 ; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `payments` ()   BEGIN
SELECT * FROM u_order NATURAL JOIN user WHERE order_status="true";
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `pay_cart` (IN `ip` VARCHAR(255))   BEGIN
INSERT INTO pay_cart (p_id, u_ip, qty)
SELECT p_id, u_ip, qty FROM cart
WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `product` (IN `id` INT)   BEGIN
SELECT p_id,p_title,p_price,p_discount,p_description,p_image,c_name,o_name FROM category JOIN order_cat on category.c_id=order_cat.c_id JOIN product ON order_cat.o_id=product.o_id where p_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `QtyCart` (IN `ip` VARCHAR(255))   BEGIN
SELECT sum(qty) AS total FROM cart WHERE u_ip=ip; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `QtyWhishlist` (IN `ip` VARCHAR(255))   BEGIN
SELECT COUNT(*) AS total FROM whishlist WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SearchQuery` (IN `query` VARCHAR(255))   BEGIN
SELECT * FROM product WHERE p_title LIKE query ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SearchUser` (IN `email` VARCHAR(100), IN `pass` VARCHAR(100))   BEGIN
select count(*) AS count from user where u_email=email AND u_password=pass; 
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `SelectUser` (IN `email` VARCHAR(100))   BEGIN
select * from user where u_email=email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showcategory` (IN `id` INT(10))   BEGIN
SELECT * FROM category WHERE c_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showComment` (IN `id` INT)   BEGIN
SELECT * FROM comment WHERE p_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showordercat` (IN `id` INT)   BEGIN
SELECT * FROM order_cat WHERE o_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `showproduct` (IN `id` INT)   BEGIN
SELECT * FROM product WHERE p_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `time_pay_cart` (IN `ip` VARCHAR(255))   BEGIN
select * from pay_cart where u_ip=ip order by pay_id desc limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `time_pay_order` (IN `id` INT)   BEGIN
select * from pay_cart where order_id=id order by pay_id desc limit 1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `TotalPrice` (IN `ip` VARCHAR(255))   BEGIN
SELECT total_price FROM total WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCart` (IN `id` INT, IN `ip` VARCHAR(255), IN `q` VARCHAR(255))   BEGIN
update cart set qty=q where p_id=id AND u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateCategory` (IN `id` INT(10), IN `name` TEXT)   BEGIN
UPDATE category SET c_name=name WHERE c_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateComment` (IN `id` INT)   BEGIN
UPDATE comment SET com_status=1 WHERE com_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateOrder` (IN `id` INT, IN `au` VARCHAR(100), IN `ref` VARCHAR(20))   BEGIN
UPDATE u_order SET order_status="true" , authority=au , refid=ref  WHERE order_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateOrdercat` (IN `id1` INT(10), IN `name` TEXT, IN `id2` INT(10))   BEGIN
UPDATE order_cat SET o_name=name , c_id=id2 WHERE o_id=id1;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePass` (IN `email` VARCHAR(100), IN `pass` VARCHAR(100))   BEGIN
UPDATE user SET u_password=pass WHERE u_email=email;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePaycart` (IN `tim` TIMESTAMP, IN `id` INT)   BEGIN
UPDATE pay_cart SET order_id=id WHERE order_time=tim;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdatePro` (IN `id1` INT, IN `title` VARCHAR(255), IN `price` TEXT, IN `discount` TEXT, IN `description` TEXT, IN `id2` INT(10))   BEGIN
UPDATE product SET p_title=title , p_price=price , p_discount=discount , p_description=description , o_id=id2 WHERE p_id=id1 ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProduct` (IN `id1` INT, IN `title` VARCHAR(255), IN `price` TEXT, IN `discount` TEXT, IN `description` TEXT, IN `image` TEXT, IN `id2` INT(10))   BEGIN
UPDATE product SET p_title=title , p_price=price , p_discount=discount , p_description=description , p_image=image , o_id=id2 WHERE p_id=id1 ;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateProfile` (IN `id` INT(10), IN `name` VARCHAR(30), IN `lastname` VARCHAR(50), IN `province` TEXT, IN `city` TEXT, IN `address` VARCHAR(255), IN `phone` VARCHAR(255), IN `image` TEXT)   BEGIN
UPDATE user SET u_name=name , u_lastname=lastname , u_province=province , u_city=city , u_address=address , u_phone=phone , u_image=image WHERE u_id=id;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateQty` (IN `id` INT, IN `ip` VARCHAR(255), IN `q` INT)   BEGIN
UPDATE cart SET qty=qty+q WHERE p_id=id AND u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateTotal` (IN `ip` VARCHAR(255), IN `price` DECIMAL)   BEGIN
update total set total_price=price WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UpdateUser` (IN `ip` VARCHAR(255))   BEGIN
UPDATE user SET u_confirmed=1 , u_confirmcode=0 WHERE u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UserCart` (IN `ip` VARCHAR(255))   BEGIN
SELECT p_id, p_title, p_price, p_discount, qty, p_image FROM product NATURAL JOIN cart  where u_ip=ip;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UserPaycart` (IN `id` INT)   BEGIN
SELECT p_id, p_title, p_price, p_discount, qty, p_image FROM product NATURAL JOIN pay_cart  where order_id=id;

END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `users` ()   BEGIN
SELECT * FROM user;
END$$

CREATE DEFINER=`root`@`localhost` PROCEDURE `UserWhishlist` (IN `ip` VARCHAR(255))   BEGIN
SELECT p_id, p_title, p_price, p_discount, p_image FROM product NATURAL JOIN whishlist  where u_ip=ip;
END$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `a_id` int(10) NOT NULL,
  `a_name` char(30) NOT NULL,
  `a_lastname` char(50) NOT NULL,
  `a_email` varchar(100) NOT NULL,
  `a_password` varchar(100) NOT NULL,
  `a_phone` varchar(255) NOT NULL,
  `a_image` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`a_id`, `a_name`, `a_lastname`, `a_email`, `a_password`, `a_phone`, `a_image`) VALUES
(1, 'فائزه', 'عیدی', 'eydi.faezeh79@gmail.com', '9731001379', '09905401138', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `cart_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_ip` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `c_id` int(10) NOT NULL,
  `c_name` text NOT NULL,
  `a_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`c_id`, `c_name`, `a_id`) VALUES
(1, 'زرشک', 1),
(2, 'زعفران', 1),
(9, 'خشکبار', 1);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `com_id` int(11) NOT NULL,
  `com_name` char(100) NOT NULL,
  `com_email` varchar(100) NOT NULL,
  `com_text` text NOT NULL,
  `com_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `com_status` int(11) NOT NULL DEFAULT 0,
  `p_id` int(11) NOT NULL,
  `u_ip` varchar(255) NOT NULL,
  `a_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`com_id`, `com_name`, `com_email`, `com_text`, `com_date`, `com_status`, `p_id`, `u_ip`, `a_id`) VALUES
(11, 'فائزه عیدی', 'eydi.faezeh79@gmail.com', 'این محصول خیلی با کیفیته، پیشنهاد میکنم حتما از این محصول خریداری کنید!', '2023-10-19 13:23:49', 1, 23, '::1', 1),
(12, 'فائزه عیدی', 'eydi.faezeh79@gmail.com', 'این زعفرون خوش عطر و خوش رنگه، توصیه میکنم حتما امتحانش کنید.', '2023-10-19 13:23:38', 0, 14, '::1', 1);

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `con_id` int(11) NOT NULL,
  `con_name` char(100) NOT NULL,
  `con_phone` varchar(255) NOT NULL,
  `con_email` varchar(100) NOT NULL,
  `con_title` text NOT NULL,
  `con_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_cat`
--

CREATE TABLE `order_cat` (
  `o_id` int(10) NOT NULL,
  `o_name` text NOT NULL,
  `c_id` int(10) NOT NULL,
  `a_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `order_cat`
--

INSERT INTO `order_cat` (`o_id`, `o_name`, `c_id`, `a_id`) VALUES
(1, 'دانه اناری', 1, 1),
(2, 'پفکی', 1, 1),
(3, 'نگین', 2, 1),
(4, 'سرگل', 2, 1),
(5, 'دخترپیچ', 2, 1),
(6, 'ریشه زعفران', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `pay_cart`
--

CREATE TABLE `pay_cart` (
  `pay_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_ip` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `order_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `pay_cart`
--

INSERT INTO `pay_cart` (`pay_id`, `p_id`, `u_ip`, `qty`, `order_time`, `order_id`) VALUES
(28, 24, '::1', 1, '2023-10-17 04:15:32', 77),
(29, 20, '::1', 1, '2023-10-17 04:16:23', 78),
(30, 24, '::1', 1, '2023-10-17 04:17:20', 79),
(31, 8, '::1', 3, '2023-10-17 08:14:41', 80),
(32, 23, '::1', 1, '2023-10-18 03:36:13', 81),
(33, 20, '::1', 1, '2023-10-18 03:36:13', 81),
(34, 24, '::1', 1, '2023-10-18 03:36:13', 81),
(35, 18, '::1', 1, '2023-10-18 03:37:30', 83),
(36, 15, '::1', 1, '2023-10-18 03:37:30', 83),
(38, 19, '::1', 1, '2023-10-18 03:38:11', 0),
(39, 9, '::1', 1, '2023-10-18 03:38:11', 0),
(41, 9, '::1', 1, '2023-10-18 03:49:57', 89),
(42, 8, '::1', 1, '2023-10-18 03:49:57', 89),
(44, 7, '::1', 1, '2023-10-18 03:50:39', 90),
(45, 22, '::1', 1, '2023-10-18 03:50:39', 90),
(47, 24, '::1', 2, '2023-10-18 05:54:39', 91),
(48, 22, '::1', 1, '2023-10-18 06:07:05', 92),
(49, 23, '::1', 3, '2023-10-19 13:31:59', 93),
(50, 24, '::1', 1, '2023-10-19 13:31:59', 93),
(51, 22, '::1', 1, '2023-10-19 13:31:59', 93);

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `p_id` int(11) NOT NULL,
  `p_title` varchar(255) NOT NULL,
  `p_price` text NOT NULL,
  `p_discount` text NOT NULL,
  `p_description` text NOT NULL,
  `p_image` text NOT NULL,
  `p_date` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `o_id` int(10) NOT NULL,
  `a_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`p_id`, `p_title`, `p_price`, `p_discount`, `p_description`, `p_image`, `p_date`, `o_id`, `a_id`) VALUES
(6, 'ریشه زعفران اصل قائنات – 1 کیلویی', '6,000,000', '5,495,000', 'وزن خالص ریشه زعفران: 1050 گرم', 'ریشه-سفید-زعفران.jpg', '2023-09-16 18:13:45', 6, 1),
(7, 'ریشه زعفران – 20 مثقالی – خاتم', '850,000', '595,000', 'وزن خالص ریشه زعفران: 92 گرم', 'ریشه-زعفران-20-مثقالی-خاتم.jpg', '2023-09-16 18:13:32', 6, 1),
(8, 'ریشه زعفران اعلاء (5 مثقال)', '232,000', '185,000', 'وزن: 50 گرم', 'ریشه-زعفران-اعلاء-(5 مثقال).jpg', '2023-09-16 18:13:20', 6, 1),
(9, 'زرشک پفکی درجه 1 قائنات (1 کیلویی)', '259,000', '215,000', 'وزن خالص زرشک: 1000 گرم', 'زرشک-پفکی-درجه-1-قائنات-(1 کیلویی).jpg', '2023-09-16 18:13:06', 2, 1),
(10, 'زعفران نگین قائنات (1 کیلو)', '47,500,000', '', 'وزن: 1000 گرم', 'زعفران-نگین-قائنات-[1 کیلو].jpg', '2023-09-16 18:12:52', 3, 1),
(11, 'زعفران سرگل قائنات (1 کیلو)', '46,800,000', '', 'وزن: 1000 گرم', 'زعفران-سرگل-قائنات-[ 1 کیلو ].jpg', '2023-09-16 06:59:21', 4, 1),
(14, 'زعفران سرگل قائنات – 100 گرم – خاتم', '5,980,000 ', '5,220,000 ', 'وزن خالص زعفران: 100 گرم', 'زعفران-سرگل-قائنات-100-گرم-خاتم.jpg', '2023-09-16 07:05:17', 4, 1),
(15, 'زرشک پفکی اعلا قائنات (نیم کیلو)', '149,000', '129,000', 'وزن: 500 گرم', 'زرشک-پفکی-اعلا-قائنات-(نیم کیلو).jpg', '2023-09-16 07:05:17', 2, 1),
(16, 'زعفران سرگل قائنات – 1 مثقالی – بسته‌بندی خاتم', '385,000', '315,000', 'وزن با بسته بندی: 25 گرم', 'زعفران-سرگل-قائنات-1-مثقالی-بسته‌بندی-خاتم.jpg', '2023-09-16 07:16:02', 4, 1),
(17, 'زعفران دسته (دختر پیچ) قائنات (1 کیلو)', '38,000,000', '', 'وزن: 1000 گرم', 'زعفران-دسته-(دختر پیچ)-قائنات-[ 1 کیلو ].jpg', '2023-09-16 07:23:03', 5, 1),
(18, 'زعفران دسته (دختر پیچ) – 1 مثقالی – بسته پاکتی', '249,000', '225,000', 'وزن خالص زعفران: 4.6 گرم', 'زعفران-دسته-(دختر پیچ)-1-مثقالی-بسته-پاکتی.jpg', '2023-09-16 07:23:03', 5, 1),
(19, 'زرشک پفکی درجه یک – 150 گرمی', '48,000', '37,000', 'وزن خالص: 150 گرم', 'زرشک-پفکی-درجه-یک-150-گرمی.jpg', '2023-09-16 07:27:02', 2, 1),
(20, 'زعفران دسته (دختر پیچ) – 1 مثقالی – بسته‌بندی خاتم', '292,000', '239,000', 'وزن خالص زعفران: 4.6 گرم', 'زعفران-دسته-(دختر پیچ)-1-مثقالی-بسته‌بندی-خاتم.jpg', '2023-09-16 07:27:02', 5, 1),
(21, 'زعفران سرگل قائنات – 5 مثقال – بسته‌بندی خاتم', '1,850,000', '1,470,000', 'وزن خالص زعفران: 23 گرم', 'زعفران-سرگل-قائنات-5-مثقال-بسته‌بندی-خاتم.jpg', '2023-09-16 07:31:46', 4, 1),
(22, 'زعفران دختر پیچ (دسته) – 10 مثقال – خاتم', '2,650,000', '2,200,000 ', 'وزن خالص زعفران: 46 گرم', 'زعفران-دخترپیچ-(دسته)-10-مثقال-خاتم.jpg', '2023-09-16 07:31:46', 5, 1),
(23, 'زرشک دانه اناری (1 کیلویی)', '140,000', '130,000', 'وزن: 1000 گرم', 'زرشک-دانه-اناری-(1 کیلویی).jpg', '2023-09-16 07:35:05', 1, 1),
(24, 'زعفران دسته قائنات (دختر پیچ) – 5 مثقالی', '1,255,000', '1,070,000', 'وزن خالص زعفران: 23 گرم                    ', 'زعفران-دسته-قائنات-(دختر پیچ)-5-مثقالی.jpg', '2023-09-19 09:07:33', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `total`
--

CREATE TABLE `total` (
  `t_id` int(11) NOT NULL,
  `u_ip` varchar(255) NOT NULL,
  `total_price` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `total`
--

INSERT INTO `total` (`t_id`, `u_ip`, `total_price`) VALUES
(14, '::1', 2200000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `u_id` int(10) NOT NULL,
  `u_ip` varchar(255) NOT NULL,
  `u_name` char(30) NOT NULL,
  `u_lastname` char(50) NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `u_password` varchar(100) NOT NULL,
  `u_province` text NOT NULL,
  `u_city` text NOT NULL,
  `u_address` varchar(255) NOT NULL,
  `u_phone` varchar(255) NOT NULL,
  `u_image` text NOT NULL,
  `u_confirmed` int(11) NOT NULL,
  `u_confirmcode` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`u_id`, `u_ip`, `u_name`, `u_lastname`, `u_email`, `u_password`, `u_province`, `u_city`, `u_address`, `u_phone`, `u_image`, `u_confirmed`, `u_confirmcode`) VALUES
(65, '::1', 'فائزه', 'عیدی', 'eydi.faezeh79@gmail.com', 'Faeze!9797', 'خراسان جنوبی', 'قائن', 'فاز5', '09905401138', '', 0, 687299243),
(66, '89.42.101.101', 'زهرا', 'محمدی', 'zahramohammadi@gmail.com', 'Zahra*2525', 'تهران', 'تهران', 'دلاوران', '09121234567', '', 0, 453480773);

-- --------------------------------------------------------

--
-- Table structure for table `u_order`
--

CREATE TABLE `u_order` (
  `order_id` int(11) NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_price` decimal(20,0) NOT NULL,
  `order_status` text NOT NULL,
  `u_email` varchar(100) NOT NULL,
  `authority` varchar(100) NOT NULL,
  `refid` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Dumping data for table `u_order`
--

INSERT INTO `u_order` (`order_id`, `order_time`, `total_price`, `order_status`, `u_email`, `authority`, `refid`) VALUES
(80, '2023-10-17 08:13:30', 555000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001241285', '12345678'),
(81, '2023-10-18 03:36:06', 1439000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001242593', '12345678'),
(82, '2023-10-18 03:36:39', 354000, 'false', 'eydi.faezeh79@gmail.com', '', ''),
(83, '2023-10-18 03:37:25', 354000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001242595', '12345678'),
(86, '2023-10-18 03:46:02', 1470000, 'false', 'zahramohammadi@gmail.com', '', ''),
(87, '2023-10-18 03:46:14', 1470000, 'false', 'zahramohammadi@gmail.com', '', ''),
(88, '2023-10-18 03:48:56', 400000, 'false', 'eydi.faezeh79@gmail.com', '', ''),
(89, '2023-10-18 03:49:52', 400000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001242603', '12345678'),
(90, '2023-10-18 03:50:27', 2795000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001242604', '12345678'),
(91, '2023-10-18 05:54:26', 2140000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001242632', '12345678'),
(92, '2023-10-18 06:06:57', 2200000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001242642', '12345678'),
(93, '2023-10-19 13:31:38', 2200000, 'true', 'eydi.faezeh79@gmail.com', '000000000000000000000000000001244285', '12345678');

-- --------------------------------------------------------

--
-- Table structure for table `whishlist`
--

CREATE TABLE `whishlist` (
  `w_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_ip` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_persian_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`a_id`),
  ADD UNIQUE KEY `a_email` (`a_email`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`cart_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `u_ip` (`u_ip`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`c_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`com_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `a_id` (`a_id`),
  ADD KEY `u_ip` (`u_ip`);

--
-- Indexes for table `order_cat`
--
ALTER TABLE `order_cat`
  ADD PRIMARY KEY (`o_id`),
  ADD KEY `order_cat_ibfk_1` (`c_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `pay_cart`
--
ALTER TABLE `pay_cart`
  ADD PRIMARY KEY (`pay_id`),
  ADD KEY `p_id` (`p_id`),
  ADD KEY `u_ip` (`u_ip`),
  ADD KEY `o_id` (`order_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`p_id`),
  ADD KEY `o_id` (`o_id`),
  ADD KEY `a_id` (`a_id`);

--
-- Indexes for table `total`
--
ALTER TABLE `total`
  ADD PRIMARY KEY (`t_id`),
  ADD KEY `u_ip` (`u_ip`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`u_id`),
  ADD UNIQUE KEY `u_ip` (`u_ip`),
  ADD UNIQUE KEY `u_email` (`u_email`);

--
-- Indexes for table `u_order`
--
ALTER TABLE `u_order`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `u_email` (`u_email`);

--
-- Indexes for table `whishlist`
--
ALTER TABLE `whishlist`
  ADD PRIMARY KEY (`w_id`),
  ADD KEY `p_id` (`p_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `a_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `cart_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `c_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `com_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_cat`
--
ALTER TABLE `order_cat`
  MODIFY `o_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pay_cart`
--
ALTER TABLE `pay_cart`
  MODIFY `pay_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `p_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `total`
--
ALTER TABLE `total`
  MODIFY `t_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `u_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

--
-- AUTO_INCREMENT for table `u_order`
--
ALTER TABLE `u_order`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `whishlist`
--
ALTER TABLE `whishlist`
  MODIFY `w_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `category`
--
ALTER TABLE `category`
  ADD CONSTRAINT `category_ibfk_1` FOREIGN KEY (`a_id`) REFERENCES `admin` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `order_cat`
--
ALTER TABLE `order_cat`
  ADD CONSTRAINT `order_cat_ibfk_1` FOREIGN KEY (`c_id`) REFERENCES `category` (`c_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `order_cat_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `admin` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `pay_cart`
--
ALTER TABLE `pay_cart`
  ADD CONSTRAINT `pay_cart_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `pay_cart_ibfk_2` FOREIGN KEY (`u_ip`) REFERENCES `user` (`u_ip`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `product_ibfk_1` FOREIGN KEY (`o_id`) REFERENCES `order_cat` (`o_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `product_ibfk_2` FOREIGN KEY (`a_id`) REFERENCES `admin` (`a_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `u_order`
--
ALTER TABLE `u_order`
  ADD CONSTRAINT `u_order_ibfk_1` FOREIGN KEY (`u_email`) REFERENCES `user` (`u_email`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `whishlist`
--
ALTER TABLE `whishlist`
  ADD CONSTRAINT `whishlist_ibfk_1` FOREIGN KEY (`p_id`) REFERENCES `product` (`p_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

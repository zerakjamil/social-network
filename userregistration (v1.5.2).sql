-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2023 at 01:22 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `userregistration`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `full_name` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` text NOT NULL,
  `password_text` text NOT NULL,
  `m_mode` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `full_name`, `email`, `password`, `password_text`, `m_mode`) VALUES
(1, 'Zerak Jamil', 'zerak@netlink.com', '62c203187baab14cad9179d1ba00272a', 'Shaqlawa12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `block_list`
--

CREATE TABLE `block_list` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `blocked_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `block_list`
--

INSERT INTO `block_list` (`id`, `user_id`, `blocked_user_id`) VALUES
(101, 163, 5),
(105, 1, 29);

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `post_id`, `user_id`, `comment`, `created_at`) VALUES
(50, 32, 30, 'jwana', '2023-01-25 20:00:58'),
(51, 33, 30, 'today', '2023-01-26 09:30:20'),
(52, 34, 29, 'piroza buiya dwam post', '2023-01-27 16:49:30'),
(53, 32, 30, 'nazdara', '2023-02-14 19:41:16'),
(54, 32, 8, 'number 1', '2023-02-16 08:58:58'),
(56, 32, 19, 'jhkjhh', '2023-02-19 11:35:43'),
(58, 1, 59, 'jwana', '2023-02-21 05:51:36'),
(60, 44, 5, 'jwana', '2023-02-22 08:23:32'),
(71, 32, 29, 'supas', '2023-03-02 20:20:15'),
(92, 70, 85, 'jwana', '2023-03-10 15:04:14'),
(106, 43, 29, 'jwana bzhi', '2023-03-12 10:27:11'),
(107, 65, 29, 'shaza', '2023-03-12 16:51:10'),
(110, 1, 1, 'supas', '2023-03-16 15:17:00'),
(112, 45, 3, '٣', '2023-03-29 09:16:04'),
(113, 45, 3, '٣٣', '2023-03-29 09:16:16'),
(130, 32, 1, 'shahanaya', '2023-04-23 17:29:58'),
(145, 99, 29, 'SD ', '2023-04-28 11:25:54'),
(149, 125, 29, 'fdgf', '2023-05-03 16:59:39'),
(151, 125, 29, 'slaw', '2023-05-03 18:15:42'),
(155, 126, 1, 'just ', '2023-05-06 07:05:39'),
(157, 129, 163, 'jcfnjkfcgjk', '2023-05-08 06:29:04');

-- --------------------------------------------------------

--
-- Table structure for table `comment_likes`
--

CREATE TABLE `comment_likes` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `comment_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `comment_likes`
--

INSERT INTO `comment_likes` (`id`, `user_id`, `comment_id`) VALUES
(10, '29', '53'),
(11, '29', '50'),
(12, '1', '53'),
(13, '1', '50'),
(14, '1', '54'),
(15, '1', '56'),
(16, '1', '71'),
(18, '29', '67'),
(19, '29', '81'),
(20, '29', '107'),
(21, '29', '106'),
(23, '29', '113'),
(24, '29', '112'),
(25, '29', '114'),
(26, '29', '54'),
(27, '29', '56'),
(28, '29', '71'),
(29, '29', '119'),
(30, '29', '121'),
(33, '29', '130'),
(34, '29', '140'),
(37, '29', '144'),
(41, '29', '148'),
(42, '29', '155'),
(43, '1', '151');

-- --------------------------------------------------------

--
-- Table structure for table `conatc_us`
--

CREATE TABLE `conatc_us` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` text NOT NULL,
  `submit` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `conatc_us`
--

INSERT INTO `conatc_us` (`id`, `name`, `email`, `message`, `submit`) VALUES
(27, 'Lara Richardson', 'poduqowozo@mailinator.com', 'dweff', '1');

-- --------------------------------------------------------

--
-- Table structure for table `follow_list`
--

CREATE TABLE `follow_list` (
  `id` int(11) NOT NULL,
  `follower_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  `since` datetime NOT NULL DEFAULT current_timestamp(),
  `read_status` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `follow_list`
--

INSERT INTO `follow_list` (`id`, `follower_id`, `user_id`, `status`, `since`, `read_status`) VALUES
(131, 34, 5, '', '0000-00-00 00:00:00', 0),
(133, 34, 22, '', '0000-00-00 00:00:00', 0),
(134, 34, 8, '', '0000-00-00 00:00:00', 0),
(135, 8, 34, '', '0000-00-00 00:00:00', 0),
(139, 26, 15, '', '0000-00-00 00:00:00', 0),
(141, 35, 15, '', '0000-00-00 00:00:00', 0),
(142, 33, 6, '', '0000-00-00 00:00:00', 0),
(143, 33, 5, '', '0000-00-00 00:00:00', 0),
(144, 33, 7, '', '0000-00-00 00:00:00', 0),
(146, 38, 32, '', '0000-00-00 00:00:00', 0),
(147, 29, 15, '', '0000-00-00 00:00:00', 0),
(150, 40, 2, '', '0000-00-00 00:00:00', 0),
(152, 40, 4, '', '0000-00-00 00:00:00', 0),
(163, 28, 51, '', '0000-00-00 00:00:00', 0),
(166, 52, 50, '', '0000-00-00 00:00:00', 0),
(167, 52, 28, '', '0000-00-00 00:00:00', 0),
(168, 52, 32, '', '0000-00-00 00:00:00', 0),
(169, 52, 36, '', '0000-00-00 00:00:00', 0),
(171, 52, 53, '', '0000-00-00 00:00:00', 0),
(172, 29, 52, '', '0000-00-00 00:00:00', 0),
(175, 22, 2, '', '0000-00-00 00:00:00', 0),
(188, 29, 7, '', '0000-00-00 00:00:00', 0),
(189, 67, 6, '', '0000-00-00 00:00:00', 0),
(191, 29, 69, '', '0000-00-00 00:00:00', 0),
(192, 29, 68, '', '0000-00-00 00:00:00', 0),
(219, 3, 2, '', '2023-03-06 10:25:21', 0),
(254, 29, 85, '', '2023-03-10 07:42:32', 0),
(256, 29, 19, '', '2023-03-12 03:49:31', 1),
(257, 29, 28, '', '2023-03-14 04:36:03', 0),
(261, 29, 6, '', '2023-03-14 06:31:59', 0),
(264, 3, 5, '', '2023-03-16 03:16:13', 0),
(267, 1, 2, '', '2023-03-16 08:16:20', 0),
(268, 1, 50, '', '2023-03-16 08:22:44', 0),
(286, 29, 50, '', '2023-03-25 23:42:28', 0),
(288, 29, 2, '', '2023-03-26 00:04:07', 0),
(289, 29, 8, '', '2023-03-26 00:04:12', 0),
(290, 29, 20, '', '2023-03-26 00:04:46', 0),
(291, 29, 67, '', '2023-03-26 00:05:06', 0),
(296, 1, 3, '', '2023-03-29 05:56:20', 1),
(298, 29, 22, '', '2023-03-29 07:21:11', 0),
(299, 29, 24, '', '2023-03-29 07:21:16', 0),
(300, 1, 7, '', '2023-04-07 12:02:19', 0),
(314, 29, 3, '', '2023-04-29 23:01:06', 1),
(321, 3, 1, '', '2023-05-07 12:56:58', 1),
(322, 163, 28, '', '2023-05-07 23:35:42', 0),
(325, 163, 1, 'p', '2023-05-07 23:36:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_id`, `user_id`) VALUES
(96, 32, 30),
(100, 33, 30),
(102, 34, 29),
(104, 32, 7),
(105, 32, 8),
(106, 37, 15),
(107, 1, 15),
(108, 39, 29),
(110, 32, 19),
(112, 37, 29),
(114, 1, 22),
(116, 44, 5),
(162, 65, 29),
(168, 45, 29),
(169, 72, 3),
(172, 81, 29),
(175, 83, 29),
(176, 1, 29),
(177, 90, 29),
(180, 32, 29),
(183, 92, 3),
(184, 91, 29),
(185, 88, 3),
(186, 43, 29),
(190, 88, 29),
(191, 43, 1),
(192, 91, 100),
(193, 88, 100),
(199, 88, 1),
(200, 32, 1),
(203, 111, 1),
(204, 119, 1),
(206, 85, 29),
(213, 92, 29),
(214, 99, 29),
(218, 129, 163);

-- --------------------------------------------------------

--
-- Table structure for table `logged_devices`
--

CREATE TABLE `logged_devices` (
  `logged_id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `logged_device` text NOT NULL,
  `ip_address` varchar(50) NOT NULL,
  `trusted` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logged_devices`
--

INSERT INTO `logged_devices` (`logged_id`, `user_id`, `logged_device`, `ip_address`, `trusted`, `created_at`) VALUES
(71, '29', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/113.0.0.0 Safari/537.36', '::1', 0, '2023-05-11 17:11:02');

-- --------------------------------------------------------

--
-- Table structure for table `loginlogs`
--

CREATE TABLE `loginlogs` (
  `id` int(11) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `IpAddress` varbinary(16) NOT NULL,
  `TryTime` bigint(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `loginlogs`
--

INSERT INTO `loginlogs` (`id`, `user_id`, `IpAddress`, `TryTime`) VALUES
(181, '', 0x3a3a31, 1683753018),
(182, '', 0x3a3a31, 1683753028);

-- --------------------------------------------------------

--
-- Table structure for table `marke_user`
--

CREATE TABLE `marke_user` (
  `market_id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `location` varchar(255) NOT NULL,
  `user_id` varchar(50) NOT NULL,
  `market_pic` text NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `market_text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `marke_user`
--

INSERT INTO `marke_user` (`market_id`, `name`, `location`, `user_id`, `market_pic`, `created_at`, `market_text`) VALUES
(10, 'ZerakJamil', 'Shaqlawa,Kurdistan', '29', '16836472668249e7afab4b765fd5682fe0a9a5c0fd.jpg', '2023-05-08 08:24:02', 'kogay electronyat');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `msg` text NOT NULL,
  `msg_pic` text NOT NULL,
  `msg_voice` text NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `nstatus` text NOT NULL,
  `seenBy` varchar(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `from_user_id`, `to_user_id`, `msg`, `msg_pic`, `msg_voice`, `read_status`, `nstatus`, `seenBy`, `created_at`) VALUES
(17, 29, 1, 'bashi', '', '', 1, '', '1', '2023-04-27 16:33:06'),
(18, 1, 29, 'bashi atu', '', '', 1, '', '1', '2023-04-27 16:38:27'),
(23, 29, 5, 'slaw', '', '', 0, '', '0', '2023-04-27 17:09:55'),
(44, 1, 28, 'slaw', '', '', 0, '', '0', '2023-04-28 14:29:43'),
(49, 29, 5, 'slaw', '', '', 0, '', '0', '2023-04-29 16:01:27'),
(51, 3, 29, 'slaw', '', '', 1, '', '1', '2023-04-30 06:57:36'),
(52, 29, 3, 'chone', '', '', 0, '', '0', '2023-05-01 19:02:03'),
(53, 29, 27, 'hkghj', '', '', 0, '', '0', '2023-05-02 07:23:13'),
(54, 29, 27, 'slaw', '', '', 0, '', '0', '2023-05-03 07:40:46'),
(55, 29, 34, 'slaw', '', '', 0, '', '0', '2023-05-03 07:41:17'),
(58, 29, 1, '', '', '6452c94713cc7.webm', 1, '', '1', '2023-05-03 20:51:19'),
(59, 29, 8, 'slaw', '', '', 0, '', '0', '2023-05-06 10:27:19');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `from_user_id` int(11) NOT NULL,
  `read_status` int(11) NOT NULL DEFAULT 0,
  `post_id` text DEFAULT NULL,
  `comment_id` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `to_user_id`, `message`, `created_at`, `from_user_id`, `read_status`, `post_id`, `comment_id`) VALUES
(687, 29, 'لێدوانی لەسەر پۆستەکەی تۆ دا', '2023-05-06 07:05:39', 1, 1, '126', '0'),
(688, 29, 'داواکەی تۆی قەبووڵ کرد', '2023-05-06 07:08:07', 1, 1, '0', '0'),
(689, 1, 'سەرنجەکەی تۆی بەدڵە', '2023-05-07 17:18:52', 29, 1, '155', '0'),
(690, 3, 'داواکەی تۆی قەبووڵ کرد', '2023-05-07 20:02:12', 1, 1, '0', '0'),
(691, 28, 'شوێن تۆکەوت', '2023-05-08 06:35:42', 163, 0, '0', '0'),
(692, 5, 'شوێن تۆکەوت', '2023-05-08 06:36:20', 163, 0, '0', '0'),
(693, 29, 'سەرنجەکەی تۆی بەدڵە', '2023-05-08 06:38:38', 1, 1, '151', '0'),
(695, 29, 'کەسێک لە ڕێگەی ئامێرێکی نەناسراو هەوڵی هاتنە ژوورەوەی ئەکاونتەکەی تۆ ئەدا، ئایە ئەو کەسە تۆی؟ گەر تۆ نی پێشنیاری گۆڕینی تێپەڕەوشە ئەکەین بە زووترین کات.', '2023-05-12 11:01:52', 9999, 1, '0', '0');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `post_img` text NOT NULL,
  `post_vid` text NOT NULL,
  `post_text` text NOT NULL,
  `coLock` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `post_img`, `post_vid`, `post_text`, `coLock`, `created_at`) VALUES
(1, 1, '7.jpg', '', 'jwani srusht', 0, '2022-12-04 10:01:26'),
(32, 29, '1674676595feed2.jpg', '', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis in lacinia augue. Nulla facilisi. Nulla ornare sapien sit amet augue bibendum aliquet. In hac habitasse platea dictumst. Integer ut arcu eu nisl malesuada auctor. Proin vel lorem quis velit feugiat aliquam. Sed venenatis risus eget felis fringilla, vel faucibus magna tristique. Sed consequat ex id lectus sagittis, id placerat urna semper. Praesent imperdiet ex et massa mollis, euismod maximus purus efficitur. Vivamus ut malesuada sapien, non suscipit velit. Sed luctus nulla eu eleifend fermentum. Sed eget sapien id massa vestibulum euismod.', 0, '2023-01-25 19:56:35'),
(34, 31, '16748379721.jpg', '', 'goren<small class=\"text-muted\" style=\"font-size:0.7rem;\"><br> edited </small>', 0, '2023-01-27 16:46:12'),
(37, 15, '1676540205beautiful-profile-picture-id182773387-4253914269 (1).jpg', '', 'goren<small class=\"text-muted\" style=\"font-size:0.7rem;\"><br> edited </small>', 0, '2023-02-16 09:36:45'),
(43, 7, '1676969955Boys-Profile-Images-2.jpg', '', 'goren<small class=\"text-muted\" style=\"font-size:0.7rem;\"><br> edited </small>', 0, '2023-02-21 08:59:15'),
(45, 29, '1677180218kk-1784555108.jpg', '', 'Dasttan xosh', 0, '2023-02-23 19:23:38'),
(65, 80, '16778399851_dQyfOpFWmSxrmdOcQgW6OQ-1545818645.jpg', '', 'jwana<small class=\"text-muted\" style=\"font-size:0.7rem;\"><br> edited </small>', 0, '2023-03-03 10:39:45'),
(81, 29, '16785697031.jpeg', '', 'gdsfhdsfs', 1, '2023-03-11 21:21:43'),
(85, 29, '1678827577video_2023-03-05_08-28-16.mp4', '', '<p>Zankoy Soran</p>', 0, '2023-03-14 20:59:37'),
(88, 29, '16788734311.jpeg', '', '                          \r\nSearch Icons\r\n\r\nBootstrap Arrow Left Icon (Missile, Projectile)\r\nBootstrap Arrow Left Icon refers to using the right and left arrow keys to move between columns and using the up and down arrow keys to move between rows. This icon is also known as \"bi bi-arrow-left\" or \"bi arrow left\". Arrow Left bootstrap icon also symbolizes missile and projectile.\r\nArrow left Icon is given below. You can use this icon on the same way in your project. First make sure you have added Bootstrap Icon library. If this library is added just add the HTML css class arrow-left to any element to add the icon. Bootstrap arrow left Icon can be resized as per your need. You can manage size of icon(arrow left) by using font-size css style.\r\n\r\nYou can get steps to add HTML icon Arrow left in Web, Bootstrap and Angular Bootstrap framwork.\r\n\r\n\r\n\r\nHow to add Bootstrap arrow left Icon ?\r\nBootstrap Icon arrow left Icon can be added to any web page simply as below.\r\n\r\nIcon Code-\r\n<span class=\"bi bi-arrow-left\"></span>\r\nArrow left Icon Code | Customize color\r\n\r\nYou can get icon arrow left in blue, white, red color and transparent color from below list. You can also customize color using color picker.\r\n\r\nAdvance Editor\r\nfontawesomeicons.com\r\n<span id=\"boot-icon\" class=\"bi bi-arrow-left\" style=\"font-size: 50px; color: rgb(0, 0, 0); -webkit-text-stroke-width: 0.8px;\"></span>\r\n              Italian Trulli \r\n Italian Trulli \r\n Italian Trulli \r\nSize\r\n\r\n\r\n50\r\nOpacity\r\n\r\n\r\n1\r\nStroke\r\n\r\n\r\n0.8\r\nItalian Trulli\r\n1. Web\r\nYou can integrate Icon in web pages by just adding following below syntax & icon code.\r\n\r\nIcon - \r\n<span class=\"bi bi-arrow-left\"></span>\r\nIcon Code - \r\narrow-left\r\nTry Demo Yourself \r\nBootstrap Button with arrow left Icon\r\nButton Icon Left -\r\nYou can add icon to button left aligned as below.\r\n\r\nIcon Button -\r\nIf you want to make button icon only and no text, add following code.\r\n\r\n<span class=\"bi bi-arrow-left\"></span></button>\r\nTags\r\ncursor.,dart.,missile.,projectile.,bolt.,indicator.,pointer.,shaft.,left-hand,sinistral\r\n\r\n\r\n\r\n\r\n\r\nBootstrap Icon arrow left Icon | arrow left | HTML, CSS\r\nAdding Bootstrap Icon icon HTML Arrow left(arrow-left) in web project is very simple. You need to add the icon class along with bi, it is basically main class and mandatory for icons so do not forget to add this class. You can customize Bootstrap Icon arrow left Icon Arrow left as per your requirement, suppose that you need to chnage the color of Arrow left icon or change the size of size. It is pretty simple to change color of icon Arrow left just add style=\"color:red\" it will make font color red. On the same way you can change size of Arrow left icon by just adding style=\"font-size:50px;\". Smililarly you can add border color, shadow and other font styles to Arrow left. Hope this icon fullfilled your need.                        ', 0, '2023-03-15 09:43:51'),
(91, 29, '1679176183IMG_8847.MP4', '', '', 0, '2023-03-18 21:49:43'),
(92, 3, '1679306651social+media+profile+picture-1-3532664170.jpg', '', '', 1, '2023-03-20 10:04:11'),
(99, 3, '16800811671676813648cool-profile-pictures-for-steam-tumblr_mwe88mlxE41sare1go1_1280.jpg', '', '', 0, '2023-03-29 09:12:47'),
(106, 99, '16819108251.jpg', '', '<p><br></p>', 1, '2023-04-19 13:27:05'),
(115, 1, '16820823481677191710Awesome-Profile-Picture-For-Facebook-233233192.jpg', '', '<p>slaw</p>', 0, '2023-04-21 13:05:48'),
(125, 3, '16828375631674676595feed2.jpg', '', '<p><br></p>', 0, '2023-04-30 06:52:43'),
(126, 29, '', '', 'hvhghfhgf', 0, '2023-04-30 19:59:18'),
(127, 29, '16829687591_dQyfOpFWmSxrmdOcQgW6OQ-1545818645.jpg', '', '                          <h3>NETlink</h3>                        ', 1, '2023-05-01 19:19:19'),
(129, 163, '', '', 'jdrtbshbthj', 0, '2023-05-08 06:28:50');

-- --------------------------------------------------------

--
-- Table structure for table `recent_searches`
--

CREATE TABLE `recent_searches` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `search_id` varchar(11) NOT NULL,
  `searches` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `recent_searches`
--

INSERT INTO `recent_searches` (`id`, `user_id`, `search_id`, `searches`, `created_at`) VALUES
(61, '120', '29', 'Zerak Jamil', '2023-04-25 17:29:52'),
(62, '29', '120', 'Mardin Xalil', '2023-04-25 17:34:50'),
(64, '131', '29', 'Zerak Jamil', '2023-04-26 14:40:14'),
(65, '131', '5', 'Sarhad Baez', '2023-04-26 14:40:31'),
(71, '1', '29', 'Zerak Jamil', '2023-04-29 16:17:46'),
(74, '3', '29', 'Zerak Jamil', '2023-04-30 07:32:06'),
(80, '1', '29', 'Zerak Jamil', '2023-05-03 19:00:00'),
(87, '3', '1', 'Jamil Ahmed', '2023-05-07 19:56:56'),
(88, '163', '29', 'Zerak Jamil', '2023-05-08 06:36:03'),
(89, '163', '5', 'Sarhad Baez', '2023-05-08 06:36:15'),
(90, '163', '29', 'Zerak Jamil', '2023-05-08 06:36:31'),
(91, '163', '1', 'Jamil Ahmed', '2023-05-08 06:36:50'),
(92, '1', '5', 'Sarhad Baez', '2023-05-08 06:44:20'),
(93, '1', '5', 'Sarhad Baez', '2023-05-08 06:44:48');

-- --------------------------------------------------------

--
-- Table structure for table `reels`
--

CREATE TABLE `reels` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `reel_post` text NOT NULL,
  `reel_text` text NOT NULL,
  `coLock` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reels`
--

INSERT INTO `reels` (`id`, `user_id`, `reel_post`, `reel_text`, `coLock`, `created_at`) VALUES
(8, 1, '1678959324video_2023-03-05_08-28-16.mp4', '<p><br></p>', 0, '2023-03-16 09:35:24'),
(9, 29, '1678959426IMG_8847.MP4', '<p><br></p>', 0, '2023-03-16 09:37:06'),
(10, 6, '1679172785video_2023-03-05_08-28-16.mp4', '<p>lagal hawreyani aziz la soran</p>', 0, '2023-03-18 20:53:05'),
(18, 2, '1679318680video_2023-03-20_06-24-19.mp4', '<p><br></p>', 0, '2023-03-20 13:24:40'),
(19, 29, '1679318969video_2023-03-20_06-26-37.mp4', '<p><br></p>', 0, '2023-03-20 13:29:29'),
(20, 29, '1679318986video_2023-03-20_06-26-50.mp4', '<p><br></p>', 0, '2023-03-20 13:29:46'),
(21, 29, '1679319129video_2023-03-20_06-27-15.mp4', '<p>da aw rasmay bgra drm taqi hhhhh<br></p>', 0, '2023-03-20 13:32:09'),
(23, 29, '1679820539video_2023-03-05_08-28-16.mp4', '', 0, '2023-03-26 08:48:59'),
(24, 29, '16818317801.mp4', '', 0, '2023-04-18 15:29:40'),
(25, 29, '1681831904video_2023-03-20_06-26-37.mp4', '', 0, '2023-04-18 15:31:44');

-- --------------------------------------------------------

--
-- Table structure for table `remember_me_tokens`
--

CREATE TABLE `remember_me_tokens` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `remember_me_tokens`
--

INSERT INTO `remember_me_tokens` (`id`, `user_id`, `token`, `expires`) VALUES
(1, 29, '382e5cc23e50ba6668cf335ed86dbf63b71f69d4af8bbb6b21659d888c3003b2', '2023-05-30 16:44:34'),
(2, 29, 'e0a36446d04639080da3bd82dc327c70a2ae3dd889b4245b6fb756c32dd33076', '2023-06-12 14:21:50');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` int(11) NOT NULL,
  `comment_id` varchar(11) NOT NULL,
  `post_id` varchar(11) NOT NULL,
  `reply` text NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `created_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `comment_id`, `post_id`, `reply`, `user_id`, `created_on`) VALUES
(16, '155', '126', 'just what', '29', '2023-05-07 17:18:41'),
(17, '155', '126', 'just what?', '29', '2023-05-09 11:11:40');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `report_id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `reporter_id` varchar(11) NOT NULL,
  `post_id` varchar(11) NOT NULL,
  `description` text NOT NULL,
  `reason` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`report_id`, `user_id`, `reporter_id`, `post_id`, `description`, `reason`) VALUES
(15, '29', '3', '99', 'ئەم پۆستە ساختەیە و هەوڵی لە رێ بردنی خەڵکی ئەدا', 'هەواڵی ساختە '),
(16, '29', '29', '45', 'Pariatur Voluptas a', 'هەواڵی ساختە '),
(17, '29', '29', '123', 'jdfjksdgfkhs', 'شتی تر '),
(18, '29', '29', '91', 'uilkujhgfds', 'تیرۆرستی ');

-- --------------------------------------------------------

--
-- Table structure for table `stories`
--

CREATE TABLE `stories` (
  `id` int(11) NOT NULL,
  `user_id` varchar(11) NOT NULL,
  `story_img` text NOT NULL,
  `read_status` tinyint(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `username` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` text NOT NULL,
  `profile_pic` text NOT NULL,
  `bg_pic` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `verify` tinyint(1) NOT NULL DEFAULT 0,
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `ac_status` int(11) NOT NULL COMMENT '0=not verified,1=active,2=blocked',
  `last_login` timestamp NOT NULL DEFAULT current_timestamp(),
  `bio` text NOT NULL,
  `work` text NOT NULL,
  `city` text DEFAULT NULL,
  `work_place` text NOT NULL,
  `DoB` date DEFAULT NULL,
  `islocked` tinyint(1) NOT NULL,
  `counter` int(1) NOT NULL,
  `locked` tinyint(1) NOT NULL DEFAULT 0,
  `locked_until` timestamp NULL DEFAULT NULL,
  `twoStep` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `first_name`, `last_name`, `gender`, `email`, `phone`, `password`, `profile_pic`, `bg_pic`, `created_at`, `verify`, `updated_at`, `ac_status`, `last_login`, `bio`, `work`, `city`, `work_place`, `DoB`, `islocked`, `counter`, `locked`, `locked_until`, `twoStep`) VALUES
(1, 'jamil', 'Jamil', 'Ahmed', 1, 'wolfboy82@gmail.com', '0', '62c203187baab14cad9179d1ba00272a', '1682521021facebook_photo_download_194639357233682-2376680453.jpg', '168208216221.jpg', '2023-04-26 18:53:02', 1, '2023-05-12 10:03:44', 1, '2023-05-12 10:03:44', 'i love kurdistan', '', '', '', '1991-02-07', 1, 0, 0, NULL, 0),
(2, 'arasmustafa1', 'Aras', 'Mustafa', 1, 'dfgdsf@gmail.com', '0', 'aras12', '1676435495facebook_photo_download_194639357233682-2376680453.jpg', 'd-cover.jpg', '2022-11-26 08:00:00', 1, '2023-04-26 18:54:16', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(3, 'shayma', 'Shayma', 'Muttalib', 2, 'shayma.muttalib2002@gmail.com', '00000000', '62c203187baab14cad9179d1ba00272a', '1677528074Whatsapp-girls-attitude-dp-2973526896.jpg', '1678126522awesome-beautiful-nature-wallpaper_042319501_304-3894978568.jpg', '2023-02-02 19:48:51', 2, '2023-05-07 20:03:18', 1, '2023-05-07 20:03:18', 'IT student', '', 'کوردستان، هەولێر', '', '0000-00-00', 0, 0, 0, NULL, 0),
(5, 'sarhadbaez1', 'Sarhad', 'Baez', 1, 'sarhad.baez@gmail.com', '0', '1234567', '16764129781597998041092.jpg', 'd-cover.jpg', '2023-01-16 08:00:00', 0, '2023-04-26 18:54:34', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(6, 'rehamsherzad1', 'reham', 'sherzad', 2, 'reham.sherzad1@gmail.com', '0', '123456789', '1676413372wp5756355-4015939421.jpg', '1678306396bg.jpeg', '0000-00-00 00:00:00', 0, '2023-03-08 20:13:16', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(7, 'yadhoshyar', 'Yad', 'Hoshyar', 1, 'yad@gmail.com', '0', '12345678', '16764129431624482113395.jpg', 'd-cover.jpg', '0000-00-00 00:00:00', 1, '2023-03-13 13:42:28', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(8, 'bahroz', 'bahroz', 'K. hussein', 1, 'bahrozkarem232@gmail.com', '0', 'bahroz1234', 'default_profile.jpg', 'd-cover.jpg', '0000-00-00 00:00:00', 1, '2023-03-13 13:42:32', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(15, 'alesurchy', 'ALI', 'M ZRAR', 1, 'alimukre.22@gmail.com', '0', '7bb5ca9baf1fc7e81e941cfc4e523fa2', '1676578842photo_2023-02-16_06-50-25.jpg', 'd-cover.jpg', '0000-00-00 00:00:00', 1, '2023-03-13 13:42:38', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(19, 'laele', 'Layla', 'Farhan', 0, 'layla.farhan@gmail.com', '0', 'c440da0e96c14806c42969927ed4432e', '1678618149beautiful-profile-picture-id182773387-4253914269 (1).jpg', '1678617946bg.jpeg', '0000-00-00 00:00:00', 0, '2023-03-12 10:49:09', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 1, 0, 0, NULL, 0),
(20, 'asya', 'Asya', 'Hamadamin', 2, 'asya.hamadamin@gmail.com', '0', '806f7fa344a70d0bd003bf53a78d529d', '1676413431template_3.jpg', '1678644020f67e8c8c5daf8a8d6f18578dc6e98080-992259716.jpg', '0000-00-00 00:00:00', 0, '2023-03-12 18:00:20', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(22, 'ibrahim', 'ibrahim', 'jalal', 1, 'ebrahimjalal91@gmail.com', '0', 'e4cb7cf6ac25db2ca4263563b50576ce', 'default_profile.jpg', 'd-cover.jpg', '0000-00-00 00:00:00', 1, '2023-03-13 13:42:42', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(24, 'lana', 'lana', 'ali', 2, 'lana.ali1@gmail.com', '0', '123456789', '1676435433f67e8c8c5daf8a8d6f18578dc6e98080-992259716.jpg', 'd-cover.jpg', '0000-00-00 00:00:00', 1, '2023-03-13 13:42:47', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(26, 'ahmed', 'Ahmad', 'Surchy', 1, 'ahmad.batasy@gmail.com', '0', '22222222', '1676435124cool-profile-pictures-for-steam-tumblr_mwe88mlxE41sare1go1_1280.jpg', 'd-cover.jpg', '2022-11-10 15:38:38', 1, '2023-03-13 13:42:51', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(27, 'amanj', 'Amanj', 'Omer', 1, 'amanj.omer@gmail.com', '0', 'amanjomer123#$$#', '1676434679pexels-trinity-kubassek-246805.jpg', 'd-cover.jpg', '2022-11-13 07:17:12', 1, '2023-03-13 13:42:56', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(28, 'safar', 'safer', 'khoshnaw', 1, 'safarsafar493@gmail.com', '0', 'shaqlawa77', '1676412875photo_2023-02-14_14-14-16.jpg', 'd-cover.jpg', '2022-11-22 15:58:31', 1, '2023-03-13 13:43:01', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(29, 'zerakjamil', 'Zerak', 'Jamil', 1, 'wolfboy829@gmail.com', '7810270247', '62c203187baab14cad9179d1ba00272a', '16827910194.jpg', '16827912735-8f4ad0b25ca8935ea3d04e1904a2546d.jpg', '2023-01-25 19:37:05', 2, '2023-05-12 11:21:51', 1, '2023-05-12 11:21:51', 'CEO and founder of NETlink ', '', 'کوردستان، شەقڵاوە', 'Shaqlawa TechCollege', '2000-07-21', 1, 0, 0, NULL, 1),
(30, 'zana_m', 'zana', 'muttalib', 1, 'zana.mutalib@gmail.com', '0', '62c203187baab14cad9179d1ba00272a', 'default_profile.jpg', 'd-cover.jpg', '2023-01-25 19:59:15', 0, '2023-03-13 13:43:04', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(31, 'lana1', 'Lana', 'Ali', 2, 'lana.ali@gmail.com', '0', '62c203187baab14cad9179d1ba00272a', '16748380396.jpg', 'd-cover.jpg', '2023-01-27 16:44:13', 1, '2023-03-13 13:43:07', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(32, 'pola', 'pola', 'kawani', 0, 'pola.kawami11@gmail.com', '0', 'Pola12pola', '1676412544(49).jpg', 'd-cover.jpg', '2023-01-31 18:58:16', 1, '2023-03-13 13:43:12', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(33, 'lawin', 'Mobile', 'Lawin', 1, 'lawin.88@yahoo.com', '0', '35dd5ef62be9f7d5cee85137ece6b7da', 'default_profile.jpg', 'd-cover.jpg', '2023-02-10 17:02:05', 0, '2023-03-13 13:43:17', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(34, 'bilal', 'Bilal', 'Majeed', 1, 'bilalmajeedxoshnaw@gmail.com', '0', 'f63999b139c03b3535dce1112678e221', 'default_profile.jpg', 'd-cover.jpg', '2023-02-16 08:55:19', 0, '2023-03-13 13:43:21', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(35, 'ayad', 'Ayad', 'Hemn', 1, 'ayadhemn012@gmail.com', '0', '1320673f7fef0ff18ee6fedc47381d2e', 'default_profile.jpg', 'd-cover.jpg', '2023-02-16 09:39:40', 0, '2023-03-13 13:43:25', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(36, 'muhammed', 'Muhammed', 'Wali', 1, 'muhammad@gmail.com', '07504554432', '01271cb732e35817ebe2bbc907e60dbe', 'default_profile.jpg', 'd-cover.jpg', '2023-02-16 20:16:05', 0, '2023-03-13 13:43:28', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(38, 'ayad44', 'AYAD', 'MAXSUD', 1, 'kishaiskae@gmail.com', '07827327076', 'a37d980ca3c74d2c26826f4112185062', 'default_profile.jpg', 'd-cover.jpg', '2023-02-17 16:32:44', 1, '2023-03-13 13:43:31', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(50, 'zakaria', 'Zakaria', 'Shawkat', 1, 'zakaria.shawkat@gmail.com', '0783082303', 'c75318e5c9c81f72728a7c1d3bcff34a', 'default_profile.jpg', 'd-cover.jpg', '2023-02-19 17:01:00', 1, '2023-03-13 13:43:35', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(51, 'shawkat', 'Shawkat', 'Xoshnaw', 1, 'shawka.xoshnaw@gmail.com', '07504512325', '53f1500f828255fa4d913de359ef8a16', '1676835564photo_2023-02-19_11-38-27.jpg', 'd-cover.jpg', '2023-02-19 17:24:06', 0, '2023-03-13 13:43:39', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(52, 'farhad', 'Frahad', 'Surchi', 1, 'farhad.asaad92@gmail.com', '07504019232', '4c40adf0ee523d8829a6e108a3e47240', '1676834830photo_2023-02-19_11-19-17.jpg', 'd-cover.jpg', '2023-02-19 18:55:52', 1, '2023-03-13 13:43:43', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(53, 'eva', 'Eva', 'Eva', 2, 'eva.eva@gmail.com', '07508944343', 'e2cfdc38824f97412666e52f1a86b1f1', 'default_profile.jpg', 'd-cover.jpg', '2023-02-19 19:24:51', 0, '2023-03-13 13:43:46', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(59, 'saad', 'Saad', 'Fakher', 1, 'fakhersaad7@gmail.com', '07505890209', '357e7da343590992d188813d2c4046c4', 'default_profile.jpg', 'd-cover.jpg', '2023-02-21 05:49:17', 1, '2023-03-13 13:43:50', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(60, 'n_fazl', 'nawaz', 'fadhil', 1, 'nawazfazl@gmail.com', '07504830520', '0d5159c879bfb560db870add1041cbe5', 'default_profile.jpg', 'd-cover.jpg', '2023-02-21 05:54:46', 1, '2023-03-13 13:43:55', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(67, 'rayan', 'rayan', 'rzgar', 2, 'rayanrzgar114@gmail.com', '0000000', '8657359bc53e0b7237858af08bcd3e8a', 'default_profile.jpg', 'd-cover.jpg', '2023-02-27 06:54:27', 1, '2023-03-13 13:44:01', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(68, 'narmin', 'Narmin', 'Ali', 2, 'zerak@kurdishsocial.com', '07506651787', '827ccb0eea8a706c4c34a16891f84e7b', 'default_profile.jpg', 'd-cover.jpg', '2023-02-27 08:12:58', 1, '2023-03-13 13:44:05', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(69, 'parzhin', 'parzhin', 'ghazi', 2, 'e54418is@epu.edu.iq', '07504655462', '25d55ad283aa400af464c76d713c07ad', 'default_profile.jpg', 'd-cover.jpg', '2023-02-27 08:15:18', 1, '2023-03-13 13:44:09', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(70, 'sekahe', 'Nolan', 'Hunt', 0, 'nomucokive@mailinator.com', '+1 (568) 861-2203', '62c203187baab14cad9179d1ba00272a', 'default_profile.jpg', 'd-cover.jpg', '2023-02-27 20:02:26', 0, '2023-03-13 13:44:13', 1, '2023-03-12 11:35:01', 'i love kurdistan', '', '', '', NULL, 0, 0, 0, NULL, 0),
(71, 'pkawani', 'Pana', 'Ali', 2, 'panpanosh@gmail.com', '07500419948', '44f46ec753b59b82eca94982317a9852', 'default_profile.jpg', 'd-cover.jpg', '2023-02-28 17:13:39', 0, '2023-03-13 13:44:17', 1, '2023-03-12 11:35:01', 'Faith', '', '', '', NULL, 0, 0, 0, NULL, 0),
(85, 'dyar', 'Dyar', 'Said', 1, 'dyar.gg55@gmail.com', '07812266613', 'f4d7235660106a8320c3285d2b15022b', 'default_profile.jpg', 'd-cover.jpg', '2023-03-10 14:59:31', 1, '2023-04-22 19:09:14', 1, '2023-03-12 11:35:01', '', '', '', '', NULL, 0, 0, 0, NULL, 0),
(121, 'mardin', 'Mardin', 'Xalil', 1, 'mardinxalil2@gmail.com', '07504554432', 'f90fc1d5072e5a67dfbe8f74473468da', 'd-avatar.jpg', 'bg.jpeg', '2023-04-25 17:39:11', 1, '2023-04-25 17:40:34', 1, '2023-04-25 17:39:20', '', '', '', '', NULL, 0, 2, 0, NULL, 0),
(163, 'zerakjam', 'Oprah', 'Snow', 1, 'fofywedevo@mailinator.com', '+1 (503) 861-7164', '66b8ae8c1da921e61d0156e16bba1537', '1683527406(49).jpg', 'bg.jpeg', '2023-05-08 06:26:02', 0, '2023-05-08 06:36:55', 1, '2023-05-08 06:36:55', 'CEO and founder of KurdishSocial', 'قووتابی', 'کوردستان، شەقڵاوە', 'Shaqlawa TechCollege', '0000-00-00', 0, 0, 0, NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `block_list`
--
ALTER TABLE `block_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `comment_likes`
--
ALTER TABLE `comment_likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `conatc_us`
--
ALTER TABLE `conatc_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `follow_list`
--
ALTER TABLE `follow_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `logged_devices`
--
ALTER TABLE `logged_devices`
  ADD PRIMARY KEY (`logged_id`);

--
-- Indexes for table `loginlogs`
--
ALTER TABLE `loginlogs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `marke_user`
--
ALTER TABLE `marke_user`
  ADD PRIMARY KEY (`market_id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `recent_searches`
--
ALTER TABLE `recent_searches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reels`
--
ALTER TABLE `reels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `remember_me_tokens`
--
ALTER TABLE `remember_me_tokens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`report_id`);

--
-- Indexes for table `stories`
--
ALTER TABLE `stories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `block_list`
--
ALTER TABLE `block_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=106;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `comment_likes`
--
ALTER TABLE `comment_likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `conatc_us`
--
ALTER TABLE `conatc_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `follow_list`
--
ALTER TABLE `follow_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=220;

--
-- AUTO_INCREMENT for table `logged_devices`
--
ALTER TABLE `logged_devices`
  MODIFY `logged_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `loginlogs`
--
ALTER TABLE `loginlogs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=183;

--
-- AUTO_INCREMENT for table `marke_user`
--
ALTER TABLE `marke_user`
  MODIFY `market_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=696;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=131;

--
-- AUTO_INCREMENT for table `recent_searches`
--
ALTER TABLE `recent_searches`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=95;

--
-- AUTO_INCREMENT for table `reels`
--
ALTER TABLE `reels`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `remember_me_tokens`
--
ALTER TABLE `remember_me_tokens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `report_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `stories`
--
ALTER TABLE `stories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=166;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `remember_me_tokens`
--
ALTER TABLE `remember_me_tokens`
  ADD CONSTRAINT `remember_me_tokens_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

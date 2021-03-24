-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2020-12-22 07:19:23
-- 伺服器版本: 10.1.30-MariaDB
-- PHP 版本： 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `bookstore`
--

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `UID` int(20) NOT NULL COMMENT '使用者編號',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者帳號',
  `passwd` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者密碼',
  `usertype` int(11) DEFAULT NULL COMMENT '使用者權限類別'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`UID`, `username`, `passwd`, `usertype`) VALUES
(1, 'ASD@gmail.com', '123456', 0),
(2, 'ZXC@gmail.com', 'asd75641', 0),
(3, 'WSX@gmail.com', '321654', 0),
(4, 'zzz@gmail.com', '125642', 0),
(5, 'xxx@gmail.com', '111111', 0),
(6, 'ccc@gmail.com', '555555', 0),
(7, 'aaa@gmail.com', '666666', 0),
(8, 'sss@gmail.com', '777888', 0),
(9, 'ddd@gmail.com', '999777', 0),
(10, 'fff@gmail.com', '222555', 0);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(20) NOT NULL AUTO_INCREMENT COMMENT '使用者編號', AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2021-02-25 03:26:08
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
-- 資料表結構 `order_output_list`
--

CREATE TABLE `order_output_list` (
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `UID` int(20) NOT NULL COMMENT '使用者編號',
  `O_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '收件人姓名',
  `O_tel` int(20) NOT NULL COMMENT '收件人電話',
  `O_addr` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `total_amount` int(20) NOT NULL COMMENT '總金額',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '訂購時間',
  `send_method` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '運送方式(1宅配2超商)',
  `pay_method` int(5) NOT NULL COMMENT '付款方式(1到付2匯款)',
  `pay_status` int(5) NOT NULL DEFAULT '1' COMMENT '付款狀況(1待付2確認)',
  `order_status` int(5) NOT NULL DEFAULT '1' COMMENT '訂單狀況(1處理中)',
  `O_other` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '訂單備註'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `order_output_list`
--
ALTER TABLE `order_output_list`
  ADD PRIMARY KEY (`O_ID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `order_output_list`
--
ALTER TABLE `order_output_list`
  MODIFY `O_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '訂單編號';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

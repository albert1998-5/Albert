-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2021-01-26 09:03:21
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
-- 資料表結構 `uorder`
--

CREATE TABLE `uorder` (
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `UID` int(20) NOT NULL COMMENT '使用者編號',
  `P_ID` int(20) NOT NULL COMMENT '商品編號',
  `qty` int(11) NOT NULL COMMENT '購買數量',
  `S_name` int(11) NOT NULL COMMENT '優惠方案編號',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '訂購時間',
  `pay_method` int(5) NOT NULL COMMENT '付款方式',
  `pay_status` int(5) NOT NULL DEFAULT '0' COMMENT '付款狀況',
  `order_status` int(5) NOT NULL DEFAULT '0' COMMENT '訂單狀況'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `uorder`
--
ALTER TABLE `uorder`
  ADD PRIMARY KEY (`O_ID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `uorder`
--
ALTER TABLE `uorder`
  MODIFY `O_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '訂單編號';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

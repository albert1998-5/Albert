-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: 127.0.0.1
-- 產生時間： 2021-02-25 03:26:54
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
-- 資料表結構 `order_output_data`
--

CREATE TABLE `order_output_data` (
  `O_data_ID` int(20) NOT NULL COMMENT '貨品流水編號',
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `P_ID` int(20) NOT NULL COMMENT '商品編號',
  `O_qty` int(11) NOT NULL COMMENT '購買數量',
  `S_name` varchar(20) COLLATE utf8_unicode_ci NOT NULL COMMENT '優惠方案編號'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `order_output_data`
--
ALTER TABLE `order_output_data`
  ADD PRIMARY KEY (`O_data_ID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `order_output_data`
--
ALTER TABLE `order_output_data`
  MODIFY `O_data_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '貨品流水編號';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

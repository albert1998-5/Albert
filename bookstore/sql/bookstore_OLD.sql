-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- 主機: localhost
-- 產生時間： 2021-02-25 03:36:20
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
-- 資料表結構 `cart`
--

CREATE TABLE `cart` (
  `C_ID` int(20) UNSIGNED NOT NULL,
  `UID` varchar(30) COLLATE utf8_unicode_ci NOT NULL COMMENT '會員ID',
  `P_ID` int(20) NOT NULL COMMENT '商品ID',
  `qty` tinyint(50) NOT NULL COMMENT '選購數量',
  `ordtime` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '選購時間'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `dept_list`
--

CREATE TABLE `dept_list` (
  `dept_ID` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '部門代號',
  `dept_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '部門類別_名稱',
  `dept_leader_name` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '主管姓名'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `dept_list`
--

INSERT INTO `dept_list` (`dept_ID`, `dept_name`, `dept_leader_name`) VALUES
('A01', '董事長室', '林政賢'),
('B01', '總經理室', '何茂宗'),
('C01', '倉儲一課', '徐煥坤'),
('C02', '倉儲二課', '江正維'),
('C03', '倉儲三課', '易君揚'),
('D01', '業務一課', '陳曉蘭'),
('D02', '業務二課', '陳雅賢'),
('D03', '業務三課', '朱金倉'),
('D04', '業務四課', '林鵬翔'),
('E01', '採購部', '黃大倫'),
('F01', '維修部', '劉柏村'),
('G01', '資訊部', '林朝財'),
('H01', '企劃部', '程光民'),
('I01', '人事部', '楊習仁'),
('J01', '行政部', '許進發'),
('K01', '會計部', '胡富傑'),
('L01', '圖書室', '洪惠芬');

-- --------------------------------------------------------

--
-- 資料表結構 `employee_data`
--

CREATE TABLE `employee_data` (
  `UID` int(20) NOT NULL COMMENT '員工編號',
  `emp_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '員工姓名',
  `emp_job_title` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '職稱',
  `dept_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '部門代號',
  `emp_city` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '縣市',
  `emp_addr` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `emp_phone` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '電話',
  `emp_postal_code` int(6) NOT NULL COMMENT '郵遞區號',
  `emp_salary` int(20) NOT NULL COMMENT '月薪',
  `emp_annual_leave` int(10) DEFAULT NULL COMMENT '年假天數',
  `emp_e_mail` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '電子信箱'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `employee_data`
--

INSERT INTO `employee_data` (`UID`, `emp_name`, `emp_job_title`, `dept_ID`, `emp_city`, `emp_addr`, `emp_phone`, `emp_postal_code`, `emp_salary`, `emp_annual_leave`, `emp_e_mail`) VALUES
(1, '方重圍', '顧問工程師', 'A01', '新竹市', '科學工業園區工業東四路7號2樓', '035-780050', 300, 190550, 7, ''),
(2, '何茂宗', '總經理', 'B01', '台北市', '中山區松江路301號9樓', '02-5020238', 104, 158620, 14, ''),
(3, '黃慧萍', '特別助理', 'B01', '台北縣', '新店市寶興路45巷5號3樓', '02-9179261', 231, 84460, 14, ''),
(4, '林建興', '研發副總', 'B01', '屏東市', '中正路688巷46弄59號', '08-7379531', 900, 142140, 14, ''),
(5, '蔡豪鈞', '業務副總', 'B01', '桃園縣', '楊梅鎮高榮里新榮路339號', '03-4905265', 326, 37080, 7, ''),
(6, '林森和', '倉儲人員', 'C01', '台北市', '民權東路3段37號12樓', '(02)515-00', 104, 39140, 7, ''),
(7, '黃志文', '倉儲人員', 'C01', '台北市', '光復南路422號2樓之1', '02-7043828', 106, 68186, 14, ''),
(8, '張藍方', '倉儲人員', 'C01', '台北市', '松德路159號-1', '02-7593733', 110, 69422, 14, ''),
(9, '徐煥坤', '倉儲人員', 'C01', '台北縣', '土城市福安街75號', '02-2685871', 236, 37080, 14, ''),
(10, '王德惠', '倉儲人員', 'C01', '台北縣', '新店市寶中路123巷1號5樓', '02-9174400', 231, 38110, 7, ''),
(11, '莊清媚', '倉儲人員', 'C02', '台中市', '北區漢口路4段367號11樓', '04-2374989', 404, 33990, 14, ''),
(12, '張景松', '倉儲人員', 'C02', '台中市', '西屯區台中工業區工業五路3號', '04-3592345', 407, 32445, 14, ''),
(13, '李垂文', '倉儲人員', 'C02', '台中縣', '大里市仁化路261號', '(04)491-41', 412, 35535, 7, ''),
(14, '盧大為', '倉儲人員', 'C02', '台北市', '大同區承德路一段40號12樓', '02-5559211', 103, 33990, 14, ''),
(15, '江正維', '倉儲人員', 'C02', '台北市', '松山區南京東路5段5號2樓', '02-7649130', 105, 62830, 14, ''),
(16, '鍾智慧', '倉儲人員', 'C03', '台北市', '八德路二段260號9樓', '02-7752450', 104, 30385, 7, ''),
(17, '方鎮深', '倉儲人員', 'C03', '台北市', '士林區社中街76號', '02-8118101', 111, 32960, 14, ''),
(18, '楊銘哲', '倉儲人員', 'C03', '台北市', '萬華區漢口街2段60號', '02-3111116', 108, 28016, 14, ''),
(19, '王演銓', '倉儲人員', 'C03', '桃園縣', '大園鄉北港村大工路31號', '03-3868956', 337, 39346, 14, ''),
(20, '易君揚', '倉儲人員', 'C03', '桃園縣', '楊梅鎮秀才路520號', '03-4753821', 326, 77456, 14, ''),
(21, '鄭秀家', '倉儲人員', 'C03', '高雄市', '五福三路21號6樓', '07-2135522', 801, 37595, 7, ''),
(22, '王玉治', '業務副理', 'D01', '台中縣', '潭子鄉建國路3之2號', '04-5331112', 427, 35844, 14, ''),
(23, '林鳳春', '業務專員', 'D01', '台北市', '中正區杭洲南路1段15-1號19樓', '02-3936566', 100, 60770, 14, ''),
(24, '葉秀珠', '業務助理', 'D01', '台北市', '南港區成功路一段65號2&3樓', '02-7832854', 115, 25544, 7, ''),
(25, '陳曉蘭', '業務經理', 'D01', '台南縣', '歸仁鄉南興村中山路851號', '06-2306611', 711, 30385, 7, ''),
(26, '吳美成', '資深專員', 'D01', '彰化縣', '和美鎮彰美路二段106號', '04-7352182', 508, 35844, 7, ''),
(27, '莊國雄', '業務副理', 'D02', '台中縣', '潭子鄉中山路三段493巷35號', '04-5343566', 427, 40376, 7, ''),
(28, '向大鵬', '業務專員', 'D02', '台北市', '建國北路2段145號3樓', '02-5031111', 104, 24102, 7, ''),
(29, '陳詔芳', '業務助理', 'D02', '高雄市', '新興區中正二路182號8-1樓', '07-2228856', 800, 28634, 7, ''),
(30, '陳雅賢', '業務經理', 'D02', '新竹縣', '湖口鄉光復北路92號', '035-981491', 303, 55826, 14, ''),
(31, '吳國信', '資深專員', 'D02', '彰化縣', '福興鄉萬豐村福工路12號', '04-7695161', 506, 38110, 7, ''),
(32, '張志輝', '業務副理', 'D03', '台中縣', '大肚鄉沙田路二段132巷60號', '04-6991173', 432, 32445, 7, ''),
(33, '林玉堂', '業務專員', 'D03', '台北市', '松江路124巷21號4樓', '02-5926597', 104, 26265, 7, ''),
(34, '張世興', '業務助理', 'D03', '台北縣', '淡水鎮下圭柔山100-2號', '02-6228750', 251, 72100, 14, ''),
(35, '朱金倉', '業務經理', 'D03', '高雄市', '三民區通化街120號', '07-3712111', 807, 40067, 14, ''),
(36, '謝穎青', '資深專員', 'D03', '高雄縣', '仁武鄉仁心路311號', '07-3711696', 814, 25235, 7, ''),
(37, '毛渝南', '業務副理', 'D04', '台北市', '大安區敦化南路2段218號', '02-3779968', 106, 78280, 7, ''),
(38, '郭曜明', '業務專員', 'D04', '台北市', '中山區八德路四段111號', '02-7532121', 105, 26780, 7, ''),
(39, '李進祿', '業務專員', 'D04', '台北市', '松山區復興北路369號3樓', '02-7150669', 105, 25750, 7, ''),
(40, '陳惠娟', '業務助理', 'D04', '高雄市', '三民區灣興街96之1號', '07-3853358', 807, 23690, 14, ''),
(41, '林鵬翔', '業務經理', 'D04', '彰化縣', '和美鎮鎮平里彰草路二段697號', '04-7525121', 508, 37080, 7, ''),
(42, '黃大倫', '採購經理', 'E01', '台中縣', '大肚鄉沙田路二段310巷2號', '04-6991191', 432, 27810, 14, ''),
(43, '黃振清', '採購副理', 'E01', '台北市', '大同區重慶北路三段137巷25號2樓', '02-5976225', 103, 35535, 14, ''),
(44, '林國和', '採購專員', 'E01', '台北市', '民生西路292號10樓', '02-5559676', 103, 63860, 14, ''),
(45, '黃秋好', '採購專員', 'E01', '台北市', '新明路124號', '02-7912161', 114, 24102, 7, ''),
(46, '陳弘昌', '採購助理', 'E01', '台南縣', '永康鄉中正北路711號', '06-2531221', 710, 22660, 7, ''),
(47, '張琪', '採購助理', 'E01', '桃園縣', '大園鄉橫峰村1號', '03-3811811', 337, 23175, 7, ''),
(48, '許鴻章', '維修經理', 'E01', '彰化縣', '秀水鄉埔崙村三越街82號', '04-7692511', 504, 26265, 7, ''),
(49, '連邦俊', '維修助理', 'F01', '台北市', '大安區仁愛路三段108號7樓', '02-7042162', 106, 29767, 14, ''),
(50, '張治', '維修工程師', 'F01', '台北市', '大安區復興南路一段390號5樓之3', '02-7081881', 106, 38934, 14, ''),
(51, '吳寶珠', '維修工程師', 'F01', '台北市', '中山區長安東路2段173號7樓', '02-7720267', 104, 33475, 14, ''),
(52, '洪毓祥', '維修工程師', 'F01', '台北市', '中正區忠孝東路2段123號B1', '02-3971881', 100, 41200, 14, ''),
(53, '丁組長', '助理工程師', 'F01', '台北市', '松山區南京東路5段46號7樓', '02-7613571', 105, 29355, 7, ''),
(54, '李秋煌', '助理工程師', 'F01', '台北市', '許昌街四二號九樓', '02-6584251', 100, 26368, 7, ''),
(55, '何信穎', '副工程師', 'F01', '台北縣', '土城市工業區中山路59號', '02-2683366', 236, 39037, 7, ''),
(56, '陳福金', '副工程師', 'F01', '台北縣', '樹林鎮三俊街273號', '02-6882387', 223, 28840, 7, ''),
(57, '林靜秋', '維修副理', 'F01', '桃園縣', '龍潭鄉九龍村中興路九龍段3巷13號', '03-4792988', 325, 61285, 14, ''),
(58, '劉柏村', '維修經理', 'F01', '高雄市', '鼓山區明倫路514巷19號', '07-5836967', 804, 31930, 7, ''),
(59, '季正杰', '資深工程師', 'F01', '嘉義市', '中正路690號', '05-3714666', 600, 62830, 7, ''),
(60, '顧舜生', '系統工程師', 'G01', '台中市', '台中工業區37路46號', '04-3594510', 400, 34299, 7, ''),
(61, '祝閔豪', '系統工程師', 'G01', '台北市', '松山區民生東路4段54號9樓901室', '02-7152266', 105, 32445, 14, ''),
(62, '鄭力中', '硬體工程師', 'G01', '台北市', '長春路328號5樓之2', '02-7198303', 104, 33475, 7, ''),
(63, '范揚耀', '程式設計師', 'G01', '台北市', '新生南路一段121號4樓', '02-2990212', 106, 32445, 7, ''),
(64, '高鴻烈', '程式設計師', 'G01', '台南縣', '永康市王行路68巷263號', '06-2017777', 710, 32445, 7, ''),
(65, '林朝財', '資訊經理', 'G01', '高雄市', '三民區民族一路491號', '07-3410301', 807, 74160, 14, ''),
(66, '陳美玉', '網路工程師', 'G01', '新竹縣', '湖口鄉新竹工業區光復南路15號', '035-983683', 303, 35535, 7, ''),
(67, '吳淑芬', '市場分析師', 'H01', '台北市', '士林區中正路115號', '02-8822342', 111, 32445, 7, ''),
(68, '林俊成', '企劃專員', 'H01', '台北市', '大同區貴德街36巷5號', '02-5555601', 103, 33475, 7, ''),
(69, '簡清皛', '企劃專員', 'H01', '台北市', '中山北路六段75號', '02-8342662', 111, 31930, 7, ''),
(70, '謝彗萍', '企劃專員', 'H01', '台北市', '中山區建國北路1段88巷12號', '02-5062442', 104, 35535, 7, ''),
(71, '黃憲政', '企劃專員', 'H01', '台北縣', '土城市大暖路71號', '02-2683969', 236, 35535, 7, ''),
(72, '鄭黛明', '企劃助理', 'H01', '台北縣', '淡水鎮埤島里51-11號', '02-6222131', 251, 36565, 14, ''),
(73, '魏阿輝', '美工專員', 'H01', '台南市', '安南區安和路二段269號', '06-2552171', 709, 30900, 7, ''),
(74, '鄭元杰', '美工專員', 'H01', '台南縣', '麻豆鎮小埤里苓子林8-12號', '06-5703271', 721, 31930, 14, ''),
(75, '謝忠証', '美工助理', 'H01', '高雄市', '左營區新庄子路339巷3號', '07-3431236', 813, 29870, 7, ''),
(76, '王禾', '企劃副理', 'H01', '高雄縣', '橋頭鄉芋林路299號', '07-6116622', 825, 60770, 14, ''),
(77, '程光民', '企劃經理', 'H01', '雲林縣', '斗六市雲林路三段369號', '05-5222331', 640, 26368, 7, ''),
(78, '楊習仁', '人事經理', 'I01', '台中縣', '烏日鄉中山路一段和平巷150弄27號', '04-3372621', 414, 29767, 7, ''),
(79, '陳舜庭', '人事專員', 'I01', '台北市', '中山北路三段22號', '02-5925252', 104, 52530, 7, ''),
(80, '陳建岳', '人事專員', 'I01', '台南市', '中區中山路90號4樓', '06-2260191', 700, 23690, 7, ''),
(81, '劉伯村', '人事專員', 'I01', '高雄市', '小港區長春路5號', '07-8023601', 812, 28325, 7, ''),
(82, '張財全', '人事助理', 'I01', '高雄市', '前鎮區高雄加工出口區南一路10號', '07-8111171', 806, 31930, 7, ''),
(83, '陳淑慧', '行政助理', 'J01', '台北市', '大安區仁愛路四段109號15樓', '02-7110990', 106, 23690, 7, ''),
(84, '許進發', '行政經理', 'J01', '台北市', '敦化北路201-24號8樓', '02-7177888', 105, 21630, 14, ''),
(85, '王芳香', '行政專員', 'J01', '新竹市', '科學工業園區工業東二路6號', '035-773121', 300, 28840, 7, ''),
(86, '施美芳', '行政專員', 'J01', '嘉義縣', '水上鄉回歸村北回60號', '05-2357861', 608, 71997, 7, ''),
(87, '劉大慶', '總機', 'J01', '彰化縣', '和美鎮彰新路二段290號', '04-7351127', 508, 30900, 14, ''),
(88, '沈榮治', '會計助理', 'K01', '台北市', '莒光路310號5樓', '02-3062131', 108, 42436, 14, ''),
(89, '王繡瑩', '會計助理', 'K01', '台北市', '復興北路181號6樓', '02-7129111', 105, 41200, 7, ''),
(90, '林俐君', '會計師', 'K01', '台北市', '敦化北路201-24號後棟6樓', '02-7174500', 105, 28016, 7, ''),
(91, '李德竹', '會計師', 'K01', '台南縣', '歸仁鄉南保村中山路734號', '06-2301171', 711, 66950, 7, ''),
(92, '胡富傑', '會計經理', 'K01', '桃園縣', '觀音鄉富源村35-2號', '03-4901511', 328, 35535, 7, ''),
(93, '唐德義', '資深會計師', 'K01', '高雄市', '林森三路193巷34號', '07-3336571', 806, 32445, 14, ''),
(94, '鍾海萍', '資深會計師', 'K01', '新竹市', '科學工業園區展業一路20號2樓', '035-770255', 300, 25750, 7, ''),
(95, '溫智傑', '圖書助理', 'L01', '台北市', '中山區南京東路一段92號8樓', '02-5316125', 104, 21630, 7, ''),
(96, '邱資堡', '圖書助理', 'L01', '台北市', '塔城街66號3樓', '02-5523075', 103, 28943, 7, ''),
(97, '洪惠芬', '圖書館專員', 'L01', '高雄縣', '大社工業區興工路1-3號', '07-3514151', 815, 11330, 14, '');

-- --------------------------------------------------------

--
-- 資料表結構 `employee_list`
--

CREATE TABLE `employee_list` (
  `UID` int(20) NOT NULL COMMENT '員工編號',
  `usid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者暱稱',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者帳號',
  `passwd` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者密碼'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `employee_list`
--

INSERT INTO `employee_list` (`UID`, `usid`, `username`, `passwd`) VALUES
(1, '方重圍', 'aaa1@gmail.com', '123456'),
(2, '何茂宗', 'aaa2@gmail.com', '123456'),
(3, '黃慧萍', 'aaa3@gmail.com', '123456'),
(4, '林建興', 'aaa4@gmail.com', '123456'),
(5, '蔡豪鈞', 'aaa5@gmail.com', '123456'),
(6, '林森和', 'aaa6@gmail.com', '123456'),
(7, '黃志文', 'aaa7@gmail.com', '123456'),
(8, '張藍方', 'aaa8@gmail.com', '123456'),
(9, '徐煥坤', 'aaa9@gmail.com', '123456'),
(10, '王德惠', 'aaa10@gmail.com', '123456'),
(11, '莊清媚', 'aaa11@gmail.com', '123456'),
(12, '張景松', 'aaa12@gmail.com', '123456'),
(13, '李垂文', 'aaa13@gmail.com', '123456'),
(14, '盧大為', 'aaa14@gmail.com', '123456'),
(15, '江正維', 'aaa15@gmail.com', '123456'),
(16, '鍾智慧', 'aaa16@gmail.com', '123456'),
(17, '方鎮深', 'aaa17@gmail.com', '123456'),
(18, '楊銘哲', 'aaa18@gmail.com', '123456'),
(19, '王演銓', 'aaa19@gmail.com', '123456'),
(20, '易君揚', 'aaa20@gmail.com', '123456'),
(21, '鄭秀家', 'aaa21@gmail.com', '123456'),
(22, '王玉治', 'aaa22@gmail.com', '123456'),
(23, '林鳳春', 'aaa23@gmail.com', '123456'),
(24, '葉秀珠', 'aaa24@gmail.com', '123456'),
(25, '陳曉蘭', 'aaa25@gmail.com', '123456'),
(26, '吳美成', 'aaa26@gmail.com', '123456'),
(27, '莊國雄', 'aaa27@gmail.com', '123456'),
(28, '向大鵬', 'aaa28@gmail.com', '123456'),
(29, '陳詔芳', 'aaa29@gmail.com', '123456'),
(30, '陳雅賢', 'aaa30@gmail.com', '123456'),
(31, '吳國信', 'aaa31@gmail.com', '123456'),
(32, '張志輝', 'aaa32@gmail.com', '123456'),
(33, '林玉堂', 'aaa33@gmail.com', '123456'),
(34, '張世興', 'aaa34@gmail.com', '123456'),
(35, '朱金倉', 'aaa35@gmail.com', '123456'),
(36, '謝穎青', 'aaa36@gmail.com', '123456'),
(37, '毛渝南', 'aaa37@gmail.com', '123456'),
(38, '郭曜明', 'aaa38@gmail.com', '123456'),
(39, '李進祿', 'aaa39@gmail.com', '123456'),
(40, '陳惠娟', 'aaa40@gmail.com', '123456'),
(41, '林鵬翔', 'aaa41@gmail.com', '123456'),
(42, '黃大倫', 'aaa42@gmail.com', '123456'),
(43, '黃振清', 'aaa43@gmail.com', '123456'),
(44, '林國和', 'aaa44@gmail.com', '123456'),
(45, '黃秋好', 'aaa45@gmail.com', '123456'),
(46, '陳弘昌', 'aaa46@gmail.com', '123456'),
(47, '張琪', 'aaa47@gmail.com', '123456'),
(48, '許鴻章', 'aaa48@gmail.com', '123456'),
(49, '連邦俊', 'aaa49@gmail.com', '123456'),
(50, '張治', 'aaa50@gmail.com', '123456'),
(51, '吳寶珠', 'aaa51@gmail.com', '123456'),
(52, '洪毓祥', 'aaa52@gmail.com', '123456'),
(53, '丁組長', 'aaa53@gmail.com', '123456'),
(54, '李秋煌', 'aaa54@gmail.com', '123456'),
(55, '何信穎', 'aaa55@gmail.com', '123456'),
(56, '陳福金', 'aaa56@gmail.com', '123456'),
(57, '林靜秋', 'aaa57@gmail.com', '123456'),
(58, '劉柏村', 'aaa58@gmail.com', '123456'),
(59, '季正杰', 'aaa59@gmail.com', '123456'),
(60, '顧舜生', 'aaa60@gmail.com', '123456'),
(61, '祝閔豪', 'aaa61@gmail.com', '123456'),
(62, '鄭力中', 'aaa62@gmail.com', '123456'),
(63, '范揚耀', 'aaa63@gmail.com', '123456'),
(64, '高鴻烈', 'aaa64@gmail.com', '123456'),
(65, '林朝財', 'aaa65@gmail.com', '123456'),
(66, '陳美玉', 'aaa66@gmail.com', '123456'),
(67, '吳淑芬', 'aaa67@gmail.com', '123456'),
(68, '林俊成', 'aaa68@gmail.com', '123456'),
(69, '簡清皛', 'aaa69@gmail.com', '123456'),
(70, '謝彗萍', 'aaa70@gmail.com', '123456'),
(71, '黃憲政', 'aaa71@gmail.com', '123456'),
(72, '鄭黛明', 'aaa72@gmail.com', '123456'),
(73, '魏阿輝', 'aaa73@gmail.com', '123456'),
(74, '鄭元杰', 'aaa74@gmail.com', '123456'),
(75, '謝忠証', 'aaa75@gmail.com', '123456'),
(76, '王禾', 'aaa76@gmail.com', '123456'),
(77, '程光民', 'aaa77@gmail.com', '123456'),
(78, '楊習仁', 'aaa78@gmail.com', '123456'),
(79, '陳舜庭', 'aaa79@gmail.com', '123456'),
(80, '陳建岳', 'aaa80@gmail.com', '123456'),
(81, '劉伯村', 'aaa81@gmail.com', '123456'),
(82, '張財全', 'aaa82@gmail.com', '123456'),
(83, '陳淑慧', 'aaa83@gmail.com', '123456'),
(84, '許進發', 'aaa84@gmail.com', '123456'),
(85, '王芳香', 'aaa85@gmail.com', '123456'),
(86, '施美芳', 'aaa86@gmail.com', '123456'),
(87, '劉大慶', 'aaa87@gmail.com', '123456'),
(88, '沈榮治', 'aaa88@gmail.com', '123456'),
(89, '王繡瑩', 'aaa89@gmail.com', '123456'),
(90, '林俐君', 'aaa90@gmail.com', '123456'),
(91, '李德竹', 'aaa91@gmail.com', '123456'),
(92, '胡富傑', 'aaa92@gmail.com', '123456'),
(93, '唐德義', 'aaa93@gmail.com', '123456'),
(94, '鍾海萍', 'aaa94@gmail.com', '123456'),
(95, '溫智傑', 'aaa95@gmail.com', '123456'),
(96, '邱資堡', 'aaa96@gmail.com', '123456'),
(97, '洪惠芬', 'aaa97@gmail.com', '123456');

-- --------------------------------------------------------

--
-- 資料表結構 `factory_data`
--

CREATE TABLE `factory_data` (
  `factory_ID` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '公司代號',
  `factory_name` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '公司名稱',
  `factory_city` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '縣市',
  `factory_addr` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '地址',
  `factory_postal_code` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '郵遞區號',
  `factory_contact` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '聯絡人',
  `factory_contact_titles` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '職稱',
  `factory_contact_phone` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '電話',
  `factory_Industry` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '行業別',
  `factory_uniform_numbers` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '統一編號'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `factory_data`
--

INSERT INTO `factory_data` (`factory_ID`, `factory_name`, `factory_city`, `factory_addr`, `factory_postal_code`, `factory_contact`, `factory_contact_titles`, `factory_contact_phone`, `factory_Industry`, `factory_uniform_numbers`) VALUES
('A0001', '九和汽車股份有限公司', '台中市', '西屯區工業區12路5號', '407', '陳勳森', '採購專員', '04-7081881', '機械', '86281373'),
('A0002', '遠東氣體工業股份公司', '台北市', '北投區承德路7段371-1號', '100', '謝裕民', '行政專員', '02-7752450', '機械', '4675569'),
('A0003', '諾貝爾生物有限公司', '台北市', '松山區敦化北路122號3樓', '105', '翁崇銘', '工程師', '02-9015105', '機械', '22039731'),
('A0004', '有萬貿易股份有限公司', '台北市', '復興北路57號5樓', '108', '郭淑玲', '行政專員', '02-1879991', '食品', '85800192'),
('A0005', '真正精機股份有限公司', '台南縣', '歸仁鄉南興村中山路851號', '720', '廖述宏', '工程師', '06-8792123', '建築', '12231596'),
('A0006', '東興振業股份有限公司', '台南縣', '麻豆鎮小埤里苓子林8-12號', '710', '黃清吉', '總務主任', '06-4588455', '電機', '4735004'),
('A0007', '漢寶農畜產企業公司', '台中市', '西屯區台中工業區工業五路3號', '407', '林慶文', '工程師', '04-7613571', '電子', '7406808'),
('A0008', '大喬機械公司', '台中縣', '烏日鄉中山路三段6號', '414', '張君暉', '工程師', '04-2552171', '機械', '11222009'),
('A0009', '達亞汽車股份有限公司', '台北市', '大安區復興南路一段390號5樓之3', '106', '蔣清池', '總務主任', '02-2301212', '電子', '61781463'),
('A0010', '台灣航空電子股份公司', '台北市', '大安區敦化南路一段223號8樓', '106', '劉瑞復', '工程師', '02-7721320', '貿易', '97513218'),
('A0011', '洽興金屬工業股份公司', '台北市', '中山北路三段22號', '104', '梁文雄', '工程師', '02-2514474', '機械', '52003703'),
('A0012', '新益機械工廠股份公司', '台北市', '中山區松江路293號805室', '111', '林金源', '採購專員', '02-9991061', '機械', '3807628'),
('A0013', '天源義記機械股份公司', '台北市', '中山區南京東路3段65號2樓', '104', '陳幼獅', '行政專員', '02-7174500', '資訊', '79854797'),
('A0014', '家鄉事業股份有限公司', '台北市', '中正區博愛路154號6-7樓', '104', '林添財', '主任', '02-9179261', '機械', '11081681'),
('A0015', '四維企業(股)公司', '台北市', '中正區懷寧街43號6樓', '100', '張國萬', '採購專員', '02-6668541', '電子', '11099303'),
('A0016', '永輝興電機工業股份公司', '台北市', '忠孝東路四段285號13樓', '103', '陳世棟', '採購專員', '02-7195800', '機械', '22956788'),
('A0017', '溪泉電器工廠股份公司', '台北市', '松山區南京東路三段248號14樓', '110', '楊喜棠', '工程師', '02-1184988', '貿易', '51868406'),
('A0018', '善品精機股份有限公司', '台北市', '信義路五段2號14樓', '104', '李青潭', '工程師', '02-2595286', '機械', '3722109'),
('A0019', '佳樂電子股份有限公司', '台北市', '許昌街四二號九樓', '104', '李進興', '總務主任', '02-4688516', '化學', '52004800'),
('A0020', '科隆實業股份有限公司', '台北市', '塔城街66號3樓', '106', '蘇益慶', '工程師', '02-9879103', '化學', '86172733'),
('A0021', '永光壓鑄企業公司', '台北市', '土城市大暖路71號', '114', '張子信', '工程師', '02-1524755', '貿易', '5135739'),
('A0022', '正五傑機械股份有限公司', '台北縣', '土城市自強街29號', '241', '黃俊勝', '行政專員', '02-5569536', '機械', '61602905'),
('A0023', '集上科技股份有限公司', '台北縣', '汐止鎮大同路3段275號', '236', '徐旭明', '主任', '02-4247674', '建築', '73251209'),
('A0024', '強安鋼架工程股份有限公司', '台北縣', '板橋市民生路一段28號', '235', '林勝豐', '採購專員', '02-8795884', '食品', '7881361'),
('A0025', '菱生精密工業股份有限公司', '台北縣', '新店市寶興路45巷5號3樓', '251', '呂擇賞', '工程師', '02-4998556', '機械', '22099630'),
('A0026', '昆信機械工業股份有限公司', '台北縣', '仁德鄉保安村開發四路6號', '238', '鄭榮勳', '採購專員', '02-4489598', '機械', '72065240'),
('A0027', '麥柏股份有限公司', '桃園縣', '桃園市大林里大仁路50號', '334', '周正義', '主任', '03-4856525', '電子', '4697347'),
('A0028', '中友開發建設股份有限公司', '桃園縣', '楊梅鎮大同里行善路80號', '337', '陳登榜', '工程師', '03-1385562', '化學', '60330130'),
('A0029', '長生營造股份有限公司', '桃園縣', '龜山鄉善村文德路25號', '324', '黃正弘', '行政專員', '03-4855525', '建築', '3932533'),
('A0030', '百容電子股份有限公司', '桃園縣', '蘆竹鄉南崁路二段201巷7號', '330', '唐樂川', '總務主任', '03-2659569', '建築', '22099934'),
('A0031', '欣中天然氣股份有限公司', '桃園縣', '小港區中林路26號', '325', '林長芳', '工程師', '03-2365566', '電子', '86159485'),
('A0032', '比力機械工業股份公司', '桃園縣', '五福三路21號6樓', '338', '吳政翔', '總務主任', '03-4554521', '機械', '21222725'),
('A0033', '詮讚興業公司', '高雄市', '鼓山區明倫路514巷19號', '813', '劉宗齊', '採購專員', '07-2665563', '建築', '86379208'),
('A0034', '鐶琪塑膠股份有限公司', '高雄市', '大社工業區興工路1-3號', '806', '楊菊生', '工程師', '07-5645655', '建築', '75370905'),
('A0035', '亞智股份有限公司', '新竹市', '科學工業園區園區二路47號105室', '300', '賴朝宗', '採購', '035-189566', '電子', '84308030'),
('A0036', '九華營造工程股份有限公司', '新竹市', '竹東鎮中興路四段14號', '300', '胡明宗', '採購助理', '035-789542', '化學', '3703601'),
('A0037', '台灣保谷光學股份有限公司', '新竹市', '水上鄉回歸村北回60號', '300', '王振芳', '總務助理', '035-585985', '機械', '23120951'),
('A0038', '豐興鋼鐵(股)公司', '新竹縣', '秀水鄉埔崙村三越街82號', '302', '林清富', '工程師', '035-584425', '其他', '22018285'),
('A0039', '台灣勝家實業股份有限公司', '台中縣', '烏日鄉中山路一段和平巷150弄27號', '414', '顏仲仁', '總務主任', '04-8342662', '機械', '23418669'),
('A0040', '周家合板股份有限公司', '台北市', '士林區社中街76號', '111', '徐賢德', '工程師', '02-7351127', '化學', '11085292'),
('A0041', '英業達股份有限公司', '台北市', '大安區忠孝東路4段285號6樓', '106', '許金良', '採購專員', '02-5316125', '食品', '3767301'),
('A0042', '羽田機械股份有限公司', '台北市', '中山區南京東路二段95號11樓', '104', '徐惠秋', '總務主任', '02-7751286', '資訊', '6606103'),
('A0043', '中衛聯合開發公司', '台北市', '敦化南路522號2樓', '106', '巫嘉昌', '工程師', '02-1949849', '電機', '52004800'),
('A0044', '台中精機廠股份有限公司', '台北市', '華陰街119號', '105', '黃永松', '總務主任', '02-4789198', '機械', '77514419'),
('A0045', '東陽實業(股)公司', '台北縣', '新店市寶橋路229號', '220', '李春淵', '採購專員', '02-8499256', '電機', '23826519'),
('A0046', '金泰成粉廠股份有限公司', '台北縣', '樹林鎮東興街1號', '231', '林棟材', '工程師', '02-9985554', '化學', '12223723'),
('A0047', '現代農牧股份有限公司', '台南縣', '中壢市新生路二段334號', '721', '呂碧如', '工程師', '06-4882554', '機械', '41695406'),
('A0048', '惠亞工程股份有限公司', '台南縣', '八德市大湳里和平路1127號', '711', '張朝深', '總務主任', '06-8884551', '機械', '3329507'),
('A0049', '台灣釜屋電機股份有限公司', '桃園縣', '大園鄉橫峰村1號', '320', '陳世昌', '採購專員', '03-4884525', '其他', '7284214'),
('A0050', '國光血清疫苗製造公司', '桃園縣', '平鎮市建安村太平東路7號', '330', '陳標山', '行政專員', '03-5568425', '紡織', '37199708'),
('A0051', '台灣製罐工業股份有限公司', '桃園縣', '楊梅鎮秀才路520號', '337', '陳智雄', '工程師', '03-4825826', '貿易', '5630750'),
('A0052', '雅企科技(股)', '桃園縣', '龜山鄉樂善村文德路25號', '330', '陳肇源', '採購專員', '03-4851551', '建築', '76940003'),
('A0053', '國豐電線工廠股份有限公司', '新竹市', '科學工業園區園區二路40號1樓', '300', '鄭景昌', '行政專員', '035-645858', '電子', '12388674'),
('A0054', '金興鋼鐵股份有限公司', '新竹縣', '和美鎮彰美路二段106號', '310', '張永茂', '工程師', '035-851453', '機械', '85614991'),
('A0055', '原帥電機股份有限公司', '台中市', '南屯區南屯路三段86號', '408', '蔡淑慧', '工程師', '04-5062442', '建築', '75370905'),
('A0056', '新寶纖維股份有限公司', '台北市', '大安區敦化南路1段331號6樓', '106', '杜鴻國', '採購專員', '02-3592139', '機械', '38011301'),
('A0057', '太平洋汽門工業股份公司', '台北市', '中山區松江路301號9樓', '111', '葉育恩', '工程師', '02-4951111', '貿易', '12486393'),
('A0058', '喬福機械工業股份有限公司', '台北市', '中正區延平南路10號', '104', '林繼宗', '採購專員', '02-4648165', '食品', '22102494'),
('A0059', '楓原設計公司', '台北市', '南港區東新街34巷10號3樓', '105', '秦嘉鴻', '採購專員', '02-7899552', '食品', '74231126'),
('A0060', '日南紡織股份有限公司', '台北市', '三重市重新路五段609巷16號6樓', '106', '高文彬', '總務主任', '02-6548854', '建築', '6673382');

-- --------------------------------------------------------

--
-- 資料表結構 `order_input_data`
--

CREATE TABLE `order_input_data` (
  `O_data_ID` int(20) NOT NULL COMMENT '貨品流水編號',
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `P_ID` int(20) NOT NULL COMMENT '商品編號',
  `qty` int(11) NOT NULL COMMENT '購買數量',
  `S_name` int(11) NOT NULL COMMENT '優惠方案編號'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `order_input_data`
--

INSERT INTO `order_input_data` (`O_data_ID`, `O_ID`, `P_ID`, `qty`, `S_name`) VALUES
(1, 1, 2886, 37, 0),
(2, 1, 41012, 32, 0),
(3, 1, 41346, 30, 0),
(4, 2, 81580, 30, 0),
(5, 2, 2886, 30, 0),
(6, 2, 41012, 30, 0),
(7, 3, 92500, 30, 0),
(8, 3, 101168, 30, 0),
(9, 4, 101823, 30, 0),
(10, 4, 103483, 30, 0),
(11, 5, 104256, 30, 0),
(12, 6, 104256, 30, 0),
(13, 6, 89059, 30, 0),
(14, 7, 2886, 66, 0),
(15, 8, 2886, 66, 0),
(16, 9, 2886, 66, 0),
(17, 10, 101823, 25, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `order_input_list`
--

CREATE TABLE `order_input_list` (
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `UID_request` int(20) NOT NULL COMMENT '發出請求者(倉儲人員的ID)',
  `UID_executor` int(20) NOT NULL COMMENT '執行者(採購人員的ID)',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '訂購時間',
  `order_status` int(5) NOT NULL DEFAULT '1' COMMENT '訂單狀況',
  `O_addr` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '目的地'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `order_input_list`
--

INSERT INTO `order_input_list` (`O_ID`, `UID_request`, `UID_executor`, `order_date`, `order_status`, `O_addr`) VALUES
(1, 14, 42, '2021-02-05 07:57:29', 1, ''),
(2, 14, 42, '2021-02-08 03:23:36', 1, ''),
(3, 7, 42, '2021-02-08 00:23:22', 2, ''),
(4, 9, 42, '2021-02-08 00:23:24', 2, ''),
(6, 14, 42, '2021-02-08 00:23:30', 4, ''),
(7, 888, 0, '2021-02-22 03:37:54', 1, ''),
(9, 888, 0, '2021-02-24 23:27:31', 1, ''),
(10, 1, 0, '2021-02-25 01:08:04', 1, '');

-- --------------------------------------------------------

--
-- 資料表結構 `order_output_data`
--

CREATE TABLE `order_output_data` (
  `O_data_ID` int(20) NOT NULL COMMENT '貨品流水編號',
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `P_ID` int(20) NOT NULL COMMENT '商品編號',
  `qty` int(11) NOT NULL COMMENT '購買數量',
  `S_name` int(11) NOT NULL COMMENT '優惠方案編號'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `order_output_data`
--

INSERT INTO `order_output_data` (`O_data_ID`, `O_ID`, `P_ID`, `qty`, `S_name`) VALUES
(1, 1, 2886, 20, 0),
(2, 1, 41012, 55, 0),
(3, 1, 41346, 20, 0),
(4, 2, 81580, 21, 0),
(5, 2, 2886, 41, 0),
(6, 2, 41012, 20, 0),
(7, 3, 92500, 20, 0),
(8, 3, 101168, 40, 0),
(9, 4, 101823, 25, 0),
(10, 4, 103483, 77, 0),
(11, 5, 104256, 20, 0),
(12, 6, 104256, 20, 0),
(13, 6, 89059, 20, 0);

-- --------------------------------------------------------

--
-- 資料表結構 `order_output_list`
--

CREATE TABLE `order_output_list` (
  `O_ID` int(20) NOT NULL COMMENT '訂單編號',
  `UID` int(20) NOT NULL COMMENT '使用者編號',
  `order_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP COMMENT '訂購時間',
  `pay_method` int(5) NOT NULL COMMENT '付款方式',
  `send_method` int(5) NOT NULL COMMENT '運送方式',
  `pay_status` tinyint(1) NOT NULL DEFAULT '0' COMMENT '付款狀況',
  `order_status` int(5) NOT NULL DEFAULT '0' COMMENT '訂單狀況',
  `O_addr` varchar(200) COLLATE utf8_unicode_ci NOT NULL COMMENT '目的地'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `order_output_list`
--

INSERT INTO `order_output_list` (`O_ID`, `UID`, `order_date`, `pay_method`, `send_method`, `pay_status`, `order_status`, `O_addr`) VALUES
(1, 1, '2021-02-08 04:42:53', 1, 1, 1, 5, ''),
(2, 1, '2021-02-08 03:54:36', 1, 1, 1, 4, ''),
(3, 1, '2021-02-08 03:54:36', 1, 1, 1, 2, ''),
(4, 11, '2021-02-08 03:55:23', 1, 1, 0, 1, ''),
(6, 12, '2021-02-08 03:55:27', 1, 1, 0, 1, '');

-- --------------------------------------------------------

--
-- 資料表結構 `order_status_list`
--

CREATE TABLE `order_status_list` (
  `order_status_ID` int(11) NOT NULL COMMENT '處理狀態_code',
  `order_status_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '處理狀態_name',
  `all_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '說明文字',
  `status_output_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '處理狀態_出售_name',
  `status_output_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '出售_說明文字',
  `status_input_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '處理狀態_購入_name',
  `status_input_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '購入_說明文字',
  `send_method` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '運送方式',
  `send_method_text` varchar(200) CHARACTER SET utf32 COLLATE utf32_unicode_ci NOT NULL COMMENT '運送方式_說明文字',
  `pay_method` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '付款方式',
  `pay_method_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '付款方式_說明文字'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `order_status_list`
--

INSERT INTO `order_status_list` (`order_status_ID`, `order_status_name`, `all_text`, `status_output_name`, `status_output_text`, `status_input_name`, `status_input_text`, `send_method`, `send_method_text`, `pay_method`, `pay_method_text`) VALUES
(1, '等待處理', '起', '備貨中', '等待倉儲處理', '待處理', '等待採購處理', '', '', '', ''),
(2, '正在處理', '承', '出貨中', '有倉儲處理了', '處理中', '有採購處理了', '', '', '', ''),
(3, '已經處理', '轉', '已出貨', '倉儲已將貨品出貨', '已採購', '採購已送出訂單給上游', '', '', '', ''),
(4, '待取貨', '', '待領取', '待領取', '待領取', '待領取', '', '', '', ''),
(5, '已結案', '合', '已領取', '顧客已收到貨品', '已收件', '倉儲已收到貨品', '', '', '', ''),
(6, '已取消', '', '退貨', '', '退貨', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 資料表結構 `products`
--

CREATE TABLE `products` (
  `P_ID` int(20) NOT NULL COMMENT '商品編號',
  `P_name` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '商品名稱',
  `P_author` varchar(30) CHARACTER SET utf8 NOT NULL COMMENT '作者',
  `P_price` int(11) NOT NULL COMMENT '商品價格',
  `P_type_id` varchar(100) CHARACTER SET utf8 NOT NULL COMMENT '商品標籤',
  `P_NO` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '系列作_編號',
  `P_content` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT '商品資訊',
  `P_data` date DEFAULT NULL COMMENT '出版日期',
  `P_ISBN` varchar(100) CHARACTER SET utf8 DEFAULT NULL COMMENT 'ISBN'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `products`
--

INSERT INTO `products` (`P_ID`, `P_name`, `P_author`, `P_price`, `P_type_id`, `P_NO`, `P_content`, `P_data`, `P_ISBN`) VALUES
(2886, '拉普拉斯的魔女', '東野圭吾', 280, '5', '', '', '2021-01-21', ''),
(41012, '愚者的片尾', '米澤穗信', 182, '5', '', '', '2021-01-04', ''),
(41346, '庫特利亞芙卡的順序', '米澤穗信', 266, '5', '', '', '0000-00-00', ''),
(81580, '虛構推理', '城平京', 171, '5', '', '', '0000-00-00', ''),
(89059, '空挺Dragons', '桑原太矩', 195, '3', '', '', '0000-00-00', ''),
(92500, '嫌疑犯X的獻身【15週年紀念全新譯本】', '東野圭吾', 295, '5', '', '', '0000-00-00', ''),
(101168, '幼女戰記', 'カルロ・ゼン/篠月 しのぶ', 210, '3', '', '', '0000-00-00', ''),
(101823, '化物語', '西尾維新', 55, '3', '', '', '0000-00-00', ''),
(102024, '火舞', '黃曉惠水彩藝術', 630, '9', '', '', '0000-00-00', ''),
(103483, '日本庶民美食', '林潔珏、游翔皓、EZ Japan編輯部', 300, '2', '', '', '0000-00-00', ''),
(104256, '戈登˙拉姆齊的享瘦食譜', '戈登˙拉姆齊', 594, '11', '', '', '2020-12-15', '');

-- --------------------------------------------------------

--
-- 資料表結構 `special_offer`
--

CREATE TABLE `special_offer` (
  `S_ID` int(20) NOT NULL COMMENT '優惠方案ID',
  `S_name` varchar(30) NOT NULL COMMENT '優惠方案',
  `S_discount` float NOT NULL COMMENT '折扣率',
  `start_time` date NOT NULL COMMENT '開始時間',
  `end_time` date NOT NULL COMMENT '結束時間',
  `sale_col` varchar(20) NOT NULL COMMENT '促銷條件(欄位)',
  `sale_value` int(10) NOT NULL COMMENT '促銷條件(值)',
  `sale_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL COMMENT '促銷說明文字'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `special_offer`
--

INSERT INTO `special_offer` (`S_ID`, `S_name`, `S_discount`, `start_time`, `end_time`, `sale_col`, `sale_value`, `sale_text`) VALUES
(1, '懸疑大推行', 0.8, '2020-12-01', '2050-03-31', 'P_type_id', 5, NULL);

-- --------------------------------------------------------

--
-- 資料表結構 `stock`
--

CREATE TABLE `stock` (
  `P_ID` int(20) NOT NULL COMMENT '商品編號',
  `in_stock` int(20) NOT NULL COMMENT '實際庫存',
  `safety_stock` int(20) NOT NULL COMMENT '安全存量'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `stock`
--

INSERT INTO `stock` (`P_ID`, `in_stock`, `safety_stock`) VALUES
(2886, 60, 50),
(41012, 55, 50),
(41346, 40, 50),
(81580, 70, 50),
(89059, 55, 50),
(92500, 51, 50),
(101168, 70, 50),
(101823, 20, 50),
(102024, 40, 50),
(103483, 40, 50),
(104256, 51, 50);

-- --------------------------------------------------------

--
-- 資料表結構 `type_list`
--

CREATE TABLE `type_list` (
  `P_type_id` int(11) NOT NULL COMMENT '商品標籤(ID)',
  `P_type_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '商品標籤(名稱)',
  `sort` int(20) NOT NULL DEFAULT '1' COMMENT '排序'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `type_list`
--

INSERT INTO `type_list` (`P_type_id`, `P_type_name`, `sort`) VALUES
(1, '言情小說', 1),
(2, '文學小說', 1),
(3, '奇幻．科幻', 1),
(4, '詩集散文', 1),
(5, '懸疑．推理', 1),
(6, '愛情文藝', 1),
(7, '歷史．武俠', 1),
(8, '恐怖驚悚', 1),
(9, '文學研究．評論', 1),
(10, '其他', 5),
(11, '食譜', 2);

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `UID` int(20) NOT NULL COMMENT '使用者編號',
  `usid` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT '使用者暱稱',
  `username` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者帳號',
  `passwd` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '使用者密碼',
  `birthday` date DEFAULT NULL,
  `gender` enum('F','M') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT 'F',
  `addr` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usertype` int(11) DEFAULT NULL COMMENT '使用者權限類別'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`UID`, `usid`, `username`, `passwd`, `birthday`, `gender`, `addr`, `usertype`) VALUES
(1, '安安', 'ASD@gmail.com', '123456', NULL, 'F', NULL, 0),
(2, '', 'ZXC@gmail.com', 'asd75641', NULL, 'F', NULL, 0),
(3, '', 'WSX@gmail.com', '321654', NULL, 'F', NULL, 0),
(4, '', 'zzz@gmail.com', '125642', NULL, 'F', NULL, 0),
(5, '', 'xxx@gmail.com', '111111', NULL, 'F', NULL, 0),
(6, '', 'ccc@gmail.com', '555555', NULL, 'F', NULL, 0),
(7, '', 'aaa@gmail.com', '666666', NULL, 'F', NULL, 0),
(8, '', 'sss@gmail.com', '777888', NULL, 'F', NULL, 0),
(9, '', 'ddd@gmail.com', '999777', NULL, 'F', NULL, 0),
(10, '', 'fff@gmail.com', '222555', NULL, 'F', NULL, 0),
(11, '王曉明', 'aa@gmail.com', 'QAZWSX123', '2021-01-20', '', '台中市西區', NULL),
(12, 'ULL', '555a@gmail.com', '1234zxcv', '2021-01-12', '', '', NULL);

--
-- 已匯出資料表的索引
--

--
-- 資料表索引 `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`C_ID`);

--
-- 資料表索引 `dept_list`
--
ALTER TABLE `dept_list`
  ADD PRIMARY KEY (`dept_ID`);

--
-- 資料表索引 `employee_data`
--
ALTER TABLE `employee_data`
  ADD PRIMARY KEY (`UID`);

--
-- 資料表索引 `employee_list`
--
ALTER TABLE `employee_list`
  ADD PRIMARY KEY (`UID`);

--
-- 資料表索引 `factory_data`
--
ALTER TABLE `factory_data`
  ADD PRIMARY KEY (`factory_ID`);

--
-- 資料表索引 `order_input_data`
--
ALTER TABLE `order_input_data`
  ADD PRIMARY KEY (`O_data_ID`);

--
-- 資料表索引 `order_input_list`
--
ALTER TABLE `order_input_list`
  ADD PRIMARY KEY (`O_ID`);

--
-- 資料表索引 `order_output_data`
--
ALTER TABLE `order_output_data`
  ADD PRIMARY KEY (`O_data_ID`);

--
-- 資料表索引 `order_output_list`
--
ALTER TABLE `order_output_list`
  ADD PRIMARY KEY (`O_ID`);

--
-- 資料表索引 `order_status_list`
--
ALTER TABLE `order_status_list`
  ADD PRIMARY KEY (`order_status_ID`),
  ADD UNIQUE KEY `order_status_ID` (`order_status_ID`),
  ADD UNIQUE KEY `order_status_ID_2` (`order_status_ID`);

--
-- 資料表索引 `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`P_ID`);

--
-- 資料表索引 `special_offer`
--
ALTER TABLE `special_offer`
  ADD PRIMARY KEY (`S_ID`);

--
-- 資料表索引 `stock`
--
ALTER TABLE `stock`
  ADD PRIMARY KEY (`P_ID`);

--
-- 資料表索引 `type_list`
--
ALTER TABLE `type_list`
  ADD PRIMARY KEY (`P_type_id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`UID`);

--
-- 在匯出的資料表使用 AUTO_INCREMENT
--

--
-- 使用資料表 AUTO_INCREMENT `cart`
--
ALTER TABLE `cart`
  MODIFY `C_ID` int(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- 使用資料表 AUTO_INCREMENT `employee_list`
--
ALTER TABLE `employee_list`
  MODIFY `UID` int(20) NOT NULL AUTO_INCREMENT COMMENT '員工編號', AUTO_INCREMENT=98;

--
-- 使用資料表 AUTO_INCREMENT `order_input_data`
--
ALTER TABLE `order_input_data`
  MODIFY `O_data_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '貨品流水編號', AUTO_INCREMENT=18;

--
-- 使用資料表 AUTO_INCREMENT `order_input_list`
--
ALTER TABLE `order_input_list`
  MODIFY `O_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=11;

--
-- 使用資料表 AUTO_INCREMENT `order_output_data`
--
ALTER TABLE `order_output_data`
  MODIFY `O_data_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '貨品流水編號', AUTO_INCREMENT=14;

--
-- 使用資料表 AUTO_INCREMENT `order_output_list`
--
ALTER TABLE `order_output_list`
  MODIFY `O_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '訂單編號', AUTO_INCREMENT=7;

--
-- 使用資料表 AUTO_INCREMENT `products`
--
ALTER TABLE `products`
  MODIFY `P_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '商品編號', AUTO_INCREMENT=104261;

--
-- 使用資料表 AUTO_INCREMENT `special_offer`
--
ALTER TABLE `special_offer`
  MODIFY `S_ID` int(20) NOT NULL AUTO_INCREMENT COMMENT '優惠方案ID', AUTO_INCREMENT=2;

--
-- 使用資料表 AUTO_INCREMENT `type_list`
--
ALTER TABLE `type_list`
  MODIFY `P_type_id` int(11) NOT NULL AUTO_INCREMENT COMMENT '商品標籤(ID)', AUTO_INCREMENT=12;

--
-- 使用資料表 AUTO_INCREMENT `users`
--
ALTER TABLE `users`
  MODIFY `UID` int(20) NOT NULL AUTO_INCREMENT COMMENT '使用者編號', AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

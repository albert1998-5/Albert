
--
-- 資料表結構 `order_status`
--

CREATE TABLE `order_status` (
  `order_status_ID` int(11) NOT NULL COMMENT '處理狀態_code',
  `order_status_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '處理狀態_name',
  `all_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '說明文字',


  `status_output_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '處理狀態_出售_name',
  `status_output_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'output_說明文字',

  `status_input_name` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT '處理狀態_購入_name',
  `status_input_text` varchar(200) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL COMMENT 'input_說明文字'


) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- 資料表的匯出資料 `order_status`
--

-- INSERT INTO `order_status` (`P_type_id`, `P_type_name`, `sort`) VALUES
-- (1, '言情小說', 1),
-- (2, '文學小說', 1),
-- (3, '奇幻．科幻', 1),
-- (4, '詩集散文', 1),
-- (5, '懸疑．推理', 1),
-- (6, '愛情文藝', 1),
-- (7, '歷史．武俠', 1),
-- (8, '恐怖驚悚', 1),
-- (9, '文學研究．評論', 1),
-- (10, '其他', 5),
-- (11, '食譜', 2);


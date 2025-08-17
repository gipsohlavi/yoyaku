-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- ホスト: 127.0.0.1
-- 生成日時: 2025-07-17 10:25:10
-- サーバのバージョン： 10.4.32-MariaDB
-- PHP のバージョン: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- データベース: `hairtest`
--

-- --------------------------------------------------------

--
-- テーブルの構造 `customer`
--

DROP TABLE IF EXISTS `customer`;
CREATE TABLE `customer` (
  `c_id` int(6) NOT NULL,
  `name` varchar(16) NOT NULL,
  `namefuri` varchar(32) DEFAULT NULL,
  `tel` varchar(12) NOT NULL,
  `mail` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `customer`
--

INSERT INTO `customer` (`c_id`, `name`, `namefuri`, `tel`, `mail`) VALUES
(1, '田中太郎', 'タナカタロウ', '08000000001', 'test@test.jp'),
(2, '山下一郎', 'ヤマシタイチロウ', '08000000002', 'test2@test.jp'),
(20, '山田太郎', 'ヤマダタロウ', '02000010001', 'test@test.test'),
(21, '斎藤工', 'サイトウタクミ', '02000020002', 'test@test.test');

-- --------------------------------------------------------

--
-- テーブルの構造 `menu`
--

DROP TABLE IF EXISTS `menu`;
CREATE TABLE `menu` (
  `menu_id` int(2) NOT NULL,
  `menu_name` varchar(8) NOT NULL,
  `duration` time NOT NULL,
  `kingaku` int(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `menu`
--

INSERT INTO `menu` (`menu_id`, `menu_name`, `duration`, `kingaku`) VALUES
(1, 'カット', '00:30:00', 4000),
(2, 'カラー', '01:30:00', 7000),
(3, 'パーマ', '02:00:00', 8000),
(4, 'ヘッドスパ', '00:30:00', 2500),
(5, 'ヘアメイク', '01:00:00', 4000),
(6, 'カープ', '00:30:00', 1000);

-- --------------------------------------------------------

--
-- テーブルの構造 `reserve`
--

DROP TABLE IF EXISTS `reserve`;
CREATE TABLE `reserve` (
  `id` int(6) NOT NULL,
  `c_id` int(6) NOT NULL,
  `menu_id` int(2) NOT NULL,
  `res_date` datetime NOT NULL,
  `comp_date` datetime NOT NULL,
  `ins_date` datetime NOT NULL,
  `upd_date` datetime DEFAULT NULL,
  `bikou` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- テーブルのデータのダンプ `reserve`
--

INSERT INTO `reserve` (`id`, `c_id`, `menu_id`, `res_date`, `comp_date`, `ins_date`, `upd_date`, `bikou`) VALUES
(31, 13, 2, '2025-07-18 15:00:00', '2025-07-18 16:30:00', '2025-07-16 16:37:13', NULL, NULL),
(33, 13, 2, '2025-07-21 14:00:00', '2025-07-21 15:30:00', '2025-07-16 16:38:42', NULL, NULL),
(34, 13, 2, '2025-07-18 11:00:00', '2025-07-18 12:30:00', '2025-07-16 16:40:19', NULL, NULL),
(35, 20, 2, '2025-07-19 12:00:00', '2025-07-19 13:30:00', '2025-07-17 10:08:09', NULL, NULL),
(36, 21, 1, '2025-07-19 14:30:00', '2025-07-19 15:00:00', '2025-07-17 10:11:48', NULL, 'とくになし　');

--
-- ダンプしたテーブルのインデックス
--

--
-- テーブルのインデックス `customer`
--
ALTER TABLE `customer`
  ADD PRIMARY KEY (`c_id`);

--
-- テーブルのインデックス `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`menu_id`);

--
-- テーブルのインデックス `reserve`
--
ALTER TABLE `reserve`
  ADD PRIMARY KEY (`id`);

--
-- ダンプしたテーブルの AUTO_INCREMENT
--

--
-- テーブルの AUTO_INCREMENT `customer`
--
ALTER TABLE `customer`
  MODIFY `c_id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- テーブルの AUTO_INCREMENT `menu`
--
ALTER TABLE `menu`
  MODIFY `menu_id` int(2) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- テーブルの AUTO_INCREMENT `reserve`
--
ALTER TABLE `reserve`
  MODIFY `id` int(6) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

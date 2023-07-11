-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Mar 23, 2023 at 08:05 AM
-- Server version: 10.6.12-MariaDB-cll-lve
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u307116308_spar`
--

-- --------------------------------------------------------

--
-- Table structure for table `td_account_type`
--

CREATE TABLE `td_account_type` (
  `id` int(11) NOT NULL,
  `account_type` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_account_type`
--

INSERT INTO `td_account_type` (`id`, `account_type`) VALUES
(1, 'administrator'),
(2, 'mere user'),
(3, 'root');

-- --------------------------------------------------------

--
-- Table structure for table `td_activation_funds`
--

CREATE TABLE `td_activation_funds` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL,
  `status` varchar(10) DEFAULT NULL,
  `peer_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_advanced_withdrawals`
--

CREATE TABLE `td_advanced_withdrawals` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `capital` decimal(10,2) NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 0,
  `date_approved` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_banks`
--

CREATE TABLE `td_banks` (
  `id` int(11) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL,
  `country` varchar(30) NOT NULL,
  `swift_code` varchar(20) NOT NULL,
  `bank_code` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_banks`
--

INSERT INTO `td_banks` (`id`, `bank_name`, `account_name`, `account_number`, `member_id`, `country`, `swift_code`, `bank_code`) VALUES
(1001, '', '', '', 3, '', '', ''),
(1073, '', '', '', 75, '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `td_btc`
--

CREATE TABLE `td_btc` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_daily_income`
--

CREATE TABLE `td_daily_income` (
  `id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `member_id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_deposits`
--

CREATE TABLE `td_deposits` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_approved` datetime DEFAULT NULL,
  `amount` decimal(10,0) NOT NULL,
  `deposit_options_id` int(11) NOT NULL,
  `package_id` int(11) NOT NULL,
  `is_pending` tinyint(1) NOT NULL,
  `is_expired` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_deposit_options`
--

CREATE TABLE `td_deposit_options` (
  `id` int(11) NOT NULL,
  `name` varchar(200) NOT NULL,
  `account` varchar(255) NOT NULL,
  `tag` varchar(20) NOT NULL,
  `rule` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_deposit_options`
--

INSERT INTO `td_deposit_options` (`id`, `name`, `account`, `tag`, `rule`) VALUES
(1, 'Bitcoin', '3NF8LgaoZWGYXXR2JoW8jTJ4eRKpxjQUnY', '', ''),
(3, 'Ethereum', '0x69ef66396c6296680b4bebfd50342650abe6113a', '', ''),
(11, 'Account Balance', '', '', ''),
(12, 'XRP', 'rBA7oBScBPccjDcmGhkmCY82v2ZeLa2K2f\n', '87743575', ''),
(13, 'BNB', '0x69ef66396c6296680b4bebfd50342650abe6113a', '', ''),
(14, 'Litecoin', 'MKL4bzAdtAd8esbopA3GpwHA47ZR2Lfwwb', '', ''),
(16, 'USDT', '0x105911b272089d5b9a73d2e899e4d1aab2b6f569', '', ''),
(17, 'Activation Fund', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `td_franchise_applications`
--

CREATE TABLE `td_franchise_applications` (
  `id` int(11) NOT NULL,
  `entry` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `td_franchise_applications`
--

INSERT INTO `td_franchise_applications` (`id`, `entry`) VALUES
(11, 'uno uno uno\nPERSONAL INFORMATION \nTarget country: AF\nName of owner: \nName of CEO/Managing Director: \nName of primary contact person: \nEmail address primary contact: \n\nCORPORATE DETAILS \nName of the company: \nTelephone: \nGeneral description of your business activities: \nAddress: \nHow many company owned grocery outlets do you have?: \nHow many other company owned retail outlets do you have?: \nWhich type of grocery retail outlets do you have?:  \nWhere are your stores located?:  \nWhat is the total annual turnover of the total company?: \nWhat is the average size of the sales area in your stores?: \nWhat is the annual grocery retail turnover of your company?: \nHow many Distribution Centres does the company own?: \n\nABOUT SPAR \nWhy do you want to join SPAR?: \nWhere did you first hear about SPAR?:  , News paper\n');

-- --------------------------------------------------------

--
-- Table structure for table `td_fund_bonus`
--

CREATE TABLE `td_fund_bonus` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `referral_bonus_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_fund_transfer`
--

CREATE TABLE `td_fund_transfer` (
  `id` int(11) NOT NULL,
  `sender_member_id` int(11) NOT NULL,
  `receiver_member_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `source_of_fund` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_gcash`
--

CREATE TABLE `td_gcash` (
  `id` int(11) NOT NULL,
  `phone_number` varchar(200) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_group_sales`
--

CREATE TABLE `td_group_sales` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `month` int(11) NOT NULL,
  `year` int(11) NOT NULL DEFAULT 2021,
  `bonus` float NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_lifestyle_bonus`
--

CREATE TABLE `td_lifestyle_bonus` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `referral_bonus_id` int(11) NOT NULL,
  `amount` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_members`
--

CREATE TABLE `td_members` (
  `id` int(11) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `username` varchar(200) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `date` datetime NOT NULL,
  `password` varchar(255) NOT NULL,
  `account_type_id` int(11) NOT NULL DEFAULT 2,
  `country` varchar(200) NOT NULL,
  `beneficiary` varchar(50) NOT NULL,
  `verified` tinyint(1) NOT NULL,
  `verification_code` varchar(10) NOT NULL,
  `referred_by` tinytext NOT NULL,
  `auth_code` varchar(5) NOT NULL,
  `last_access` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_members`
--

INSERT INTO `td_members` (`id`, `full_name`, `username`, `email_address`, `date`, `password`, `account_type_id`, `country`, `beneficiary`, `verified`, `verification_code`, `referred_by`, `auth_code`, `last_access`) VALUES
(1, 'root root', 'root', 'e@g.c', '2022-07-12 00:00:00', '123456', 3, '', '', 1, 'INTSEAINC', '', '', '2022-07-12 22:09:27'),
(3, 'uno uno uno', 'uno', 'av2@gmail.com', '2022-07-12 22:09:48', '$2y$11$uVizruKc3R9VhMOLJDQMqehvxCfkNTejcA9fP/CdxEeLeml/hSj1K', 2, '', '', 1, 'INTSEAINC', 'root', '17836', '2022-07-12 22:09:48'),
(75, 'Administrator', 'adminspar', 'sparmain23@gmail.com', '2023-03-23 15:19:17', '$2y$11$FOCXqGmsl0c8G08Cp.mFLulOwH5oQPPd0fuBj9hYGSx9SJXs7TCgW', 1, '', '', 1, 'INTSEAINC', 'uno', '', '2023-03-23 15:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `td_messages`
--

CREATE TABLE `td_messages` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `member_id` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_packages`
--

CREATE TABLE `td_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(255) NOT NULL,
  `daily_rate` float NOT NULL,
  `minimum_amount` float NOT NULL,
  `maximum_amount` float NOT NULL,
  `duration_in_days` int(11) NOT NULL,
  `expected_profit` decimal(10,0) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_packages`
--

INSERT INTO `td_packages` (`id`, `package_name`, `daily_rate`, `minimum_amount`, `maximum_amount`, `duration_in_days`, `expected_profit`) VALUES
(1, 'ASSOCIATE MEMBERSHIP PACKAGE', 1, 200, 1999.99, 150, NULL),
(2, 'PREMIUM MEMBERSHIP PACKAGE', 1.25, 2000, 19999, 125, NULL),
(5, 'V.I.P. MEMBERSHIP PACKAGE', 2, 20000, 100000000, 100, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `td_profile_picture`
--

CREATE TABLE `td_profile_picture` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `image_name` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_referrals`
--

CREATE TABLE `td_referrals` (
  `id` int(11) NOT NULL,
  `referrer_id` int(11) NOT NULL,
  `referee_id` int(11) NOT NULL,
  `referral_bonus` decimal(10,0) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_referral_bonus`
--

CREATE TABLE `td_referral_bonus` (
  `id` int(11) NOT NULL,
  `deposit_id` int(11) NOT NULL,
  `referrer_id` int(11) NOT NULL,
  `amount` decimal(10,5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_referral_codes`
--

CREATE TABLE `td_referral_codes` (
  `id` int(11) NOT NULL,
  `code` varchar(10) NOT NULL,
  `is_taken` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_referral_codes`
--

INSERT INTO `td_referral_codes` (`id`, `code`, `is_taken`) VALUES
(26, 'SQkGDu', 1),
(610, 'WiYoJZ', 1),
(611, 'JsZD2Q', 1),
(612, 'LQiIhw', 1),
(613, 'SXlu3K', 0),
(614, 'fpqgcK', 0),
(615, '7mt9hC', 0),
(616, 'gxmaiR', 0),
(617, '5X2gSr', 0),
(618, '3eQUzf', 0),
(619, 'MuSX01', 0),
(620, 'SxkHGC', 0),
(621, 'F1BcLO', 0),
(622, 't1xbPD', 0),
(623, 'bCYU9Q', 0),
(624, 'ubU8mB', 0),
(625, 'S6oyGU', 0),
(626, 'eI45Vb', 0),
(627, 'W8d2oV', 0),
(628, 'FpnZTm', 0),
(629, '2ryH5P', 0),
(630, 'xqgRjh', 0),
(631, '3ZN6sX', 0),
(632, 'qnirkf', 0),
(633, 'uEM17O', 0),
(634, 'R3aqQH', 0),
(635, '1GV70s', 0),
(636, 'AYQye3', 0),
(637, 'b7NPm5', 0),
(638, 'n5jh4U', 0),
(639, 'ZdAaEz', 0),
(640, 'kzlQhq', 0),
(641, 'L5zyRI', 0),
(642, 'Xv4KPt', 0),
(643, 'Lpdi8m', 0),
(644, 'MuOJvy', 0),
(645, 'KoQxE4', 0),
(646, 'bTpqZj', 0),
(647, 'jYcfbm', 0),
(648, 'M27VNO', 0),
(649, 'PyI1xu', 0),
(650, 'PpfuHV', 0),
(651, 'uxN28S', 0),
(652, 'MlfRBb', 0),
(653, 'tria6K', 0),
(654, 'NH9IOL', 0),
(655, '0WHwah', 0),
(656, 'RV3rKO', 0),
(657, 'IjwRT9', 0),
(658, '0zqPA2', 0),
(659, '5GEwIu', 0),
(660, '0iFUuI', 0),
(661, 'Nzhpwb', 0),
(662, 'PjbGz1', 0),
(663, 'zviuJ1', 0),
(664, '3XJ7Wx', 0),
(665, 'tWlT8k', 0),
(666, 'RknGwJ', 0),
(667, 'QFekR2', 0),
(668, '1z8pr2', 0),
(669, 'CjYWu5', 0),
(670, 'd8ZSBG', 0),
(671, 'ZpRgcG', 0),
(672, 'WiFBGm', 0),
(673, 'qH5Cme', 0),
(674, 'Lfzckp', 0),
(675, '1XkDUd', 0),
(676, 'KvFCSg', 0),
(677, 'mVLpzs', 0),
(678, '5nyQ31', 0),
(679, 'h97oeN', 0),
(680, '1haqIi', 0),
(681, 'iDj3v7', 0),
(682, 'Pj8ZmL', 0),
(683, 'Zi5jJw', 0),
(684, 'RkpCYr', 0),
(685, 'lXC2cg', 0),
(686, '9cS8Yf', 0),
(687, '5ReDYr', 0),
(688, 'pU1MSe', 0),
(689, 'vyqIcg', 0),
(690, 'plM0w8', 0),
(691, 'qQc89r', 0),
(692, 'xYNzuc', 0),
(693, 'dXTSqr', 0),
(694, 'RjEyUP', 0),
(695, 'p4EJQe', 0),
(696, '76U0xQ', 0),
(697, 'OHX1yp', 0),
(698, 'i81c9f', 0),
(699, '1wm4Xn', 0),
(700, '380xe6', 0),
(701, 'BLEpiN', 0),
(702, 'dAplLf', 0),
(703, '36JRVo', 0),
(704, '0vTWkO', 0),
(705, 'wNUM3T', 0),
(706, '8Woym9', 0),
(707, 'mQwhcR', 0),
(708, 'thu3qT', 0),
(709, 'aKBGZo', 0),
(710, 'VYomDw', 0),
(711, 'MQBUpF', 0),
(712, 'MvuY3R', 0),
(713, 'gIjRyV', 0),
(714, '8Og5RA', 0),
(715, 'Z8MtFx', 0),
(716, 'ZL4FKJ', 0),
(717, 'Wp5CyD', 0),
(718, 'NQ8zLA', 0),
(719, 'OFgiK2', 0),
(720, '76wEHB', 0),
(721, '9zOhtT', 0),
(722, 'T3DSKG', 0),
(723, 'WFzIXh', 0),
(724, 's5OudU', 0),
(725, 'CIfl5w', 0),
(726, 'i5ADxf', 0),
(727, 'Xb1L8n', 0),
(728, 'Y6VKFU', 0),
(729, 'qXywKE', 0),
(730, 'Np82sz', 0),
(731, 'rLZbQC', 0),
(732, 'OuZH1l', 0),
(733, 'qjGAT4', 0),
(734, 'A2kdPa', 0),
(735, 's5GFzV', 0),
(736, 'RmClAN', 0),
(737, 'TwRWX6', 0),
(738, 's1RKAj', 0),
(739, 'N12doZ', 0),
(740, 'Vz8huK', 0),
(741, 'snJTKo', 0),
(742, 'cYSl45', 0),
(743, '3XBxnE', 0),
(744, 'ltFIjN', 0),
(745, '42gLKi', 0),
(746, 'Ob6pLD', 0),
(747, '71y2It', 0),
(748, 'pBdHRa', 0),
(749, 'nWS9E6', 0),
(750, 'E5uGAn', 0),
(751, 'GCxZHT', 0),
(752, 'xf5PwV', 0),
(753, 'phzHn6', 0),
(754, 'Dprczn', 0),
(755, '8F2S6K', 0),
(756, 'L6sWf4', 0),
(757, 'wfestx', 0),
(758, '2WkSmw', 0),
(759, 'exAfmM', 0),
(760, 'LgrGTB', 0),
(761, '6qHeI3', 0),
(762, 'aUl4bo', 0),
(763, 'MgY86B', 0),
(764, 'A3ZlkS', 0),
(765, 'j89LBo', 0),
(766, 'xQHCeb', 0),
(767, 'lQOrfC', 0),
(768, 'HWdMbE', 0),
(769, 'y6YrXO', 0),
(770, 'lajpBm', 0),
(771, 'eE3Cwh', 0),
(772, 'wUui5C', 0),
(773, 'QHmjI7', 0),
(774, 'E30196', 0),
(775, 'kwYVAt', 0),
(776, 'HFTZ3U', 0),
(777, 'Vhng8Z', 0),
(778, '5pc0wY', 0),
(779, 'gG8lhc', 0),
(780, 'g5Da9M', 0),
(781, 'MvNnbl', 0),
(782, '4EIhTl', 0),
(783, 'DwNRil', 0),
(784, 'oh4u1N', 0),
(785, 'UBFEtJ', 0),
(786, 'ebXGvF', 0),
(787, 'eBkiHp', 0),
(788, 'EsAlw9', 0),
(789, 'YLIWsp', 0),
(790, 'H0hNj5', 0),
(791, '7aEWjv', 0),
(792, 'UYtJi7', 0),
(793, 'DQHjhT', 0),
(794, 'CNqvRb', 0),
(795, '3xceU1', 0),
(796, 'XPvETc', 0),
(797, 'wGEXu0', 0),
(798, 'MbVNJd', 0),
(799, 'Mhdix8', 0),
(800, 'rCoR5q', 0),
(801, 'nmNDCI', 0),
(802, 'jYeUXC', 0),
(803, 'tWVuo5', 0),
(804, 'RVkCju', 0),
(805, 'qiRN3r', 0),
(806, 'dyg25I', 0),
(807, '0z4T2F', 0),
(808, 'GaxJk1', 0),
(809, 'Zrf7vT', 0),
(810, 'fOpD4H', 0),
(811, 'pg8DSJ', 0),
(812, 'ye5sAm', 0),
(813, 'A4HzBZ', 0),
(814, 'qtFJKj', 0),
(815, 'qGHxZ6', 0),
(816, '0mN3gh', 0),
(817, '56zoAx', 0),
(818, 'ps45iV', 0),
(819, 'wG5Wxf', 0),
(820, 'FAt8gK', 0),
(821, 'Z7Shdy', 0),
(822, 'SiR6ce', 0),
(823, 'iVHqmM', 0),
(824, 'DJYaFe', 0),
(825, 'xwjUi1', 0),
(826, 'l6ODQ5', 0),
(827, 'yMSctB', 0),
(828, 'c2AyKe', 0),
(829, 'jKgvYE', 0),
(830, 'F1SJTL', 0),
(831, 'nfNQ7i', 0),
(832, '9mDhO4', 0),
(833, 'ACF1vf', 0),
(834, '7N4RiV', 0),
(835, 'xP2dMF', 0),
(836, 'TODnjs', 0),
(837, '8sDHY3', 0),
(838, 'rXNRyc', 0),
(839, '5s1VEA', 0),
(840, 'duNRIb', 0),
(841, 'nT6wUx', 0),
(842, 'ahqbsZ', 0),
(843, 'lL2GXo', 0),
(844, 'eTL1om', 0),
(845, 'xbdR67', 0),
(846, 'IGcu2l', 0),
(847, 'RDPxaX', 0),
(848, '4Wx9ek', 0),
(849, 'wvUYcz', 0),
(850, 'MVWnN3', 0),
(851, 'VDSoEw', 0),
(852, 'zYAfxB', 0),
(853, '9WxKLf', 0),
(854, 'S6z4nN', 0),
(855, 'kewMc7', 0),
(856, '0oVOlw', 0),
(857, 'KsRdTI', 0),
(858, 'Xo3sLO', 0),
(859, 'iRmWr2', 0),
(860, 'iXeV1C', 0),
(861, 'm4sDzc', 0),
(862, '6Z5a0y', 0),
(863, 'w7oRHu', 0),
(864, 'alkyGx', 0),
(865, 'LwtV9P', 0),
(866, 'JItg4s', 0),
(867, 'JqoCSA', 0),
(868, 'Kz7YwN', 0),
(869, 'RY108u', 0),
(870, 'Dl3kcb', 0),
(871, '4v5zeA', 0),
(872, 'YTL1Pj', 0),
(873, 'EBhYJt', 0),
(874, 'En4LyO', 0),
(875, 'k5f1KT', 0),
(876, 'jHP8qt', 0),
(877, 'XkJH6C', 0),
(878, '3jekDM', 0),
(879, 'mdRUj0', 0),
(880, 'b4QX71', 0),
(881, 'ctw0YN', 0),
(882, 'JDNlj0', 0),
(883, '813Dod', 0),
(884, 'XfpYdt', 0),
(885, 'luydfx', 0),
(886, 'UBY98I', 0),
(887, 'H9xauF', 0),
(888, 'dDkRhq', 0),
(889, '8c0EMY', 0),
(890, 'QmO7gb', 0),
(891, 'NQ3mf9', 0),
(892, 'hSCmlY', 0),
(893, 'B2E7PJ', 0),
(894, 'yV6i3f', 0),
(895, 'pcNT6f', 0),
(896, '7ZW6tR', 0),
(897, 'K21Cut', 0),
(898, '3Fvxud', 0),
(899, 'ZWP91J', 0),
(900, 'YyaVZ3', 0),
(901, 'jfiuoZ', 0),
(902, 'pSGgKy', 0),
(903, 'IJFi4h', 0),
(904, 'ldiFns', 0),
(905, 'mOQlUD', 0),
(906, 'lEx8Gs', 0),
(907, 'ltVgDm', 0),
(908, 'RfvEUo', 0),
(909, 'i7CX85', 0),
(910, 'nhmfxd', 0),
(911, 'jTbEeK', 0),
(912, 'rqlLCM', 0),
(913, 'Aexr1W', 0),
(914, 'OBHvt3', 0),
(915, 'Fdnlrz', 0),
(916, '0kKHJL', 0),
(917, 'b05Vt1', 0),
(918, 'eFUQ1R', 0),
(919, 'NxXu4H', 0),
(920, 'ip8BJ3', 0),
(921, '0oyba3', 0),
(922, 'NV6wcT', 0),
(923, 'EyYtMk', 0),
(924, 'PrIJEz', 0),
(925, 'Ba8nJV', 0),
(926, '6RB4TY', 0),
(927, 'nafbuT', 0),
(928, 'xbaVON', 0),
(929, 'Ce17PR', 0),
(930, 'mgb3H1', 0),
(931, 'GDBKqQ', 0),
(932, 'sDi8Vh', 0),
(933, 'i76pfh', 0),
(934, 'APGhZ3', 0),
(935, 'EyBRTq', 0),
(936, 'N9IYcC', 0),
(937, 'c6MVES', 0),
(938, 'dNAjfV', 0),
(939, 'DiGQn3', 0),
(940, '0scWUj', 0),
(941, 'aobFNu', 0),
(942, 'LriQnJ', 0),
(943, 'V8WwgY', 0),
(944, 'j4JhMW', 0),
(945, 'e1h5Pf', 0),
(946, 'Tx3WPN', 0),
(947, '1GbZyF', 0),
(948, 'QT69mf', 0),
(949, 'rCfuLP', 0),
(950, 'OSGrta', 0),
(951, 'spbOCY', 0),
(952, 'Zp8MYI', 0),
(953, 'aVOWCy', 0),
(954, 'h4Byxq', 0),
(955, 'sxgu01', 0),
(956, 'pzUBLt', 0),
(957, 'Rab31w', 0),
(958, 'KNYATO', 0),
(959, 'S3U1pP', 0),
(960, 'xQ2hgc', 0),
(961, 'PN0hZR', 0),
(962, 'CRJpZd', 0),
(963, '2c7N1R', 0),
(964, '9XBoum', 0),
(965, 'U0WomH', 0),
(966, 'uQ5D2d', 0),
(967, '6dAuPi', 0),
(968, 'xVaTuD', 0),
(969, 'DG8UfN', 0),
(970, 'OUHGvN', 0),
(971, 'gUeGMI', 0),
(972, 'MEhczg', 0),
(973, 'LigFRb', 0),
(974, 'SBilKz', 0),
(975, 'QxE6iF', 0),
(976, 'REIeGv', 0),
(977, '7IQy1P', 0),
(978, 'M1YWpA', 0),
(979, 'CJIl1D', 0),
(980, 's5Meng', 0),
(981, '5CvzHD', 0),
(982, 'MC5Le8', 0),
(983, '7Ia6su', 0),
(984, 'UPYdjh', 0),
(985, 'MYkqLF', 0),
(986, 'z1cGZT', 0),
(987, 'CqzMfl', 0),
(988, 'HeEN1j', 0),
(989, 'Oxr36H', 0),
(990, 'RLkHgc', 0),
(991, 'xZ21E5', 0),
(992, '3g4Hsd', 0),
(993, 'z4QpJR', 0),
(994, '2EToe1', 0),
(995, 'uLiWCO', 0),
(996, 'XLq5E2', 0),
(997, 'RNiGW1', 0),
(998, '5GyvNf', 0),
(999, 'TA5oeN', 0),
(1000, '3bKicY', 0),
(1001, '4eqjnW', 0),
(1002, 'cxWT2y', 0),
(1003, 'HlunrV', 0),
(1004, '2PwnAc', 0),
(1005, 'eJKMIU', 0),
(1006, 'UGErT8', 0),
(1007, 'B84kRf', 0),
(1008, 'TIAY0Q', 0),
(1009, 'h9dmSE', 0),
(1010, 'MYcAbV', 0),
(1011, 'P985Z4', 0),
(1012, 'qYn2wE', 0),
(1013, 'scM39D', 0),
(1014, 'sCRK9Y', 0),
(1015, 'Tv4I61', 0),
(1016, 'SIfaen', 0),
(1017, 'o4DdEB', 0),
(1018, 'XRHMIs', 0),
(1019, 'ost7za', 0),
(1020, 'j2VPSJ', 0),
(1021, 'blpXFB', 0),
(1022, 'is6UDF', 0),
(1023, 'jCguNW', 0),
(1024, 'a7eNLu', 0),
(1025, 'etyvAi', 0),
(1026, 'VC1ukY', 0),
(1027, 'GnSQ3R', 0),
(1028, '52bl4r', 0),
(1029, 'wmhln4', 0),
(1030, 'BaZXI8', 0),
(1031, 'J8paZj', 0),
(1032, 'Wqje2L', 0),
(1033, 'wJyEOV', 0),
(1034, '8Rd3iH', 0),
(1035, 'R4u37y', 0),
(1036, 'LFqg7t', 0),
(1037, 'WYbM9C', 0),
(1038, 'S0pmUL', 0),
(1039, 'j3D9Hn', 0),
(1040, '4nl708', 0),
(1041, 'UbHPAi', 0),
(1042, 'S7NReP', 0),
(1043, 'dcZ4k6', 0),
(1044, 'FZD0iJ', 0),
(1045, 'lutNw1', 0),
(1046, 'H1tnYO', 0),
(1047, 'hBZFSI', 0),
(1048, 'pZveSF', 0),
(1049, 'Fx0Wd1', 0),
(1050, 'jDnfYB', 0),
(1051, 'RFUNaz', 0),
(1052, 'YDGr6M', 0),
(1053, 'ImSf6l', 0),
(1054, '6IJtCU', 0),
(1055, 'xSBb2s', 0),
(1056, 'njmtz3', 0),
(1057, '7J6KH3', 0),
(1058, 'eGEuvd', 0),
(1059, 'kNEA0p', 0),
(1060, 'i78t6p', 0),
(1061, 'VWHDN1', 0),
(1062, 'BOahoq', 0),
(1063, 'NpiDA6', 0),
(1064, '8tpL7T', 0),
(1065, 'GPgdqN', 0),
(1066, '8JLNkg', 0),
(1067, 'W5UD7q', 0),
(1068, 's5gVPy', 0),
(1069, '1fRDiE', 0),
(1070, 'S104pL', 0),
(1071, 'B4pAa5', 0),
(1072, 'xjY8k4', 0),
(1073, 'LVz87A', 0),
(1074, 'hNv8kJ', 0),
(1075, 'ifR3SK', 0),
(1076, 'JMADFG', 0),
(1077, 'S9wVY2', 0),
(1078, 'b3aYlJ', 0),
(1079, 'NJ72dW', 0),
(1080, 'iLBzlJ', 0),
(1081, 'LoC2EO', 0),
(1082, 'IBR6yK', 0),
(1083, 'RyFJn6', 0),
(1084, 'PTxvHV', 0),
(1085, 'M0Wmik', 0),
(1086, 'mWLvtI', 0),
(1087, 'Vs4YJW', 0),
(1088, 'mgqD7t', 0),
(1089, 'hNZwHs', 0),
(1090, 'QkAzqa', 0),
(1091, 'ho4IT7', 0),
(1092, 'kT4zLU', 0),
(1093, 'LDogKc', 0),
(1094, 'XQL2Sf', 0),
(1095, 'jfcR5m', 0),
(1096, 'zshuxD', 0),
(1097, 'UGiJ82', 0),
(1098, 'NriRuH', 0),
(1099, 'vzmajo', 0),
(1100, 'lxZIAE', 0),
(1101, 'i5VrnK', 0),
(1102, 'ykIK6F', 0),
(1103, 'XY5BWG', 0),
(1104, 'PiEvaC', 0),
(1105, 'gr7zps', 0),
(1106, 'jXI9SW', 0),
(1107, 'hcSbdJ', 0),
(1108, 'PfTEpz', 0),
(1109, 'OtfgXJ', 0),
(1110, '38PnsX', 0),
(1111, 'iYQobf', 0),
(1112, '0u2i6p', 0),
(1113, 'BSAmj2', 0),
(1114, 'Xw7jgl', 0),
(1115, 'bPeufo', 0),
(1116, 'iMnJYW', 0),
(1117, 'B1Pqe2', 0),
(1118, '5Ar0KN', 0),
(1119, 'ln5KaS', 0),
(1120, 'QFvl5y', 0),
(1121, 'TH56o2', 0),
(1122, 'weDhtW', 0),
(1123, 'Tp9iRC', 0),
(1124, 'cMRYNl', 0),
(1125, '8WDSJZ', 0),
(1126, 'ZWVOSt', 0),
(1127, 'NI2MTz', 0),
(1128, '65Moz8', 0),
(1129, 'xYHGoV', 0),
(1130, '6iGjAq', 0),
(1131, 'vaXEZf', 0),
(1132, 'MbHv9Y', 0),
(1133, 'hINKyu', 0),
(1134, 'lw8T0o', 0),
(1135, 'kAnZrX', 0),
(1136, 'eX13z9', 0),
(1137, '7uksCS', 0),
(1138, 'iEqsPd', 0),
(1139, 'TB0KdH', 0),
(1140, '2ChDGX', 0),
(1141, 'XJreqI', 0),
(1142, 'ILxolM', 0),
(1143, '5VFEqL', 0),
(1144, 'SXhtMN', 0),
(1145, 'A2ahQB', 0),
(1146, 'MnqpOK', 0),
(1147, 'lsbifc', 0),
(1148, 'y6XhIn', 0),
(1149, 'TetRbY', 0),
(1150, 'bKk10O', 0),
(1151, 'Gf0nC1', 0),
(1152, 'fxEmu3', 0),
(1153, 'C21GTq', 0),
(1154, 'iIwcpB', 0),
(1155, 'G2D5H4', 0),
(1156, 'izaXBJ', 0),
(1157, 'QIBmfo', 0),
(1158, 'wXnbdM', 0),
(1159, 'Zke1Yi', 0),
(1160, '6sW0Ir', 0),
(1161, 'BuwPR3', 0),
(1162, 'LsjYWH', 0),
(1163, 'OMTLhB', 0),
(1164, 'obhXDu', 0),
(1165, 'ndXDl9', 0),
(1166, 'zeqcPH', 0),
(1167, 'j0LY8b', 0),
(1168, 'ylZ3mD', 0),
(1169, 'puwseG', 0),
(1170, '6CE4H0', 0),
(1171, 'wXZjAq', 0),
(1172, '6JBanA', 0),
(1173, 'jgqNcp', 0),
(1174, 'gvfDhJ', 0),
(1175, 'uBXISw', 0),
(1176, 'fScvh8', 0),
(1177, 'VPRnxM', 0),
(1178, 'x7UjhV', 0),
(1179, 'u0LTNl', 0),
(1180, '6OFDbs', 0),
(1181, 'Jqa9Di', 0),
(1182, 'NXo8gY', 0),
(1183, '5UOWJA', 0),
(1184, 'fpmras', 0),
(1185, 'Ub9Ys4', 0),
(1186, 'yngYuk', 0),
(1187, 'hQLdZU', 0),
(1188, '2nmwdb', 0),
(1189, 'aOYf4e', 0),
(1190, 'Vijr87', 0),
(1191, 'JXEOPl', 0),
(1192, 'IhD4ma', 0),
(1193, 'Hnkljy', 0),
(1194, 'WntURE', 0),
(1195, 't3EiRh', 0),
(1196, 'nXD9Pm', 0),
(1197, 'ztCV19', 0),
(1198, 'ALSRZE', 0),
(1199, 'yN9mWR', 0),
(1200, 'tg6Vb0', 0),
(1201, 'C4SBqU', 0),
(1202, 'tW19oQ', 0),
(1203, 'SHTyDI', 0),
(1204, 'qbHY8i', 0),
(1205, 'Rd3Mwc', 0),
(1206, 'yjfbOU', 0),
(1207, '13p6FR', 0),
(1208, 'SZoA5G', 0),
(1209, 'ilsa5J', 0),
(1210, 'gT7ClS', 0),
(1211, 'CwMukZ', 0),
(1212, 'qRU41k', 0),
(1213, 'WagfuX', 0),
(1214, 'NJzkax', 0),
(1215, 'jKBXe9', 0),
(1216, 'iJYatm', 0),
(1217, '9p8xjT', 0),
(1218, '8vyDWL', 0),
(1219, '8FIto2', 0),
(1220, 'doT9YC', 0),
(1221, 'evy0dR', 0),
(1222, 'fpz8go', 0),
(1223, 'osBEgS', 0),
(1224, 'n8eWMO', 0),
(1225, 'ykinV9', 0),
(1226, 'ZCOTs8', 0),
(1227, 'SUg8GK', 0),
(1228, 'WYMEli', 0),
(1229, 'fiHAlZ', 0),
(1230, 'QjN9Ih', 0),
(1231, 'aBjuOn', 0),
(1232, 'QB8dzn', 0),
(1233, 'tksjUi', 0),
(1234, '6hAoO3', 0),
(1235, 'onrl10', 0),
(1236, 'PTMq8O', 0),
(1237, 'CvRMZI', 0),
(1238, 'XOvyUe', 0),
(1239, 'Hwj2ZX', 0),
(1240, 'F3KcCA', 0),
(1241, 'i0N1ju', 0),
(1242, 'lc8xEQ', 0),
(1243, 'lubzAT', 0),
(1244, 'rEwjqM', 0),
(1245, 'jn3ICy', 0),
(1246, 'p6Ka1B', 0),
(1247, 'AThmUb', 0),
(1248, '54NhJP', 0),
(1249, '89XmDS', 0),
(1250, 'fBR10n', 0),
(1251, 'MuUZWa', 0),
(1252, 'e8FWPN', 0),
(1253, 'Sj4YCH', 0),
(1254, 'c0zpdY', 0),
(1255, 'RIMcDl', 0),
(1256, 'uAmlId', 0),
(1257, '0p7Hxi', 0),
(1258, 'KHMYd7', 0),
(1259, 'x7Bv9p', 0),
(1260, 'k7Vp5j', 0),
(1261, 'DzWTjB', 0),
(1262, 'snWkp5', 0),
(1263, 'OxtLrs', 0),
(1264, 'MGWzCx', 0),
(1265, '982Oui', 0),
(1266, 'C0ptEo', 0),
(1267, 'EnsDWS', 0),
(1268, 'NU180c', 0),
(1269, 'amuE3q', 0),
(1270, 'jFkSsT', 0),
(1271, 'QbzcJS', 0),
(1272, 'eXQ4FD', 0),
(1273, 'sUncKF', 0),
(1274, 'KlXrJ7', 0),
(1275, 'Wg3XHj', 0),
(1276, 'sejrRv', 0),
(1277, 'rkv0Rz', 0),
(1278, 'INT3qQ', 0),
(1279, '1M6FxE', 0),
(1280, '9OT0wS', 0),
(1281, 'ufnF8r', 0),
(1282, 'I3c4js', 0),
(1283, 'nG231M', 0),
(1284, 'DOcRKG', 0),
(1285, 'WfpYy1', 0),
(1286, 'aXFqWO', 0),
(1287, 'HsV2iO', 0),
(1288, 'ErMGIl', 0),
(1289, 'MmBLfQ', 0),
(1290, 'TA17Nj', 0),
(1291, 'xH0Uhv', 0),
(1292, 'S31nhZ', 0),
(1293, 'hH3Mfu', 0),
(1294, 'Aals7q', 0),
(1295, 'DdXbNq', 0),
(1296, '6uX8VP', 0),
(1297, 'fzGPel', 0),
(1298, 'gdZvp2', 0),
(1299, 'DdSX6b', 0),
(1300, 'u3WJTV', 0),
(1301, 'PdS4hL', 0),
(1302, 'EcZxsG', 0),
(1303, 'KBpiHD', 0),
(1304, 'rhsbqG', 0),
(1305, 'KoTOpS', 0),
(1306, 'DhdrVy', 0),
(1307, 'aHQALS', 0),
(1308, '8sQiUE', 0),
(1309, 'PfHcGo', 0),
(1310, '6mPHdo', 0),
(1311, 'jYByms', 0),
(1312, 'etpy4F', 0),
(1313, '9g5U0a', 0),
(1314, 'PR8E01', 0),
(1315, 'OudCbj', 0),
(1316, '5ayu7k', 0),
(1317, 'hnzHIY', 0),
(1318, 'lU4uqX', 0),
(1319, 'LIE7HS', 0),
(1320, 'F0y5rI', 0),
(1321, '2Wdui4', 0),
(1322, 'qGEdCD', 0),
(1323, 'T3Krtq', 0),
(1324, 'N9XL1h', 0),
(1325, 'ELIRh7', 0),
(1326, 'Z2OA4o', 0),
(1327, 'Cu6PLo', 0),
(1328, 'ZB8OTp', 0),
(1329, 'rnvJRp', 0),
(1330, 'RizYeK', 0),
(1331, 'LAFpeM', 0),
(1332, '2Iep95', 0),
(1333, 'FBqUpA', 0),
(1334, 'L74YsE', 0),
(1335, 'UNMurh', 0),
(1336, 'wEWy5x', 0),
(1337, '1cxkml', 0),
(1338, 'jWeQnz', 0),
(1339, 'rlHYfO', 0),
(1340, 'sXnxrw', 0),
(1341, 'vkAjTi', 0),
(1342, '9jg8en', 0),
(1343, 'RvZC4M', 0),
(1344, 'XpPZlk', 0),
(1345, 'XBCKUr', 0),
(1346, 'w1JLPT', 0),
(1347, '2tMB7Q', 0),
(1348, 'FQ1ND2', 0),
(1349, 'm67U5S', 0),
(1350, 'mvKb7W', 0),
(1351, 'dD3SxG', 0),
(1352, 'W5bvYO', 0),
(1353, 'gbBXVz', 0),
(1354, 'YbrPoh', 0),
(1355, 'vGr9OZ', 0),
(1356, '1vuibL', 0),
(1357, 'GujADB', 0),
(1358, '39mKVk', 0),
(1359, 'Nx4fPW', 0),
(1360, 'eLfQvb', 0),
(1361, 'hXbpq9', 0),
(1362, 'wgXR8j', 0),
(1363, 's9RdMq', 0),
(1364, 'Y6kBwU', 0),
(1365, 'OS4lx0', 0),
(1366, 'ne3F17', 0),
(1367, 'D4Sfq2', 0),
(1368, 'VNoAJs', 0),
(1369, 'tIXf4r', 0),
(1370, 'y320BJ', 0),
(1371, '56odX7', 0),
(1372, 'lRUW6K', 0),
(1373, 'NtCemF', 0),
(1374, 'Xp49Wd', 0),
(1375, 'Pkb8ax', 0),
(1376, 'dAlqrI', 0),
(1377, 'hcLnRV', 0),
(1378, 'Pb3OAs', 0),
(1379, 'VhI9rl', 0),
(1380, 'jXS2hz', 0),
(1381, 'SeUZI0', 0),
(1382, 'o6BeEa', 0),
(1383, '4hCLrN', 0),
(1384, 'NhdxGw', 0),
(1385, 't3LNoh', 0),
(1386, 'BYQ4fJ', 0),
(1387, 'NRIVsF', 0),
(1388, 'AOeU41', 0),
(1389, 'sqACRT', 0),
(1390, 'oaKYNB', 0),
(1391, 'f3UkeJ', 0),
(1392, 'CZYNQB', 0),
(1393, 'OrB5mq', 0),
(1394, 'Q5pHVP', 0),
(1395, 'jXE0be', 0),
(1396, 'yBYGoV', 0),
(1397, 'jdgHq4', 0),
(1398, '4q5ONM', 0),
(1399, 'uYTb3F', 0),
(1400, 'qHPN3F', 0),
(1401, 'wCv6X7', 0),
(1402, 'hPwoCz', 0),
(1403, 'X8EZi6', 0),
(1404, 'Gsp4Tq', 0),
(1405, 'nMWhpX', 0),
(1406, 'xqCrHS', 0),
(1407, 'nFaT9t', 0),
(1408, 'sDi1A3', 0),
(1409, 'YBiuUF', 0),
(1410, 'EMxJ47', 0),
(1411, 'w7c5L2', 0),
(1412, '4vmB2Y', 0),
(1413, 'vpNDsd', 0),
(1414, '2XY7t0', 0),
(1415, 'tWSZkh', 0),
(1416, 'QEkeAf', 0),
(1417, 'DI6vxH', 0),
(1418, 'CbnLUV', 0),
(1419, '2v09rA', 0),
(1420, 'hH0dPR', 0),
(1421, 'AwvLt4', 0),
(1422, 'SbdpE6', 0),
(1423, 'WyIhJp', 0),
(1424, 'Num3n0', 0),
(1425, '5r3xme', 0),
(1426, '8wuzrx', 0),
(1427, '7wxuHk', 0),
(1428, 'StdI4K', 0),
(1429, 'KqDChH', 0),
(1430, 'EXg05P', 0),
(1431, '1h43wb', 0),
(1432, 't2OU54', 0),
(1433, '9ZX7dg', 0),
(1434, 'vQqYo0', 0),
(1435, 'GUKmb2', 0),
(1436, 'uViDZO', 0),
(1437, '94hVKM', 0),
(1438, 'eOGUXg', 0),
(1439, 'MbKhtq', 0),
(1440, 'VgkfQm', 0),
(1441, 'clXxbJ', 0),
(1442, 'EcTNwO', 0),
(1443, 'rO74yU', 0),
(1444, 'pF5rZG', 0),
(1445, 'Zlovgh', 0),
(1446, 'T2LQYm', 0),
(1447, '58BA2Z', 0),
(1448, 'Ufc3IH', 0),
(1449, 'GUzL2t', 0),
(1450, '1G3EkK', 0),
(1451, 'e3ATBW', 0),
(1452, 'YbFdNX', 0),
(1453, 'c9zZe0', 0),
(1454, '65YhiT', 0),
(1455, 'luqrU8', 0),
(1456, 'wDByx3', 0),
(1457, '0AQRxb', 0),
(1458, 'jilXYD', 0),
(1459, 'hZVOm3', 0),
(1460, 'IStm5Z', 0),
(1461, 'RO4YmP', 0),
(1462, 'fINvgQ', 0),
(1463, 'zQGof7', 0),
(1464, '3xDaSr', 0),
(1465, 'BITqHp', 0),
(1466, '13EyCb', 0),
(1467, 'nTxRV8', 0),
(1468, 'g2oHbN', 0),
(1469, '5qIAz0', 0),
(1470, 'nqtBWY', 0),
(1471, 'EUlcjt', 0),
(1472, '802W3C', 0),
(1473, 'LFAW42', 0),
(1474, 'LgkbG6', 0),
(1475, 'jLdaN5', 0),
(1476, 'L4DJyR', 0),
(1477, 'sCpPZu', 0),
(1478, 'S0dE9p', 0),
(1479, '57zstw', 0),
(1480, '23ByHt', 0),
(1481, 'uPvr51', 0),
(1482, 'aOEQ9R', 0),
(1483, 'DEmeoF', 0),
(1484, 'GhT17N', 0),
(1485, '7sjbBg', 0),
(1486, 'rAsSCK', 0),
(1487, 'TQzPDl', 0),
(1488, 'ntdB4C', 0),
(1489, 'VB9jqW', 0),
(1490, 'YRkxod', 0),
(1491, 'qDGu1W', 0),
(1492, 'xfymj2', 0),
(1493, 'fWIF05', 0),
(1494, 'McLVCQ', 0),
(1495, 'qN6IEY', 0),
(1496, 'kOMUBR', 0),
(1497, '3wgd1l', 0),
(1498, 'JwSun7', 0),
(1499, 'cptiH8', 0),
(1500, 'oH1vVh', 0),
(1501, 'ZCt4h7', 0),
(1502, '754sJl', 0),
(1503, 'wCPEu7', 0),
(1504, 'CMVXU8', 0),
(1505, 'yz79uR', 0),
(1506, '6MPBLX', 0),
(1507, '8dpzeU', 0),
(1508, 'K1Qqzj', 0),
(1509, '6NkyQx', 0),
(1510, 'UvclmT', 0),
(1511, 's3QA4n', 0),
(1512, 'wNqZ0M', 0),
(1513, '84movb', 0),
(1514, 'skVEGC', 0),
(1515, 'T6Uqy4', 0),
(1516, '10Z56v', 0),
(1517, 'lbisUN', 0),
(1518, 'HtSgzR', 0),
(1519, 'gLnoR3', 0),
(1520, '0rIE78', 0),
(1521, '9o0fDd', 0),
(1522, 'nt2Xrh', 0),
(1523, 'lhysUm', 0),
(1524, 'mNJid6', 0),
(1525, 'srvwQa', 0),
(1526, 'N6PegI', 0),
(1527, 'hVBy12', 0),
(1528, 'Bj1ucJ', 0),
(1529, 'mOBcXT', 0),
(1530, 'K9T0xZ', 0),
(1531, '9MJfqj', 0),
(1532, 'GsE0aN', 0),
(1533, 'vHd3bc', 0),
(1534, '3rQOS4', 0),
(1535, '1EgHY8', 0),
(1536, 'egPB3D', 0),
(1537, 'ldQnHN', 0),
(1538, 'YgDNXM', 0),
(1539, 'f52Ezp', 0),
(1540, 'sdJgVy', 0),
(1541, 'bJU6L2', 0),
(1542, '0bOSsx', 0),
(1543, 'USmCTq', 0),
(1544, 'AzVFdr', 0),
(1545, 'JgPxXb', 0),
(1546, 'j9K5Er', 0),
(1547, 'Y7OLpc', 0),
(1548, '9ZJD1n', 0),
(1549, 'JnESfa', 0),
(1550, 'aTJ6zu', 0),
(1551, 'JFSTzI', 0),
(1552, 'Md5OJs', 0),
(1553, 'kHfNQW', 0),
(1554, 'uf1v9n', 0),
(1555, 'Kig2Ls', 0),
(1556, 'ge7IKC', 0),
(1557, 'Nmpnv5', 0),
(1558, '7Xc1vw', 0),
(1559, '2xJXSh', 0),
(1560, '3JVQKx', 0),
(1561, 'xLGMgj', 0),
(1562, '1Rg3rn', 0),
(1563, 'uFRkw8', 0),
(1564, 'R8viTU', 0),
(1565, 'W6hG3U', 0),
(1566, 'PIipy9', 0),
(1567, 'SNemd9', 0),
(1568, 'IVNaTb', 0),
(1569, 'wqdGx5', 0),
(1570, '2WxZa0', 0),
(1571, 'rZSG5Q', 0),
(1572, 'P4sux3', 0),
(1573, 'a284gm', 0),
(1574, '0Pjd8w', 0),
(1575, 'FfgB05', 0),
(1576, '9QSW2F', 0),
(1577, '2UJe0l', 0),
(1578, 'i5ECNr', 0),
(1579, 'ZP8LWa', 0),
(1580, 'gQDstH', 0),
(1581, 'Kzmdhg', 0),
(1582, '4LdE2n', 0),
(1583, 'od1ajX', 0),
(1584, 'BW6vkO', 0),
(1585, '1JGozD', 0),
(1586, 'q4RrKW', 0),
(1587, 'EO8MAU', 0),
(1588, 'f9y3V2', 0),
(1589, 'jpKbhr', 0),
(1590, 'd4vweZ', 0),
(1591, 'vON8tI', 0),
(1592, 'fieJwO', 0),
(1593, 'MZ4udK', 0),
(1594, 'iMadwV', 0),
(1595, 'baDmcW', 0),
(1596, '67Va1i', 0),
(1597, 'MCqUs8', 0),
(1598, 'bQCel1', 0),
(1599, 'SX2lLe', 0),
(1600, 'Hw3xyt', 0),
(1601, 'jlH9Nm', 0),
(1602, 'bAEk5Q', 0),
(1603, 'PEQxiS', 0),
(1604, 'h8zSTI', 0),
(1605, '4YVvqr', 0),
(1606, 'Tj48ht', 0),
(1607, 'MD1K4v', 0),
(1608, 'CHL4y8', 0),
(1609, 'PguEYM', 0),
(1610, 'haLA9r', 0),
(1611, '3eYIgt', 0),
(1612, '4NCdE2', 0),
(1613, 'cApiNy', 0),
(1614, 'jIrPKS', 0),
(1615, '5NUdZI', 0),
(1616, 'aPkLem', 0),
(1617, 'Wx612U', 0),
(1618, 'NCRTk7', 0),
(1619, '9tzGfH', 0),
(1620, 'rTM2dE', 0),
(1621, 'SM7Ka4', 0),
(1622, 'P0cVJn', 0),
(1623, 'gMQbWq', 0),
(1624, '4GuR90', 0),
(1625, 'SNaOzG', 0),
(1626, '0GTXM3', 0),
(1627, 'lHOmLP', 0),
(1628, 'tyzR7v', 0),
(1629, 'JaNQVf', 0),
(1630, 'DiqtrK', 0),
(1631, 'Vx3FmK', 0),
(1632, 'N8UiLh', 0),
(1633, '3nqsw6', 0),
(1634, 'kqp43e', 0),
(1635, 'yRXsYq', 0),
(1636, '7HRJtd', 0),
(1637, 'zwGUxh', 0),
(1638, 'UEHcDQ', 0),
(1639, 'MNr3io', 0),
(1640, 'dFIn3C', 0),
(1641, 'OmTKZf', 0),
(1642, 'fbq97M', 0),
(1643, 'V49zo2', 0),
(1644, 'APWeFK', 0),
(1645, 'ezSUlG', 0),
(1646, 'Xe6xOA', 0),
(1647, 'GypAM4', 0),
(1648, 'pXcEeC', 0),
(1649, 'cnwlmj', 0),
(1650, 'LPghiz', 0),
(1651, 'gNTrMW', 0),
(1652, '9YgGUQ', 0),
(1653, 'Tnrgw2', 0),
(1654, '2Q7wis', 0),
(1655, '1LRdME', 0),
(1656, 'OkVSRM', 0),
(1657, 'Fm6rGq', 0),
(1658, '7YEgMS', 0),
(1659, 'xH5boa', 0),
(1660, 'BcDP6E', 0),
(1661, 'QoEman', 0),
(1662, 'sNkxnF', 0),
(1663, 'w6ySm5', 0),
(1664, 'n0GWkD', 0),
(1665, 'aDWGyR', 0),
(1666, 'zRuAdo', 0),
(1667, 'Twg78b', 0),
(1668, 'ieJypC', 0),
(1669, '1OozXg', 0),
(1670, 'Tlhr14', 0),
(1671, 'GK8aE9', 0),
(1672, 'g18Ybm', 0),
(1673, 'LpZ5Ii', 0),
(1674, 'B9MVTC', 0),
(1675, 'fKlB6D', 0),
(1676, 'XFfH1P', 0),
(1677, 'eV29L1', 0),
(1678, 'mCdnc0', 0),
(1679, 'iGNx1W', 0),
(1680, 'ypd8PY', 0),
(1681, '3v6Ez5', 0),
(1682, 'zproK3', 0),
(1683, '3VF9s1', 0),
(1684, 'UKPn1Y', 0),
(1685, 'DxpbFV', 0),
(1686, '5nDvL4', 0),
(1687, '7asULy', 0),
(1688, '2pmHKt', 0),
(1689, 'JKcNbd', 0),
(1690, 'glJZt7', 0),
(1691, 'MVcaES', 0),
(1692, 'ZrKycA', 0),
(1693, 'XWRko2', 0),
(1694, 'AgzoJK', 0),
(1695, 'rabSMq', 0),
(1696, '92yVL4', 0),
(1697, 'hQFRHG', 0),
(1698, 'MGko0P', 0),
(1699, 'TXL8or', 0),
(1700, 'ekiZ5E', 0),
(1701, 'Y3jP7k', 0),
(1702, 'nxQEIt', 0),
(1703, 'DpH93m', 0),
(1704, 'orU0GX', 0),
(1705, 'JQBoLb', 0),
(1706, 'j4O1xB', 0),
(1707, 'kUuVGD', 0),
(1708, 'deMjL1', 0),
(1709, 'OpWUyK', 0),
(1710, '8zPAC1', 0),
(1711, 'xM7OaQ', 0),
(1712, 'pAyOQT', 0),
(1713, 'MATVDn', 0),
(1714, 'Sws3jf', 0),
(1715, 'ek2Sl3', 0),
(1716, 'VSBTEF', 0),
(1717, 'Re7D56', 0),
(1718, 'CKSba6', 0),
(1719, '7umBZj', 0),
(1720, 'OVRou2', 0),
(1721, '8ocvmx', 0),
(1722, 'VOZJEw', 0),
(1723, 'Vb0iON', 0),
(1724, 'Uv3hgY', 0),
(1725, 'ApJXcs', 0),
(1726, 'CkSNqK', 0),
(1727, 'xGdkn4', 0),
(1728, 'bciFa2', 0),
(1729, 'yEv8FB', 0),
(1730, '3pET79', 0),
(1731, 'FsnJRm', 0),
(1732, '6qRGki', 0),
(1733, 'aJMDY8', 0),
(1734, 'CM1yA2', 0),
(1735, 'DCwpkZ', 0),
(1736, '1qB0el', 0),
(1737, 'cPYfOw', 0),
(1738, 'KimUza', 0),
(1739, 'H9XNzG', 0),
(1740, 'ogFrv5', 0),
(1741, '6KajXc', 0),
(1742, 'qPu79k', 0),
(1743, 'v0D9GX', 0),
(1744, '0TFGgI', 0),
(1745, 'XUVNbD', 0),
(1746, 'LS4v6P', 0),
(1747, 'AzhpaL', 0),
(1748, 'YLqr36', 0),
(1749, 'r7JaPu', 0),
(1750, 'VmTrwg', 0),
(1751, 'NGpwtP', 0),
(1752, 'gqGmBT', 0),
(1753, 'wiF1kc', 0),
(1754, 'zb60Ku', 0),
(1755, 'ZL1Q3Y', 0),
(1756, 'TPAJpX', 0),
(1757, 'A1y3p4', 0),
(1758, 'MzwhZo', 0),
(1759, '4c1U7d', 0),
(1760, 'P5XYL9', 0),
(1761, 'x85J3e', 0),
(1762, 'wxINnb', 0),
(1763, 'rFgWmh', 0),
(1764, 'Y2jAtL', 0),
(1765, 'PRJyvQ', 0),
(1766, 'on5x9Q', 0),
(1767, '5z9gua', 0),
(1768, 'gBym5U', 0),
(1769, 'bOlnx9', 0),
(1770, 'doe8Af', 0),
(1771, 'Y5XQWm', 0),
(1772, 'l98C3k', 0),
(1773, 'hnde1P', 0),
(1774, 'ZA5mRd', 0),
(1775, 'pvWPwJ', 0),
(1776, 'Rw27ZU', 0),
(1777, '18rBW3', 0),
(1778, 'AXIOWF', 0),
(1779, 'i14lMW', 0),
(1780, '3PrLKj', 0),
(1781, 'Gg871W', 0),
(1782, '2bCops', 0),
(1783, '3wtNc7', 0),
(1784, '0R8AvT', 0),
(1785, '4nYWJB', 0),
(1786, '1DZigq', 0),
(1787, 'jHEN0s', 0),
(1788, '2gI3NC', 0),
(1789, '6FhJIy', 0),
(1790, 'lE1mKb', 0),
(1791, 'zGMR2r', 0),
(1792, '3VX4wa', 0),
(1793, '1gRD5K', 0),
(1794, 'kcdUBL', 0),
(1795, 'Y9hUX2', 0),
(1796, 'wceMFB', 0),
(1797, 'cAkqIg', 0),
(1798, 'p2dDfl', 0),
(1799, 'f0qUmH', 0),
(1800, 'Bl03fE', 0),
(1801, 'qOCnsN', 0),
(1802, 'vJYNl8', 0),
(1803, 'RtO2yn', 0),
(1804, '7qQjVL', 0),
(1805, 'WfpvH0', 0),
(1806, 'znQC5d', 0),
(1807, 'ny7z0J', 0),
(1808, 'hjiUlc', 0),
(1809, 'Y7eqhE', 0),
(1810, 'BDl28u', 0),
(1811, 'vFUx0r', 0),
(1812, '6EgQ4a', 0),
(1813, 'SsUeu4', 0),
(1814, 'aV3FoW', 0),
(1815, 'mOg6Js', 0),
(1816, 'iNf6gB', 0),
(1817, '8fD4Iz', 0),
(1818, 'Zsngx8', 0),
(1819, 'ZpYweX', 0),
(1820, 'T6oYFc', 0),
(1821, '7p8gXW', 0),
(1822, 'byCZla', 0),
(1823, 'b3RGBD', 0),
(1824, 'vmj20f', 0),
(1825, 'k2MvTl', 0),
(1826, '14UyKV', 0),
(1827, '61k7LZ', 0),
(1828, 'wVoa1D', 0),
(1829, 'MIJzch', 0),
(1830, 'JDvqQ8', 0),
(1831, 'd54wb0', 0),
(1832, 'CI1MFR', 0),
(1833, 'R2iL3P', 0),
(1834, 'q1yuKe', 0),
(1835, 'UvE2AY', 0),
(1836, 'zDe9I8', 0),
(1837, 'OxHtXa', 0),
(1838, 'yb89fc', 0),
(1839, 'vgyOCR', 0),
(1840, 'hLEp5o', 0),
(1841, '9HfCVQ', 0),
(1842, 'i0aKzA', 0),
(1843, '2ThKjU', 0),
(1844, '45XQvn', 0),
(1845, 'WKRdED', 0),
(1846, 'EioBdr', 0),
(1847, 'g0XFxs', 0),
(1848, 'AJ0P5l', 0),
(1849, 'UTWOlf', 0),
(1850, 'YRxd9U', 0),
(1851, 'goKGPb', 0),
(1852, '2voHls', 0),
(1853, 'T9ReY5', 0),
(1854, 'cANhQR', 0),
(1855, 'LRFdDN', 0),
(1856, 'weHac5', 0),
(1857, 'GHBiQI', 0),
(1858, 'QiJdON', 0),
(1859, 'ryQui2', 0),
(1860, 'MDJWUY', 0),
(1861, '9D3awQ', 0),
(1862, 'ElGVLv', 0),
(1863, 'lxPqL9', 0),
(1864, 'MvK27N', 0),
(1865, 'MUr8uD', 0),
(1866, 'j0faD4', 0),
(1867, 'ov8J4a', 0),
(1868, 'DBobe8', 0),
(1869, '4PHNJm', 0),
(1870, 'v3RwT9', 0),
(1871, 'G7a65B', 0),
(1872, 'NX4pSG', 0),
(1873, 'cYxJiw', 0),
(1874, 'UO1pxX', 0),
(1875, 'xgNIQi', 0),
(1876, '8qDLiw', 0),
(1877, 'm8WaMS', 0),
(1878, 'yULseS', 0),
(1879, 'rt034O', 0),
(1880, 'H2ZEAr', 0),
(1881, 'O1KuvT', 0),
(1882, 'JVLb0M', 0),
(1883, '4vmYhl', 0),
(1884, 'fCQmj2', 0),
(1885, 'bPmMhK', 0),
(1886, 'N9x56R', 0),
(1887, 'xytO48', 0),
(1888, 'MG8xiH', 0),
(1889, 'qkLSQm', 0),
(1890, 'zWDV7L', 0),
(1891, 'CjVJEz', 0),
(1892, '7VyO9q', 0),
(1893, 'lGbUjo', 0),
(1894, 'w4CB3v', 0),
(1895, 'Ys4N2e', 0),
(1896, '1Zgu5r', 0),
(1897, 'YEReF6', 0),
(1898, 'KEcfrD', 0),
(1899, 'lIW7xu', 0),
(1900, 'vq5ruJ', 0),
(1901, 'bOcypP', 0),
(1902, 'qoi5nK', 0),
(1903, 'EiQDJf', 0),
(1904, 'gGXdpo', 0),
(1905, 'Ez5LUg', 0),
(1906, 'o2mEWP', 0),
(1907, 'qpoDYC', 0),
(1908, 'hj1cJC', 0),
(1909, 'DnWrCy', 0),
(1910, 'L9my0e', 0),
(1911, 'NLjcdH', 0),
(1912, 'AzX7eZ', 0),
(1913, 'kA0ltQ', 0),
(1914, '5X1Aua', 0),
(1915, 'AOlECZ', 0),
(1916, 'gJAS6s', 0),
(1917, 'K0zbLr', 0),
(1918, 'XT2Y9S', 0),
(1919, '7yWqEF', 0),
(1920, 'tAxusi', 0),
(1921, 'W42arL', 0),
(1922, '5UZQ7B', 0),
(1923, 'CTZ4rf', 0),
(1924, 'GiEs5M', 0),
(1925, '1eCmuL', 0),
(1926, 'aOyhnp', 0),
(1927, 'eg5Aud', 0),
(1928, 'WcRH0b', 0),
(1929, 'hWyr54', 0),
(1930, '08MCAQ', 0),
(1931, 'yxoVZ4', 0),
(1932, 'QSPxmt', 0),
(1933, 'OTq7w6', 0),
(1934, 'uU3GPn', 0),
(1935, 'Itk5PK', 0),
(1936, 'B6Pyhi', 0),
(1937, '05hC1J', 0),
(1938, 'teERzu', 0),
(1939, '8QjXMx', 0),
(1940, '2KRi6e', 0),
(1941, '6Z2udn', 0),
(1942, 'sFnA7o', 0),
(1943, 'OKf1Yv', 0),
(1944, 'pnWQ60', 0),
(1945, 'PGobHK', 0),
(1946, 'lf39nz', 0),
(1947, 'bArQfz', 0),
(1948, 'ihz4Kx', 0),
(1949, 'KfOPYb', 0),
(1950, 'mA0Xbo', 0),
(1951, 'Ogrexf', 0),
(1952, 'N8FVKn', 0),
(1953, 'l4dyvB', 0),
(1954, 'RTpxI5', 0),
(1955, 'szphtb', 0),
(1956, 'UoauBK', 0),
(1957, 'RgmepE', 0),
(1958, '8MeDgV', 0),
(1959, 'u8CIHG', 0),
(1960, 'zscM6L', 0),
(1961, '1SslBA', 0),
(1962, 'UsJP4x', 0),
(1963, '63rdqb', 0),
(1964, 'GnEuD5', 0),
(1965, '3uw752', 0),
(1966, '8MWFT2', 0),
(1967, 'dqb8xI', 0),
(1968, 'GPS8Qq', 0),
(1969, '1VZWB2', 0),
(1970, 'WkFNvT', 0),
(1971, 'HnKmB1', 0),
(1972, 'U0m1lL', 0),
(1973, 'EuUHkZ', 0),
(1974, 'RnDEMS', 0),
(1975, 'uqgw0m', 0),
(1976, 'zGcEBC', 0),
(1977, 'Kzl0ig', 0),
(1978, 'txAi5k', 0),
(1979, '5fM7ik', 0),
(1980, 'iUtqd5', 0),
(1981, 'rWwZuT', 0),
(1982, 'fYp73b', 0),
(1983, 'cIOtgE', 0),
(1984, 'dQDYj4', 0),
(1985, 'FosbOk', 0),
(1986, 'ciMDlh', 0),
(1987, 'Yor8WU', 0),
(1988, 'SAOpTc', 0),
(1989, 'hBSymu', 0),
(1990, 'QmgwAV', 0),
(1991, 'skZLKc', 0),
(1992, 'oBZEdq', 0),
(1993, 'YwvdMo', 0),
(1994, 'izqrD3', 0),
(1995, '3rXvUR', 0),
(1996, 'fIDNs2', 0),
(1997, 'JNvhnl', 0),
(1998, 'qFeutB', 0),
(1999, 'gHFTPJ', 0),
(2000, 'qrVShF', 0),
(2001, 'zwUA6T', 0),
(2002, 'GZ6tqV', 0),
(2003, 'iECphQ', 0),
(2004, 'sjhKbT', 0),
(2005, 'SYCwAd', 0),
(2006, 'Uc0QzA', 0),
(2007, 'Y32u7P', 0),
(2008, '8uJ2ji', 0),
(2009, 'eCpyUE', 0),
(2010, 'lY4DRp', 0),
(2011, 'aNcCpk', 0),
(2012, 'MRFr95', 0),
(2013, 'ZXjRpa', 0),
(2014, 'Lt08J7', 0),
(2015, 'fJlxbP', 0),
(2016, 'r9ai8f', 0),
(2017, 'HhfMOD', 0),
(2018, 'zJ20IB', 0),
(2019, 'pBvytY', 0),
(2020, 'mPU0ET', 0),
(2021, 'KGRAdZ', 0),
(2022, 'Er3zuG', 0),
(2023, 'SN9j4T', 0),
(2024, 'xnjVJ4', 0),
(2025, 'u8hCqD', 0),
(2026, 'mdEAeC', 0),
(2027, 'fgDyhW', 0),
(2028, 'P13Zqo', 0),
(2029, 'vu4W3i', 0),
(2030, 'BkRmGu', 0),
(2031, 'f2pk9E', 0),
(2032, 'dUOTKt', 0),
(2033, '2r7St9', 0),
(2034, '6Jxc7n', 0),
(2035, 'MN3fLH', 0),
(2036, 'LGeHzI', 0),
(2037, 'FlAUBr', 0),
(2038, '2v74le', 0),
(2039, 'vO601c', 0),
(2040, 'XhFs8M', 0),
(2041, 'Z9Dwoc', 0),
(2042, 'jAGd7v', 0),
(2043, 'T6rJm2', 0),
(2044, '3cAnuN', 0),
(2045, 'o5w38q', 0),
(2046, 'TPvgfw', 0),
(2047, 'C9tVwT', 0),
(2048, 'anqU7A', 0),
(2049, 'eLAUf4', 0),
(2050, 'lkvLoB', 0),
(2051, 'ToGK50', 0),
(2052, 'BmD2LQ', 0),
(2053, 'M64sOR', 0),
(2054, 'dJv8si', 0),
(2055, '1l4Zdj', 0),
(2056, 'VKgzrF', 0),
(2057, 'tTEM3r', 0),
(2058, 'HPmCYz', 0),
(2059, 'X5oY6S', 0),
(2060, 'upJsC1', 0),
(2061, 'fzP2TL', 0),
(2062, 'OTytWG', 0),
(2063, 'to28lG', 0),
(2064, '7EW2wh', 0),
(2065, 'E5nUCv', 0),
(2066, 'THvMXJ', 0),
(2067, 'SEBjbG', 0),
(2068, 'FlGNd6', 0),
(2069, 'RgZWoL', 0),
(2070, 'JgfYZC', 0),
(2071, 's1mzik', 0),
(2072, 'KonZN7', 0),
(2073, 'PMKm0t', 0),
(2074, 'wdlav8', 0),
(2075, '4gazbo', 0),
(2076, 'tubgwy', 0),
(2077, 'lxqQi5', 0),
(2078, 'g1uKzp', 0),
(2079, 'x9RLPz', 0),
(2080, 'fe9EoA', 0),
(2081, 'fGtdBM', 0),
(2082, 'JA6UL8', 0),
(2083, 'EBouqX', 0),
(2084, 'Nc3PRg', 0),
(2085, 'dIVk5v', 0),
(2086, 'L81PoE', 0),
(2087, 'imSgtO', 0),
(2088, 'n9L0Uq', 0),
(2089, 'yqchSd', 0),
(2090, 'HMFobR', 0),
(2091, 'hZjU2m', 0),
(2092, 'wi7ocJ', 0),
(2093, 'Cdt7sw', 0),
(2094, 'jcV0zZ', 0),
(2095, 'WMzN8v', 0),
(2096, 'xtnWfP', 0),
(2097, '14B9Vn', 0),
(2098, 'dxHUI0', 0),
(2099, 'HfY8GP', 0),
(2100, 'Jy0xLg', 0),
(2101, 'mYhzKt', 0),
(2102, 'tnRgOq', 0),
(2103, 'BClgiN', 0),
(2104, 'j9tEXO', 0),
(2105, 'whaSDx', 0),
(2106, 'oMFQYp', 0),
(2107, 'BsV3Ex', 0),
(2108, '0r39qf', 0),
(2109, 'l6Qudz', 0),
(2110, 'QTd4cU', 0),
(2111, 'EefSF3', 0),
(2112, 'RZu7zi', 0),
(2113, 'FvM7qR', 0),
(2114, 'vqZMPK', 0),
(2115, 'xv3n2q', 0),
(2116, 'yNzFV5', 0),
(2117, 'urVTLB', 0),
(2118, 'DTQfsR', 0),
(2119, 'bhwpcP', 0),
(2120, 'W4wO5G', 0),
(2121, 'vuW6GC', 0),
(2122, 'Y7np48', 0),
(2123, 'QF0re9', 0),
(2124, 'SXslg1', 0),
(2125, 'nHJNlm', 0),
(2126, 'QhK3iJ', 0),
(2127, 'c7hqrw', 0),
(2128, 'VkujmR', 0),
(2129, 'xot7CV', 0),
(2130, 'BuqaQN', 0),
(2131, 'KPBQ75', 0),
(2132, 'r5msHS', 0),
(2133, 't3CyOE', 0),
(2134, 'XI5Mqf', 0),
(2135, 'VQrhXF', 0),
(2136, 'JokG4L', 0),
(2137, 'Yjre03', 0),
(2138, 'uv5xg1', 0),
(2139, 'mF2gka', 0),
(2140, 'B8HFzD', 0),
(2141, 'xWZkFS', 0),
(2142, 'Ydmu5M', 0),
(2143, 'F5T6PI', 0),
(2144, 'AFsiec', 0),
(2145, '31zcSv', 0),
(2146, 'aOg9mb', 0),
(2147, 'ujOAgR', 0),
(2148, 'SUEhXf', 0),
(2149, 'p8sfNy', 0),
(2150, 'EguXYA', 0),
(2151, '1VKRPb', 0),
(2152, '5cgB6O', 0),
(2153, 'nD9Q0z', 0),
(2154, 'kIad8l', 0),
(2155, 'cALTzu', 0),
(2156, 'poahgS', 0),
(2157, 'rmU2lb', 0),
(2158, 'ciYqyr', 0),
(2159, 'eq8GZd', 0),
(2160, 'T3nheY', 0),
(2161, 'OaZEWw', 0),
(2162, 'olr5NG', 0),
(2163, 'NkVrR0', 0),
(2164, 'FOveRz', 0),
(2165, 'lY4skH', 0),
(2166, 'lKL5C1', 0),
(2167, 'R1NUVr', 0),
(2168, 'xAu5Ml', 0),
(2169, 'vIuDPL', 0),
(2170, 'iSchQY', 0),
(2171, 'Js8Q4g', 0),
(2172, 'aK19ji', 0),
(2173, 'k2sXRw', 0),
(2174, '1XneWB', 0),
(2175, 'zLWHrM', 0),
(2176, 'oia14U', 0),
(2177, 'p2bFvO', 0),
(2178, 'l32twK', 0),
(2179, 'HMSR1u', 0),
(2180, '0KOQsP', 0),
(2181, '5upUKS', 0),
(2182, 'cJDExm', 0),
(2183, 'jKx0eX', 0),
(2184, 'J1L3pV', 0),
(2185, '4bst2E', 0),
(2186, 'GTaUyc', 0),
(2187, 'ijxUdk', 0),
(2188, 'p6uP9f', 0),
(2189, 'fX0qai', 0),
(2190, 'BPh2ui', 0),
(2191, 'S7DTUX', 0),
(2192, 'PvNHEk', 0),
(2193, 'AyVmqd', 0),
(2194, 'dbyDEV', 0),
(2195, 'bHvKk1', 0),
(2196, 'VF9znT', 0),
(2197, 'LAYsT8', 0),
(2198, 'AO2LMv', 0),
(2199, 'EOcvBy', 0),
(2200, 'xi1TCU', 0),
(2201, 'YIBwFu', 0),
(2202, 'sk6LRP', 0),
(2203, 'E9p4iU', 0),
(2204, 'UyxAwS', 0),
(2205, 'J4bUDO', 0),
(2206, 'TZKVjv', 0),
(2207, 'mdD0L7', 0),
(2208, 'OPNQqv', 0),
(2209, 'YHUcER', 0),
(2210, 'kih9Rz', 0),
(2211, 'OWGJTg', 0),
(2212, 'M8bhKF', 0),
(2213, 'bEAaYp', 0),
(2214, 'ypKEuA', 0),
(2215, 'wIzr3D', 0),
(2216, '1IjwXk', 0),
(2217, 'c7yVdn', 0),
(2218, 'aq0Rn3', 0),
(2219, '4EJ51g', 0),
(2220, 'S5czXn', 0),
(2221, 'UDXQkT', 0),
(2222, 'B2gR7Q', 0),
(2223, 'ZvezJa', 0),
(2224, 'jdNqZ4', 0),
(2225, 's29wjz', 0),
(2226, 'YbZPFH', 0),
(2227, 'Lw0dYt', 0),
(2228, '6JiN3Z', 0),
(2229, 'tgW4nX', 0),
(2230, 'dIgKek', 0),
(2231, 'IJQ9XA', 0),
(2232, 'fCoYLc', 0),
(2233, 'Z1oaHg', 0),
(2234, 'JdSFD4', 0),
(2235, 'kwafB6', 0),
(2236, 'WIjSAu', 0),
(2237, '6QUXdj', 0),
(2238, 'tczXJr', 0),
(2239, 'S145i0', 0),
(2240, '0o25pV', 0),
(2241, 'A9BZos', 0),
(2242, 'OD9Noh', 0),
(2243, '7YRHSJ', 0),
(2244, 'YWKTE0', 0),
(2245, 'bSHB17', 0),
(2246, 'KviOGf', 0),
(2247, 'SPNKYg', 0),
(2248, '7iOFmz', 0),
(2249, '56x7G0', 0),
(2250, '1EhCsx', 0),
(2251, 'q6xph2', 0),
(2252, 'D82vQs', 0),
(2253, '68eILN', 0),
(2254, 'EMyNoF', 0),
(2255, '632gya', 0),
(2256, 'pcI1NQ', 0),
(2257, 'v69k5l', 0),
(2258, 'AOxCBG', 0),
(2259, 'Zr5nHO', 0),
(2260, 'FiurHy', 0),
(2261, 'lJ5cwD', 0),
(2262, 'xDRP4H', 0),
(2263, 'cTDfX8', 0),
(2264, 'BIMm6K', 0),
(2265, '3z7lAL', 0),
(2266, 'HrF8I9', 0),
(2267, 'KbklGe', 0),
(2268, 'Mk6AXB', 0),
(2269, 'c7rKIU', 0),
(2270, 'YO8SGq', 0),
(2271, 'pIP9S4', 0),
(2272, '498vEy', 0),
(2273, 'ADyZJ3', 0),
(2274, 'UZRdi0', 0),
(2275, 'GdJyav', 0),
(2276, 'IdxS27', 0),
(2277, 'Wkhdyj', 0),
(2278, 'dG0epr', 0),
(2279, 'NIk98E', 0),
(2280, 'Y0X1Ws', 0),
(2281, 'kmp0aK', 0),
(2282, 'iXbTSJ', 0),
(2283, '5puBVk', 0),
(2284, 'nyxrj7', 0),
(2285, 'Q3Z4AL', 0),
(2286, 'YcJFpl', 0),
(2287, 'Z82P1l', 0),
(2288, 'PhTdGl', 0),
(2289, 'sApPEN', 0),
(2290, 'YC8vPA', 0),
(2291, 'nH8Wdy', 0),
(2292, 'wIzHnp', 0),
(2293, 'xcRQYU', 0),
(2294, '1nolVC', 0),
(2295, 'BMiWfK', 0),
(2296, 'XwoL4m', 0),
(2297, '7lH26G', 0),
(2298, 'fZdezA', 0),
(2299, 'Fu7SXz', 0),
(2300, 'HgQSFZ', 0),
(2301, 'i4ltxA', 0),
(2302, 'hv4TMm', 0),
(2303, 't8bEl6', 0),
(2304, 'E3L7jh', 0),
(2305, 'uU9BEq', 0),
(2306, 'F7epXM', 0),
(2307, '0uSdwH', 0),
(2308, 'fm8BOE', 0),
(2309, 'MAXcf0', 0),
(2310, 'mUaMOv', 0),
(2311, 'zQndHI', 0),
(2312, 'LasonY', 0),
(2313, '7O8uwc', 0),
(2314, '5LVwKp', 0),
(2315, 'uMtJ0O', 0),
(2316, 'fLRkyq', 0),
(2317, 'rKGtE2', 0),
(2318, '6xPSTJ', 0),
(2319, 'MhV6G4', 0),
(2320, '4P3tro', 0),
(2321, 'wHlYxa', 0),
(2322, '1WSwxB', 0),
(2323, 'YDwe9g', 0),
(2324, 'hs9kx1', 0),
(2325, 'G1Y6No', 0),
(2326, '1XSrWa', 0),
(2327, 'Sya0P5', 0),
(2328, 'eniIhJ', 0),
(2329, 'ME8r6I', 0),
(2330, 'iuGUvS', 0),
(2331, 'Y1F23T', 0),
(2332, 'hs6lOQ', 0),
(2333, 'zkqnAx', 0),
(2334, 'tUFsHW', 0),
(2335, 'mBP2os', 0),
(2336, '4ows80', 0),
(2337, 'rwnXNz', 0),
(2338, 'gQz5oh', 0),
(2339, 'CdyIY8', 0),
(2340, 'jfgVTd', 0),
(2341, 'tzaV9m', 0),
(2342, 'QfXdtp', 0),
(2343, '2MSGmP', 0),
(2344, 'K1SEUs', 0),
(2345, 'KNpHWC', 0),
(2346, 'wYBmO8', 0),
(2347, '63mke5', 0),
(2348, 'MLF9pk', 0),
(2349, 'qifAVI', 0),
(2350, 'R9YBfq', 0),
(2351, 'U2EAey', 0),
(2352, '6b1oFV', 0),
(2353, 'BCoJti', 0),
(2354, '3PsjoE', 0),
(2355, 'izGYN4', 0),
(2356, 'L06uix', 0),
(2357, 'oTi8zR', 0),
(2358, 'TlfF97', 0),
(2359, 'cFWoIS', 0),
(2360, 'Dpu2j4', 0),
(2361, 'GsFNv7', 0),
(2362, 'myo2uL', 0),
(2363, 'BEQ0NL', 0),
(2364, 'ifaZ14', 0),
(2365, 'hvXSYk', 0),
(2366, 'fl7uMB', 0),
(2367, '3fXYOp', 0),
(2368, 'G4jSCm', 0),
(2369, 'pmd64r', 0),
(2370, '5JmaCS', 0),
(2371, 'GtRs9W', 0),
(2372, 'gDW1v8', 0),
(2373, '6em9Dq', 0),
(2374, '2V1GwX', 0),
(2375, 'kYlQZF', 0),
(2376, 'IP4F62', 0),
(2377, 'Rx0ObJ', 0),
(2378, 'pXH6MB', 0),
(2379, 'rO1m2p', 0),
(2380, 'YRuhHQ', 0),
(2381, '6p8iV9', 0),
(2382, 'NLBr30', 0),
(2383, 'lMBXmO', 0),
(2384, 'dZnlfF', 0),
(2385, 'TZCGu1', 0),
(2386, 'RVspFD', 0),
(2387, 'WQsbeH', 0),
(2388, 'gj3xKM', 0),
(2389, '9lJivQ', 0),
(2390, 'gQza5d', 0),
(2391, 'qiAbFH', 0),
(2392, 'sAxo3p', 0),
(2393, 'IzjfPG', 0),
(2394, 'Fomk0u', 0),
(2395, 'kHlzFJ', 0),
(2396, '0Hi3Fa', 0),
(2397, 'fcOIxl', 0),
(2398, 'EtzyRQ', 0),
(2399, 'OJzHRW', 0),
(2400, 'yF2lsQ', 0),
(2401, 'byJukR', 0),
(2402, '2Kmahi', 0),
(2403, 'm0FbcI', 0),
(2404, '1IvtaU', 0),
(2405, 'zmNh4b', 0),
(2406, '28Jx5f', 0),
(2407, 'ERaYUu', 0),
(2408, 'TcYm10', 0),
(2409, 'URsduc', 0),
(2410, 'nPvsK3', 0),
(2411, 'Fi2V0y', 0),
(2412, 'pEZYxU', 0),
(2413, 'eJDhj2', 0),
(2414, '57O6XP', 0),
(2415, 'kqTNKP', 0),
(2416, 'YlwLMt', 0),
(2417, 'BtuUMA', 0),
(2418, 'IrOvSE', 0),
(2419, 'koIcQm', 0),
(2420, 'nI1Rbw', 0),
(2421, '20Fh73', 0),
(2422, 'jhYWwR', 0),
(2423, '07VsRU', 0),
(2424, '8ZHkuI', 0),
(2425, 's5u3aR', 0),
(2426, 'lZWEhN', 0),
(2427, 'smkBxe', 0),
(2428, 'QWu6d1', 0),
(2429, 'OXkJIq', 0),
(2430, 'i9ZNgy', 0),
(2431, 'Qjv5Y2', 0),
(2432, 'SatYeX', 0),
(2433, 'FZgTnd', 0),
(2434, 'K6OGyT', 0),
(2435, 'Wr3n4s', 0),
(2436, '83r6Tc', 0),
(2437, 'AD8mH5', 0),
(2438, 'A70CGK', 0),
(2439, 'LZuyeG', 0),
(2440, 'nNB8cG', 0),
(2441, 'h9O1Pj', 0),
(2442, 'rkwY2M', 0),
(2443, '3pCTeP', 0),
(2444, '5tCruQ', 0),
(2445, 't8oPLJ', 0),
(2446, 'Jk3aLi', 0),
(2447, 'bIwuvA', 0),
(2448, 'JhDgqW', 0),
(2449, 'sPF6e2', 0),
(2450, 'eCBqV7', 0),
(2451, 'TbEGeQ', 0),
(2452, 'SIiMLw', 0),
(2453, 'boRdvF', 0),
(2454, 'XZQoFR', 0),
(2455, 'JfcLmb', 0),
(2456, 'y5l9wd', 0),
(2457, 'Y2UTAv', 0),
(2458, '3IzvLX', 0),
(2459, 'yrDGFY', 0),
(2460, 'G7hF2C', 0),
(2461, '9ehgL6', 0),
(2462, '1ZbsCB', 0),
(2463, 'kXKU16', 0),
(2464, 'gDEkUl', 0),
(2465, 'lnbtBV', 0),
(2466, '5XudnS', 0),
(2467, 'C2uavV', 0),
(2468, '6l8suK', 0),
(2469, 'NLW8j6', 0),
(2470, 'dsySXZ', 0),
(2471, '8hduDM', 0),
(2472, 'nHOeU9', 0),
(2473, 'Cjsltz', 0),
(2474, 'tDszN6', 0),
(2475, 'SVEqlM', 0),
(2476, 'oXILE8', 0),
(2477, 'QgFMq8', 0),
(2478, 'slDaXp', 0),
(2479, '1HfNRY', 0),
(2480, 'mWvYLH', 0),
(2481, 'w0iPdL', 0),
(2482, 'tFwxk8', 0),
(2483, 'AYB13j', 0),
(2484, '4yqTHV', 0),
(2485, '8OBA6e', 0),
(2486, '1lPj0t', 0),
(2487, 'SEkDAH', 0),
(2488, 'vQ1dUL', 0),
(2489, 'Pi82sM', 0),
(2490, '5Pdyjs', 0),
(2491, '23PTaB', 0),
(2492, 'AbOGjP', 0),
(2493, '6j4tSJ', 0),
(2494, 'VTlmWK', 0),
(2495, 'Ok1UuA', 0),
(2496, 'bNR6Vj', 0),
(2497, 'IkGWVd', 0),
(2498, '4WXz29', 0),
(2499, 'iQcu3N', 0),
(2500, '9Kj2Ee', 0),
(2501, 'MZhfI4', 0),
(2502, '0v2T7S', 0),
(2503, '17Cms5', 0),
(2504, 'sEP4Hl', 0),
(2505, 'i1Q6Ry', 0),
(2506, 'Q6qyh0', 0),
(2507, 'gMbeLm', 0),
(2508, 'oSjMmU', 0),
(2509, 'rK25od', 0),
(2510, 'YtFsAJ', 0),
(2511, 'hMgiQj', 0),
(2512, 'Rkj7iB', 0),
(2513, 'kYSDWy', 0),
(2514, 'cpGFxt', 0),
(2515, 'LB75Hb', 0),
(2516, 'Ds6JOz', 0),
(2517, 'ucS2B5', 0),
(2518, 'BAN9j1', 0),
(2519, 'bL8wc7', 0),
(2520, 'GdVebz', 0),
(2521, 'WcktXV', 0),
(2522, '7porkB', 0),
(2523, 'bXjHLq', 0),
(2524, 'P8GAbm', 0),
(2525, 'ycPGXv', 0),
(2526, 'Jiq4BQ', 0),
(2527, 'mGkFLB', 0),
(2528, 'aAY32w', 0),
(2529, '2rIwCg', 0),
(2530, 'mMHwGv', 0),
(2531, '36ldBz', 0),
(2532, 'X0hKxk', 0),
(2533, '0D48dV', 0),
(2534, 'uoJItA', 0),
(2535, '21ZWv7', 0),
(2536, 'HO6vqT', 0),
(2537, 'W9FfnZ', 0),
(2538, '3MBgVa', 0),
(2539, 'WwyMkA', 0),
(2540, 'hBw7zP', 0),
(2541, 'LXwEHr', 0),
(2542, 'r6Htln', 0),
(2543, 'GstYyD', 0),
(2544, '0sRjha', 0),
(2545, '8fXynP', 0),
(2546, 'HCZf8s', 0),
(2547, 'AiD3M0', 0),
(2548, 'k1Db7N', 0),
(2549, 'Q7nyAD', 0),
(2550, 'RL0BWF', 0),
(2551, 'O3RagY', 0),
(2552, 'Jh2Vdn', 0),
(2553, 'heqPmN', 0),
(2554, 'iUfcZG', 0),
(2555, 'AVWsEx', 0),
(2556, 'sPTNkr', 0),
(2557, 'magy5q', 0),
(2558, '38ryGX', 0),
(2559, 'ynBLvp', 0),
(2560, 'fbdmx2', 0),
(2561, 'szqn1c', 0),
(2562, 'YDFJUs', 0),
(2563, 'OGb57i', 0),
(2564, '6nh3Sk', 0),
(2565, 'D3AfHv', 0),
(2566, '4nDzQ5', 0),
(2567, 'lBHwnU', 0),
(2568, 'x5fLZD', 0),
(2569, '6dLSJC', 0),
(2570, 'SiecCY', 0),
(2571, 'xgdP0F', 0),
(2572, 'hxWzVX', 0),
(2573, 'Ss29Rz', 0),
(2574, 'xof79V', 0),
(2575, '3RuDHs', 0),
(2576, 'tFayqV', 0),
(2577, 'xVlIR9', 0),
(2578, 'EdwNhK', 0),
(2579, 'iUyhzm', 0),
(2580, 'ftLklG', 0),
(2581, 'xGJqkZ', 0),
(2582, 'DoBN8R', 0),
(2583, 'DZYUC1', 0),
(2584, 'CY2XT8', 0),
(2585, '9gC8G2', 0),
(2586, 'Waiv7D', 0),
(2587, 'BvRYSh', 0),
(2588, 'h9wb24', 0),
(2589, 'ZB8jNE', 0),
(2590, 'tCpP2f', 0),
(2591, 'InclNj', 0),
(2592, 'FdWSbl', 0),
(2593, 'WsAz3X', 0),
(2594, 'BpxrYF', 0),
(2595, '0nuTiW', 0),
(2596, '9FRz1f', 0),
(2597, 'nLmwjt', 0),
(2598, 'Muqmnd', 0),
(2599, '5q0L9J', 0),
(2600, 'VLf64c', 0),
(2601, 'gMKdLp', 0),
(2602, 'i4fQM0', 0),
(2603, 'yHB8tF', 0),
(2604, 'cCJXWT', 0),
(2605, 'F2Z0jk', 0),
(2606, 'UWwO1r', 0),
(2607, 'WxKTiw', 0),
(2608, 'vf7Tnk', 0),
(2609, 'm5ZD6a', 0),
(2610, 'U2DCsJ', 0),
(2611, 'yxFYwi', 0),
(2612, 'Im2DyK', 0),
(2613, 'O1Mg4J', 0),
(2614, 'mkJRDw', 0),
(2615, 'RxOwnc', 0),
(2616, 'rbtXsy', 0),
(2617, 'Ip8yeg', 0),
(2618, 'gLfrVU', 0),
(2619, 'kvFfpu', 0),
(2620, 'MxFZnm', 0),
(2621, 'KJnTwE', 0),
(2622, 'wEj0gT', 0),
(2623, 'lBjeqN', 0),
(2624, 'wNdiu3', 0),
(2625, 'pxbKtS', 0),
(2626, 'VZYabG', 0),
(2627, 'qafLh9', 0),
(2628, '93gx08', 0),
(2629, 'KgdMZN', 0),
(2630, 'YhB156', 0),
(2631, 'HCtbkE', 0),
(2632, 'JEqxKb', 0),
(2633, 'hswM27', 0),
(2634, 'Yerwa3', 0),
(2635, '5S21sm', 0),
(2636, 'J3VgQo', 0),
(2637, 'VrfZQh', 0),
(2638, 'xuPXBJ', 0),
(2639, 'rvX4DE', 0),
(2640, 'qdtXTS', 0),
(2641, 'N3npbe', 0),
(2642, 'NmOrPM', 0),
(2643, '2CT5r7', 0),
(2644, 'hABg7u', 0),
(2645, '4mtrl8', 0),
(2646, 'Q2WZdv', 0),
(2647, 'c05zaT', 0),
(2648, 'SUBdr3', 0),
(2649, '8B3MW2', 0),
(2650, 'GBxXI3', 0),
(2651, 'eQFJPC', 0),
(2652, 'UIeJgH', 0),
(2653, 'toTiAF', 0),
(2654, 'fsxukS', 0),
(2655, '8VUOrt', 0),
(2656, 'LH7a1o', 0),
(2657, 'RjUvFc', 0),
(2658, 's7XcUE', 0),
(2659, 'Cc6xDZ', 0),
(2660, 'CaHkrh', 0),
(2661, 'HLVcag', 0),
(2662, 'NnIJ1o', 0),
(2663, 'DrT5kB', 0),
(2664, 'w9v5IF', 0),
(2665, 'EbV5pY', 0),
(2666, 'dOCMpG', 0),
(2667, '7tOsmS', 0),
(2668, 'CqLBgt', 0),
(2669, 'lKJgZR', 0),
(2670, 'xwJ5oT', 0),
(2671, 'gIBx4Z', 0),
(2672, 'bZpgA6', 0),
(2673, 'XakUDK', 0),
(2674, 'K6Xosy', 0),
(2675, '9kTZVA', 0),
(2676, 'IjhdB2', 0),
(2677, 'FbyjuB', 0),
(2678, 'PuoRKH', 0),
(2679, 'Zwk9Kz', 0),
(2680, 'J09zQ2', 0),
(2681, 'qMct3J', 0),
(2682, 'pIUa1Y', 0),
(2683, 'r87vEm', 0),
(2684, 'KtIDma', 0),
(2685, 'ej5TBp', 0),
(2686, 'J8XfjA', 0),
(2687, 'ONpWRn', 0),
(2688, 'SaPQxv', 0),
(2689, 'Yz1JIB', 0),
(2690, 'tfYBeF', 0),
(2691, 'ZvP7ID', 0),
(2692, 'Og4MVC', 0),
(2693, 'QW6jxo', 0),
(2694, 'Di2X0f', 0),
(2695, 'k50jZY', 0),
(2696, 'rVEIjB', 0),
(2697, 'XlPsWC', 0),
(2698, 'f9TvmE', 0),
(2699, '5yrBvb', 0),
(2700, 'jdOxJf', 0),
(2701, 'SnwbFY', 0),
(2702, 'ZIEJV9', 0),
(2703, 'VgZicx', 0),
(2704, 'oxQIfi', 0),
(2705, '0Swbt6', 0),
(2706, 'Bx8Uua', 0),
(2707, 'vI0shi', 0),
(2708, 'VseRiK', 0),
(2709, 'X0SiFa', 0),
(2710, '5wKFaZ', 0),
(2711, '6VGvgC', 0),
(2712, 'nH1rOX', 0),
(2713, 'fWKIyE', 0),
(2714, '6AwGCv', 0),
(2715, '8RgJPT', 0),
(2716, 'rjwERJ', 0),
(2717, 'NsGgVo', 0),
(2718, 'YWwR49', 0),
(2719, 'afk5EI', 0),
(2720, '6rCjue', 0),
(2721, 'TKPi5m', 0),
(2722, 'PNYQFv', 0),
(2723, 'kfcPLF', 0),
(2724, 'Zrw2TJ', 0),
(2725, 'DVj5ez', 0),
(2726, 'Am9Gdo', 0),
(2727, 'ByVdQj', 0),
(2728, 'QlTr0J', 0),
(2729, 'Tph9Sv', 0),
(2730, 'LYpkBU', 0),
(2731, 'Tncto4', 0),
(2732, 'XWpkrY', 0),
(2733, 'vKjYML', 0),
(2734, 'O2t4b7', 0),
(2735, 'KoCLGX', 0),
(2736, 'NB64wx', 0),
(2737, '3t6CzF', 0),
(2738, 'fzXOLk', 0),
(2739, 'NKCnjQ', 0),
(2740, 'q6MuAH', 0),
(2741, 'qZfWCl', 0),
(2742, 'UkQvI9', 0),
(2743, 'hlESDd', 0),
(2744, 'fC7x3o', 0),
(2745, 'sNQatV', 0),
(2746, 'mEcIHf', 0),
(2747, '7X3pdj', 0),
(2748, 'IbxgLM', 0),
(2749, 'xIDQ62', 0),
(2750, 'Ylw7qx', 0),
(2751, 'sdRm6t', 0),
(2752, 'Fjub4U', 0),
(2753, 'NijlI9', 0),
(2754, '3JzAYC', 0),
(2755, 'MoCZtK', 0),
(2756, 'hHP9OV', 0),
(2757, 'x8pkCN', 0),
(2758, 'uJtMoW', 0),
(2759, '2oW15Z', 0),
(2760, '9kwnD1', 0),
(2761, '4qkL2s', 0),
(2762, 'DRL2b8', 0),
(2763, 'fkc6QJ', 0),
(2764, 'BWYExo', 0),
(2765, '4tMPia', 0),
(2766, 'FPDJXx', 0),
(2767, 'YVCupW', 0),
(2768, 'makngz', 0),
(2769, 'SvZKQO', 0),
(2770, 'NkXGtH', 0),
(2771, 'nuAjYz', 0),
(2772, 'hl5Ny9', 0),
(2773, '2Ply5L', 0),
(2774, '60eXBy', 0),
(2775, 'MNLKvV', 0),
(2776, 'iUf4l9', 0),
(2777, 'MjvVpl', 0),
(2778, 'UobLwn', 0),
(2779, 'dXOfA5', 0),
(2780, 'PRtqu7', 0),
(2781, '3HNvC4', 0),
(2782, '1FZaqI', 0),
(2783, 'AK8OrP', 0),
(2784, 'yoSs9J', 0),
(2785, '5SzZyv', 0),
(2786, 'ZCg2Rr', 0),
(2787, 'WgbwYR', 0),
(2788, 'IfLaDr', 0),
(2789, '2RYKxm', 0),
(2790, 'GBnKHm', 0),
(2791, 'Mtdp8y', 0),
(2792, 'eQ0GjE', 0),
(2793, 'MRL6Pc', 0),
(2794, 'CO3BIe', 0),
(2795, 'm4glZf', 0),
(2796, 'wdlRHW', 0),
(2797, 'tDTQMC', 0),
(2798, 'oXJytz', 0),
(2799, '2xkP7i', 0),
(2800, 't5BPZS', 0),
(2801, 'e24kHR', 0),
(2802, 'SUf5w6', 0),
(2803, 'UOQFC4', 0),
(2804, 'JeZhOt', 0),
(2805, 'Zj5wTh', 0),
(2806, 'c1GkEt', 0),
(2807, 'EUugyH', 0),
(2808, 'GVxBiP', 0),
(2809, 'jRWlNm', 0),
(2810, 'bnIceX', 0),
(2811, 'b64snK', 0),
(2812, 'WcUkaB', 0),
(2813, 'lwyH6V', 0),
(2814, 'qWJeGO', 0),
(2815, '4sNMxt', 0),
(2816, 'GP7RsM', 0),
(2817, '7sLDkF', 0),
(2818, 'GEWqeS', 0),
(2819, 'F8KTEI', 0),
(2820, 'x5vDUP', 0),
(2821, 'HtNbml', 0),
(2822, 'XB7SeN', 0),
(2823, 'OhpAQx', 0),
(2824, 'Trc4v3', 0),
(2825, 'kuUbxd', 0),
(2826, 'B5f21W', 0),
(2827, 'xqSbKL', 0),
(2828, 'YLt2hp', 0),
(2829, 'QO3I1p', 0),
(2830, 'gj60T1', 0),
(2831, '4Fzrbi', 0),
(2832, '3qu4Re', 0),
(2833, 'RoSJtz', 0),
(2834, 'MOCFXT', 0),
(2835, 'VlJ62s', 0),
(2836, 'YubJsZ', 0),
(2837, 'eRdnEM', 0),
(2838, 'jY5GtS', 0),
(2839, 'q0yBLk', 0),
(2840, 'DZP7a8', 0),
(2841, 'QTURgK', 0),
(2842, 'ztklMJ', 0),
(2843, 'ZQy5xs', 0),
(2844, 'lvHOyE', 0),
(2845, 'ZBIziu', 0),
(2846, 'pCwg9S', 0),
(2847, 'CnX67j', 0),
(2848, 'bJvOQd', 0),
(2849, 'QilFqD', 0),
(2850, 'TWOq0u', 0),
(2851, 'eYKHJF', 0),
(2852, 'rwxBfp', 0),
(2853, '1hqV9H', 0),
(2854, '9p6Xsj', 0),
(2855, '6RJvwW', 0),
(2856, '8pN5GK', 0),
(2857, 'eHB8GS', 0),
(2858, 'Fz83cm', 0),
(2859, 'sBadkJ', 0),
(2860, 'M0c3KN', 0),
(2861, 'TWqRnC', 0),
(2862, 'cBfYEX', 0),
(2863, 'SNg02A', 0),
(2864, 'haUiSp', 0),
(2865, 'tdVH0y', 0),
(2866, 'gfsxFT', 0),
(2867, '6ujEw5', 0),
(2868, 'ANs6Fy', 0),
(2869, 'gqxOod', 0),
(2870, 'HYwrbp', 0),
(2871, 'xmLXlS', 0),
(2872, 'wgmdcb', 0),
(2873, 'EBaU6T', 0),
(2874, 'qLtv8I', 0),
(2875, 'Xo1dWY', 0),
(2876, 'Hjg6Fz', 0),
(2877, 'JYzLrK', 0),
(2878, 'xQG6jp', 0),
(2879, 'FpWVnl', 0),
(2880, 'kZIASp', 0),
(2881, 'jVckPq', 0),
(2882, 'sj9bVB', 0),
(2883, 'Wlgw0A', 0),
(2884, 'MctUvq', 0),
(2885, '51xWZg', 0),
(2886, 'v6X18B', 0),
(2887, 'X4y7nt', 0),
(2888, 'VGdXO6', 0),
(2889, 'UHDnit', 0),
(2890, 'j3KfIH', 0),
(2891, 'fTqg72', 0),
(2892, 'EecoRv', 0),
(2893, 'AXEkSe', 0),
(2894, 'xNZrFa', 0),
(2895, 'KZl3S1', 0),
(2896, 'ld297J', 0),
(2897, 'HsIt1z', 0),
(2898, 'gmwt6l', 0),
(2899, '51Gfhl', 0),
(2900, 'abmhdl', 0),
(2901, '5tmkAG', 0),
(2902, '4u1xqN', 0),
(2903, 'iN0rTa', 0),
(2904, 'YDd6WJ', 0),
(2905, 'ahEKQz', 0),
(2906, '2EjRUg', 0),
(2907, '4b8Haq', 0),
(2908, 'oueGQX', 0),
(2909, 'TcBpKt', 0),
(2910, 'twQRLF', 0),
(2911, '4d0uPI', 0),
(2912, 'znVkFf', 0),
(2913, 'gS9dCr', 0),
(2914, 'tB9IYl', 0),
(2915, '3gnFrZ', 0),
(2916, 'qpov3M', 0),
(2917, 'HofkmV', 0),
(2918, 'lxSN75', 0),
(2919, '7ZyGcO', 0),
(2920, 'mVyR0e', 0),
(2921, 'q5d7Lo', 0),
(2922, 'JQtcsR', 0),
(2923, 'ncvAZV', 0),
(2924, 'k8wzS4', 0),
(2925, 'pmyNQV', 0),
(2926, 'GaEYA6', 0),
(2927, 'hUAZTs', 0),
(2928, 'd0PilB', 0),
(2929, 'e6fjnp', 0),
(2930, 'XORdZG', 0),
(2931, '5JFSpo', 0),
(2932, 'yxC2dE', 0),
(2933, 'UA1pnq', 0),
(2934, 'Xvl8Qr', 0),
(2935, 'q86LHl', 0),
(2936, 'Bo8m39', 0),
(2937, 'tgKTOy', 0),
(2938, 'SwIyeo', 0),
(2939, 'GOvVTP', 0),
(2940, 'fr29HE', 0),
(2941, '1SQEWF', 0),
(2942, 'S7dbDL', 0),
(2943, 'ifsmvR', 0),
(2944, '8Ht6Jn', 0),
(2945, 'xnDCFA', 0),
(2946, 'ymtzE9', 0),
(2947, 'Fgz1Iu', 0),
(2948, 'gQuGjP', 0),
(2949, 'Czju1c', 0),
(2950, 'VSPHG8', 0),
(2951, 'Xy3poH', 0),
(2952, 'XYx7Qu', 0),
(2953, 'YcdiEx', 0),
(2954, 'MFy65t', 0),
(2955, 'eVY0DK', 0),
(2956, 'afWXgK', 0),
(2957, 'NnhmPG', 0),
(2958, 'q5zCi2', 0),
(2959, '5t2mTB', 0),
(2960, 'cDqXzx', 0),
(2961, 'pTQijE', 0),
(2962, 'ocSMqb', 0),
(2963, '9DAmKX', 0),
(2964, 'VYSqax', 0),
(2965, 'QMIwLt', 0),
(2966, 'm7BCTD', 0),
(2967, 'EblpgJ', 0),
(2968, 'IEjXm4', 0),
(2969, 'VUW93k', 0),
(2970, '2L0Vcr', 0),
(2971, 'ExHdA5', 0),
(2972, '7cTurQ', 0),
(2973, 'zWRwp1', 0),
(2974, 'MtxSTn', 0),
(2975, '9SIp52', 0),
(2976, 'VBdc6r', 0),
(2977, 'fwLnFY', 0),
(2978, 'fFPTrc', 0),
(2979, 'Kt7jXf', 0),
(2980, '6SYkso', 0),
(2981, 'ZWxleC', 0),
(2982, 's4AqUN', 0),
(2983, 'W1injL', 0),
(2984, 'vUNkqn', 0),
(2985, 'npe84W', 0),
(2986, 'omlAPH', 0),
(2987, 'RLmTFY', 0),
(2988, 'Uwo5I9', 0),
(2989, 'pBNTjl', 0),
(2990, 'VqJgyb', 0),
(2991, 'AO5YwE', 0),
(2992, 'LDEXM1', 0),
(2993, 'GFaWl2', 0),
(2994, '4pCME7', 0),
(2995, '63dsbO', 0),
(2996, 'da7ZAu', 0),
(2997, '1Mqcgy', 0),
(2998, 'RulVHT', 0),
(2999, 'whQBZs', 0);

-- --------------------------------------------------------

--
-- Table structure for table `td_remittance`
--

CREATE TABLE `td_remittance` (
  `id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `middle_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone_number` int(12) NOT NULL,
  `remittance_center` varchar(255) NOT NULL,
  `member_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_withdrawals`
--

CREATE TABLE `td_withdrawals` (
  `id` int(11) NOT NULL,
  `is_from_bonus` tinyint(1) NOT NULL,
  `member_id` int(11) NOT NULL,
  `date` datetime NOT NULL DEFAULT current_timestamp(),
  `date_approved` datetime NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `payment_method` varchar(255) NOT NULL,
  `is_pending` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `td_withdrawal_mode`
--

CREATE TABLE `td_withdrawal_mode` (
  `id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `bitcoin` varchar(200) NOT NULL,
  `ethereum` varchar(200) NOT NULL,
  `doge_coin` text NOT NULL,
  `litecoin` text NOT NULL,
  `xrp_account` text NOT NULL,
  `xrp_tag` varchar(10) NOT NULL,
  `trx` tinytext NOT NULL,
  `paypal` text NOT NULL,
  `usdt` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_general_ci;

--
-- Dumping data for table `td_withdrawal_mode`
--

INSERT INTO `td_withdrawal_mode` (`id`, `member_id`, `bitcoin`, `ethereum`, `doge_coin`, `litecoin`, `xrp_account`, `xrp_tag`, `trx`, `paypal`, `usdt`) VALUES
(1002, 3, '', 'jmhgbfcvkjhgi8765rkjbv', '', '', '', '', '', '', ''),
(1003, 4, '', '', '', '', '', '', '', '', ''),
(1004, 5, '', '', '', '', '', '', '', '', ''),
(1005, 6, '', '', '', '', '', '', '', '', ''),
(1006, 7, '', '', '', '', '', '', '', '', ''),
(1007, 8, '', '', '', '', '', '', '', '', ''),
(1008, 9, '', '', '', '', '', '', '', '', ''),
(1009, 10, '', '', '', '', '', '', '', '', ''),
(1010, 11, '', '', '', '', '', '', '', '', ''),
(1011, 12, '', '', '', '', '', '', '', '', ''),
(1012, 13, '', '', '', '', '', '', '', '', ''),
(1013, 14, '', '', '', '', '', '', '', '', ''),
(1014, 15, '', '', '', '', '', '', '', '', ''),
(1015, 16, '', '', '', '', '', '', '', '', ''),
(1016, 17, '', '', '', '', '', '', '', '', ''),
(1017, 18, '', '', '', '', '', '', '', '', ''),
(1018, 19, '', '', '', '', '', '', '', '', ''),
(1019, 20, '', '', '', '', '', '', '', '', ''),
(1020, 21, '', '', '', '', '', '', '', '', ''),
(1021, 22, '', '', '', '', '', '', '', '', ''),
(1022, 23, '', '', '', '', '', '', '', '', ''),
(1023, 24, '', '', '', '', '', '', '', '', ''),
(1024, 25, '', '', '', '', '', '', '', '', ''),
(1025, 26, '', '', '', '', '', '', '', '', ''),
(1026, 27, '', '', '', '', '', '', '', '', ''),
(1027, 28, '', '', '', '', '', '', '', '', ''),
(1028, 29, '', '', '', '', '', '', '', '', ''),
(1029, 30, '', '', '', '', '', '', '', '', ''),
(1030, 31, '', '', '', '', '', '', '', '', ''),
(1031, 32, '', '', '', '', '', '', '', '', ''),
(1032, 33, '', '', '', '', '', '', '', '', ''),
(1033, 34, '', '', '', '', '', '', '', '', ''),
(1034, 35, '', '', '', '', '', '', '', '', ''),
(1035, 36, '', '', '', '', '', '', '', '', ''),
(1036, 37, '', '', '', '', '', '', '', '', ''),
(1037, 38, '', '', '', '', '', '', '', '', ''),
(1038, 39, '', '', '', '', '', '', '', '', ''),
(1039, 40, '', '', '', '', '', '', '', '', ''),
(1040, 41, '', '', '', '', '', '', '', '', ''),
(1041, 42, '', '', '', '', '', '', '', '', ''),
(1042, 43, '', '', '', '', '', '', '', '', ''),
(1043, 44, '', '', '', '', '', '', '', '', ''),
(1044, 45, '', '', '', '', '', '', '', '', ''),
(1045, 46, '', '', '', '', '', '', '', '', ''),
(1046, 47, '', '', '', '', '', '', '', '', ''),
(1047, 48, '', '', '', '', '', '', '', '', ''),
(1048, 49, '', '', '', '', '', '', '', '', ''),
(1049, 50, '', '', '', '', '', '', '', '', ''),
(1050, 51, '', '', '', '', '', '', '', '', ''),
(1051, 52, '', '', '', '', '', '', '', '', ''),
(1052, 53, '', '', '', '', '', '', '', '', ''),
(1053, 54, '', '', '', '', '', '', '', '', ''),
(1054, 55, '', '', '', '', '', '', '', '', ''),
(1055, 56, '', '', '', '', '', '', '', '', ''),
(1056, 57, '', '', '', '', '', '', '', '', ''),
(1057, 58, '', '', '', '', '', '', '', '', ''),
(1058, 59, '', '', '', '', '', '', '', '', ''),
(1059, 60, '', '', '', '', '', '', '', '', ''),
(1060, 61, '', '', '', '', '', '', '', '', ''),
(1061, 62, '', '', '', '', '', '', '', '', ''),
(1062, 63, '', '', '', '', '', '', '', '', ''),
(1063, 64, '', '', '', '', '', '', '', '', ''),
(1064, 65, '', '', '', '', '', '', '', '', ''),
(1065, 66, '', '', '', '', '', '', '', '', ''),
(1066, 67, '', '', '', '', '', '', '', '', ''),
(1067, 68, '', '', '', '', '', '', '', '', ''),
(1068, 69, '', '', '', '', '', '', '', '', ''),
(1069, 70, '', '', '', '', '', '', '', '', ''),
(1070, 71, '', '', '', '', '', '', '', '', ''),
(1071, 72, '', '', '', '', '', '', '', '', ''),
(1072, 73, '', '', '', '', '', '', '', '', ''),
(1073, 74, '', '', '', '', '', '', '', '', ''),
(1074, 75, '', '', '', '', '', '', '', '', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `td_account_type`
--
ALTER TABLE `td_account_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_activation_funds`
--
ALTER TABLE `td_activation_funds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_advanced_withdrawals`
--
ALTER TABLE `td_advanced_withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_adv_withdrawal` (`member_id`),
  ADD KEY `fk_deposit_adv_withdrawal` (`deposit_id`);

--
-- Indexes for table `td_banks`
--
ALTER TABLE `td_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_bank` (`member_id`);

--
-- Indexes for table `td_btc`
--
ALTER TABLE `td_btc`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_daily_income`
--
ALTER TABLE `td_daily_income`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_deposits`
--
ALTER TABLE `td_deposits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_id` (`member_id`),
  ADD KEY `fk_deposit_options` (`deposit_options_id`),
  ADD KEY `FK_DEPOSIT_PACKAGE` (`package_id`);

--
-- Indexes for table `td_deposit_options`
--
ALTER TABLE `td_deposit_options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_franchise_applications`
--
ALTER TABLE `td_franchise_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_fund_bonus`
--
ALTER TABLE `td_fund_bonus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_referral_fundbonus` (`referral_bonus_id`);

--
-- Indexes for table `td_fund_transfer`
--
ALTER TABLE `td_fund_transfer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_sender` (`sender_member_id`),
  ADD KEY `fk_member_receiver` (`receiver_member_id`);

--
-- Indexes for table `td_gcash`
--
ALTER TABLE `td_gcash`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_group_sales`
--
ALTER TABLE `td_group_sales`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_lifestyle_bonus`
--
ALTER TABLE `td_lifestyle_bonus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_referral_lifestyle` (`referral_bonus_id`);

--
-- Indexes for table `td_members`
--
ALTER TABLE `td_members`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_account_type` (`account_type_id`);

--
-- Indexes for table `td_messages`
--
ALTER TABLE `td_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_message` (`member_id`);

--
-- Indexes for table `td_packages`
--
ALTER TABLE `td_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_profile_picture`
--
ALTER TABLE `td_profile_picture`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_referrals`
--
ALTER TABLE `td_referrals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_referral_bonus`
--
ALTER TABLE `td_referral_bonus`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_deposit_ref_bonus` (`deposit_id`),
  ADD KEY `fk_member_bonus` (`referrer_id`);

--
-- Indexes for table `td_referral_codes`
--
ALTER TABLE `td_referral_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `td_remittance`
--
ALTER TABLE `td_remittance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `td_withdrawals`
--
ALTER TABLE `td_withdrawals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_withdrawal` (`member_id`);

--
-- Indexes for table `td_withdrawal_mode`
--
ALTER TABLE `td_withdrawal_mode`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_member_accounts` (`member_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `td_account_type`
--
ALTER TABLE `td_account_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `td_activation_funds`
--
ALTER TABLE `td_activation_funds`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `td_advanced_withdrawals`
--
ALTER TABLE `td_advanced_withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `td_banks`
--
ALTER TABLE `td_banks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1074;

--
-- AUTO_INCREMENT for table `td_btc`
--
ALTER TABLE `td_btc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_daily_income`
--
ALTER TABLE `td_daily_income`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_deposits`
--
ALTER TABLE `td_deposits`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `td_deposit_options`
--
ALTER TABLE `td_deposit_options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `td_franchise_applications`
--
ALTER TABLE `td_franchise_applications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `td_fund_bonus`
--
ALTER TABLE `td_fund_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_fund_transfer`
--
ALTER TABLE `td_fund_transfer`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `td_gcash`
--
ALTER TABLE `td_gcash`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_group_sales`
--
ALTER TABLE `td_group_sales`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `td_lifestyle_bonus`
--
ALTER TABLE `td_lifestyle_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `td_members`
--
ALTER TABLE `td_members`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `td_messages`
--
ALTER TABLE `td_messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `td_packages`
--
ALTER TABLE `td_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `td_profile_picture`
--
ALTER TABLE `td_profile_picture`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_referrals`
--
ALTER TABLE `td_referrals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `td_referral_bonus`
--
ALTER TABLE `td_referral_bonus`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `td_referral_codes`
--
ALTER TABLE `td_referral_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3000;

--
-- AUTO_INCREMENT for table `td_withdrawals`
--
ALTER TABLE `td_withdrawals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `td_withdrawal_mode`
--
ALTER TABLE `td_withdrawal_mode`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1075;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `td_advanced_withdrawals`
--
ALTER TABLE `td_advanced_withdrawals`
  ADD CONSTRAINT `fk_deposit_adv_withdrawal` FOREIGN KEY (`deposit_id`) REFERENCES `td_deposits` (`id`),
  ADD CONSTRAINT `fk_member_adv_withdrawal` FOREIGN KEY (`member_id`) REFERENCES `td_members` (`id`);

--
-- Constraints for table `td_banks`
--
ALTER TABLE `td_banks`
  ADD CONSTRAINT `fk_member_bank` FOREIGN KEY (`member_id`) REFERENCES `td_members` (`id`);

--
-- Constraints for table `td_deposits`
--
ALTER TABLE `td_deposits`
  ADD CONSTRAINT `FK_DEPOSIT_PACKAGE` FOREIGN KEY (`package_id`) REFERENCES `td_packages` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_deposit_options` FOREIGN KEY (`deposit_options_id`) REFERENCES `td_deposit_options` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member_id` FOREIGN KEY (`member_id`) REFERENCES `td_members` (`id`);

--
-- Constraints for table `td_fund_bonus`
--
ALTER TABLE `td_fund_bonus`
  ADD CONSTRAINT `fk_referral_fundbonus` FOREIGN KEY (`referral_bonus_id`) REFERENCES `td_referral_bonus` (`id`);

--
-- Constraints for table `td_fund_transfer`
--
ALTER TABLE `td_fund_transfer`
  ADD CONSTRAINT `fk_member_receiver` FOREIGN KEY (`receiver_member_id`) REFERENCES `td_members` (`id`) ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_member_sender` FOREIGN KEY (`sender_member_id`) REFERENCES `td_members` (`id`) ON UPDATE CASCADE;

--
-- Constraints for table `td_members`
--
ALTER TABLE `td_members`
  ADD CONSTRAINT `fk_member_account_type` FOREIGN KEY (`account_type_id`) REFERENCES `td_account_type` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 15, 2017 at 09:17 PM
-- Server version: 5.6.16
-- PHP Version: 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `user_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cf_random`
--

CREATE TABLE IF NOT EXISTS `cf_random` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `handle` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `cf_rating`
--

CREATE TABLE IF NOT EXISTS `cf_rating` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `rating` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=232 ;

--
-- Dumping data for table `cf_rating`
--

INSERT INTO `cf_rating` (`user_id`, `user_name`, `rating`) VALUES
(131, 'Tanmoy', 1473),
(157, 'protap', 1413),
(205, 'arijit', 1551),
(207, 'Iqbal', 1403),
(209, 'ghosh', 1591),
(211, 'musa', 1634),
(217, 'tanim', 1642),
(221, 'akash', 1649),
(223, 'wahid', 1503),
(231, 'tawhid', 1089);

-- --------------------------------------------------------

--
-- Table structure for table `codeforces_id`
--

CREATE TABLE IF NOT EXISTS `codeforces_id` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `cf_id` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `codeforces_id`
--

INSERT INTO `codeforces_id` (`id`, `user_name`, `cf_id`) VALUES
(1, 'akash', 'abcd'),
(2, 'arijit', 'adamantium'),
(3, 'Iqbal', 'Animesh'),
(4, 'Tanmoy', 'Tanmoy_Datta'),
(5, 'protap', 'Protap_Ghose'),
(6, 'musa', 'musa.cse12'),
(7, 'ghosh', 'Tanmoy1228'),
(8, 'tanim', 'Tanim_kuet'),
(9, 'wahid', 'little_mod'),
(10, 'tawhid', 'dark_matter');

-- --------------------------------------------------------

--
-- Table structure for table `comment_table`
--

CREATE TABLE IF NOT EXISTS `comment_table` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `contest_table`
--

CREATE TABLE IF NOT EXISTS `contest_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `contest_id` int(11) NOT NULL,
  `contest` varchar(255) NOT NULL,
  `start` int(11) NOT NULL,
  `duration` int(11) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=441 ;

--
-- Dumping data for table `contest_table`
--

INSERT INTO `contest_table` (`id`, `contest_id`, `contest`, `start`, `duration`, `link`) VALUES
(438, 756, '8VC Venture Cup 2017 - Final Round', 1485106500, 7200, 'http://codeforces.com/contests/756'),
(439, 758, 'Codeforces Round #392 (Div. 2)', 1484838300, 7200, 'http://codeforces.com/contests/758'),
(440, 755, '8VC Venture Cup 2017 - Elimination Round', 1484499900, 7200, 'http://codeforces.com/contests/755');

-- --------------------------------------------------------

--
-- Table structure for table `last_time_solve`
--

CREATE TABLE IF NOT EXISTS `last_time_solve` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `time_` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=758 ;

--
-- Dumping data for table `last_time_solve`
--

INSERT INTO `last_time_solve` (`user_id`, `user_name`, `time_`) VALUES
(748, 'akash', 2147483647),
(749, 'Tanmoy', 1482696053),
(750, 'Iqbal', 1475213529),
(751, 'protap', 1484243758),
(752, 'arijit', 1484241689),
(753, 'musa', 1484502345),
(754, 'ghosh', 1484500221),
(755, 'tanim', 1484501809),
(756, 'wahid', 1483653292),
(757, 'tawhid', 1484289179);

-- --------------------------------------------------------

--
-- Table structure for table `login_info`
--

CREATE TABLE IF NOT EXISTS `login_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `image` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Dumping data for table `login_info`
--

INSERT INTO `login_info` (`user_id`, `user_name`, `password`, `email`, `batch`, `image`, `city`, `country`) VALUES
(6, 'akash', '123', 'asdas@gmail.com', '2k13', 'codeforces_logo.png', 'Khulna', 'Bangladesh'),
(12, 'Tanmoy', 'as', 'asd@gmail.com', '2k14', '', 'Khulna', 'Bangladesh'),
(13, 'Iqbal', 'a', 'asas@gmail.com', '2k15', 'abc.jpg', 'Rangpur', 'Bangladesh'),
(16, 'protap', 'a', 'asdf@gmail.com', '2k13', '', 'Sylhet', 'Bangladesh'),
(17, 'arijit', 'a', 'akashkuet13cse@gmail.com', '2k12', 'algorithm.png', 'Chittagong', 'Bangladesh'),
(21, 'admin', 'admin', '', '2k13', '', 'Khulna', 'Bangladesh'),
(22, 'musa', 'a', 'musa@gmail.com', '2k12', '', 'Rajshahi', 'Bangaldesh'),
(23, 'ghosh', 'a', 'ghosh@gmail.com', '2k12', '', 'Jessore', 'Bangladesh'),
(24, 'tanim', 'a', 'tanim@gmail.com', '2k12', '', 'Khulna', 'Bangladesh'),
(25, 'wahid', 'a', 'wahid@gmail.com', '2k14', '', 'Khulna', 'Bangladesh'),
(26, 'tawhid', 'a', 'tawhid@gmail.com', '2k14', '', 'Khulna', 'Bangladesh');

-- --------------------------------------------------------

--
-- Table structure for table `point_rule`
--

CREATE TABLE IF NOT EXISTS `point_rule` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `cf_rating` int(11) NOT NULL,
  `cf_solve` int(11) NOT NULL,
  `uva_solve` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `point_rule`
--

INSERT INTO `point_rule` (`user_id`, `cf_rating`, `cf_solve`, `uva_solve`) VALUES
(1, 2, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `point_table`
--

CREATE TABLE IF NOT EXISTS `point_table` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `point` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=791 ;

--
-- Dumping data for table `point_table`
--

INSERT INTO `point_table` (`user_id`, `user_name`, `point`) VALUES
(781, 'akash', 1006),
(782, 'Tanmoy', 3202),
(783, 'Iqbal', 2699),
(784, 'protap', 2824),
(785, 'arijit', 3382),
(786, 'musa', 3269),
(787, 'ghosh', 3183),
(788, 'tanim', 3285),
(789, 'wahid', 2998),
(790, 'tawhid', 2176);

-- --------------------------------------------------------

--
-- Table structure for table `submission_table`
--

CREATE TABLE IF NOT EXISTS `submission_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `problem` varchar(255) NOT NULL,
  `time` int(11) NOT NULL,
  `lang` varchar(255) NOT NULL,
  `verdict` varchar(255) NOT NULL,
  `link` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4119 ;

--
-- Dumping data for table `submission_table`
--

INSERT INTO `submission_table` (`id`, `user_name`, `problem`, `time`, `lang`, `verdict`, `link`) VALUES
(4073, 'akash', 'What is for dinner?', 1286470244, 'GNU C++', 'Hacked', 'http://codeforces.com/problemset/problem/33/A'),
(4074, 'akash', 'What is for dinner?', 1286470195, 'GNU C++', 'Hacked', 'http://codeforces.com/problemset/problem/33/A'),
(4075, 'akash', 'What is for dinner?', 1286470106, 'GNU C++', 'Hacked', 'http://codeforces.com/problemset/problem/33/A'),
(4076, 'akash', 'What is for dinner?', 1286470043, 'GNU C++', 'Hacked', 'http://codeforces.com/problemset/problem/33/A'),
(4077, 'akash', 'What is for dinner?', 1286469918, 'GNU C++', 'Hacked', 'http://codeforces.com/problemset/problem/33/A'),
(4078, 'arijit', 'Felicity is Coming!', 1484251829, 'GNU C++11', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/757/C'),
(4079, 'Iqbal', 'Drinks', 1475216345, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/200/B'),
(4080, 'Iqbal', 'Lucky Numbers', 1475213529, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/630/C'),
(4081, 'Iqbal', 'New Year Snowmen', 1325694428, 'GNU C++', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/140/C'),
(4082, 'Iqbal', 'New Year Snowmen', 1325693859, 'GNU C++', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/140/C'),
(4083, 'Iqbal', 'New Year Table', 1325690639, 'GNU C++', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/140/A'),
(4084, 'Tanmoy', 'New Year and Rating', 1483113700, 'GNU C++11', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/750/C'),
(4085, 'Tanmoy', 'New Year and North Pole', 1483112255, 'GNU C++11', 'Accepted', 'http://codeforces.com/problemset/problem/750/B'),
(4086, 'Tanmoy', 'New Year and North Pole', 1483109750, 'GNU C++11', 'Hacked', 'http://codeforces.com/problemset/problem/750/B'),
(4087, 'Tanmoy', 'New Year and Hurry', 1483107810, 'GNU C++11', 'Accepted', 'http://codeforces.com/problemset/problem/750/A'),
(4088, 'Tanmoy', 'Bear and Prime Numbers', 1482696053, 'GNU C++11', 'Accepted', 'http://codeforces.com/problemset/problem/385/C'),
(4089, 'musa', 'PolandBall and Forest', 1484503250, 'GNU C++11', 'Accepted', 'http://codeforces.com/problemset/problem/755/C'),
(4090, 'musa', 'PolandBall and Forest', 1484502980, 'GNU C++11', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/755/C'),
(4091, 'musa', 'PolandBall and Game', 1484502345, 'GNU C++11', 'Accepted', 'http://codeforces.com/problemset/problem/755/B'),
(4092, 'musa', 'PolandBall and Game', 1484502185, 'GNU C++11', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/755/B'),
(4093, 'musa', 'PolandBall and Game', 1484501158, 'GNU C++11', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/755/B'),
(4094, 'ghosh', 'PolandBall and Forest', 1484503973, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/755/C'),
(4095, 'ghosh', 'PolandBall and Forest', 1484503682, 'GNU C++', 'Idleness Limit<br>Exceeded', 'http://codeforces.com/problemset/problem/755/C'),
(4096, 'ghosh', 'PolandBall and Forest', 1484503514, 'GNU C++', 'Idleness Limit<br>Exceeded', 'http://codeforces.com/problemset/problem/755/C'),
(4097, 'ghosh', 'PolandBall and Game', 1484501826, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/755/B'),
(4098, 'ghosh', 'PolandBall and Hypothesis', 1484500221, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/755/A'),
(4099, 'tanim', 'PolandBall and Forest', 1484505899, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/755/C'),
(4100, 'tanim', 'PolandBall and Forest', 1484505635, 'GNU C++', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/755/C'),
(4101, 'tanim', 'PolandBall and Forest', 1484505527, 'GNU C++', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/755/C'),
(4102, 'tanim', 'PolandBall and Game', 1484501809, 'GNU C++', 'Accepted', 'http://codeforces.com/problemset/problem/755/B'),
(4103, 'tanim', 'PolandBall and Game', 1484501679, 'GNU C++', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/755/B'),
(4104, 'wahid', 'Ilya and tic-tac-toe game', 1483715454, 'GNU C++14', 'Accepted', 'http://codeforces.com/problemset/problem/754/B'),
(4105, 'wahid', 'Ilya and tic-tac-toe game', 1483715037, 'GNU C++14', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/754/B'),
(4106, 'wahid', 'Ilya and tic-tac-toe game', 1483714790, 'GNU C++14', 'Wrong<br>Answer', 'http://codeforces.com/problemset/problem/754/B'),
(4107, 'wahid', 'Lesha and array splitting', 1483714078, 'GNU C++14', 'Accepted', 'http://codeforces.com/problemset/problem/754/A'),
(4108, 'wahid', 'Good Sequences', 1483653292, 'GNU C++14', 'Accepted', 'http://codeforces.com/problemset/problem/264/B'),
(4109, 'arijit', 'ConcatFibos', 1477426315, 'GNU C++', 'Wrong<br>Answer', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=5044'),
(4110, 'arijit', 'ConcatFibos', 1477429126, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=5044'),
(4111, 'arijit', 'Subsets', 1477514914, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=5040'),
(4112, 'arijit', 'Walk Through the Forest', 1478719422, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=1858'),
(4113, 'arijit', 'A Multiplication Game', 1481393185, 'GNU C++11', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=788'),
(4114, 'Tanmoy', 'Triangle Trouble', 1482951255, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=2626'),
(4115, 'Tanmoy', 'Diving for Gold', 1482952030, 'GNU C++11', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=931'),
(4116, 'Tanmoy', 'Soya Milk', 1483016154, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=3060'),
(4117, 'Tanmoy', 'Satellites', 1483039495, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=1162'),
(4118, 'Tanmoy', 'Alternate Task', 1483105817, 'GNU C++', 'Accepted', 'https://uva.onlinejudge.org/index.php?option=com_onlinejudge&Itemid=8&category=24&page=show_problem&problem=2828');

-- --------------------------------------------------------

--
-- Table structure for table `temp_login_info`
--

CREATE TABLE IF NOT EXISTS `temp_login_info` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `batch` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_solve`
--

CREATE TABLE IF NOT EXISTS `user_solve` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `ac` int(11) NOT NULL,
  `wa` int(11) NOT NULL,
  `tle` int(11) NOT NULL,
  `rte` int(11) NOT NULL,
  `compile` int(11) NOT NULL,
  `mle` int(11) NOT NULL,
  `pe` int(11) NOT NULL,
  `accepted2` int(11) NOT NULL,
  `wa2` int(11) NOT NULL,
  `tle2` int(11) NOT NULL,
  `rte2` int(11) NOT NULL,
  `compile2` int(11) NOT NULL,
  `mle2` int(11) NOT NULL,
  `pe2` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=256 ;

--
-- Dumping data for table `user_solve`
--

INSERT INTO `user_solve` (`user_id`, `user_name`, `ac`, `wa`, `tle`, `rte`, `compile`, `mle`, `pe`, `accepted2`, `wa2`, `tle2`, `rte2`, `compile2`, `mle2`, `pe2`) VALUES
(41, 'tourist', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(173, 'admin', 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(243, 'tanim', 251, 371, 65, 21, 9, 11, 0, 0, 0, 0, 0, 0, 0, 0),
(244, 'musa', 317, 628, 52, 27, 25, 5, 0, 0, 0, 0, 0, 0, 0, 0),
(246, 'ghosh', 375, 395, 78, 42, 6, 12, 0, 0, 0, 0, 0, 0, 0, 0),
(247, 'wahid', 396, 231, 17, 7, 5, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(248, 'protap', 701, 763, 112, 24, 8, 3, 0, 0, 0, 0, 0, 0, 0, 0),
(249, 'Iqbal', 4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(251, 'akash', 4, 3, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(253, 'tawhid', 449, 798, 74, 36, 27, 8, 0, 0, 0, 0, 0, 0, 0, 0),
(254, 'arijit', 521, 397, 53, 13, 1, 1, 0, 313, 234, 48, 21, 27, 0, 12),
(255, 'Tanmoy', 401, 389, 63, 18, 16, 6, 0, 422, 298, 35, 38, 19, 0, 10);

-- --------------------------------------------------------

--
-- Table structure for table `uva_id`
--

CREATE TABLE IF NOT EXISTS `uva_id` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `handle` varchar(255) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `uva_id`
--

INSERT INTO `uva_id` (`user_id`, `user_name`, `handle`) VALUES
(1, 'arijit', '569355'),
(2, 'Tanmoy', '390669');

-- --------------------------------------------------------

--
-- Table structure for table `uva_random`
--

CREATE TABLE IF NOT EXISTS `uva_random` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `uid` varchar(255) NOT NULL,
  `handle` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `uva_solve`
--

CREATE TABLE IF NOT EXISTS `uva_solve` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_name` varchar(255) NOT NULL,
  `solve` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=134 ;

--
-- Dumping data for table `uva_solve`
--

INSERT INTO `uva_solve` (`user_id`, `user_name`, `solve`) VALUES
(132, 'arijit', 282),
(133, 'Tanmoy', 271);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

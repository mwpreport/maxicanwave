-- phpMyAdmin SQL Dump
-- version 4.0.10deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 25, 2018 at 04:18 PM
-- Server version: 5.6.33-0ubuntu0.14.04.1
-- PHP Version: 5.6.36-1+ubuntu14.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `maxcake`
--

-- --------------------------------------------------------

--
-- Table structure for table `assigned_gifts`
--

CREATE TABLE IF NOT EXISTS `assigned_gifts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gift_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gift_id` (`gift_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assigned_gifts`
--

INSERT INTO `assigned_gifts` (`id`, `gift_id`, `user_id`, `count`, `balance`, `dt`) VALUES
(1, 1, 2, 100, 0, '2018-05-26 18:25:46'),
(2, 2, 2, 100, 0, '2018-05-26 18:25:56'),
(3, 2, 2, 100, 0, '2018-05-26 18:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_samples`
--

CREATE TABLE IF NOT EXISTS `assigned_samples` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `count` int(11) NOT NULL,
  `balance` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `assigned_samples`
--

INSERT INTO `assigned_samples` (`id`, `product_id`, `user_id`, `count`, `balance`, `dt`) VALUES
(1, 1, 2, 100, 0, '2018-05-26 18:10:13'),
(2, 2, 2, 100, 0, '2018-05-26 18:10:24'),
(3, 2, 2, 100, 0, '2018-05-26 18:10:24');

-- --------------------------------------------------------

--
-- Table structure for table `chemists`
--

CREATE TABLE IF NOT EXISTS `chemists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `door_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `is_approved` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_updated` datetime NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ch_city_id` (`city_id`),
  KEY `ch_state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `chemists`
--

INSERT INTO `chemists` (`id`, `code`, `user_id`, `name`, `contact_person`, `mobile`, `phone`, `email`, `address`, `door_no`, `street`, `area`, `state_id`, `city_id`, `pincode`, `is_approved`, `is_active`, `is_deleted`, `last_updated`, `dt`) VALUES
(1, 'CHTN00001', 1, 'Rajan', 'rajan', 12345, 123546987, 'rajan@amin.com', 'address', '', '', 'local area', 24, 1143, 123123, 1, 1, 0, '0000-00-00 00:00:00', '2017-12-05 23:10:41'),
(2, 'CHTN00002', 1, 'Prem', 'Raj', 12345, 123546987, 'prem@admin.com', 'address', '', '', '', 24, 1143, 123123, 1, 1, 0, '0000-00-00 00:00:00', '2017-12-05 23:10:41'),
(3, 'CHTN00003', 1, 'Paramar', 'paraman', 1234567896, NULL, 'parama@admin.com', '', '', '', '', 24, 1145, 123123, 1, 1, 0, '0000-00-00 00:00:00', '2018-02-06 04:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `cities`
--

CREATE TABLE IF NOT EXISTS `cities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id` int(11) NOT NULL,
  `city_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1473 ;

--
-- Dumping data for table `cities`
--

INSERT INTO `cities` (`id`, `state_id`, `city_name`) VALUES
(1, 15, 'Kolhapur'),
(2, 29, 'Port Blair'),
(3, 1, 'Adilabad'),
(4, 1, 'Adoni'),
(5, 1, 'Amadalavalasa'),
(6, 1, 'Amalapuram'),
(7, 1, 'Anakapalle'),
(8, 1, 'Anantapur'),
(9, 1, 'Badepalle'),
(10, 1, 'Banganapalle'),
(11, 1, 'Bapatla'),
(12, 1, 'Bellampalle'),
(13, 1, 'Bethamcherla'),
(14, 1, 'Bhadrachalam'),
(15, 1, 'Bhainsa'),
(16, 1, 'Bheemunipatnam'),
(17, 1, 'Bhimavaram'),
(18, 1, 'Bhongir'),
(19, 1, 'Bobbili'),
(20, 1, 'Bodhan'),
(21, 1, 'Chilakaluripet'),
(22, 1, 'Chirala'),
(23, 1, 'Chittoor'),
(24, 1, 'Cuddapah'),
(25, 1, 'Devarakonda'),
(26, 1, 'Dharmavaram'),
(27, 1, 'Eluru'),
(28, 1, 'Farooqnagar'),
(29, 1, 'Gadwal'),
(30, 1, 'Gooty'),
(31, 1, 'Gudivada'),
(32, 1, 'Gudur'),
(33, 1, 'Guntakal'),
(34, 1, 'Guntur'),
(35, 1, 'Hanuman Junction'),
(36, 1, 'Hindupur'),
(37, 1, 'Hyderabad'),
(38, 1, 'Ichchapuram'),
(39, 1, 'Jaggaiahpet'),
(40, 1, 'Jagtial'),
(41, 1, 'Jammalamadugu'),
(42, 1, 'Jangaon'),
(43, 1, 'Kadapa'),
(44, 1, 'Kadiri'),
(45, 1, 'Kagaznagar'),
(46, 1, 'Kakinada'),
(47, 1, 'Kalyandurg'),
(48, 1, 'Kamareddy'),
(49, 1, 'Kandukur'),
(50, 1, 'Karimnagar'),
(51, 1, 'Kavali'),
(52, 1, 'Khammam'),
(53, 1, 'Koratla'),
(54, 1, 'Kothagudem'),
(55, 1, 'Kothapeta'),
(56, 1, 'Kovvur'),
(57, 1, 'Kurnool'),
(58, 1, 'Kyathampalle'),
(59, 1, 'Macherla'),
(60, 1, 'Machilipatnam'),
(61, 1, 'Madanapalle'),
(62, 1, 'Mahbubnagar'),
(63, 1, 'Mancherial'),
(64, 1, 'Mandamarri'),
(65, 1, 'Mandapeta'),
(66, 1, 'Manuguru'),
(67, 1, 'Markapur'),
(68, 1, 'Medak'),
(69, 1, 'Miryalaguda'),
(70, 1, 'Mogalthur'),
(71, 1, 'Nagari'),
(72, 1, 'Nagarkurnool'),
(73, 1, 'Nandyal'),
(74, 1, 'Narasapur'),
(75, 1, 'Narasaraopet'),
(76, 1, 'Narayanpet'),
(77, 1, 'Narsipatnam'),
(78, 1, 'Nellore'),
(79, 1, 'Nidadavole'),
(80, 1, 'Nirmal'),
(81, 1, 'Nizamabad'),
(82, 1, 'Nuzvid'),
(83, 1, 'Ongole'),
(84, 1, 'Palacole'),
(85, 1, 'Palasa Kasibugga'),
(86, 1, 'Palwancha'),
(87, 1, 'Parvathipuram'),
(88, 1, 'Pedana'),
(89, 1, 'Peddapuram'),
(90, 1, 'Pithapuram'),
(91, 1, 'Pondur'),
(92, 1, 'Ponnur'),
(93, 1, 'Proddatur'),
(94, 1, 'Punganur'),
(95, 1, 'Puttur'),
(96, 1, 'Rajahmundry'),
(97, 1, 'Rajam'),
(98, 1, 'Ramachandrapuram'),
(99, 1, 'Ramagundam'),
(100, 1, 'Rayachoti'),
(101, 1, 'Renigunta'),
(102, 1, 'Repalle'),
(103, 1, 'Sadasivpet'),
(104, 1, 'Salur'),
(105, 1, 'Samalkot'),
(106, 1, 'Sangareddy'),
(107, 1, 'Sattenapalle'),
(108, 1, 'Siddipet'),
(109, 1, 'Singapur'),
(110, 1, 'Sircilla'),
(111, 1, 'Srikakulam'),
(112, 1, 'Srikalahasti'),
(113, 1, 'Suryapet'),
(114, 1, 'Tadepalligudem'),
(115, 1, 'Tadpatri'),
(116, 1, 'Tandur'),
(117, 1, 'Tanuku'),
(118, 1, 'Tenali'),
(119, 1, 'Tirupati'),
(120, 1, 'Tuni'),
(121, 1, 'Uravakonda'),
(122, 1, 'Venkatagiri'),
(123, 1, 'Vicarabad'),
(124, 1, 'Vijayawada'),
(125, 1, 'Vinukonda'),
(126, 1, 'Visakhapatnam'),
(127, 1, 'Vizianagaram'),
(128, 1, 'Wanaparthy'),
(129, 1, 'Warangal'),
(130, 1, 'Yellandu'),
(131, 1, 'Yemmiganur'),
(132, 1, 'Yerraguntla'),
(133, 1, 'Zahirabad'),
(134, 1, 'Rajampet'),
(135, 2, 'Along'),
(136, 2, 'Bomdila'),
(137, 2, 'Itanagar'),
(138, 2, 'Naharlagun'),
(139, 2, 'Pasighat'),
(140, 3, 'Abhayapuri'),
(141, 3, 'Amguri'),
(142, 3, 'Anandnagaar'),
(143, 3, 'Barpeta'),
(144, 3, 'Barpeta Road'),
(145, 3, 'Bilasipara'),
(146, 3, 'Bongaigaon'),
(147, 3, 'Dhekiajuli'),
(148, 3, 'Dhubri'),
(149, 3, 'Dibrugarh'),
(150, 3, 'Digboi'),
(151, 3, 'Diphu'),
(152, 3, 'Dispur'),
(153, 3, 'Gauripur'),
(154, 3, '6lpara'),
(155, 3, 'Golaghat'),
(156, 3, 'Guwahati'),
(157, 3, 'Haflong'),
(158, 3, 'Hailakandi'),
(159, 3, 'Hojai'),
(160, 3, 'Jorhat'),
(161, 3, 'Karimganj'),
(162, 3, 'Kokrajhar'),
(163, 3, 'Lanka'),
(164, 3, 'Lumding'),
(165, 3, 'Mangaldoi'),
(166, 3, 'Mankachar'),
(167, 3, 'Margherita'),
(168, 3, 'Mariani'),
(169, 3, 'Marigaon'),
(170, 3, 'Nagaon'),
(171, 3, 'Nalbari'),
(172, 3, 'North Lakhimpur'),
(173, 3, 'Rangia'),
(174, 3, 'Sibsagar'),
(175, 3, 'Silapathar'),
(176, 3, 'Silchar'),
(177, 3, 'Tezpur'),
(178, 3, 'Tinsukia'),
(179, 4, 'Amarpur'),
(180, 4, 'Araria'),
(181, 4, 'Areraj'),
(182, 4, 'Arrah'),
(183, 4, 'Asarganj'),
(184, 4, 'Aurangabad'),
(185, 4, 'Bagaha'),
(186, 4, 'Bahadurganj'),
(187, 4, 'Bairgania'),
(188, 4, 'Bakhtiarpur'),
(189, 4, 'Banka'),
(190, 4, 'Banmankhi Bazar'),
(191, 4, 'Barahiya'),
(192, 4, 'Barauli'),
(193, 4, 'Barbigha'),
(194, 4, 'Barh'),
(195, 4, 'Begusarai'),
(196, 4, 'Behea'),
(197, 4, 'Bettiah'),
(198, 4, 'Bhabua'),
(199, 4, 'Bhagalpur'),
(200, 4, '4 Sharif'),
(201, 4, 'Bikramganj'),
(202, 4, 'Bodh Gaya'),
(203, 4, 'Buxar'),
(204, 4, 'Chandan Bara'),
(205, 4, 'Chanpatia'),
(206, 4, 'Chhapra'),
(207, 4, 'Colgong'),
(208, 4, 'Dalsinghsarai'),
(209, 4, 'Darbhanga'),
(210, 4, 'Daudnagar'),
(211, 4, 'Dehri-on-Sone'),
(212, 4, 'Dhaka'),
(213, 4, 'Dighwara'),
(214, 4, 'Dumraon'),
(215, 4, 'Fatwah'),
(216, 4, 'Forbesganj'),
(217, 4, 'Gaya'),
(218, 4, 'Gogri Jamalpur'),
(219, 4, 'Gopalganj'),
(220, 4, 'Hajipur'),
(221, 4, 'Hilsa'),
(222, 4, 'Hisua'),
(223, 4, 'Islampur'),
(224, 4, 'Jagdispur'),
(225, 4, 'Jamalpur'),
(226, 4, 'Jamui'),
(227, 4, 'Jehanabad'),
(228, 4, 'Jhajha'),
(229, 4, 'Jhanjharpur'),
(230, 4, 'Jogabani'),
(231, 4, 'Kanti'),
(232, 4, 'Katihar'),
(233, 4, 'Khagaria'),
(234, 4, 'Kharagpur'),
(235, 4, 'Kishanganj'),
(236, 4, 'Lakhisarai'),
(237, 4, 'Lalganj'),
(238, 4, 'Madhepura'),
(239, 4, 'Madhubani'),
(240, 4, 'Maharajganj'),
(241, 4, 'Mahnar Bazar'),
(242, 4, 'Makhdumpur'),
(243, 4, 'Maner'),
(244, 4, 'Manihari'),
(245, 4, 'Marhaura'),
(246, 4, 'Masaurhi'),
(247, 4, 'Mirganj'),
(248, 4, 'Mokameh'),
(249, 4, 'Motihari'),
(250, 4, 'Motipur'),
(251, 4, 'Munger'),
(252, 4, 'Murliganj'),
(253, 4, 'Muzaffarpur'),
(254, 4, 'Narkatiaganj'),
(255, 4, 'Naugachhia'),
(256, 4, 'Nawada'),
(257, 4, 'Nokha'),
(258, 4, 'Patna'),
(259, 4, 'Piro'),
(260, 4, 'Purnia'),
(261, 4, 'Rafiganj'),
(262, 4, 'Rajgir'),
(263, 4, 'Ramnagar'),
(264, 4, 'Raxaul Bazar'),
(265, 4, 'Revelganj'),
(266, 4, 'Rosera'),
(267, 4, 'Saharsa'),
(268, 4, 'Samastipur'),
(269, 4, 'Sasaram'),
(270, 4, 'Sheikhpura'),
(271, 4, 'Sheohar'),
(272, 4, 'Sherghati'),
(273, 4, 'Silao'),
(274, 4, 'Sitamarhi'),
(275, 4, 'Siwan'),
(276, 4, 'Sonepur'),
(277, 4, 'Sugauli'),
(278, 4, 'Sultanganj'),
(279, 4, 'Supaul'),
(280, 4, 'Warisaliganj'),
(281, 5, 'Ahiwara'),
(282, 5, 'Akaltara'),
(283, 5, 'Ambagarh Chowki'),
(284, 5, 'Ambikapur'),
(285, 5, 'Arang'),
(286, 5, 'Bade Bacheli'),
(287, 5, 'Balod'),
(288, 5, 'Baloda Bazar'),
(289, 5, 'Bemetra'),
(290, 5, 'Bhatapara'),
(291, 5, 'Bilaspur'),
(292, 5, 'Birgaon'),
(293, 5, 'Champa'),
(294, 5, 'Chirmiri'),
(295, 5, 'Dalli-Rajhara'),
(296, 5, 'Dhamtari'),
(297, 5, 'Dipka'),
(298, 5, 'Dongargarh'),
(299, 5, 'Durg-Bhilai Nagar'),
(300, 5, 'Gobranawapara'),
(301, 5, 'Jagdalpur'),
(302, 5, 'Janjgir'),
(303, 5, 'Jashpurnagar'),
(304, 5, 'Kanker'),
(305, 5, 'Kawardha'),
(306, 5, 'Kondagaon'),
(307, 5, 'Korba'),
(308, 5, 'Mahasamund'),
(309, 5, 'Mahendragarh'),
(310, 5, 'Mungeli'),
(311, 5, 'Naila Janjgir'),
(312, 5, 'Raigarh'),
(313, 5, 'Raipur'),
(314, 5, 'Rajnandgaon'),
(315, 5, 'Sakti'),
(316, 5, 'Tilda Newra'),
(317, 31, 'Amli'),
(318, 31, 'Silvassa'),
(319, 32, 'Daman and Diu'),
(320, 32, 'Daman and Diu'),
(321, 33, 'Asola'),
(322, 33, 'Delhi'),
(323, 6, 'Aldona'),
(324, 6, 'Curchorem Cacora'),
(325, 6, 'Madgaon'),
(326, 6, 'Mapusa'),
(327, 6, 'Margao'),
(328, 6, 'Marmagao'),
(329, 6, 'Panaji'),
(330, 7, 'Ahmedabad'),
(331, 7, 'Amreli'),
(332, 7, 'Anand'),
(333, 7, 'Ankleshwar'),
(334, 7, 'Bharuch'),
(335, 7, 'Bhavnagar'),
(336, 7, 'Bhuj'),
(337, 7, 'Cambay'),
(338, 7, 'Dahod'),
(339, 7, 'Deesa'),
(340, 7, 'Dholka'),
(341, 7, 'Gandhinagar'),
(342, 7, 'Godhra'),
(343, 7, 'Himatnagar'),
(344, 7, 'Idar'),
(345, 7, 'Jamnagar'),
(346, 7, 'Junagadh'),
(347, 7, 'Kadi'),
(348, 7, 'Kalavad'),
(349, 7, 'Kalol'),
(350, 7, 'Kapadvanj'),
(351, 7, 'Karjan'),
(352, 7, 'Keshod'),
(353, 7, 'Khambhalia'),
(354, 7, 'Khambhat'),
(355, 7, 'Kheda'),
(356, 7, 'Khedbrahma'),
(357, 7, 'Kheralu'),
(358, 7, 'Kodinar'),
(359, 7, 'Lathi'),
(360, 7, 'Limbdi'),
(361, 7, 'Lunawada'),
(362, 7, 'Mahesana'),
(363, 7, 'Mahuva'),
(364, 7, 'Manavadar'),
(365, 7, 'Mandvi'),
(366, 7, 'Mangrol'),
(367, 7, 'Mansa'),
(368, 7, 'Mehmedabad'),
(369, 7, 'Modasa'),
(370, 7, 'Morvi'),
(371, 7, 'Nadiad'),
(372, 7, 'Navsari'),
(373, 7, 'Padra'),
(374, 7, 'Palanpur'),
(375, 7, 'Palitana'),
(376, 7, 'Pardi'),
(377, 7, 'Patan'),
(378, 7, 'Petlad'),
(379, 7, 'Porbandar'),
(380, 7, 'Radhanpur'),
(381, 7, 'Rajkot'),
(382, 7, 'Rajpipla'),
(383, 7, 'Rajula'),
(384, 7, 'Ranavav'),
(385, 7, 'Rapar'),
(386, 7, 'Salaya'),
(387, 7, 'Sanand'),
(388, 7, 'Savarkundla'),
(389, 7, 'Sidhpur'),
(390, 7, 'Sihor'),
(391, 7, 'Songadh'),
(392, 7, 'Surat'),
(393, 7, 'Talaja'),
(394, 7, 'Thangadh'),
(395, 7, 'Tharad'),
(396, 7, 'Umbergaon'),
(397, 7, 'Umreth'),
(398, 7, 'Una'),
(399, 7, 'Unjha'),
(400, 7, 'Upleta'),
(401, 7, 'Vadnagar'),
(402, 7, 'Vadodara'),
(403, 7, 'Valsad'),
(404, 7, 'Vapi'),
(405, 7, 'Vapi'),
(406, 7, 'Veraval'),
(407, 7, 'Vijapur'),
(408, 7, 'Viramgam'),
(409, 7, 'Visnagar'),
(410, 7, 'Vyara'),
(411, 7, 'Wadhwan'),
(412, 7, 'Wankaner'),
(413, 7, 'Adalaj'),
(414, 7, 'Adityana'),
(415, 7, 'Alang'),
(416, 7, 'Ambaji'),
(417, 7, 'Ambaliyasan'),
(418, 7, 'Andada'),
(419, 7, 'Anjar'),
(420, 7, 'Anklav'),
(421, 7, 'Antaliya'),
(422, 7, 'Arambhada'),
(423, 7, 'Atul'),
(424, 8, 'Ballabhgarh'),
(425, 8, 'Ambala'),
(426, 8, 'Ambala'),
(427, 8, 'Asankhurd'),
(428, 8, 'Assandh'),
(429, 8, 'Ateli'),
(430, 8, 'Babiyal'),
(431, 8, 'Bahadurgarh'),
(432, 8, 'Barwala'),
(433, 8, 'Bhiwani'),
(434, 8, 'Charkhi Dadri'),
(435, 8, 'Cheeka'),
(436, 8, 'Ellenabad 2'),
(437, 8, 'Faridabad'),
(438, 8, 'Fatehabad'),
(439, 8, 'Ganaur'),
(440, 8, 'Gharaunda'),
(441, 8, 'Gohana'),
(442, 8, 'Gurgaon'),
(443, 8, 'Haibat(Yamuna Nagar)'),
(444, 8, 'Hansi'),
(445, 8, 'Hisar'),
(446, 8, 'Hodal'),
(447, 8, 'Jhajjar'),
(448, 8, 'Jind'),
(449, 8, 'Kaithal'),
(450, 8, 'Kalan Wali'),
(451, 8, 'Kalka'),
(452, 8, 'Karnal'),
(453, 8, 'Ladwa'),
(454, 8, 'Mahendragarh'),
(455, 8, 'Mandi Dabwali'),
(456, 8, 'Narnaul'),
(457, 8, 'Narwana'),
(458, 8, 'Palwal'),
(459, 8, 'Panchkula'),
(460, 8, 'Panipat'),
(461, 8, 'Pehowa'),
(462, 8, 'Pinjore'),
(463, 8, 'Rania'),
(464, 8, 'Ratia'),
(465, 8, 'Rewari'),
(466, 8, 'Rohtak'),
(467, 8, 'Safidon'),
(468, 8, 'Samalkha'),
(469, 8, 'Shahbad'),
(470, 8, 'Sirsa'),
(471, 8, 'Sohna'),
(472, 8, 'Sonipat'),
(473, 8, 'Taraori'),
(474, 8, 'Thanesar'),
(475, 8, 'Tohana'),
(476, 8, 'Yamunanagar'),
(477, 9, 'Arki'),
(478, 9, 'Baddi'),
(479, 9, 'Bilaspur'),
(480, 9, 'Chamba'),
(481, 9, 'Dalhousie'),
(482, 9, 'Dharamsala'),
(483, 9, 'Hamirpur'),
(484, 9, 'Mandi'),
(485, 9, 'Nahan'),
(486, 9, 'Shimla'),
(487, 9, 'Solan'),
(488, 9, 'Sundarnagar'),
(489, 10, 'Jammu'),
(490, 10, 'Achabbal'),
(491, 10, 'Akhnoor'),
(492, 10, 'Anantnag'),
(493, 10, 'Arnia'),
(494, 10, 'Awantipora'),
(495, 10, 'Bandipore'),
(496, 10, 'Baramula'),
(497, 10, 'Kathua'),
(498, 10, 'Leh'),
(499, 10, 'Punch'),
(500, 10, 'Rajauri'),
(501, 10, 'Sopore'),
(502, 10, 'Srinagar'),
(503, 10, 'Udhampur'),
(504, 11, 'Amlabad'),
(505, 11, 'Ara'),
(506, 11, 'Barughutu'),
(507, 11, 'Bokaro Steel City'),
(508, 11, 'Chaibasa'),
(509, 11, 'Chakradharpur'),
(510, 11, 'Chandrapura'),
(511, 11, 'Chatra'),
(512, 11, 'Chirkunda'),
(513, 11, 'Churi'),
(514, 11, 'Daltonganj'),
(515, 11, 'Deoghar'),
(516, 11, 'Dhanbad'),
(517, 11, 'Dumka'),
(518, 11, 'Garhwa'),
(519, 11, 'Ghatshila'),
(520, 11, 'Giridih'),
(521, 11, 'Godda'),
(522, 11, 'Gomoh'),
(523, 11, 'Gumia'),
(524, 11, 'Gumla'),
(525, 11, 'Hazaribag'),
(526, 11, 'Hussainabad'),
(527, 11, 'Jamshedpur'),
(528, 11, 'Jamtara'),
(529, 11, 'Jhumri Tilaiya'),
(530, 11, 'Khunti'),
(531, 11, 'Lohardaga'),
(532, 11, 'Madhupur'),
(533, 11, 'Mihijam'),
(534, 11, 'Musabani'),
(535, 11, 'Pakaur'),
(536, 11, 'Patratu'),
(537, 11, 'Phusro'),
(538, 11, 'Ramngarh'),
(539, 11, 'Ranchi'),
(540, 11, 'Sahibganj'),
(541, 11, 'Saunda'),
(542, 11, 'Simdega'),
(543, 11, 'Tenu Dam-cum- Kathhara'),
(544, 12, 'Arasikere'),
(545, 12, 'Bangalore'),
(546, 12, 'Belgaum'),
(547, 12, 'Bellary'),
(548, 12, 'Chamrajnagar'),
(549, 12, 'Chikkaballapur'),
(550, 12, 'Chintamani'),
(551, 12, 'Chitradurga'),
(552, 12, 'Gulbarga'),
(553, 12, 'Gundlupet'),
(554, 12, 'Hassan'),
(555, 12, 'Hospet'),
(556, 12, 'Hubli'),
(557, 12, 'Karkala'),
(558, 12, 'Karwar'),
(559, 12, 'Kolar'),
(560, 12, 'Kota'),
(561, 12, 'Lakshmeshwar'),
(562, 12, 'Lingsugur'),
(563, 12, 'Maddur'),
(564, 12, 'Madhugiri'),
(565, 12, 'Madikeri'),
(566, 12, 'Magadi'),
(567, 12, 'Mahalingpur'),
(568, 12, 'Malavalli'),
(569, 12, 'Malur'),
(570, 12, 'Mandya'),
(571, 12, 'Mangalore'),
(572, 12, 'Manvi'),
(573, 12, 'Mudalgi'),
(574, 12, 'Mudbidri'),
(575, 12, 'Muddebihal'),
(576, 12, 'Mudhol'),
(577, 12, 'Mulbagal'),
(578, 12, 'Mundargi'),
(579, 12, 'Mysore'),
(580, 12, 'Nanjangud'),
(581, 12, 'Pavagada'),
(582, 12, 'Puttur'),
(583, 12, 'Rabkavi Banhatti'),
(584, 12, 'Raichur'),
(585, 12, 'Ramanagaram'),
(586, 12, 'Ramdurg'),
(587, 12, 'Ranibennur'),
(588, 12, 'Robertson Pet'),
(589, 12, 'Ron'),
(590, 12, 'Sadalgi'),
(591, 12, 'Sagar'),
(592, 12, 'Sakleshpur'),
(593, 12, 'Sandur'),
(594, 12, 'Sankeshwar'),
(595, 12, 'Saundatti-Yellamma'),
(596, 12, 'Savanur'),
(597, 12, 'Sedam'),
(598, 12, 'Shahabad'),
(599, 12, 'Shahpur'),
(600, 12, 'Shiggaon'),
(601, 12, 'Shikapur'),
(602, 12, 'Shimoga'),
(603, 12, 'Shorapur'),
(604, 12, 'Shrirangapattana'),
(605, 12, 'Sidlaghatta'),
(606, 12, 'Sindgi'),
(607, 12, 'Sindhnur'),
(608, 12, 'Sira'),
(609, 12, 'Sirsi'),
(610, 12, 'Siruguppa'),
(611, 12, 'Srinivaspur'),
(612, 12, 'Talikota'),
(613, 12, 'Tarikere'),
(614, 12, 'Tekkalakota'),
(615, 12, 'Terdal'),
(616, 12, 'Tiptur'),
(617, 12, 'Tumkur'),
(618, 12, 'Udupi'),
(619, 12, 'Vijayapura'),
(620, 12, 'Wadi'),
(621, 12, 'Yadgir'),
(622, 13, 'Adoor'),
(623, 13, 'Akathiyoor'),
(624, 13, 'Alappuzha'),
(625, 13, 'Ancharakandy'),
(626, 13, 'Aroor'),
(627, 13, 'Ashtamichira'),
(628, 13, 'Attingal'),
(629, 13, 'Avinissery'),
(630, 13, 'Chalakudy'),
(631, 13, 'Changanassery'),
(632, 13, 'Chendamangalam'),
(633, 13, 'Chengannur'),
(634, 13, 'Cherthala'),
(635, 13, 'Cheruthazham'),
(636, 13, 'Chittur-Thathamangalam'),
(637, 13, 'Chockli'),
(638, 13, 'Erattupetta'),
(639, 13, 'Guruvayoor'),
(640, 13, 'Irinjalakuda'),
(641, 13, 'Kadirur'),
(642, 13, 'Kalliasseri'),
(643, 13, 'Kalpetta'),
(644, 13, 'Kanhangad'),
(645, 13, 'Kanjikkuzhi'),
(646, 13, 'Kannur'),
(647, 13, 'Kasaragod'),
(648, 13, 'Kayamkulam'),
(649, 13, 'Kochi'),
(650, 13, 'Kodungallur'),
(651, 13, 'Kollam'),
(652, 13, 'Koothuparamba'),
(653, 13, 'Kothamangalam'),
(654, 13, 'Kottayam'),
(655, 13, 'Kozhikode'),
(656, 13, 'Kunnamkulam'),
(657, 13, 'Malappuram'),
(658, 13, 'Mattannur'),
(659, 13, 'Mavelikkara'),
(660, 13, 'Mavoor'),
(661, 13, 'Muvattupuzha'),
(662, 13, 'Nedumangad'),
(663, 13, 'Neyyattinkara'),
(664, 13, 'Ottappalam'),
(665, 13, 'Palai'),
(666, 13, 'Palakkad'),
(667, 13, 'Panniyannur'),
(668, 13, 'Pappinisseri'),
(669, 13, 'Paravoor'),
(670, 13, 'Pathanamthitta'),
(671, 13, 'Payyannur'),
(672, 13, 'Peringathur'),
(673, 13, 'Perinthalmanna'),
(674, 13, 'Perumbavoor'),
(675, 13, 'Ponnani'),
(676, 13, 'Punalur'),
(677, 13, 'Quilandy'),
(678, 13, 'Shoranur'),
(679, 13, 'Taliparamba'),
(680, 13, 'Thiruvalla'),
(681, 13, 'Thiruvananthapuram'),
(682, 13, 'Thodupuzha'),
(683, 13, 'Thrissur'),
(684, 13, 'Tirur'),
(685, 13, 'Vadakara'),
(686, 13, 'Vaikom'),
(687, 13, 'Varkala'),
(688, 14, 'Ashok Nagar'),
(689, 14, 'Balaghat'),
(690, 14, 'Betul'),
(691, 14, 'Bhopal'),
(692, 14, 'Burhanpur'),
(693, 14, 'Chhatarpur'),
(694, 14, 'Dabra'),
(695, 14, 'Datia'),
(696, 14, 'Dewas'),
(697, 14, 'Dhar'),
(698, 14, 'Fatehabad'),
(699, 14, 'Gwalior'),
(700, 14, 'Indore'),
(701, 14, 'Itarsi'),
(702, 14, 'Jabalpur'),
(703, 14, 'Katni'),
(704, 14, 'Kotma'),
(705, 14, 'Lahar'),
(706, 14, 'Lundi'),
(707, 14, 'Maharajpur'),
(708, 14, 'Mahidpur'),
(709, 14, 'Maihar'),
(710, 14, 'Malajkhand'),
(711, 14, 'Manasa'),
(712, 14, 'Manawar'),
(713, 14, 'Mandideep'),
(714, 14, 'Mandla'),
(715, 14, 'Mandsaur'),
(716, 14, 'Mauganj'),
(717, 14, 'Mhow Cantonment'),
(718, 14, 'Mhowgaon'),
(719, 14, 'Morena'),
(720, 14, 'Multai'),
(721, 14, 'Murwara'),
(722, 14, 'Nagda'),
(723, 14, 'Nainpur'),
(724, 14, 'Narsinghgarh'),
(725, 14, 'Narsinghgarh'),
(726, 14, 'Neemuch'),
(727, 14, 'Nepanagar'),
(728, 14, 'Niwari'),
(729, 14, 'Nowgong'),
(730, 14, 'Nowrozabad'),
(731, 14, 'Pachore'),
(732, 14, 'Pali'),
(733, 14, 'Panagar'),
(734, 14, 'Pandhurna'),
(735, 14, 'Panna'),
(736, 14, 'Pasan'),
(737, 14, 'Pipariya'),
(738, 14, 'Pithampur'),
(739, 14, 'Porsa'),
(740, 14, 'Prithvipur'),
(741, 14, 'Raghogarh-Vijaypur'),
(742, 14, 'Rahatgarh'),
(743, 14, 'Raisen'),
(744, 14, 'Rajgarh'),
(745, 14, 'Ratlam'),
(746, 14, 'Rau'),
(747, 14, 'Rehli'),
(748, 14, 'Rewa'),
(749, 14, 'Sabalgarh'),
(750, 14, 'Sagar'),
(751, 14, 'Sanawad'),
(752, 14, 'Sarangpur'),
(753, 14, 'Sarni'),
(754, 14, 'Satna'),
(755, 14, 'Sausar'),
(756, 14, 'Sehore'),
(757, 14, 'Sendhwa'),
(758, 14, 'Seoni'),
(759, 14, 'Seoni-Malwa'),
(760, 14, 'Shahdol'),
(761, 14, 'Shajapur'),
(762, 14, 'Shamgarh'),
(763, 14, 'Sheopur'),
(764, 14, 'Shivpuri'),
(765, 14, 'Shujalpur'),
(766, 14, 'Sidhi'),
(767, 14, 'Sihora'),
(768, 14, 'Singrauli'),
(769, 14, 'Sironj'),
(770, 14, 'Sohagpur'),
(771, 14, 'Tarana'),
(772, 14, 'Tikamgarh'),
(773, 14, 'Ujhani'),
(774, 14, 'Ujjain'),
(775, 14, 'Umaria'),
(776, 14, 'Vidisha'),
(777, 14, 'Wara Seoni'),
(778, 15, 'Ahmednagar'),
(779, 15, 'Akola'),
(780, 15, 'Amravati'),
(781, 15, 'Aurangabad'),
(782, 15, 'Baramati'),
(783, 15, 'Chalisgaon'),
(784, 15, 'Chinchani'),
(785, 15, 'Devgarh'),
(786, 15, 'Dhule'),
(787, 15, 'Dombivli'),
(788, 15, 'Durgapur'),
(789, 15, 'Ichalkaranji'),
(790, 15, 'Jalna'),
(791, 15, 'Kalyan'),
(792, 15, 'Latur'),
(793, 15, 'Loha'),
(794, 15, 'Lonar'),
(795, 15, 'Lonavla'),
(796, 15, 'Mahad'),
(797, 15, 'Mahuli'),
(798, 15, 'Malegaon'),
(799, 15, 'Malkapur'),
(800, 15, 'Manchar'),
(801, 15, 'Mangalvedhe'),
(802, 15, 'Mangrulpir'),
(803, 15, 'Manjlegaon'),
(804, 15, 'Manmad'),
(805, 15, 'Manwath'),
(806, 15, 'Mehkar'),
(807, 15, 'Mhaswad'),
(808, 15, 'Miraj'),
(809, 15, 'Morshi'),
(810, 15, 'Mukhed'),
(811, 15, 'Mul'),
(812, 15, 'Mumbai'),
(813, 15, 'Murtijapur'),
(814, 15, 'Nagpur'),
(815, 15, 'Nalasopara'),
(816, 15, 'Nanded-Waghala'),
(817, 15, 'Nandgaon'),
(818, 15, 'Nandura'),
(819, 15, 'Nandurbar'),
(820, 15, 'Narkhed'),
(821, 15, 'Nashik'),
(822, 15, 'Navi Mumbai'),
(823, 15, 'Nawapur'),
(824, 15, 'Nilanga'),
(825, 15, 'Osmanabad'),
(826, 15, 'Ozar'),
(827, 15, 'Pachora'),
(828, 15, 'Paithan'),
(829, 15, 'Palghar'),
(830, 15, 'Pandharkaoda'),
(831, 15, 'Pandharpur'),
(832, 15, 'Panvel'),
(833, 15, 'Parbhani'),
(834, 15, 'Parli'),
(835, 15, 'Parola'),
(836, 15, 'Partur'),
(837, 15, 'Pathardi'),
(838, 15, 'Pathri'),
(839, 15, 'Patur'),
(840, 15, 'Pauni'),
(841, 15, 'Pen'),
(842, 15, 'Phaltan'),
(843, 15, 'Pulgaon'),
(844, 15, 'Pune'),
(845, 15, 'Purna'),
(846, 15, 'Pusad'),
(847, 15, 'Rahuri'),
(848, 15, 'Rajura'),
(849, 15, 'Ramtek'),
(850, 15, 'Ratnagiri'),
(851, 15, 'Raver'),
(852, 15, 'Risod'),
(853, 15, 'Sailu'),
(854, 15, 'Sangamner'),
(855, 15, 'Sangli'),
(856, 15, 'Sangole'),
(857, 15, 'Sasvad'),
(858, 15, 'Satana'),
(859, 15, 'Satara'),
(860, 15, 'Savner'),
(861, 15, 'Sawantwadi'),
(862, 15, 'Shahade'),
(863, 15, 'Shegaon'),
(864, 15, 'Shendurjana'),
(865, 15, 'Shirdi'),
(866, 15, 'Shirpur-Warwade'),
(867, 15, 'Shirur'),
(868, 15, 'Shrigonda'),
(869, 15, 'Shrirampur'),
(870, 15, 'Sillod'),
(871, 15, 'Sinnar'),
(872, 15, 'Solapur'),
(873, 15, 'Soyagaon'),
(874, 15, 'Talegaon Dabhade'),
(875, 15, 'Talode'),
(876, 15, 'Tasgaon'),
(877, 15, 'Tirora'),
(878, 15, 'Tuljapur'),
(879, 15, 'Tumsar'),
(880, 15, 'Uran'),
(881, 15, 'Uran Islampur'),
(882, 15, 'Wadgaon Road'),
(883, 15, 'Wai'),
(884, 15, 'Wani'),
(885, 15, 'Wardha'),
(886, 15, 'Warora'),
(887, 15, 'Warud'),
(888, 15, 'Washim'),
(889, 15, 'Yevla'),
(890, 15, 'Uchgaon'),
(891, 15, 'Udgir'),
(892, 15, 'Umarga'),
(893, 15, 'Umarkhed'),
(894, 15, 'Umred'),
(895, 15, 'Vadgaon Kasba'),
(896, 15, 'Vaijapur'),
(897, 15, 'Vasai'),
(898, 15, 'Virar'),
(899, 15, 'Vita'),
(900, 15, 'Yavatmal'),
(901, 15, 'Yawal'),
(902, 16, 'Imphal'),
(903, 16, 'Kakching'),
(904, 16, 'Lilong'),
(905, 16, 'Mayang Imphal'),
(906, 16, 'Thoubal'),
(907, 17, 'Jowai'),
(908, 17, 'Nongstoin'),
(909, 17, 'Shillong'),
(910, 17, 'Tura'),
(911, 18, 'Aizawl'),
(912, 18, 'Champhai'),
(913, 18, 'Lunglei'),
(914, 18, 'Saiha'),
(915, 19, 'Dimapur'),
(916, 19, 'Kohima'),
(917, 19, 'Mokokchung'),
(918, 19, 'Tuensang'),
(919, 19, 'Wokha'),
(920, 19, 'Zunheboto'),
(921, 20, 'Anandapur'),
(922, 20, 'Anugul'),
(923, 20, 'Asika'),
(924, 20, 'Balangir'),
(925, 20, 'Balasore'),
(926, 20, 'Baleshwar'),
(927, 20, 'Bamra'),
(928, 20, 'Barbil'),
(929, 20, 'Bargarh'),
(930, 20, 'Bargarh'),
(931, 20, 'Baripada'),
(932, 20, 'Basudebpur'),
(933, 20, 'Belpahar'),
(934, 20, 'Bhadrak'),
(935, 20, 'Bhawanipatna'),
(936, 20, 'Bhuban'),
(937, 20, 'Bhubaneswar'),
(938, 20, 'Biramitrapur'),
(939, 20, 'Brahmapur'),
(940, 20, 'Brajrajnagar'),
(941, 20, 'Byasanagar'),
(942, 20, 'Cuttack'),
(943, 20, 'Debagarh'),
(944, 20, 'Dhenkanal'),
(945, 20, 'Gunupur'),
(946, 20, 'Hinjilicut'),
(947, 20, 'Jagatsinghapur'),
(948, 20, 'Jajapur'),
(949, 20, 'Jaleswar'),
(950, 20, 'Jatani'),
(951, 20, 'Jeypur'),
(952, 20, 'Jharsuguda'),
(953, 20, 'Joda'),
(954, 20, 'Kantabanji'),
(955, 20, 'Karanjia'),
(956, 20, 'Kendrapara'),
(957, 20, 'Kendujhar'),
(958, 20, 'Khordha'),
(959, 20, 'Koraput'),
(960, 20, 'Malkangiri'),
(961, 20, 'Nabarangapur'),
(962, 20, 'Paradip'),
(963, 20, 'Parlakhemundi'),
(964, 20, 'Pattamundai'),
(965, 20, 'Phulabani'),
(966, 20, 'Puri'),
(967, 20, 'Rairangpur'),
(968, 20, 'Rajagangapur'),
(969, 20, 'Raurkela'),
(970, 20, 'Rayagada'),
(971, 20, 'Sambalpur'),
(972, 20, 'Soro'),
(973, 20, 'Sunabeda'),
(974, 20, 'Sundargarh'),
(975, 20, 'Talcher'),
(976, 20, 'Titlagarh'),
(977, 20, 'Umarkote'),
(978, 35, 'Karaikal'),
(979, 35, 'Mahe'),
(980, 35, 'Pondicherry'),
(981, 35, 'Yanam'),
(982, 21, 'Ahmedgarh'),
(983, 21, 'Amritsar'),
(984, 21, 'Barnala'),
(985, 21, 'Batala'),
(986, 21, 'Bathinda'),
(987, 21, 'Bhagha Purana'),
(988, 21, 'Budhlada'),
(989, 21, 'Chandigarh'),
(990, 21, 'Dasua'),
(991, 21, 'Dhuri'),
(992, 21, 'Dinanagar'),
(993, 21, 'Faridkot'),
(994, 21, 'Fazilka'),
(995, 21, 'Firozpur'),
(996, 21, 'Firozpur Cantt.'),
(997, 21, 'Giddarbaha'),
(998, 21, 'Gobindgarh'),
(999, 21, 'Gurdaspur'),
(1000, 21, 'Hoshiarpur'),
(1001, 21, 'Jagraon'),
(1002, 21, 'Jaitu'),
(1003, 21, 'Jalalabad'),
(1004, 21, 'Jalandhar'),
(1005, 21, 'Jalandhar Cantt.'),
(1006, 21, 'Jandiala'),
(1007, 21, 'Kapurthala'),
(1008, 21, 'Karoran'),
(1009, 21, 'Kartarpur'),
(1010, 21, 'Khanna'),
(1011, 21, 'Kharar'),
(1012, 21, 'Kot Kapura'),
(1013, 21, 'Kurali'),
(1014, 21, 'Longowal'),
(1015, 21, 'Ludhiana'),
(1016, 21, 'Malerkotla'),
(1017, 21, 'Malout'),
(1018, 21, 'Mansa'),
(1019, 21, 'Maur'),
(1020, 21, 'Moga'),
(1021, 21, 'Mohali'),
(1022, 21, 'Morinda'),
(1023, 21, 'Mukerian'),
(1024, 21, 'Muktsar'),
(1025, 21, 'Nabha'),
(1026, 21, 'Nakodar'),
(1027, 21, 'Nangal'),
(1028, 21, 'Nawanshahr'),
(1029, 21, 'Pathankot'),
(1030, 21, 'Patiala'),
(1031, 21, 'Patran'),
(1032, 21, 'Patti'),
(1033, 21, 'Phagwara'),
(1034, 21, 'Phillaur'),
(1035, 21, 'Qadian'),
(1036, 21, 'Raikot'),
(1037, 21, 'Rajpura'),
(1038, 21, 'Rampura Phul'),
(1039, 21, 'Rupnagar'),
(1040, 21, 'Samana'),
(1041, 21, 'Sangrur'),
(1042, 21, 'Sirhind Fatehgarh Sahib'),
(1043, 21, 'Sujanpur'),
(1044, 21, 'Sunam'),
(1045, 21, 'Talwara'),
(1046, 21, 'Tarn Taran'),
(1047, 21, 'Urmar Tanda'),
(1048, 21, 'Zira'),
(1049, 21, 'Zirakpur'),
(1050, 22, 'Bali'),
(1051, 22, 'Banswara'),
(1052, 22, 'Ajmer'),
(1053, 22, 'Alwar'),
(1054, 22, 'Bandikui'),
(1055, 22, 'Baran'),
(1056, 22, 'Barmer'),
(1057, 22, 'Bikaner'),
(1058, 22, 'Fatehpur'),
(1059, 22, 'Jaipur'),
(1060, 22, 'Jaisalmer'),
(1061, 22, 'Jodhpur'),
(1062, 22, 'Kota'),
(1063, 22, 'Lachhmangarh'),
(1064, 22, 'Ladnu'),
(1065, 22, 'Lakheri'),
(1066, 22, 'Lalsot'),
(1067, 22, 'Losal'),
(1068, 22, 'Makrana'),
(1069, 22, 'Malpura'),
(1070, 22, 'Mandalgarh'),
(1071, 22, 'Mandawa'),
(1072, 22, 'Mangrol'),
(1073, 22, 'Merta City'),
(1074, 22, 'Mount Abu'),
(1075, 22, 'Nadbai'),
(1076, 22, 'Nagar'),
(1077, 22, 'Nagaur'),
(1078, 22, 'Nargund'),
(1079, 22, 'Nasirabad'),
(1080, 22, 'Nathdwara'),
(1081, 22, 'Navalgund'),
(1082, 22, 'Nawalgarh'),
(1083, 22, 'Neem-Ka-Thana'),
(1084, 22, 'Nelamangala'),
(1085, 22, 'Nimbahera'),
(1086, 22, 'Nipani'),
(1087, 22, 'Niwai'),
(1088, 22, 'Nohar'),
(1089, 22, 'Nokha'),
(1090, 22, 'Pali'),
(1091, 22, 'Phalodi'),
(1092, 22, 'Phulera'),
(1093, 22, 'Pilani'),
(1094, 22, 'Pilibanga'),
(1095, 22, 'Pindwara'),
(1096, 22, 'Pipar City'),
(1097, 22, 'Prantij'),
(1098, 22, 'Pratapgarh'),
(1099, 22, 'Raisinghnagar'),
(1100, 22, 'Rajakhera'),
(1101, 22, 'Rajaldesar'),
(1102, 22, 'Rajgarh (Alwar)'),
(1103, 22, 'Rajgarh (Churu'),
(1104, 22, 'Rajsamand'),
(1105, 22, 'Ramganj Mandi'),
(1106, 22, 'Ramngarh'),
(1107, 22, 'Ratangarh'),
(1108, 22, 'Rawatbhata'),
(1109, 22, 'Rawatsar'),
(1110, 22, 'Reengus'),
(1111, 22, 'Sadri'),
(1112, 22, 'Sadulshahar'),
(1113, 22, 'Sagwara'),
(1114, 22, 'Sambhar'),
(1115, 22, 'Sanchore'),
(1116, 22, 'Sangaria'),
(1117, 22, 'Sardarshahar'),
(1118, 22, 'Sawai Madhopur'),
(1119, 22, 'Shahpura'),
(1120, 22, 'Shahpura'),
(1121, 22, 'Sheoganj'),
(1122, 22, 'Sikar'),
(1123, 22, 'Sirohi'),
(1124, 22, 'Sojat'),
(1125, 22, 'Sri Madhopur'),
(1126, 22, 'Sujangarh'),
(1127, 22, 'Sumerpur'),
(1128, 22, 'Suratgarh'),
(1129, 22, 'Taranagar'),
(1130, 22, 'Todabhim'),
(1131, 22, 'Todaraisingh'),
(1132, 22, 'Tonk'),
(1133, 22, 'Udaipur'),
(1134, 22, 'Udaipurwati'),
(1135, 22, 'Vijainagar'),
(1136, 23, 'Gangtok'),
(1137, 28, 'Calcutta'),
(1138, 24, 'Arakkonam'),
(1139, 24, 'Arcot'),
(1140, 24, 'Aruppukkottai'),
(1141, 24, 'Bhavani'),
(1142, 24, 'Chengalpattu'),
(1143, 24, 'Chennai'),
(1144, 24, 'Chinna salem'),
(1145, 24, 'Coimbatore'),
(1146, 24, 'Coonoor'),
(1147, 24, 'Cuddalore'),
(1148, 24, 'Dharmapuri'),
(1149, 24, 'Dindigul'),
(1150, 24, 'Erode'),
(1151, 24, 'Gudalur'),
(1152, 24, 'Gudalur'),
(1153, 24, 'Gudalur'),
(1154, 24, 'Kanchipuram'),
(1155, 24, 'Karaikudi'),
(1156, 24, 'Karungal'),
(1157, 24, 'Karur'),
(1158, 24, 'Kollankodu'),
(1159, 24, 'Lalgudi'),
(1160, 24, 'Madurai'),
(1161, 24, 'Nagapattinam'),
(1162, 24, 'Nagercoil'),
(1163, 24, 'Namagiripettai'),
(1164, 24, 'Namakkal'),
(1165, 24, 'Nandivaram-Guduvancheri'),
(1166, 24, 'Nanjikottai'),
(1167, 24, 'Natham'),
(1168, 24, 'Nellikuppam'),
(1169, 24, 'Neyveli'),
(1170, 24, 'O'' Valley'),
(1171, 24, 'Oddanchatram'),
(1172, 24, 'P.N.Patti'),
(1173, 24, 'Pacode'),
(1174, 24, 'Padmanabhapuram'),
(1175, 24, 'Palani'),
(1176, 24, 'Palladam'),
(1177, 24, 'Pallapatti'),
(1178, 24, 'Pallikonda'),
(1179, 24, 'Panagudi'),
(1180, 24, 'Panruti'),
(1181, 24, 'Paramakudi'),
(1182, 24, 'Parangipettai'),
(1183, 24, 'Pattukkottai'),
(1184, 24, 'Perambalur'),
(1185, 24, 'Peravurani'),
(1186, 24, 'Periyakulam'),
(1187, 24, 'Periyasemur'),
(1188, 24, 'Pernampattu'),
(1189, 24, 'Pollachi'),
(1190, 24, 'Polur'),
(1191, 24, 'Ponneri'),
(1192, 24, 'Pudukkottai'),
(1193, 24, 'Pudupattinam'),
(1194, 24, 'Puliyankudi'),
(1195, 24, 'Punjaipugalur'),
(1196, 24, 'Rajapalayam'),
(1197, 24, 'Ramanathapuram'),
(1198, 24, 'Rameshwaram'),
(1199, 24, 'Rasipuram'),
(1200, 24, 'Salem'),
(1201, 24, 'Sankarankoil'),
(1202, 24, 'Sankari'),
(1203, 24, 'Sathyamangalam'),
(1204, 24, 'Sattur'),
(1205, 24, 'Shenkottai'),
(1206, 24, 'Sholavandan'),
(1207, 24, 'Sholingur'),
(1208, 24, 'Sirkali'),
(1209, 24, 'Sivaganga'),
(1210, 24, 'Sivagiri'),
(1211, 24, 'Sivakasi'),
(1212, 24, 'Srivilliputhur'),
(1213, 24, 'Surandai'),
(1214, 24, 'Suriyampalayam'),
(1215, 24, 'Tenkasi'),
(1216, 24, 'Thammampatti'),
(1217, 24, 'Thanjavur'),
(1218, 24, 'Tharamangalam'),
(1219, 24, 'Tharangambadi'),
(1220, 24, 'Theni Allinagaram'),
(1221, 24, 'Thirumangalam'),
(1222, 24, 'Thirunindravur'),
(1223, 24, 'Thiruparappu'),
(1224, 24, 'Thirupuvanam'),
(1225, 24, 'Thiruthuraipoondi'),
(1226, 24, 'Thiruvallur'),
(1227, 24, 'Thiruvarur'),
(1228, 24, 'Thoothukudi'),
(1229, 24, 'Thuraiyur'),
(1230, 24, 'Tindivanam'),
(1231, 24, 'Tiruchendur'),
(1232, 24, 'Tiruchengode'),
(1233, 24, 'Tiruchirappalli'),
(1234, 24, 'Tirukalukundram'),
(1235, 24, 'Tirukkoyilur'),
(1236, 24, 'Tirunelveli'),
(1237, 24, 'Tirupathur'),
(1238, 24, 'Tirupathur'),
(1239, 24, 'Tiruppur'),
(1240, 24, 'Tiruttani'),
(1241, 24, 'Tiruvannamalai'),
(1242, 24, 'Tiruvethipuram'),
(1243, 24, 'Tittakudi'),
(1244, 24, 'Udhagamandalam'),
(1245, 24, 'Udumalaipettai'),
(1246, 24, 'Unnamalaikadai'),
(1247, 24, 'Usilampatti'),
(1248, 24, 'Uthamapalayam'),
(1249, 24, 'Uthiramerur'),
(1250, 24, 'Vadakkuvalliyur'),
(1251, 24, 'Vadalur'),
(1252, 24, 'Vadipatti'),
(1253, 24, 'Valparai'),
(1254, 24, 'Vandavasi'),
(1255, 24, 'Vaniyambadi'),
(1256, 24, 'Vedaranyam'),
(1257, 24, 'Vellakoil'),
(1258, 24, 'Vellore'),
(1259, 24, 'Vikramasingapuram'),
(1260, 24, 'Viluppuram'),
(1261, 24, 'Virudhachalam'),
(1262, 24, 'Virudhunagar'),
(1263, 24, 'Viswanatham'),
(1264, 25, 'Agartala'),
(1265, 25, 'Badharghat'),
(1266, 25, 'Dharmanagar'),
(1267, 25, 'Indranagar'),
(1268, 25, 'Jogendranagar'),
(1269, 25, 'Kailasahar'),
(1270, 25, 'Khowai'),
(1271, 25, 'Pratapgarh'),
(1272, 25, 'Udaipur'),
(1273, 27, 'Achhnera'),
(1274, 27, 'Adari'),
(1275, 27, 'Agra'),
(1276, 27, 'Aligarh'),
(1277, 27, 'Allahabad'),
(1278, 27, 'Amroha'),
(1279, 27, 'Azamgarh'),
(1280, 27, 'Bahraich'),
(1281, 27, 'Ballia'),
(1282, 27, 'Balrampur'),
(1283, 27, 'Banda'),
(1284, 27, 'Bareilly'),
(1285, 27, 'Chandausi'),
(1286, 27, 'Dadri'),
(1287, 27, 'Deoria'),
(1288, 27, 'Etawah'),
(1289, 27, 'Fatehabad'),
(1290, 27, 'Fatehpur'),
(1291, 27, 'Fatehpur'),
(1292, 27, 'Greater Noida'),
(1293, 27, 'Hamirpur'),
(1294, 27, 'Hardoi'),
(1295, 27, 'Jajmau'),
(1296, 27, 'Jaunpur'),
(1297, 27, 'Jhansi'),
(1298, 27, 'Kalpi'),
(1299, 27, 'Kanpur'),
(1300, 27, 'Kota'),
(1301, 27, 'Laharpur'),
(1302, 27, 'Lakhimpur'),
(1303, 27, 'Lal Gopalganj Nindaura'),
(1304, 27, 'Lalganj'),
(1305, 27, 'Lalitpur'),
(1306, 27, 'Lar'),
(1307, 27, 'Loni'),
(1308, 27, 'Lucknow'),
(1309, 27, 'Mathura'),
(1310, 27, 'Meerut'),
(1311, 27, 'Modinagar'),
(1312, 27, 'Muradnagar'),
(1313, 27, 'Nagina'),
(1314, 27, 'Najibabad'),
(1315, 27, 'Nakur'),
(1316, 27, 'Nanpara'),
(1317, 27, 'Naraura'),
(1318, 27, 'Naugawan Sadat'),
(1319, 27, 'Nautanwa'),
(1320, 27, 'Nawabganj'),
(1321, 27, 'Nehtaur'),
(1322, 27, 'NOIDA'),
(1323, 27, 'Noorpur'),
(1324, 27, 'Obra'),
(1325, 27, 'Orai'),
(1326, 27, 'Padrauna'),
(1327, 27, 'Palia Kalan'),
(1328, 27, 'Parasi'),
(1329, 27, 'Phulpur'),
(1330, 27, 'Pihani'),
(1331, 27, 'Pilibhit'),
(1332, 27, 'Pilkhuwa'),
(1333, 27, 'Powayan'),
(1334, 27, 'Pukhrayan'),
(1335, 27, 'Puranpur'),
(1336, 27, 'Purquazi'),
(1337, 27, 'Purwa'),
(1338, 27, 'Rae Bareli'),
(1339, 27, 'Rampur'),
(1340, 27, 'Rampur Maniharan'),
(1341, 27, 'Rasra'),
(1342, 27, 'Rath'),
(1343, 27, 'Renukoot'),
(1344, 27, 'Reoti'),
(1345, 27, 'Robertsganj'),
(1346, 27, 'Rudauli'),
(1347, 27, 'Rudrapur'),
(1348, 27, 'Sadabad'),
(1349, 27, 'Safipur'),
(1350, 27, 'Saharanpur'),
(1351, 27, 'Sahaspur'),
(1352, 27, 'Sahaswan'),
(1353, 27, 'Sahawar'),
(1354, 27, 'Sahjanwa'),
(1355, 27, 'Sambhal'),
(1356, 27, 'Samdhan'),
(1357, 27, 'Samthar'),
(1358, 27, 'Sandi'),
(1359, 27, 'Sandila'),
(1360, 27, 'Sardhana'),
(1361, 27, 'Seohara'),
(1362, 27, 'Shahganj'),
(1363, 27, 'Shahjahanpur'),
(1364, 27, 'Shamli'),
(1365, 27, 'Sherkot'),
(1366, 27, 'Shikohabad'),
(1367, 27, 'Shishgarh'),
(1368, 27, 'Siana'),
(1369, 27, 'Sikanderpur'),
(1370, 27, 'Sikandra Rao'),
(1371, 27, 'Sikandrabad'),
(1372, 27, 'Sirsaganj'),
(1373, 27, 'Sirsi'),
(1374, 27, 'Sitapur'),
(1375, 27, 'Soron'),
(1376, 27, 'Suar'),
(1377, 27, 'Sultanpur'),
(1378, 27, 'Sumerpur'),
(1379, 27, 'Tanda'),
(1380, 27, 'Tanda'),
(1381, 27, 'Tetri Bazar'),
(1382, 27, 'Thakurdwara'),
(1383, 27, 'Thana Bhawan'),
(1384, 27, 'Tilhar'),
(1385, 27, 'Tirwaganj'),
(1386, 27, 'Tulsipur'),
(1387, 27, 'Tundla'),
(1388, 27, 'Unnao'),
(1389, 27, 'Utraula'),
(1390, 27, 'Varanasi'),
(1391, 27, 'Vrindavan'),
(1392, 27, 'Warhapur'),
(1393, 27, 'Zaidpur'),
(1394, 27, 'Zamania'),
(1395, 26, 'Almora'),
(1396, 26, 'Bazpur'),
(1397, 26, 'Chamba'),
(1398, 26, 'Dehradun'),
(1399, 26, 'Haldwani'),
(1400, 26, 'Haridwar'),
(1401, 26, 'Jaspur'),
(1402, 26, 'Kashipur'),
(1403, 26, 'kichha'),
(1404, 26, 'Kotdwara'),
(1405, 26, 'Manglaur'),
(1406, 26, 'Mussoorie'),
(1407, 26, 'Nagla'),
(1408, 26, 'Nainital'),
(1409, 26, 'Pauri'),
(1410, 26, 'Pithoragarh'),
(1411, 26, 'Ramnagar'),
(1412, 26, 'Rishikesh'),
(1413, 26, 'Roorkee'),
(1414, 26, 'Rudrapur'),
(1415, 26, 'Sitarganj'),
(1416, 26, 'Tehri'),
(1417, 27, 'Muzaffarnagar'),
(1418, 28, 'Alipurduar'),
(1419, 28, 'Arambagh'),
(1420, 28, 'Asansol'),
(1421, 28, 'Baharampur'),
(1422, 28, 'Bally'),
(1423, 28, 'Balurghat'),
(1424, 28, 'Bankura'),
(1425, 28, 'Barakar'),
(1426, 28, 'Barasat'),
(1427, 28, 'Bardhaman'),
(1428, 28, 'Bidhan Nagar'),
(1429, 28, 'Chinsura'),
(1430, 28, 'Contai'),
(1431, 28, 'Cooch Behar'),
(1432, 28, 'Darjeeling'),
(1433, 28, 'Durgapur'),
(1434, 28, 'Haldia'),
(1435, 28, 'Howrah'),
(1436, 28, 'Islampur'),
(1437, 28, 'Jhargram'),
(1438, 28, 'Kharagpur'),
(1439, 28, 'Kolkata'),
(1440, 28, 'Mainaguri'),
(1441, 28, 'Mal'),
(1442, 28, 'Mathabhanga'),
(1443, 28, 'Medinipur'),
(1444, 28, 'Memari'),
(1445, 28, 'Monoharpur'),
(1446, 28, 'Murshidabad'),
(1447, 28, 'Nabadwip'),
(1448, 28, 'Naihati'),
(1449, 28, 'Panchla'),
(1450, 28, 'Pandua'),
(1451, 28, 'Paschim Punropara'),
(1452, 28, 'Purulia'),
(1453, 28, 'Raghunathpur'),
(1454, 28, 'Raiganj'),
(1455, 28, 'Rampurhat'),
(1456, 28, 'Ranaghat'),
(1457, 28, 'Sainthia'),
(1458, 28, 'Santipur'),
(1459, 28, 'Siliguri'),
(1460, 28, 'Sonamukhi'),
(1461, 28, 'Srirampore'),
(1462, 28, 'Suri'),
(1463, 28, 'Taki'),
(1464, 28, 'Tamluk'),
(1465, 28, 'Tarakeswar'),
(1466, 12, 'Chikmagalur'),
(1467, 12, 'Davanagere'),
(1468, 12, 'Dharwad'),
(1469, 12, 'Gadag'),
(1470, 24, 'Chennai'),
(1471, 24, 'Coimbatore'),
(1472, 24, 'VEERAPANDI PRIVU');

-- --------------------------------------------------------

--
-- Table structure for table `city_distances`
--

CREATE TABLE IF NOT EXISTS `city_distances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `city_from` int(11) NOT NULL,
  `city_to` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `city_from` (`city_from`),
  KEY `city_to` (`city_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Dumping data for table `city_distances`
--

INSERT INTO `city_distances` (`id`, `city_from`, `city_to`, `km`) VALUES
(6, 1143, 1145, 56),
(7, 31, 35, 67),
(8, 31, 36, 75),
(9, 1, 2, 100),
(10, 4, 7, 45);

-- --------------------------------------------------------

--
-- Table structure for table `config`
--

CREATE TABLE IF NOT EXISTS `config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `scope` varchar(225) NOT NULL,
  `value` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `config`
--

INSERT INTO `config` (`id`, `scope`, `value`) VALUES
(1, 'mr_doctors_limit', '20');

-- --------------------------------------------------------

--
-- Table structure for table `daily_allowances`
--

CREATE TABLE IF NOT EXISTS `daily_allowances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_type_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `cost` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_type_id` (`expense_type_id`),
  KEY `role_id` (`role_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `daily_allowances`
--

INSERT INTO `daily_allowances` (`id`, `expense_type_id`, `role_id`, `cost`) VALUES
(1, 1, 5, 0),
(2, 2, 5, 210);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE IF NOT EXISTS `doctors` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `class` int(11) DEFAULT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `qualification_id` int(11) DEFAULT NULL,
  `add_qualification` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `dow` date DEFAULT NULL,
  `address` text NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `reg_no` varchar(50) NOT NULL,
  `door_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `is_approved` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `doc_city_id` (`city_id`),
  KEY `doc_state_id` (`state_id`),
  KEY `doc_speciality_id` (`speciality_id`),
  KEY `doc_qualification_id` (`qualification_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `code`, `user_id`, `name`, `class`, `speciality_id`, `qualification_id`, `add_qualification`, `mobile`, `phone`, `email`, `dob`, `dow`, `address`, `clinic_name`, `reg_no`, `door_no`, `street`, `area`, `state_id`, `city_id`, `pincode`, `is_approved`, `is_active`, `is_deleted`, `last_updated`, `dt`) VALUES
(1, 'DCTN00001', 1, 'RAMADOSS K', 2, 1, 3, 'DM(Neuro)', 123456789, 1321313131, 'ramneuo@gmail.com', '1970-07-16', '1970-01-01', 'address 1', 'SRI RAMAKRISHNA HOSPTIAL', '12334', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2017-11-26 09:19:00', '2017-11-26 09:19:00'),
(2, 'DCTN00002', 1, 'ASOKAN K', 1, 1, 3, 'DM(Neuro)', 79879879, 0, 'drasokan@rediffmail.com', '1995-01-13', '2017-10-17', 'address2', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2017-11-26 09:23:00', '2017-11-26 09:23:00'),
(3, 'DCTN00003', 1, 'VIKRAM M', 2, 8, 4, 'DNB', 1234567896, 0, 'vikram@gmail.com', '1970-01-01', '1970-01-01', 'address of mahesh', 'SRI RAMAKRISHNA HOSPTIAL', '1234', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2017-11-26 09:24:00', '2017-11-26 09:24:00'),
(4, 'DCTN00004', 1, 'JAMBULINGAM S', 2, 4, 3, '', 1234567896, 0, 'dr@gmail.com', '1970-01-01', '1970-01-01', 'address of mahesh', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2017-11-26 09:24:00', '2017-11-26 09:24:00'),
(6, 'DCTN00006', 1, 'RAMASAMY M', 2, 4, 3, '', 2147483647, 0, 'ramar@admin.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-01-18 06:30:49', '2018-01-18 06:30:49'),
(7, 'DCTN00007', 1, 'SARAVANAKUMAR', 0, 8, 4, '', 2147483647, NULL, 'ashok@admin.com', '2000-01-12', '2018-02-06', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-02-07 06:50:02', '2018-02-07 06:50:02'),
(8, 'DCTN00008', 2, 'MURUGESH M', 1, 12, 3, 'DM(Gastro)', 54654562, NULL, 'priya@admin.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-02-19 05:28:19', '2018-02-19 05:28:19'),
(9, 'DCTN00009', 2, 'KRISHNA SHANKAR G', 0, 5, 3, '', 2147483647, NULL, 'harini@admin.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-02-19 05:32:57', '2018-02-19 05:32:57'),
(10, 'DCTN00010', 2, 'MANOHARAN S', 0, 2, 3, 'DM(Cardio)', 89898998, NULL, 'haarini@admin.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-02-19 05:35:31', '2018-02-19 05:35:31'),
(11, 'DCTN00011', 2, 'SUMAN C P', 0, 3, 5, '', 84848484, NULL, 'tet@admin.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-02-27 05:09:26', '2018-02-27 05:09:26'),
(13, 'DCTN00012', 1, 'GOKULA KRISHNAN R', 2, 3, 5, '', 2147483647, 0, 'ramar@admin.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641044, 1, 1, 0, '2018-01-18 06:30:49', '2018-01-18 06:30:49'),
(14, 'DCTN00014', 1, 'GUHAN', NULL, 3, 5, '', 9999999999, NULL, 'kasokan@rediffmail.com', '1970-01-01', '1970-01-01', '', 'SRI RAMAKRISHNA HOSPTIAL', '12345', '395', 'SAROJINI NAIDU ROAD', 'SIDHAPUDUR', 24, 1145, 641013, 0, 0, 0, '2018-06-18 13:13:36', '2018-06-18 13:13:36');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_relation`
--

CREATE TABLE IF NOT EXISTS `doctors_relation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `class` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `dcr_doctor_id` (`doctor_id`),
  KEY `dcr_user_id` (`user_id`),
  KEY `class` (`class`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `doctors_relation`
--

INSERT INTO `doctors_relation` (`id`, `user_id`, `doctor_id`, `class`, `is_active`, `dt`) VALUES
(1, 3, 1, 2, 1, '2017-11-27 21:40:53'),
(2, 3, 2, 2, 1, '2017-11-27 21:40:53'),
(3, 3, 3, 2, 1, '2017-11-27 21:41:05'),
(4, 2, 4, 2, 1, '2017-12-08 13:37:22'),
(6, 2, 1, 2, 1, '2017-12-08 15:20:43'),
(8, 2, 2, 1, 1, '2017-12-09 12:46:15'),
(10, 2, 3, 2, 1, '2018-01-16 08:08:52'),
(11, 4, 2, 1, 1, '2018-01-16 08:16:28'),
(12, 2, 6, 2, 1, '2018-02-06 04:05:26'),
(13, 4, 1, 1, 1, '2018-02-08 18:27:07'),
(14, 4, 3, 2, 1, '2018-02-21 06:19:40'),
(15, 4, 4, 2, 1, '2018-02-21 06:19:40'),
(16, 9, 1, 2, 1, '2018-02-27 04:30:27'),
(17, 9, 2, 2, 1, '2018-02-27 04:30:27'),
(18, 9, 3, 2, 1, '2018-02-27 04:30:28'),
(19, 9, 4, 2, 1, '2018-02-27 04:30:28'),
(20, 9, 6, 2, 1, '2018-02-27 04:31:04'),
(21, 9, 7, 2, 1, '2018-02-27 04:31:04'),
(22, 2, 8, 1, 1, '2018-05-27 17:53:15'),
(23, 2, 13, 2, 1, '2018-05-30 15:03:04'),
(24, 2, 7, 1, 0, '2018-06-18 15:38:27'),
(25, 2, 9, 1, 0, '2018-06-18 15:38:27'),
(26, 2, 10, 1, 0, '2018-06-18 15:38:27'),
(27, 2, 11, 1, 0, '2018-06-18 15:38:27'),
(28, 2, 14, 1, 0, '2018-06-18 15:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_types`
--

CREATE TABLE IF NOT EXISTS `doctor_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `doctor_types`
--

INSERT INTO `doctor_types` (`id`, `name`) VALUES
(1, 'A'),
(2, 'B');

-- --------------------------------------------------------

--
-- Table structure for table `expenses`
--

CREATE TABLE IF NOT EXISTS `expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `work_plan_submit_id` int(11) NOT NULL,
  `expense_date` date NOT NULL,
  `expense_type_id` int(11) NOT NULL,
  `daily_allowance` int(11) NOT NULL,
  `started` time NOT NULL,
  `reached` time NOT NULL,
  `disallowed` int(11) NOT NULL DEFAULT '0',
  `disallowed_remark` varchar(255) NOT NULL,
  `abeyance` int(11) NOT NULL DEFAULT '0',
  `abeyance_remark` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `work_plan_submit_id` (`work_plan_submit_id`),
  KEY `expense_type_id` (`expense_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_approvals`
--

CREATE TABLE IF NOT EXISTS `expense_approvals` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `is_approved` int(11) NOT NULL DEFAULT '0',
  `is_rejected` int(11) NOT NULL DEFAULT '0',
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `expense_types`
--

CREATE TABLE IF NOT EXISTS `expense_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(25) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `expense_types`
--

INSERT INTO `expense_types` (`id`, `name`) VALUES
(1, 'HQ'),
(2, 'EX-HQ'),
(3, 'OS');

-- --------------------------------------------------------

--
-- Table structure for table `gifts`
--

CREATE TABLE IF NOT EXISTS `gifts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `gifts`
--

INSERT INTO `gifts` (`id`, `name`, `code`) VALUES
(1, 'gift1', ''),
(2, 'gift2', '');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE IF NOT EXISTS `holidays` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `date` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `name`, `date`) VALUES
(1, 'PONGAL ', '2018-01-15'),
(2, 'PONGAL', '2018-01-16'),
(3, 'REPUBLIC DAY', '2018-01-26'),
(4, 'TAMIL NEW YEAR', '2018-04-14'),
(6, 'MAY DAY', '2018-05-01'),
(7, 'INDEPENDENCE DAY', '2018-08-15'),
(8, 'VINAYAGAR CHADURTHI', '2018-09-13'),
(9, 'GANDHI JAYANTHI', '2018-10-02'),
(10, 'POOJA FESTIVAL', '2018-10-18'),
(11, 'VIJAYA DHASAMI', '2018-10-19'),
(12, 'DIWALI', '2018-11-06'),
(13, 'CHRISTMAS', '2018-12-25');

-- --------------------------------------------------------

--
-- Table structure for table `issued_gifts`
--

CREATE TABLE IF NOT EXISTS `issued_gifts` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `gift_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `pgother_id` int(11) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `gift_id` (`gift_id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `plan_id` (`plan_id`),
  KEY `pgother_id` (`pgother_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `issued_gifts`
--

INSERT INTO `issued_gifts` (`id`, `gift_id`, `user_id`, `doctor_id`, `pgother_id`, `plan_id`, `count`, `dt`) VALUES
(8, 1, 2, 1, NULL, 106, 15, '2018-05-30 15:01:13'),
(9, 2, 2, 1, NULL, 106, 15, '2018-05-30 15:01:14'),
(10, 1, 2, 13, NULL, 152, 15, '2018-05-30 15:03:31'),
(12, 2, 2, NULL, 14, 154, 15, '2018-05-30 15:12:12'),
(13, 1, 2, 2, NULL, 107, 10, '2018-05-06 00:39:08'),
(14, 1, 2, 4, NULL, 105, 1, '2018-06-18 12:49:26');

-- --------------------------------------------------------

--
-- Table structure for table `issued_samples`
--

CREATE TABLE IF NOT EXISTS `issued_samples` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `pgother_id` int(11) DEFAULT NULL,
  `plan_id` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `product_id` (`product_id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`),
  KEY `plan_id` (`plan_id`),
  KEY `pgother_id` (`pgother_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Dumping data for table `issued_samples`
--

INSERT INTO `issued_samples` (`id`, `product_id`, `user_id`, `doctor_id`, `pgother_id`, `plan_id`, `count`, `dt`) VALUES
(9, 1, 2, 1, NULL, 106, 12, '2018-05-30 15:01:14'),
(10, 2, 2, 1, NULL, 106, 12, '2018-05-30 15:01:14'),
(11, 1, 2, 13, NULL, 152, 15, '2018-05-30 15:03:31'),
(13, 1, 2, NULL, 14, 154, 15, '2018-05-30 15:12:12'),
(16, 1, 2, 6, NULL, 115, 15, '2018-05-02 16:43:12'),
(17, 1, 2, 8, NULL, 203, 5, '2018-05-05 23:18:10'),
(18, 2, 2, 8, NULL, 203, 5, '2018-05-05 23:18:10'),
(19, 1, 2, 2, NULL, 107, 10, '2018-05-06 00:39:09'),
(20, 1, 2, 4, NULL, 105, 2, '2018-06-18 12:49:27');

-- --------------------------------------------------------

--
-- Table structure for table `leave_types`
--

CREATE TABLE IF NOT EXISTS `leave_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `leave_types`
--

INSERT INTO `leave_types` (`id`, `name`) VALUES
(1, 'Casual'),
(2, 'Sick'),
(3, 'Paternity'),
(4, 'Religious'),
(5, 'Marriage');

-- --------------------------------------------------------

--
-- Table structure for table `other_allowances`
--

CREATE TABLE IF NOT EXISTS `other_allowances` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `other_allowances`
--

INSERT INTO `other_allowances` (`id`, `name`) VALUES
(1, 'Hill Station Allowance'),
(2, 'FARE : SPM/Review Meet');

-- --------------------------------------------------------

--
-- Table structure for table `other_expenses`
--

CREATE TABLE IF NOT EXISTS `other_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `other_allowance_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `fare` int(11) NOT NULL,
  `voucher_no` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_id` (`expense_id`),
  KEY `other_allowance_id` (`other_allowance_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `pg_others`
--

CREATE TABLE IF NOT EXISTS `pg_others` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `speciality_id` int(11) DEFAULT NULL,
  `mobile` bigint(20) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `dob` date DEFAULT NULL,
  `dow` date DEFAULT NULL,
  `address` text NOT NULL,
  `clinic_name` varchar(255) NOT NULL,
  `door_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `doc_city_id` (`city_id`),
  KEY `doc_state_id` (`state_id`),
  KEY `doc_speciality_id` (`speciality_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `pg_others`
--

INSERT INTO `pg_others` (`id`, `code`, `user_id`, `name`, `speciality_id`, `mobile`, `phone`, `email`, `dob`, `dow`, `address`, `clinic_name`, `door_no`, `street`, `area`, `state_id`, `city_id`, `pincode`, `is_deleted`, `last_updated`, `dt`) VALUES
(1, 'DCTN00001', 1, 'mano', 1, 123456789, 1321313131, 'mano@gmail.com', '1970-01-01', '1970-01-01', 'address 1', 'Mano Clinic', '10', 'street', 'local area', 24, 1143, 123431, 0, '2017-11-26 09:19:00', '2017-11-26 09:19:00'),
(2, 'DCTN00002', 1, 'Mani', 1, 79879879, 0, 'mani@doctor.com', '1995-01-13', '2017-10-17', 'address2', '', '', '0', '0', 24, 1143, 654564, 0, '2017-11-26 09:23:00', '2017-11-26 09:23:00'),
(3, 'DCTN00003', 1, 'mahesh', 1, 1234567896, 0, '', NULL, NULL, 'address of mahesh', '', '', '0', '0', 24, 1143, 654564, 0, '2017-11-26 09:24:00', '2017-11-26 09:24:00'),
(4, 'DCTN00004', 1, 'Ramesh', 1, 1234567896, 0, '', NULL, NULL, 'address of mahesh', '', '', '0', '0', 24, 1143, 654564, 0, '2017-11-26 09:24:00', '2017-11-26 09:24:00'),
(6, 'DCTN00006', 1, 'Ramar', 1, 2147483647, 0, 'ramar@admin.com', '1970-01-01', '1970-01-01', '', '', '', '', '', 24, 1145, 111111, 0, '2018-01-18 06:30:49', '2018-01-18 06:30:49'),
(7, 'DCTN00007', 1, 'Ashok', 1, 2147483647, NULL, 'ashok@admin.com', '2000-01-12', '2018-02-06', '', 'Ashokan Clinic', '20', 'nortrh st', 'KK Nagar', 24, 1145, 624552, 0, '2018-02-07 06:50:02', '2018-02-07 06:50:02'),
(8, 'DCTN00008', 2, 'Priya', 2, 54654562, NULL, 'priya@admin.com', NULL, NULL, '', '', '', '', '', 24, 1143, NULL, 0, '2018-02-19 05:28:19', '2018-02-19 05:28:19'),
(9, 'DCTN00009', 2, 'Harini', 1, 2147483647, NULL, 'harini@admin.com', NULL, NULL, '', '', '', '', '', 24, 1145, NULL, 0, '2018-02-19 05:32:57', '2018-02-19 05:32:57'),
(10, 'DCTN00010', 2, 'haarini', 1, 89898998, NULL, 'haarini@admin.com', NULL, NULL, '', '', '', '', '', 24, 1143, NULL, 0, '2018-02-19 05:35:31', '2018-02-19 05:35:31'),
(11, 'DCTN00011', 2, 'Test', 1, 84848484, NULL, 'tet@admin.com', NULL, NULL, '', '', '', '', '', 24, 1143, NULL, 0, '2018-02-27 05:09:26', '2018-02-27 05:09:26'),
(12, '', 2, 'Smith', 1, 0, NULL, '', NULL, NULL, '', '', '', '', '', 24, 1143, NULL, 0, '2018-05-11 06:03:54', '2018-05-11 06:03:54'),
(13, '', 2, 'Sivaaumar', 2, 0, NULL, '', NULL, NULL, '', '', '', '', '', 24, 1145, NULL, 0, '2018-05-30 15:09:09', '2018-05-30 15:09:09'),
(14, '', 2, 'Sivaaumar', 2, 0, NULL, '', NULL, NULL, '', '', '', '', '', 24, 1145, NULL, 0, '2018-05-30 15:12:12', '2018-05-30 15:12:12'),
(15, '', 2, 'RAMASAMY', 1, 0, NULL, '', NULL, NULL, '', '', '', '', '', 24, 1143, NULL, 0, '2018-06-18 12:55:26', '2018-06-18 12:55:26');

-- --------------------------------------------------------

--
-- Table structure for table `plan_relations`
--

CREATE TABLE IF NOT EXISTS `plan_relations` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `plan_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `is_missed` int(11) NOT NULL,
  `is_unplanned` int(11) NOT NULL,
  `work_with` int(11) NOT NULL,
  `reason` text NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `plan_id` (`plan_id`),
  KEY `user_id` (`user_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `plan_relations`
--

INSERT INTO `plan_relations` (`id`, `plan_id`, `user_id`, `doctor_id`, `is_missed`, `is_unplanned`, `work_with`, `reason`, `dt`) VALUES
(1, 1, 2, 1, 0, 0, 0, '', '2018-01-27 10:32:32'),
(2, 1, 2, 2, 0, 0, 0, '', '2018-01-27 10:32:32');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=44 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `code`) VALUES
(1, 'MEXBACT', 'Mex'),
(2, 'MAXHOPE', 'Max'),
(4, 'WAVFIX O', 'Wvo'),
(5, 'WAVPOD', 'Wpd'),
(6, 'FALLNIL', 'Fnl'),
(7, 'WAVEFER', 'Wfr'),
(8, 'MIRACAL', 'Mcl'),
(9, 'HAPIWALK', 'Hwk'),
(10, 'WAVCOX', ''),
(11, 'WAVEDOL', ''),
(12, 'MEXDASE', ''),
(13, 'MEXFINAC', ''),
(14, 'WAVCORT', ''),
(15, 'LEMO', ''),
(16, 'WAVTUS', ''),
(17, 'KM SYRUP', ''),
(18, 'D2', ''),
(19, 'MEXROVA', ''),
(20, 'SAFSTAT', ''),
(21, 'SAFDIPINE', ''),
(22, 'WAVTEL', ''),
(23, 'WAVTEL H', ''),
(24, 'WAVTEL AM', ''),
(25, 'SAFGLIM', ''),
(26, 'SAFGLIM MF', ''),
(27, 'SAFGLIM VG', ''),
(28, 'MEXBOSE', ''),
(29, 'MEXBOSE MF', ''),
(30, 'WAVIT', ''),
(31, 'SAFNERV', ''),
(32, 'SAFNERV PG', ''),
(33, 'DUGALIN NTM', ''),
(34, 'ESOWAVE', ''),
(35, 'ESOWAVE D', ''),
(36, 'NAPCOX D', ''),
(37, 'WAVMOX CV', ''),
(38, 'BACTROZAP', ''),
(39, 'CYTOGABA AT', ''),
(40, 'CYTOGABA PLUS', ''),
(41, 'B DIET', ''),
(42, 'MEXARTH', ''),
(43, 'WAVTUS D', '');

-- --------------------------------------------------------

--
-- Table structure for table `qualifications`
--

CREATE TABLE IF NOT EXISTS `qualifications` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

--
-- Dumping data for table `qualifications`
--

INSERT INTO `qualifications` (`id`, `name`) VALUES
(1, 'MBBS'),
(2, 'BDS'),
(3, 'MD'),
(4, 'MS'),
(5, 'MS(Ortho)'),
(6, 'DM(Neuro)'),
(7, 'DNB'),
(8, 'D DIAB'),
(9, 'DGO'),
(10, 'DCH'),
(11, 'D Ortho'),
(12, 'DTCD'),
(13, 'DA'),
(14, 'DPM'),
(15, 'DLO'),
(17, 'MS(ENT)'),
(18, 'MS(O&G)'),
(19, 'DM(Gastro)'),
(20, 'D Cardio'),
(21, 'DM(Cardio)'),
(22, 'DM(Nephro)'),
(23, 'DM(Rheum)'),
(24, 'DM(Onco)'),
(25, 'M.Ch(Neuro)'),
(26, 'M.Ch(Gastro)'),
(27, 'M.Ch(Uro)'),
(28, 'M.Ch(Plastic)'),
(29, 'M.Ch(Ortho)'),
(30, 'M.Ch(Onco)'),
(31, 'M.Ch(Cardio)');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `code` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `code`) VALUES
(1, 'Super Admin', 'SA'),
(2, 'Zonal Manager', 'ZM'),
(3, 'Regional Manager', 'RM'),
(4, 'Area Manager', 'AR'),
(5, 'Medical Rep', 'MR');

-- --------------------------------------------------------

--
-- Table structure for table `specialities`
--

CREATE TABLE IF NOT EXISTS `specialities` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Dumping data for table `specialities`
--

INSERT INTO `specialities` (`id`, `name`, `code`) VALUES
(1, 'NEUROLOGIST', 'NEUP'),
(2, 'CARDIOLOGIST', 'CARDIO'),
(3, 'ORTHOPAEDICIAN', 'ORTHO'),
(4, 'CONSULTANT PHYSICIAN', 'CP'),
(5, 'DIABETOLOGIST', 'DIAB'),
(6, 'GENERAL PRACTIONER', 'GP'),
(7, 'NEURO SURGEON', 'NEUS'),
(8, 'GENERAL SURGEON', 'SUR'),
(9, 'PAEDIATRICIAN', 'PAED'),
(10, 'GYNAECOLOGIST', 'GYN'),
(11, 'DENTIST', 'DENT'),
(12, 'GASTROENRTOLOGIST', 'GASTRO'),
(13, 'NEPHROLOGIST', 'NEPH'),
(14, 'RHEUMATALOGIST', 'RHEU'),
(15, 'ONCOLOGIST', 'ONCO'),
(16, 'UROLOGIST', 'URO'),
(17, 'DERMATALOGIST', 'DERM'),
(18, 'PULMONOLOGIST', 'PULM'),
(19, 'ENT', 'ENT'),
(20, 'PSYCHIATRIST', 'PSY'),
(22, 'GASTRO SURGEON', 'GASTS');

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE IF NOT EXISTS `states` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `state_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=37 ;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `name`, `state_code`) VALUES
(1, 'Andhra Pradesh', 'AP'),
(2, 'Arunachal Pradesh', 'AR'),
(3, 'Assam', 'AS'),
(4, 'Bihar', 'BR'),
(5, 'Chhattisgarh', 'CG'),
(6, 'Goa', 'GA'),
(7, 'Gujarat', 'GJ'),
(8, 'Haryana', 'HR'),
(9, 'Himachal Pradesh', 'HP'),
(10, 'Jammu and Kashmir', 'JK'),
(11, 'Jharkhand', 'JH'),
(12, 'Karnataka', 'KA'),
(13, 'Kerala', 'KL'),
(14, 'Madhya Pradesh', 'MP'),
(15, 'Maharashtra', 'MH'),
(16, 'Manipur', 'MN'),
(17, 'Meghalaya', 'ML'),
(18, 'Mizoram', 'MZ'),
(19, 'Nagaland', 'NL'),
(20, 'Orissa', 'OR'),
(21, 'Punjab', 'PB'),
(22, 'Rajasthan', 'RJ'),
(23, 'Sikkim', 'SK'),
(24, 'Tamil Nadu', 'TN'),
(25, 'Tripura', 'TR'),
(26, 'Uttarakhand', 'UK'),
(27, 'Uttar Pradesh', 'UP'),
(28, 'West Bengal', 'WB'),
(29, 'Andaman and Nicobar Islands', 'AN'),
(30, 'Chandigarh', 'CH'),
(31, 'Dadra and Nagar Haveli', 'DH'),
(32, 'Daman and Diu', 'DD'),
(33, 'Delhi', 'DL'),
(34, 'Lakshadweep', 'LD'),
(35, 'Pondicherry', 'PY'),
(36, 'Telangana', 'TS');

-- --------------------------------------------------------

--
-- Table structure for table `stockists`
--

CREATE TABLE IF NOT EXISTS `stockists` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(225) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `contact_person` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `phone` bigint(20) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `address` text NOT NULL,
  `door_no` varchar(255) NOT NULL,
  `street` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `state_id` int(11) DEFAULT NULL,
  `city_id` int(11) DEFAULT NULL,
  `pincode` int(11) DEFAULT NULL,
  `dl_no` varchar(100) NOT NULL,
  `gst_no` varchar(100) NOT NULL,
  `bank_name` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `ifsc` varchar(20) NOT NULL,
  `account_holder` varchar(150) NOT NULL,
  `account_no` bigint(20) DEFAULT NULL,
  `account_type` varchar(50) NOT NULL,
  `is_approved` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_updated` datetime NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `ch_city_id` (`city_id`),
  KEY `ch_state_id` (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `stockists`
--

INSERT INTO `stockists` (`id`, `code`, `user_id`, `name`, `owner`, `contact_person`, `mobile`, `phone`, `email`, `address`, `door_no`, `street`, `area`, `state_id`, `city_id`, `pincode`, `dl_no`, `gst_no`, `bank_name`, `branch`, `ifsc`, `account_holder`, `account_no`, `account_type`, `is_approved`, `is_active`, `is_deleted`, `last_updated`, `dt`) VALUES
(1, 'STTN00001', 1, 'Rajan', 'Owner', 'rajan', 12345, 123546987, 'rajan@admin.com', 'address', '', '', 'local area', 24, 1143, 123123, '424242', '42342342', 'SBI', 'Madurai', 'IFSC00021', 'Rajan', 2147483647, 'current', 1, 1, 0, '0000-00-00 00:00:00', '2017-12-05 23:10:41'),
(2, 'STTN00002', 1, 'Prem', '', 'Raj', 12345, 123546987, 'prem@admin.com', 'address', '', '', '', 24, 1143, 123123, '', '', '', '', '', '', NULL, '', 1, 1, 0, '0000-00-00 00:00:00', '2017-12-05 23:10:41'),
(3, 'STTN00003', 1, 'Parama', '', 'paraman', 1234567896, NULL, 'paraaman@admin.com', '', '', '', '', 24, 1145, 123123, '', '', '', '', '', '', NULL, '', 1, 1, 0, '0000-00-00 00:00:00', '2018-02-06 04:07:54');

-- --------------------------------------------------------

--
-- Table structure for table `travel_expenses`
--

CREATE TABLE IF NOT EXISTS `travel_expenses` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `expense_id` int(11) NOT NULL,
  `work_type_id` int(11) NOT NULL,
  `city_from` int(11) NOT NULL,
  `city_to` int(11) NOT NULL,
  `km` int(11) NOT NULL,
  `fare` int(11) NOT NULL,
  `travel_mode` varchar(50) NOT NULL,
  `started` time NOT NULL,
  `reached` time NOT NULL,
  PRIMARY KEY (`id`),
  KEY `expense_id` (`expense_id`),
  KEY `city_from` (`city_from`),
  KEY `city_to` (`city_to`),
  KEY `work_type_id` (`work_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(25) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `reset_password_token` varchar(255) NOT NULL,
  `token_created_at` datetime DEFAULT NULL,
  `status` int(15) NOT NULL,
  `role_id` int(15) NOT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `state_id` int(11) NOT NULL,
  `city_id` int(11) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `qualification` varchar(225) DEFAULT NULL,
  `is_approved` int(11) NOT NULL,
  `is_active` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_logon` datetime NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `username` (`username`),
  KEY `role` (`role_id`),
  KEY `users_states_id` (`state_id`),
  KEY `users_city_id` (`city_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `code`, `username`, `email`, `password`, `reset_password_token`, `token_created_at`, `status`, `role_id`, `lead_id`, `firstname`, `lastname`, `state_id`, `city_id`, `avatar`, `gender`, `qualification`, `is_approved`, `is_active`, `is_deleted`, `last_logon`, `dt`) VALUES
(1, 'MWPTN00001', 'admin', 'admin@admin.com', '$2y$10$MGYDUYCIJZujzJaCaIFbR.4GcFHQPOSGDSm8u622x4um.LSF3rBc2', '', NULL, 1, 1, NULL, 'maxicanwave', 'Pharma', 24, 1143, '', '1', '', 1, 1, 0, '0000-00-00 00:00:00', '2017-11-18 21:34:37'),
(2, 'MWPTN00002', 'MUTHAIAH', 'smuthaiah@mexicanwavepharma.com', '$2y$10$MGYDUYCIJZujzJaCaIFbR.4GcFHQPOSGDSm8u622x4um.LSF3rBc2', '', NULL, 1, 5, 8, 'MUTHAIAH', 'S', 24, 1145, '', '1', 'BA', 1, 1, 0, '0000-00-00 00:00:00', '2017-11-18 21:34:37'),
(3, 'MWPTN00003', 'karthi', 'karthi@admin.com', '$2y$10$27GWiSr0GUZWVj/ACkb3vekz1oYUqDnxbLrHDye8WmBXSaii3R7xW', '', NULL, 1, 5, 8, 'Ktm', '', 24, 1143, '', '1', '', 1, 1, 1, '0000-00-00 00:00:00', '2017-11-18 21:34:37'),
(4, 'MWPTN00004', 'krtgtm', 'krtgtm@admin.com', '$2y$10$08IG9Z.ubxA/fl3YMfQZ7uV3eyClit8OILUaWANKI6xELeiqadof2', '', NULL, 0, 5, 8, 'krt', 'gtm', 24, 1143, '', '1', '', 1, 1, 1, '0000-00-00 00:00:00', '2018-01-09 06:21:12'),
(5, 'MWPTN00005', 'SETHUPATHI', 'csethupathi@mexicanwavepharma.com', '$2y$10$MGYDUYCIJZujzJaCaIFbR.4GcFHQPOSGDSm8u622x4um.LSF3rBc2', '', NULL, 0, 5, 8, 'SETHUPATHI', 'C', 24, 1150, '', '1', 'DME', 1, 1, 0, '0000-00-00 00:00:00', '2018-02-07 06:45:12'),
(6, 'MWPTN00006', 'zm', 'ramesh@admin.com', '$2y$10$08IG9Z.ubxA/fl3YMfQZ7uV3eyClit8OILUaWANKI6xELeiqadof2', '', NULL, 0, 2, 1, 'Ramesh', 'G', 24, 1143, '', '1', '', 1, 1, 0, '0000-00-00 00:00:00', '2018-01-09 06:21:12'),
(7, 'MWPTN00007', 'rm', 'johny@admin.com', '$2y$10$08IG9Z.ubxA/fl3YMfQZ7uV3eyClit8OILUaWANKI6xELeiqadof2', '', NULL, 0, 3, 6, 'Johny', 'G', 24, 1143, '', '1', '', 1, 1, 0, '0000-00-00 00:00:00', '2018-01-09 06:21:12'),
(8, 'MWPTN00008', 'am', 'prem@admin.com', '$2y$10$08IG9Z.ubxA/fl3YMfQZ7uV3eyClit8OILUaWANKI6xELeiqadof2', '', NULL, 0, 4, 7, 'Prem', 'G', 24, 1143, '', '1', '', 1, 1, 0, '0000-00-00 00:00:00', '2018-01-09 06:21:12'),
(9, 'MWPTN00009', 'mr1', 'mr1@admin.com', '$2y$10$wrZ8IAVuG9HeoC6oGwa3o.hDaa2hCWqvKf7hglC0OuNbgTE/0jWIy', '', NULL, 0, 5, 8, 'MR!', 'test', 24, 1143, '', '1', 'MBA', 1, 1, 1, '0000-00-00 00:00:00', '2018-02-27 04:29:51'),
(10, 'MWPTN00010', 'mr2', 'mr2@admin.com', '$2y$10$yylQ2jwNe90eT8KkSG/ssuAeP2Lw18erMg.FMJbzdDJRaLHFkoXhS', '', NULL, 0, 5, 8, 'MR2', 'Test', 24, 1145, '', '1', 'MBA', 1, 1, 1, '0000-00-00 00:00:00', '2018-02-27 04:35:50'),
(11, 'MWPTN00011', 'USMAN', 'mdusman@mexicanwavepharma.com', '$2y$10$MGYDUYCIJZujzJaCaIFbR.4GcFHQPOSGDSm8u622x4um.LSF3rBc2', '', NULL, 0, 5, 8, 'MOHAMED', 'USMAN', 24, 1471, '', '1', 'BSC', 1, 1, 0, '0000-00-00 00:00:00', '2018-06-18 13:11:18'),
(12, 'MWPTN00012', 'SENTHIL', 'ksenthilkumar@mexicanwavepharma.com', '$2y$10$bGzgzniog.4e1cV9SxU/ZOGOSbvzJetRPSB3l4giZZMIDQjLJXCgu', '', NULL, 0, 3, 6, 'SENTHIL ', 'KUMAR K', 24, 1145, '', '1', 'MBA', 1, 1, 0, '0000-00-00 00:00:00', '2018-06-18 14:18:51');

-- --------------------------------------------------------

--
-- Table structure for table `work_plans`
--

CREATE TABLE IF NOT EXISTS `work_plans` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `work_type_id` int(11) DEFAULT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `city_id` int(11) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `chemist_id` int(11) DEFAULT NULL,
  `stockist_id` int(11) DEFAULT NULL,
  `pgother_id` int(11) DEFAULT NULL,
  `plan_reason` int(11) DEFAULT NULL,
  `plan_details` text NOT NULL,
  `plan_time` varchar(15) DEFAULT NULL,
  `work_with` varchar(50) DEFAULT NULL,
  `products` text NOT NULL,
  `samples` text NOT NULL,
  `gifts` text NOT NULL,
  `discussion` varchar(255) DEFAULT NULL,
  `visit_time` varchar(5) DEFAULT NULL,
  `business` int(11) DEFAULT NULL,
  `missed_reason` varchar(255) NOT NULL,
  `is_missed` int(11) NOT NULL,
  `is_planned` int(11) NOT NULL,
  `is_unplanned` int(11) NOT NULL,
  `is_approved` int(11) NOT NULL,
  `is_reported` int(11) NOT NULL,
  `is_submitted` int(11) NOT NULL,
  `is_expired` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `last_updated` datetime DEFAULT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `work_type_id` (`work_type_id`),
  KEY `work_city_id` (`city_id`),
  KEY `work_user_id` (`user_id`),
  KEY `plan_reason` (`plan_reason`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=227 ;

--
-- Dumping data for table `work_plans`
--

INSERT INTO `work_plans` (`id`, `user_id`, `work_type_id`, `start_date`, `end_date`, `city_id`, `doctor_id`, `chemist_id`, `stockist_id`, `pgother_id`, `plan_reason`, `plan_details`, `plan_time`, `work_with`, `products`, `samples`, `gifts`, `discussion`, `visit_time`, `business`, `missed_reason`, `is_missed`, `is_planned`, `is_unplanned`, `is_approved`, `is_reported`, `is_submitted`, `is_expired`, `is_deleted`, `last_updated`, `dt`) VALUES
(1, 2, 2, '2018-02-01 00:00:00', '2018-02-01 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-01-27 10:32:31'),
(2, 2, 3, '2018-02-02 00:00:00', '2018-02-02 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 10:33:03'),
(3, 2, 4, '2018-02-03 00:00:00', '2018-02-03 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 10:33:09'),
(4, 2, 5, '2018-02-04 00:00:00', '2018-02-04 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 10:33:14'),
(5, 2, 6, '2018-02-05 00:00:00', '2018-02-05 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 10:33:19'),
(7, 2, 1, '2018-02-06 00:00:00', '2018-02-06 23:59:00', 1143, NULL, NULL, NULL, NULL, 1, 'casual', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 10:33:40'),
(9, 2, 2, '2018-02-10 00:00:00', '2018-02-10 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:29:21'),
(10, 2, 2, '2018-02-10 00:00:00', '2018-02-10 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:29:21'),
(11, 2, 2, '2018-02-10 00:00:00', '2018-02-10 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:30:50'),
(12, 2, 2, '2018-02-10 00:00:00', '2018-02-10 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:30:50'),
(13, 2, 2, '2018-02-11 00:00:00', '2018-02-11 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:39:48'),
(14, 2, 2, '2018-02-11 00:00:00', '2018-02-11 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:39:48'),
(15, 2, 2, '2018-02-11 00:00:00', '2018-02-11 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:39:48'),
(16, 2, 2, '2018-02-12 00:00:00', '2018-02-12 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:40:56'),
(17, 2, 2, '2018-02-12 00:00:00', '2018-02-12 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:40:56'),
(18, 2, 2, '2018-02-12 00:00:00', '2018-02-12 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:40:56'),
(19, 2, 2, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:1;s:5:"1 box";i:3;s:5:"2 box";}', '', '', 'ewr wrew w', '14.30', 500, '', 0, 1, 0, 1, 1, 0, 0, 0, '2018-02-19 04:43:21', '2018-01-27 11:41:29'),
(20, 2, 2, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:41:29'),
(21, 2, 2, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:41:29'),
(22, 2, 2, '2018-02-14 00:00:00', '2018-02-14 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:53:13'),
(23, 2, 2, '2018-02-14 00:00:00', '2018-02-14 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:53:13'),
(24, 2, 2, '2018-02-15 00:00:00', '2018-02-15 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:55:39'),
(25, 2, 2, '2018-02-15 00:00:00', '2018-02-15 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 11:55:39'),
(26, 2, 2, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', '', '', NULL, 'Doctor on Leave', 1, 1, 0, 1, 1, 0, 0, 0, '2018-02-15 06:15:00', '2018-01-27 11:55:48'),
(27, 2, 2, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 1, 0, 0, 0, '2018-02-15 06:13:04', '2018-01-27 11:55:48'),
(28, 2, 2, '2018-02-17 00:00:00', '2018-02-17 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:21:52'),
(29, 2, 2, '2018-02-17 00:00:00', '2018-02-17 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:21:52'),
(30, 2, 2, '2018-02-18 00:00:00', '2018-02-18 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:22:28'),
(31, 2, 2, '2018-02-19 00:00:00', '2018-02-19 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:26:07'),
(32, 2, 7, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, '2018-02-05 06:10:47', '2018-01-27 12:26:29'),
(33, 2, 3, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 1, 1, 0, 1, 1, 0, 0, 0, '2018-02-15 06:33:14', '2018-01-27 12:26:31'),
(34, 2, 6, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 1, 0, 0, 0, '2018-02-20 06:30:04', '2018-01-27 12:26:38'),
(35, 2, 4, '2018-02-21 00:00:00', '2018-02-21 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:28:12'),
(36, 2, 5, '2018-02-22 00:00:00', '2018-02-22 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:29:00'),
(37, 2, 6, '2018-02-23 00:00:00', '2018-02-23 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:40:34'),
(38, 2, 6, '2018-02-23 00:00:00', '2018-02-23 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:40:51'),
(39, 2, 5, '2018-02-24 00:00:00', '2018-02-24 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:41:20'),
(40, 2, 7, '2018-02-25 00:00:00', '2018-02-25 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:42:04'),
(41, 2, 2, '2018-02-26 00:00:00', '2018-02-26 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:42:19'),
(42, 2, 2, '2018-02-26 00:00:00', '2018-02-26 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-01-27 12:42:19'),
(43, 2, 2, '2018-03-05 00:00:00', '2018-03-05 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-01 18:10:21'),
(44, 2, 2, '2018-03-05 00:00:00', '2018-03-05 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-01 18:10:21'),
(45, 2, 2, '2018-03-05 00:00:00', '2018-03-05 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-01 18:10:21'),
(46, 2, 1, '2018-03-03 00:00:00', '2018-03-03 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'sad', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 14:43:03'),
(47, 2, 7, '2018-03-01 00:00:00', '2018-03-01 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:45:26'),
(48, 2, 5, '2018-03-06 00:00:00', '2018-03-06 23:59:00', 1143, NULL, NULL, NULL, NULL, 1, 'asa', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:46:50'),
(49, 2, 1, '2018-03-07 00:00:00', '2018-03-07 23:59:00', 1143, NULL, NULL, NULL, NULL, 1, 'asa', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:46:51'),
(50, 2, 1, '2018-03-08 00:00:00', '2018-03-08 23:59:00', 1143, NULL, NULL, NULL, NULL, 1, 'asa', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:46:51'),
(52, 2, 1, '2018-03-12 00:00:00', '2018-03-12 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'sd', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:50:58'),
(53, 2, 1, '2018-03-13 00:00:00', '2018-03-13 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'sd', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:50:58'),
(54, 2, 1, '2018-03-15 00:00:00', '2018-03-15 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'sd', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:50:58'),
(55, 2, 2, '2018-03-09 00:00:00', '2018-03-09 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:51:22'),
(56, 2, 2, '2018-03-09 00:00:00', '2018-03-09 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:51:22'),
(57, 2, 2, '2018-03-09 00:00:00', '2018-03-09 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-02 17:51:22'),
(58, 2, 4, '2018-03-02 00:00:00', '2018-03-02 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-05 17:34:55'),
(61, 2, NULL, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, NULL, NULL, 1, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-05 17:57:04', '2018-02-05 17:57:04'),
(62, 2, NULL, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, NULL, NULL, 2, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-05 17:57:04', '2018-02-05 17:57:04'),
(63, 2, NULL, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, NULL, 1, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-05 17:59:33', '2018-02-05 17:59:33'),
(64, 2, NULL, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, NULL, 2, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-05 17:59:33', '2018-02-05 17:59:33'),
(65, 2, NULL, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, 1, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-06 03:41:42', '2018-02-06 03:41:42'),
(66, 2, NULL, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, NULL, 2, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-06 03:41:42', '2018-02-06 03:41:42'),
(67, 2, 2, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-02-06 03:49:56', '2018-02-06 03:49:56'),
(68, 2, 2, '2018-02-20 00:00:00', '2018-02-20 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-02-06 03:49:56', '2018-02-06 03:49:56'),
(69, 2, NULL, '2018-02-14 00:00:00', '2018-02-14 23:59:00', 1143, NULL, NULL, 1, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-06 05:38:17', '2018-02-06 05:38:18'),
(70, 2, 2, '2018-03-10 00:00:00', '2018-03-10 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-07 06:55:06'),
(71, 2, 2, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-02-16 05:28:05', '2018-02-16 05:28:05'),
(72, 2, NULL, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, 8, NULL, NULL, NULL, NULL, '', NULL, 'BM-ZBM', '', '', '', '', '', NULL, '', 0, 0, 0, 1, 1, 0, 0, 0, '2018-02-19 05:28:20', '2018-02-19 05:28:20'),
(73, 2, NULL, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1145, 9, NULL, NULL, NULL, NULL, '', NULL, 'HO', 'a:3:{i:1;s:5:"asdfa";i:3;N;i:5;N;}', '', '', '', '', NULL, '', 0, 0, 0, 1, 1, 0, 0, 0, '2018-02-19 05:32:57', '2018-02-19 05:32:58'),
(74, 2, NULL, '2018-02-13 00:00:00', '2018-02-13 23:59:00', 1143, 10, NULL, NULL, NULL, NULL, '', NULL, 'BM', 'a:3:{i:1;s:5:"1 box";i:3;s:5:"2 box";i:5;s:5:"1 box";}', '', '', '', '', NULL, '', 0, 0, 0, 1, 1, 0, 0, 0, '2018-02-19 05:35:32', '2018-02-19 05:35:32'),
(75, 2, 2, '2018-02-19 00:00:00', '2018-02-19 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:2;s:5:"1 box";i:4;s:5:"1 box";}', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-02-20 06:46:39', '2018-02-20 06:46:39'),
(76, 9, 2, '2018-03-01 00:00:00', '2018-03-01 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:37:09'),
(77, 9, 2, '2018-03-02 00:00:00', '2018-03-02 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:37:15'),
(78, 9, 6, '2018-03-05 00:00:00', '2018-03-05 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:37:21'),
(79, 9, 7, '2018-03-06 00:00:00', '2018-03-06 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:39:39'),
(80, 9, 2, '2018-03-07 00:00:00', '2018-03-07 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:39:45'),
(81, 9, 2, '2018-03-07 00:00:00', '2018-03-07 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:39:46'),
(82, 9, 1, '2018-03-08 00:00:00', '2018-03-08 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'asdf  asf s', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:19'),
(83, 9, 1, '2018-03-09 00:00:00', '2018-03-09 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'asdf  asf s', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:20'),
(84, 9, 8, '2018-03-10 00:00:00', '2018-03-10 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, 'sdfsfs', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:30'),
(85, 9, 2, '2018-03-11 00:00:00', '2018-03-11 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:43'),
(86, 9, 2, '2018-03-11 00:00:00', '2018-03-11 23:59:00', 1145, 7, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:43'),
(87, 9, 2, '2018-03-12 00:00:00', '2018-03-12 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:53'),
(88, 9, 2, '2018-03-12 00:00:00', '2018-03-12 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:53'),
(89, 9, 6, '2018-03-15 00:00:00', '2018-03-15 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:49:59'),
(90, 9, 5, '2018-03-16 00:00:00', '2018-03-16 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:04'),
(91, 9, 2, '2018-03-17 00:00:00', '2018-03-17 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:18'),
(92, 9, 2, '2018-03-18 00:00:00', '2018-03-18 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:27'),
(93, 9, 7, '2018-03-19 00:00:00', '2018-03-19 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:34'),
(94, 9, 3, '2018-03-21 00:00:00', '2018-03-21 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:41'),
(95, 9, 2, '2018-03-22 00:00:00', '2018-03-22 23:59:00', 1145, 7, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:50'),
(96, 9, 2, '2018-03-23 00:00:00', '2018-03-23 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', '', NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-02-27 04:50:59'),
(97, 2, 2, '2018-02-01 00:00:00', '2018-02-01 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-02-27 05:07:39', '2018-02-27 05:07:39'),
(98, 2, NULL, '2018-02-01 00:00:00', '2018-02-01 23:59:00', 1143, NULL, 1, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-27 05:08:28', '2018-02-27 05:08:28'),
(99, 2, NULL, '2018-02-01 00:00:00', '2018-02-01 23:59:00', 1145, NULL, NULL, 3, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-27 05:08:42', '2018-02-27 05:08:42'),
(100, 2, NULL, '2018-02-01 00:00:00', '2018-02-01 23:59:00', 1143, 11, NULL, NULL, NULL, NULL, '', NULL, 'ZM', 'a:1:{i:3;s:4:"assd";}', '', '', 'ads d sd asd s', '14.30', 500, '', 0, 0, 0, 1, 1, 0, 0, 0, '2018-02-27 05:09:27', '2018-02-27 05:09:27'),
(101, 2, 3, '2018-02-01 00:00:00', '2018-02-01 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-27 05:20:06', '2018-02-27 05:20:06'),
(102, 2, 1, '2018-02-06 00:00:00', '2018-02-06 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'test leave', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-27 05:33:20', '2018-02-27 05:33:20'),
(103, 2, 1, '2018-02-06 00:00:00', '2018-02-06 23:59:00', 1143, NULL, NULL, NULL, NULL, 2, 'test leave', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-02-27 05:33:30', '2018-02-27 05:33:30'),
(104, 2, 3, '2018-06-10 00:00:00', '2018-06-10 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-05 04:19:01', '2018-06-05 04:19:01'),
(105, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:0;s:1:"4";i:1;s:1:"5";}', 'a:1:{i:1;s:1:"2";}', 'a:1:{i:1;s:1:"1";}', '', '12:00', 1, 'Doctor not in Station', 0, 1, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-07 10:20:20'),
(106, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:2:{i:1;s:2:"12";i:2;s:2:"12";}', 'a:2:{i:1;s:2:"15";i:2;s:2:"15";}', '', '21:30', 1, '', 0, 1, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-07 10:20:20'),
(107, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:1:{i:1;s:2:"10";}', 'a:1:{i:1;s:2:"10";}', '', '90:30', 1, '', 0, 1, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-07 10:20:20'),
(108, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, 'Others', 1, 1, 0, 1, 1, 0, 0, 0, '2018-06-18 12:56:50', '2018-06-07 10:20:20'),
(109, 2, 2, '2018-06-03 00:00:00', '2018-06-03 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:20:28'),
(110, 2, 2, '2018-06-03 00:00:00', '2018-06-03 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:20:28'),
(111, 2, 2, '2018-06-03 00:00:00', '2018-06-03 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:20:29'),
(112, 2, 2, '2018-06-03 00:00:00', '2018-06-03 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:20:29'),
(113, 2, 2, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:20:43'),
(114, 2, 3, '2018-06-04 00:00:00', '2018-06-04 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 1, 1, 0, 0, '2018-06-07 04:31:20', '2018-06-07 10:20:49'),
(115, 2, 2, '2018-06-05 00:00:00', '2018-06-05 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, '', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:1:{i:1;s:2:"15";}', '', '', '', NULL, '', 0, 1, 0, 1, 1, 0, 0, 0, '2018-06-02 16:43:11', '2018-06-07 10:21:03'),
(116, 2, 2, '2018-06-05 00:00:00', '2018-06-05 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:12'),
(117, 2, 2, '2018-06-05 00:00:00', '2018-06-05 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:12'),
(118, 2, 2, '2018-06-05 00:00:00', '2018-06-05 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:12'),
(119, 2, 7, '2018-06-06 00:00:00', '2018-06-06 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 1, 0, 0, 0, '2018-06-08 04:29:31', '2018-06-07 10:21:23'),
(120, 2, 7, '2018-06-07 00:00:00', '2018-06-07 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:28'),
(121, 2, 2, '2018-06-08 00:00:00', '2018-06-08 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:34'),
(122, 2, 2, '2018-06-08 00:00:00', '2018-06-08 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:34'),
(123, 2, 2, '2018-06-08 00:00:00', '2018-06-08 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:34'),
(124, 2, 2, '2018-06-08 00:00:00', '2018-06-08 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:34'),
(125, 2, 2, '2018-06-09 00:00:00', '2018-06-09 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:42'),
(126, 2, 2, '2018-06-09 00:00:00', '2018-06-09 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:42'),
(127, 2, 2, '2018-06-10 00:00:00', '2018-06-10 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:52'),
(128, 2, 2, '2018-06-10 00:00:00', '2018-06-10 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:21:52'),
(129, 2, 2, '2018-06-11 00:00:00', '2018-06-11 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:03'),
(130, 2, 2, '2018-06-11 00:00:00', '2018-06-11 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:03'),
(131, 2, 2, '2018-06-12 00:00:00', '2018-06-12 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, '2018-06-20 04:41:33', '2018-06-07 10:22:11'),
(132, 2, 2, '2018-06-12 00:00:00', '2018-06-12 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:11'),
(133, 2, 2, '2018-06-12 00:00:00', '2018-06-12 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:11'),
(134, 2, 2, '2018-06-12 00:00:00', '2018-06-12 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, 'Doctor Refused Appointment', 1, 1, 0, 1, 1, 0, 0, 0, '2018-06-20 04:42:21', '2018-06-07 10:22:11'),
(135, 2, 2, '2018-06-13 00:00:00', '2018-06-13 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:18'),
(136, 2, 2, '2018-06-13 00:00:00', '2018-06-13 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:18'),
(137, 2, 2, '2018-06-13 00:00:00', '2018-06-13 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:18'),
(138, 2, 2, '2018-06-14 00:00:00', '2018-06-14 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:25'),
(139, 2, 2, '2018-06-14 00:00:00', '2018-06-14 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:25'),
(140, 2, 2, '2018-06-15 00:00:00', '2018-06-15 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:34'),
(141, 2, 2, '2018-06-15 00:00:00', '2018-06-15 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-07 10:22:34'),
(143, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, NULL, NULL, 12, NULL, '', NULL, 'Alone', '', '', '', 'discussion', '20:0', 1, '', 0, 0, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-11 06:00:57'),
(144, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, NULL, NULL, 12, NULL, '', NULL, 'Alone', '', '', '', 'discussion', '20:0', 2, '', 0, 0, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-11 06:03:54'),
(146, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1145, NULL, NULL, 3, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-24 03:58:09'),
(152, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1145, 13, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:1:{i:1;s:2:"15";}', 'a:1:{i:1;s:2:"15";}', '', '10:00', 1, '', 0, 0, 1, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-30 15:03:31'),
(154, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1145, NULL, NULL, NULL, 14, NULL, '', NULL, 'Alone', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:1:{i:1;s:2:"15";}', 'a:1:{i:2;s:2:"15";}', '', '12:00', 1, '', 0, 0, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-30 15:12:12'),
(155, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, 2, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-30 15:13:53'),
(156, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, NULL, 1, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-30 15:19:42'),
(157, 2, 2, '2018-06-04 00:00:00', '2018-06-04 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', NULL, '12', 120, '', 0, 1, 0, 1, 1, 1, 0, 0, '2018-06-07 04:31:20', '2018-06-30 17:02:48'),
(158, 2, 3, '2018-07-10 00:00:00', '2018-07-10 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 0, 0, 0, 0, '2018-07-05 04:19:01', '2018-07-05 04:19:01'),
(159, 2, 2, '2018-07-01 00:00:00', '2018-07-01 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, 'Doctor not in Station', 0, 1, 0, 0, 0, 0, 0, 0, '2018-07-24 04:24:56', '2018-07-07 10:20:20'),
(160, 2, 2, '2018-07-01 00:00:00', '2018-07-01 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:2:{i:1;s:2:"12";i:2;s:2:"12";}', 'a:2:{i:1;s:2:"15";i:2;s:2:"15";}', '', '2', 2, '', 0, 1, 0, 0, 0, 0, 0, 0, '2018-07-30 15:01:13', '2018-07-07 10:20:20'),
(161, 2, 2, '2018-07-01 00:00:00', '2018-07-01 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', 'a:2:{i:0;s:1:"1";i:1;s:1:"2";}', 'a:2:{i:1;s:1:"1";i:2;s:1:"1";}', 'a:2:{i:1;s:1:"1";i:2;s:2:"12";}', '', '2.5', 1000, '', 0, 1, 0, 0, 0, 0, 0, 0, '2018-07-30 15:08:23', '2018-07-07 10:20:20'),
(162, 2, 2, '2018-07-01 00:00:00', '2018-07-01 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', '', NULL, NULL, 'Doctor on Leave', 0, 0, 0, 0, 0, 0, 0, 0, '2018-07-30 17:02:48', '2018-07-07 10:20:20'),
(163, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:20:28'),
(164, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:20:28'),
(165, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:20:29'),
(166, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:20:29'),
(167, 2, 2, '2018-07-02 00:00:00', '2018-07-02 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:20:43'),
(168, 2, 3, '2018-07-04 00:00:00', '2018-07-04 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, '2018-07-08 17:28:13', '2018-07-07 10:20:49'),
(169, 2, 2, '2018-07-05 00:00:00', '2018-07-05 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:03'),
(170, 2, 2, '2018-07-05 00:00:00', '2018-07-05 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:12'),
(171, 2, 2, '2018-07-05 00:00:00', '2018-07-05 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:12'),
(172, 2, 2, '2018-07-05 00:00:00', '2018-07-05 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:12'),
(175, 2, 2, '2018-07-08 00:00:00', '2018-07-08 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:34'),
(176, 2, 2, '2018-07-08 00:00:00', '2018-07-08 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:34'),
(177, 2, 2, '2018-07-08 00:00:00', '2018-07-08 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:34'),
(178, 2, 2, '2018-07-08 00:00:00', '2018-07-08 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:34'),
(179, 2, 2, '2018-07-09 00:00:00', '2018-07-09 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:42'),
(180, 2, 2, '2018-07-09 00:00:00', '2018-07-09 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:42'),
(181, 2, 2, '2018-07-10 00:00:00', '2018-07-10 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:52'),
(182, 2, 2, '2018-07-10 00:00:00', '2018-07-10 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:21:52'),
(183, 2, 2, '2018-07-11 00:00:00', '2018-07-11 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:03'),
(184, 2, 2, '2018-07-11 00:00:00', '2018-07-11 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:03'),
(185, 2, 2, '2018-07-12 00:00:00', '2018-07-12 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:11'),
(186, 2, 2, '2018-07-12 00:00:00', '2018-07-12 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:11'),
(187, 2, 2, '2018-07-12 00:00:00', '2018-07-12 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:11'),
(188, 2, 2, '2018-07-12 00:00:00', '2018-07-12 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:11'),
(189, 2, 2, '2018-07-13 00:00:00', '2018-07-13 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:18'),
(190, 2, 2, '2018-07-13 00:00:00', '2018-07-13 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:18'),
(191, 2, 2, '2018-07-13 00:00:00', '2018-07-13 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:18'),
(192, 2, 2, '2018-07-14 00:00:00', '2018-07-14 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:25'),
(193, 2, 2, '2018-07-14 00:00:00', '2018-07-14 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:25'),
(194, 2, 2, '2018-07-15 00:00:00', '2018-07-15 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:34'),
(195, 2, 2, '2018-07-15 00:00:00', '2018-07-15 23:59:00', 1143, 2, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-07-07 10:22:34'),
(196, 2, 3, '2018-06-05 00:00:00', '2018-06-05 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-02 15:59:00', '2018-06-02 15:59:01'),
(197, 2, 3, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-03 17:04:48'),
(198, 2, 1, '2018-06-16 00:00:00', '2018-06-16 23:59:00', 1143, NULL, NULL, NULL, NULL, 1, 'test', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 1, 1, 0, 0, '2018-06-08 06:12:03', '2018-06-03 17:06:48'),
(199, 2, 2, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-06-03 18:37:53', '2018-06-03 18:37:53'),
(200, 2, 2, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, 1, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:1:{i:0;s:1:"2";}', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-06-03 18:38:44', '2018-06-03 18:38:44'),
(201, 2, NULL, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, NULL, 1, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-03 18:40:51', '2018-06-03 18:40:51'),
(202, 2, 2, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, 'Alone', '', '', '', '', '', NULL, '', 0, 0, 1, 1, 1, 0, 0, 0, '2018-06-03 18:41:04', '2018-06-03 18:41:04'),
(203, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, 8, NULL, NULL, NULL, NULL, '', NULL, 'Alone', 'a:2:{i:0;s:1:"2";i:1;s:1:"3";}', 'a:2:{i:1;s:1:"5";i:2;s:1:"5";}', '', '', '20:00', 1, '', 0, 0, 1, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-05 23:18:10'),
(204, 2, 7, '2018-06-04 00:00:00', '2018-06-04 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-07 04:31:20', '2018-06-16 04:45:11'),
(205, 2, 4, '2018-06-04 00:00:00', '2018-06-04 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', NULL, '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-07 04:31:20', '2018-06-16 04:50:05'),
(206, 2, 8, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, 'sdfasf', '12:00-02:30', '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-17 05:26:56', '2018-06-17 05:26:56'),
(207, 2, 8, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, 'fsdfsdfs', '12:12-21:21', '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-17 05:29:43', '2018-06-17 05:29:43'),
(208, 2, 3, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-17 05:31:30', '2018-06-17 05:31:30'),
(209, 2, 3, '2018-06-02 00:00:00', '2018-06-02 23:59:00', 1143, NULL, NULL, NULL, NULL, NULL, '', '', '', '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-17 05:33:14', '2018-06-17 05:33:14'),
(210, 2, 2, '2018-07-15 00:00:00', '2018-07-15 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00'),
(211, 2, 2, '2018-07-18 00:00:00', '2018-07-18 23:59:00', 1143, 4, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '0000-00-00 00:00:00'),
(214, 2, 2, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', '', 'TM', 'a:1:{i:0;s:1:"4";}', '', '', '', '15:00', 1, '', 0, 0, 1, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-18 12:52:27'),
(215, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, 1, NULL, NULL, NULL, '', '', NULL, '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-18 12:53:51'),
(216, 2, 2, '2018-06-20 00:00:00', '2018-06-20 23:59:00', 1143, 3, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 1, 0, 0, 0, 0, NULL, '2018-06-18 12:54:39'),
(217, 2, NULL, '2018-06-01 00:00:00', '2018-06-01 23:59:00', 1143, NULL, NULL, NULL, 15, NULL, '', NULL, 'Alone', '', '', '', '', '14:00', 1, '', 0, 0, 0, 1, 1, 1, 0, 0, '2018-06-18 12:58:17', '2018-06-18 12:55:26'),
(219, 2, NULL, '2018-06-12 00:00:00', '2018-06-12 23:59:00', 1145, NULL, NULL, 3, NULL, NULL, '', '', NULL, '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-20 04:49:25', '2018-06-20 04:49:25'),
(220, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1145, 6, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-06-20 05:17:12'),
(221, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1145, 7, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-06-20 05:18:55'),
(222, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1145, 8, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-06-20 05:20:03'),
(223, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1145, 9, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-06-20 05:20:03'),
(224, 2, 2, '2018-07-03 00:00:00', '2018-07-03 23:59:00', 1145, 10, NULL, NULL, NULL, NULL, '', NULL, NULL, '', '', '', NULL, NULL, NULL, '', 0, 1, 0, 0, 0, 0, 0, 0, NULL, '2018-06-20 05:20:03'),
(225, 2, 8, '2018-06-11 00:00:00', '2018-06-11 23:59:00', 1145, NULL, NULL, NULL, NULL, NULL, 'opd camp', '09:00-24:00', NULL, '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-20 05:24:08', '2018-06-20 05:24:08'),
(226, 2, 7, '2018-06-11 00:00:00', '2018-06-11 23:59:00', 1145, NULL, NULL, NULL, NULL, NULL, '', '', NULL, '', '', '', NULL, NULL, NULL, '', 0, 0, 0, 0, 1, 0, 0, 0, '2018-06-20 05:25:09', '2018-06-20 05:25:09');

-- --------------------------------------------------------

--
-- Table structure for table `work_plan_approval`
--

CREATE TABLE IF NOT EXISTS `work_plan_approval` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `is_approved` int(11) NOT NULL,
  `is_rejected` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `work_plan_approval`
--

INSERT INTO `work_plan_approval` (`id`, `date`, `user_id`, `lead_id`, `is_approved`, `is_rejected`, `dt`) VALUES
(1, '2018-03-01', 9, 8, 0, 0, '2018-02-27 04:51:04');

-- --------------------------------------------------------

--
-- Table structure for table `work_plan_submit`
--

CREATE TABLE IF NOT EXISTS `work_plan_submit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `lead_id` int(11) DEFAULT NULL,
  `is_rejected` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `work_plan_submit`
--

INSERT INTO `work_plan_submit` (`id`, `date`, `user_id`, `lead_id`, `is_rejected`, `dt`) VALUES
(1, '2018-06-04', 2, 8, 0, '2018-06-07 04:31:20'),
(2, '2018-06-16', 2, 8, 0, '2018-06-08 06:12:03'),
(3, '2018-06-01', 2, 8, 0, '2018-06-18 12:58:17');

-- --------------------------------------------------------

--
-- Table structure for table `work_reports`
--

CREATE TABLE IF NOT EXISTS `work_reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `work_type_id` int(11) NOT NULL,
  `plan_id` date NOT NULL,
  `strart_date` date NOT NULL,
  `city_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `report_details` text NOT NULL,
  `is_missed` int(11) NOT NULL,
  `is_completed` int(11) NOT NULL,
  `is_deleted` int(11) NOT NULL,
  `dt` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `rp_user_id` (`user_id`),
  KEY `rp_city_id` (`city_id`),
  KEY `rp_type_id` (`work_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `work_types`
--

CREATE TABLE IF NOT EXISTS `work_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(225) NOT NULL,
  `color` varchar(7) NOT NULL,
  `list` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `work_types`
--

INSERT INTO `work_types` (`id`, `name`, `color`, `list`) VALUES
(1, 'Leave', '#001F3F', 7),
(2, 'Field Work', '#5A61EE', 1),
(3, 'Quarterly Meeting', '#FBB818', 2),
(4, 'CME/Symposium', '#FF6504', 3),
(5, 'Induction/Training', '#00C64C', 4),
(6, 'Transist', '#c1803f', 5),
(7, 'Review Meeting', '#FF6361', 6),
(8, 'Others', '#777777', 8);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_gifts`
--
ALTER TABLE `assigned_gifts`
  ADD CONSTRAINT `assign_gift_pdt` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`),
  ADD CONSTRAINT `assign_gift_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `assigned_samples`
--
ALTER TABLE `assigned_samples`
  ADD CONSTRAINT `assign_sample_pdt` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `assign_sample_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `chemists`
--
ALTER TABLE `chemists`
  ADD CONSTRAINT `ch_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `ch_state_id` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cities`
--
ALTER TABLE `cities`
  ADD CONSTRAINT `state_id` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `city_distances`
--
ALTER TABLE `city_distances`
  ADD CONSTRAINT `city_distances_ibfk_1` FOREIGN KEY (`city_from`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `city_distances_ibfk_2` FOREIGN KEY (`city_to`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `daily_allowances`
--
ALTER TABLE `daily_allowances`
  ADD CONSTRAINT `daily_allowances_ibfk_1` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `daily_allowances_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doc_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `doc_qualification_id` FOREIGN KEY (`qualification_id`) REFERENCES `qualifications` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `doc_speciality_id` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`),
  ADD CONSTRAINT `doc_state_id` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doctors_relation`
--
ALTER TABLE `doctors_relation`
  ADD CONSTRAINT `dcr_doctor_id` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `dcr_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `expenses`
--
ALTER TABLE `expenses`
  ADD CONSTRAINT `expenses_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `expenses_ibfk_2` FOREIGN KEY (`work_plan_submit_id`) REFERENCES `work_plan_submit` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `expenses_ibfk_3` FOREIGN KEY (`expense_type_id`) REFERENCES `expense_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `issued_gifts`
--
ALTER TABLE `issued_gifts`
  ADD CONSTRAINT `issue_gift_doc` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `issue_gift_pg` FOREIGN KEY (`pgother_id`) REFERENCES `pg_others` (`id`),
  ADD CONSTRAINT `issue_gift_plan` FOREIGN KEY (`plan_id`) REFERENCES `work_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issue_gift_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `issue_gitf_pdt` FOREIGN KEY (`gift_id`) REFERENCES `gifts` (`id`);

--
-- Constraints for table `issued_samples`
--
ALTER TABLE `issued_samples`
  ADD CONSTRAINT `issue_sample_doc` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`),
  ADD CONSTRAINT `issue_sample_pdt` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`),
  ADD CONSTRAINT `issue_sample_pg` FOREIGN KEY (`pgother_id`) REFERENCES `pg_others` (`id`),
  ADD CONSTRAINT `issue_sample_plan` FOREIGN KEY (`plan_id`) REFERENCES `work_plans` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `issue_sample_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `other_expenses`
--
ALTER TABLE `other_expenses`
  ADD CONSTRAINT `other_expenses_ibfk_1` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `other_expenses_ibfk_2` FOREIGN KEY (`other_allowance_id`) REFERENCES `other_allowances` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `plan_relations`
--
ALTER TABLE `plan_relations`
  ADD CONSTRAINT `rel_plan_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rel_plan_id` FOREIGN KEY (`plan_id`) REFERENCES `work_plans` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `rel_plan_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `stockists`
--
ALTER TABLE `stockists`
  ADD CONSTRAINT `st_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `st_state_id` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `travel_expenses`
--
ALTER TABLE `travel_expenses`
  ADD CONSTRAINT `travel_expenses_ibfk_1` FOREIGN KEY (`expense_id`) REFERENCES `expenses` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `travel_expenses_ibfk_2` FOREIGN KEY (`city_from`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `travel_expenses_ibfk_3` FOREIGN KEY (`city_to`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `travel_expenses_ibfk_4` FOREIGN KEY (`work_type_id`) REFERENCES `work_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_roles_id` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `users_states_id` FOREIGN KEY (`state_id`) REFERENCES `states` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_plans`
--
ALTER TABLE `work_plans`
  ADD CONSTRAINT `work_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `work_type_id` FOREIGN KEY (`work_type_id`) REFERENCES `work_types` (`id`),
  ADD CONSTRAINT `work_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `work_reports`
--
ALTER TABLE `work_reports`
  ADD CONSTRAINT `rp_city_id` FOREIGN KEY (`city_id`) REFERENCES `cities` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rp_type_id` FOREIGN KEY (`work_type_id`) REFERENCES `work_types` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `rp_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

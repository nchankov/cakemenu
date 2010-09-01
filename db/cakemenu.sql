SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

CREATE TABLE IF NOT EXISTS `cakemenu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `link` varchar(255) DEFAULT NULL,
  `parent_id` varchar(45) DEFAULT NULL,
  `lft` int(11) DEFAULT NULL,
  `rght` int(11) DEFAULT NULL,
  `icon` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

INSERT INTO `cakemenu` (`id`, `name`, `link`, `parent_id`, `lft`, `rght`, `icon`) VALUES
(18, 'Menu 1', '/', NULL, 1, 2, ''),
(20, 'Menu 2', 'array(''plugin''=>false, ''controller''=>''my_controller'', ''action''=>''my_index'', 5)', NULL, 3, 4, ''),
(21, 'Menu 3 (no nodes)', '', NULL, 5, 6, ''),
(22, 'Profile', '/profile', NULL, 21, 22, '/cakemenu/img/icon-user-red.png'),
(23, 'Logout', '/logout', NULL, 23, 24, ''),
(27, 'Menu 4 (with children)', '', '', 7, 10, ''),
(28, 'Sub menu 4', '/location', '27', 8, 9, ''),
(29, 'Menu 5', '', '', 11, 20, ''),
(30, 'Menu 5.1', '/location-5-1', '29', 12, 19, ''),
(31, 'Menu 5.1.1', '/location 5.1.1', '30', 13, 14, ''),
(32, 'Menu 5.1.2', '/location-5.1.2', '30', 15, 18, ''),
(33, 'Menu 5.1.2.1', '/location-5.1.2.1', '32', 16, 17, '');

-- phpMyAdmin SQL Dump
-- version 3.3.7deb5build0.10.10.1
-- http://www.phpmyadmin.net
--
-- Värd: localhost
-- Skapad: 24 februari 2011 kl 08:39
-- Serverversion: 5.1.49
-- PHP-version: 5.3.3-1ubuntu9.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databas: `community`
--

-- --------------------------------------------------------

--
-- Struktur för tabell `com_categories`
--

CREATE TABLE IF NOT EXISTS `com_categories` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Data i tabell `com_categories`
--

INSERT INTO `com_categories` (`id`, `name`, `description`) VALUES
(1, 'Datorprat', 'Snack om datorer'),
(2, 'Webdesign', 'Här kan du prata webdesign'),
(3, 'Programmering', 'C/C++/Python eller övriga programmeringsspråk'),
(4, 'Off topic', 'Här kan du prata om allt random');

-- --------------------------------------------------------

--
-- Struktur för tabell `com_forum`
--

CREATE TABLE IF NOT EXISTS `com_forum` (
  `server_id` varchar(32) NOT NULL,
  `name` varchar(32) NOT NULL,
  `description` text,
  PRIMARY KEY (`server_id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data i tabell `com_forum`
--

INSERT INTO `com_forum` (`server_id`, `name`, `description`) VALUES
('R68QZskkM8JPH589', 'KlockClockers', 'best cry ever');

-- --------------------------------------------------------

--
-- Struktur för tabell `com_groups`
--

CREATE TABLE IF NOT EXISTS `com_groups` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(32) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Data i tabell `com_groups`
--

INSERT INTO `com_groups` (`id`, `name`) VALUES
(1, 'Admin'),
(2, 'Moderator'),
(3, 'User');

-- --------------------------------------------------------

--
-- Struktur för tabell `com_permissions`
--

CREATE TABLE IF NOT EXISTS `com_permissions` (
  `category` int(10) unsigned NOT NULL,
  `group` int(10) unsigned NOT NULL,
  PRIMARY KEY (`category`,`group`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Data i tabell `com_permissions`
--


-- --------------------------------------------------------

--
-- Struktur för tabell `com_posts`
--

CREATE TABLE IF NOT EXISTS `com_posts` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `text` text NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `time_modified` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `creator` int(10) unsigned NOT NULL,
  `thread` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Data i tabell `com_posts`
--

INSERT INTO `com_posts` (`id`, `text`, `time_created`, `time_modified`, `creator`, `thread`) VALUES
(1, 'sjelva hjertatt i hord diskenn e trassit va jag ska hitta po nu har ingen aning va som e fel:SSS\r\n\r\nhjelp mej!!', '2011-02-10 11:17:01', '0000-00-00 00:00:00', 2, 11),
(2, 'Jag förstår inte vad du menar..\r\nDu måste förklara mer utförligt vad som är fel, annars är det svårt att hjälpa dig.', '2011-02-10 11:18:52', '0000-00-00 00:00:00', 1, 11),
(3, 'de de lungnt ja ficksa de ja fromatera om dattan de funka nu tack', '2011-02-11 10:10:22', '2011-02-09 00:00:00', 2, 11),
(4, 'pÃ¥ llokalhost servver sÃ¥ ladar min internett xplorrer ner php vad jag gÃ¶r fel? :S', '2011-02-17 08:23:41', '2011-02-17 08:23:41', 2, 10),
(5, 'ja hÃ¥ler pÃ¥ me c# Ã¥ de e bra men ja fatar itne va e en int fÃ¶r nÃ¥ ja mÃ¥ste ha hjelp!!!1', '2011-02-17 08:26:12', '2011-02-17 08:26:12', 2, 1),
(6, 'intrenett e nere kan nÃ¥n hjelppa mej startta dett igen??:S', '2011-02-17 08:27:59', '2011-02-17 08:27:59', 2, 12),
(7, 'min hord disk moste va trassi fÃ¶r ja kan itne anslutta satta kabeln til den vett itne va felet e hÃ¤r e en bild pÃ¥ hord disken\r\nhttp://blog.twinbytes.ca/wp-content/uploads/2010/10/HD-IDE.jpg', '2011-02-17 08:29:56', '2011-02-17 08:29:56', 2, 9),
(8, 'visuall basik e best fÃ¶ man kan gÃ¶ massa sakker me de ville bara sÃ¤ja dett man kan ladda ner grattis de e bra ockcssÃ¥', '2011-02-17 08:31:25', '2011-02-17 08:31:25', 2, 5),
(9, 'ja dÃ¶dda min mama pÃ¥ cs :''(', '2011-02-17 08:31:55', '2011-02-17 08:31:55', 2, 8),
(10, 'va e en html tag fÃ¶r nÃ¥ ja kan inte fÃ¥ den her kodden at funkka ps ja vil gÃ¶rra en sidda som fragbitte fÃ¶r den siddan e bra\r\n\r\n<htnl\r\n<hedd></>boddy><<\r\n<titlle<fragbitte kopia\r\n\r\n</b0dy<//\r\n><hedd>\r\n<ifframe src=fraggbite.com</hedd>\r\n\r\n\r\n\r\nhotml>/', '2011-02-17 08:36:58', '2011-02-17 08:36:58', 2, 13),
(11, 'hjelp plzzz', '2011-02-22 13:03:01', '2011-02-22 13:03:01', 2, 12),
(13, 'Ã¥Ã¤Ã¶', '2011-02-23 09:44:31', '2011-02-23 09:44:31', 2, 11),
(19, 'lack', '2011-02-23 10:18:38', '2011-02-23 10:18:38', 2, 17),
(20, 'Ã¤ger', '2011-02-23 10:22:14', '2011-02-23 10:22:14', 2, 18),
(21, 'ja e ny hÃ¤r!1111', '2011-02-23 10:23:37', '2011-02-23 10:23:37', 2, 19),
(22, 'omfg', '2011-02-23 10:27:33', '2011-02-23 10:27:33', 2, 20),
(23, 'va e c#?', '2011-02-23 10:28:19', '2011-02-23 10:28:19', 2, 21),
(24, 'ja jilar glass', '2011-02-23 11:02:09', '2011-02-23 11:02:09', 2, 22),
(25, 'de e gÃ¥t', '2011-02-23 11:02:17', '2011-02-23 11:02:17', 2, 22),
(26, 'Men du Ã¤r ju fan cp.', '2011-02-23 11:02:51', '2011-02-23 11:02:51', 1, 8);

-- --------------------------------------------------------

--
-- Struktur för tabell `com_themes`
--

CREATE TABLE IF NOT EXISTS `com_themes` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(16) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Data i tabell `com_themes`
--

INSERT INTO `com_themes` (`id`, `name`, `description`) VALUES
(1, 'Standard', 'Standardtema');

-- --------------------------------------------------------

--
-- Struktur för tabell `com_threads`
--

CREATE TABLE IF NOT EXISTS `com_threads` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(64) NOT NULL,
  `description` text,
  `views` int(10) unsigned NOT NULL,
  `time_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `creator` int(10) unsigned NOT NULL,
  `category` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Data i tabell `com_threads`
--

INSERT INTO `com_threads` (`id`, `name`, `description`, `views`, `time_created`, `creator`, `category`) VALUES
(8, ':S min mamma dog', 'fffffffffFFFFFFFFFFfuUUUUUUU', 0, '2011-02-10 10:11:35', 2, 4),
(1, 'hjelp vad e en int?? :S', 'vad fan är en int i c?', 0, '2011-02-10 09:44:13', 2, 3),
(5, 'Visual basic pwnar!!1111', 'besta sproket evar!', 0, '2011-02-10 09:44:07', 2, 3),
(7, 'min datta e trasi :S', 'denn starttar inte hjelp mej!!??', 0, '2011-02-10 10:01:52', 2, 1),
(9, 'kan inte anslutta satta-kablen', 'vet inte vad som e fel:S', 0, '2011-02-10 10:12:37', 2, 1),
(10, 'internett xplorer laddar ner php:S', 'vett inte vad som e fell på loclahostt servern:S', 0, '2011-02-10 10:13:43', 2, 2),
(11, 'mitt modermodem e trassit??!', 'hjertat i hord disken e fel:S', 0, '2011-02-10 10:15:19', 2, 1),
(12, 'mitt internet funkar inte:SS', 'internet e nere vet inte kan nogon starta det?S:', 0, '2011-02-10 10:16:09', 2, 1),
(13, 'vett inte hur man progorammerarar html:SS', 'va e html hur programrmmerear ja dett??S:SS:S', 0, '2011-02-10 10:17:04', 2, 2),
(17, 'mastor', NULL, 0, '2011-02-23 10:18:38', 2, 1),
(18, 'intrenett exploiter', NULL, 0, '2011-02-23 10:22:14', 2, 2),
(19, 'hej', NULL, 0, '2011-02-23 10:23:37', 2, 4),
(20, 'dattafel', NULL, 0, '2011-02-23 10:27:33', 2, 2),
(21, 'hjelp', NULL, 0, '2011-02-23 10:28:19', 2, 3),
(22, 'glass', NULL, 0, '2011-02-23 11:02:09', 2, 1);

-- --------------------------------------------------------

--
-- Struktur för tabell `com_users`
--

CREATE TABLE IF NOT EXISTS `com_users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(16) NOT NULL,
  `email` varchar(128) NOT NULL,
  `password` varchar(64) NOT NULL,
  `avatar` varchar(256) DEFAULT NULL,
  `signature` text,
  `location` varchar(32) DEFAULT NULL,
  `description` text NOT NULL,
  `registered` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `last_active` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `group` int(10) unsigned NOT NULL,
  `theme` int(10) unsigned NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Data i tabell `com_users`
--

INSERT INTO `com_users` (`id`, `username`, `email`, `password`, `avatar`, `signature`, `location`, `description`, `registered`, `last_active`, `group`, `theme`) VALUES
(1, 'leet', 'leet@1337.org', 'b68918ef29dd7499fada16d28b0ae915b3e9f4df', 'avatars/leet.jpg', '1337', 'mothership', 'Jag Ã¤r 1338, lite bÃ¤ttre Ã¤n alla andra ;PppPp', '2011-01-21 11:58:57', '2011-01-21 00:00:00', 1, 1),
(2, 'n00b', 'n00b@hamsterpaj.kuk', 'b68918ef29dd7499fada16d28b0ae915b3e9f4df', 'avatars/n00b.jpg', 'jag suger :S', 'vet inte:S', 'hej ja e n00b jag suger :S', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, 1);

USE GameGang;

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id`        int(11) NOT NULL auto_increment,
  `username`  varchar(50) NOT NULL default '',
  `password`  varchar(50) NOT NULL default '',
  `joinDate`  timestamp default NOW(),
  `realName`  varchar(50) default '',

  PRIMARY KEY  (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- 
-- O serie de date
-- 

INSERT INTO `users` VALUES (1, 'GucciUser',         'bigMoneyBoy',      default,  'Abi');
INSERT INTO `users` VALUES (2, 'Lorry',             'qwer1234',         default, 'Loredana Vamanu');
INSERT INTO `users` VALUES (3, 'Sonia',             'qwer12345',        default, 'Sonia Mihaela-Bogos');
INSERT INTO `users` VALUES (4, 'xXxPuSSySl4y3rxXx', 'nicePasswordM8',   default, 'Andrei Getuta');




DROP TABLE IF EXISTS `games`;
CREATE TABLE IF NOT EXISTS `games` (
  `id`          int(11) NOT NULL auto_increment,
  `title`       varchar(50) NOT NULL default 'title',
  `rating`      int(10) NOT NULL default 0,
  `playerCount` int(10) NOT NULL default 0,
  `picture`     varchar(100)  NOT NULL default 'images/doom.jpg',

  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

INSERT INTO `games` VALUES (1, 'League of Legends', 9, 150000000, 'images/doom.jpg');
INSERT INTO `games` VALUES (2, 'Doom', 9, 15000000, 'images/doom.jpg');
INSERT INTO `games` VALUES (3, 'God of War', 7, 13000, 'images/gow.jpg');
INSERT INTO `games` VALUES (4, 'Bloodborne', 10, 12, 'images/bloodborne.jpg');

DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL,
  `login` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `fio` varchar(255) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `table_name_email_uindex` (`email`),
  UNIQUE KEY `table_name_login_uindex` (`login`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

LOCK TABLES `user` WRITE;
INSERT INTO `user` VALUES (1,'admin@admin.com','admin','20eabe5d64b0e216796e834f52d61fd0b70332fc','Князев Вадим');
UNLOCK TABLES;

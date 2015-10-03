CREATE TABLE IF NOT EXISTS `article` (
  `article_id` int(11) NOT NULL,
  `title` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `content` text COLLATE utf8_czech_ci,
  `url` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_czech_ci DEFAULT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;


INSERT INTO `article` (`article_id`, `title`, `content`, `url`, `description`) VALUES
(1, 'Úvod', '<p>Vítajte na našom webe!</p>\r\n\r\n<p>Tento web je postavený na <strong>jednoduchom redakčnom systéme v Nette frameworku</strong>. Toto je úvodný článok, načítaný z databáze.</p>', 'uvod', 'Úvodný článok na webe v Nette v PHP'),
(2, 'Stránka sa nenašla', '<p>Ľutujeme, ale požadovaná stránka sa nenašla. Skontrolujte, prosím, URL adresu.</p>', 'chyba', 'Stránka sa nenašla');

ALTER TABLE `article`
ADD PRIMARY KEY (`article_id`), ADD UNIQUE KEY `url` (`url`);

ALTER TABLE `article`
MODIFY `article_id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `user`
-- ----------------------------
DROP TABLE IF EXISTS `user`;
CREATE TABLE `user` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_czech_ci NOT NULL,
  `password` varchar(60) COLLATE utf8_czech_ci NOT NULL,
  `role` enum('member','admin') COLLATE utf8_czech_ci NOT NULL DEFAULT 'member',
  PRIMARY KEY (`user_id`),
  UNIQUE KEY `username` (`username`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_czech_ci;

-- ----------------------------
-- Records of user
-- ----------------------------
INSERT INTO `user` VALUES ('1', 'admin', '$2y$10$h8vmMU0yHJ4jFOpfxrZO0eIW3qgnRFXsdi4G9DKzXaHuo9OLPuPJu', 'admin');
INSERT INTO `user` VALUES ('2', 'test', '$2y$10$Re6SSHFjyr25eaddRBQHP.tvQ0nUr0EqUK05y12bGhgM.MzeHa5c6', 'member');

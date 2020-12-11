DROP TABLE IF EXISTS `award_date_rest`;
CREATE TABLE `award_date_rest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drawDate` int(8) NOT NULL DEFAULT '20201210' COMMENT '日期',
  `firstDraw` tinyint(1) NOT NULL DEFAULT '1' COMMENT '一等奖抽取数量',
  `secondDraw` tinyint(3) NOT NULL DEFAULT '20' COMMENT '二等奖每日抽取数量',
  PRIMARY KEY (`id`,`drawDate`),
  UNIQUE KEY `drawDate` (`drawDate`)
) ENGINE=InnoDB COMMENT='当日一二等奖剩余数' DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `award_rest`;
CREATE TABLE `award_rest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `firstDraw` tinyint(1) NOT NULL DEFAULT '5' COMMENT '一等奖剩余数量',
  `secondDraw` tinyint(3) NOT NULL DEFAULT '100' COMMENT '二等奖剩余数量',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB COMMENT='一二等奖剩余数' DEFAULT CHARSET=utf8;

INSERT INTO `award_rest` (`firstDraw`, `secondDraw`) VALUES (5, 100);


DROP TABLE IF EXISTS `draw_article`;
CREATE TABLE `draw_article` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel` char(11) NOT NULL COMMENT '用户手机号',
  `article` text NOT NULL,
  `addtimes` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `inx_tel` (`tel`) USING BTREE
) ENGINE=InnoDB COMMENT='投稿数据' DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `draw_list`;
CREATE TABLE `draw_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tel_id` int(11) NOT NULL DEFAULT '0' COMMENT '对应id（手机号对应id）',
  `drawType` tinyint(1) NOT NULL DEFAULT '3' COMMENT '获取几等奖 - 1>一等奖 2>二等奖 3> 三等奖',
  `addtimes` char(11) NOT NULL COMMENT '时间戳',
  PRIMARY KEY (`id`),
  KEY `tel_id` (`tel_id`)
) ENGINE=InnoDB  COMMENT='领奖数据' DEFAULT CHARSET=utf8;

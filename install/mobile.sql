
--
-- Table structure for table `ls_adv`
--

DROP TABLE IF EXISTS `mobile`;
CREATE TABLE `mobile` (
  `id` INT(11) unsigned NOT NULL auto_increment,
  `mts` INT(7) unsigned NOT NULL DEFAULT 0,
  `province` VARCHAR (20) character set utf8 collate utf8_unicode_ci NOT NULL DEFAULT '',
  `cat_name` VARCHAR(20) character set utf8 collate utf8_unicode_ci NOT NULL DEFAULT '',
  `carrier` varchar(20) character set utf8 collate utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;




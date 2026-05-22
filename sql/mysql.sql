CREATE TABLE `slideshow_item` (
	`item_id` int(10) NOT NULL auto_increment,
	`item_title` varchar(255) NOT NULL,
	`item_caption` text,
	`item_category` int(11) NOT NULL,
	`item_link` varchar(255) NOT NULL DEFAULT '',
	`item_linktarget` TINYINT(3) UNSIGNED NOT NULL DEFAULT '0',
	`item_status` tinyint(1) NOT NULL DEFAULT '1',
	`item_create` int(10) NOT NULL DEFAULT '0',
	`item_uid` int(11) NOT NULL DEFAULT '0',
	`item_order` int(11) NOT NULL DEFAULT '100',
	`item_img` varchar(255) NOT NULL DEFAULT '',
	`item_type` varchar(60) NOT NULL DEFAULT 'image',
	`item_video_url` varchar(500) NOT NULL DEFAULT '',
	`item_startdate` datetime NOT NULL DEFAULT '2026-01-01 00:00:00',
	`item_enddate` datetime NOT NULL DEFAULT '2038-01-19 03:14:07',
	`item_languagecode` varchar(60) NOT NULL DEFAULT '',
	PRIMARY KEY (`item_id`),
	KEY `select` (`item_category`, `item_status`, `item_type`),
	KEY `order` (`item_order`),
	KEY `dates` (`item_startdate`, `item_enddate`)
) ENGINE=InnoDB;

CREATE TABLE `slideshow_category` (
	`category_id` int(11) unsigned NOT NULL auto_increment,
	`category_title` varchar(255) NOT NULL,
	`category_created` int(10) NOT NULL default '0',
	PRIMARY KEY (`category_id`)
) ENGINE=InnoDB;
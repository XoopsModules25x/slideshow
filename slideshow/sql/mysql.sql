CREATE TABLE `slideshow_item` (
	`item_id` int(10) NOT NULL auto_increment,
	`item_title` varchar(255) NOT NULL,
	`item_text` text NOT NULL,
	`item_topic` int(11) NOT NULL,
	`item_link` varchar(255) NOT NULL,
	`item_status` tinyint(1) NOT NULL,
	`item_create` int (10) NOT NULL default '0',
	`item_uid` int(11) NOT NULL,
	`item_order` int(11) NOT NULL,
	`item_img` varchar(255) NOT NULL,
	`item_thumb` varchar(255) NOT NULL,
	`item_default` tinyint(1) NOT NULL default '0',
	`item_type` varchar (60)   NOT NULL ,
PRIMARY KEY  (`item_id`)
) ENGINE=MyISAM;

CREATE TABLE `slideshow_topic` (
	`topic_id` int (11) unsigned NOT NULL  auto_increment,
	`topic_title` varchar (255)   NOT NULL ,
	`topic_showtype` varchar (60)   NOT NULL ,
	`topic_created` int (10)   NOT NULL default '0',
PRIMARY KEY (`topic_id`)
) ENGINE=MyISAM;
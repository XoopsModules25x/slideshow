<?php

/**
 * XOOPS slideshow module
 *
 * You may not change or alter any portion of this comment or credits
 * of supporting developers from this source code or any supporting source code
 * which is considered copyrighted (c) material of the original comment or credit authors.
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.
 *
 * @copyright       XOOPS Project (https://xoops.org)
 * @license         GNU GPL 2 (http://www.gnu.org/licenses/old-licenses/gpl-2.0.html)
 * @package         module
 * @since           2.5.0
 * @author          Mohtava Project <http://www.mohtava.com>
 * @author          Hossein Azizabadi <djvoltan@gmail.com>
 * @version         $Id: $
 */
function xoops_module_update_slideshow()
{
    $db = Database::getInstance();
    $prefix = $db->prefix('slideshow_item');

    // v2.0 → add item_img if missing
    $result = $db->query("SHOW COLUMNS FROM `{$prefix}` LIKE 'item_img'");
    if ($db->getRowsNum($result) == 0) {
        $db->query("ALTER TABLE `{$prefix}` ADD `item_img` varchar(255) NOT NULL DEFAULT ''");
    }

    // v2.1 → add item_video_url for video support
    $result = $db->query("SHOW COLUMNS FROM `{$prefix}` LIKE 'item_video_url'");
    if ($db->getRowsNum($result) == 0) {
        $db->query("ALTER TABLE `{$prefix}` ADD `item_video_url` varchar(500) NOT NULL DEFAULT '' AFTER `item_img`");
    }

    // v2.1 → add item_languagecode if missing
    $result = $db->query("SHOW COLUMNS FROM `{$prefix}` LIKE 'item_languagecode'");
    if ($db->getRowsNum($result) == 0) {
        $db->query("ALTER TABLE `{$prefix}` ADD `item_languagecode` varchar(60) NOT NULL DEFAULT '' AFTER `item_enddate`");
    }

    // v2.1 → add item_startdate if missing
    $result = $db->query("SHOW COLUMNS FROM `{$prefix}` LIKE 'item_startdate'");
    if ($db->getRowsNum($result) == 0) {
        $db->query("ALTER TABLE `{$prefix}` ADD `item_startdate` datetime NOT NULL DEFAULT '2026-01-01 00:00:00' AFTER `item_languagecode`");
    }

    // v2.1 → add item_enddate if missing
    $result = $db->query("SHOW COLUMNS FROM `{$prefix}` LIKE 'item_enddate'");
    if ($db->getRowsNum($result) == 0) {
        $db->query("ALTER TABLE `{$prefix}` ADD `item_enddate` datetime NOT NULL DEFAULT '2038-01-19 03:14:07' AFTER `item_startdate`");
    }

    // v2.1 → fix item_type default and normalize old values
    $db->query("ALTER TABLE `{$prefix}` MODIFY `item_type` varchar(60) NOT NULL DEFAULT 'image'");
    $db->query("UPDATE `{$prefix}` SET `item_type` = 'image' WHERE `item_type` = '' OR `item_type` = 'slideshow'");

    return true;
}

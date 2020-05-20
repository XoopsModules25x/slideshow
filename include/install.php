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
function xoops_module_install_slideshow()
{
    $dir = XOOPS_ROOT_PATH . '/uploads/slideshow';

    if (!is_dir($dir)) {
        mkdir($dir, 0777);

        chmod($dir, 0777);
    }

    $dir = XOOPS_ROOT_PATH . '/uploads/slideshow/image';

    if (!is_dir($dir)) {
        mkdir($dir, 0777);

        chmod($dir, 0777);
    }
}

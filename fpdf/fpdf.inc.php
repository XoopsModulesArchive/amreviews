<?php

// $Id: fpdf.inc.php,v 1.1 2007/01/24 19:22:45 andrew Exp $
//  ------------------------------------------------------------------------ //
//                XOOPS - PHP Content Management System                      //
//                    Copyright (c) 2000 XOOPS.org                           //
//                       <https://www.xoops.org>                             //
//  ------------------------------------------------------------------------ //
//  This program is free software; you can redistribute it and/or modify     //
//  it under the terms of the GNU General Public License as published by     //
//  the Free Software Foundation; either version 2 of the License, or        //
//  (at your option) any later version.                                      //
//                                                                           //
//  You may not change or alter any portion of this comment or credits       //
//  of supporting developers from this source code or any supporting         //
//  source code which is considered copyrighted (c) material of the          //
//  original comment or credit authors.                                      //
//                                                                           //
//  This program is distributed in the hope that it will be useful,          //
//  but WITHOUT ANY WARRANTY; without even the implied warranty of           //
//  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the            //
//  GNU General Public License for more details.                             //
//                                                                           //
//  You should have received a copy of the GNU General Public License        //
//  along with this program; if not, write to the Free Software              //
//  Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA  02111-1307 USA //
//  ------------------------------------------------------------------------ //
// Author: Kazumi Ono (AKA onokazu)                                          //
// URL: http://www.myweb.ne.jp/, https://www.xoops.org/, http://jp.xoops.org/ //
// Project: The XOOPS Project                                                //
// ------------------------------------------------------------------------- //
if (!defined('XOOPS_ROOT_PATH')) {
    die('XOOPS root path not defined');
}

define('AMREV_FPDF_PATH', XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/fpdf');
define('FPDF_FONTPATH', AMREV_FPDF_PATH . '/font/');

require AMREV_FPDF_PATH . '/gif.php';
require AMREV_FPDF_PATH . '/fpdf.php';

if (is_readable(AMREV_FPDF_PATH . '/language/' . $xoopsConfig['language'] . '.php')) {
    require_once AMREV_FPDF_PATH . '/language/' . $xoopsConfig['language'] . '.php';
} elseif (is_readable(AMREV_FPDF_PATH . '/language/english.php')) {
    require_once AMREV_FPDF_PATH . '/language/english.php';
} else {
    die('No Language File Readable!');
}
include AMREV_FPDF_PATH . '/makepdf_class.php';
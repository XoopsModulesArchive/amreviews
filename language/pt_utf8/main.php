<?php

// $Id: main.php,v 1.1 2006/06/08 05:07:42 mikhail Exp $
// ------------------------------------------------------------------------ //
// Author: Andrew Mills //
// Email: ajmills@sirium.net //
// About: This file is part of the AM Reviews module for Xoops v2. //
// //
// ------------------------------------------------------------------------ //
// XOOPS - PHP Content Management System //
// Copyright (c) 2000 xoopscube.org //
// <http://www.xoopscube.org> //
// ------------------------------------------------------------------------ //
// This program is free software; you can redistribute it and/or modify //
// it under the terms of the GNU General Public License as published by //
// the Free Software Foundation; either version 2 of the License, or //
// (at your option) any later version. //
// //
// You may not change or alter any portion of this comment or credits //
// of supporting developers from this source code or any supporting //
// source code which is considered copyrighted (c) material of the //
// original comment or credit authors. //
// //
// This program is distributed in the hope that it will be useful, //
// but WITHOUT ANY WARRANTY; without even the implied warranty of //
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the //
// GNU General Public License for more details. //
// //
// You should have received a copy of the GNU General Public License //
// along with this program; if not, write to the Free Software //
// Foundation, Inc., 59 Temple Place, Suite 330, Boston, MA 02111-1307 USA //
// ------------------------------------------------------------------------ //
// includes
//require_once "header.php";
/**
 * Defines for index.php
 */
define('_MD_AMR_NAVBCTOP', 'Top'); // Navigation BreadCrumbs "Top"
/**
 * index.php - reviews listing.
 */
define('_MD_AMR_REVIEWEDBY', 'Reviewed by:');
define('_MD_AMR_NOREVIEWCAP', 'There are currently no reviews in this category.');
define('_MD_AMR_NOPERMCATMSG', 'You do not have permission to view this category. Do you need to log in?');
/**
 * Generic that can go anywhere.
 */
define('_MD_AMR_GENON', 'on');
define('_MD_AMR_READCAP', 'reads');
/**
 * review.php
 */
define('_MD_AMR_SUBTTLCAP', 'Subtitle:');
define('_MD_AMR_STARALTNORATE', 'Not rated.');
define('_MD_AMR_OURRATECAP', 'Our rating:');
define('_MD_AMR_USERRATECAP', 'User rating:');
define('_MD_AMR_USERRATEALT', 'Our users have rated this: %s/5 from %s votes.'); // first %s replaced with vote, second with number of votes.
define('_MD_AMR_DETAILSCAP', 'Item details:');
define('_MD_AMR_BACKCAP', 'Back');
define('_MD_AMR_PRINTCAP', 'Click for printer friendly version');
define('_MD_AMR_EMAILCAP', 'Click to send to friend');
define('_MD_AMR_PDFCAP', 'Click for PDF version');
define('_MD_AMR_RSSCAP', 'RSS feed.');
define('_MD_AMR_EDITCAP', 'Click to edit');
define('_MD_AMR_DELETECAP', 'Click to delete');
define('_MD_AMR_PAGENEXT', 'next');
define('_MD_AMR_PAGEPREV', 'prev');
define('_MD_AMR_PAGENUM', 'Page');
define('_MD_AMR_PAGEOF', 'of');

<?php

// $Id: admin.php,v 1.1 2006/06/08 05:07:42 mikhail Exp $
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
 * Admin header menu.
 */
define('_AM_AMREV_GENERALSET', 'Prefs');
define('_AM_AMREV_GOTOMOD', 'Go to mod');
define('_AM_AMREV_HELP', 'Help');
define('_AM_AMREV_MODULEADMIN', 'Admin :');
define('_AM_AMREV_INDEX', 'Index');
define('_AM_AMREV_CAT', 'Categories');
define('_AM_AMREV_REVIEWS', 'Reviews');
define('_MI_AMREV_IMAGES', 'Images');
define('_AM_AMREV_PERMS', 'Permissions');
/**
 * Misc. (used on more than one page)
 */
define('_AM_AMREV_FILECHECKS', 'Information');
define('_AM_AMREV_UPLOADMAX', 'Maximum upload size: ');
define('_AM_AMREV_POSTMAX', 'Maximum post size: ');
define('_AM_AMREV_UPLOADS', 'Uploads allowed: ');
define('_AM_AMREV_UPLOAD_ON', 'On');
define('_AM_AMREV_UPLOAD_OFF', 'Off');
define('_AM_AMREV_GDIMGSPPRT', 'GD image lib supported: ');
define('_AM_AMREV_GDIMGON', 'Yes');
define('_AM_AMREV_GDIMGOFF', 'No');
define('_AM_AMREV_GDIMGVRSN', 'GD image lib version: ');
define('_AM_AMREV_DBUPDATED', 'Database updated!');
define('_AM_AMREV_DBNOUPDATED', 'Database not updated!');
define('_AM_AMREV_DBCONFMDEL', 'Are you sure you want to delete this item?');
define('_AM_AMREV_DBDELETED', 'Item deleted!');
define('_AM_AMREV_DBNOTDELETED', 'Item not deleted!');
define('_AM_AMREV_CLICKEDIT', 'Click to edit.');
define('_AM_AMREV_CLICKDELETE', 'Click to delete.');
define('_AM_AMREV_STATUSSHOW', 'Status: Published.');
define('_AM_AMREV_STATUSHIDE', 'Status: Hidden.');
define('_AM_AMREV_FRMCAPNOHTML', ' Allow HTML.');
define('_AM_AMREV_FRMCAPNOBR', ' Convert line breaks (deselect when using WYSIWYG editors).');
define('_AM_AMREV_FRMCAPNOSMLY', ' Allow XOOPS smiley icons.');
define('_AM_AMREV_FRMCAPNOXCDE', ' Allow XOOPS codes.');
define('_AM_AMREV_FRMCAPNOXIMG', ' Allow display of images with XOOPS codes.');
/**
 * index.php
 */
define('_AM_AMREV_SUMMARY', 'General stats');
define('_AM_AMREV_WAITVALCAP', 'Validation:');
define('_AM_AMREV_WAITVAL', '%s reviews are waiting to be <a href="validate.php">validated</a>.');
define('_AM_AMREV_REVIEWTOTCAP', 'No. reviews:');
define('_AM_AMREV_REVIEWTOT', '%s <a href="review.php">reviews</a>.');
define('_AM_AMREV_CATETOTCAP', 'No. categories:');
define('_AM_AMREV_CATETOT', '%s <a href="category.php">categories</a>.');
define('_AM_AMREV_CATTBLCAP', 'Categories');
define('_AM_AMREV_VIEWSCAP', 'No. views:');
define('_AM_AMREV_VIEWS', '%s total <a href="review.php">reviews</a> views.');
define('_AM_AMREV_PUBLISHEDCAP', 'Published:');
define('_AM_AMREV_PUBLISHED', '%s <a href="review.php">reviews</a> have been published.');
define('_AM_AMREV_HIDDENCAP', 'Hidden:');
define('_AM_AMREV_HIDDEN', '%s <a href="review.php">reviews</a> are hidden (includes unvalidated <a href="review.php">reviews</a>).');
/**
 * category.php
 */
define('_AM_AMREV_CATCAPTION', 'Add a category:');
define('_AM_AMREV_CATCAPSAVE', 'Save');
define('_AM_AMREV_CATCAPTIONED', 'Edit a category:');
define('_AM_AMREV_CATCAPSAVEED', 'Save changes');
/**
 * catform.inc.php
 */
define('_AM_AMREV_CATCAPTTL', 'Category title:');
define('_AM_AMREV_CATCAPDESC', 'Description:');
define('_AM_AMREV_CATCAPPAR', 'Parent category:');
define('_AM_AMREV_CATCAPPARSLT', 'Select parent as required:');
define('_AM_AMREV_CATCAPSRT', 'Weight:');
define('_AM_AMREV_CATCAPDSPLY', 'Publish:');
define('_AM_AMREV_CATCAPDSPLYTXT', ' Select to show this category.');
/**
 * review.php
 */
define('_AM_AMREV_REVIEWTBLCAP', 'Reviews:');
define('_AM_AMREV_REVCAPTION', 'Add a review:');
define('_AM_AMREV_REVCAPSAVE', 'Save');
define('_AM_AMREV_REVCAPEDIT', 'Edit review:');
/**
 * reviewform.inc.php
 */
define('_AM_AMREV_REVCAPTTL', 'Review title:');
define('_AM_AMREV_REVCAPSUBTTL', 'Subtitle:');
define('_AM_AMREV_CAPSAUTHOR', 'Author:');
define('_AM_AMREV_CAPSDETAILS', 'Item details:');
define('_AM_AMREV_CAPSTEASER', 'Teaser:');
define('_AM_AMREV_CAPSMAINREVIEW', 'Main review:');
define('_AM_AMREV_CAPSKEYWORDS', 'Keywords:');
define('_AM_AMREV_CAPSKEYWORDSDSC', 'Add comma separated list of keywords for meta headers and site search.<br> Example: &quot;key, word, for, search, meta tags&quot;');
define('_AM_AMREV_CATCAP', 'Category:');
define('_AM_AMREV_CATCAPSLT', 'Select a category');
define('_AM_AMREV_CAPDSPLYREV', 'Publish:');
define('_AM_AMREV_CAPDSPLYREVTXT', 'display this review.');
define('_AM_AMREV_CAPSDDATE', 'Published date:');
define('_AM_AMREV_CAPSSTARTDATE', 'Start date:');
define('_AM_AMREV_CAPSSTARTDTBX', 'Set when to start display of review (de-select to remove display restriction).<br>');
define('_AM_AMREV_CAPSSTARTDTYN', '<br>Remove start date: ');
define('_AM_AMREV_CAPSENDDATE', 'End date:');
define('_AM_AMREV_CAPSENDDTBX', 'Set when to end display of review (de-select to remove display restriction).<br>');
define('_AM_AMREV_CAPSENDDTYN', '<br>Remove expiry date: ');
define('_AM_AMREV_CAPRATE', 'Review rating:');
define('_AM_AMREV_CAPRATESLT', 'Select a rating:');
define('_AM_AMREV_CAPRATE1', '*');
define('_AM_AMREV_CAPRATE2', '**');
define('_AM_AMREV_CAPRATE3', '***');
define('_AM_AMREV_CAPRATE4', '****');
define('_AM_AMREV_CAPRATE5', '*****');
define('_AM_AMREV_PAGETTL', 'Review title as page title:');
//define("_AM_AMREV_PAGETTLDSC", "The default page title behaviour - can be set individually in review.");
define('_AM_AMREV_PAGETTL_OPT_0', 'None: default XOOPS page title');
define('_AM_AMREV_PAGETTL_OPT_1', 'Yes: &lt;module name&gt; - &lt;review title&gt;');
define('_AM_AMREV_PAGETTL_OPT_2', 'Yes: &lt;review title&gt; - &lt;module name&gt;');
define('_AM_AMREV_KEYWORD', 'Keyword meta header options:');
define('_AM_AMREV_KEYWORD_OPT_0', 'None: default XOOPS meta tags');
define('_AM_AMREV_KEYWORD_OPT_1', "Yes: review's meta tags only");
define('_AM_AMREV_KEYWORD_OPT_2', "Yes: review's and XOOPS meta tags");
define('_AM_AMREV_CAPCOMMENTS', 'Allow comments:');
define('_AM_AMREV_CAPCOMMENTSTXT', ' Allow comments for this review.');
/**
 * Image.php
 */
define('_AM_AMREV_IMGUPLOAD', 'Upload images:');
define('_AM_AMREV_IMGUPFILE', 'Select image:');
define('_AM_AMREV_IMGUPBUTTON', 'Upload');
define('_AM_AMREV_IMGUPLOADFNL', '<b>Final upload path:</b> ');
define('_AM_AMREV_IMGUPLOADTMP', '<b>Temp upload path:</b> ');
define('_AM_AMREV_IMGUPLOADMAX', '<b>Max. file size:</b> ');
define('_AM_AMREV_IMGUPLOADFN', ' Select to keep original filename.');
define('_AM_AMREV_IMGUPLOADED', 'Image uploaded successfully');
define('_AM_AMREV_DELETEIMGCAP', 'Delete an image:');
define('_AM_AMREV_SELECTIMGCAP', 'Select image:');
define('_AM_AMREV_HIWIDTH', 'Default highlight width:');
define('_AM_AMREV_THUMBWIDTH', 'Default thumbnail width:');
define('_AM_AMREV_DELTHUMBS', 'Delete thumbnails:');
define('_AM_AMREV_DELTHUMBSCAP', '');
define('_AM_AMREV_DELIMAGEBUT', 'Delete');
/**
 * perms.php
 */
define('_AM_AMREV_CATPERMTTL', 'Category permissions');
define('_AM_AMREV_CATPERMDSC', 'Select who can view which category:');

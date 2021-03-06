<?php

// $Id: xoops_version.php,v 1.7 2007/01/24 19:24:32 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                               //
//	About:  This file is part of the AM Reviews module for Xoops v2.         //
//                                                                           //
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

// Any copyright notice, instructions, etc...
$modversion['name'] = _MI_AM_REVIEW_NAME;
$modversion['version'] = 0.10;
$modversion['description'] = _MI_AM_REVIEW_DESC;
$modversion['credits'] = '';
$modversion['author'] = 'Andrew Mills - http://support.sirium.net';
$modversion['help'] = 'help.html';
$modversion['license'] = 'GPL see LICENSE';
$modversion['official'] = 0;
$modversion['image'] = 'modulelogo.png';
$modversion['dirname'] = 'amreviews';

// Admin
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 1;

// Templates
$modversion['templates'][1]['file'] = 'amr_index.html'; // main index - default view
$modversion['templates'][1]['description'] = '';
$modversion['templates'][2]['file'] = 'amr_review.html'; // Review page
$modversion['templates'][2]['description'] = '';
$modversion['templates'][3]['file'] = 'amr_rate.html'; // Rate page
$modversion['templates'][3]['description'] = '';
$modversion['templates'][4]['file'] = 'amr_print.html'; // Rate page
$modversion['templates'][4]['description'] = '';

// Blocks
//$modversion['blocks'][1]['file']		= "menu_block.php";
//$modversion['blocks'][1]['name']		= _MI_ARTICLES_BNAME1;
//$modversion['blocks'][1]['description']	= "Shows Norton AV info";
//$modversion['blocks'][1]['show_func']	= "nav_info_show";
//$modversion['blocks'][1]['template']	= 'news_block_topics.html';

// Sql file (must contain sql generated by phpMyAdmin or phpPgAdmin)
// All tables should not have any prefix!
$modversion['sqlfile']['mysql'] = 'sql/mysql.sql';
//$modversion['sqlfile']['postgresql']	= "sql/pgsql.sql";

// Tables created by sql file (without prefix!)
$modversion['tables'][0] = 'amreview_reviews';
$modversion['tables'][1] = 'amreview_cat';
//$modversion['tables'][2]	= "amreview_rate";

// Search
$modversion['hasSearch'] = 1;
$modversion['search']['file'] = 'include/search.inc.php';
$modversion['search']['func'] = 'amreviews_search';

// Comments
$modversion['hasComments'] = 1;
$modversion['comments']['itemName'] = 'id';
$modversion['comments']['pageName'] = 'review.php';

// Config options
//
#$modversion['config'][1]['name']		= 'indextype';
#$modversion['config'][1]['title']		= '_MI_AMR_OTPN_INDEX';
#$modversion['config'][1]['description']	= '_MI_AMR_OTPN_INDEXDESC';
#$modversion['config'][1]['formtype']	= 'select';
#$modversion['config'][1]['valuetype']	= 'int';
#$modversion['config'][1]['default']		= '0';
#$modversion['config'][1]['options']		= array('default' => '0', 'Directory' => '1');

$key = 1;
// Number of category columns in directory view
$modversion['config'][$key]['name'] = 'indexcolumns';
$modversion['config'][$key]['title'] = '_MI_AMR_INDXCOL';
$modversion['config'][$key]['description'] = '_MI_AMR_INDXCOLDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '2';

// Date format - review page
$key++;
$modversion['config'][$key]['name'] = 'indxlistdatefrmt';
$modversion['config'][$key]['title'] = '_MI_AMR_DATEFRMTINDX';
$modversion['config'][$key]['description'] = '_MI_AMR_DATEFRMTINDXDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = 'Y/m/d';

// Date format - review page
$key++;
$modversion['config'][$key]['name'] = 'dateformat';
$modversion['config'][$key]['title'] = '_MI_AMR_DATEFRMT';
$modversion['config'][$key]['description'] = '_MI_AMR_DATEFRMTDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = 'Y/m/d';

// Date format - print page
$key++;
$modversion['config'][$key]['name'] = 'dateformatprint';
$modversion['config'][$key]['title'] = '_MI_AMR_DATEFRMTPRT';
$modversion['config'][$key]['description'] = '_MI_AMR_DATEFRMTPRTDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = 'D, j F Y';

// Date format - review page
$key++;
$modversion['config'][$key]['name'] = 'dateformatpdf';
$modversion['config'][$key]['title'] = '_MI_AMR_DATEFRMTPDF';
$modversion['config'][$key]['description'] = '_MI_AMR_DATEFRMTPDFDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = 'Y/m/d';

// Show reviewed by
$key++;
$modversion['config'][$key]['name'] = 'showreviewedby';
$modversion['config'][$key]['title'] = '_MI_AMR_SHWRVWDBY';
$modversion['config'][$key]['description'] = '_MI_AMR_SHWRVWDBYDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

/*
// Show reviewed on (show/hide date)
$key++;
$modversion['config'][$key]['name']		= 'showreviewedon';
$modversion['config'][$key]['title']		= '_MI_AMR_OPT_SHWRVWDON';
$modversion['config'][$key]['description']	= '_MI_AMR_OPT_SHWRVWDONDSC';
$modversion['config'][$key]['formtype']	= 'yesno';
$modversion['config'][$key]['valuetype']	= 'int';
$modversion['config'][$key]['default']		= 1;
*/

// Show print version
$key++;
$modversion['config'][$key]['name'] = 'showprint';
$modversion['config'][$key]['title'] = '_MI_AMR_SHWPRINT';
$modversion['config'][$key]['description'] = '_MI_AMR_SHWPRINTDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// Allow e-mail to friend feature.
$key++;
$modversion['config'][$key]['name'] = 'allowpdf';
$modversion['config'][$key]['title'] = '_MI_AMR_ALLOWPDF';
$modversion['config'][$key]['description'] = '_MI_AMR_ALLOWPDFDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// Allow e-mail to friend feature.
$key++;
$modversion['config'][$key]['name'] = 'allowemail';
$modversion['config'][$key]['title'] = '_MI_AMR_ALLOWEMAIL';
$modversion['config'][$key]['description'] = '_MI_AMR_ALLOWEMAILDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// Log in to use - emailtofriendlogin
$key++;
$modversion['config'][$key]['name'] = 'emailtofriendlogin';
$modversion['config'][$key]['title'] = '_MI_AMR_EMLLOGGEDIN';
$modversion['config'][$key]['description'] = '_MI_AMR_EMLLOGGEDINDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// Allow user to include own message
$key++;
$modversion['config'][$key]['name'] = 'emailtofriendownmsg';
$modversion['config'][$key]['title'] = '_MI_AMR_OPTION_EMLOWNMSG';
$modversion['config'][$key]['description'] = '_MI_AMR_OPTION_EMLOWNMSGDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// Characters in message
$key++;
$modversion['config'][$key]['name'] = 'emailtofreindchars';
$modversion['config'][$key]['title'] = '_MI_AMR_OPTION_EMLMSGCHRS';
$modversion['config'][$key]['description'] = '_MI_AMR_OPTION_EMLMSGCHRSDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '200';

// Subject text
$key++;
$modversion['config'][$key]['name'] = 'emailtofreindsubect';
$modversion['config'][$key]['title'] = '_MI_AMR_OPTION_EMLMSGSBJCT';
$modversion['config'][$key]['description'] = '_MI_AMR_OPTION_EMLMSGSBJCTDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = _MI_AMR_OPTION_EMLMSGSUBJECT;

// send to friend e-mail text
$key++;
$modversion['config'][$key]['name'] = 'emailtext';
$modversion['config'][$key]['title'] = '_MI_AMR_OPTION_EMAILTXT';
$modversion['config'][$key]['description'] = '_MI_AMR_OPTION_EMAILTXTSC';
$modversion['config'][$key]['formtype'] = 'textarea';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = _MI_AMR_OPTION_EMAILTXTMSG;

/*
// Index page header text
$key++;
$modversion['config'][$key]['name']		= 'headertext';
$modversion['config'][$key]['title']		= '_MI_AMR_OPT_HEADER';
$modversion['config'][$key]['description']	= '_MI_AMR_OPT_HEADERDSC';
$modversion['config'][$key]['formtype']	= 'textbox';
$modversion['config'][$key]['valuetype']	= 'text';
$modversion['config'][$key]['default']		= '_MI_AMR_OPT_HEADERTXT';
*/
// Item details template
$key++;
$modversion['config'][$key]['name'] = 'itemdetailtpl';
$modversion['config'][$key]['title'] = '_MI_AMR_DETAILTPL';
$modversion['config'][$key]['description'] = '_MI_AMR_DETAILTPLDSC';
$modversion['config'][$key]['formtype'] = 'textarea';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = _MI_AMR_DETAILTPLTXT;

// Do not increment admin views
$key++;
$modversion['config'][$key]['name'] = 'noincrementifadmin';
$modversion['config'][$key]['title'] = '_MI_AMR_INCREMENTADMIN';
$modversion['config'][$key]['description'] = '_MI_AMR_INCREMENTADMINDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// default admin editor
$key++;
$modversion['config'][$key]['name'] = 'amrevieweditadmin';
$modversion['config'][$key]['title'] = '_MI_AMR_EDITADMIN';
$modversion['config'][$key]['description'] = '_MI_AMR_EDITADMINDSC';
$modversion['config'][$key]['formtype'] = 'select';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '0';
$modversion['config'][$key]['options'] = ['XOOPS dhtml' => '0', 'SPAW' => '1', 'FCK Editor' => '2', 'HTML Area' => '3', 'Koivi' => '4', 'XOOPS Compact' => '5'];

$key++;
$modversion['config'][$key]['name'] = 'photopath';
$modversion['config'][$key]['title'] = '_MI_AMR_PHOTOPATH';
$modversion['config'][$key]['description'] = '_MI_AMR_PHOTOPATHDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'text';
$modversion['config'][$key]['default'] = '/modules/amreviews/photos';

// Maximum upload size - admin
$key++;
$modversion['config'][$key]['name'] = 'maxuploadadmin';
$modversion['config'][$key]['title'] = '_MI_AMR_MAXUPADMIN';
$modversion['config'][$key]['description'] = '_MI_AMR_MAXUPADMINDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '200';

// Highlight image - default width (used in review/cat listing)
$key++;
$modversion['config'][$key]['name'] = 'imghighwdith';
$modversion['config'][$key]['title'] = '_MI_AMR_IMGHIGHWIDTH';
$modversion['config'][$key]['description'] = '_MI_AMR_IMGHIGHWIDTHDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '80';

// Thumbnail image - default width (used in review article)
$key++;
$modversion['config'][$key]['name'] = 'imgthumbwdith';
$modversion['config'][$key]['title'] = '_MI_AMR_IMGTHUMBWIDTH';
$modversion['config'][$key]['description'] = '_MI_AMR_IMGTHUMBWIDTHDSC';
$modversion['config'][$key]['formtype'] = 'textbox';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '120';

// show/hide showsubcats
$key++;
$modversion['config'][$key]['name'] = 'showsubcats';
$modversion['config'][$key]['title'] = '_MI_AMR_SHOWSUBCATS';
$modversion['config'][$key]['description'] = '_MI_AMR_SHOWSUBCATSDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 1;

// show/hide cats for people who do not have permission to view.
$key++;
$modversion['config'][$key]['name'] = 'hidenopermcats';
$modversion['config'][$key]['title'] = '_MI_AMR_HIDENOPERMCATS';
$modversion['config'][$key]['description'] = '_MI_AMR_HIDENOPERMCATSDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 0;

// Default page title options.
$key++;
$modversion['config'][$key]['name'] = 'pagettldefault';
$modversion['config'][$key]['title'] = '_MI_AMR_PAGETTLDEF';
$modversion['config'][$key]['description'] = '_MI_AMR_PAGETTLDEFDSC';
$modversion['config'][$key]['formtype'] = 'select';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '0';
$modversion['config'][$key]['options'] = ['_MI_AMR_PAGETTLDEF_OPT_0' => '0', '_MI_AMR_PAGETTLDEF_OPT_1' => '1', '_MI_AMR_PAGETTLDEF_OPT_2' => '2'];

// Default page meta tag options
$key++;
$modversion['config'][$key]['name'] = 'pagemetadefault';
$modversion['config'][$key]['title'] = '_MI_AMR_PAGEMETADEF';
$modversion['config'][$key]['description'] = '_MI_AMR_PAGEMETADEFDSC';
$modversion['config'][$key]['formtype'] = 'select';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '0';
$modversion['config'][$key]['options'] = ['_MI_AMR_PAGEMETADEF_OPT_0' => '0', '_MI_AMR_PAGEMETADEF_OPT_1' => '1']; //, '_MI_AMR_PAGEMETADEF_OPT_2' => '2');

// Logged in to vote
$key++;
$modversion['config'][$key]['name'] = 'loggedinvote';
$modversion['config'][$key]['title'] = '_MI_AMR_LOGGEDINVOTE';
$modversion['config'][$key]['description'] = '_MI_AMR_LOGGEDINVOTEDSC';
$modversion['config'][$key]['formtype'] = 'yesno';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = 0;

// Default page meta tag options
$key++;
$modversion['config'][$key]['name'] = 'hiliteimg';
$modversion['config'][$key]['title'] = '_MI_AMR_HILITEIMG';
$modversion['config'][$key]['description'] = '_MI_AMR_HILITEIMGDSC';
$modversion['config'][$key]['formtype'] = 'select';
$modversion['config'][$key]['valuetype'] = 'int';
$modversion['config'][$key]['default'] = '1';
$modversion['config'][$key]['options'] = ['_MI_AMR_HILITEIMG_OPT_0' => '0', '_MI_AMR_HILITEIMG_OPT_1' => '1']; //, '_MI_AMR_PAGEMETADEF_OPT_2' => '2');

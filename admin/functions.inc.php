<?php

// $Id: functions.inc.php,v 1.5 2007/01/24 19:15:59 andrew Exp $
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

// includes
//require_once "header.php";

/**
 * This file holds admin functions only.
 * @param mixed $currentoption
 * @param mixed $breadcrumb
 */

/**
 * Admin header.
 * @param $currentoption
 * @param $breadcrumb
 */
function amrev_adminmenu($currentoption, $breadcrumb)
{
    global $xoopsModule, $xoopsConfig;

    /* Nice buttons styles */

    echo "
    	<style type='text/css'>
    	#buttontop { float:left; width:100%; background: #e7e7e7; font-size:93%; line-height:normal; border-top: 1px solid black; border-left: 1px solid black; border-right: 1px solid black; margin: 0; }
    	#buttonbar { float:left; width:100%; background: #e7e7e7 url('" . XOOPS_URL . '/modules/' . _AM_AMRMODDIR . "/images/bg.png') repeat-x left bottom; font-size:93%; line-height:normal; border-left: 1px solid black; border-right: 1px solid black; margin-bottom: 12px; }
    	#buttonbar ul { margin:0; margin-top: 15px; padding:10px 10px 0; list-style:none; }
		#buttonbar li { display:inline; margin:0; padding:0; }
		#buttonbar a { float:left; background:url('" . XOOPS_URL . '/modules/' . _AM_AMRMODDIR . "/images/left_both.png') no-repeat left top; margin:0; padding:0 0 0 9px; border-bottom:1px solid #000; text-decoration:none; }
		#buttonbar a span { float:left; display:block; background:url('" . XOOPS_URL . '/modules/' . _AM_AMRMODDIR . "/images/right_both.png') no-repeat right top; padding:5px 15px 4px 6px; font-weight:bold; color:#765; }
		/* Commented Backslash Hack hides rule from IE5-Mac \*/
		#buttonbar a span {float:none;}
		/* End IE5-Mac hack */
		#buttonbar a:hover span { color:#333; }
		#buttonbar #current a { background-position:0 -150px; border-width:0; }
		#buttonbar #current a span { background-position:100% -150px; padding-bottom:5px; color:#333; }
		#buttonbar a:hover { background-position:0% -150px; }
		#buttonbar a:hover span { background-position:100% -150px; }
		</style>
    ";

    $tblColors = [];

    $tblColors[0] = $tblColors[1] = $tblColors[2] = $tblColors[3] = $tblColors[4] = $tblColors[5] = $tblColors[6] = $tblColors[7] = $tblColors[8] = '';

    //$tblColors[$currentoption] = 'current';

    if ($currentoption >= 0) {
        $tblColors[$currentoption] = 'current';
    }

    if (file_exists(XOOPS_ROOT_PATH . '/modules/' . _AM_AMRMODDIR . '/language/' . $xoopsConfig['language'] . '/modinfo.php')) {
        require_once XOOPS_ROOT_PATH . '/modules/' . _AM_AMRMODDIR . '/language/' . $xoopsConfig['language'] . '/modinfo.php';
    } else {
        require_once XOOPS_ROOT_PATH . '/modules/' . _AM_AMRMODDIR . '/language/english/modinfo.php';
    }

    echo "<div id='buttontop'>";

    echo '<table border="0" style="width: 100%; padding: 0; " cellspacing="0"><tr>';

    echo '<td style="width: 60%; font-size: 10px; text-align: left; color: #2F5376; padding: 0 6px; line-height: 18px;"><a class="nobutton" href="../../system/admin.php?fct=preferences&amp;op=showmod&amp;mod='
         . $xoopsModule->getVar('mid')
         . '">'
         . _AM_AMREV_GENERALSET
         . '</a> | <a href="../index.php">'
         . _AM_AMREV_GOTOMOD
         . '</a> | <a href="about.php">'
         . _AM_AMREV_ABOUT
         . '</a> | <a href="#">'
         . _AM_AMREV_HELP
         . '</a></td>';

    echo '<td style="width: 40%; font-size: 10px; text-align: right; color: #2F5376; padding: 0 6px; line-height: 18px;"><b>' . $xoopsModule->name() . '  ' . _AM_AMREV_MODULEADMIN . '</b> ' . $breadcrumb . '</td>';

    echo '</tr></table>';

    echo '</div>';

    echo "<div id='buttonbar'>";

    echo '<ul>';

    echo "<li id='" . $tblColors[0] . "'><a href=\"index.php\"\"><span>" . _AM_AMREV_INDEX . "</span></a></li>\n";

    echo "<li id='" . $tblColors[1] . "'><a href=\"category.php\"><span>" . _AM_AMREV_CAT . "</span></a></li>\n";

    echo "<li id='" . $tblColors[2] . "'><a href=\"review.php\"><span>" . _AM_AMREV_REVIEWS . "</span></a></li>\n";

    echo "<li id='" . $tblColors[3] . "'><a href=\"image.php\"><span>" . _MI_AMREV_IMAGES . "</span></a></li>\n";

    echo "<li id='" . $tblColors[4] . "'><a href=\"perms.php\"><span>" . _AM_AMREV_PERMS . "</span></a></li>\n";

    //echo "<li id='" . $tblColors[5] . "'><a href=\"index.php\"><span>" . _MI_ . "</span></a></li>\n";

    //echo "<li id='" . $tblColors[6] . "'><a href=\"index.php\"><span>" . _MI_ . "</span></a></li>\n";

    echo '</ul></div>';

    echo '<br><br><pre>&nbsp;</pre><pre>&nbsp;</pre>';
} // end function

//----------------------------------------------------------------------------//

function amrev_adminfooter()
{
    global $xoopsModule;

    echo '<span style="font-size: smaller;">';

    echo '<br>';

    //echo $xoopsModule->getVar('name') . ", version " . round($xoopsModule->getVar('version')/100 , 2) . "<br>";

    echo $xoopsModule->getVar('name') . ', version ' . _AM_AMRVERSION . '<br>';

    echo 'Updates are available from <a href="http://support.sirium.net" target="_blank">http://support.sirium.net</a>';

    echo '</span>';
} // end functions

//----------------------------------------------------------------------------//

/**
 * Do some basic file checks and stuff.
 */
function amr_filechecks()
{
    global $xoopsModule, $xoopsConfig;

    echo '<fieldset>';

    echo '<legend style="color: #990000; font-weight: bold;">' . _AM_AMREV_FILECHECKS . '</legend>';

    $photodir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/photos';

    $photothumbdir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/photos/thumb';

    $photohighdir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/photos/highlight';

    $cachedir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/cache';

    $tmpdir = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar('dirname') . '/cache/tmp';

    if (file_exists($photodir)) {
        if (!is_writable($photodir)) {
            echo '<span style=" color: red; font-weight: bold;">Warning:</span> I am unable to write to: ' . $photodir . '<br>';
        } else {
            echo '<span style=" color: green; font-weight: bold;">OK:</span> ' . $photodir . '<br>';
        }
    } else {
        echo '<span style=" color: red; font-weight: bold;">Warning:</span> ' . $photodir . ' does NOT exist!<br>';
    }

    // photothumbdir

    if (file_exists($photothumbdir)) {
        if (!is_writable($photothumbdir)) {
            echo '<span style=" color: red; font-weight: bold;">Warning:</span> I am unable to write to: ' . $photothumbdir . '<br>';
        } else {
            echo '<span style=" color: green; font-weight: bold;">OK:</span> ' . $photothumbdir . '<br>';
        }
    } else {
        echo '<span style=" color: red; font-weight: bold;">Warning:</span> ' . $photothumbdir . ' does NOT exist!<br>';
    }

    // photohighdir

    if (file_exists($photohighdir)) {
        if (!is_writable($photohighdir)) {
            echo '<span style=" color: red; font-weight: bold;">Warning:</span> I am unable to write to: ' . $photohighdir . '<br>';
        } else {
            echo '<span style=" color: green; font-weight: bold;">OK:</span> ' . $photohighdir . '<br>';
        }
    } else {
        echo '<span style=" color: red; font-weight: bold;">Warning:</span> ' . $photohighdir . ' does NOT exist!<br>';
    }

    // cachedir

    if (file_exists($cachedir)) {
        if (!is_writable($cachedir)) {
            echo '<span style=" color: red; font-weight: bold;">Warning:</span> I am unable to write to: ' . $cachedir . '<br>';
        } else {
            echo '<span style=" color: green; font-weight: bold;">OK:</span> ' . $cachedir . '<br>';
        }
    } else {
        echo '<span style=" color: red; font-weight: bold;">Warning:</span> ' . $cachedir . ' does NOT exist!<br>';
    }

    // tmpdir

    if (file_exists($tmpdir)) {
        if (!is_writable($tmpdir)) {
            echo '<span style=" color: red; font-weight: bold;">Warning:</span> I am unable to write to: ' . $tmpdir . '<br>';
        } else {
            echo '<span style=" color: green; font-weight: bold;">OK:</span> ' . $tmpdir . '<br>';
        }
    } else {
        echo '<span style=" color: red; font-weight: bold;">Warning:</span> ' . $tmpdir . ' does NOT exist!<br>';
    }

    /**
     * Some info.
     */

    $uploads = (ini_get('file_uploads')) ? _AM_AMREV_UPLOAD_ON : _AM_AMREV_UPLOAD_OFF;

    echo '<br>';

    echo '<ul>';

    echo '<li>' . _AM_AMREV_UPLOADMAX . '<b>' . ini_get('upload_max_filesize') . '</b></li>';

    echo '<li>' . _AM_AMREV_POSTMAX . '<b>' . ini_get('post_max_size') . '</b></li>';

    echo '<li>' . _AM_AMREV_UPLOADS . '<b>' . $uploads . '</b></li>';

    $gdinfo = gd_info();

    if (function_exists('gd_info')) {
        echo '<li>' . _AM_AMREV_GDIMGSPPRT . '<b>' . _AM_AMREV_GDIMGON . '</b></li>';

        echo '<li>' . _AM_AMREV_GDIMGVRSN . '<b>' . $gdinfo['GD Version'] . '</b></li>';
    } else {
        echo '<li>' . _AM_AMREV_GDIMGSPPRT . '<b>' . _AM_AMREV_GDIMGOFF . '</b></li>';
    }

    echo '</ul>';

    //$inithingy = ini_get_all();

    //print_r($inithingy);

    echo '</fieldset>';
} // end function

//----------------------------------------------------------------------------//

function amr_summary()
{
    global $xoopsDB;

    // amreview_reviews - amreview_cat - amreview_rate

    $summary = [];

    /**
     * As many of these will be "joined" at some point.
     */

    /**
     * Review count (total)
     */

    $result = $xoopsDB->query('SELECT COUNT(id) AS revcount FROM ' . $xoopsDB->prefix('amreview_reviews') . ' ');

    [$revcount] = $xoopsDB->fetchRow($result); // {

    if (!$result) {
        $summary['revcount'] = 0;
    } else {
        $summary['revcount'] = $revcount;
    }

    /**
     * Waiting validation.
     */

    $result2 = $xoopsDB->query('SELECT COUNT(id) AS waitval FROM ' . $xoopsDB->prefix('amreview_reviews') . " WHERE validated='0'");

    [$waitval] = $xoopsDB->fetchRow($result2); // {

    if ($waitval < 1) {
        $summary['waitval'] = '<span style="font-weight: bold;">0</span>';
    } else {
        $summary['waitval'] = '<span style="font-weight: bold; color: red;">' . $waitval . '</span>';
    }

    /**
     * Category count (total)
     */

    $result = $xoopsDB->query('SELECT COUNT(id) AS catcount FROM ' . $xoopsDB->prefix('amreview_cat') . ' ');

    [$catcount] = $xoopsDB->fetchRow($result); // {

    if (!$result) {
        $summary['catcount'] = 0;
    } else {
        $summary['catcount'] = $catcount;
    }

    unset($result);

    /**
     * Views count (total)
     */

    $result = $xoopsDB->query('SELECT SUM(views) AS views FROM ' . $xoopsDB->prefix('amreview_reviews') . ' ');

    [$views] = $xoopsDB->fetchRow($result); // {

    if (!$result) {
        $summary['views'] = 0;
    } else {
        $summary['views'] = $views;
    }

    unset($result);

    /**
     * Published (total)
     */

    $result = $xoopsDB->query('SELECT count(id) AS published FROM ' . $xoopsDB->prefix('amreview_reviews') . " WHERE showme='1' AND validated='1'");

    [$published] = $xoopsDB->fetchRow($result); // {

    if (!$result) {
        $summary['published'] = 0;
    } else {
        $summary['published'] = $published;
    }

    unset($result);

    /**
     * Hidden (total)
     */

    $result = $xoopsDB->query('SELECT count(id) AS hidden FROM ' . $xoopsDB->prefix('amreview_reviews') . " WHERE showme='0' OR validated='0'");

    [$hidden] = $xoopsDB->fetchRow($result); // {

    if (!$result) {
        $summary['hidden'] = 0;
    } else {
        $summary['hidden'] = $hidden;
    }

    unset($result);

    //print_r($summary);

    return $summary;
} // end function

//----------------------------------------------------------------------------//

################################################################################
# Get form wysiwyg editor - based on function in news 1.4(?), and sampleform.inc.php.
# Width & height passed through are for 2.0.* version.
function amreviews_getwysiwygform($caption, $name, $value = '', $width = '100%', $height = '400px', $formrows = '20', $formcols = '50', $config = '')
{
    global $xoopsModuleConfig;

    $editor = false;

    $x22 = false;

    $xv = str_replace('XOOPS ', '', XOOPS_VERSION);

    if ('2' == mb_substr($xv, 2, 1)) {
        $x22 = true;
    }

    // options for the editor

    //required configs

    $editor_options['name'] = $name;

    $editor_options['value'] = $value;

    //optional configs
    $editor_options['rows'] = $formrows; // default value = 5
    $editor_options['cols'] = $formcols; // default value = 50
    $editor_options['width'] = $width; // default value = 100%
    $editor_options['height'] = $height; // default value = 400px

    // Want to choose which editor config to use, depending on whether user or admin side.

    if ('user' == $config) {
        $whichconfig = $xoopsModuleConfig['articleedituser'];
    } else {
        $whichconfig = $xoopsModuleConfig['amrevieweditadmin'];
    }

    switch ($whichconfig) {
        case '0': // xoops' default dhtml
            if (!$x22) {
                $editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['cols']);

            #}
            } else {
                $editor = new XoopsFormEditor($caption, 'dhtml', $editor_options);
            }

           break;
        case '1': // spaw
            if (!$x22) {
                if (is_readable(XOOPS_ROOT_PATH . '/class/spaw/formspaw.php')) {
                    require_once XOOPS_ROOT_PATH . '/class/spaw/formspaw.php';

                    $editor = new XoopsFormSpaw($caption, $name, $value, $width, $height);
                } else {
                    $editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
                }
            } else {
                $editor = new XoopsFormEditor($caption, 'spaw', $editor_options);
            }

           break;
        case '2': // fck editor
            if (!$x22) {
                if (is_readable(XOOPS_ROOT_PATH . '/class/fckeditor/formfckeditor.php')) {
                    require_once XOOPS_ROOT_PATH . '/class/fckeditor/formfckeditor.php';

                    $editor = new XoopsFormFckeditor($caption, $name, $value, $width, $height);
                } else {
                    $editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
                }
            } else {
                $editor = new XoopsFormEditor($caption, 'fckeditor', $editor_options);
            }

           break;
        case '3': // htmlarea
            if (!$x22) {
                if (is_readable(XOOPS_ROOT_PATH . '/class/htmlarea/formhtmlarea.php')) {
                    require_once XOOPS_ROOT_PATH . '/class/htmlarea/formhtmlarea.php';

                    $editor = new XoopsFormHtmlarea($caption, $name, $value, $width, $height);
                } else {
                    $editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
                }
            } else {
                $editor = new XoopsFormEditor($caption, 'htmlarea', $editor_options);
            }

           break;
        case '4': // koivi (edkoivipath)
            if (!$x22) {
                if (is_readable(XOOPS_ROOT_PATH . '/class/koivi/formwysiwygtextarea.php')) {
                    require_once XOOPS_ROOT_PATH . '/class/koivi/formwysiwygtextarea.php';

                    $editor = new XoopsFormWysiwygTextArea($caption, $name, $value, $width, $height);
                } else {
                    $editor = new XoopsFormDhtmlTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
                }
            } else {
                $editor = new XoopsFormEditor($caption, 'koivi', $editor_options);
            }

           break;
        case '5': // xoops compact/textarea
            if (!$x22) {
                $editor = new XoopsFormTextArea($caption, $name, $value, $editor_options['rows'], $editor_options['width']);
            } else {
                $editor = new XoopsFormTextArea($caption, $name, $editor_options);
            }

           break;
    } // end switch

    return $editor;
} // end

//----------------------------------------------------------------------------//

/**
 * See if an image file is in use by a review.
 * @param mixed $image_file
 * @return int|mixed
 * @return int|mixed
 */
function amr_checkImageInUse($image_file = '')
{
    global $xoopsDB;

    $sql = ('SELECT COUNT(image_file) AS count FROM ' . $xoopsDB->prefix('amreview_reviews') . " WHERE image_file='" . $image_file . "'");

    $result = $xoopsDB->query($sql);

    if ($xoopsDB->getRowsNum($result) > 0) {
        while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
            $count = $myrow['count'];
        }
    } else {
        $count = 0;
    }

    return $count;
} // end function

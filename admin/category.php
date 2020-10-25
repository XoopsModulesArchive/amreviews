<?php

// $Id: category.php,v 1.4 2007/01/24 19:15:59 andrew Exp $
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
require dirname(__DIR__, 3) . '/include/cp_header.php';
if (file_exists('../language/' . $xoopsConfig['language'] . '/main.php')) {
    include '../language/' . $xoopsConfig['language'] . '/main.php';
} else {
    include '../language/english/main.php';
}
require_once 'functions.inc.php';
require_once '../include/config.inc.php';
require_once XOOPS_ROOT_PATH . '/class/xoopstree.php';

$myts = MyTextSanitizer::getInstance();

//----------------------------------------------------------------------------//

if (!isset($_REQUEST['op'])) {
    xoops_cp_header();

    amrev_adminmenu(1, _AM_AMREV_CAT);

    /**
     * List categories
     */

    $class = '';

    echo '<table border="0" width="100%" cellspacing="1" class="outer">';

    echo '<tr><th colspan="5">' . _AM_AMREV_CATTBLCAP . '</th></td>';

    ##

    ##

    //$start = isset($_GET['start']) ? intval($_GET['start']) : 0;

    $start = 0;

    // Based on code from news 1.4

    // See news/admin/index.php line 610 on

    $xt = new XoopsTree($xoopsDB->prefix('amreview_cat'), 'id', 'cat_parentid');

    $cats_arr = $xt->getChildTreeArray(0, 'cat_title');

    $totalcats = count($cats_arr);

    $rowclass = '';

    //echo "<pre>";

    //var_dump($xt);

    //var_dump($cats_arr);

    //echo "</pre>";

    $tmpcpt = $start;

    $ok = true;

    while ($ok) {
        if ($tmpcpt < $totalcats) {
            $rowclass = ('odd' == $rowclass) ? 'even' : 'odd';

            echo '<tr>';

            echo '<td style="text-align: center; width: 20px;" class="' . $rowclass . '">' . $cats_arr[$tmpcpt]['id'] . '</td>';

            if (0 != $cats_arr[$tmpcpt]['cat_parentid']) {
                $cats_arr[$tmpcpt]['prefix'] = str_replace('.', '-', $cats_arr[$tmpcpt]['prefix']) . '&nbsp;';

            //echo "thing1";
            } else {
                $cats_arr[$tmpcpt]['prefix'] = str_replace('.', '', $cats_arr[$tmpcpt]['prefix']);

                //echo "thing2";
            }

            echo '<td class="' . $rowclass . '">' . $cats_arr[$tmpcpt]['prefix'] . $cats_arr[$tmpcpt]['cat_title'] . '</td>';

            if (1 == $cats_arr[$tmpcpt]['cat_showme']) {
                $bulb = 'bulb-yell.png';

                $alttxt = _AM_AMREV_STATUSSHOW;
            } else {
                $bulb = 'bulb-grey.png';

                $alttxt = _AM_AMREV_STATUSHIDE;
            }

            echo '<td style="text-align: center; width: 20px;" class="' . $rowclass . '"><img src="../images/' . $bulb . '" title="' . $alttxt . '" alt="' . $alttxt . '"></td>';

            echo '<td style="text-align: center; width: 20px;" class="' . $rowclass . '"><a href="' . $_SERVER['PHP_SELF'] . '?op=edit&amp;id=' . $cats_arr[$tmpcpt]['id'] . '"><img src="/modules/amreviews/images/edit3.png" title="Click to edit"></a></td>';

            echo '<td style="text-align: center; width: 20px;" class="' . $rowclass . '"><a href="' . $_SERVER['PHP_SELF'] . '?op=del&amp;id=' . $cats_arr[$tmpcpt]['id'] . '"><img src="/modules/amreviews/images/del3.png" title="Click to delete"></a></td>';

            echo '</tr>';

        //$rowclass = ($rowclass == 'even') ? 'odd' : 'even';
        } else {
            $ok = false;
        }

        //echo $tmpcpt ."<br>";

        $tmpcpt++;
    } // while

    echo '</table><br><br>';

    /**
     * Load category form to add new.
     */

    $catformcaption = _AM_AMREV_CATCAPTION;

    $submitbutton = _AM_AMREV_CATCAPSAVE;

    $formaction = 'add';

    require_once 'catform.inc.php';

    amrev_adminfooter();

    xoops_cp_footer();
} // end if

//----------------------------------------------------------------------------//

/**
 * Save new category data.
 */
if (isset($_REQUEST['op']) and 'save' == $_REQUEST['op']) {
    xoops_cp_header();

    //amrev_adminmenu(1, _AM_AMREV_CAT);

    $formdata = $_POST['formdata'] ?? '';

    //echo "<pre>";

    //print_r($formdata);

    //echo "</pre>";

    $cat_title = $myts->addSlashes($formdata['cat_title']);

    $cat_description = $myts->addSlashes($formdata['cat_description']);

    $cat_parentid = (int)$formdata['cat_id'];

    $cat_weight = (int)$formdata['cat_weight'];

    $cat_showme = (int)$formdata['cat_showme'];

    $sql = 'INSERT INTO ' . $xoopsDB->prefix('amreview_cat') . " VALUES (
			NULL, 
			'$cat_parentid', 
			'$cat_title', 
			'$cat_description', 
			'$cat_weight',
			'$cat_showme' )";

    $xoopsDB->query($sql); // or $eh->show("0013");

    if ($xoopsDB->getAffectedRows($sql)) {
        redirect_header('category.php', 2, _AM_AMREV_DBUPDATED);

    //echo "entered";
    } else {
        redirect_header('category.php', 2, _AM_AMREV_DBNOUPDATED);

        //echo "not entered";
    }

    xoops_cp_footer();
} // end if

//----------------------------------------------------------------------------//

/**
 * Save new category data.
 */
if (isset($_REQUEST['op']) and 'edit' == $_REQUEST['op']) {
    //xoops_cp_header();

    //amrev_adminmenu(1, _AM_AMREV_CAT);

    /**
     * Load form if subop not set.
     */

    if (!isset($_REQUEST['subop'])) {
        xoops_cp_header();

        //amrev_adminmenu(1, _AM_AMREV_CAT);

        $id = $_GET['id'] ?? '';

        $result = $xoopsDB->query('SELECT id, cat_parentid, cat_title, cat_description, cat_weight, cat_showme  FROM ' . $xoopsDB->prefix('amreview_cat') . " WHERE id=$id LIMIT 1");

        [$id, $cat_parentid, $cat_title, $cat_description, $cat_weight, $cat_showme] = $xoopsDB->fetchRow($result);

        $cat_title = htmlspecialchars($cat_title, ENT_QUOTES | ENT_HTML5);

        $cat_description = htmlspecialchars($cat_description, ENT_QUOTES | ENT_HTML5);

        //$cat_weight

        // form stuff (edit)

        $catformcaption = _AM_AMREV_CATCAPTIONED;

        $submitbutton = _AM_AMREV_CATCAPSAVEED;

        $formaction = 'edit';

        require_once 'catform.inc.php';

        xoops_cp_footer();
    } // end if

    /**
     * Save update if subop set.
     */

    if (isset($_REQUEST['subop']) and 'save' == $_REQUEST['subop']) {
        xoops_cp_header();

        $formdata = $_POST['formdata'] ?? '';

        //echo "<pre>";

        //print_r($formdata);

        //echo "</pre>";

        $id = (int)$formdata['id'];

        $cat_parentid = (int)$formdata['cat_id'];

        $cat_title = $myts->addSlashes($formdata['cat_title']);

        $cat_description = $myts->addSlashes($formdata['cat_description']);

        $cat_weight = (int)$formdata['cat_weight'];

        $cat_showme = (int)$formdata['cat_showme'];

        $sql = ('UPDATE ' . $xoopsDB->prefix('amreview_cat') . " SET 
				id = '$id', 
				cat_parentid	= '$cat_parentid', 
				cat_title		= '$cat_title', 
				cat_description	= '$cat_description', 
				cat_weight		= '$cat_weight',
				cat_showme		= '$cat_showme' 
				WHERE id=$id");

        $result = $xoopsDB->query($sql);

        if ($xoopsDB->query($sql)) {
            redirect_header('category.php', 2, _AM_AMREV_DBUPDATED);

        //echo "entered";
        } else {
            redirect_header('category.php', 2, _AM_AMREV_DBNOUPDATED);

            //echo "not entered";
        }

        xoops_cp_footer();
    } // end if

    //xoops_cp_footer();
} // end if

//----------------------------------------------------------------------------//

/**
 * Delete category.
 */
if (isset($_REQUEST['op']) and 'del' == $_REQUEST['op']) {
    //xoops_cp_header();

    //amrev_adminmenu(1, _AM_AMREV_CAT);

    if (isset($_REQUEST['id'])) {
        $id = (int)$_REQUEST['id'];
    } else {
        $id = '';
    }

    /**
     * Confirm deletion.
     */

    if (!isset($_REQUEST['subop'])) {
        xoops_cp_header();

        xoops_confirm(['op' => 'del', 'id' => $id, 'subop' => 'delok'], 'category.php', _AM_AMREV_DBCONFMDEL);

        xoops_cp_footer();
    } // end if

    /**
     * Delete
     */

    if (isset($_REQUEST['subop']) && 'delok' == $_REQUEST['subop']) {
        $sql = sprintf('DELETE FROM %s WHERE id = %u', $xoopsDB->prefix('amreview_cat'), $id);

        if ($xoopsDB->queryF($sql)) {
            // Delete permissions.

            xoops_groupperm_deletebymoditem($xoopsModule->getVar('mid'), 'Category Permission', $id);

            redirect_header('category.php', 2, _AM_AMREV_DBDELETED);

        //echo "deleted";
        } else {
            redirect_header('category.php', 2, _AM_AMREV_DBNOTDELETED);

            //echo "not deleted";
        }
    }
} // end if

<?php

// $Id: email.php,v 1.2 2007/01/24 19:24:31 andrew Exp $
//  ------------------------------------------------------------------------ //
//  Author: Andrew Mills                                                     //
//  Email:  ajmills@sirium.net                                         //
//	About:  This file is part of the Articles module for Xoops v2.           //
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

require_once __DIR__ . '/header.php';
require_once __DIR__ . '/include/functions.inc.php';
$myts = MyTextSanitizer::getInstance();

//
//----------------------------------------------------------------------------//
// Define a few vars
$isregged = 0;
$uname = '';
$uemail = '';

//
//----------------------------------------------------------------------------//
// check if email feature is allowed.
if (1 != $xoopsModuleConfig['allowemail']) {
    redirect_header(XOOPS_URL . '/modules/' . $xoopsModule->getVar('dirname') . '/index.php', 2, _MD_NOACCESSHERE);

    exit();
}

//
//----------------------------------------------------------------------------//
// Check if logged in
if (1 == $xoopsModuleConfig['emailtofriendlogin']) {
    if (empty($xoopsUser)) {
        //redirect_header("index.php", 2, _MD_LOGGEDIN);

        redirect_header(XOOPS_URL . '/user.php', 2, _MD_LOGGEDIN);

        exit();
    }

    $isregged = 1; // set is registered flag

    $uname = $xoopsUser->getVar('uname', 'E');

    $uemail = $xoopsUser->getVar('email', 'E');
}

//
//----------------------------------------------------------------------------//
// Stop if max characters exceeded.
if (isset($_POST['formdata'])) {
    $formdata = $_POST['formdata'];

    if (mb_strlen($formdata['message']) > $xoopsModuleConfig['emailtofreindchars']) {
        redirect_header(XOOPS_URL . 'index.php', 2, _MD_EMLMAXCHARS);

        exit();
    }
}

//
//----------------------------------------------------------------------------//
//
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // this page uses smarty template

    // this must be set before including main header.php

    $GLOBALS['xoopsOption']['template_main'] = 'article_email.html';

    require XOOPS_ROOT_PATH . '/header.php';

    $xoopsTpl->assign('form', 'start'); // switch for template section
    $xoopsTpl->assign('regged', $isregged); // switch for when user is registered or not
    $xoopsTpl->assign('uname', $uname); // user name
    $xoopsTpl->assign('uemail', $uemail); // user's email
    $xoopsTpl->assign('headtitle', _MD_EMAILHEADTTL);

    $xoopsTpl->assign('yourname', _MD_EMAILYOURNAME);

    $xoopsTpl->assign('youremail', _MD_EMAILYOUREMAIL);

    $xoopsTpl->assign('recipient', _MD_EMAILRECIPIENT);

    $xoopsTpl->assign('emailmsg', _MD_EMAILMESSAGE);

    $xoopsTpl->assign('emailmsgdsc', _MD_EMAILMESSAGEDESC);

    $xoopsTpl->assign('emailsend', _MD_EMAILSEND);

    $xoopsTpl->assign('emailreset', _MD_EMAILSET);

    $xoopsTpl->assign('emailsecnote', _MD_EMAILSECNOTE);

    // Allow email - despite the redirect above to stop usage of the e-mail page, the

    // following line (and relevant code in template) prevents form being shown.

    $xoopsTpl->assign('email_allow', $xoopsModuleConfig['allowemail']);

    $xoopsTpl->assign('email_allowown', $xoopsModuleConfig['emailtofriendownmsg']); // switch for message box
    $xoopsTpl->assign('maxchars', $xoopsModuleConfig['emailtofreindchars']); // max number of chars

    $sql = ('SELECT * FROM ' . $xoopsDB->prefix('articles_main') . " WHERE id = $id LIMIT 1");

    $result = $xoopsDB->query($sql);

    $myrow = $xoopsDB->fetchArray($result);

    $email = [];

    $email['id'] = $myrow['id'];  //= htmlspecialchars($myrow['cat_name']);
    $email['title'] = $myrow['art_title'];   //htmlspecialchars($myrow['cat_description']);

    $xoopsTpl->append('email', $email);

    unset($email);
} // end if

//
//----------------------------------------------------------------------------//
// process form data
if (isset($_POST['formdata'])) {
    $formdata = $_POST['formdata'];

    $id = $formdata['id'];

    //print_r($formdata);

    $GLOBALS['xoopsOption']['template_main'] = 'article_email.html';

    require XOOPS_ROOT_PATH . '/header.php';

    $xoopsTpl->assign('form', 'sent'); // switch for template section
    $xoopsTpl->assign('email_allowown', $xoopsModuleConfig['emailtofriendownmsg']); // switch for message box
    $xoopsTpl->assign('headtitle', _MD_EMAILHEADTTL);

    $xoopsTpl->assign('recipient', _MD_EMAILRECIPIENT);

    $xoopsTpl->assign('emailmsg', _MD_EMAILMESSAGE);

    /*
    $sql = ("SELECT * FROM " . $xoopsDB->prefix("articles_main") . " WHERE id = $id LIMIT 1");
    $result=$xoopsDB->query($sql);

    $myrow = $xoopsDB->fetchArray($result);
    */

    $emailsend = [];

    #$emailsend['id']			= $myrow['id'];  //= htmlspecialchars($myrow['cat_name']);

    #$emailsend['title']			= $myrow['art_title'];   //htmlspecialchars($myrow['cat_description']);

    $emailsend['recipient'] = $formdata['recipient'];

    $emailsend['message'] = stripslashes($myts->displayTarea($formdata['message'], 0, 0, 1, 0, 1));

    #$emailsend['message']   = stripslashes($myts->displayTarea($formmessage, 0, 0, 0, 0, 1));

    $emailsend['name'] = $formdata['name'];

    $emailsend['email'] = $formdata['email'];

    #$xoopsTpl->append('email', $emailsend);

    #unset($emailsend);

    // grab prefs.

    /*
    $sql2 = ("SELECT * FROM " . $xoopsDB->prefix("articles_prefs") . " WHERE id=1 LIMIT 1");
    $result2=$xoopsDB->query($sql2);
        $myrow2 = $xoopsDB->fetchArray($result2);

        $email_subject	= $myrow2['email_subject'];
        $email_text		= $myrow2['email_text'];
    */

    // Get subject and e-mail text

    $email_subject = $xoopsModuleConfig['emailtofreindsubect'];

    $email_text = $xoopsModuleConfig['emailtext'];

    // actual mail stuff

    #$headers  = "From: " . $mailfrom . "\r\n";

    $headers = 'From: ' . $emailsend['name'] . '<' . $emailsend['email'] . ">\r\n";

    $headers .= "X-mailer: Articles - XOOPS v2 module at XOOPS_URL.\r\n";

    // Convert any HTML entities that may exist in user's text into their actual

    // characters. Use "user_text" var to prevent probs with thingy.

    // Updated 14/3/04 to add support for HTML entity decode for PHP versions

    // older than 4.3.0.

    if (PHP_VERSION >= '4.3.0') {
        $user_text = html_entity_decode($emailsend['message'], ENT_QUOTES);

    #echo PHP_VERSION;
    } else {
        $user_text = htmlentitydecode($emailsend['message']);

        #echo PHP_VERSION;
    }

    // Then convert any HTML line breaks to text and remove slashes

    $user_text = preg_replace("/<br \>/i", "\r\n", $user_text);

    // Insert user's own message into the e-mail text from the DB

    // {USER_MESSAGE} is the search string.

    $message = preg_replace('/{USER_MESSAGE}/', $user_text, $email_text);

    // Replace {USER_IP} with user's IP address.

    $message = preg_replace('/{USER_IP}/', $_SERVER['REMOTE_ADDR'], $message);

    // Replace {USER_BROWSER} with user's browser info.

    $message = preg_replace('/{USER_BROWSER}/', $_SERVER['HTTP_USER_AGENT'], $message);

    // Replace {SITE_URL} with XOOPS generated URL of site.

    $message = preg_replace('/{SITE_URL}/', XOOPS_URL, $message);

    // Replace {SITE_NAME} with name of site defined in XOOPS' config.

    $message = preg_replace('/{SITE_NAME}/', $xoopsConfig['sitename'], $message);

    // Replace {USER_TIME} with date and time

    $message = preg_replace('/{USER_TIME}/', formatTimestamp(mktime(), 'rss'), $message);

    // Replace {ARTICLE_URL} with URL to article.

    $message = preg_replace('/{ARTICLE_URL}/', XOOPS_URL . '/modules/articles/article.php?id=' . $id, $message);

    // Replace {ADMIN_EMAIL} with admin email

    $message = preg_replace('/{ADMIN_EMAIL}/', $xoopsConfig['adminmail'], $message);

    // Wordwrap e-mail to 72 characters and use \r\n to wrap in plain text.

    $message = wordwrap($message, 72, "\r\n");

    // send the mail.

    #mail($emailsend['recipient'], $email_subject, $message, $headers);

    $xoopsMailer = getMailer();

    $xoopsMailer->useMail();

    $xoopsMailer->setToEmails($emailsend['recipient']);

    $xoopsMailer->setFromEmail($emailsend['email']);

    $xoopsMailer->setFromName($emailsend['name']);

    $xoopsMailer->setSubject($email_subject);

    $xoopsMailer->setBody($message);

    $xoopsMailer->send();

    $xoopsTpl->append('email', $emailsend);

    unset($emailsend);
} // end if

require XOOPS_ROOT_PATH . '/footer.php';

<?php

// $Id: makepdf.php,v 1.1 2007/01/24 19:24:50 andrew Exp $
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

// Based on makepdf.php (from news module) by phppp

error_reporting(0);
require_once 'header.php';
$myts = MyTextSanitizer::getInstance();
require_once 'fpdf/fpdf.inc.php';

/*
$storyid = isset($_GET['storyid']) ? intval($_GET['storyid']) : 0;

if (empty($storyid))  {
    redirect_header(XOOPS_URL.'/modules/news/index.php',2,_NW_NOSTORY);
    exit();
}

$article = new NewsStory($storyid);
// Not yet published
if ( $article->published() == 0 || $article->published() > time() ) {
    redirect_header(XOOPS_URL.'/modules/news/index.php', 2, _NW_NOSTORY);
    exit();
}

// Expired
if ( $article->expired() != 0 && $article->expired() < time() ) {
    redirect_header(XOOPS_URL.'/modules/news/index.php', 2, _NW_NOSTORY);
    exit();
}


$gpermHandler = xoops_getHandler('groupperm');
if (is_object($xoopsUser)) {
    $groups = $xoopsUser->getGroups();
} else {
    $groups = XOOPS_GROUP_ANONYMOUS;
}
if (!$gpermHandler->checkRight('news_view', $article->topicid(), $groups, $xoopsModule->getVar('mid'))) {
    redirect_header(XOOPS_URL.'/modules/news/index.php', 3, _NOPERM);
    exit();
}
*/

//----------------------------------------------------------------------------//

$sql = ('SELECT * FROM ' . $xoopsDB->prefix('amreview_reviews') . " WHERE (date_publish='0' OR " . time() . " > date_publish) AND (date_end='0' OR " . time() . " < date_end) AND validated='1' AND showme='1' AND id = '" . (int)$_GET['id'] . "'");
$result = $xoopsDB->query($sql);

if ($xoopsDB->getRowsNum($result) > 0) {
    while (false !== ($myrow = $xoopsDB->fetchArray($result))) {
        $id = $myrow['id'];

        $pdf_data['title'] = $myts->displayTarea($myrow['title'], 0, 0, 1, 0, 0);

        $pdf_data['subtitle'] = $myts->displayTarea($myrow['subtitle'], 0, 0, 1, 0, 0);

        $pdf_data['item_details'] = $myts->displayTarea($myrow['item_details'], 1, 1, 1, 1, 1);

        $pdf_data['review'] = $myts->displayTarea($myrow['review'], $myrow['nohtml'], $myrow['nosmiley'], $myrow['noxcode'], $myrow['noimage'], $myrow['nobr']);

        $pdf_data['date'] = formatTimestamp(strtotime($myrow['date']), $xoopsModuleConfig['dateformat']);

        $pdf_data['author'] = XoopsUser::getUnameFromId($myrow['uid'], 0);
    } // end while
}// end if

#$dateformat=news_getmoduleoption('dateformat');
#$article_data = $article->hometext() . $article->bodytext();
#$article_title = $article->title();
#$article_title = news_html2text($myts->undoHtmlSpecialChars($article_title));
#$forumdata['topic_title'] = $article_title;
#$pdf_data['title'] = $article->title();
#$topic_title = $article->topic_title();
#$topic_title = news_html2text($myts->undoHtmlSpecialChars($topic_title));
#$pdf_data['subtitle'] = $topic_title;

#$pdf_data['subsubtitle'] = '';
#$pdf_data['date'] = formatTimestamp($article->published(),$dateformat);
#$pdf_data['filename'] = preg_replace("/[^0-9a-z\-_\.]/i",'', htmlspecialchars($article->topic_title()).' - '.$article->title());
$pdf_data['filename'] = 'test';
#$hometext = $article->hometext();
#$bodytext = $article->bodytext();
#$content = $myts->undoHtmlSpecialChars($hometext) . '<br><br>' . $myts->undoHtmlSpecialChars($bodytext);
//$content = str_replace('[pagebreak]','<br><br>',$content);
$pdf_data['review'] = str_replace('[pagebreak]', '', $pdf_data['review']);
#$pdf_data['content'] = $content;

#$pdf_data['author'] = $article->uname();

//Other stuff
$puff = '<br>';
$puffer = '<br><br><br>';

//create the A4-PDF...
$pdf_config['slogan'] = $xoopsConfig['sitename'] . ' - ' . $xoopsConfig['slogan'];

$pdf = new PDF();
if (method_exists($pdf, 'encoding')) {
    $pdf->encoding($pdf_data, _CHARSET);
}
$pdf->SetCreator($pdf_config['creator']);
$pdf->SetTitle($pdf_data['title']);
$pdf->SetAuthor($pdf_config['url']);
$pdf->SetSubject($pdf_data['author']);
$out = $pdf_config['url'] . ', ' . $pdf_data['author'] . ', ' . $pdf_data['title'] . ', ' . $pdf_data['subtitle'] . ', ' . $pdf_data['subsubtitle'];
$pdf->SetKeywords($out);
$pdf->SetAutoPageBreak(true, 25);
$pdf->SetMargins($pdf_config['margin']['left'], $pdf_config['margin']['top'], $pdf_config['margin']['right']);
$pdf->Open();

//First page
$pdf->AddPage();
$pdf->SetXY(24, 25);
$pdf->SetTextColor(10, 60, 160);
$pdf->SetFont($pdf_config['font']['slogan']['family'], $pdf_config['font']['slogan']['style'], $pdf_config['font']['slogan']['size']);
$pdf->WriteHTML($pdf_config['slogan'], $pdf_config['scale']);
//$pdf->Image($pdf_config['logo']['path'],$pdf_config['logo']['left'],$pdf_config['logo']['top'],$pdf_config['logo']['width'],$pdf_config['logo']['height'],'',$pdf_config['url']);
$pdf->Line(25, 30, 190, 30);
$pdf->SetXY(25, 35);
$pdf->SetFont($pdf_config['font']['title']['family'], $pdf_config['font']['title']['style'], $pdf_config['font']['title']['size']);
$pdf->WriteHTML($pdf_data['title'], $pdf_config['scale']);

if ('' != $pdf_data['subtitle']) {
    $pdf->WriteHTML($puff, $pdf_config['scale']);

    $pdf->SetFont($pdf_config['font']['subtitle']['family'], $pdf_config['font']['subtitle']['style'], $pdf_config['font']['subtitle']['size']);

    $pdf->WriteHTML($pdf_data['subtitle'], $pdf_config['scale']);
}
/*
if ($pdf_data['subsubtitle']<>'') {
    $pdf->WriteHTML($puff,$pdf_config['scale']);
    $pdf->SetFont($pdf_config['font']['subsubtitle']['family'],$pdf_config['font']['subsubtitle']['style'],$pdf_config['font']['subsubtitle']['size']);
    $pdf->WriteHTML($pdf_data['subsubtitle'],$pdf_config['scale']);
}
*/
$pdf->WriteHTML($puff, $pdf_config['scale']);
$pdf->SetFont($pdf_config['font']['author']['family'], $pdf_config['font']['author']['style'], $pdf_config['font']['author']['size']);
$out = AMREV_PDF_AUTHOR . ': ';
$out .= $pdf_data['author'];
$pdf->WriteHTML($out, $pdf_config['scale']);
$pdf->WriteHTML($puff, $pdf_config['scale']);
$out = AMREV_PDF_DATE;
$out .= $pdf_data['date'];
$pdf->WriteHTML($out, $pdf_config['scale']);
$pdf->WriteHTML($puff, $pdf_config['scale']);

$pdf->SetTextColor(0, 0, 0);
$pdf->WriteHTML($puffer, $pdf_config['scale']);

$pdf->SetFont($pdf_config['font']['review']['family'], $pdf_config['font']['review']['style'], $pdf_config['font']['review']['size']);
$pdf->WriteHTML($pdf_data['review'], $pdf_config['scale']);

//$pdf->Output($pdf_data['filename'],'');

$pdf->Output();
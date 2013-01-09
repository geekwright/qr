<?php
/**
 * index.php - a blank main page for qr module
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 **/

include '../../mainfile.php';
$GLOBALS['xoopsOption']['template_main'] = 'qr_index.html';
include(XOOPS_ROOT_PATH."/header.php");

// $body='<img src="getqrcode.php?qrdata='.urlencode(XOOPS_URL).'">';

if(isset($body)) $xoopsTpl->assign('body', $body);

include(XOOPS_ROOT_PATH."/footer.php");
?>
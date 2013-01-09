<?php
/**
 * admin/license.php - make the more complicated license info available as a url
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.2
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 *
**/

include 'header.php';
if($xoop25plus) echo $moduleAdmin->addNavigation('license.php');
else adminmenu(3);

$qr='QRcode Perl CGI & PHP script ver.0.50i';
$line = '<p><b>This license covers the scripts in the "modules/qr/trust" directory of this module distribution:</b><br /><br />';
$line .= '<pre>'.utf8_encode(implode("\n", file('../docs/swetake-license.txt'))) . "\n</pre>";
if($xoop25plus) {
	$moduleAdmin->addInfoBox($qr);
	$moduleAdmin->addInfoBoxLine($qr, $line, '', '', 'information');
} else {
	echo'<table width="100%" border="0" cellspacing="1" class="outer">';
	echo '<tr><th>'.$qr.'</th></tr><tr><td width="100%" >';
	echo $line;
	echo '</td></tr></table>';
}

$mod='QR - a module for Xoops';
$line = '<p><b>This license covers all of the QR module distribution except the scripts in the "modules/qr/trust" directory:</b><br /><br />';
$line .= '<pre>'.utf8_encode(implode("\n", file('../docs/license.txt'))) . "\n</pre>";
if($xoop25plus) {
	$moduleAdmin->addInfoBox($mod);
	$moduleAdmin->addInfoBoxLine($mod, $line, '', '', 'information');
} else {
	echo'<table width="100%" border="0" cellspacing="1" class="outer">';
	echo '<tr><th>'.$mod.'</th></tr><tr><td width="100%" >';
	echo $line;
	echo '</td></tr></table>';
}
if($xoop25plus) echo $moduleAdmin->renderInfoBox();
include "footer.php";
?>
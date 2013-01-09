<?php
/**
 * admin/help.php - provide access to help on systems that are not running XOOPS 2.5+
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

// !$xoop25plus
adminmenu(0);

$help = XOOPS_ROOT_PATH . '/modules/' . $xoopsModule->getVar("dirname") . '/language/' . $xoopsConfig['language'] . '/help/help.html';
if(!file_exists($help)) $help = XOOPS_ROOT_PATH . "/modules/" . $xoopsModule->getVar("dirname") . "/language/english/help/help.html" ;

echo '<table width="100%" border="0" cellspacing="1" class="outer">';
echo '<tr><th>'._AM_QRMODULE_ADMENU_HELP.'</th></tr><tr><td width="100%" >';
$helptext=utf8_encode(implode("\n", file($help)));
$helptext=str_replace ( '<{$xoops_url}>', XOOPS_URL, $helptext);
echo $helptext.'<br /></td></tr></table>';

include "footer.php";
?>
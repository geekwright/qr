<?php
/**
 * admin - index
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 **/

include 'header.php';
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$qrpath=XOOPS_TRUST_PATH.'/modules/'.$dir.'/php/';
	if($xoop25plus) $moduleAdmin->addConfigBoxLine($qrpath, 'folder');

	if($xoop25plus) echo $moduleAdmin->addNavigation('index.php') ;
	else adminmenu(1);

	$rendertest=_AM_QRMODULE_CONFIG_RENDER_CODE;
	if(!empty($_REQUEST['test'])) $rendertest=$_REQUEST['test'];
	$rendertestenc=urlencode($rendertest);
	$rendercode =sprintf('<form action="" method="get">%s <input type="text" name="test" value="%s" />',_AM_QRMODULE_CONFIG_RENDER_PHRASE,$rendertest);
	$rendercode.=sprintf('<img src="../getqrcode.php?qrdata=%s" alt="%s"  title="%s" /></form>',$rendertestenc,$rendertest,$rendertest);

	$serverpath = XOOPS_TRUST_PATH.'/modules/'.$dir.'/php/qr_img.php';
	if($xoop25plus) {
		$moduleAdmin->addInfoBox(_AM_QRMODULE_CONFIG_RENDER);

		if(file_exists($serverpath)) {
			$moduleAdmin->addInfoBoxLine(_AM_QRMODULE_CONFIG_RENDER, $rendercode, '', '', 'information');
		}
		else {
			$moduleAdmin->addInfoBoxLine(_AM_QRMODULE_CONFIG_RENDER, '%s', _AM_QRMODULE_CONFIG_RENDER_FAIL, 'red', 'default');
		}
		echo $moduleAdmin->renderIndex();
	}
	else { // !$xoop25plus
		echo '<table width="100%" border="0" cellspacing="1" class="outer">';
		echo '<tr><th>'._AM_QRMODULE_CONFIG_RENDER.'</th></tr><tr><td width="100%" ><br />';
		if(file_exists($serverpath)) {
			echo $rendercode;
		}
		else {
			echo '<span style="color:red;">'._AM_QRMODULE_CONFIG_RENDER_FAIL.'</span>';
		}
		echo '</td></tr></table>';
	}
	

include "footer.php";
?>
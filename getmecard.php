<?php
/**
 * getmecard.php - convert structured http query string to mecard code
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.2
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 *
 **/

include '../../mainfile.php';
//include(XOOPS_ROOT_PATH."/header.php");
$dir = basename( dirname( __FILE__ ) ) ;

$limit_referer = $xoopsModuleConfig['limit_referer'];

if($limit_referer) $check=$GLOBALS['xoopsSecurity']->checkReferer();
else $check=true;

if ($check) {
	$mecardtags=explode("|","N|SOUND|TEL|TEL-AV|EMAIL|NOTE|BDAY|ADR|URL|NICKNAME");

	$card='';
	$have_name=false;
	for($i=0; $i<sizeof($mecardtags); $i++) {
		$value='';
		if(!empty($_REQUEST[$mecardtags[$i]])) $value=$_REQUEST[$mecardtags[$i]];
		if(!empty($_REQUEST[strtolower($mecardtags[$i])])) $value=$_REQUEST[strtolower($mecardtags[$i])];
		if(!empty($value)) {
			if($mecardtags[$i]=='N') $have_name=true;
			$card.=formatMecard($mecardtags[$i],$value);
		}
	}
	if(!empty($card) && $have_name) { // we must have name for most scanners to accept a MECARD
		$card = 'MECARD:'.$card.';';	
		$_GET['d']=$card;
		$_GET['e']=$xoopsModuleConfig['ec_level'];
		unset($_GET['s'],$_GET['v'],$_GET['t'],$_GET['n'],$_GET['m'],$_GET['p'],$_GET['o']);
		include_once(XOOPS_ROOT_PATH.'/modules/'.$dir.'/swetake/php/qr_img.php');
	}
}

function formatMecard($tag,$value) {
	$carditem='';
	$value=mb_decode_numericentity($value, array(0x0, 0x2FFFF, 0, 0xFFFF), 'UTF-8');
	//$value=str_replace("&#039;","'",$value); // this is so names like O'Brian will work. Must be a better way.
	// escape according to docomo docs
	$value=str_replace("\\","\\\\",$value);
	$value=str_replace(":","\\:",$value);
	$value=str_replace(";","\\;",$value);
	if($tag=='N' || $tag=='ADR' || $tag=='KANA') $value=str_replace(",","\\,",$value);
	if(!empty($value)) $carditem=$tag.':'.$value.';';
	return $carditem;
}
//include(XOOPS_ROOT_PATH."/footer.php");
?>

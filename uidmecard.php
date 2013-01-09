<?php
/**
 * uidmecard.php - mecard for XOOPS user
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.2
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 **/
include '../../mainfile.php';
//include(XOOPS_ROOT_PATH."/header.php");
$dir = basename( dirname( __FILE__ ) ) ;

$limit_referer = $xoopsModuleConfig['limit_referer'];

if($limit_referer) $check=$GLOBALS['xoopsSecurity']->checkReferer();
else $check=true;

if ($check) {
	// $mecardtags=explode("|","N|SOUND|TEL|TEL-AV|EMAIL|NOTE|BDAY|ADR|URL|NICKNAME");

	$uid=0;
	if(!empty($_REQUEST['uid'])) $uid=(int)$_REQUEST['uid'];
	if(!$uid) $uid = ($xoopsUser)?$xoopsUser->getVar('uid'):0;
	if($uid>0) {
		$member_handler =& xoops_gethandler('member');
		$thisUser =& $member_handler->getUser($uid);
        	if (!is_object($thisUser) || !$thisUser->isActive() ) {
			exit();
		}
		$card='';
		$name=$thisUser->getVar('name'); // we must have name for most scanners
		if(!empty($name)) {
			$card.=formatMecard('N',$thisUser->getVar('name'));
			$card.=formatMecard('NICKNAME',$thisUser->getVar('uname'));
		} else {
			$card.=formatMecard('N',$thisUser->getVar('uname'));
		}
		if($thisUser->getVar('user_viewemail')) $card.=formatMecard('EMAIL',$thisUser->getVar('email'));
		$card.=formatMecard('URL',$thisUser->getVar('url'));
		$card.=formatMecard('ADR',$thisUser->getVar('user_from'));
	}

	if(!empty($card)) {
		$card = 'MECARD:'.$card.';';	
		$_GET['d']=$card;
		$_GET['e']=$xoopsModuleConfig['ec_level'];
		unset($_GET['s'],$_GET['v'],$_GET['t'],$_GET['n'],$_GET['m'],$_GET['p'],$_GET['o']);
		include_once(XOOPS_TRUST_PATH.'/modules/'.$dir.'/php/qr_img.php');
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
//to denote "¥" state "¥¥"
//to denote ":" state "¥:"
//to denote ";" state "¥;"
//to denote "," state "¥,"
?>

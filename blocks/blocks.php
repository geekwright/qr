<?php
/**
 * blocks
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 **/

if (!defined('XOOPS_ROOT_PATH')){ exit(); }

function b_qr_manual_show($options) {
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$block['qrcode']='<img src="'.XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata='.urlencode($options[0]).'" alt="'.$options[1].'" title="'.$options[1].'">';

	return $block;
}

function b_qr_manual_edit($options) {
	$form = _MB_QR_MANUAL_STRING.": <input type='text' value='".$options[0]."'id='options[0]' name='options[0]' /><br />";
	$form .= _MB_QR_MANUAL_ALT.": <input type='text' value='".$options[1]."'id='options[1]' name='options[1]' />";

	return $form;
}

function b_qr_here_show($options) {
	if(is_null($options[2])) $options[2]=1; // keep old behavior as default until edited
	$names_to_check = explode(',',$options[0]);
	$query='';
	foreach($names_to_check as $i) {
		if($i) {
			if(isset($_REQUEST[$i])) {
				if($query!='') $query .= '&';
				$query .= $i."=".$_REQUEST[$i];
			}
		}
	}
	if($options[2] && $query=='') return false;
	if($query!='') $query='?'.$query;
	$ourscript=$_SERVER['SCRIPT_NAME'];
	// eliminate index.php if no query string
	$ourscript_parts = pathinfo($ourscript);
	if ($ourscript_parts['basename']=='index.php' && $query=='') {
		$ourscript=$ourscript_parts['dirname'].'/';
	}
	// check protocol
	$protocol = 'http://'; $defaultport=80;
	if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
		$protocol = 'https://';
		$defaultport = 443;
	}
	// add port if not default
	$port= empty($_SERVER['SERVER_PORT']) ? 80 : intval($_SERVER['SERVER_PORT']);
	$port = ($port==$defaultport) ? '' : ':'.$port;

	$oururl=$protocol.$_SERVER['SERVER_NAME'].$port.$ourscript.$query;
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;

	$block['qrcode']='<img src="'.XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata='.urlencode($oururl).'" alt="'.$options[1].'" title="'.$options[1].'">';

	return $block;
}

function b_qr_here_edit($options) {
	if(is_null($options[2])) $options[2]=1; // keep old behavior as default until overwritten
	$form = _MB_QR_HERE_STRING.": <input type='text' size='50' value='".$options[0]."'id='options[0]' name='options[0]' /><br /><br />";
	$form .= _MB_QR_HERE_ALT.": <input type='text' size='50' value='".$options[1]."'id='options[1]' name='options[1]' /><br /><br />";
	$form .=_MB_QR_HERE_REQ_PARMS.": <input type='radio' name='options[2]' value='1' ";
	if($options[2]) $form .="checked='checked'"; 
	$form .=" />&nbsp;Yes&nbsp;<input type='radio' name='options[2]' value='0' ";
	if(!$options[2]) $form .="checked='checked'"; 
	$form .="  />&nbsp;No<br /><br />";
	return $form;
}

// MECARD : http://www.nttdocomo.co.jp/english/service/developer/make/content/barcode/function/application/addressbook/index.html

function b_qr_mecard_show($options) {
	// must match options order
	$mecardtags=explode("|","N|SOUND|TEL|TEL-AV|EMAIL|NOTE|BDAY|ADR|URL|NICKNAME");

	$card='';
	for($i=0; $i<sizeof($mecardtags); $i++) {
		if(isset($options[$i])) {
			if($options[$i]!='') {
				$card.=b_qr_formatMecard($mecardtags[$i],$options[$i]);
			}
		}
	}
	if($card=='') return false;
	$card = 'MECARD:'.$card.';';
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;

	$block['qrcode']='<img src="'.XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata='.rawurlencode($card).'" alt="'.$options[10].'" title="'.$options[10].'">';

	return $block;
}

function b_qr_formatMecard($tag,$value) {
	$carditem='';
	$value=mb_decode_numericentity($value, array(0x0, 0x2FFFF, 0, 0xFFFF), 'UTF-8');
	// escape according to docomo docs
	$value=str_replace("\\","\\\\",$value);
	$value=str_replace(":","\\:",$value);
	$value=str_replace(";","\\;",$value);
	if($tag=='N' || $tag=='ADR' || $tag=='KANA') $value=str_replace(",","\\,",$value);
	if(!empty($value)) $carditem=$tag.':'.$value.';';
	return $carditem;
}


function b_qr_mecard_edit($options) {
	$form = _MB_QR_MECARD_STRING."<br />";

	$form .= _MB_QR_MECARD_N.": <input type='text' value='".$options[0]."'id='options[0]' name='options[0]' /><br />";
	$form .= _MB_QR_MECARD_SOUND.": <input type='text' value='".$options[1]."'id='options[1]' name='options[1]' /><br />";
	$form .= _MB_QR_MECARD_TEL.": <input type='text' value='".$options[2]."'id='options[2]' name='options[2]' /><br />";
	$form .= _MB_QR_MECARD_TELAV.": <input type='text' value='".$options[3]."'id='options[3]' name='options[3]' /><br />";
	$form .= _MB_QR_MECARD_EMAIL.": <input type='text' value='".$options[4]."'id='options[4]' name='options[4]' /><br />";
	$form .= _MB_QR_MECARD_NOTE.": <input type='text' value='".$options[5]."'id='options[5]' name='options[5]' /><br />";
	$form .= _MB_QR_MECARD_BDAY.": <input type='text' value='".$options[6]."'id='options[6]' name='options[6]' /><br />";
	$form .= _MB_QR_MECARD_ADR.": <input type='text' value='".$options[7]."'id='options[7]' name='options[7]' /><br />";
	$form .= _MB_QR_MECARD_URL.": <input type='text' value='".$options[8]."'id='options[8]' name='options[8]' /><br />";
	$form .= _MB_QR_MECARD_NICKNAME.": <input type='text' value='".$options[9]."'id='options[9]' name='options[9]' /><br />";
	$form .= _MB_QR_MECARD_ALT.": <input type='text' value='".$options[10]."'id='options[10]' name='options[10]' />";
	return $form;
}

function b_qr_bookmark_show($options) {
	$names_to_check = explode(',',$options[0]);
	$query='';
	foreach($names_to_check as $i) {
		if($i) {
			if(isset($_REQUEST[$i])) {
				if($query!='') $query .= '&';
				$query .= $i."=".$_REQUEST[$i];
			}
		}
	}
	if($options[2] && $query=='') return false;
	if($query!='') $query='?'.$query;
	$ourscript=$_SERVER['SCRIPT_NAME'];
	// eliminate index.php if no query string
	$ourscript_parts = pathinfo($ourscript);
	if ($ourscript_parts['basename']=='index.php' && $query=='') {
		$ourscript=$ourscript_parts['dirname'].'/';
	}
	// check protocol
	$protocol = 'http://'; $defaultport=80;
	if (!empty($_SERVER['HTTPS']) && ($_SERVER['HTTPS']=='on')) {
		$protocol = 'https://';
		$defaultport = 443;
	}
	// add port if not default
	$port= empty($_SERVER['SERVER_PORT']) ? 80 : intval($_SERVER['SERVER_PORT']);
	$port = ($port==$defaultport) ? '' : ':'.$port;

	$oururl=$protocol.$_SERVER['SERVER_NAME'].$port.$ourscript.$query;
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;

	$block['qrcode']='<img src="'.XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata='.urlencode($oururl).'" alt="'.$options[1].'" title="'.$options[1].'">';
    $block['qrscript']= XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata=';
    $block['url']=$oururl;
    $block['alt']=$options[1];
    $block['imagedir']= XOOPS_URL.'/modules/'.$dir.'/images';
    $block['usepopup']= $options[3]?true:false;
    $block['popupprompt']= $options[4];
    $block['popupclose']=_MB_QR_MEBKM_POPUP_CLOSE;
	// we will get the document title directly from dom with javascript because it has not been set yet when block code runs.
	return $block;
}

function b_qr_bookmark_edit($options) {
	$form  = _MB_QR_HERE_STRING.": <input type='text' size='50' value='".$options[0]."'id='options[0]' name='options[0]' /><br /><br />";
	$form .= _MB_QR_HERE_ALT.": <input type='text' size='50' value='".$options[1]."'id='options[1]' name='options[1]' /><br /><br />";
	$form .= _MB_QR_HERE_REQ_PARMS.": <input type='radio' name='options[2]' value='1' ";
	if($options[2]) $form .="checked='checked'"; 
	$form .= " />&nbsp;Yes&nbsp;<input type='radio' name='options[2]' value='0' ";
	if(!$options[2]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;No<br /><br />";
	$form .= _MB_QR_MEBKM_POPUP.": <input type='radio' name='options[3]' value='1' ";
	if($options[3]) $form .="checked='checked'"; 
	$form .= " />&nbsp;Yes&nbsp;<input type='radio' name='options[3]' value='0' ";
	if(!$options[3]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;No<br /><br />";
	$form .= _MB_QR_MEBKM_POPUP_PROMPT.": <input type='text' size='20' value='".$options[4]."'id='options[4]' name='options[4]' /><br /><br />";
	return $form;
}

?>

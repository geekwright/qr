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
	$block['qrdata']=urlencode($options[0]);
    $block['qrscript']= XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata=';
//    $block['url']=$oururl;
    $block['alt']=$options[1];
    $block['imagedir']= XOOPS_URL.'/modules/'.$dir.'/images';
    $block['usepopup']= $options[2]?true:false;
    $block['mouseover']= $options[2]>1;
    $block['popupprompt']= $options[3];
    $block['popupclose']=_MB_QR_SHOW_AS_POPUP_CLOSE;

	return $block;
}

function b_qr_manual_edit($options) {
	$form = _MB_QR_MANUAL_STRING.": <input type='text' value='".$options[0]."'id='options[0]' name='options[0]' /><br /><br />";
	$form .= _MB_QR_MANUAL_ALT.": <input type='text' value='".$options[1]."'id='options[1]' name='options[1]' /><br /><br />";
	$form .= _MB_QR_SHOW_AS_POPUP.": <input type='radio' name='options[2]' value='1' ";
	if($options[2]==1) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONCLICK."&nbsp;<input type='radio' name='options[2]' value='2' ";
	if($options[2]==2) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONMOUSE."&nbsp;<input type='radio' name='options[2]' value='0' ";
	if(!$options[2]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;"._NO."<br /><br />";
	$form .= _MB_QR_SHOW_AS_POPUP_PROMPT.": <input type='text' size='20' value='".$options[3]."'id='options[3]' name='options[3]' /><br /><br />";

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
	$block['qrdata']=urlencode($oururl);
    $block['qrscript']= XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata=';
    $block['url']=$oururl;
    $block['alt']=$options[1];
    $block['imagedir']= XOOPS_URL.'/modules/'.$dir.'/images';
    $block['usepopup']= $options[3]?true:false;
    $block['mouseover']= $options[3]>1;
    $block['popupprompt']= $options[4];
    $block['popupclose']=_MB_QR_SHOW_AS_POPUP_CLOSE;
	// if needed, get the document title directly from dom with javascript as it has not been set yet when block code runs.

	return $block;
}

function b_qr_here_edit($options) {
	if(is_null($options[2])) $options[2]=1; // keep old behavior as default until overwritten
	$form  = _MB_QR_HERE_STRING.": <input type='text' size='50' value='".$options[0]."'id='options[0]' name='options[0]' /><br /><br />";
	$form .= _MB_QR_HERE_ALT.": <input type='text' size='50' value='".$options[1]."'id='options[1]' name='options[1]' /><br /><br />";
	$form .= _MB_QR_HERE_REQ_PARMS.": <input type='radio' name='options[2]' value='1' ";
	if($options[2]) $form .="checked='checked'"; 
	$form .= " />&nbsp;Yes&nbsp;<input type='radio' name='options[2]' value='0' ";
	if(!$options[2]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;No<br /><br />";
	$form .= _MB_QR_SHOW_AS_POPUP.": <input type='radio' name='options[3]' value='1' ";
	if($options[3]==1) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONCLICK."&nbsp;<input type='radio' name='options[3]' value='2' ";
	if($options[3]==2) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONMOUSE."&nbsp;<input type='radio' name='options[3]' value='0' ";
	if(!$options[3]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;"._NO."<br /><br />";
	$form .= _MB_QR_SHOW_AS_POPUP_PROMPT.": <input type='text' size='20' value='".$options[4]."'id='options[4]' name='options[4]' /><br /><br />";
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
	$block['qrdata']=rawurlencode($card);
    $block['qrscript']= XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata=';
//    $block['url']=$oururl;
    $block['alt']=$options[10];
    $block['imagedir']= XOOPS_URL.'/modules/'.$dir.'/images';
    $block['usepopup']= $options[11]?true:false;
    $block['mouseover']= $options[11]>1;
	$block['popupprompt']= $options[12];
    $block['popupclose']=_MB_QR_SHOW_AS_POPUP_CLOSE;

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
	$form .= _MB_QR_MECARD_NICKNAME.": <input type='text' value='".$options[9]."'id='options[9]' name='options[9]' /><br /><br />";
	$form .= _MB_QR_MECARD_ALT.": <input type='text' value='".$options[10]."'id='options[10]' name='options[10]' /><br /><br />";
	
	$form .= _MB_QR_SHOW_AS_POPUP.": <input type='radio' name='options[11]' value='1' ";
	if($options[11]==1) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONCLICK."&nbsp;<input type='radio' name='options[11]' value='2' ";
	if($options[11]==2) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONMOUSE."&nbsp;<input type='radio' name='options[11]' value='0' ";
	if(!$options[11]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;"._NO."<br /><br />";

	$form .= _MB_QR_SHOW_AS_POPUP_PROMPT.": <input type='text' size='20' value='".$options[12]."'id='options[12]' name='options[12]' /><br /><br />";

	return $form;
}

// vCard : lower device compatibility than MECARD, but requested

function b_qr_vcard_show($options) {
	for($i=0;$i<28;$i++) {
		$options[$i]=mb_decode_numericentity($options[$i], array(0x0, 0x2FFFF, 0, 0xFFFF), 'UTF-8');
	}
	$crlf="\r\n";
	$vcard ="BEGIN:VCARDVERSION:3.0REV:".date('c').$crlf;
	$vcard.="FN:{$options[0]}".$crlf;
	$vcard.="N:{$options[1]};{$options[2]};{$options[3]};{$options[4]};{$options[5]}".$crlf;
	if(!empty($options[6])) $vcard.="ORG:{$options[6]}".$crlf;
	if(!empty($options[7])) $vcard.="TITLE:{$options[7]}".$crlf;
	if(!empty($options[9]) || !empty($options[10]) || !empty($options[11]) || !empty($options[12]) ||
		!empty($options[13]) || !empty($options[14]) || !empty($options[15])) {
			$vcard.="ADR;TYPE={$options[8]}:{$options[9]};{$options[10]};{$options[11]};";
			$vcard.="{$options[12]};{$options[13]};{$options[14]};{$options[15]}".$crlf;
	}
	if(!empty($options[16])) $vcard.="EMAIL;TYPE=INTERNET,PREF:{$options[16]}".$crlf;
	if(!empty($options[17])) $vcard.="EMAIL;TYPE=INTERNET:{$options[17]}".$crlf;
	if(!empty($options[18])) $vcard.="TEL;TYPE={$options[19]},PREF:{$options[18]}".$crlf;
	if(!empty($options[20])) $vcard.="TEL;TYPE={$options[21]}:{$options[20]}".$crlf;
	if(!empty($options[22])) $vcard.="TEL;TYPE={$options[23]}:{$options[22]}".$crlf;
	if(!empty($options[24])) $vcard.="URL:{$options[24]}".$crlf;
	if(!empty($options[25])) $vcard.="NOTE:{$options[25]}".$crlf;
	if(!empty($options[26])) $vcard.="{$options[26]}".$crlf;
	if(!empty($options[27])) $vcard.="{$options[27]}".$crlf;
	$vcard.="TZ:".date('O').$crlf;
	$vcard.="END:VCARD".$crlf;

	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;

	$block['qrcode']='<img src="'.XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata='.urlencode($vcard).'" alt="'.$options[28].'" title="'.$options[28].'">';
	$block['qrdata']=urlencode($vcard);
    $block['qrscript']= XOOPS_URL.'/modules/'.$dir.'/getqrcode.php?qrdata=';
//    $block['url']=$oururl;
    $block['alt']=$options[28];
    $block['imagedir']= XOOPS_URL.'/modules/'.$dir.'/images';
    $block['usepopup']= $options[29]?true:false;
    $block['mouseover']= $options[29]>1;
	$block['popupprompt']= $options[30];
    $block['popupclose']=_MB_QR_SHOW_AS_POPUP_CLOSE;
    trigger_error(print_r($block,1));

	return $block;
}

function b_qr_formatvcard($tag,$value) {
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

function b_qr_vcard_add($prompt,$op,$value,$br=true,$type='')
{
	$form=$prompt;
	$l=$br?'<br />':'';
	switch(strtoupper($type)) {
		case 'ADR':
			$form .= ": <select id='options[{$op}]' name='options[{$op}]'>";
			$form .= '<option value="WORK"'.($value=="WORK"?' selected':'').'>'._MB_QR_VCARD_TYPE_WORK.'</option>';
			$form .= '<option value="HOME"'.($value=="HOME"?' selected':'').'>'._MB_QR_VCARD_TYPE_HOME.'</option>';
			$form .= '</select>';
			break;
		case 'TEL':
			$form .= ": <select id='options[{$op}]' name='options[{$op}]'>";
			$form .= '<option value="CELL,VOICE"'.($value=="CELL,VOICE"?' selected':'').'>'._MB_QR_VCARD_TYPE_CELL.'</option>';
			$form .= '<option value="WORK,VOICE"'.($value=="WORK,VOICE"?' selected':'').'>'._MB_QR_VCARD_TYPE_WORK.'</option>';
			$form .= '<option value="HOME,VOICE"'.($value=="HOME,VOICE"?' selected':'').'>'._MB_QR_VCARD_TYPE_HOME.'</option>';
			$form .= '<option value="FAX"'.($value=="FAX"?' selected':'').'>'._MB_QR_VCARD_TYPE_FAX.'</option>';
			$form .= '</select>';
			break;
		default:
		case '':
			$form .= ": <input type='text' value='{$value}' id='options[{$op}]' name='options[{$op}]' />";
			break;
	}
	return $form.$l;
}

function b_qr_vcard_edit($options) {
	$form = _MB_QR_VCARD_STRING."<br />";

	$form .= b_qr_vcard_add(_MB_QR_VCARD_FN,'0',$options[0]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_N_FAMILY,'1',$options[1]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_N_GIVEN,'2',$options[2]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_N_ADDITIONAL,'3',$options[3]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_N_PREFIX,'4',$options[4]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_N_SUFFIX,'5',$options[5]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ORG,'6',$options[6]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TITLE,'7',$options[7]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_TYPE,'8',$options[8],1,'ADR');
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_POBOX,'9',$options[9]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_EXTENDED,'10',$options[10]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_STREET,'11',$options[11]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_LOCALITY,'12',$options[12]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_REGION,'13',$options[13]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_POSTCODE,'14',$options[14]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_ADR_COUNTRY,'15',$options[15]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_EMAIL_PREF,'16',$options[16]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_EMAIL,'17',$options[17]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TEL_PREF,'18',$options[18],0);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TEL_TYPE,'19',$options[19],1,'TEL');
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TEL,'20',$options[20],0);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TEL_TYPE,'21',$options[21],1,'TEL');
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TEL,'22',$options[22],0);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_TEL_TYPE,'23',$options[23],1,'TEL');
	$form .= b_qr_vcard_add(_MB_QR_VCARD_URL,'24',$options[24]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_NOTE,'25',$options[25]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_RAW,'26',$options[26]);
	$form .= b_qr_vcard_add(_MB_QR_VCARD_RAW,'27',$options[27]);

	$form .= _MB_QR_VCARD_ALT.": <input type='text' value='".$options[28]."'id='options[28]' name='options[28]' /><br /><br />";
	
	$form .= _MB_QR_SHOW_AS_POPUP.": <input type='radio' name='options[29]' value='1' ";
	if($options[29]==1) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONCLICK."&nbsp;<input type='radio' name='options[29]' value='2' ";
	if($options[29]==2) $form .="checked='checked'"; 
	$form .= " />&nbsp;"._MB_QR_SHOW_POPUP_ONMOUSE."&nbsp;<input type='radio' name='options[29]' value='0' ";
	if(!$options[29]) $form .="checked='checked'"; 
	$form .= "  />&nbsp;"._NO."<br /><br />";

	$form .= _MB_QR_SHOW_AS_POPUP_PROMPT.": <input type='text' size='20' value='".$options[30]."'id='options[30]' name='options[30]' /><br /><br />";

	return $form;
}

?>

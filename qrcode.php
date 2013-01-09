<?php
//  ------------------------------------------------------------------------ //
//  Author: Designburo.nl (info@designburo.nl)                               //
//  http://www.designburo.nl                                                 //
//  Project: QRcode v1.0                                                     //
//  ------------------------------------------------------------------------ //
/**
 *
 * qrcode.php - compatibility layer for Designburo.nl qrcode module
 *
 * This file was adapted and modified by Richard Griffith - richard@geekwright.com
 * to provide a compatibility layer for use with existing implementations that
 * use the Designburo.nl XOOPS module QRcode.
 *
 * This adaptation uses the local resources available in the geekwright qr module
 * for generating qr codes rather than depending on network communication with
 * designburo.nl for code generation.
 *
 * Additional differences in this implementation:
 *  - size is ignored. Code size is based on configured options and the data encoded.
 *
 * @copyright   Designburo.nl, geekwright
 * @license	GNU General Public License (GPL)
 * @since	1.2
 * @author	Designburo.nl (info@designburo.nl), Richard Griffith (richard@geekwright.com)
 * @package	qr
 * @version	$Id$
 *
**/
function qrcode($type="",$data=array(),$size="250")
{
$dir = basename( dirname( __FILE__ ) ) ;
$modurl=XOOPS_URL.'/modules/'.$dir.'/';

	if($type!='')
	{
		switch ($type)
		{
			//QRCode with sending e-mail
			case "email":
			if (!$data['email']) { return "error no e-mail"; break;}	
			else
			{
				$l = "SMTP:".$data['email'].":".$data['subject'].":".$data['txt'];
				$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
				break;
			}
			// QRCode with phonenumber
			case "phone":
			if (!$data['phonenr']) { return "error no phonenumber"; break;}	
			else {
				$l = "TEL:".$data['phonenr'];
				$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
				break;
			}
			// QRCcode sending SMS
			case "sms";
			if (!$data['phonenr']) { return "error no gsm number"; break;}	
			else {
				$l = "SMSTO:".$data['phonenr'].":".$data['txt'];
				$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
				break;
			}
			// QRCode plain text
			case "txt";
			if (!$data['txt']) { return "error no text"; break;}	
			else {
				$l = $data['txt'];
				$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
				break;
			}
			//QRCode url			
			case "url";
			if (!$data['url']) { return "error no url"; break;}	
			else {
				$l = $data['url'];
				$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
				break;
			}
			//QRCode gps coordinates
			case "gps";
			$l = "geo:".$data['lat'].",".$data['long'].",100";
			$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
			break;
			//QRcode business card
			case "contact";
			$eor= "\r\n";
			$l = "MECARD:";
			$l.= "N:".$data['surname'].",".$data['name'].";";
			$l.= "TEL-AV:".$data['mobile'].";";
			$l.= "TEL:".$data['phonenr'].";";
			$l.= "ADR:,,".$data['adres'].",".$data['state'].",".$data['city'].",".$data['zipcode'].",".$data['country'].";";
			$l.= "EMAIL:".$data['email'].";";
			$l.= "URL:".$data['url'].";";
			$l.= "NOTE:".$data['title']." @ ".$data['company'].";";
			$l.= "BDAY:".$data['b_year'].$data['b_month'].$data['b_day'].";";
			$l.= ";";
			$ul = rawurlencode(utf8_encode($l)); 
				return '<img src="'.$modurl.'getqrcode.php?qrdata='.$ul.'">';
			break;
		}
	}
	else
	{
		return "error no type definition";
	}
}
?>

<?php
/**
 * language - blocks
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 */

define('_MB_QR_MANUAL_STRING' , 'String to encode in QR Code');
define('_MB_QR_MANUAL_ALT' , 'ALT String for QR Code Image');
define('_MB_QR_HERE_STRING' , "Variables to include in QR URL separated by comma (i.e. 'post_id,page')");
define('_MB_QR_HERE_REQ_PARMS' , 'Require variable(s) from the list to display block');
define('_MB_QR_HERE_ALT' , 'ALT String for QR Code Image');

define('_MB_QR_MECARD_STRING' , 'MECARD data fields, leave field blank to omit from bar code.');
define('_MB_QR_MECARD_ALT' , 'ALT String for QR Code Image');

define('_MB_QR_MECARD_N'       ,'Name');
define('_MB_QR_MECARD_SOUND'   ,'Reading (kana)');
define('_MB_QR_MECARD_TEL'     ,'Phone');
define('_MB_QR_MECARD_TELAV'   ,'Videophone');
define('_MB_QR_MECARD_EMAIL'   ,'Email');
define('_MB_QR_MECARD_NOTE'    ,'Memo');
define('_MB_QR_MECARD_BDAY'    ,'Birthday');
define('_MB_QR_MECARD_ADR'     ,'Address');
define('_MB_QR_MECARD_URL'     ,'URL');
define('_MB_QR_MECARD_NICKNAME','Nickname');

// new in v1.3
define('_MB_QR_MEBKM_POPUP', 'Show code in popup window?');
define('_MB_QR_MEBKM_POPUP_PROMPT', 'Prompt for Popup Open');
define('_MB_QR_MEBKM_POPUP_CLOSE', 'Click to Close');
?>

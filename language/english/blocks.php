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
define('_MB_QR_SHOW_AS_POPUP', 'Show code in popup window?');
define('_MB_QR_SHOW_POPUP_ONCLICK','On Click');
define('_MB_QR_SHOW_POPUP_ONMOUSE','On Mouse Over');
define('_MB_QR_SHOW_AS_POPUP_PROMPT', 'Prompt for Popup Open');
define('_MB_QR_SHOW_AS_POPUP_CLOSE', 'Click to Close');

// new in vcard
define('_MB_QR_VCARD_STRING', 'vCard data fields, leave field blank to omit from bar code. (Full Name and Name required.)');
define('_MB_QR_VCARD_ALT' , 'ALT String for QR Code Image');
define('_MB_QR_VCARD_TYPE'         ,'Type');
define('_MB_QR_VCARD_TYPE_WORK'    ,'Work');
define('_MB_QR_VCARD_TYPE_HOME'    ,'Home');
define('_MB_QR_VCARD_TYPE_CELL'    ,'Cell');
define('_MB_QR_VCARD_TYPE_FAX'     ,'Fax');

define('_MB_QR_VCARD_FN'           ,'Full Name');
define('_MB_QR_VCARD_N_FAMILY'     ,'Name - Family');
define('_MB_QR_VCARD_N_GIVEN'      ,'Name - Given Name');
define('_MB_QR_VCARD_N_ADDITIONAL' ,'Name(s) - Additional');
define('_MB_QR_VCARD_N_PREFIX'     ,'Name - Prefixes');
define('_MB_QR_VCARD_N_SUFFIX'     ,'Name - Suffixes');
define('_MB_QR_VCARD_ORG'          ,'Organization');
define('_MB_QR_VCARD_TITLE'        ,'Title');

define('_MB_QR_VCARD_ADR_TYPE'     ,'Address - Type');
define('_MB_QR_VCARD_ADR_POBOX'    ,'Address - PO Box');
define('_MB_QR_VCARD_ADR_EXTENDED' ,'Address - Extended Address');
define('_MB_QR_VCARD_ADR_STREET'   ,'Address - Street Address');
define('_MB_QR_VCARD_ADR_LOCALITY' ,'Address - City');
define('_MB_QR_VCARD_ADR_REGION'   ,'Address - State/Province');
define('_MB_QR_VCARD_ADR_POSTCODE' ,'Address - Postal Code');
define('_MB_QR_VCARD_ADR_COUNTRY'  ,'Address - Country');

define('_MB_QR_VCARD_EMAIL_PREF'   ,'Email - Prefered');
define('_MB_QR_VCARD_EMAIL'        ,'Email');

define('_MB_QR_VCARD_TEL_TYPE'     ,'Type');
define('_MB_QR_VCARD_TEL_PREF'     ,'Phone - Prefered');
define('_MB_QR_VCARD_TEL'          ,'Phone');
define('_MB_QR_VCARD_URL'          ,'URL');
define('_MB_QR_VCARD_NOTE'         ,'Note');

define('_MB_QR_VCARD_RAW'         ,'Raw vCard Line Data');

?>

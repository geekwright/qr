<?php
/**
 * getqrcode.php
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
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
	if(isset($_REQUEST['qrdata'])) {
		$qrdata=$_REQUEST['qrdata'];
		$_GET['d']=$qrdata;
		$_GET['e']=$xoopsModuleConfig['ec_level'];
		unset($_GET['s'],$_GET['v'],$_GET['t'],$_GET['n'],$_GET['m'],$_GET['p'],$_GET['o']);
		include_once(XOOPS_TRUST_PATH.'/modules/'.$dir.'/php/qr_img.php');
	}
}
/*
* Possible parameters to qr_img.php:
*   d= data         URL encoded data.
*   e= ECC level    L or M or Q or H   (default M)
*   s= module size  (dafault PNG:4 JPEG:8)
*   v= version      1-40 or Auto select if you do not set.
*   t= image type   J:jpeg image , other: PNG image
*
*  structured append  m of n (experimental)
*   n= structure append n (2-16)
*   m= structure append m (1-16)
*   p= parity
*   o= original data (URL encoded data)  for calculating parity
*/
//include(XOOPS_ROOT_PATH."/footer.php");
?>

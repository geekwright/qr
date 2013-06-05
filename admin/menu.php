<?php
/**
 * admin - menu
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 *
 **/
if(file_exists(XOOPS_ROOT_PATH.'/Frameworks/moduleclasses/icons/32/about.png')) {
$pathIcon32='../../Frameworks/moduleclasses/icons/32';

$adminmenu[1] = array(
	'title'	=> _MI_QRMODULE_HOME ,
	'link'	=> 'admin/index.php' ,
	'desc'	=> _MI_QRMODULE_HOME_DESC,
	'icon'	=> $pathIcon32.'/home.png'
) ;

$adminmenu[] = array(
	'title'	=> _MI_QRMODULE_ABOUT ,
	'link'	=> 'admin/about.php' ,
	'desc'	=> _MI_QRMODULE_ABOUT_DESC,
	'icon'	=> $pathIcon32.'/about.png'
) ;

$adminmenu[] = array(
	'title'	=> _MI_QRMODULE_LICENSE ,
	'link'	=> 'admin/license.php' ,
	'desc'	=> _MI_QRMODULE_LICENSE_DESC,
	'icon'	=> $pathIcon32.'/view_text.png'
) ;

} else {

$adminmenu[1] = array(
	'title'	=> _MI_QRMODULE_HOME ,
	'link'	=> 'admin/index.php' ,
	'desc'	=> _MI_QRMODULE_HOME_DESC,
	'icon'	=> 'images/admin/home.png'
) ;

$adminmenu[] = array(
	'title'	=> _MI_QRMODULE_ABOUT ,
	'link'	=> 'admin/about.php' ,
	'desc'	=> _MI_QRMODULE_ABOUT_DESC,
	'icon'	=> 'images/admin/about.png'
) ;

$adminmenu[] = array(
	'title'	=> _MI_QRMODULE_LICENSE ,
	'link'	=> 'admin/license.php' ,
	'desc'	=> _MI_QRMODULE_LICENSE_DESC,
	'icon'	=> 'images/admin/license.png'
) ;

}
?>

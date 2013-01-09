<?php
/**
* uninstall.php - cleanup on module uninstall
*
* @copyright  Copyright © 2012 geekwright, LLC. All rights reserved. 
* @license    qr/docs/license.txt  GNU General Public License (GPL)
* @since      1.2
* @author     Richard Griffith <richard@geekwright.com>
* @package    qr
* @version    $Id$
*/

if (!defined("XOOPS_ROOT_PATH"))  die("Root path not defined");

function xoops_module_uninstall_qr_rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            xoops_module_uninstall_qr_rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

// hate to do this, but we need this function to have a module directory specific name
// only gets used once, so not a performance consideration
// we need to make sure we have qr generating code in a pre-install position
//    if we have two copies, get rid of trustpath copy
//    if just in trustpath, move it back to module so we can delete or reinstall later

$qrUninstallFunctionName='xoops_module_uninstall_'.basename( dirname ( dirname( __FILE__ ) ) ) ;

eval ('function '.$qrUninstallFunctionName.'(&$module) {
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$codedir=XOOPS_ROOT_PATH . "/modules/".$dir."/trust";
	$ourtrust=XOOPS_TRUST_PATH."/modules/".$dir;
	if(is_dir($codedir) && is_dir($ourtrust)) xoops_module_uninstall_qr_rrmdir($ourtrust);
	if(!is_dir($codedir) && is_dir($ourtrust)) rename($ourtrust, $codedir);	
	return true;
}');

?>
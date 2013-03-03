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

// recursively remove a directory
function xoops_module_uninstallx_qr_rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            xoops_module_uninstallx_qr_rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

// we will try to make sure we have qr generating code in a pre-install position
// if it doesn't work, there really isn't much we can/should do
function xoops_module_uninstallx_qr(&$module) {
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$codedir=XOOPS_ROOT_PATH . "/modules/".$dir."/trust";
	$ourtrust=XOOPS_TRUST_PATH."/modules/".$dir;
	// if we have two copies, get rid of trustpath copy
	if(is_dir($codedir) && is_dir($ourtrust)) xoops_module_uninstall_qr_rrmdir($ourtrust);
	// if just in trustpath, move it back to module so we can delete or reinstall later
	if(!is_dir($codedir) && is_dir($ourtrust)) rename($ourtrust, $codedir);	
	return true;
}

// hate to do this, but we need this function to have a module directory specific name
// only gets used once, so not a performance consideration
$qrUninstallFunctionName='xoops_module_uninstall_'.basename( dirname ( dirname( __FILE__ ) ) ) ;

eval ('function '.$qrUninstallFunctionName.'(&$module) {
	$result=xoops_module_uninstallx_qr($module);
	if(!$result(trigger_error("Automatic trust install failed."));
	return $result;
}');

?>

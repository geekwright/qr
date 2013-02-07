<?php
/**
* update.php - initializations on module update
*
* @copyright  Copyright © 2012 geekwright, LLC. All rights reserved. 
* @license    qr/docs/license.txt  GNU General Public License (GPL)
* @since      1.2
* @author     Richard Griffith <richard@geekwright.com>
* @package    qr
* @version    $Id$
*/
if (!defined("XOOPS_ROOT_PATH"))  die("Root path not defined");
# recursively remove a directory
function xoops_module_update_qr_rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            xoops_module_update_qr_rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

// hate to do this, but we need this function to have a module directory specific name
// only gets used once, so not a performance consideration
// remove trust directory from the update module if we don't need or want it
// if we don't have the trust folder in our module space, we won't do anything (admin just updated installed module)
// if we have two copies, get rid of old copy (new version or copy is being updated - this will fall thru to next)


$qrUpdateFunctionName='xoops_module_update_'.basename( dirname ( dirname( __FILE__ ) ) ) ;

eval ('function '.$qrUpdateFunctionName.'(&$module, $old_version) {
	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$codedir=XOOPS_ROOT_PATH . "/modules/".$dir."/trust";
	$ourtrust=XOOPS_TRUST_PATH."/modules/".$dir;
	if(is_writable( XOOPS_TRUST_PATH."/modules/" ) ) {
		if(is_dir($codedir) && is_dir($ourtrust)) xoops_module_update_qr_rrmdir($ourtrust);
		if(is_dir($codedir) && !is_dir($ourtrust)) {
			if(!is_dir(XOOPS_TRUST_PATH."/modules")) mkdir(XOOPS_TRUST_PATH."/modules");
			rename($codedir, $ourtrust );
		}
		return true;
	}
	$module->setErrors(XOOPS_TRUST_PATH . "/modules is not writable. See help.");
	return false;
}');

?>
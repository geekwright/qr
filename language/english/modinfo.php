<?php
/**
 * language - modinfo
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 */
if (!defined('XOOPS_ROOT_PATH')) die('Root path not defined');
if (!defined('_MI_QR_NAME')) {
// Module Info

// The name and description of module
define('_MI_QR_NAME', 'QR Module');
define('_MI_QR_DESC', 'QR Code Blocks for XOOPS and ImpressCMS');

// config options
define('_MI_QR_LIMIT_REFERER', 'Limit by Referer');
define('_MI_QR_LIMIT_REFERER_DSC', 'Restrict QR Code generation to requests from this site?');

define('_MI_QR_EC_LEVEL', 'Error Correction Level');
define('_MI_QR_EC_LEVEL_DSC', 'This controls the amount of error correction included in generated QR Codes. The hisher the level, the larger the code. The default is Level M.');

define('_MI_QR_ECL_L', 'Level L – up to 7% damage');
define('_MI_QR_ECL_M', 'Level M – up to 15% damage');
define('_MI_QR_ECL_Q', 'Level Q – up to 25% damage');
define('_MI_QR_ECL_H', 'Level H – up to 30% damage');

// Blocks
define('_MI_QR_MANUAL', 'Manual QR Code');
define('_MI_QR_MANUAL_DESC', 'Manual QR Code Block');

define('_MI_QR_HERE', 'This Page QR Code');
define('_MI_QR_HERE_DESC', 'This Page QR Code Block');

define('_MI_QR_MECARD', 'MECARD');
define('_MI_QR_MECARD_DESC', 'MECARD format QR Code');

define('_MI_QR_HEREX', 'This Page QR Code Extra');
define('_MI_QR_HEREX_DESC', 'This Page QR Code Block Extra - uses templates/blocks/qr_blockx_html');

define('_MI_QRMODULE_HOME', 'Home');
define('_MI_QRMODULE_HOME_DESC', 'Verify QR Installation');

define('_MI_QRMODULE_ABOUT', 'About');
define('_MI_QRMODULE_ABOUT_DESC', 'About QR');

define('_MI_QRMODULE_LICENSE','License');
define('_MI_QRMODULE_LICENSE_DESC','Details of the Multiple Licenses used in this module.');

// new in v1.3
define('_MI_QR_BOOKMARK', 'QR Bookmark This Page');
define('_MI_QR_BOOKMARK_DESC', 'Display Bookmark QR Code for Current Page.');
define('_MB_QR_MEBKM_LAUNCH', 'Click for QR Code&reg;');

define('_MI_QRMODULE_TROUBLESHOOT', 'Troubleshoot');
define('_MI_QRMODULE_TROUBLESHOOT_DESC', 'Troubleshooting Install Problems');

}
?>

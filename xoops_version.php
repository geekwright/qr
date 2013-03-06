<?php
/**
 * xoops_version
 *
 * @copyright	Geekwright, LLC http://geekwright.com
 * @license	GNU General Public License (GPL)
 * @since	1.0
 * @author	Richard Griffith richard@geekwright.com
 * @package	qr
 * @version	$Id$
 **/
if (!defined("XOOPS_ROOT_PATH")) die("Root path not defined");

$modversion['name'] = _MI_QR_NAME;
$modversion['dirname'] = basename( dirname( __FILE__ ) ) ;
$modversion['version'] = '1.3';
$modversion['description'] = _MI_QR_DESC;
$modversion['author'] = "Richard Griffith (geekwright.com)";
$modversion['credits'] = "QRcode scripts by Y.Swetake (swetake.com)";
$modversion['help'] = 'page=help';
$modversion['license'] = "Multiple: GPL V2, free software";
$modversion['license_url'] = XOOPS_URL.'/modules/'.$modversion['dirname'].'/admin/license.php';
$modversion['license_url'] = substr($modversion['license_url'],strpos($modversion['license_url'],'//')+2);
$modversion['official'] = 0;
if (defined("ICMS_ROOT_PATH")) $modversion['image'] = "images/icon_big.png";
else $modversion['image'] = "images/icon.png";

//about
$modversion['release_date']     = '2013/03/05';
$modversion["module_website_url"] = "geekwright.com";
$modversion["module_website_name"] = "geekwright.com";
$modversion["module_status"] = "RC";
$modversion['min_php']='5.2';
$modversion['min_xoops']='2.5';
$modversion['system_menu'] = 1;

// Admin things
$modversion['hasAdmin'] = 1;
$modversion['adminindex'] = 'admin/index.php';
$modversion['adminmenu'] = 'admin/menu.php';

// Menu
$modversion['hasMain'] = 1;

// Search
$modversion['hasSearch'] = 0;

// comments
$modversion['hasComments'] = 0;
// notification
$modversion['hasNotification'] = 0;

//$modversion['onInstall'] = 'include/install.php';
//$modversion['onUpdate'] = 'include/update.php';
//$modversion['onUninstall'] = 'include/uninstall.php';
// Config

$modversion['config'][1]=array(
  'name' => 'limit_referer',
  'title' => '_MI_QR_LIMIT_REFERER',
  'description' => '_MI_QR_LIMIT_REFERER_DSC',
  'formtype' => 'yesno',
  'valuetype' => 'int',
  'default' => '0');

$modversion['config'][]=array(
  'name' => 'ec_level',
  'title' => '_MI_QR_EC_LEVEL',
  'description' => '_MI_QR_EC_LEVEL_DSC',
  'formtype' => 'select',
  'valuetype' => 'text',
  'default' => 'M',
  'options' => array('_MI_QR_ECL_L'=>'L', '_MI_QR_ECL_M'=>'M', '_MI_QR_ECL_Q'=>'Q', '_MI_QR_ECL_H'=>'H')
  );


// Blocks
$modversion['blocks'][1] = array(
  'file' => 'blocks.php',
  'name' => _MI_QR_MANUAL,
  'description' => _MI_QR_MANUAL_DESC,
  'show_func' => 'b_qr_manual_show',
  'edit_func' => 'b_qr_manual_edit',
  'options' => XOOPS_URL.'|Site QR Code|0|'._MI_QR_POPUP_LAUNCH,
  'template' => 'qr_block.html');

$modversion['blocks'][] = array(
  'file' => 'blocks.php',
  'name' => _MI_QR_HERE,
  'description' => _MI_QR_HERE_DESC,
  'show_func' => 'b_qr_here_show',
  'edit_func' => 'b_qr_here_edit',
  'options' => 'page,post_id,itemid,topic_id,forum,storyid,lid|'._MI_QR_FOR_THIS_PAGE.'|0|0|'._MI_QR_POPUP_LAUNCH,
  'template' => 'qr_block.html');

$modversion['blocks'][] = array(
  'file' => 'blocks.php',
  'name' => _MI_QR_MECARD,
  'description' => _MI_QR_MECARD_DESC,
  'show_func' => 'b_qr_mecard_show',
  'edit_func' => 'b_qr_mecard_edit',
  'options' => '||||||||||'._MI_QR_DEFAULT_MECARD_ALT.'|0|'._MI_QR_POPUP_LAUNCH,
  'template' => 'qr_block.html');

$modversion['blocks'][] = array(
  'file' => 'blocks.php',
  'name' => _MI_QR_HEREX,
  'description' => _MI_QR_HEREX_DESC,
  'show_func' => 'b_qr_here_show',
  'edit_func' => 'b_qr_here_edit',
  'options' => 'page,post_id,itemid,topic_id,forum,storyid,lid|'._MI_QR_FOR_THIS_PAGE.'|0|0|'._MI_QR_POPUP_LAUNCH,
  'template' => 'qr_blockx.html');

$modversion['blocks'][] = array(
  'file' => 'blocks.php',
  'name' => _MI_QR_BOOKMARK,
  'description' => _MI_QR_BOOKMARK_DESC,
  'show_func' => 'b_qr_here_show',
  'edit_func' => 'b_qr_here_edit',
  'options' => 'page,post_id,itemid,topic_id,forum,storyid,lid|'._MI_QR_FOR_THIS_PAGE.'|0|0|'._MI_QR_POPUP_LAUNCH,
  'template' => 'qr_block_mebkm.html');

// Templates
$modversion['templates'][1]['file'] = 'qr_index.html';
$modversion['templates'][1]['description'] = 'Module Index';

?>

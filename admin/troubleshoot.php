<?php
include 'header.php';

function tablerow($cell,$flag=false) { if($flag) $cell='<font color="red">'.$cell.'</font>'; echo "<tr><td>$cell</td></tr>"; }
function tablehrow($cell) { echo "<tr><th><b>$cell</b></th></tr>"; }

function explainFilePermissions($file,$perms,$title,$src=false)
{
global $prc_owner, $prc_group, $pre_group;

	tablehrow($title);

	tablerow(sprintf("Testing: %s",$file));

	if(file_exists($file))
	{
		$src_owner=fileowner($file);
		$src_owner_info=posix_getpwuid($src_owner);
		tablerow(sprintf("Owner: %s - %s", $src_owner, $src_owner_info['name']));

		$src_group=filegroup($file);
		$src_group_info=posix_getgrgid($src_group);
		tablerow(sprintf("Group: %s - %s", $src_group, $src_group_info['name']));
	
		$fileperms=substr(sprintf('%o', fileperms($file)), -3);
		tablerow(sprintf("Permissions: %s",$fileperms));

		if (posix_access($file, $perms)) {
			tablerow(sprintf('%s has the required permissions.',$file));
			return 1;
		} else {
			$error = posix_get_last_error();
			tablerow(sprintf("Error %s: %s", $error, posix_strerror($error)),1);
			tablerow(sprintf('%s DOES NOT have the required permissions.',$file),1);
			if($perms & POSIX_R_OK) {
				if(!is_readable($file)) tablerow(sprintf("%s CAN NOT be read",$file),1);
			}
			if($perms & POSIX_W_OK) {
				if(!is_writable($file)) tablerow(sprintf("%s CAN NOT be written",$file),1);
			}	
			if($perms & POSIX_X_OK) {
				if(!@file_exists($file)) tablerow(sprintf("%s CAN NOT be traversed",$file),1);
			}
			$newperms[0]=substr($fileperms,0,1);
			$newperms[1]=substr($fileperms,1,1);
			$newperms[2]=substr($fileperms,2,1);
			if($src_owner==$prc_owner) {
				$newperms[0]='7';
				$description='Owner of process and %s are the same';
			} elseif ($src_group==$prc_group || $src_group==$pre_group) {
				$newperms[1]='7';
				$description='Group of process and %s are the same';
			} else {
				$newperms[2]='7';
				$description='Owner/Group of process and %s are totally different';
			}
			tablerow(sprintf($description,$file));
			tablerow(sprintf('For automatic installation, the suggested permission for %s is %s',$file,$newperms[0].$newperms[1].$newperms[2]));
			if($src) tablerow(sprintf('These permissions need to be applied to all files and subdirectories of %s.',$file,$newperms[0].$newperms[1].$newperms[2]));
			tablerow('Any suggested changes are only needed for automatic installation. Please revert any changes after successful install. You should consider manually correcting issues (using shell, file manager, ftp, scp or similar access) rather than applying world write permissions.');
	
			return 2;
		}
	} else {
		tablerow(sprintf("%s does not exist",$file));
		return 3;
	}
}

// recursively remove a directory
function rrmdir($dir) {
    foreach(glob($dir . '/*') as $file) {
        if(is_dir($file))
            rrmdir($file);
        else
            unlink($file);
    }
    rmdir($dir);
}

// remove trust directory from the update module if we don't need or want it
function autofix($codedir,$ourtrust) {
	if(!is_dir($codedir) && is_dir($ourtrust)) return true;
	if(is_writable( XOOPS_TRUST_PATH."/modules/" ) && is_writeable($codedir)) {
		// if we have two copies, get rid of old copy (new version or copy is being updated - this will fall thru to next)
		if(is_dir($codedir) && is_dir($ourtrust)) rrmdir($ourtrust);
		// move new copy into place, just like install
		if(is_dir($codedir) && !is_dir($ourtrust)) {
			if(!is_dir(XOOPS_TRUST_PATH."/modules")) mkdir(XOOPS_TRUST_PATH."/modules");
			return rename($codedir, $ourtrust );
		}
		return true;
	}
	return false;
}

	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$qrpath=XOOPS_TRUST_PATH.'/modules/'.$dir.'/php/';
	if($xoop25plus) $moduleAdmin->addConfigBoxLine($qrpath, 'folder');

	if($xoop25plus) echo $moduleAdmin->addNavigation('troubleshoot.php') ;
	else adminmenu(4);

	$dir = basename( dirname ( dirname( __FILE__ ) ) ) ;
	$codedir=XOOPS_ROOT_PATH . "/modules/".$dir."/trust";
	$ourtrust=XOOPS_TRUST_PATH."/modules/".$dir;

	$op='';
    if(!empty($_POST['op'])) $op=$_POST['op'];
    if($op=='codedir') {
		rrmdir($codedir);
	}
	unset($autoresult);
	if($op=='auto') {
		$autoresult=autofix($codedir,$ourtrust);
	}


	$showall=true;
	$showtrust=true;
	echo '<table width="100%">';
	if(isset($autoresult) && $autoresult==false) { tablerow('Attempt to Fix Failed',1); }
	if(!is_dir($codedir) && is_dir($ourtrust)) {
		tablehrow('Proper Installation');
		tablerow('Installation appears to have been successful.');
		tablerow('<img src="../getqrcode.php?qrdata=It+Worked%21" alt="This should be a QR code Image">');
		$showall=false;
	}
	if(is_dir($codedir) && is_dir($ourtrust)) {
		tablehrow('System Has Two Copies Of QR Library');
		tablerow(sprintf('The directory %s should be removed.', $codedir));
		$form='<form method="post"><input type="hidden" name="op" value="codedir"><input type="submit" value="'.'Attempt to Fix'.'"></form>';
		tablerow(sprintf($form));
		$showtrust=false;
	}
	if(is_dir($codedir) && !is_dir($ourtrust)) {
		tablehrow('QR Library is not in the required location');
		tablerow(sprintf('Move directory %s to %s.', $codedir,$ourtrust));
		$form='<form method="post"><input type="hidden" name="op" value="auto"><input type="submit" value="'.'Attempt to Fix'.'"></form>';
		tablerow(sprintf($form));
		$showtrust=true;
	}
	if(!is_dir($codedir) && !is_dir($ourtrust)) {
		tablehrow('QR Library NOT Found');
		tablerow('Re-Install from distribution archive to continue.');
	}

	if($showall) {
		tablehrow("Current User Information");
		$prc_owner=posix_getuid();
		$prc_owner_info=posix_getpwuid($prc_owner);
		tablerow(sprintf("User: %s - %s", $prc_owner, $prc_owner_info['name']));
		$prc_group=posix_getgid();
		$prc_group_info=posix_getgrgid($prc_group);
		tablerow(sprintf("Group: %s - %s", $prc_group, $prc_group_info['name']));
		$pre_group=posix_getegid();
		$pre_group_info=posix_getgrgid($pre_group);
		tablerow(sprintf("Effective Group: %s - %s", $pre_group, $pre_group_info['name']));

		// POSIX_F_OK - exits, POSIX_R_OK - read, POSIX_W_OK - write, POSIX_X_OK - execute
		$file = XOOPS_TRUST_PATH."/modules/";
		explainFilePermissions($codedir,POSIX_R_OK | POSIX_W_OK | POSIX_X_OK, "Distribution directory of QR Library",true);
		if($showtrust) {
			explainFilePermissions($file,POSIX_R_OK | POSIX_W_OK | POSIX_X_OK, "XOOPS_TRUST_PATH modules directory");
			explainFilePermissions($ourtrust,POSIX_R_OK | POSIX_W_OK | POSIX_X_OK, "XOOPS_TRUST_PATH directory for QR Library");
		}
	}

	echo '</table><br /><br />';

include "footer.php";
?>

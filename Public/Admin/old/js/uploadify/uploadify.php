<?php
/*
Uploadify
Copyright (c) 2012 Reactive Apps, Ronnie Garcia
Released under the MIT License <http://www.opensource.org/licenses/mit-license.php> 
*/

// Define a destination
$targetFolder ='/yy'; // Relative to the root

//$verifyToken = md5('unique_salt' . $_POST['timestamp']);
$data=array();
if (!empty($_FILES) ) {
	$tempFile = $_FILES['Filedata']['tmp_name'];
	$targetPath ="E:/website/" . $targetFolder;
	
	if(!file_exists($targetPath))
	{
		mkdir($targetPath);
	}

	$targetFile = rtrim($targetPath,'/') . '/' . $_FILES['Filedata']['name'];
	
	// Validate the file type
	$fileTypes = array('jpg','jpeg','gif','png'); // File extensions
	$fileParts = pathinfo($_FILES['Filedata']['name']);
	
	if (in_array($fileParts['extension'],$fileTypes)) {
		move_uploaded_file($tempFile,$targetFile);
		$data['url']=($_FILES['Filedata']['name']);
		$data['path']=$targetFolder."/".$_FILES['Filedata']['name'];
		echo json_encode($data);
	} else {
		echo 'Invalid file type.';
	}
}
?>
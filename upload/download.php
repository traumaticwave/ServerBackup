<?php
$file_name = trim($_GET['file']);
if(!empty($file_name)) {
	$file_path = 'files/'.$file_name;
	if(file_exists($file_path)) {
		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Disposition: attachment; filename=$file_name");
		header("Content-Type: application/octet-stream");
		header("Content-Transfer-Encoding: binary");

		readfile($file_path);
		exit;
	}
}

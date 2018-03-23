<?php
session_start();
$prevPage = $_SERVER['HTTP_REFERER'];

if(!empty($_FILES['files']['name'][0])) {
	$files = $_FILES['files'];
	$uploaded = array();
	$failed = array();

	$allowed = array('hwp', 'pdf', 'tex', 'jpg', 'png', 'gif');

	@$con = new mysqli('localhost', 'root', '8tty8lbm88_H', 'friends');
	if(mysqli_connect_error()) {
		echo 'Error : Could not connect to database. Please try again later.';
		exit;
	}
	$stmt = $con->prepare("INSERT INTO files (file_name, file_desc, name, ext) values (?,?,?,?)");
	

	foreach($files['name'] as $key => $file_name) {
		$tmp = $files['tmp_name'][$key];
		$error = $files['error'][$key];

		$name_arr = explode('.', $file_name);
		$ext = strtolower(end($name_arr));

		if($error === 0) {
			if(in_array($ext, $allowed)) {
				$date = date("m:d:h:i:s");
				$new_name = $date.'_'.$file_name;
				$destination = 'files/'.$new_name;
				if(move_uploaded_file($tmp, $destination)) {
					$uploaded[$key] = $new_name;
					$desc = $_POST['desc'];
					$stmt->bind_param("ssss", $new_name, $desc, $_SESSION['username'], $ext);
					$stmt->execute();
				} else {
					$failed[$key] = "[{$file_name}] failed to load.";
				}
			} else {
				$failed[$key] = "[{$file_name}] file extension '{$ext}' is not allowed.";
			}
		} else {
			$failed[$key] = "[{$file_name}] errored with code {$error}.";
		}
	}
	$stmt->close();
	$con->close();

	if(!empty($failed)) {
		print_r($failed);
	}

	header('location:'.$prevPage);
}
				

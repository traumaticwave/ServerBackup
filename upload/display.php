<?php
header('Content-Type: text/xml');

echo '<?xml version="1.0" encoding="UTF-8" standalone="yes" ?>';
echo '<response>';

$con = new mysqli("localhost", "root", "8tty8lbm88_H", "friends");
if(mysqli_connect_errno()) {
	die("sql connection failed");
}

$query = "select * from files";
$result = $con->query($query);
$num_results = $result->num_rows;

for($i=0; $i < $num_results; $i++) {
	$row = $result->fetch_assoc();
	$path = 'files/'.$row['file_name'];
	if( !file_exists($path) ) {
		continue;
	}

	echo '<file_name>'.$row['file_name'].'</file_name>';
	$size = filesize($path);
	echo '<file_size>'.$size.'</file_size>';
	echo '<file_desc>'.$row['file_desc'].'</file_desc>';
	echo '<name>'.$row['name'].'</name>';
	echo '<extension>'.$row['ext'].'</extension>';
}
echo '</response>';
$con->close();
?>

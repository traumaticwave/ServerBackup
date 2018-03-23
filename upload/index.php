<?php
session_start();
if(!isset($_SESSION['username'])) {
	header('location:../index.php');
}
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
  <!--
    Modified from the Debian original for Ubuntu
    Last updated: 2016-11-16
    See: https://launchpad.net/bugs/1288690
  -->
	<head>
    	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    	<title>Math Trauma</title>
    	<style type="text/css" media="screen">
  		* {
  		  margin: 0px 0px 0px 0px;
  		  padding: 0px 0px 0px 0px;
  		}
		</style>
		<link rel="stylesheet" href="../css/bootstrap.css">
	</head>

	<body onload="process()">
		<div class='container-fluid'> 
			<ul class="nav nav-pills navbar-right" role="tablist">
				<li data-toggle="modal" data-target="#uploadModal"><a>Upload</a></li> 
				<li id="logout"><a>logout</a></li>
			</ul>
		</div>
		<div id='file-display'></div>

	<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<script src="../js/Ajax_start.js"></script>
	<script src="process.js"></script>

	</body>
</html>

<div id="uploadModal" class="modal fade" role="dialog">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">UPLOAD</h4>
			</div>
			<div class="modal-body">
   				<form method="post" action="upload.php" enctype="multipart/form-data">
   				    <input type="file" name="files[]" class="form-control" multiple /><br/>
					<textarea name="desc" cols="50" rows="3" class="form-control"> </textarea><br/>
   				    <input id="upload" type="submit" value="submit" class="btn btn-warning"/>
   				</form>
			</div>
		</div>
	</div>
</div>

<script>
$(document).ready(function () {
	$('#upload').click(function () {
		$('#uploadModal').hide();
		location.reload();
	});

	$('#logout').click(function () {
		var action = "logout";
		$.ajax({
			url: "../action.php",
			method: "POST",
			data: { action: action },
			success: function () {
				location.href ='../index.php';
			}
		});
	});
});
</script> 

<?php
session_start();
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
		<meta name='viewport' content='width=device-width'/>
		<title>Math Trauma</title>
		<style type="text/css" media="screen">
		* {
		  margin: 0px 0px 0px 0px;
		  padding: 0px 0px 0px 0px;
		}
		</style>
		<link rel="stylesheet" href="myContent.css">  
		<link rel="stylesheet" href="css/bootstrap.css">
	</head>

	<body style="background-color: #2F2F31; color: white;"> 

	<div class="container-fluid">
<?php
if(isset($_SESSION['username']))
{
?>
		<ul class="nav nav-pills navbar-right" role="tablist">
			<li class="navbar-header">
				<a href="#"><?php echo $_SESSION['username']; ?> 파일 주세요.</a>
			</li>
			<li><a href='upload/index.php'>스터디 자료실</a></li>
			<li><a href="#" id="logout">Logout</a></li>
		</ul>
<?php
}
else
{
?>
		<ul class="nav navbar-nav navbar-right">
			<li name="login" id="login" data-toggle="modal" data-target="#loginModal"><a>Login</a></li> 
		</ul>
<?php
}
?>
	</div> <!-- container -->
	
	<br/>
	<br/>
	
	<div id='my_content'>	
		<div class="loading">
			<div class="loading-text">
				<span class="loading-text-words">M</span>
				<span class="loading-text-words">A</span>
				<span class="loading-text-words">T</span>
				<span class="loading-text-words">H</span>
				<span class="loading-text-words"> </span>
				<span class="loading-text-words">T</span>
				<span class="loading-text-words">R</span>
				<span class="loading-text-words">A</span>
				<span class="loading-text-words">U</span>
				<span class="loading-text-words">M</span>
				<span class="loading-text-words">A</span>
			</div>
		</div>
		<br/><br/>
		<h3 align="center"><a href="puzzle/Rubik1.html">Puzzle</a></h3>
	</div>
</body>
</html>

<div id="loginModal" class="modal fade" role="dialog" style="color:black;">
	<div class="modal-dialog">
		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Login</h4>
			</div>
			<div class="modal-body">
				<label>Username</label>
				<input type="text" name="username" id="username" class="form-control" />
				<br />
				<label>Password</label>
				<input type="password" name="password" id="password" class="form-control" />
				<br />
				<button type="button" name="login_button" id="login_button" class="btn btn-warning">Shoot</button>
			</div>
		</div>
	</div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
<script src="js/bootstrap.js"></script>
<script>
$(document).ready(function () {
	$('#login_button').click(function () {
		var username = $('#username').val();
		var password = $('#password').val();
		if (username != '' && password != '') {
			$.ajax({
				url: "action.php",
				method: "POST",
				data: { username: username, password: password },
				success: function (data) {
					if (data == 'No') {
						alert("Wrong Data");
					} else {
						$('#loginModal').hide();
						location.reload();
					}
				}
			});
		} else {
			alert("Both Fields are required");
		}
	});

	$('#logout').click(function () {
		var action = "logout";
		$.ajax({
			url: "action.php",
			method: "POST",
			data: { action: action },
			success: function () {
				location.reload();
			}
		});
	});
});
</script> 

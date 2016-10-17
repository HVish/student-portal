<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<title>JECRC Student Portal</title>
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/css/bootstrap.min.css" />
	<link rel="stylesheet" href="<?php echo base_url(); ?>assets/css/login.css" media="screen" title="no title">
	<style media="screen">
		body {
			background: #eee url(<?php echo base_url(); ?>assets/images/sativa.png);
		}

		.avatar {
			background: url(<?php echo base_url(); ?>assets/images/user.png);
			opacity: 0.55;
		}
	</style>
</head>

<body>
	<div class="container">
		<div class="login-container">
			<div id="output"></div>
			<div class="avatar"></div>
			<div class="form-box">
				<form action="" method="">
					<input name="user" type="text" placeholder="username">
					<input type="password" placeholder="password">
					<button class="btn btn-info btn-block login" type="submit">Login</button>
				</form>
			</div>
		</div>
	</div>
</body>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.0.0-alpha/js/bootstrap.min.js"></script>
<script src="<?php echo base_url(); ?>assets/js/login.js" charset="utf-8"></script>

</html>

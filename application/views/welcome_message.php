<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Documentation route</title>
	<!-- Compiled and minified CSS -->
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

	<!-- Compiled and minified JavaScript -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
</head>
<body>
	
	<nav class="blue">
		<div class="nav-wrapper container">
			<a href="#" class="brand-logo"><b>Stock Photo</b> <small>Documentation</small></a>
			<ul id="nav-mobile" class="right hide-on-med-and-down">
				<li><a href="#">Documentation</a></li>
				<li><a href="#">Help</a></li>
			</ul>
		</div>
	</nav>

	<div class="container">
		
		<h3>Documentaton Auth API</h3>
		<table class="table-striped">
			<thead>
				<tr>
					<th>URL</th>
					<th>Method</th>
					<th>Parameter</th>
					<th>Return</th>
					<th>Purpose</th>
				</tr>
			</thead>

			<tbody>
				<tr>
					<td><?=base_url()?>v1/Auth/Register</td>
					<td>POST</td>
					<td>
						username <br>
						email <br>
						password <br>
						password_confirmation
					</td>
					<td>
						Message <br>
						Error
					</td>
					<td>Create new account</td>
				</tr>
				<tr>
					<td><?=base_url()?>v1/Auth/Login</td>
					<td>POST</td>
					<td>
						email <br>
						password
					</td>
					<td>
						Message <br>
						Error <br>
						<i class="red-text">Token</i>
					</td>
					<td>Login to your account</td>
				</tr>
				<tr>
					<td><?=base_url()?>v1/Auth/Logout?token=<i class="red-text">{token}</i></td>
					<td>GET</td>
					<td>
					</td>
					<td>
						Message <br>
						Error <br>
					</td>
					<td>Logout from current account</td>
				</tr>
			</tbody>
		</table>

	</div>

</body>
</html>
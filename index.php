

<head>
	<title>Welcome to Informatics College</title>
</head>
 <link rel="stylesheet" type="text/css" href="./Assets/css/login.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<body>


<div class="login-body">

<div class="login">
	<h1>
		Admin
	</h1>

 <form action="./functions/authenticate.php" method="POST">
	<label for="username"> 
      <i class="fa fa-user"></i>
	</label>
	<input type="text" name="username" placeholder="Username" id="username" required>
	<label for="password">
		<i class="fa fa-lock"></i>
	</label>
	<input type="password" name="password" placeholder="Password" id="password" required>
	<input type="submit" name="btn-submit" value="Login">
 </form>
</div>
</div>
</body>
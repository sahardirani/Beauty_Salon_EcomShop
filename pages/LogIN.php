<!DOCTYPE html>
<html>
<head>
	<title>Login Page</title>
	<style>
		body {
			font-family: Arial, sans-serif;
			background-color: #f2f2f2;
		}

		.container {
			width: 300px;
			margin: 100px auto;
			padding: 20px;
			background-color: #fff;
			border-radius: 5px;
			box-shadow: 0 0 10px rgba(0,0,0,0.3);
		}

		h1 {
			text-align: center;
			color: #333;
			margin-top: 0;
		}

		label {
			display: block;
			margin-bottom: 10px;
			color: #666;
		}

		input[type="text"], input[type="password"] {
			width: 100%;
			padding: 10px;
			border-radius: 3px;
			border: none;
			box-shadow: 0 0 5px rgba(0,0,0,0.1);
			margin-bottom: 20px;
			box-sizing: border-box;
		}

		input[type="submit"] {
			background-color: #333;
			color: #fff;
			padding: 10px;
			border-radius: 3px;
			border: none;
			cursor: pointer;
		}

		input[type="submit"]:hover {
			background-color: #555;
		}
        input[type="text"], input[type="password"] {
  border: 1px solid #ccc;
  padding: 8px;
  border-radius: 4px;
}

	</style>
</head>
<body>

<div class="container">
    <h1>Login</h1>
    <form id="login-form" action='ProccessLog.php' method='POST'>

        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <input type="submit" value="Login" id="submit-btn">
    </form>
</div>





</body>
</html>

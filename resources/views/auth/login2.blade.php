<!DOCTYPE html>
<html>
	 <head>
	  <meta charset="UTF-8">
	  <meta name="viewport" content="width=device-width, initial-scale-1.0">
	  <meta http-equiv="X-UA-Compatible" content="ie=edge">
	   <link href="css/style.css" rel="stylesheet">
	</head>
	  <title>Вход</title>
	</head>
	<body>
		<div class="container">
			<div class="message"></p>
			</div>
			<div class="logo">
				<img class='logo-img' src ="img/logo.png">
				<form class="login-form" action="" method="POST">
					<span>Введите Ваш логин</span><br>
					<input type="text" placeholder="Логин" name="login"><br>
					<span>Введите Ваш пароль</span><br>
					<input type="password" placeholder="Пароль" name="password"><br>
					<input class='login-button' type="submit" value="Войти">
					<a href="pass_update.php" style="font-size: 14px">Не могу войти</a>
				</form>
			</div>
		</div>
	</body>
</html>
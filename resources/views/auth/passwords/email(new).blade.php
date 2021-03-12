<!DOCTYPE html>
<html>
     <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale-1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <link href="../css/style.css" rel="stylesheet">
	</head>
	  <title>Восстановление пароля</title>
	</head>
	<body>
		<div class="container">
			<div class="message">
				@if (session('status'))
                        
                            На вашу почту отправлена ссылка для изменения пароля
                        
                    @endif
			</div>
			<div class="logo">
				<img class='logo-img' src ="../img/logo.png">
				<form class="login-form" action="{{ route('password.email') }}" method="POST">
					@csrf
					<span>Введите Ваш e-mail</span><br>
					<input id="email" type="email" placeholder="Email" name="email" class="form-control @error('email') is-invalid @enderror" required autocomplete="email" autofocus>
					@error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
					<br>
					
					<button type="submit" class="btn btn-primary">
                            Отправить
                    </button>
					<a href="/login" style="font-size: 14px">Назад</a><br>
				</form>
			</div>
		</div>
	</body>
</html> 
<!DOCTYPE html>
<html>
     <head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale-1.0">
      <meta http-equiv="X-UA-Compatible" content="ie=edge">
       <link href="../../css/style.css" rel="stylesheet">
  </head>
    <title>Смена пароля</title>
  </head>
  <body>
    <div class="container">
      <div class="message">
        
      </div>
      <div class="logo">
        <img class='logo-img' src ="../../img/logo.png">
        <form class="login-form" action="{{ route('password.update') }}" method="POST">
        	<input type="hidden" name="token" value="{{ $token }}">
          @csrf
          <input id="email"  type="hidden" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus>
          @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
          @enderror
          <br>
          <span>Введите новый пароль</span><br>
          <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password"><br>
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    <span>Подтвердите пароль</span><br>
                     <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password"><br>
          <button type="submit" class="btn btn-primary">
                            Сбросить
                    </button>
          <a href="/login" style="font-size: 14px">Назад</a><br>
        </form>
      </div>
    </div>
  </body>
</html> 
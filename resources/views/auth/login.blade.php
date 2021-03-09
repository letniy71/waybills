
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
            <div class="logo">
                <img class='logo-img' src ="img/logo.png">
                    <form class="login-form" method="POST" action="{{ route('login') }}">
                        @csrf
                        <span>Введите Ваш логин</span><br>
                        <input placeholder="Логин" id="login" type="name" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autocomplete="login" autofocus><br>

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                                    
                        <span>Введите Ваш пароль</span><br>
                        <input placeholder="Пароль" id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password"><br>

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                                    
                        <button type="submit" class="btn btn-primary">
                            Вход
                        </button>

                        @if (Route::has('password.request'))
                            <a class="btn btn-link" href="{{ route('password.request') }}">
                                Не могу войти
                            </a>
                        @endif     
                    </form>      
                </div>         
        </div>
    </body>
</html> 

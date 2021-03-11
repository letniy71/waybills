<!DOCTYPE html>

<html>
	<head>
    	<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale-1.0">
    	<meta http-equiv="X-UA-Compatible" content="ie=edge">
    	<title>Путевые Листы</title>
        <link href="{{ URL::asset('css/style.css') }}" rel="stylesheet" type="text/css" >
    	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    	<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
        <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
        <link href="../js/dist/jquery.formstyler.css" rel="stylesheet" />
        <link href="../js/dist/jquery.formstyler.theme.css" rel="stylesheet" />
        <script src="http://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        <script src="../js/dist/jquery.formstyler.min.js"></script>
        <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
        <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
        <script src="{{ asset("js/app.js") }}"></script>
	</head>



	<body>
		<header>
			<div class="logo-img-header">
				 <a href ="/"><img src ="../img/logo.png"></a>
			</div>
			<div class="container-header">
				<div class="row">
					<div class="col-lg-6 col-xs-6">
						Вы зашли как {{Auth::user()->name}}
					</div>
					<div class="col-lg-1 col-xs-1">
						<a class="setting-links" href="../pages/report_admin.php">Отчеты</a>
					</div>
					<div class="col-lg-1 col-xs-1">
						<a class="setting-links" href="/settings">Настройки</a>
					</div>
					<div class="col-lg-1 col-xs-1">
						<a class="setting-links" href="../pages/support.php">Помощь</a>
					</div>
					<div class="col-lg-3 col-xs-3" style="text-align: right;">
                            <a  href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Выход
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
					</div>
				</div>
				<div style="clear: left;"></div>
			</div>

		</header>

@yield('content')

<footer class="footer">
    <p>&#174; Петров Игорь </p>
</footer>
</body>
</html>

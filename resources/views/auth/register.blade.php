@extends('layouts.site')



@section('content')
<main>
<div class="table-main catalog">
		<table>
			<thead>
				<tr>		
					<th>Имя</th>
					<th>Логин</th>
					<th>E-mail</th>
					<th>Тип УЗ</th>
					<th>Бригада</th>
					<!--<th>Редактировать</th>-->
					<th>Удалить</th>
				</tr>
			</thead>
			@foreach ($users as $row)
      		<tbody>
      			<tr>
		  			<td data-label="Имя">{{$row->name}}</td>
		  			<td data-label="Логин">{{$row->login}}</td>
		  			<td data-label="E-mail">{{$row->email}}</td>
		  			<td data-label="Тип УЗ">{{$row->role->name}}</td>
		  			<td data-label="Бригада">{{$row->brigade->nameBrigade}}</td>
		  			<!--<td data-label="Редактировать">
		  				<form action="" method="post">
		            		<input type="hidden"  name="id" value="{{$row->id}}">
		            		<input class="button_form catalog-input" type="submit" value="редактировать">
		            		{{ csrf_field()}}
		          		</form>
		  			</td>	-->  			
		  			<td data-label="Удалить">
		          		<form action="{{route('delete-register')}}" method="post">
		            		<input type="hidden"  name="id" value="{{$row->id}}">
		            		<input class="button_form catalog-input" type="submit" value="удалить">
		            		{{ csrf_field()}}
		          		</form>
		            </td>
	  			</tr>
	  		</tbody>
		@endforeach

		</table>
	</div>





<div class="content">
      <button class="show_popup blue_btn catalog_button" rel="popup1">Добавить</button>
    </div>
    <div class="overlay_popup"></div>
    <div class="popup" id="popup1">
	    <div class="object">
	    	<div class="header_popup">
	    		<h4>Добавить Пользователя</h4>
	    	</div>
	    	<div class="form">
				<form method="POST" action="{{ route('register') }}">
					@csrf
					<div class="container" style="margin-top: 20px;">
				      <div class="row">
				        <div class="col-lg-4">
				        	<span>Имя</span>
				        	</div>
				        <div class="col-lg-8">
							 <input class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus id="name" type="text" name="name">
							@error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                            @enderror
						</div>
				      </div>
				      <div class="row">
				        <div class="col-lg-4">
				        	<span>Логин</span>
				        </div>
				        <div class="col-lg-8">
							 <input class="form-control" type="text" name="login">
						</div>
				      </div>
					  <div class="row">
				        <div class="col-lg-4">
				        	<span>Пароль</span>
				        </div>
				        <div class="col-lg-8">
							 <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
				      </div>
				      <div class="row">
				        <div class="col-lg-4">
				        	<span>Подтвердите парлоль</span>
				        </div>
				        <div class="col-lg-8">
							 <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
						</div>
						
				      </div>
					  <div class="row">
				        <div class="col-lg-4">
				        	<span>E-mail</span>
				        </div>
				        <div class="col-lg-8">
							 <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
						</div>
				      </div>
					      <div class="styled-select">
					        <div class="select">
					        	<div class="row">
					          		<div class="col-lg-4">
					            		<span>Тип учетной записи</span>
					          		</div>
					          	<div class="col-lg-8">
					            <div class="select">
									<select name="role">
									@foreach ($role as $row)
			                          <option value="{{$row->name}}">{{$row->name}}</option>
			                        @endforeach
					      </select>
					      </div>
					      </div>			      				      				      
				  	</div>
				  </div>
				</div>
				<div class="styled-select">
					        <div class="select">

					        <div class="row">
					          <div class="col-lg-4">
					            <span>Бригада</span>
					          </div>
					          <div class="col-lg-8">
					            <div class="select">
							<select name="nameBrigade">
								@foreach ($brigade as $row)
			                          <option value="{{$row->nameBrigade}}">{{$row->nameBrigade}}</option>
			                    @endforeach
					      </select>
					      </div>
					      </div>			      				      				      
				  	</div>
				  </div>
				</div>
				  	<input type="submit" value="добавить">
				  	{{ csrf_field()}}
				</form>
			</div>
	<script src="jquery/jquery-1.11.2.min.js"></script> 
  <script>
    $('.show_popup').click(function() {
    var popup_id = $('#' + $(this).attr("rel"));
    $(popup_id).show();
    $('.overlay_popup').show();
})
$('.overlay_popup').click(function() {
    $('.overlay_popup, .popup').hide();
})
  </script>
</main>
@endsection()
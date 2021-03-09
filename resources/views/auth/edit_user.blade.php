@extends('layouts.site')



@section('content')

<main>
	<div class="table-main catalog">
		<form action="{{route('edit-register-user')}}" method="POST">
			<table><h6>Логин {{$users->login}}</h6>
        		<thead>
		          <tr>
		            <th>Имя</th>
		            <th>Пароль</th>
		            <th>e-mail</th>
		            <th>Тип УЗ</th>
		            <th>Бригада</th>
		          </tr>
		        </thead>
		        <tbody>
		        	<input type="hidden" name="id" value="'. $id .'">
		        	<td data-label="Имя"><input type="text" name="name" value="{{$users->name}}"></td>
		        	<td data-label="Пароль"><input type="password" name="password" value="{{$users->password}}"></td>
		        	<td data-label="e-mail"><input type="email" name="email" value="{{$users->email}}"></td></td>
		        	<td>
			        	<div class="select">
			        		<select name="role">
				        		@foreach ($role as $row)
		                          <option value="{{$row->name}}">{{$row->name}}</option>
		                        @endforeach
	                    	</select>
                    	</div>
                	</td>
                	<td>
			        	<div class="select">
			        		<select name="nameBrigade">
				        		@foreach ($brigade as $row)
		                          <option value="{{$row->nameBrigade}}">{{$row->nameBrigade}}</option>
		                        @endforeach
	                    	</select>
                    	</div>
                	</td>
                	 </tbody>
      </table>
      <input class="edit" type="submit" value="Изменить">
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
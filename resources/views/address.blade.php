@extends('layouts.site')



@section('content')
<main>
	<div class="table-main catalog">
    <h6 style="margin-bottom: 20px;">Адреса</h6>
	<table>
		<thead>
		<tr>
			<th>Адрес</th>
			<th>Бригада</th>
			<th>Удалить</th>
		</tr>
		</thead>
		@foreach ($address as $row)
      <tbody><tr>
  			<td data-label="Адрес">{{$row->address}}</td>
  			<td data-label="Бригада">{{$row->brigade->nameBrigade}}</td>
  			<td data-label="Удалить">
          <form action="{{route('delete-address')}}" method="post">
            <input type="hidden"  name="idAddress" value="{{$row->idAddress}}">
            <input class="button_form catalog-input" type="submit" value="удалить">
            {{ csrf_field()}}
          </form>

            </td>
  		</tr></tbody>
		@endforeach

	</table>
</div>


  <div class="content">
      <button class="show_popup blue_btn catalog_button" rel="popup1">Добавить</button>
  </div>

  <div class="overlay_popup"></div>

  <div class="popup catalog-popup" id="popup1">
    <div class="object">
      <div class="header_popup">
        <h4>Добавить адрес</h4>
      </div>
      <div class="form">
        <form action="/address" method="POST">
          <div class="container" style="margin-top: 20px;">
            <div class="row">
              <div class="col-lg-4">
                <span>Адрес</span>
              </div>
              <div class="col-lg-8">
                <input  required type="text" name="address">
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
                      <select name="name_brigade_address">
                        @foreach ($brigade as $row)
                          <option value="{{$row->nameBrigade}}">{{$row->nameBrigade}}</option>
                        @endforeach
                      </select>
                    </div>
                  </div>
                </div>
              </div>
              <input type="submit" value="добавить">
              {{ csrf_field()}}
           </form>
          </div>
        </div>
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
    </div>
  </div>




</main>
@endsection()

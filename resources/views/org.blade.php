@extends('layouts.site')



@section('content')
<main>
	<div class="table-main catalog">
    <h6 style="margin-bottom: 20px;">Подрядчик</h6>
	<table>
		<thead>
		<tr>
			<th>Навзание подрядчика</th>
			<th>Удалить</th>
		</tr>
		</thead>
		@foreach ($org as $row)
      <tbody><tr>
  			<td data-label="Навзание подрядчика">{{$row->nameOrganization}}</td>
        <td>
    			<form action="{{route('delete-org')}}" method="post">
              <input type="hidden"  name="id" value="{{$row->idorganization}}">
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
        <h4>Добавить организацию</h4>
      </div>
      <div class="form">
        <form action="/org" method="POST">
          <div class="container" style="margin-top: 20px;">
            <div class="row">
              <div class="col-lg-4">
                <span>Подрядчик</span>
              </div>
              <div class="col-lg-8">
                <input type="text" name="nameOrganization">
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

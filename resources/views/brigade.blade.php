@extends('layouts.site')



@section('content')
<main>
	<div class="table-main catalog">
    <h6 style="margin-bottom: 20px;">Бригады</h6>
	<table>
		<thead>
		<tr>
			<th>Навзание бригады</th>
      <th>Навзание организации</th>
			<th>Удалить</th>
		</tr>
		</thead>
    

    @foreach ($brigade as $row)
      <tbody><tr>
              <td data-label="Навзание подрядчика">{{$row->nameBrigade}}</td>
        <td data-label="Навзание организации">{{$row->organization->nameOrganization}}</td>
        <td data-label="Удалить">
          <form action="{{route('delete-brigade')}}" method="post">
            <input type="hidden"  name="id" value="{{$row->idBrigade}}">
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
        <h4>Добавить бригаду</h4>
      </div>
      <div class="form">
        <form action="/brigade" method="POST">
          <div class="container" style="margin-top: 20px;">
            <div class="row">
              <div class="col-lg-4">
                <span>Бригада</span>
              </div>
              <div class="col-lg-8">
                <input required type="text" name="nameBrigade">
              </div>            
            </div>
            <div class="styled-select">
              <div class="select">
                <div class="row">
                  <div class="col-lg-4">
                    <span>Подрядчик</span>
                  </div>
                  <div class="col-lg-8">
                    <div class="select">
                      <select name="name_organization_auto">
                        @foreach ($org as $row)
                          <option value="{{$row->nameOrganization}}">{{$row->nameOrganization}}</option>
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

@extends('layouts.site')



@section('content')

<main>
    <div class="row">
        <div class="col-md-6">
            <div class="date_form ">
                <form action="{{route('all-waybills')}}" method="GET">
                    <span>Выберите дату</span>
                    <input autocomplete="off"  type="text"  class="datepicker" name="date" >
                    <input class="date_button" type="submit" value="Выбрать">
                </form>
            </div>
        </div>
    <div class="col-md-6 text-right"><a href ="allxlsx.php"><button class="blue_btn alldown">Скачать все</button></a></div>
  </div>
	<div class="table-main catalog">
    <h6 style="margin-bottom: 20px;">Путевые листы за 
    @if(!empty($_GET['date']))
    {{$_GET['date']}}
    @endif
    </h6>
	<table>
		<thead>
		<tr>
        <th>Серия</th>
        <th>Номер</th>
        <th>Гос.Номер</th>
        <th class="hidden_table">Модель авто</th>
        <th>Водитель</th> 
        <th  class="hidden_table">Диспетчер</th>
        <th  class="hidden_table">Механик</th>
		</tr>
		</thead>

        @if(isset($waybills))
		@foreach ($waybills as $row)
      <tbody><tr>
  			<td data-label="Серия">{{$row->serialWay}}</td>
        <td data-label="Номер">{{$row->numberWay}}</td>
        <td data-label="Гос.Номер">{{$row->auto->number}}</td>
        <td data-label="Модель авто">{{$row->auto->model}}</td>
        <td data-label="Водитель">{{$row->drivers->name}}</td>
        <td data-label="Диспетчер">{{$row->dispatchers->nameDispatcher}}</td>
        <td data-label="Механик">{{$row->mechanics->nameMechanic}}</td>
  		</tr></tbody> 
		@endforeach
        @endif

	</table>
    
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

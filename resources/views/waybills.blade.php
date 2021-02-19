@extends('layouts.site')



@section('content')

<main>
	<div class="table-main catalog">
    <h6 style="margin-bottom: 20px;">Путевые листы за</h6>
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

	</table>
    тут{{dump($user_role)}}
</div>


</main>
@endsection()

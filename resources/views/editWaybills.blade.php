@extends('layouts.site')
@section('content')

<main>
	<div class="table-main catalog">
		<form action="{{route('edit-waybills')}}" method="POST">
			<table>
				<h6>Серия {{$waybill->serialWay}}\ Номер {{$waybill->numberWay}}\ Дата {{$waybill->date}}</h6>
        		<thead>
		          <tr>
		            <th>Водитель</th>
		            <th>Номер</th>
		            <th>Время по графику</th>
		          </tr>
		        </thead>
        		<tbody>
					<input type="hidden" name="idWaybills" value="{{$waybill->idWaybills}}">
                	<td data-label="Водитель">
                		<div class="select">
                			<select name="name_drivers_waybill">;
				                @foreach ($drivers as $row)
				                  <option value="{{$row->name}}">{{$row->name}}</option>
				                @endforeach
				            </select>
				        </div>
				    </td>
				    <td data-label="Номер авто">
                		<div class="select">
                			<select name="number_auto_waybill">;
				                @foreach ($auto as $row)
				                  <option value="{{$row->number}}">{{$row->number}}</option>
				                @endforeach
				            </select>
				        </div>
				    </td>
				    <td data-label="Время по графику">
                		<div class="select">
                			<select name="typeWB">;
				                @foreach ($typeWB as $row)
				                  <option value="{{$row->type}}">{{$row->type}}</option>
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
	<div class="back_button">
		<a href="/waybills/?date={{$waybill->date}}"><button>Назад</button></a>
	</div>
</main>


@endsection()
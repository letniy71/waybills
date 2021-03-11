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
        <th>Дата</th>
        <th>Серия</th>
        <th>Номер</th>
        <th>Гос.Номер</th>
        <th>Модель авто</th>
        <th>Водитель</th> 
        <th>Диспетчер</th>
        <th>Механик</th>
        <th>Время по графику</th>
        <th>Редактировать</th>
        @if(Auth::user()->idRole == 1)
            <th>Удалить</th>
        @endif
		</tr>
		</thead>

        @if(isset($waybills))
    		@foreach ($waybills as $row)
                <tbody>
                    <tr>
                        <td data-label="Серия">{{$row->date}}</td>
                  		<td data-label="Серия">{{$row->serialWay}}</td>
                        <td data-label="Номер">{{$row->numberWay}}</td>
                        <td data-label="Гос.Номер">{{$row->auto->number}}</td>
                        <td data-label="Модель авто">{{$row->auto->model}}</td>
                        <td data-label="Водитель">{{$row->drivers->name}}</td>
                        <td data-label="Диспетчер">{{$row->dispatchers->nameDispatcher}}</td>
                        <td data-label="Механик">{{$row->mechanics->nameMechanic}}</td>
                        <td data-label="Время по графику">{{$row->typeWB->type}}</td>
                        <td data-label="Редактировать">
                            <form action="{{route('show-edit-waybills')}}" method="GET">
                                <input type="hidden" name="idWaybills" value="{{$row->idWaybills}}">
                                <input type="hidden"  name="date" value="{{$row->date}}">
                                <input class="button_form"  type="submit" value="редактировать">
                            </form>
                        </td>
                        @if(Auth::user()->idRole == 1)
                            <td data-label="Удалить">
                              <form action="{{route('delete-waybills')}}" method="post">
                                <input type="hidden"  name="idWaybills" value="{{$row->idWaybills}}">
                                <input type="hidden"  name="date" value="{{$row->date}}">
                                <input class="button_form catalog-input" type="submit" value="удалить">
                                {{ csrf_field()}}
                              </form>
                            </td>
                        @endif
          		    </tr>
                </tbody> 
    		@endforeach
        @endif
	</table> 
</div>

@if(!empty($_GET['date']))
<div class="content">
    <button class="show_popup blue_btn" rel="popup1">Добавить</button>
</div>
 <div class="overlay_popup"></div>
  <div class="popup" id="popup1">
    <div class="object">
        <div class="header_popup">
            <h4>Формирование путевого листа</h4>
        </div>
      

        <form action="{{route('add-waybills')}}" method="POST">
            <table>
                <thead>
                  <tr>
                    <th>Водитель</th>
                    <th>Номер</th>
                    <th>Время по графику</th>
                    <th>Добавить</th>
                  </tr>
                </thead>
                <tbody>
                    @for ($i=1; $i<=10; $i++)
                        <tr>
                            <input type="hidden" name="date" value="{{$_GET['date']}}">
                            <input type="hidden" name="brigade" value="{{Auth::user()->idBrigade}}">
                            <td>
                                <div class="select">
                                    <select name="name_drivers_waybill{{$i}}">
                                        @foreach ($drivers as $row)
                                            <option value="{{$row->name}}">{{$row->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="select">
                                    <select name="number_auto_waybill{{$i}}">
                                        @foreach ($auto as $row)
                                            <option value="{{$row->number}}">{{$row->number}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <div class="select">
                                    <select name="typeWB{{$i}}">
                                        @foreach ($typeWB as $row)
                                            <option value="{{$row->type}}">{{$row->type}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </td>
                            <td>
                                <input type="checkbox" name="checkWaybill{{$i}}" value="Yes" />
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
            <input class="button_form" type="submit" value="добавить">
            {{ csrf_field()}}
        </form>
        @endif
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

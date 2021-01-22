<main>
	<div class="table-main catalog">
	<table>
		<thead>
		<tr>
			<th>Модель</th>
			<th>Номер</th>
			<th>Бригада</th>
			<th>Удалить</th>
		</tr>
		</thead>

		@foreach ($auto as $row)
      <tbody><tr>
  			<td data-label="Модель">{{$row['model']}}</td>
  			<td data-label="Номер">{{row['number']}}</td>
  			<td data-label="Бригада">{{$row['name_brigade']}}</td>
  			<td data-label="Удалить"><a href ="del.php?id=' . $row['idAuto']. '"><input class="button_form catalog-input" type="submit" value="удалить"></a></td>
  		</tr></tbody>
		@endforeach

	</table>
</div>

</main>

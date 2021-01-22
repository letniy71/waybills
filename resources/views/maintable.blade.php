

<main>
  <div class="row">
    <div class="col-md-6">
      <div class="date_form ">
    <form action="" method="GET">
      <span>Выберите дату</span>
    </form>
  </div>
    </div>
    <div class="col-md-6 text-right"><a href ="allxlsx.php"><button class="blue_btn alldown">Скачать все</button></a></div>
  </div>
  
    
  

  <div class="table-main">
    <h6 style="margin-bottom: 20px;">Путевые листы за <?php if (!empty($_GET['date'])) {echo $_GET['date'];}?></h6>
    <table>
      <thead>
      <tr>
				<th>Дата</th>
				<th>Серия</th>
				<th>Номер</th>
        <th>Гос.Номер</th>
        <th class="hidden_table">Модель авто</th>
        <th>Водитель</th>
        <th>Подразделение заказчика</th>    
        <th>Время начала работы</th>
        <th  class="hidden_table">Время работы</th>
        <th  class="hidden_table">Диспетчер</th>
        <th  class="hidden_table">Механик</th>
        <th>Пробег до</th>
        <th>Пробег после</th>
        <th>Пробег</th>
        <th>Подразделение</th>
        <th>Пробег до</th>
        <th>Пробег после</th>
        <th>Добавить</th>
        <th>Скачать</th>
        <th>Редактировать</th>
			</tr>
    </thead>
		<?php

				$result = '';
			foreach($data as $row){
        $diff = $row['mileageWB_after'] - $row['mileageWB_before'];
				$result .= '<tbody><tr>';
				$result .= '<td data-label="Дата">' . $row['date'] . '</td>';
				$result .= '<td data-label="Серия"> ' . $row['serialWay'] . '</td>';
				$result .= '<td data-label="Номер">' . $row['numberWay'] . '</td>';
        $result .= '<td data-label="Гос.Номер">' . $row['auto_number'] . '</td>';
        $result .= '<td class="hidden_table" data-label="Модель">' . $row['model'] . '</td>';
        $result .= '<td data-label="Водитель">' . $row['drivers_name'] . '</td>';
        $result .= '<td data-label="Подразделение">' . $row['department'] . '</td>';
        if($row['nameBrigade'] == 10){
          $result .= '<td data-label="Начало работы"> c 7.00</td>';
        } else {
        $result .= '<td data-label="Начало работы">' . $row['typeWB'] . '</td>';
      } 
        if($row['nameBrigade'] == 10){
          $result .= '<td class="hidden_table" data-label="Время работы">12</td>';
        } else {
        $result .= '<td class="hidden_table" data-label="Время работы">10</td>';
      }
        $result .= '<td class="hidden_table" data-label="Диспетчер">' . $row['name_dispatcher'] . '</td>';
        $result .= '<td class="hidden_table" data-label="Механик">' . $row['name_mechanic'] . '</td>';
        $result .= '<td data-label="Пробег до">' . $row['mileageWB_before'] . '</td>';
        $result .= '<td data-label="Пробег после">' . $row['mileageWB_after'] . '</td>';
        $result .= '<td data-label="Пробег">' . $diff . '</td>';
        $result .= '<form action="add-user.php" method="POST">';
        $result .= '<td data-label="Подразделение"><input name="department" value=""></td>
                    <td data-label="Пробег до"><input name="before_mileage" value=""></td>
                    <td data-label="Пробег после"><input name="after_mileage" value=""></td>
                    <input type="hidden" name="idWaybills" value="'. $row['idWaybills'] . '"></td>';
        $result .= '<td data-label="Добавить"><input class="button_form" type="submit" value="добавить"></td></form>';
				$result .= '<td data-label="Скачать"><a href ="../read_xls.php?idWaybills=' . $row['idWaybills'] . '"><input class="button_form" type="submit" value="скачать"></a></td>';
				//$result .= '<td data-label="Скачать"><a href ="../download/путевой_лист_'. $row['idWaybills'] .'.xlsx"><input class="button_form" type="submit" value="cкачать"></a>';
        $result .= '<form action="edit.php" method="POST"><input type="hidden" name="idWaybills" value="'. $row['idWaybills'] .'">';
				$result .= '<td data-label="Редактировать"><input class="button_form"  type="submit" value="редактировать"></td></form>';
				$result .= '</tr></tbody>';
			}
			echo $result;

		?>
		</table>
  </div>







<?php 
//readfile('../template.xlsx'); ?>

<div class="content">

    <button class="show_popup blue_btn" rel="popup1">Добавить</button>
  
  </div>
 <div class="overlay_popup"></div>

  <div class="popup" id="popup1">
    <div class="object">
    	<div class="header_popup">
    		<h4>Формирование путевого листа</h4>
    	</div>
      

<form action="newwaibill.php" method="POST">
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
          
            <?php
            $result ='';
             for ($i=1; $i<=10; $i++) { 
                echo '<input type="hidden" name="date" value="'. $date .'">';
                echo '<td><div class="select"><select name="name_drivers_waybill' . $i .'">';
                foreach($selectDrivers as $elem){
                  echo '<option value="' . $elem .'">'. $elem . '</option>';
                }
                echo '</select></div></td>';
                echo '<td><div class="select"><select name="number_auto_waybill' . $i .'">';
                foreach($selectNumberAuto as $elem){
                  echo '<option value="' . $elem .'">'. $elem . '</option>';
                }
                echo '</select></div></td>';
                echo '<td><div class="select"><select name="typeWB'  .$i .'">';
                foreach($selecttypeWB as $elem){
                  echo '<option value="' . $elem .'">'. $elem . '</option>';
                }
                echo '</select></div></td>';
                echo '<td><input type="checkbox" name="checkWaybill' .$i .'" value="Yes" /></td></tr>';
              }  
            ?>

          
        </tbody>
      </table>
      <input class="button_form" type="submit" value="добавить">
</form>
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
<?php include '../elems/footer.php';
 }else{
	if(isset($_SESSION['logout'])){
		echo $_SESSION['logout'];
		unset($_SESSION['logout']);
}
header('Location: /login.php'); 
}

?>
<?php

switch ($_REQUEST['action']) {
    case 'save':

        echo 'Пример 2 - передача завершилась успешно. Параметры: name = ' . $_POST['name'] . ', nickname= ' . $_POST['nickname'];
        break;
		
	case 'filter':
		?>
		<table class="table table-striped">
			<thead class="thead-dark">
				<tr>
				  <th scope="col"></th>
				  <th scope="col">Название задачи</th>
				  <th scope="col">Автор</th>
				  <th scope="col">Статус</th>
				</tr>
			</thead>
			<tbody>
				<tr>
				  <th scope="row">134</th>
				  <td>Filter</td>
				  <td><?=$_POST['author'];?></td>
				  <td><?=$_POST['status'];?></td>
				</tr>
			</tbody>
		</table>	
		
		
		<?php
        break;


}

?>
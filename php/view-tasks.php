<?php

require( "../config.php" );
require( "../classes/task.php" );
$action = isset( $_GET['action'] ) ? preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/u", "", $_GET['action'] ) : "";

switch ($action) {
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
		
	case 'list':
		getList();
		break;
}

	function getList(){
			$limit=intval($_POST['limit']);
			$page=intval($_POST['page']);
			$pass=$limit*($page-1);
			//echo $a;
			$data = Task::getList($pass, $limit );
			$tasks = $data['results'];
			$totalRows = $data['totalRows'];
			$pages_count=ceil($totalRows/$limit); ?>
	
			<div class="row">
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
			<?php foreach ( $tasks as $task ) { ?>
				
				<tr>
				  <th scope="row" class="text-left">
					<button type="button" class="close" aria-label="Close">
						<span onclick="Close(<?=$task->id;?>)"  aria-hidden="true">&times;</span>
					</button>
				  </th>
				  <td><?=$task->title;?></td>
				  <td><?=$task->author;?></td>
				  <td><?=$task->status;?></td>
				</tr>
			
			<?php } ?>
			</tbody></table></div>
			<div class="row">
				<?php for($i=1;$i<=$pages_count;$i++){ 
					if($i==$page){ ?>
						<button class="btn btn-secondary col" onclick="SendForm(<?=$i;?>)"><?=$i;?></button>
					<?php }else{ ?>
					<button class="btn btn-primary col" onclick="SendForm(<?=$i;?>)"><?=$i;?></button>
					<?php } ?>
					
				<?php } ?>
			</div> 
	<?php }

	
 
 

?>
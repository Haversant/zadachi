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
	
	<?php }
//для красоты выравниваем последнюю страницу пагинации по остальным (добавляем пустых строк)	
	$max_rows=$pages_count*$limit;
	if($page==$pages_count&&$pages_count>1&&$max_rows!=$totalRows){
		$nul_rows=$max_rows-$totalRows;
		for($n=1;$n<=$nul_rows;$n++){ ?>
			<tr>
			  <th scope="row"></th>
			  <td>...</td>
			  <td>...</td>
			  <td>...</td>
			</tr>
		<?php }
	} ?>
	
</tbody></table></div>
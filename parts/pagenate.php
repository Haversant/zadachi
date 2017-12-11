

<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">
	<div class="btn-group mr-2" role="group" aria-label="First group">
		<?php //previous
			if($page==1){ ?>
				<button type="button" class="btn btn-primary disabled">
			<?php }else{ ?>
				<button type="button" class="btn btn-primary" onclick="SendForm(<?=$page-1;?>)">
			<?php } ?>
				Назад</button>
	</div>
	<div class="btn-group mr-2" role="group" aria-label="Second group">
		<?php //pages
			for($i=1;$i<=$pages_count;$i++){ 
				if($i==$page){ ?>
					<button type="button" class="btn btn-primary disabled"><?=$i;?></button>
				<?php }else{ ?>
					<button type="button" class="btn btn-primary" onclick="SendForm(<?=$i;?>)"><?=$i;?></button>
				<?php }
			} ?>
	</div>
	<div class="btn-group" role="group" aria-label="Third group">		
		<?php //next
			if($page==$pages_count){ ?>
				<button type="button" class="btn btn-primary disabled">
			<?php }else{ ?>
				<button type="button" class="btn btn-primary" onclick="SendForm(<?=$page+1;?>)">
			<?php } ?>
				Вперёд</button>
	</div>
</div> 
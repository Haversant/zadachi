
			
				<div class="form-group col-md-4">
					<label for="author"></label>
					<select class="form-control" id="author" onchange="SendForm()" required  >
						<option value="%">Все авторы</option>
					<?php foreach ( $forms['authors'] as $option => $count ) { ?>
						
						<option value="<?=$option;?>"><?=$option." (".$count.")";?></option>
					<?php } ?>
					</select>
				</div>
				
				<div class="form-group col-md-4">
					<label for="status"></label>
					<select class="form-control" id="status" onchange="SendForm()" required  >
						<option value="%">Все статусы</option>
					<?php foreach ( $forms['statuses'] as $option ) { ?>
						
						<option value="<?=$option;?>"><?=$option;?></option>
					<?php } ?>
					</select>
				</div>
				
			
			
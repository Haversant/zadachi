function getForm() {
		$.ajax({
			type: 'POST',
			url: 'controllers/task.php?action=form',
			data: { },
			cache: false,
			success: function(data){
			$('.ajax-form').html(data);
			SendForm();
			}
		});
		
    }
	function SendForm( pag ) {
		var author=$("#author").val();
		var status=$("#status").val();
		if(pag>=1){var page=pag;}else{var page=1;}
		var limit=3;
		
		$.ajax({
			type: 'POST',
			url: 'controllers/task.php?action=list',
			data: {'author' :author, 'status' :status, 'page' :page, 'limit' :limit },
			cache: false,
			success: function(data){
			$('.results').html(data);
			}
		});
    }
	function Close(params) {
		var id=params;
		
		 $.ajax({
			type: 'POST',
			url: 'controllers/task.php?action=delete',
			data: {'id' :id},
			cache: false,
			success: function(data){
			$('.del').html(data);
			SendForm();
			}
		});  
    }
	$(document).load( getForm());

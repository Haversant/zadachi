<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie8"> <![endif]-->
<!--[if IE 9 ]><html class="ie9"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html> <!--<![endif]-->
<head>

	<title>Новая задача</title>
	
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width" />
	
	<link type="text/css" rel="stylesheet" href="../css/normalize.css" media="all" />
	<link type="text/css" rel="stylesheet" href="../css/bootstrap.css" media="all" />
	<link type="text/css" rel="stylesheet" href="../css/style.css" media="all" />
	
</head>


<body>	<!-- ---- B O D Y ---- -->
<div class="space"></div>
<div class="container">

	<div class="row align-items-end ">
		<div class="col-md-9">
			<h1>Новая задача</h1>
		</div>
		<div class="col-md-3 text-right">
			<a type="button" href="../" class="btn btn-primary btn active" role="button">Список задач</a>
		</div>
	</div>
	
	<form action="../controllers/task.php?action=create" method="POST">
		<div class="form-group">
		<label for="title"></label>
			<input name="title" class="form-control form-control-lg" type="text" placeholder="Название задачи" required>
		</div>
		
		<div class="form-group">
			<input name="author" class="form-control form-control-lg" type="text" placeholder="Автор" required>
		</div>
		
		<div class="form-group">
			<select class="form-control form-control-lg" id="status" name="status" required >
				
				<option value="Обычная" selected>Обычная</option>
				<option value="Не срочно">Не срочно</option>
				<option value="Срочно">Срочно</option>
				<option value="Очень срочно">Очень срочно</option>
			</select>
		</div>
		
			<button type="submit" class="save btn btn-primary">Сохранить</button>
	</form>
		
</div>

</body>
</html>
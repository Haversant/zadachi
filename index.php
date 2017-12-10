<!DOCTYPE html>
<!--[if IE 7 ]><html class="ie7"> <![endif]-->
<!--[if IE 8 ]><html class="ie8"> <![endif]-->
<!--[if IE 9 ]><html class="ie9"> <![endif]-->
<!--[if (gte IE 10)|!(IE)]><!--><html> <!--<![endif]-->
<head>

	<title>Задачи</title>
	
	<meta charset="utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<meta name="viewport" content="width=device-width" />
	<meta name="SKYPE_TOOLBAR" content="SKYPE_TOOLBAR_PARSER_COMPATIBLE" />
	
	
	<link type="text/css" rel="stylesheet" href="css/normalize.css" media="all" />
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
	<link type="text/css" rel="stylesheet" href="css/jquery.fancybox-1.3.4.css" media="all" />
	<!--<link type="text/css" rel="stylesheet" href="css/bootstrap.css" media="all" />-->
	<link type="text/css" rel="stylesheet" href="css/style.css" media="all" />
	
	

	<!--[if lt IE 9]>
		<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
		<script src="http://css3-mediaqueries-js.googlecode.com/svn/trunk/css3-mediaqueries.js"></script>
	<![endif]-->

	<script type="text/javascript" src="js/script.js"></script>
	
</head>


<body>	<!-- ---- B O D Y ---- -->

<div class="container">
	
	<div class="row align-items-end ">
		<div class="col-md-9">
			<h1>Задачник</h1>
		</div>
		<div class="col-md-3 text-right">
			<a type="button" href="/create" class="btn btn-primary btn active" role="button">Новая задача</a>
		</div>
		<!--<a class="button" href="new.php">Новая задача</a>-->
	</div>


	<!-- filter -->
	
		<form class="row">
			<div class="form-group col-md-4">
			<label for="author"></label>
			<select class="form-control" id="author" onchange="SendForm()" required  >
				<option value="all">Все авторы</option>
				<option value="Вася">Вася</option>
				<option value="Гена">Гена</option>
				<option value="Коля">Коля</option>
				<option value="Петя">Петя</option>
			</select>
			</div>
			<div class="form-group col-md-4">
			<label for="status"></label>
			<select class="form-control" id="status" onchange="SendForm()" required >
				<option value="all">Все статусы</option>
				<option value="Обычная">Обычная</option>
				<option value="Не срочно">Не срочно</option>
				<option value="Срочно">Срочно</option>
				<option value="Очень срочно">Очень срочно</option>
			</select>
			</div>
		</form>


	<!-- content -->
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
			<tbody class="results">
				
			</tbody>
		</table>	
	</div>
</div>

<!-- F O O T E R -->
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
  
	<script type="text/javascript" src="js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="js/jquery.fancybox-1.3.4.js"></script>
	<!--<script type="text/javascript" src="js/bootstrap.js"></script>-->
	<script>
	function SendForm() {
		var author=$("#author").val();
		var status=$("#status").val();
		$.ajax({
			type: 'POST',
			url: 'php/view-tasks.php?action=list',
			data: {'author' :author, 'status' :status },
			cache: false,
			success: function(data){
			$('.results').html(data);
			}
		});
    }
	function Close(params) {
		var id=params;
		alert(id);
		/* $.ajax({
			type: 'POST',
			url: 'php/view-tasks.php?action=list',
			data: {'author' :author, 'status' :status },
			cache: false,
			success: function(data){
			$('.results').html(data);
			}
		});  */
    }
	$(document).load(SendForm());
	</script>
</body>
</html>
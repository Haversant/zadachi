<?php

require( "../config.php" );
require( "../classes/task.php" );
$action = isset( $_GET['action'] ) ? preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/u", "", $_GET['action'] ) : "";

switch ($action) {
	case 'form':
		getForm();
		break;
	case 'list':
		getList();
		break;
	case 'create':
		newTask();
		break;
	case 'delete':
		delTask();
		break;

	default:
		header( "Location: ../index.php?status=GetError" );
}


	function newTask() {
		$results = array();

		if ( isset( $_POST['title'] )&&isset( $_POST['author'] )&&isset( $_POST['status'] ) ) {
			// сохраняем новую статью
			$task = new Task;
			$task->storeFormValues( $_POST );
			$task->insert();
			header( "Location: ../index.php?status=TaskCreate" );
		} else {
			header( "Location: ../create/index.php?status=PostError" );
		}
	}
	
	function getForm(){
		
		//получаем содержимое форм
		$forms = Task::getForms();	
		//подключаем шаблон форм
		require("../parts/forms.php");
	}
	
	function getList(){
			$author=(string)$_POST['author'];
			$status=(string)$_POST['status'];
			$limit=intval($_POST['limit']);
			$page=intval($_POST['page']);
			
			//считаем сколько пропустить
			$pass=$limit*($page-1);
			//получаем задачи учитывая пагинацию и фильтрацию
			$data = Task::getList( $pass, $limit, $author ,$status );
			$tasks = $data['results'];
			$totalRows = $data['totalRows'];
			$pages_count=ceil($totalRows/$limit);
			
			
			
			//подключаем шаблон таблицы
			require("../parts/task_table.php");
			//подключаем шаблон пагинации если надо
			if($pages_count>1){
				require("../parts/pagenate.php");
			}
		}
		
		function delTask() {
			if ( !$task = Task::getById( (int)$_POST['id'] ) ) {
				header( "Location: ../index.php?error=Deleting task not found" );
				return;
			}
			$title=$task->title;
			$task->delete();
			echo "Task by title='".$title."' deleted" ;
		}
?>
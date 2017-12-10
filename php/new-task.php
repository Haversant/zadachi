<?php 

require( "../config.php" );
require( "../classes/task.php" );
$action = isset( $_GET['action'] ) ? preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/u", "", $_GET['action'] ) : "";
//preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Z0-9()]/u", "", $_GET['action'] )

switch ( $action ) {
	
  case 'create':
    newTask();
    break;

  default:
    header( "Location: ../create/index.php?status=GetError" );
}

function newTask() {
  $results = array();
  $results['pageTitle'] = "New Task";
  $results['formAction'] = "newTask";
  
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


?>
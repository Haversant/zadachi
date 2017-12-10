<?php
	ini_set( "display_errors", true );
	date_default_timezone_set( 'Europe/Samara' );
	$DN='Test-db' ;
	$DH='localhost';
	$DC='utf8';
	
	$OP = array(
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);
	define( "CONFIG", "./config" );
	define( "CLASSES", "./classes" );
	define( "GALERY", "./galery" );
	define( "PARTS", "./parts" );
	define( "ADMIN", "./admin" );
	define( "JS", "./js" );
	define( "CSS", "./css" );
	
	define( "TASK", "task" );
	
	define( "DUN", "root" );
	define( "DUP", "" );
	define( "DSN", "mysql:host=$DH;dbname=$DN;charset=$DC" );
	define( "HNA", 10 );
	define( "AIP", 3 );
	define( "ADNAME", "Alexandr" );
	define( "ADPAS", "a6684ffbe228e8b647ebca219c95080a" );

require( CLASSES."/task.php" );
	
	function handleException( $exception ) {
  echo "Sorry, a problem occurred. Please try later.";
  error_log( $exception->getMessage() );
}
set_exception_handler( 'handleException' ); 
?>
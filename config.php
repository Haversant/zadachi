<?php
	
	date_default_timezone_set( 'Europe/Samara' );
	$DN='Test-db' ;
	$DH='localhost';
	$DC='utf8';
	
	$OP = array(
		PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
		PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
	);

	define( "TASK", "task" );
	
	define( "DUN", "root" );
	define( "DUP", "" );
	define( "DSN", "mysql:host=$DH;dbname=$DN;charset=$DC" );
	 
?>
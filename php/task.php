<?php
class Task{
	
  public $id = null;
 
  public $title = null;
 
  public $author = null;
  
  public $status = null;
  
	public function __construct( $data=array() ) {
		if ( isset( $data['id'] ) ) $this->id = (int) $data['id'];
		if ( isset( $data['title'] ) ) $this->title = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Zа-яёА-ЯЁ0-9()]/u", "", $data['title'] );
		if ( isset( $data['author'] ) ) $this->author = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Zа-яёА-ЯЁ0-9()]/u", "", $data['author']);
		if ( isset( $data['status'] ) ) $this->status = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Zа-яёА-ЯЁ0-9()]/u", "", $data['status'];
	}
	
	public function storeFormValues ( $params ) {
		$this->__construct( $params );
	}
	
	public static function getById( $id ) {
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "SELECT * FROM ".TASK." WHERE id = :id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();
		$conn = null;
		if ( $row ) return new Task( $row );
	}
	
	public static function getList( $numRows=1000000, $order="title DESC" ) {
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".TASK."
			ORDER BY " .$order. " LIMIT :numRows";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":numRows", $numRows, PDO::PARAM_INT );
		$st->execute();
		$list = array();
		while ( $row = $st->fetch() ) {
			$task = new Task( $row );
			$list[] = $task;
		}
		// Получаем общее количество статей, которые соответствуют критерию
		$sql = "SELECT FOUND_ROWS() AS totalRows";
		$totalRows = $conn->query( $sql )->fetch();
		$conn = null;
		return ( array ( "results" => $list, "totalRows" => $totalRows[0] ) );
	}
	
	public function insert() {
		if ( !is_null( $this->id ) ) trigger_error ( "Task::insert(): Attempt to insert an Task object that already has its ID property set (to $this->id).", E_USER_ERROR );
		
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "INSERT INTO ".TASK." ( title, status, autor ) VALUES ( :title, :status, :autor )";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
		$st->bindValue( ":autor", $this->autor, PDO::PARAM_STR );
		$st->execute();
		$this->id = $conn->lastInsertId();
		$conn = null;
	}
	
	 public function update() {
		if ( is_null( $this->id ) ) trigger_error ( "Task::update(): Attempt to update an Task object that does not have its ID property set.", E_USER_ERROR );
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "UPDATE ".TASK." SET createdate=FROM_UNIXTIME(:createdate), changedate=FROM_UNIXTIME(:changedate), pubdate=FROM_UNIXTIME(:pubdate), title=:title, summary=:summary, content=:content, status=:status, autor=:autor, topic=:topic, tegs=:tegs, liked=:liked, disliked=:disliked, looked=:looked WHERE id = :id";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
		$st->bindValue( ":autor", $this->autor, PDO::PARAM_STR );
		$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
		$st->execute();
		$conn = null;
	}
	
	public function delete() {
		if ( is_null( $this->id ) ) trigger_error ( "Task::delete(): Attempt to delete an Task object that does not have its ID property set.", E_USER_ERROR );
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$st = $conn->prepare ( "DELETE FROM ".TASK." WHERE id = :id LIMIT 1" );
		$st->bindValue( ":id", $this->id, PDO::PARAM_INT );
		$st->execute();
		$conn = null;
	}
	
	public static function counter( $id, $set ){
		$conn = new PDO( DSN, DUN, DUP, $OP );
		
		$sql = "SELECT ".$set." FROM ".TASK." WHERE id = :id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$row = $st->fetch();
		$l=$row[0]+1;
		$sql = "UPDATE ".TASK." SET ".$set."=:l WHERE id = :id";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":l", $l, PDO::PARAM_INT );
		$st->bindValue( ":id", $id, PDO::PARAM_INT );
		$st->execute();
		$conn = null;
	}
	
	
}
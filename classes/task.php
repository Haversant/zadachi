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
		if ( isset( $data['status'] ) ) $this->status = preg_replace ( "/[^\.\,\-\_\'\"\@\?\!\:\$ a-zA-Zа-яёА-ЯЁ0-9()]/u", "", $data['status']);
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
	
	public static function getForms( ) {
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "SELECT author FROM ".TASK;
		$st = $conn->query($sql);
		while ($row = $st->fetch()){
			$list1[]=$row['author'];
		}
		$sql = "SELECT status FROM ".TASK;
		$st = $conn->query($sql);
		while ($row = $st->fetch()){
			$list2[]=$row['status'];
		}
		$authors=array_count_values($list1);
		$statuses=array_unique($list2);
		
		
		
		
		$conn = null;
		//if ( $row ) 
		return ( array ( "statuses" => $statuses, "authors" => $authors ) );
		return $authors;
	}
	
	public static function getList( $pass=0, $limit=1000000, $author='%', $status='%', $order="id DESC" ) {
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "SELECT SQL_CALC_FOUND_ROWS * FROM ".TASK." WHERE author LIKE :author AND status LIKE :status 
			ORDER BY " .$order. " LIMIT :pass, :limit";
		$st = $conn->prepare( $sql );
		$st->bindValue( ":pass", $pass, PDO::PARAM_INT );
		$st->bindValue( ":limit", $limit, PDO::PARAM_INT );
		$st->bindValue( ":author", $author, PDO::PARAM_STR );
		$st->bindValue( ":status", $status, PDO::PARAM_STR );
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
		$sql = "INSERT INTO ".TASK." ( title, status, author ) VALUES ( :title, :status, :author )";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
		$st->bindValue( ":author", $this->author, PDO::PARAM_STR );
		$st->execute();
		$this->id = $conn->lastInsertId();
		$conn = null;
	}
	
	 public function update() {
		if ( is_null( $this->id ) ) trigger_error ( "Task::update(): Attempt to update an Task object that does not have its ID property set.", E_USER_ERROR );
		$conn = new PDO( DSN, DUN, DUP, $OP );
		$sql = "UPDATE ".TASK." SET title=:title, status=:status, author=:author WHERE id = :id";
		$st = $conn->prepare ( $sql );
		$st->bindValue( ":title", $this->title, PDO::PARAM_STR );
		$st->bindValue( ":status", $this->status, PDO::PARAM_STR );
		$st->bindValue( ":author", $this->author, PDO::PARAM_STR );
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

}
<?php 

namespace SqlFire;

class Connection
{
	var $table;
	var $mysqli;
	
    public  function connect()
    {
        //variabel koneksi
		$host	= "localhost";
		$user	= "root";
		$pass	= "";
		$db		= "db_gaji";
		
		//konek ke MySql Server
		$mysqli = mysqli_connect($host, $user, $pass,$db);
		
		if (! $mysqli) {
			echo "Koneksi Gagal !";
		}
		else{
			$GLOBALS['mysqli'] = $mysqli;
		}
		$this->mysqli = $mysqli;
		return $mysqli;
    }
	
	function query($sql){
		$list = $this->mysqli->query($sql);
		return $list;
	}
	
	function selectData($table , $fields = "*" , $where = ""){
		$lists = array();
		if(!empty($table)){
			$sql = "SELECT ". $fields. " FROM ". $table . " ";
			if(!empty($where)){
				$sql .= " $where";
			}
			
			$list = $this->mysqli->query($sql);
			return $list;
		}
		else{
			$this->setError("Table Undefined!");
		}
	}
	
	public function insert($table, array $data)
	{
		if(empty($data)) {
			throw new InvalidArgumentException('Cannot insert an empty array.');
		}
		if(!is_string($table)) {
			throw new InvalidArgumentException('Table name must be a string.');
		}

		$fields = '`' . implode('`, `', array_keys($data)) . '`';
		$placeholders = '"' . implode('", "', array_values($data)) . '"';

		$sql = "INSERT INTO {$table} ($fields) VALUES ({$placeholders})";
		$this->mysqli->query($sql);

		return true;

	}
	
	public function update($table, array $data)
	{
		if(empty($data)) {
			throw new InvalidArgumentException('Cannot insert an empty array.');
		}
		if(!is_string($table)) {
			throw new InvalidArgumentException('Table name must be a string.');
		}

		$fields = '`' . implode('`, `', array_keys($data)) . '`';
		$placeholders = '"' . implode('", "', array_values($data)) . '"';

		$sql = "UPDATE {$table} ($fields) VALUES ({$placeholders})";
		$this->mysqli->query($sql);

		return true;

	}
	
	public function columns($table)
	{
		$sql = "SHOW COLUMNS FROM {$table}";
		$res = $this->mysqli->query($sql);
		while($row = $res->fetch_assoc()){
			$columns[] = $row['Field'];
		}
		return $columns;
	}
	
	function setError($msg){
		$_SESSION["flashmessage"] = $msg;
	}
	
}
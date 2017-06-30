<?php
class DB{

	private $dsn = 'mysql:dbname=devis_v1;host=localhost';
	private $username = 'root';
	private $password = '';
	private $db;

	public function __construct($dsn=null, $username=null, $password=null){
			if($dsn != null){
				$this->dsn = $dsn;
				$this->username = $username;
				$this->password = $password;
			}

			try{
				$this->db = new PDO($this->dsn, $this->username , $this->password,
					array(
							PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8',
							PDO::ATTR_ERRMODE => PDO::ERRMODE_WARNING
						 )
				);
			}
			catch (PDOException $e){
			        die('Erreur : ' . $e->getMessage());
			}
	}

	public function query($sql, $data = array()){
		$req = $this->db->prepare($sql);
		$req->execute($data);
		return $req -> fetchAll(PDO::FETCH_OBJ);
	}

	public function insertDemandeFunc($sql, $data = array()){
		$req = $this->db->prepare($sql);
		$req->execute($data);

		$lastInsertId = $this->db->lastInsertId();
		return $lastInsertId;
	}

	public function noReturnQuery($sql, $data = array()){
		$req = $this->db->prepare($sql);
		$req->execute($data);
	}




}
?>
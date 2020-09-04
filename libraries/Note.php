<?php

class Note {
	// Init DB Variable
	private $db;

	/*

	*Constructor

	*/

	public function __construct() {
		$this->db = new Database;
	}



	 public function add($content) {



	 	//Insert Query
	 	$this->db->query('INSERT INTO notes (content)
		 VALUES (:content)');

	 	//Bind Values
	 	$this->db->bind(':content', $content);


	 	//Execute
	 	if($this->db->execute()) {
	 		return true;
	 	} else {
	 		return false;
	 	}


	 }





	public function listNotes() {

		$this->db->query("SELECT * FROM notes");

		$row = $this->db->resultset();
		
		return $row;

	}





	public function delete($id) {
		//Insert Query
		$this->db->query("DELETE FROM notes WHERE id_n = :id_n");
		//Bind Values
		$this->db->bind(':id_n', $id);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }

}
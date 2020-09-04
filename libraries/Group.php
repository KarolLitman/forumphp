<?php

class Group {
	// Init DB Variable
	private $db;

	/*

	*Constructor

	*/

	public function __construct() {
		$this->db = new Database;
	}



	 public function addGroup($data) {



	 	//Insert Query
	 	$this->db->query('INSERT INTO groups (group_name, description,color,main_privilage,locked)
		 VALUES (:group_name, :description,:color,:main_privilage,0)');

	 	//Bind Values
	 	$this->db->bind(':group_name', $data['group_name']);
	 	$this->db->bind(':description', $data['description']);
	 	$this->db->bind(':color', $data['color']);
	 	$this->db->bind(':main_privilage', $data['main_privilage']);


	 	//Execute
	 	if($this->db->execute()) {
	 		return true;
	 	} else {
	 		return false;
	 	}

	 }





	public function listGroups() {

		$this->db->query("SELECT *, g.description AS description, sor.description AS main_privilage_desc FROM groups g JOIN set_of_rights sor ON g.main_privilage=sor.sor_id");

		$row = $this->db->resultset();
		
		return $row;

	}


	public function getTotalGroups() {
		
		$this->db->query("SELECT * FROM groups");
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

    
	public function getCategory($id){
		$this->db->query("SELECT * FROM categories
                            WHERE categories.c_id = :id			
		");
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}









	public function get($id){
		$this->db->query("SELECT * FROM groups
                            WHERE g_id = :id			
		");
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}



	public function modify($data) {


        $this->db->query("UPDATE groups
        SET group_name=:group_name, description=:description, color=:color, main_privilage=:main_privilage
        WHERE g_id=:id");

        $this->db->bind(':group_name', $data['group_name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':color', $data['color']);
        $this->db->bind(':main_privilage', $data['main_privilage']);
        $this->db->bind(':id', $data['id']);


        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}



	public function delete($id) {
		//Insert Query
		$this->db->query("DELETE FROM groups WHERE g_id = :g_id");
		//Bind Values
		$this->db->bind(':g_id', $id);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }


}
<?php

class Category {
	// Init DB Variable
	private $db;

	/*

	*Constructor

	*/

	public function __construct() {
		$this->db = new Database;
	}



	 public function add($data) {
	 	//Insert Query
	 	$this->db->query('INSERT INTO categories (name, description,parent_id)
	 		             VALUES (:name, :description, :parent_id)');

	 	//Bind Values
	 	$this->db->bind(':name', $data['name']);
	 	$this->db->bind(':description', $data['description']);
	 	$this->db->bind(':parent_id', $data['parent_id']);


	 	//Execute
	 	if($this->db->execute()) {
	 		return true;
	 	} else {
	 		return false;
	 	}


	 }



     public function listMainCategories() {

		$this->db->query("SELECT * FROM categories where parent_id=0");

		$row = $this->db->resultset();
		
		return $row;

	}



	public function get($id){
		$this->db->query("SELECT * FROM categories
                            WHERE categories.c_id = :id			
		");
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}



	public function modify($data) {


        $this->db->query("UPDATE categories
        SET name=:name, description=:description
        WHERE c_id=:id");

        $this->db->bind(':name', $data['name']);
        $this->db->bind(':description', $data['description']);
        $this->db->bind(':id', $data['id']);


        if($this->db->execute()) {
            return true;
        } else {
            return false;
        }
}



	public function delete($id) {
		//Insert Query
		$this->db->query("DELETE FROM categories WHERE c_id = :c_id");
		//Bind Values
		$this->db->bind(':c_id', $id);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }

    public function getModCategories($id) {
		//Insert Query
		$this->db->query("SELECT c.c_id, COALESCE(pu.permission,p.permission,g.main_privilage) AS active FROM categories c LEFT JOIN privilages_users pu ON c.c_id=pu.c_id AND pu.u_id=:u_id LEFT JOIN privilages p ON c.c_id=p.c_id AND p.g_id=:g_id LEFT JOIN groups g ON g.g_id=:g_id WHERE COALESCE(pu.permission,p.permission,g.main_privilage)>4");
        //Bind Values
        
$user=new User;
$g_id=$user->getUser($id)->group_id;

		$this->db->bind(':g_id', $g_id);
		$this->db->bind(':u_id', $id);

		//Execute
		$row = $this->db->resultset();
		
		return $row;
    }

    public function CountModCategories($id) {
		//Insert Query
		$this->db->query("SELECT c.c_id, COALESCE(pu.permission,p.permission,g.main_privilage) AS active FROM categories c LEFT JOIN privilages_users pu ON c.c_id=pu.c_id AND pu.u_id=:u_id LEFT JOIN privilages p ON c.c_id=p.c_id AND p.g_id=:g_id LEFT JOIN groups g ON g.g_id=:g_id WHERE COALESCE(pu.permission,p.permission,g.main_privilage)>4");
        //Bind Values
        
$user=new User;
$g_id=$user->getUser($id)->group_id;

		$this->db->bind(':g_id', $g_id);
		$this->db->bind(':u_id', $id);
		$row = $this->db->resultset();
    
        return $this->db->rowCount();    

		//Execute

    }


}
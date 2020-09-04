<?php
class Privilage{
	//Init DB Variable
	private $db;
	
	/*
	 *	Constructor
	 */
	 public function __construct(){
		$this->db = new Database;
	 }
	 
	 /*
	  *	Get All Topics
	  */
	  public function addPrivilage($g_id,$c_id,$permission){
		$this->db->query("INSERT INTO privilages (g_id, c_id, permission) VALUES(:g_id, :c_id, :permission) ON DUPLICATE KEY UPDATE    
        g_id=:g_id, c_id=:c_id, permission=:permission");

        
        $this->db->bind(':g_id', $g_id);
        $this->db->bind(':c_id', $c_id);
        $this->db->bind(':permission', $permission);


		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	  }

	  public function addPrivilageUser($u_id,$c_id,$permission){
		$this->db->query("INSERT INTO privilages_users (u_id, c_id, permission) VALUES(:u_id, :c_id, :permission) ON DUPLICATE KEY UPDATE    
        u_id=:u_id, c_id=:c_id, permission=:permission");

        
        $this->db->bind(':u_id', $u_id);
        $this->db->bind(':c_id', $c_id);
        $this->db->bind(':permission', $permission);


		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
      }
      

      public function delPrivilageUser($u_id,$c_id){
		$this->db->query("DELETE FROM privilages_users WHERE u_id=:u_id AND c_id=:c_id");

        
        $this->db->bind(':u_id', $u_id);
        $this->db->bind(':c_id', $c_id);


		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
      }
      


      public function delPrivilage($g_id,$c_id){
		$this->db->query("DELETE FROM privilages WHERE g_id=:g_id AND c_id=:c_id");

        
        $this->db->bind(':g_id', $g_id);
        $this->db->bind(':c_id', $c_id);


		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
      }
      

}
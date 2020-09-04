<?php
class Reply{
	private $db;
	

	 public function __construct(){
		$this->db = new Database;
	 }
	 

     public function delete($id) {

        $this->db->query("DELETE FROM replies WHERE r_id = :r_id");
		//Bind Values
		$this->db->bind(':r_id', $id);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }



    public function update($data) {
		//Insert Query
		$this->db->query("UPDATE replies
        SET body=:body
        WHERE r_id=:r_id");
		//Bind Values
		$this->db->bind(':r_id', $data['id']);
		$this->db->bind(':body', $data['body']);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }
    
    function getTopicID($r_id){
        $db = new Database;
    
        $db->query("SELECT * FROM replies WHERE r_id=:r_id");
    
        
        $db->bind(':r_id', $r_id);
    
    
        $row = $db->single();
    
        //Execute
        if($db->execute()) {
            return $row->topic_id;
        } else {
            return false;
        }
    
      }

}
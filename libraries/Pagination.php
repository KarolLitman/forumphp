<?php

class Message {
	// Init DB Variable
	private $db;

	/*

	*Constructor

	*/

	public function __construct() {
		$this->db = new Database;
	}


	/*

	*Register User

	*/


	public function listreceived($r_u_id) {

		$this->db->query("SELECT m.*, u2.username, u2.u_id FROM messages m JOIN users u2 ON m.sender_u_id=u2.u_id where receivier_u_id=:r_u_id ORDER BY send_date DESC");

        $this->db->bind(':r_u_id', $r_u_id);

		$row = $this->db->resultset();
		return $row;

    }
    
    public function listsent($s_u_id) {

		$this->db->query("SELECT m.*, u1.username, u1.u_id FROM messages m JOIN users u1 ON m.receivier_u_id=u1.u_id where sender_u_id=:s_u_id ORDER BY send_date DESC");

        $this->db->bind(':s_u_id', $s_u_id);

		$row = $this->db->resultset();
		return $row;

    }
    

    public function addmessage($data) {

		$this->db->query('INSERT INTO messages (sender_u_id, receivier_u_id, title, body)
		VALUES (:s_u_id, :r_u_id, :title,:body)');

//Bind Values
$this->db->bind(':s_u_id', $data['s_u_id']);
$this->db->bind(':r_u_id', $data['r_u_id']);
$this->db->bind(':title', $data['title']);
$this->db->bind(':body', $data['body']);

if($this->db->execute()) {
    return true;
} else {
    return false;
}

	}

}
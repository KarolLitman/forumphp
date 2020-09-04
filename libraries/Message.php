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

		$this->db->query("SELECT m.*, u2.username, u2.u_id, g.color FROM messages m JOIN users u2 ON m.sender_u_id=u2.u_id JOIN groups g ON u2.group_id=g.g_id where receivier_u_id=:r_u_id ORDER BY send_date DESC");

        $this->db->bind(':r_u_id', $r_u_id);

		$row = $this->db->resultset();
		return $row;

    }
    
    public function listsent($s_u_id) {

		$this->db->query("SELECT m.*, u1.username, u1.u_id, g.color FROM messages m JOIN users u1 ON m.receivier_u_id=u1.u_id JOIN groups g ON u1.group_id=g.g_id where sender_u_id=:s_u_id ORDER BY send_date DESC");

        $this->db->bind(':s_u_id', $s_u_id);

		$row = $this->db->resultset();
		return $row;

    }
    
    public function getmessage($m_id,$u_id) {

		$this->db->query("SELECT m.*, u1.username as receivier, u1.u_id as r_u_id, u2.username as sender, u2.u_id as s_u_id, g2.color as s_color, g1.color as r_color FROM messages m JOIN users u1 ON m.receivier_u_id=u1.u_id JOIN users u2 ON m.sender_u_id=u2.u_id JOIN groups g1 ON g1.g_id=u1.group_id JOIN groups g2 ON g2.g_id=u2.group_id where (sender_u_id=:u_id OR receivier_u_id=:u_id) AND m_id=:m_id");
        $this->db->bind(':u_id', $u_id);
        $this->db->bind(':m_id', $m_id);

		$row = $this->db->single();
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




	public function setRead($m_id) {


				//Insert Query
				$this->db->query("UPDATE messages
				SET was_read=1
				WHERE m_id=:m_id");
				//Bind Values
				$this->db->bind(':m_id', $m_id);
		
				//Execute
				if($this->db->execute()) {
					return true;
				} else {
					return false;
				}
			}






}
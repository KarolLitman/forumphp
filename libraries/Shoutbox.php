<?php

class Shoutbox {
	// Init DB Variable
	private $db;

	/*

	*Constructor

	*/

	public function __construct() {
		$this->db = new Database;
	}


	public function listmessages() {

		$this->db->query("SELECT s.*, g.color, u.username, u.avatar FROM shoutbox s JOIN users u ON s.u_id=u.u_id JOIN groups g ON g.g_id=u.group_id ORDER BY send_date DESC LIMIT 20");


        $row = $this->db->resultset();
        
        return json_encode($row);
		// return $row;

    }
    

    public function sendmessage($data) {

		$this->db->query('INSERT INTO shoutbox (u_id, body)
		VALUES (:u_id, :body)');

//Bind Values
$this->db->bind(':u_id', $data['u_id']);
$this->db->bind(':body', $data['body']);

if($this->db->execute()) {
    return true;
} else {
    return false;
}
	}


    public function deletemessage($id) {

		$this->db->query('DELETE FROM shoutbox WHERE s_id = :s_id');

//Bind Values
$this->db->bind(':s_id', $id);

if($this->db->execute()) {
    return true;
} else {
    return false;
}
	}

}
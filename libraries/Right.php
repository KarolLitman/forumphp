<?php
class Right{
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
	  public function getAllRights(){
		$this->db->query("SELECT * FROM set_of_rights");
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	  }




}
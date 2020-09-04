<?php
class Topic{
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
	  public function getAllTopics(){
		$this->db->query("SELECT topics.*, users.username, users.avatar, categories.name FROM topics
							INNER JOIN users
							ON topics.user_id = users.u_id
							INNER JOIN categories
							ON topics.category_id = categories.c_id WHERE topics.approved=1
							ORDER BY create_date DESC 
							");
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	  }
      
      public function getAllTopicsByState($u_id,$state){

$category=new Category;
$in=$category->getModCategories($u_id);

// print_r($in);

$arr = array();

foreach($in as $i) {
  $arr[] = $i->c_id;
}

$in_values = implode(',', $arr);


		$this->db->query("SELECT topics.*, groups.color, users.username, users.avatar, categories.name FROM topics
							INNER JOIN users
							ON topics.user_id = users.u_id
							INNER JOIN categories
							ON topics.category_id = categories.c_id
                            INNER JOIN groups
							ON groups.g_id = users.group_id
                            WHERE topics.approved=:state AND topics.category_id IN ($in_values);
							ORDER BY create_date DESC
                            ");
                            		$this->db->bind(':state', $state);
		//Assign Result Set
		$results = $this->db->resultset();
		
		return $results;
	  }

	  /*
	 * Get Topics By Category
	 */
	public function getByCategory($category_id,$page,$u_id){
		$this->db->query("SELECT topics.*, categories.*, users.username, users.avatar, groups.color FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.c_id
						INNER JOIN users
						ON topics.user_id=users.u_id
                        INNER JOIN groups
                        ON groups.g_id=users.group_id
						WHERE topics.category_id = :category_id	AND (topics.approved=1 OR users.u_id=:u_id) LIMIT 6 OFFSET :page_topics		
		");
		$this->db->bind(':category_id', $category_id);
		$this->db->bind(':page_topics', $page*5);
		$this->db->bind(':u_id', $u_id);

		//Assign Result Set
		$results = $this->db->resultset();
    

		return $results;
	}


	public function getNumByCategory($category_id){
		$this->db->query("SELECT topics.*, categories.*, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.c_id
						INNER JOIN users
						ON topics.user_id=users.u_id
						WHERE topics.category_id = :category_id	AND topics.approved=1		
		");
		$this->db->bind(':category_id', $category_id);

		//Assign Result Set
		$rows = $this->db->resultset();
		return $this->db->rowCount();    

	}

	
	/*
	 * Get Topics By Username
	 */
	public function getByUser($user_id){
		$this->db->query("SELECT topics.*, categories.*, groups.color, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.c_id
						INNER JOIN users
						ON topics.user_id=users.u_id
                        INNER JOIN groups
						ON users.group_id=groups.g_id
						WHERE topics.user_id = :user_id
		");
		$this->db->bind(':user_id', $user_id);
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}

	public function getBySearch($keyword){
		$this->db->query("SELECT topics.*, categories.*, groups.color, users.username, users.avatar FROM topics
						INNER JOIN categories
						ON topics.category_id = categories.c_id
						INNER JOIN users
						ON topics.user_id=users.u_id
                        INNER JOIN groups
						ON users.group_id=groups.g_id
						WHERE topics.title LIKE :keyword 
		");
		$this->db->bind(':keyword', '%'.$keyword.'%');
	
		//Assign Result Set
		$results = $this->db->resultset();
	
		return $results;
	}

	public function getCategoryName($t_id){
		$this->db->query("SELECT c.c_id,c.name FROM topics t JOIN categories c ON t.category_id=c.c_id WHERE t.t_id=:t_id
		");
		$this->db->bind(':t_id', $t_id);
	
		//Assign Row
		$row = $this->db->single();
	
		return $row;
	}

	
	  
	  /*
	 * Get Total # of Topics
	 */
	public function getTotalTopics(){
		$this->db->query('SELECT * FROM topics');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	
	/*
	 * Get Total # of Categories
	*/
	public function getTotalCategories(){
		$this->db->query('SELECT * FROM categories');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	
	/*
	 * Get Category By ID
	*/
	public function getCategory($category_id){
		$this->db->query("SELECT * FROM categories WHERE c_id = :category_id
		");
		$this->db->bind(':category_id', $category_id);
	
		//Assign Row
		$row = $this->db->single();
	
		return $row;
	}
	
	/*
	 * Get Total # of Replies
	*/
	public function getTotalReplies($topic_id){
		$this->db->query('SELECT * FROM replies WHERE topic_id = '.$topic_id.' AND replies.approved=1');
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}
	

	public function getTopic($id,$u_id){
		$this->db->query("SELECT topics.*, users.username, users.name, users.avatar, groups.group_name, groups.color FROM topics
						INNER JOIN users
						ON topics.user_id = users.u_id JOIN groups ON users.group_id = groups.g_id
						WHERE topics.t_id = :id AND (topics.approved=1 OR users.u_id=:u_id)			
		");
		$this->db->bind(':id', $id);
		$this->db->bind(':u_id', $u_id);
		
		$row = $this->db->single();
		
		return $row;
	}

    public function getTopic2($id){
		$this->db->query("SELECT * FROM topics where t_id=:t_id");
		$this->db->bind(':t_id', $id);
		
		$row = $this->db->single();
		
		return $row;
	}

	public function getReplies($topic_id,$page,$u_id){
		$this->db->query("SELECT replies.*, users.*, groups.group_name, groups.color FROM replies
						INNER JOIN users
						ON replies.user_id = users.u_id JOIN groups ON users.group_id = groups.g_id
						WHERE replies.topic_id = :topic_id AND (replies.approved=1 OR users.u_id=:u_id)
						ORDER BY create_date ASC LIMIT 11 OFFSET :page_replies	
		");
		$this->db->bind(':topic_id', $topic_id);
		$this->db->bind(':page_replies', $page*10==0 ? $page*10 : $page*10+1);
		$this->db->bind(':u_id', $u_id);

		$results = $this->db->resultset();
	
		return $results;
    }
    

    public function getReply($r_id){
		$this->db->query("SELECT * FROM replies WHERE r_id=:r_id");
		$this->db->bind(':r_id', $r_id);

		$row = $this->db->single();
	
		return $row;
	}


	public function getNumReplies($topic_id){
		$this->db->query("SELECT replies.*, users.* FROM replies
						INNER JOIN users
						ON replies.user_id = users.u_id
						WHERE replies.topic_id = :topic_id AND replies.approved=1 
						ORDER BY create_date ASC	
		");
		$this->db->bind(':topic_id', $topic_id);

		$rows = $this->db->resultset();
		return $this->db->rowCount();

	}

	public function getAllRepliesByState($u_id,$state){
	
		$category=new Category;
		$in=$category->getModCategories($u_id);
		
		// print_r($in);
		
		$arr = array();
		
		foreach($in as $i) {
		  $arr[] = $i->c_id;
		}
		
		$in_values = implode(',', $arr);

	
	$this->db->query("SELECT replies.*, groups.color, users.username, users.avatar, topics.title FROM replies
        INNER JOIN users
        ON replies.user_id = users.u_id INNER JOIN topics ON replies.topic_id=topics.t_id
        INNER JOIN groups
		ON groups.g_id = users.group_id
        WHERE replies.approved = :state AND topics.category_id IN ($in_values)
        ORDER BY create_date ASC
		");
			$this->db->bind(':state', $state);

		$results = $this->db->resultset();
	
		return $results;
	}




	public function create($data) {
		$this->db->query("INSERT INTO topics (category_id, user_id, title, body, last_activity,approved) 
						  VALUES (:category_id, :user_id, :title, :body, :last_activity,:approved)");

        $this->db->bind(':category_id', $data['category_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':last_activity', $data['last_activity']);
		$this->db->bind(':approved', $data['approved']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }
    
	public function delete($id) {

        $this->db->query("DELETE FROM topics WHERE t_id = :topic_id");
		//Bind Values
		$this->db->bind(':topic_id', $id);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }

    public function update($data) {
		//Insert Query
		$this->db->query("UPDATE topics
        SET title=:title,body=:body
        WHERE t_id=:t_id");
		//Bind Values
		$this->db->bind(':t_id', $data['id']);
		$this->db->bind(':title', $data['title']);
		$this->db->bind(':body', $data['body']);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

	/*

	* Add reply Method

	*/
	public function reply($data) {
		//Insert Query
		$this->db->query("INSERT INTO replies (topic_id, user_id, body,approved)
			              VALUES (:topic_id, :user_id, :body,:approved)");

		//Bind values
		$this->db->bind(':topic_id', $data['topic_id']);
		$this->db->bind(':user_id', $data['user_id']);
		$this->db->bind(':body', $data['body']);
		$this->db->bind(':approved', $data['approved']);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }
    
	public function acceptDeclineMessages($column,$el_id,$state) {

if($column==='replies'){
    $id='r_id';
}
if ($column==='topics'){
    $id='t_id';}


		//Insert Query
		$this->db->query("UPDATE $column
        SET approved=:state
        WHERE $id=:t_id");
		//Bind Values
		$this->db->bind(':t_id', $el_id);
		$this->db->bind(':state', $state);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}

    function getCategoryID($t_id){
        $db = new Database;
    
        $db->query("SELECT * FROM topics WHERE t_id=:t_id");
    
        
        $db->bind(':t_id', $t_id);
    
    
        $row = $db->single();
    
        //Execute
        if($db->execute()) {
            return $row->category_id;
        } else {
            return false;
        }
    
      }

}
<?php
/*

* Get # of replies per topic

*/
function replyCount($topic_id) {

	$db = new Database;
	$db->query("SELECT * FROM replies WHERE topic_id = :topic_id AND approved=1");
	$db->bind(':topic_id', $topic_id);
	//Assign rows
	$rows = $db->resultset();
	//Get Count
	return $db->rowCount();
}

// get topics per category

function topicsCountPerCategory($category){
	$db = new Database;
	$db->query("SELECT topics.t_id FROM topics WHERE topics.category_id=:category AND topics.approved=1");
	$db->bind(':category', $category);
	//Assign rows
	$rows = $db->resultset();
	//Get Count
	return $db->rowCount();

}

function repliesCountPerCategory($category){
	$db = new Database;
	$db->query("SELECT replies.topic_id FROM replies LEFT JOIN topics ON replies.topic_id=topics.t_id WHERE topics.category_id=:category AND replies.approved=1");
	$db->bind(':category', $category);
	//Assign rows
	$rows = $db->resultset();
	//Get Count
	return $db->rowCount();

}


/*

* Get categories

*/

function getCategories() {
	$db = new Database;
	$db->query("SELECT * FROM categories");

	//Assign result set
	$results = $db->resultset();

	return $results;
}

function getMainCategories() {
	$db = new Database;
	$db->query("SELECT name, c_id FROM categories c_id where parent_id=0");

	//Assign result set
	$results = $db->resultset();

	return $results;
}

function getCategoriesWithLatestPost($parent_id) {
	$db = new Database;
	$db->query("SELECT c.name, u.username, t.last_activity, t.title, c.description, c.c_id, u.u_id, t.t_id, g.color FROM categories c LEFT JOIN topics t ON c.c_id=t.category_id LEFT JOIN users u ON t.user_id=u.u_id LEFT JOIN groups g ON u.group_id=g.g_id WHERE c.parent_id=:parent_id GROUP BY c.c_id ORDER BY c.c_id, t.t_id");


    $db->bind(':parent_id', $parent_id);
	//Assign result set
	$results = $db->resultset();

	return $results;
}

function listCategories($c_id) {
	$db = new Database;

    $db->query("SELECT * FROM categories WHERE parent_id=:c_id");

    $db->bind(':c_id', $c_id);


    $row = $db->resultset();
    
    return $row;

}

/*

* User Posts

*/

function userPostCount($user_id){
	$db = new Database;
	$db->query('SELECT * FROM topics WHERE user_id = :user_id AND topics.approved=1');

	$db->bind(':user_id', $user_id);
	//Assign rows
	$rows = $db->resultset();
	//Get count
	$topic_count = $db->rowCount();

	$db->query('SELECT * FROM replies WHERE user_id = :user_id AND approved=1');
	$db->bind(':user_id', $user_id);
	//Assign rows
	$rows = $db->resultset();
	//Get count
	$reply_count = $db->rowCount();

	return $topic_count + $reply_count;

}




function getMainCategorieswithPrivilage($g_id) {
	$db = new Database;
	$db->query("SELECT c.name, c.c_id, p.permission AS active FROM categories c LEFT JOIN privilages p ON (c.c_id=p.c_id AND p.g_id=:g_id) JOIN groups g ON g.g_id=:g_id WHERE parent_id=0");
	$db->bind(':g_id', $g_id);

	//Assign result set
	$results = $db->resultset();

	return $results;
}


function getMainCategorieswithPrivilageByUser($u_id) {
	$db = new Database;
	$db->query("SELECT c.name, c.c_id, p.permission AS active FROM categories c LEFT JOIN privilages_users p ON (c.c_id=p.c_id AND p.u_id=:u_id) WHERE parent_id=0");
	$db->bind(':u_id', $u_id);

	//Assign result set
	$results = $db->resultset();

	return $results;
}


function listCategorieswithPrivilageByUser($u_id, $c_id) {
	$db = new Database;

	$db->query("SELECT c.name, c.c_id, p.permission AS active FROM categories c LEFT JOIN privilages_users p ON (c.c_id=p.c_id AND p.u_id=:u_id) WHERE parent_id=:c_id");
	
	$db->bind(':u_id', $u_id);
    $db->bind(':c_id', $c_id);


    $row = $db->resultset();
    
    return $row;

}

function listCategorieswithPrivilage($g_id, $c_id) {
	$db = new Database;

	$db->query("SELECT c.name, c.c_id, p.permission AS active FROM categories c LEFT JOIN privilages p ON (c.c_id=p.c_id AND p.g_id=:g_id) JOIN groups g ON g.g_id=:g_id WHERE parent_id=:c_id");
	
	$db->bind(':g_id', $g_id);
    $db->bind(':c_id', $c_id);


    $row = $db->resultset();
    
    return $row;

}



function CategoryGroupsPrivilage($c_id) {
	$db = new Database;

	$db->query("SELECT *, g.g_id, IFNULL(p.permission,g.main_privilage) AS active FROM groups g LEFT JOIN privilages p ON g.g_id=p.g_id AND p.c_id=:c_id JOIN set_of_rights sor ON IFNULL(p.permission,g.main_privilage)=sor.sor_id");
	
    $db->bind(':c_id', $c_id);


    $row = $db->resultset();
    
    return $row;

}




function listOnline24h() {
	$db = new Database;

	$db->query("SELECT * FROM users u JOIN groups g ON u.group_id=g.g_id WHERE last_activity>= now() - INTERVAL 1 DAY");

    $row = $db->resultset();
    
    return $row;

}

function listOnline15min() {
	$db = new Database;

	$db->query("SELECT * FROM users u JOIN groups g ON u.group_id=g.g_id WHERE last_activity>= now() - INTERVAL 15 MINUTE");

    $row = $db->resultset();
    
    return $row;
}

function unreadmessages($user) {
	$db = new Database;

	$db->query("SELECT m.*, u2.username, u2.u_id, g.color FROM messages m JOIN users u2 ON m.sender_u_id=u2.u_id JOIN groups g ON u2.group_id=g.g_id where receivier_u_id=:r_u_id AND was_read=0");

	$db->bind(':r_u_id', $user);


	$row = $db->single();

	if($db->rowCount() > 0) {
		return true;
	} else {
		return false;
	}

}

function getPrivilageForUser($u_id,$c_id){
	$db = new Database;

	$db->query("SELECT *, COALESCE(pu.permission,p.permission,g.main_privilage) AS active FROM users u LEFT JOIN privilages_users pu ON u.u_id=pu.u_id AND pu.c_id=:c_id LEFT JOIN privilages p ON u.group_id=p.g_id AND p.c_id=:c_id LEFT JOIN groups g ON u.group_id=g.g_id WHERE u.u_id=:u_id");

	
	$db->bind(':u_id', $u_id);
	$db->bind(':c_id', $c_id);


	$row = $db->single();

	//Execute
	if($db->execute()) {
		return $row->active;
	} else {
		return false;
	}

  }

  function getPrivilageForUserbyTopic($u_id,$t_id){

$topic=new Topic;

$c_id=$topic->getCategoryID($t_id);

	$db = new Database;

	$db->query("SELECT *, COALESCE(pu.permission,p.permission,g.main_privilage) AS active FROM users u LEFT JOIN privilages_users pu ON u.u_id=pu.u_id AND pu.c_id=:c_id LEFT JOIN privilages p ON u.group_id=p.g_id AND p.c_id=:c_id LEFT JOIN groups g ON u.group_id=g.g_id WHERE u.u_id=:u_id");

	
	$db->bind(':u_id', $u_id);
	$db->bind(':c_id', $c_id);


	$row = $db->single();

	//Execute
	if($db->execute()) {
		return $row->active;
	} else {
		return false;
	}

  }


   function countmod($id) {
	$db = new Database;

	//Insert Query
	$db->query("SELECT c.c_id, COALESCE(pu.permission,p.permission,g.main_privilage) AS active FROM categories c LEFT JOIN privilages_users pu ON c.c_id=pu.c_id AND pu.u_id=:u_id LEFT JOIN privilages p ON c.c_id=p.c_id AND p.g_id=:g_id LEFT JOIN groups g ON g.g_id=:g_id WHERE COALESCE(pu.permission,p.permission,g.main_privilage)>4");
	//Bind Values
	
$user=new User;
$g_id=$user->getUser($id)->group_id;

	$db->bind(':g_id', $g_id);
	$db->bind(':u_id', $id);
	$row = $db->resultset();

	return $db->rowCount();    

	//Execute

}



  
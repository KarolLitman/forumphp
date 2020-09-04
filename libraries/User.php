<?php

class User {
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
	 public function register($data) {
	 	//Insert Query
	 	$this->db->query('INSERT INTO users (name, email, avatar, username, password, last_activity)
	 		             VALUES (:name, :email, :avatar, :username, :password, :last_activity)');

	 	//Bind Values
	 	$this->db->bind(':name', $data['name']);
	 	$this->db->bind(':email', $data['email']);
	 	$this->db->bind(':avatar', $data['avatar']);
	 	$this->db->bind(':username', $data['username']);
	 	$this->db->bind(':password', $data['password']);
	 	$this->db->bind(':last_activity', $data['last_activity']);

$token=hash('sha256', $data['email'].'activate');         
$message='Hello '.$data['name'].',

To complete your account registration and ensure your identity, please confirm your email address by visiting the link below:

http://forumphp.2ap.pl/panel.php?email='.$data['email'].'&token='.$token.'


If you believe you have received this in error, please email contact@forumphp.2ap.pl

Sincerely,
Forum php';


         mail($data['email'], 'Please confirm your user account', $message);


	 	//Execute
	 	if($this->db->execute()) {
	 		return true;
	 	} else {
	 		return false;
	 	}


	 }


	/*

	* Upload User Avatar

	*/

	public function uploadAvatar() {
		$allowedExts = array("gif","jpeg","jpg","png");
		$temp = explode(".", $_FILES["avatar"]["name"]);
		$extension = end($temp);

		if((($_FILES["avatar"]["type"] == "image/gif")

			|| ($_FILES["avatar"]["type"] == "image/jpeg")
			|| ($_FILES["avatar"]["type"] == "image/jpg")
			|| ($_FILES["avatar"]["type"] == "image/pjpeg")
			|| ($_FILES["avatar"]["type"] == "image/x-png")
			|| ($_FILES["avatar"]["type"] == "image/png")
			&& ($FILES["avatar"]["size"] < 50000)
			&& in_array($extension, $allowedExts))) {

			if($_FILES["avatar"]["error"] > 0) {
				redirect("index.php", $_FILES["avatar"]["error"], 'error');
			} else {

				if (file_exists("images/avatars/" . $_FILES["avatar"]["name"])) {
					redirect('index.php', 'File already exists', 'error');
				} else {
					move_uploaded_file($_FILES["avatar"]["tmp_name"],
					"images/avatars/" . $_FILES["avatar"]["name"]);

					return true;
				}
			}
		} else {
            return false;

		}
	}


	public function login($username, $password) {

		$this->db->query("SELECT * FROM users WHERE username = :username AND password = :password AND group_id>3");

		$this->db->bind(':username', $username);
		$this->db->bind(':password', $password);

		$row = $this->db->single();

		if($this->db->rowCount() > 0) {
			$this->setUserData($row);
			return true;
		} else {
			return false;
		}
    }
    
    public function activate($email,$token) {
		$this->db->query("SELECT * FROM users WHERE email = :email AND group_id=3");
		$this->db->bind(':email', $email);
        
		$row = $this->db->single();
        $token_database=hash('sha256', $row->email.'activate');         

        if($token_database===$token){




            $this->db->query("UPDATE users
            SET group_id=4
            WHERE email=:email AND group_id=3");
    
            $this->db->bind(':email', $email);

            if($this->db->execute()) {
                return true;
            } else {
                return false;
            }
  
        }
else{
    return false;
}
		



	}


	public function modify($data) {

if(!empty($data['new_password'])){
	$this->db->query("UPDATE users
	SET avatar=:avatar, password=:password, name=:name, last_activity=:last_activity
	WHERE username=:username");
	
	$this->db->bind(':password', $data['new_password']);
}else{
	$this->db->query("UPDATE users
	SET avatar=:avatar, name=:name, last_activity=:last_activity
	WHERE username=:username");
}

	
			$this->db->bind(':username', $data['username']);
			$this->db->bind(':name', $data['name']);
			$this->db->bind(':avatar', $data['avatar']);
			$this->db->bind(':last_activity', $data['last_activity']);


            if($this->db->execute()) {
                $_SESSION['name']=$data['name'];
                $_SESSION['avatar']=$data['avatar'];

                return true;
            } else {
                return false;
            }
	}


	public function modifyByAdmin($data) {




if(empty($data['password'])){

	$this->db->query("UPDATE users
	SET avatar=:avatar, name=:name, username=:username, email=:email, group_id=:group
	WHERE u_id=:id");

}
else{

	$this->db->query("UPDATE users
	SET avatar=:avatar, password=:password, name=:name, username=:username, email=:email, group_id=:group
	WHERE u_id=:id");	
	
	$this->db->bind(':password', $data['password']);
}

		$this->db->bind(':username', $data['username']);
		$this->db->bind(':name', $data['name']);
		$this->db->bind(':avatar', $data['avatar']);
		$this->db->bind(':username', $data['username']);
		$this->db->bind(':email', $data['email']);
		$this->db->bind(':id', $data['id']);
		$this->db->bind(':group', $data['group']);

		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
}

	public function listUsers($page) {

		$this->db->query("SELECT * FROM users u JOIN groups g ON u.group_id=g.g_id LIMIT 6 OFFSET :page_users");

		$this->db->bind(':page_users', $page*5);


		$row = $this->db->resultset();
		
		return $row;

    }
    
    public function listUsersbyGroup($g_id,$page) {

		$this->db->query("SELECT * FROM users u JOIN groups g ON u.group_id=g.g_id WHERE g.g_id=:g_id LIMIT 6 OFFSET :page_users");

		$this->db->bind(':page_users', $page*5);
		$this->db->bind(':g_id', $g_id);


		$row = $this->db->resultset();
		
		return $row;
	}

    public function listUsersbySearch($keyword,$page) {

		$this->db->query("SELECT * FROM users u JOIN groups g ON u.group_id=g.g_id WHERE u.username LIKE :keyword LIMIT 6 OFFSET :page_users");

		$this->db->bind(':page_users', $page*5);
		$this->db->bind(':keyword', '%'.$keyword.'%');


		$row = $this->db->resultset();
		
		return $row;
	}

	public function getUser($id){
		$this->db->query("SELECT * FROM users
                            WHERE users.u_id = :id			
		");
		$this->db->bind(':id', $id);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}


	public function getUser2($unameOremail){
		$this->db->query("SELECT * FROM users
                            WHERE username = :data OR email = :data");
		$this->db->bind(':data', $unameOremail);
		
		//Assign Row
		$row = $this->db->single();
		
		return $row;
	}


	public function sendToken($data){
		$this->db->query('INSERT INTO forgotten_passwords (token, user_id, used)
		VALUES (:token, :user_id, :used)');

$token=hash('sha256', $data->email.'forgot'.time());         
//Bind Values
$this->db->bind(':token', $token);
$this->db->bind(':user_id', $data->u_id);
$this->db->bind(':used', 0);

$message='Hello '.$data->name.',

You told us you forgot your password. If you really did, click here to choose a new one:

	http://forumphp.2ap.pl/panel.php?forgot='.$token.'
	
	If you didn’t mean to reset your password, then you can just ignore this email; your password will not change.


If you believe you have received this in error, please email contact@forumphp.2ap.pl

Sincerely,
Forum php';


mail($data->email, 'Reset your password', $message);


//Execute
if($this->db->execute()) {
return true;
} else {
return false;
}
	}


	public function checkToken($token) {

		$this->db->query("SELECT * FROM forgotten_passwords f join users u on u.u_id=f.user_id WHERE token=:token");

		$this->db->bind(':token', $token);

		$row = $this->db->single();

		if($this->db->rowCount() > 0) {
			
			$password = bin2hex(openssl_random_pseudo_bytes(4));


		$message='Hello,

			Your new password is '.$password.'
			

			
			If you believe you have received this in error, please email contact@forumphp.2ap.pl
			
			Sincerely,
			Forum php';

			mail($row->email, 'Your new password', $message);

			if(!$this->updatepassword($row->u_id,hash('sha256', $password))){
				return false;
			}


			if(!$this->setUsedToken($token)){
				return false;
			}


			return true;
		} else {
			return false;
		}
		

	}

private function updatepassword($id,$password){
	$this->db->query("UPDATE users
	SET password=:password
	WHERE u_id=:u_id");

$this->db->bind(':u_id', $id);
$this->db->bind(':password', $password);

	if($this->db->execute()) {
		return true;
	} else {
		return false;
	}
}

private function setUsedToken($token){
	$this->db->query("UPDATE forgotten_passwords
	SET used=:used
	WHERE token=:token");

$this->db->bind(':token', $token);
$this->db->bind(':used', 1);

	if($this->db->execute()) {
		return true;
	} else {
		return false;
	}
}

	private function setUserData($row) {

		$_SESSION['is_logged_in'] = true;
		$_SESSION['user_id'] = $row->u_id;
		$_SESSION['username'] = $row->username;
        $_SESSION['name'] = $row->name;
        $_SESSION['avatar'] = $row->avatar;
        $_SESSION['group'] = $row->group_id;
        $_SESSION['token'] = hash('sha256', $row->u_id.'hashtoken'.date("d"));
	}

	public function update($row) {

		$_SESSION['is_logged_in'] = true;
		$_SESSION['user_id'] = $row->u_id;
		$_SESSION['username'] = $row->username;
        $_SESSION['name'] = $row->name;
        $_SESSION['avatar'] = $row->avatar;
        $_SESSION['group'] = $row->group_id;
        $_SESSION['token'] = hash('sha256', $row->u_id.'hashtoken'.date("d"));
	}	


	public function logout() {
		unset($_SESSION['is_logged_in']);
		unset($_SESSION['user_id']);
		unset($_SESSION['username']);
        unset($_SESSION['name']);
        unset($_SESSION['avatar']);
        unset($_SESSION['group']);
        unset($_SESSION['token']);
		return true;
	}



	public function getTotalUsers() {
		
		$this->db->query("SELECT * FROM users");
		$rows = $this->db->resultset();
		return $this->db->rowCount();
	}

	public function delete($id) {
		//Insert Query
		$this->db->query("DELETE FROM users WHERE u_id = :u_id");
		//Bind Values
		$this->db->bind(':u_id', $id);

		//Execute
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
    }

	public function getUserID($username) {

		$this->db->query("SELECT * FROM users WHERE username=:username");

		$this->db->bind(':username', $username);

		$row = $this->db->single();

		//Execute
		if($this->db->execute()) {
			return $row->u_id;
		} else {
			return false;
		}
    }


	public function setLastActivity($user_id){
		$this->db->query("UPDATE users
		SET last_activity=DEFAULT
		WHERE u_id=:u_id");
	
	$this->db->bind(':u_id', $user_id);
	
		if($this->db->execute()) {
			return true;
		} else {
			return false;
		}
	}
}





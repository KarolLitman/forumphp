<?php require('core/init.php'); ?>

<?php 

//Crete Topic Object
$topic = new Topic;

//Crete User Object
$user = new User;

// Create validate object
$validate = new Validator;

if((isset($_GET['email'])) && (isset($_GET['token']))) {

	if($user->activate($_GET['email'],$_GET['token'])) {
		redirect('index.php', 'Your account has been activate.', 'success');
	} else {
		redirect('index.php', 'Something went wrong with your activation', 'error');
	}
}

if(isset($_POST['do_forgot'])){

    if(!empty($_POST['username'])){
    $variable=$_POST['username'];
    }
    elseif(!empty($_POST['email'])){
        $variable=$_POST['email'];
 
    }
    else{
        redirect('panel.php', 'Please fill fields', 'error'); 
    }
    $userdata=$user->getUser2($variable);

    if($user->sendToken($userdata)){
        redirect('index.php', 'please go to the email and confirm your identity.', 'success');
 
    }
    else{
        redirect('index.php', 'Something went wrong with your forgot password.', 'success');

    }
}

if(isset($_GET['forgot'])){

	if($user->checkToken($_GET['forgot'])){
        redirect('index.php', 'Your new password has been sent to email.', 'success');
 
    }
    else{
        redirect('index.php', 'Something went wrong with your token.', 'success');

    }

}




if(isset($_POST['register'])) {

	//Create Data Array

	$data = array();
	$data['name'] = $_POST['name'];
	$data['email'] = $_POST['email'];
	$data['username'] = $_POST['username'];
	$data['password'] = hash('sha256', $_POST['password']);
	$data['password2'] = hash('sha256', $_POST['password2']);
	$data['last_activity'] = date("Y-m-d H:i:s");

	//Required fields
	$field_array = array('name','email','username','password','password2');

	if($validate->isRequired($field_array)) {

		if($validate->isValidEmail($data['email'])) {

			if($validate->passwordsMatch($data['password'], $data['password2'])) {

				//Upload Avatar Image

				if($user->uploadAvatar()) {
					$data['avatar'] = $_FILES["avatar"]["name"];
				} else {
					$data['avatar'] = 'default.png';
				}

				// Register User
				if($user->register($data)) {
					redirect('index.php', 'Your account has been made, <br> please verify it by clicking the activation link that has been send to your email.', 'success');
				} else {
					redirect('index.php', 'Something went wrong with your registration', 'error');
				}


			} else {
				redirect('panel.php', 'Your password did not match', 'error');
			}
		} else {
			redirect('panel.php', 'Please use a valid email address', 'error');
		}
	} else {
		redirect('panel.php', 'Please fill in all the required fields', 'error');
	}

}

//Get Template $ Assign Vars

$template = new Template('templates/panel.php');

//Assign Vars



//Display template

$template->userdata=$userdata;
$template->variable=$variable;

echo $template;
?>
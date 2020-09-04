<?php require('core/init.php'); ?>

<?php 

//Crete Topic Object
$topic = new Topic;

//Crete User Object
$user = new User;

// Create validate object
$validate = new Validator;



if(isset($_POST['change'])) {

	//Create Data Array

	$data = array();
	$data['name'] = $_POST['name'];
    $data['username'] = $_SESSION['username'];
    $data['cur_password'] = hash('sha256', $_POST['cur_password']);
	$data['last_activity'] = date("Y-m-d H:i:s");

	//Required fields
	$field_array = array('name');

	if($validate->isRequired($field_array)) {



				//Upload Avatar Image
                if(!empty($_FILES["avatar"]["name"])){
                    if($user->uploadAvatar()) {
                        $data['avatar'] = $_FILES["avatar"]["name"];
                    } else {
                        $data['avatar'] = 'default.png';
                    }
                }
                else{
                    $data['avatar']=$_SESSION['avatar'];
                }

                if($user->login(getUser()['username'],$data['cur_password'])){

if(!empty($_POST['new_password']))
			if($validate->passwordsMatch($_POST['new_password'], $_POST['new_password2'])) {


                $data['new_password'] = hash('sha256', $_POST['new_password']);


			} else {
				redirect('settings.php', 'Your password did not match', 'error');
            }

				// Register User
				if($user->modify($data)) {
					redirect('index.php', 'You account has been changed', 'success');
				} else {
					redirect('index.php', 'Something went wrong with your changes', 'error');
				}

        }
            else{
                redirect('settings.php', 'Your current password is incorrect', 'error');

            }



	} else {
		redirect('settings.php', 'Please fill in all the required fields', 'error');
	}

}

//Get Template $ Assign Vars

$template = new Template('templates/settings.php');

//Assign Vars
$breadcrumb='<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
  <li class="breadcrumb-item active" aria-current="page">Settings</li>
</ol>
</nav>';

$template->title = $breadcrumb;


//Display template

echo $template;
?>
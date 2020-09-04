<?php require('core/init.php'); ?>

<?php 

//Crete Topic Object
$message = new Message;

//Crete User Object
$user = new User;

// Create validate object
$validate = new Validator;


if(isset($_POST['send_message'])) {
	//Create Validator Object
	$validate = new Validator;

	//Create Data Array
	$data = array();
    $data['s_u_id'] = getUser()['user_id'];
    $data['r_u_id'] = $user->getUserID($_POST['receivier_name']);
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
    

	//Required Fileds
	$field_array = array('receivier_name', 'title', 'body');


	if($validate->isRequired($field_array)) {

		if($message->addmessage($data)) {
			redirect('messages.php?folder=sent', 'Your message has been send', 'success');
		} else {
			redirect('new_message.php', 'Something went wrong with your message', 'error');
		}
	} else {
		redirect('new_message.php', 'Please fill in the required fields', 'error');
	}
}


//Get Template $ Assign Vars

$template = new Template('templates/new_message.php');

//Assign Vars
$breadcrumb='<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
  <li class="breadcrumb-item active" aria-current="page">Messages</li>
</ol>
</nav>';

if($_GET['folder']=='sent'){
    $template->messages=$message->listsent(getUser()['user_id']);
    $template->info='To';

}
else{
    $template->messages=$message->listreceived(getUser()['user_id']);
    $template->info='From';
}


$template->title = $breadcrumb;

if(isset($_GET['to'])){
    $template->to=$_GET['to'];
}

if(isset($_POST['title'])){
    $template->title_message=$_POST['title'];
}

//Display template

echo $template;
?>
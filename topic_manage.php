<?php require('core/init.php'); ?>

<?php 
//Create Topic Object
$topic = new Topic;

$user = new User;
$userinfo = getUser();


if(isset($_GET['delete'])) {

    if((getPrivilageForUser($userinfo['user_id'],$_GET['delete']))<6) {
    exit();
	}

    if (!filter_var($_GET['delete'], FILTER_VALIDATE_INT) === false ) {

    if($topic->delete($_GET['delete'])) {
        redirect('index.php', 'Topic has been deleted', 'success');
    } else {
        redirect('topic.php?id='.$topic_id, 'Something went wrong with deletingg', 'error');
    }
} else {
    redirect('topic.php?id='.$_GET['delete'], 'Something went wrong with deleting', 'error');
}

}


if(isset($_POST['do_create'])) {
	//Create Validator Object
	$validate = new Validator;

	//Create Data Array
	$data = array();
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
	$data['category_id'] = $_POST['id'];
	$data['user_id'] = getUser()['user_id'];
    $data['last_activity'] = date("Y-m-d H:i:s");
    
    if((getPrivilageForUserbyTopic($data['user_id'],$data['category_id'])>3)) {
        $data['approved'] = 1;
    }
    else{
        $data['approved'] = 0;
    }
	//Required Fileds
	$field_array = array('title', 'body', 'id');


	if($validate->isRequired($field_array)) {

		if($topic->create($data)) {
			redirect('index.php', 'Your topic has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
		}
	} else {
		redirect('topic_manage.php', 'Please fill in the required fields', 'error');
	}
}
elseif(isset($_POST['do_update'])){

    if((getPrivilageForUser($userinfo['user_id'],$_GET['edit']))<6) {
		exit();
	}

	//Create Validator Object
	$validate = new Validator;

	//Create Data Array
	$data = array();
	$data['title'] = $_POST['title'];
	$data['body'] = $_POST['body'];
	$data['id'] = $_POST['id'];

	//Required Fileds
	$field_array = array('title', 'body', 'id');



	if($validate->isRequired($field_array)) {

		if($topic->update($data)) {
			redirect('index.php', 'Your topic has been updated', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your post', 'error');
		}
	} else {
		redirect('topic_manage.php', 'Please fill in the required fields', 'error');
	}

}
//Get Template $ Assign Vars
$template = new Template('templates/topic_manage.php');

//Assign Vars
if($_GET['update'])
$template->topic=$topic->getTopic2($_GET['update']);


//Display template

echo $template;
?>
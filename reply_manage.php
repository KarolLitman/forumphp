<?php require('core/init.php'); ?>

<?php 
//Create Topic Object
$topic = new Topic;
$reply = new Reply;

$userinfo = getUser();


if(isset($_GET['delete'])) {

    if((getPrivilageForUserbyTopic($userinfo['user_id'],$reply->getTopicID($_GET['delete'])))<6) {
    exit();
	}

    if (!filter_var($_GET['delete'], FILTER_VALIDATE_INT) === false ) {

    if($reply->delete($_GET['delete'])) {
        redirect('index.php', 'Reply has been deleted', 'success');
    } else {
        redirect('topic.php?id='.$reply->getTopicID($_GET['delete']), 'Something went wrong with deletingg', 'error');
    }
} else {
    redirect('topic.php?id='.$reply->getTopicID($_GET['delete']), 'Something went wrong with deleting', 'error');
}

}

elseif(isset($_POST['do_update'])){

    if((getPrivilageForUserbyTopic($userinfo['user_id'],$reply->getTopicID($_GET['edit'])))<6) {
		exit();
	}

	//Create Validator Object
	$validate = new Validator;

	//Create Data Array
	$data = array();
	$data['body'] = $_POST['body'];
	$data['id'] = $_POST['id'];

	//Required Fileds
	$field_array = array('body', 'id');



	if($validate->isRequired($field_array)) {

		if($reply->update($data)) {
			redirect('index.php', 'Reply has been updated', 'success');
		} else {
			redirect('reply_manage.php?edit='.$_POST['id'], 'Something went wrong with your post', 'error');
		}
	} else {
		redirect('topic_manage.php?edit=1'.$_POST['id'], 'Please fill in the required fields', 'error');
	}

}
//Get Template $ Assign Vars
$template = new Template('templates/reply_manage.php');

//Assign Vars
if($_GET['edit'])
$template->reply=$topic->getReply($_GET['edit']);


//Display template

echo $template;
?>
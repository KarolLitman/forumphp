<?php require('core/init.php'); ?>

<?php 

//Create topic Object
$topic = new Topic;

$user = new User;
//Get id from URL
$topic_id = $_GET['id'];

if($_GET['page']>0){
$page = $_GET['page']-1;
}
else{
    $page=0;
}






//Process Reply

if(isset($_POST['do_reply'])) {

	//Create Data Array

	$data = array();
	$data['topic_id'] = $_GET['id'];
	$data['body'] = $_POST['body'];
	$data['user_id'] = getUser()['user_id'];


    if((getPrivilageForUserbyTopic(getUser()['user_id'],$_GET['id'])>3)) {
        $data['approved'] = 1;
    }
    else{
        $data['approved'] = 0;
    }


	//Create Validator Object
	$validate = new Validator;

	//Required fields
	$field_array = array('body');

	if($validate->isRequired($field_array)) {
		//Register User
		if($topic->reply($data)) {
			redirect('topic.php?id='.$topic_id, 'Your reply has been posted', 'success');
		} else {
			redirect('topic.php?id='.$topic_id, 'Something went wrong with your reply', 'error');
		}
	} else {
		redirect('topic.php?id='.$topic_id, 'Your reply form is blank, please fill it in.', 'error');
	}
}

//Get Template $ Assign Vars

$template = new Template('templates/topic.php');

//Assign Vars
$template->topic = $topic->getTopic($topic_id,getUser()['user_id']);
$r = $topic->getReplies($topic_id,$page,getUser()['user_id']);

if(count($r)==11){
    array_pop($r);
    $template->next=true;
}

if($page>0){

    $template->previous=true;
}
else{
    $template->previous=false;
}

$template->replies = $r;
$template->numpages = ceil($topic->getNumReplies($topic_id)/10);
$template->topic_id = $_GET['id'];
$template->page = $page+1;

$category=$topic->getCategoryName($_GET['id']);

$breadcrumb='<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item"><a href="index.php">Board Index</a></li>
    <li class="breadcrumb-item"><a href="topics.php?category='.$category->c_id.'">'.$category->name.'</a></li>
    <li class="breadcrumb-item active" aria-current="page">'.$topic->getTopic($topic_id,getUser()['user_id'])->title.'</li>
  </ol>
</nav>';

$template->title = $breadcrumb;


//Display template

echo $template;
?>
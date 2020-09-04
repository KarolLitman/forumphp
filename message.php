<?php require('core/init.php'); ?>

<?php 

//Crete Topic Object
$message = new Message;

//Crete User Object
$user = new User;

// Create validate object
$validate = new Validator;



//Get Template $ Assign Vars

$template = new Template('templates/message.php');

if(isset($_GET['id'])){
$template->message=$message->getmessage($_GET['id'],getUser()['user_id']);
if($template->message->r_u_id==getUser()['user_id'])
{
    if($template->message->was_read==0){
        $message->setRead($_GET['id']);

    }
}



}
//Assign Vars
$breadcrumb='<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
  <li class="breadcrumb-item"><a href="messages.php">Messages</a></li>
  <li class="breadcrumb-item active" aria-current="page">'.$template->message->title.'</li>
</ol>
</nav>';




$template->title = $breadcrumb;


//Display template

echo $template;
?>
<?php require('core/init.php'); ?>

<?php 

//Crete Topic Object
$message = new Message;

//Crete User Object
$user = new User;

// Create validate object
$validate = new Validator;



//Get Template $ Assign Vars

$template = new Template('templates/messages.php');

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
    $template->received=true;

}


$template->title = $breadcrumb;


//Display template

echo $template;
?>
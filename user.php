<?php require('core/init.php'); ?>

<?php 

$user = new User;


//Get user FROM URL
$user_id = isset($_GET['id']) ? $_GET['id'] : null;


//Get Template $ Assign Vars

$template = new Template('templates/user.php');



//Check For User Filter
if(isset($user_id)) {

    $template->user = $user->getUser($user_id);
    $breadcrumb='<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
      <li class="breadcrumb-item active" aria-current="page">Viewing profile - '.$template->user->username.'</li>
    </ol>
  </nav>';

	$template->title = $breadcrumb;
// $template->title = 'Posts By "'.$user_id->getUser($user_id)->username.'"';
}




//Display template

echo $template;
?>
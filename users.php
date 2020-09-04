<?php require('core/init.php'); ?>

<?php 

$user = new User;


//Get user FROM URL
$user_id = isset($_GET['id']) ? $_GET['id'] : null;



//Get Template $ Assign Vars

$template = new Template('templates/users.php');

$page=$_GET['page'];

//Check For User Filter

if(isset($_GET['g'])){
    $template->users = $user->listUsersbyGroup($_GET['g'],$page);
    $addition='with group id '.$_GET['g'];
}
else if(isset($_GET['s'])){
    $template->users = $user->listUsersbySearch($_GET['s'],$page);
    $addition='with keywords '.$_GET['s'];

}
else{
    $template->users = $user->listUsers($page);
}

    $breadcrumb='<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
      <li class="breadcrumb-item active" aria-current="page">Users '.$addition.'</li>
    </ol>
  </nav>';

	$template->title = $breadcrumb;




//Display template

echo $template;
?>
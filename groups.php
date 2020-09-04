<?php require('core/init.php'); ?>

<?php 

$group = new Group;
$user=new User;


//Get user FROM URL
$user_id = isset($_GET['id']) ? $_GET['id'] : null;


//Get Template $ Assign Vars

$template = new Template('templates/groups.php');

$page=$_GET['page'];

//Check For User Filter

    $template->groups = $group->listGroups();
    $breadcrumb='<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
      <li class="breadcrumb-item active" aria-current="page">Groups</li>
    </ol>
  </nav>';

	$template->title = $breadcrumb;




//Display template

echo $template;
?>
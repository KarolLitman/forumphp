<?php require('core/init.php'); ?>

<?php 

// Create Topic Object

$topic = new Topic;

//Create User Object
$user = new User;


//Get Template $ Assign Vars

$template = new Template('templates/frontpage.php');

//Assign Vars

$breadcrumb='<nav aria-label="breadcrumb">
  <ol class="breadcrumb">
    <li class="breadcrumb-item active" aria-current="page">Board index</li>
  </ol>
</nav>';

$template->title = $breadcrumb;

$template->topics = $topic->getAllTopics();
$template->totalTopics = $topic->getTotalTopics();

$template->totalCategories = $topic->getTotalCategories();
$template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
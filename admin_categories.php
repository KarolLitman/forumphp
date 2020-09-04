<?php require('core/init.php'); ?>

<?php 

// Create Topic Object


//Create User Object
$category = new Category;


//Get Template $ Assign Vars

$template = new Template('templates/admin_categories.php');

$template->categories = $category->listMainCategories();
$template->title = 'Categories';


//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
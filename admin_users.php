<?php require('core/init.php'); ?>

<?php 

//Create User Object
$user = new User;


//Get Template $ Assign Vars

$template = new Template('templates/admin_users.php');

$template->title = 'Users';

if($_GET['page']>0){
    $page = $_GET['page']-1;
    }
    else{
        $page=0;
    }

    $u = $user->listUsers($page);

    
    if(count($u)==6){
        array_pop($u);
        $template->next=true;
    }
    
    if($page>0){
    
        $template->previous=true;
    }
    else{
        $template->previous=false;
    }

    $template->users=$u;

$template->numpages = ceil($user->getTotalUsers()/5);
$template->page = $page+1;

//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
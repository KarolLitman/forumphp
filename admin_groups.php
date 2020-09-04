<?php require('core/init.php'); ?>

<?php 

$group = new Group;
$right = new Right;




$template = new Template('templates/admin_groups.php');

$template->title = 'Groups';

if($_GET['page']>0){
    $page = $_GET['page']-1;
    }
    else{
        $page=0;
    }

    $g = $group->listGroups();

    
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

    $template->groups=$g;

$template->numpages = ceil($group->getTotalGroups()/5);
$template->page = $page+1;


$template->rights=$right->getAllRights();

//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
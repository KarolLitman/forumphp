<?php require('core/init.php'); ?>

<?php 

// Create Topic Object


//Create User Object
$category = new Category;
$group = new Group;
$right = new Right;

$privilage = new Privilage;


if(isset($_POST['send_privilages'])){
    foreach($_POST as $key => $value) {
        if(is_numeric($key)){
            
            if($value!=0){

               $privilage->addPrivilage($_POST['g_id'],$key,$value);
            }
            else{
                $privilage->delPrivilage($_POST['g_id'],$key);
 
            }
        }
      }
}

//Get Template $ Assign Vars

$template = new Template('templates/admin_privilages.php');
$template->groups = $group->listGroups();

$template->categories = getMainCategorieswithPrivilage($_GET['group']);
$template->title = 'Privilages group - '.$group->get($_GET['group'])->group_name;

$template->rights=$right->getAllRights();


$template->group=$_GET['group'];


//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
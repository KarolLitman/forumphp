<?php require('core/init.php'); ?>

<?php 

// Create Topic Object


//Create User Object
$category = new Category;
$group = new Group;
$right = new Right;
$user = new User;

$privilage = new Privilage;


if(isset($_POST['send_privilages'])){
    foreach($_POST as $key => $value) {
        if(is_numeric($key)){
            
            if($value!=0){

               $privilage->addPrivilageUser($_POST['u_id'],$key,$value);
            }
            else{
                $privilage->delPrivilageUser($_POST['u_id'],$key);
 
            }
        }
      }


      redirect('admin_privilages_users.php?id='.$_POST['u_id'], 'Note has been deleted', 'success');

   
      
}

//Get Template $ Assign Vars

$template = new Template('templates/admin_privilages_users.php');
$template->groups = $group->listGroups();

$template->categories = getMainCategorieswithPrivilageByUser($_GET['id']);

$template->rights=$right->getAllRights();


$template->user=$user->getUser($_GET['id']);

$template->group=$_GET['group'];

$template->title = 'Privilages User - '.$template->user->username;

//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
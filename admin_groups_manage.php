<?php require('core/init.php'); ?>

<?php 

// if(!hasadmin()){
//     exit();
// }

$group = new Group;
$right = new Right;


if(isset($_POST['add'])){

$data = array();

$data['group_name'] = $_POST['group_name'];
$data['description'] = $_POST['description'];
$data['color'] = $_POST['color'];
$data['main_privilage'] = $_POST['main_privilage']; 

if($group->addGroup($data)){
    redirect('admin_groups.php', 'New group successly added', 'success');

}
else{
    redirect('admin_groups.php', 'Something was wrong with adding group', 'error');

}
}


if(isset($_GET['delete'])){

    if($group->delete($_GET['delete'])){
        redirect('admin_groups.php', 'Group has been deleted.', 'success');
   
    }
    else{
        redirect('admin_groups.php', 'Something went wrong with deleting.', 'error');

    }
}

if(isset($_POST['change'])){


    $data = array();
    
    $data['group_name'] = $_POST['group_name'];
    $data['description'] = $_POST['description'];
    $data['color'] = $_POST['color'];
    $data['main_privilage'] = $_POST['main_privilage'];
    $data['id'] = $_GET['edit'];



    if($group->modify($data)) {
        redirect('admin_groups.php', 'Group has been modified.', 'success');
    } else {
        redirect('admin_groups.php', 'Something went wrong with modification', 'error');
    }
}

//Get Template $ Assign Vars

$template = new Template('templates/admin_groups_manage.php');

if(isset($_GET['edit'])){

$template->group = $group->get($_GET['edit']);

}

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
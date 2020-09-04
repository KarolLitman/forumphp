<?php require('core/init.php'); ?>

<?php 

// if(!hasadmin()){
//     exit();
// }




//Create User Object
$user = new User;
$group = new Group;


if(isset($_GET['delete'])){

    if($user->delete($_GET['delete'])){
        redirect('admin_users.php', 'Account has been deleted.', 'success');
   
    }
    else{
        redirect('admin_users.php', 'Something went wrong with deleting.', 'error');

    }
}

if(isset($_POST['change'])){


	$data = array();
    $data['username'] = $_POST['username'];
    if(empty($_POST['password']))
    {
    $data['password']='';   
    }
    else{
        $data['password'] = hash('sha256', $_POST['password']);

    }
    $data['name'] = $_POST['name'];
    $data['email'] = $_POST['email'];
    $data['group'] = $_POST['group'];
    $data['id'] = $_GET['edit'];

    if(empty($_FILES["avatar"]["name"])){
        $data['avatar'] = $_POST['curravatar'];
    }
    else{
        $data['avatar'] = $_FILES["avatar"]["name"];
    }



    

    if($user->modifyByAdmin($data)) {
        if(!empty($_FILES["avatar"]["name"])){
        $user->uploadAvatar();
    }
        redirect('admin_users.php', 'Account has been modified.', 'success');
    } else {
        redirect('admin_users.php', 'Something went wrong with modification', 'error');
    }
}

//Get Template $ Assign Vars

$template = new Template('templates/admin_users_manage.php');

if(isset($_GET['edit'])){

$template->user = $user->getUser($_GET['edit']);
$template->groups = $group->ListGroups();

}

//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
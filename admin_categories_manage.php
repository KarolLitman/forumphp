<?php require('core/init.php'); ?>

<?php 

// if(!hasadmin()){
//     exit();
// }





//Create User Object
$category = new Category;

if(isset($_POST['add'])){


    $data = array();
    
    $data['name'] = $_POST['name'];
    $data['description'] = $_POST['description'];
    $data['parent_id'] = $_POST['parent_id'];

    if($category->add($data)){
        redirect('admin_categories.php', 'Category has been add.', 'success');
   
    }
    else{
        redirect('admin_categories.php', 'Something went wrong with add.', 'error');

    }
}

if(isset($_GET['delete'])){

    if($category->delete($_GET['delete'])){
        redirect('admin_categories.php', 'Category has been deleted.', 'success');
   
    }
    else{
        redirect('admin_categories.php', 'Something went wrong with deleting.', 'error');

    }
}

if(isset($_POST['change'])){


    $data = array();
    
    $data['name'] = $_POST['name'];
    $data['description'] = $_POST['description'];
    $data['id'] = $_GET['edit'];


    

    if($category->modify($data)) {
        redirect('admin_categories.php', 'Category has been modified.', 'success');
    } else {
        redirect('admin_categories.php', 'Something went wrong with modification', 'error');
    }
}

//Get Template $ Assign Vars

$template = new Template('templates/admin_categories_manage.php');

if(isset($_GET['edit'])){

$template->category = $category->get($_GET['edit']);

}

$template->categories = $category->listMainCategories();


//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
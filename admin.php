<?php require('core/init.php'); ?>

<?php 

//Create User Object
$note = new Note;

if(isset($_GET['delete'])) {

    if($note->delete($_GET['delete'])) {

        redirect('admin.php', 'Note has been deleted', 'success');

    } else {

        redirect('admin.php', 'Something went wrong with deleting', 'error');
    }

}

if(isset($_POST['add'])) {

    if($note->add($_POST['content'])) {

        redirect('admin.php', 'Note has been added', 'success');

    } else {

        redirect('admin.php', 'Something went wrong with adding', 'error');
    }

}
//Get Template $ Assign Vars

$template = new Template('templates/admin.php');

$template->notes = $note->listNotes();
$template->title = 'Notes';


//Assign Vars

// $template->title = '';

// $template->topics = $topic->getAllTopics();
// $template->totalTopics = $topic->getTotalTopics();
// $template->totalCategories = $topic->getTotalCategories();
// $template->totalUsers = $user->getTotalUsers();

//Display template

echo $template;
?>
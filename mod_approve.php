<?php require('core/init.php'); ?>

<?php 

$category=new Category;

if($category->CountModCategories(getUser()['user_id'])<1){
    exit();
}

$topic = new Topic;


if(isset($_GET['accept'])){
if($topic->acceptDeclineMessages($_GET['show'],$_GET['accept'],1)){
    redirect('mod_approve.php', 'Correctly accepted topic    .', 'success');
 
}
else{
    redirect('index.php', 'Something went wrong with accept topic.', 'error');

}

}
if(isset($_GET['decline'])){
if($topic->acceptDeclineMessages($_GET['show'],$_GET['decline'],-1)){
    redirect('mod_approve.php', 'Correctly declined topic    .', 'success');
 
}
else{
    redirect('index.php', 'Something went wrong with decline topic.', 'error');

}
}

//Get Template $ Assign Vars

$template = new Template('templates/mod_approve.php');

//Assign Vars

if($_GET['state']==-1){
    $template->title = 'Declined ';
}

if(isset($_GET['show'])){
    if($_GET['show']==='topics'){
        $template->elements = $topic->getAllTopicsByState(getUser()['user_id'],$_GET['state']);
        $template->title .= 'Topics';

    }
    elseif($_GET['show']==='replies'){
        $template->elements = $topic->getAllRepliesByState(getUser()['user_id'],$_GET['state']);
        $template->title .= 'Replies';

   
}
}


//Display template

echo $template;
?>
<?php require('core/init.php'); ?>

<?php 

//Create Topics Object
$topic = new Topic;
$user = new User;

//Get category FROM URL
$category = isset($_GET['category']) ? $_GET['category'] : null;

//Get user FROM URL
$user_id = isset($_GET['user']) ? $_GET['user'] : null;

$search = isset($_GET['s']) ? $_GET['s'] : null;


//Get Template $ Assign Vars

$template = new Template('templates/topics.php');

//Assign Template Variables
if(isset($category)) {

    if($_GET['page']>0){
        $page = $_GET['page']-1;
        }
        else{
            $page=0;
        }

    $breadcrumb='<nav aria-label="breadcrumb">
    <ol class="breadcrumb">
      <li class="breadcrumb-item"><a href="index.php">Board Index</a></li>
      <li class="breadcrumb-item active" aria-current="page">'.$topic->getCategory($category)->name.'</li>
    </ol>
  </nav>';

    $t=$topic->getByCategory($category,$page,getUser()['user_id']);
    
    if(count($t)==6){
        array_pop($t);
        $template->next=true;
    }
    
    if($page>0){
    
        $template->previous=true;
    }
    else{
        $template->previous=false;
    }

    $template->topics = $t;

$template->numpages = ceil($topic->getNumByCategory($category)/5);
$template->category = $_GET['category'];
$template->page = $page+1;
$template->catincat=getCategoriesWithLatestPost($_GET['category']);

	$template->title = $breadcrumb;
}

//Check For User Filter
if(isset($user_id)) {
	$template->topics = $topic->getByUser($user_id);
	// $template->title = 'Posts By "'.$user_id->getUser($user_id)->username.'"';
}
if(isset($search)){
    $template->topics = $topic->getBySearch($search);
    $addition='with keywords '.$_GET['s'];
}
else if(!isset($category) && !isset($user_id)) {
	$template->topics = $topic->getAllTopics();
}



$template->totalUsers = $user->getTotalUsers();
$template->totalTopics = $topic->getTotalTopics();
$template->totalCategories = $topic->getTotalCategories();


//Display template

echo $template;
?>
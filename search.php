<?php require('core/init.php'); 

$database=new Database;
$user=new User;

if(isset($_POST['send'])){
    if($_POST['optradio']=='topic'){
        redirect('topics.php?s='.$_POST['keyword']);
    }
    else{
        redirect('users.php?s='.$_POST['keyword']);
    }
}

$template = new Template('templates/search.php');


$breadcrumb='<nav aria-label="breadcrumb">
<ol class="breadcrumb">
  <li class="breadcrumb-item"><a href="index.php">Board index</a></li>
  <li class="breadcrumb-item active" aria-current="page">Search</li>
</ol>
</nav>';

$template->title = $breadcrumb;



echo $template;
?>
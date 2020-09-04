<?php require('core/init.php'); ?>

<?php 



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User;

    $userinfo=$user->getUser($_POST['user_id']);

    $token_generated=hash('sha256', $userinfo->u_id.'hashtoken'.date("d"));



if($_POST['token']==$token_generated){


    if($user->setLastActivity($userinfo->u_id)){

        header("HTTP/1.1 201 CREATED");
       

    }
    else{
        // header("HTTP/1.1 400 BAD REQUEST");

    }

}}

?>
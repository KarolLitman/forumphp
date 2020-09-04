<?php require('core/init.php'); ?>

<?php 

//Crete Topic Object
$shoutbox = new Shoutbox;

if ($_SERVER['REQUEST_METHOD'] === 'GET') {

print_r($shoutbox->listmessages());
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = new User;

    $userinfo=$user->getUser($_POST['user_id']);

    $token_generated=hash('sha256', $userinfo->u_id.'hashtoken'.date("d"));



if($_POST['token']==$token_generated){

	$data = array();
	$data['u_id'] = $userinfo->u_id;
	$data['body'] = $_POST['message'];

    if($shoutbox->sendmessage($data)){

        header("HTTP/1.1 201 CREATED");
       



        $json = array(
            'avatar' => $userinfo->avatar,
            'u_id' => $userinfo->u_id,
            'username' => $userinfo->username,
            'color' => $userinfo->color,
            'send_date' => date('Y-m-d h:i:s'),
            'body' => $_POST['message'],
        );

        echo json_encode($json);


    }
    else{
        // header("HTTP/1.1 400 BAD REQUEST");

    }

}}


if ($_SERVER['REQUEST_METHOD'] === 'DELETE') {
    $user = new User;

    $userinfo=$user->getUser($_GET['user_id']);

    $token_generated=hash('sha256', $userinfo->u_id.'hashtoken'.date("d"));


if($_GET['token']==$token_generated){

    if($userinfo->group_id>3)


    if($shoutbox->deletemessage($_GET['id'])){


        header("HTTP/1.1 200 OK");
       
    }
    else{
        // header("HTTP/1.1 400 BAD REQUEST");

    }

}}

?>
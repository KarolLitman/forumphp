<?php
/*

* Redirect To Page

*/
function redirect($page = FALSE, $message = NULL, $message_type = NULL) {

	if(is_string($page)) {
		$location = $page;
	} else {
		$location = $_SERVER['SCRIPT_NAME'];
	}

	//Check For Message
	if($message != NULL) {
		//SET Message 
		$_SESSION['message'] = $message;
	}

	//Check for Type
	if($message_type != NULL) {
		//Set message type
		$_SESSION['message_type'] = $message_type;
	}
	//Redirect
	header('Location: '.$location);
	exit;
}

/*

*

*/
function displayMessages() {

	if(!empty($_SESSION['message'])) {

		//Assign message Var
		$message = $_SESSION['message'];

		if(!empty($_SESSION['message_type'])) {
			//Assign Type Var

			$message_type = $_SESSION['message_type'];
			//Create Output
			if($message_type == 'error') {
				echo '<div class="alert alert-danger">' . $message . '</div>';
			} else {
				echo '<div class="alert alert-success">' . $message . '</div>';
			}
		}
		// Unset Message
		unset($_SESSION['message']);
		unset($_SESSION['message_type']);

	} else {
		echo '';
	}
}

/*

* Check if user is logged in

*/
function isLoggedIn(){
	if(isset($_SESSION['is_logged_in'])) {
		return true;
	} else {
		return false;
	}
}

function hasAdmin(){
	if($_SESSION['group']==7) {
		return true;
	} else {
		return false;
	}
}

function hasMod(){
	if($_SESSION['group']==6 || $_SESSION['group']==7) {
		return true;
	} else {
		return false;
	}
}
/*

* Get logged in User Info

*/

function getUser() {

	$userArray = array();
	$userArray['user_id'] = $_SESSION['user_id'];
	$userArray['username'] = $_SESSION['username'];
    $userArray['name'] = $_SESSION['name'];
    $userArray['avatar'] = $_SESSION['avatar'];
    $userArray['group'] = $_SESSION['group'];
    $userArray['token'] = $_SESSION['token'];

	return $userArray;
}

<?php include('core/init.php'); ?>

<?php

	if(isset($_POST['do_login'])) {

		//Get vars
		$username = $_POST['username'];
		$password = hash('sha256', $_POST['password']);


		//Create User object
		$user = new User;

echo $username;

		if($user->login($username, $password)) {

			redirect('index.php', 'You are now logged in', 'success');

		} else {

			redirect('panel.php', 'Login not valid or no activated account', 'error');
		}

	} else {

		redirect('index.php');
	}
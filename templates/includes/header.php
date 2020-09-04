<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    

    <title>Forum PHP</title>

    <!-- Bootstrap core CSS -->
    <link href="<?php echo BASE_URI; ?>templates/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="<?php echo BASE_URI; ?>templates/css/custom.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <script src="<?php echo BASE_URI; ?>templates/js/bootstrap.min.js"></script>
    <script src="<?php echo BASE_URI; ?>templates/js/ckeditor/ckeditor.js"></script>





	<? $userinfo = getUser(); ?>

<script>
var lastTimeID = 0;

$(document).ready(function() {
  interval15min();
});

function interval15min(){
  setInterval( function() { updateactivity(); }, 900000);
}


function updateactivity(){
  var chatInput = $('#chatInput').val();
  if(chatInput != ""){
    $.ajax({
        method: 'POST',
        data: ('user_id=<? echo $userinfo['user_id']; ?>&token=<? echo $userinfo['token']; ?>'),
        statusCode: {
        201: function (result) {



},
        400: function () {

            
            }
             
            },
        url: "/activity.php",
      })
  }
}
</script>


    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <?php 

      if(!isset($title)) {

          $title = SITE_TITLE;
      }

    ?>
  </head>

  <body>

    <nav class="navbar navbar-inverse navbar-fixed-top">
      <div class="container">
        <div class="navbar-header">
          <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
            <span class="sr-only">Toggle navigation</span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </button>
          <a class="navbar-brand" href="index.php">Forum PHP</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
          <ul class="navbar-nav navbar-right navbarvcenter">
            <?php if(!isLoggedIn()) : ?>
            <li><a href="users.php">Users</a></li>
            <li><a href="groups.php">Groups</a></li>
            <li><a href="search.php">Search</a></li>
            <li><a href="panel.php">Log in / Sign up</a></li>

            <?php else : ?>
            <li><a href="users.php">Users</a></li>
            <li><a href="groups.php">Groups</a></li>
            <li><a href="search.php">Search</a></li>


            <?php if(unreadmessages(getUser()['user_id'])){
echo '<li><a href="messages.php"><span class="new-messages">NEW Messages</a></span></li>';
            }

            else{
                echo '<li><a href="messages.php">Messages</a></li>';   
            }

            ?>
            <li><a href="settings.php">Settings</a></li>
            <li><a href="logout.php">Logout</a></li>

            <!-- <form method="post" action="logout.php">
            <input type="submit" name="do_logout" class="btn btn-primary" value="Logout">
            </form> -->
            <?php endif; ?>
          </ul>
        </div><!--/.nav-collapse -->
      </div>
    </nav>



    <div class="container">

      <div class="row">
        <div class="col-md-12">
          <div class="main-col">
            <div class="block">
              <?php echo $title; ?>
              <div class="clearfix"></div>
              <hr>
              <?php displayMessages(); ?>










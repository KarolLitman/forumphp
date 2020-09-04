<?php include('includes/header.php'); ?>

</div>

        <div class="col-md-8">
          <div class="main-col">
            <div class="block">
              <h2 class="pull-left">Register form</h1>
              <div class="clearfix"></div>

<form enctype="multipart/form-data" method="post" action="panel.php" autocomplete="off">
    <div class="form-group">
        <label for="name">Name*</label>
        <input type="text" class="form-control" name="name" placeholder="Enter your name here">
    </div>
    <div class="form-group">
        <label for="email">Email Address*</label>
        <input type="email" class="form-control" name="email" placeholder="Enter your email address">
    </div>
    <div class="form-group">
        <label for="username">Choose Username*</label>
        <input type="text" class="form-control" name="username" placeholder="Your desired username">
    </div>
    <div class="form-group">
        <label for="password">Password*</label>
        <input type="password" class="form-control" name="password" placeholder="Enter a password">
    </div>
    <div class="form-group">
        <label for="password2">Confirm Password*</label>
        <input type="password" class="form-control" name="password2" placeholder="Enter password again">
    </div>
    <div class="form-group">
        <label for="avatar">Upload Avatar</label>
        <input type="file" name="avatar" value="default.png">
    </div>
   	<input type="submit" name="register" value="Register" class="btn btn-primary">
</form>

</div>
</div>
</div>

        <div class="col-md-4">
          
          <div class="sidebar">

            <div class="block">
              <h3>Login Form</h3>
              <?php if(isLoggedIn()) : ?>

                <div class="userdata">
                  Welcome, <?php echo getUser()['username']; ?>
                </div>
                <br>
                <form role="form" method="post" action="logout.php">
                  <input type="submit" name="do_logout" class="btn btn-primary" value="Logout">
                </form>

              <?php else : ?>
              <form role="form" method="post" action="login.php">
                <div class="form-group">
                  <label>Username</label>
                  <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>
                <div class="form-group">
                  <label>Password</label>
                  <input name="password" type="password" class="form-control" placeholder="Enter Password">
                </div>      
                <button name="do_login" type="submit" class="btn btn-primary">Login</button>
              </form>
              <?php endif; ?>

            </div>


                        <div class="block">
              <h3>Forgotten Password Form</h3>

                <div class="userdata">


              <form role="form" method="post" action="panel.php">
                <div class="form-group">
                  <label>Press Email</label>
                  <input name="email" type="text" class="form-control" placeholder="Enter email">
                </div>
                <div class="form-group">
                  <label>or Username</label>
                  <input name="username" type="text" class="form-control" placeholder="Enter Username">
                </div>      
                <button name="do_forgot" type="submit" class="btn btn-primary">Send</button>
              </form>

            </div>

<?php  print_r($userdata);?>

<?php echo $variable;?>

<?php include('includes/footer.php'); ?>
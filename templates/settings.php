<?php include('includes/header.php'); ?>



<form enctype="multipart/form-data" method="post" action="settings.php" autocomplete="off">
<div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" value="<?php echo getUser()['name']; ?>" name="name" placeholder="Enter your name here">
    </div>
<div class="form-group">
        <label for="password">Current Password*</label>
        <input id="password" type="password" class="form-control" name="cur_password" placeholder="password">
    </div>
    <div class="form-group">
        <label for="new_password">New password*</label>
        <input id="new_password" type="password" class="form-control" name="new_password" placeholder="password">
    </div>
    <div class="form-group">
        <label for="confirm">Confirm password*</label>
        <input id="confirm" type="password" class="form-control" name="new_password2" placeholder="password">
    </div>
    <div class="form-group">
        <label for="avatar">Current Avatar</label>
        <br><img width="100" height="100" alt="my_avatar" src="images/avatars/<?php echo getUser()['avatar']; ?>"/>
        <input type="file" id="avatar" name="avatar">
    </div>
   	<input type="submit" name="change" value="Change" class="btn btn-default">
</form>



<?php include('includes/footer.php'); ?>
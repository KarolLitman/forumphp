<?php include('includes/admin_header.php'); ?>



		
        <form enctype="multipart/form-data" method="post" action="admin_users_manage.php?edit=<?php echo $_GET['edit']; ?>" autocomplete="off">

    <div class="form-group">
        <label for="email">Username</label>
        <input type="text" class="form-control" value="<?php echo $user->username; ?>" name="username" placeholder="password">
    </div>
    <div class="form-group">
        <label for="name">Password</label>
        <input type="password" class="form-control" name="password" placeholder="password">
    </div>
<div class="form-group">
        <label for="name">Name</label>
        <input type="text" class="form-control" value="<?php echo $user->name; ?>" name="name" placeholder="Enter your name here">
    </div>

    <div class="form-group">
        <label for="email">Email</label>
        <input type="text" class="form-control" value="<?php echo $user->email; ?>" name="email" placeholder="password">
    </div>



    <div class="form-group">
        <label for="email">Group</label>
        <select name="group">

        <?php foreach($groups as $group) : ?>


<?


if($user->group_id==$group->g_id){
$selected='selected';
}
else{
    $selected='';
}
?>

        <option value="<?php echo $group->g_id; ?>" <?php echo $selected; ?>><?php echo $group->group_name; ?></option>


<?        endforeach ; ?>
</select>      </div>

    <div class="form-group">
        <label for="avatar">Current Avatar</label>
        <br><img width="100px" height="100px" src="images/avatars/<?php echo $user->avatar; ?>"/>
        <input type="file" name="avatar">
    </div>


    <input type="hidden" name="curravatar" value="<?php echo $user->avatar; ?>"/>

   	<input type="submit" name="change" value="Change" class="btn btn-default">



</form>








<?php include('includes/admin_footer.php'); ?>

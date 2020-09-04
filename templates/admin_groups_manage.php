<?php include('includes/admin_header.php'); ?>


 
		
        <form enctype="multipart/form-data" method="post" action="admin_groups_manage.php?edit=<?php echo $_GET['edit']; ?>" autocomplete="off">

<div class="form-group">
    <label for="email">Name</label>
    <input type="text" class="form-control" name="group_name" value="<?php echo $group->group_name ?>" placeholder="name">
</div>
<div class="form-group">
    <label for="name">Description</label>
    <input type="text" class="form-control" name="description" value="<?php echo $group->description ?>" placeholder="description...">
</div>
<div class="form-group">
    <label for="name">Color</label>
    <input type="text" class="form-control" name="color" value="<?php echo $group->color ?>" placeholder="hex color...">
</div>
<div class="form-group">
    <label for="name">Main privilage</label>
      <select class="form-control" name="main_privilage">

      <?php foreach($rights as $right) : 
      if($group->main_privilage==$right->sor_id)
$selected='selected';

else
$selected='';
      ?>
      <option value="<?php echo $right->sor_id ?>"<?php echo $selected ?>><?php echo $right->description ?></option>
      <?php endforeach; ?>


</select>
</div>


 <input type="submit" name="change" value="Change" class="btn btn-default">
</form>







<?php include('includes/admin_footer.php'); ?>

<?php include('includes/admin_header.php'); ?>



		
        <form enctype="multipart/form-data" method="post" action="admin_categories_manage.php?edit=<?php echo $_GET['edit']; ?>" autocomplete="off">

    <div class="form-group">
        <label for="email">Name</label>
        <input type="text" class="form-control" value="<?php echo $category->name; ?>" name="name" placeholder="password">
    </div>
    <div class="form-group">
        <label for="name">Password</label>
        <input type="text" class="form-control" value="<?php echo $category->description; ?>" name="description" placeholder="password">
    </div>
    <div class="form-group">
        <label for="name">Category or subcategory</label>
          <select class="form-control" name="parent_id">
          <option value="0">Main category</option>

          <?php foreach($categories as $maincategory) : ?>
          <option value="<?php echo $maincategory->c_id ?>"><?php echo $maincategory->name ?></option>
          <?php endforeach; ?>


  </select>
    </div>

   	<input type="submit" name="change" value="Change" class="btn btn-default">
</form>








<?php include('includes/admin_footer.php'); ?>

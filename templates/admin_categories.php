<?php include('includes/admin_header.php'); 


?>


		
				
        <form enctype="multipart/form-data" method="post" action="admin_categories_manage.php" autocomplete="off">

    <div class="form-group">
        <label for="name">Name</label>
        <input id="name" type="text" class="form-control" name="name" placeholder="name">
    </div>
    <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" class="form-control" name="description" placeholder="description...">
    </div>
    <div class="form-group">
        <label for="category">Category or subcategory</label>
          <select id="category" class="form-control" name="parent_id">
          <option value="0">Main category</option>

          <?php foreach($categories as $maincategory) : ?>
          <option value="<?php echo $maincategory->c_id ?>"><?php echo $maincategory->name ?></option>
          
          <?php foreach(listCategories($maincategory->c_id) as $category) : ?>
          <option value="<?php echo $category->c_id ?>">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $category->name ?></option>

                    <?php endforeach; ?>

          <?php endforeach; ?>


  </select>
    </div>


   	<input type="submit" name="add" value="Add" class="btn btn-default">
</form>


<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">description</th>
      <th scope="col">operations</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($categories as $maincategory) : ?>

    <tr>
      <th scope="row"><?php echo $maincategory->c_id; ?></th>
      <td><?php echo $maincategory->name; ?></td>
      <td><?php echo $maincategory->description; ?></td>
	  <td><a href="admin_categories_manage.php?edit=<?php echo $maincategory->c_id;?>"><img alt="icon edit" src="images/icons/edit.png"/></a> <a href="admin_categories_manage.php?delete=<?php echo $user->u_id;?>"><img alt="icon delete" src="images/icons/delete.png"/></a></td> 
	
      <?php foreach(listCategories($maincategory->c_id) as $category) : ?>
      <tr>
      <th scope="row"><?php echo $category->c_id; ?></th>
      <td><p class="childcategory"><?php echo $category->name; ?></p></td>
      <td><?php echo $category->description; ?></td>
	  <td><a href="admin_categories_manage.php?edit=<?php echo $category->c_id;?>"><img alt="icon edit" src="images/icons/edit.png"/></a> <a href="admin_categories_manage.php?delete=<?php echo $user->u_id;?>"><img alt="icon delete" src="images/icons/delete.png"/></a></td> 
  </tr>

    <?php foreach(listCategories($category->c_id) as $subcategory) : ?>
      <tr>
      <th scope="row"><?php echo $subcategory->c_id; ?></th>
      <td><p class="childchildcategory"><?php echo $subcategory->name; ?></p></td>
      <td><?php echo $category->description; ?></td>
	  <td><a href="admin_categories_manage.php?edit=<?php echo $subcategory->c_id;?>"><img alt="icon edit" src="images/icons/edit.png"/></a> <a href="admin_categories_manage.php?delete=<?php echo $user->u_id;?>"><img alt="icon delete" src="images/icons/delete.png"/></a></td> 
    </tr>
    <?php endforeach; ?>

    <?php endforeach; ?>
		<?php endforeach; ?>


  </tbody>
</table>






<?php include('includes/admin_footer.php'); ?>

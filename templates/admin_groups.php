<?php include('includes/admin_header.php'); ?>



<form enctype="multipart/form-data" method="post" action="admin_groups_manage.php" autocomplete="off">

<div class="form-group">
    <label for="name">Name</label>
    <input id="name" type="text" class="form-control" name="group_name" placeholder="name">
</div>
<div class="form-group">
    <label for="description">Description</label>
    <input id="description" type="text" class="form-control" name="description" placeholder="description...">
</div>
<div class="form-group">
    <label for="color">Color</label>
    <input id="color" type="text" class="form-control" name="color" placeholder="hex color...">
</div>
<div class="form-group">
    <label for="main">Main privilage</label>
      <select id="main" class="form-control" name="main_privilage">

      <?php foreach($rights as $right) : ?>
      <option value="<?php echo $right->sor_id ?>"><?php echo $right->description ?></option>
      <?php endforeach; ?>


</select>
</div>


 <input type="submit" name="add" value="Add" class="btn btn-default">
</form>

		


<table class="table">
  <thead>
    <tr>
      <th scope="col">g_id</th>
      <th scope="col">name</th>
      <th scope="col">description</th>
      <th scope="col">color</th>
      <th scope="col">main privilage</th>
      <th scope="col">operations</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($groups as $group) : ?>

    <tr>
      <th scope="row"><?php echo $group->g_id; ?></th>
      <td><span style="color: <?php echo $group->color; ?>"><?php echo $group->group_name; ?></span></td>
      <td><?php echo $group->description; ?></td>
      <td><?php echo $group->color; ?></td>
      <td><?php echo $group->main_privilage_desc; ?></td>
	  <td><a href="admin_groups_manage.php?edit=<?php echo $group->g_id;?>"><img alt="icon edit" src="images/icons/edit.png"/></a> 
    
  
    <?php

if($group->locked==0){
 echo '<a href="admin_groups_manage.php?delete='.$group->g_id.'"><img alt="icon delete" src="images/icons/delete.png"/></a>';

}

?>
    
    
    </td> 
	</tr>
		<?php endforeach; ?>


  </tbody>
</table>

<nav aria-label="Page navigation example">
  <ul class="pagination">
	<?php
	
	if($previous){

		echo '<li class="page-item"><a class="page-link" href="admin_users.php?page='.($page-1).'">Previous</a></li>';
 }
	for($i=1;$i<=$numpages;$i++){
        if($i==$page){
           $active=' <span class="sr-only">(current)</span>';
           $active2='active';
        }
        else{
            $active='';
            $active2='';
        }
		echo '<li class="page-item '.$active2.'"><a class="page-link" href="admin_groups.php?page='.$i.'">'.$i.$active.'</a></li>';
	}
		if($next){
		
		echo '<li class="page-item"><a class="page-link" href="admin_groups.php?page='.($page+1).'">Next</a></li>';
 }
	?>
  </ul>
</nav>







<?php include('includes/admin_footer.php'); ?>

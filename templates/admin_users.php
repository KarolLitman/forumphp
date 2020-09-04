<?php include('includes/admin_header.php'); ?>



		
		


<table class="table">
  <thead>
    <tr>
      <th scope="col">u_id</th>
      <th scope="col">name</th>
      <th scope="col">email</th>
      <th scope="col">avatar</th>
	  <th scope="col">username</th>
      <th scope="col">group</th>
      <th scope="col">joined</th>
      <th scope="col">last activity</th>
      <th scope="col">operations</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($users as $user) : ?>

    <tr>
      <th scope="row"><?php echo $user->u_id; ?></th>
      <td><a href="admin_privilages_users.php?id=<?php echo $user->u_id; ?>"><?php echo $user->name; ?></a></td>
      <td><?php echo $user->email; ?></td>
      <td><img width="20" height="20" alt="user avatar" src="../images/avatars/<?php echo $user->avatar; ?>"/></td>
      <td><?php echo $user->username; ?></td>
      <td><?php echo $user->group_name; ?></td>
      <td><?php echo $user->joined; ?></td>
      <td><?php echo $user->last_activity; ?></td>
	  <td><a href="admin_users_manage.php?edit=<?php echo $user->u_id;?>"><img alt="icon edit" src="images/icons/edit.png"/></a> <a href="admin_users_manage.php?delete=<?php echo $user->u_id;?>"><img alt="icon delete" src="images/icons/delete.png"/></a></td> 
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
		echo '<li class="page-item '.$active2.'"><a class="page-link" href="admin_users.php?page='.$i.'">'.$i.$active.'</a></li>';
	}
		if($next){
		
		echo '<li class="page-item"><a class="page-link" href="admin_users.php?page='.($page+1).'">Next</a></li>';
 }
	?>
  </ul>
</nav>








<?php include('includes/admin_footer.php'); ?>

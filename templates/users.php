<?php include('includes/header.php'); ?>



<table class="table">
  <thead>
    <tr>
      <th scope="col">u_id</th>
      <th scope="col">name</th>
	  <th scope="col">username</th>
      <th scope="col">group</th>
      <th scope="col">joined</th>
      <th scope="col">last actived</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($users as $user) : ?>

    <tr>
      <th scope="row"><?php echo $user->u_id; ?></th>
      <td><?php echo $user->name; ?></td>
      <td><a style="color: <?php echo $user->color; ?>" href="user.php?id=<?php echo $user->u_id; ?>"><?php echo $user->username; ?></a></td>
      <td><?php echo $user->group_name; ?></td>
      <td><?php echo $user->joined; ?></td>
      <td><?php echo $user->last_activity; ?></td>

	</tr>
		<?php endforeach; ?>


  </tbody>
</table>




<?php include('includes/footer.php'); ?>
<?php include('includes/header.php'); ?>



<table class="table">
  <thead>
    <tr>
      <th scope="col">Group name</th>
      <th scope="col">Description</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($groups as $group) : ?>

    <tr>
      <th scope="row"><a href="users.php?g=<?php echo $group->g_id; ?>" style="color: <?php echo $group->color; ?>"><?php echo $group->group_name; ?></a></th>
      <td><?php echo $group->description; ?></td>
	</tr>
		<?php endforeach; ?>


  </tbody>
</table>




<?php include('includes/footer.php'); ?>
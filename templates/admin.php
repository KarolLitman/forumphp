<?php include('includes/admin_header.php'); ?>


		
				
        <form enctype="multipart/form-data" method="post" action="admin.php" autocomplete="off">

    <div class="form-group">
        <label for="description">Description</label>
        <input id="description" type="text" class="form-control" name="content" placeholder="description...">
    </div>



   	<input type="submit" name="add" value="Add" class="btn btn-default">
</form>




		<?php foreach($notes as $note) : ?>
        <div class="well">
            <div class="media">
  <div class="media-left">
  <a href="admin.php?delete=<?php echo $note->id_n;?>"><img alt="delete icon" src="images/icons/delete.png"/></a>
  </div>
  <div class="media-body">
    <p><?php echo $note->content; ?></p>
  </div>
</div>
</div>
		<?php endforeach; ?>






<?php include('includes/admin_footer.php'); ?>

<?php include('includes/header.php'); ?>



	<ul id="topics">
<?php if($page==1){ ?>
	    <li id="main-topic" class="topic topic">
	      <div class="row">

	        <div class="col-md-2">
	          <div class="user-info">
              <ul>
								<li><img class="avatar pull-left" alt="avatar <?php echo $topic->username; ?>" src="images/avatars/<?php echo $topic->avatar; ?>" /></li>
	            
	              <li><a style="color: <?php echo $topic->color ?>" href="<?php echo BASE_URI; ?>user.php?id=<?php echo $topic->user_id; ?>">
<strong><?php echo $topic->username; ?></strong></a></li>
<li>Group: <?php echo $topic->group_name; ?></li>
	              <li><?php echo userPostCount($topic->user_id); ?> Posts</li>
	            </ul>
	          </div>
	        </div> <!-- /col-md-2 -->

	        <div class="col-md-10">
	          <div class="topic-content pull-right">
	            	<?php echo $topic->body; ?>
                    <?php if($topic->approved==0){
    echo '<div class="alert alert-info" role="alert">
    Your topic is waiting for acceptance
  </div>';}?>	
	          </div>
	        </div>
					
	      </div>
          <?php if((getPrivilageForUser(getUser()['user_id'],$_GET['id']))>5) : ?>
				<span class="align-text-bottom"><p class="text-right"><a href="topic_manage.php?update=<?php echo $_GET['id'];?>"><img alt="icon edit" src="images/icons/edit.png"/> Edit</a> <a href="topic_manage.php?delete=<?php echo $_GET['id'];?>"><img alt="icon edit" src="images/icons/delete.png"/> Delete</a></span>
				<?php endif; ?>

	    </li> <!-- / topic li -->
		


		<?php } foreach($replies as $reply) : ?>
	    <li class="topic topic">
	      <div class="row">

	        <div class="col-md-2">
	          <div class="user-info"><ul>
	            <li><img  alt="avatar <?php echo $reply->username; ?>" src="<?php echo BASE_URI; ?>images/avatars/<?php echo $reply->avatar; ?>" class="avatar pull-left img-responsive"></li>
	            
	              <li><a style="color: <?php echo $reply->color ?>" href="<?php echo BASE_URI; ?>user.php?id=<?php echo $reply->user_id; ?>"><strong><?php echo $reply->username; ?></strong></a></li>
								<li>Group: <?php echo $reply->group_name; ?></li>
								<li><?php echo userPostCount($reply->user_id)?> Posts</li>
	            </ul>
	          </div>
	        </div> <!-- /col-md-2 -->

	        <div class="col-md-10">
	          <div class="topic-content pull-right">
	            	<?php echo $reply->body; ?>
                <?php if($reply->approved==0){
    echo '<div class="alert alert-info" role="alert">
    Your answer is waiting for acceptance
  </div>';}?>
	          </div>
					</div>
				</div>
                <?php if((getPrivilageForUser(getUser()['user_id'],$_GET['id']))>5) : ?>
				<span class="align-text-bottom"><p class="text-right"><a href="reply_manage.php?edit=<?php echo $reply->r_id;?>"><img alt="icon edit" src="images/icons/edit.png"/> Edit</a> <a href="reply_manage.php?delete=<?php echo $reply->r_id;?>"><img alt="icon delete" src="images/icons/delete.png"/> Delete</a>
				<?php endif; ?>
	    </li> <!-- / topic li -->
	<?php endforeach; ?>

	    
	    
	</ul> <!-- / topics list -->

<nav aria-label="Page navigation example">
  <ul class="pagination">
	<?php
	
	if($previous){

		echo '<li class="page-item"><a class="page-link" href="topic.php?id='.$topic_id.'&page='.($page-1).'">Previous</a></li>';
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

		echo '<li class="page-item '.$active2.'"><a class="page-link" href="topic.php?id='.$topic_id.'&page='.$i.'">'.$i.$active.'</a></li>';
	}
		if($next){
		
		echo '<li class="page-item"><a class="page-link" href="topic.php?id='.$topic_id.'&page='.($page+1).'">Next</a></li>';
 }
	?>
  </ul>
</nav>

  	<h3>Reply To Topic</h3>

  	  	<?php if((getPrivilageForUser(getUser()['user_id'],$_GET['id']))>2) : ?>


  	<form action="topic.php?id=<?php echo $topic->t_id; ?>" method="post">
	    <div class="form-group">
	      <textarea name="body" id="body" cols="80" rows="10" class="form-control"></textarea>
	      <script>CKEDITOR.replace("body");</script>
	    </div>
	    <button class="btn btn-defaul" type="submit" name="do_reply">Submit</button>
  	</form>
  	<?php else : ?>

  	<div class="row">
  		<br><br>
  		<p style="text-align: center;"><em>You must be logged in to reply to posts. If you don't have an account yet, you can go to <a href="register.php">register</a> to create one.</em></p>
  	</div>

  	<?php endif; ?>


<?php include('includes/footer.php'); ?>
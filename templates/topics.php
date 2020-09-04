<?php include('includes/header.php'); ?>
<? $userinfo = getUser(); ?>

        <?php foreach($catincat as $category) : 
            if((getPrivilageForUser($userinfo['user_id'],$category->c_id))>1){

            ?>
      
      <div class="topic">
        <div class="row">

          <div class="col-md-1">
            <!-- <img class="avatar pull-left img-responsive" src="images/avatars/<?php echo $topic->avatar; ?>" /> -->
          </div> <!-- /col-md-2 -->

          <div class="col-md-5">
            <div class="topic-content pull-right">
              <h3><a href="topics.php?category=<?php echo $category->c_id; ?>"><?php echo $category->name; ?></a></h3>
              <div class="topic-info">
              <?php echo $category->description; ?>
            </div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="pull-right text-center">
              <?php echo topicsCountPerCategory($category->c_id); ?><br>topics
            </div>
          </div>
          <div class="col-md-1">
            <div class="pull-right text-center">
            <?php echo repliesCountPerCategory($category->c_id); ?><br>replies
            </div>
          </div>
          <div class="col-md-3">
            <div class="pull-right">
            <span class="pull-right"><a href="topic.php?id=<?php echo $category->t_id; ?>"><?php echo $category->title; ?></a> <?php if(!empty($category->title)) echo 'by'; ?> <a <?php if(!empty($category->color))echo 'style="color: '.$category->color.'"';?> href="user.php?id=<?php echo $category->u_id; ?>"><?php echo $category->username; ?></a><br><?php echo $category->last_activity; ?></span>
            </div>
          </div> 

        </div> <!-- /row -->
      </div>
            <?php } endforeach ; ?>

  	<?php if((getPrivilageForUser($userinfo['user_id'],$_GET['category']))>2) : ?>

  	<form action="topic_manage.php?create=<?php echo $_GET['category']; ?>" method="post">
    <input type="submit" class="btn btn-primary btn-md" value="New Thread">
  	</form>

  	<?php endif; ?>


    <div id="topics">


      <?php if($topics) : ?>

        <?php foreach($topics as $topic) : ?>
      


      <div class="topic">
        <div class="row">

          <div class="col-md-1">
            <img class="avatar pull-left img-responsive" alt="avatar <?php echo $topic->username; ?>" src="images/avatars/<?php echo $topic->avatar; ?>" />
          </div> <!-- /col-md-2 -->

          <div class="col-md-5">
            <div class="topic-content pull-right">
              <h3><a href="topic.php?id=<?php echo $topic->t_id; ?>"><?php echo $topic->title; ?></a></h3>
              <div class="topic-info">
               Created by <a style="color: <?php echo $topic->color?>" href="user.php?id=<?php echo urlFormat($topic->user_id); ?>"><?php echo $topic->username; ?></a> 
               » <?php echo formatDate($topic->create_date); ?>
              </div>
            </div>
          </div> <!-- /col-md-10 -->
          <div class="col-md-1"><div class="pull-right text-center">
          <?php echo replyCount($topic->t_id); ?><br>Replies
</div>
</div>
            <div class="col-md-5">

        </div> <!-- /row -->
      </div>
      </div> <!-- /ul#topic -->

      <?php endforeach ; ?>


    <?php else : ?>
      <p>No Topics To Display</p>
    <?php endif; ?>

<nav aria-label="Page navigation example">
  <ul class="pagination">
	<?php
	if($previous){

		echo '<li class="page-item"><a class="page-link" href="topics.php?category='.$_GET['category'].'&page='.($page-1).'">Previous</a></li>';
 }


	for($i=1;$i<=$numpages;$i++){
        if($i==$page){
           $active='<span class="sr-only">(current)</span>';
           $active2='active';
        }
        else{
            $active='';
            $active2='';
        }
		echo '<li class="page-item '.$active2.'"><a class="page-link" href="topics.php?category='.$_GET['category'].'&page='.$i.'">'.$i.$active.'</a></li>';
	}
		if($next){
		
		echo '<li class="page-item"><a class="page-link" href="topics.php?category='.$_GET['category'].'&page='.($page+1).'">Next</a></li>';
 }
	?>
  </ul>
</nav>




  	<?php if((getPrivilageForUser($userinfo['user_id'],$_GET['category']))>2) : ?>

  	<form action="topic_manage.php?create=<?php echo $_GET['category']; ?>" method="post">
    <input type="submit" class="btn btn-primary btn-md" value="New Thread">
  	</form>
  	<?php else : ?>

  	<div class="row">
  		<br><br>
  		<p style="text-align: center;"><em>You must be logged in to create thread. If you don't have an account yet, you can go to <a href="register.php">register</a> to create one.</em></p>
  	</div>

  	<?php endif; ?>
    <h3>Forum Statistics</h3>
    <div class="row">
<div class="col-md-4 text-center">
<p class="lead"><?php echo $totalUsers; ?></p>Total Number of Users
</div>
<div class="col-md-4 text-center">
<p class="lead"><?php echo $totalTopics; ?></p>Total Number of Topics
</div>
<div class="col-md-4 text-center">
<p class="lead"><?php echo $totalCategories; ?></p>Total Number of Categories
</div>
</div>



<?php include('includes/footer.php'); ?>
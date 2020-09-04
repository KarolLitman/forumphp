<?php include('includes/header.php'); ?>


<div class="btn-group" role="group" aria-label="Basic example">
  <a href="mod_approve.php?show=topics&state=0"><button type="button" class="btn btn-secondary">Topics</button></a>
  <a href="mod_approve.php?show=replies&state=0"><button type="button" class="btn btn-secondary">Replies</button></a>
  <a href="mod_approve.php?show=topics&state=-1"><button type="button" class="btn btn-secondary">Declined Topics</button></a>
  <a href="mod_approve.php?show=replies&state=-1"><button type="button" class="btn btn-secondary">Declined Replies</button></a>
</div>

    <ul id="topics">
      <?php if($elements) : ?>

        <?php foreach($elements as $topic) : ?>
      <?php if(!property_exists($topic, 't_id')){
          $topic->t_id=$topic->r_id;
      } ?>
      <li class="topic">
        <div class="row">

          <div class="col-md-1 align-middle">
            <img class="avatar pull-left img-responsive" alt="avatar <?php echo $topic->username; ?>" src="images/avatars/<?php echo $topic->avatar; ?>" />
          </div> <!-- /col-md-2 -->

          <div class="col-md-5">
              <h3><a href="topic.php?id=<?php echo $topic->t_id; ?>"><?php echo $topic->title; ?></a></h3>
              </div>
              <div class="col-md-6 text-right">
               by <a style="color: <?php echo $topic->color ?>" href="topics.php?user=<?php echo urlFormat($topic->user_id); ?>"><?php echo $topic->username; ?></a> by 
               » <?php echo formatDate($topic->create_date); ?> <a href="mod_approve.php?show=<?php echo $_GET['show'];?>&accept=<?php echo $topic->t_id;?>"><img src="images/icons/approve.png"/></a> <a href="mod_approve.php?show=<?php echo $_GET['show'];?>&decline=<?php echo $topic->t_id;?>"><img src="images/icons/delete.png"/></a>
              </div>
              <br><br><br><br>
              <div class="well"><?php echo $topic->body;?></div></div>
           <!-- /col-md-10 -->


      </li>
      <?php endforeach ; ?>

    </ul> <!-- /ul#topic -->

    <?php else : ?>
      <p>No Elements To Display</p>
    <?php endif; ?>

</div>



<?php include('includes/footer.php'); ?>
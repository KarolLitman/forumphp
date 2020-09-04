<?php include('includes/header.php'); ?>


      <?php if($user) : ?>

      <div>
        <div class="row">

          <div class="col-md-2">
            <img class="avatar pull-left img-responsive" alt="avatar <?php echo $user->username; ?>" src="images/avatars/<?php echo $user->avatar; ?>" />
          </div> <!-- /col-md-2 -->

          <div class="col-md-10">
            <div class="topic-content pull-right">
            <ul>
<li>Name: <?php echo $user->name; ?></li>
<li>Joined: <?php echo $user->joined; ?></li>
<li>Last activity:<?php echo $user->last_activity; ?></li>
<li><a href="topics.php?user=<?php echo $user->u_id; ?>">Search user’s posts</a></li>
<li><a href="new_message.php?to=<?php echo $user->username; ?>">Send message</a></li>

</ul>
              </div>
            </div>
          </div> <!-- /col-md-10 -->

        </div> <!-- /row -->


    <?php else : ?>
      <p>The requested user does not exist.</p>
    <?php endif; ?>




<?php include('includes/footer.php'); ?>
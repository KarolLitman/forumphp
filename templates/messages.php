<?php include('includes/header.php'); ?>



<div class="btn-group" role="group" aria-label="Basic example">
<form action="messages.php?folder=received" method="get">
<input type="submit" class="btn btn-primary btn-md" value="Received">
  </form>
  
  <form action="messages.php?folder=sent" method="get">
  <input type="submit" class="btn btn-primary btn-md" value="Sent">
  </form>
</div>

  	<form action="new_message.php" method="post">
    <input type="submit" class="btn btn-primary btn-md" value="New PM">
  	</form>

        <?php foreach($messages as $message) : ?>
      

      <div class="topic">
        <div class="row">

          <div class="col-md-1"></div>
          <div class="col-md-5">
            <div class="topic-content pull-right">
            <?php
            
            if(received){
              if($message->was_read){
                $unread='';
              }
              else{
                $unread='<span class="new-messages">NEW</span>';

              }
            }

            ?>
              <h3><a href="message.php?id=<?php echo $message->m_id; ?>"><?php echo $unread; echo ' '.$message->title; ?><br></a></h3>
            </div>
          </div> <!-- /col-md-10 -->
          <div class="col-md-1"><div class="pull-right text-center"><?php echo $info; ?> <a style="color: <?php echo $message->color ?>" href="http://forumphp.2ap.pl/user.php?id=<?php echo $message->u_id; ?>">
        <?php echo $message->username; ?></a><br>
</div>
</div>
            <div class="col-md-5">
            <div class="pull-right text-center">
            <?php echo formatDate($message->send_date); ?>
            </div>

        </div> <!-- /row -->
        </div>
      </div>
      <?php endforeach ; ?>

  	<form action="new_message.php" method="post">
    <input type="submit" class="btn btn-primary btn-md" value="New PM">
  	</form>

<?php include('includes/footer.php'); ?>
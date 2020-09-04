<?php include('includes/header.php'); ?>

              <p>
              Sent at: <?php echo $message->send_date; ?><br>
	            	From: <a style="color: <?php echo $message->s_color ?>" href="<?php echo $message->s_u_id; ?>"><?php echo $message->sender; ?></a><br>
	            	To: <a style="color: <?php echo $message->r_color ?>" href="<?php echo $message->r_u_id; ?>"><?php echo $message->receivier; ?></a>
                    </p>
	<ul id="topics">
    
	    <li id="main-topic" class="topic topic">
        
	      <div class="row">


	        <div class="col-md-10">
            
	          <div class="topic-content pull-right">
                <p>
	            	<?php echo $message->body; ?></p>
	          </div>
	        </div>
					
	      </div>


	    </li> <!-- / topic li -->
		


	    
	    
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

<?php if($message->r_u_id==getUser()['user_id']){
 	echo '<form action="new_message.php?to='.$message->sender.'" method="post">
     <input type="hidden" name="title" value="Re: '.$message->title.'"/>
     <input type="submit" class="btn btn-primary btn-md" value="Reply">
       </form>';
}

?>

 


<?php include('includes/footer.php'); ?>
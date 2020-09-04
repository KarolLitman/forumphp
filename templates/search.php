<?php include('includes/header.php'); ?>



<form method="post" action="search.php" autocomplete="off">
<input type="text" class="form-control" name="keyword" placeholder="Enter keywords">

<div class="radio">
  <input type="radio" name="optradio" value="topic" id="first" checked><label for="first">Search topics</label>
</div>
<div class="radio">
  <input type="radio" name="optradio" value="user" id="second">    <label for="second">Search user</label>

</div>
<input type="submit" name="send" value="Search" class="btn btn-default">

        

</form>



<?php include('includes/footer.php'); ?>
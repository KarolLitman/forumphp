<?php include('includes/header.php'); ?>



<form method="post" action="new_message.php">

<div class="form-group">
    <label for="username">User</label>
    <input type="text" class="form-control" name="receivier_name" placeholder="Enter username" value="<?php echo $to;?>">
</div>

<div class="form-group">
    <label for="title">Message Title</label>
    <input type="text" class="form-control" name="title" placeholder="Enter message title" value="<?php echo $title_message;?>">
</div>
              
<input type="hidden" name="id" value="<?php echo $_GET[array_keys($_GET)[0]]; ?>">
              
<div class="form-group">
    <label for="body">Message Body</label>
    <textarea name="body" id="body" cols="80" rows="10" class="form-control"><?php echo $topic->body;?></textarea>
    <script>CKEDITOR.replace("body");</script>
</div>
<button name="send_message" type="submit" class="btn btn-default">Submit</button>
              
</form>

<?php include('includes/footer.php'); ?>
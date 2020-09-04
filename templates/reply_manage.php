<?php include('includes/header.php'); ?>


<form method="post" action="reply_manage.php">

                  
<input type="hidden" name="id" value="<?php echo $_GET['edit']; ?>">
                  
    <div class="form-group">
        <label for="body">Reply Body</label>
        <textarea name="body" id="body" cols="80" rows="10" class="form-control"><?php echo $reply->body;?></textarea>
        <script>CKEDITOR.replace("body");</script>
    </div>
    <button name="do_update" type="submit" class="btn btn-default">Submit</button>
                  
</form>

<?php include('includes/footer.php'); ?>
<?php include('includes/header.php'); ?>


<form method="post" action="topic_manage.php">

    <div class="form-group">
        <label for="title">Topic Title</label>
        <input type="text" class="form-control" name="title" placeholder="Enter post title" value="<?php echo $topic->title;?>">
    </div>
                  
<input type="hidden" name="id" value="<?php echo $_GET[array_keys($_GET)[0]]; ?>">
                  
    <div class="form-group">
        <label for="body">Topic Body</label>
        <textarea name="body" id="body" cols="80" rows="10" class="form-control"><?php echo $topic->body;?></textarea>
        <script>CKEDITOR.replace("body");</script>
    </div>
    <button name="do_<?php echo array_keys($_GET)[0];?>" type="submit" class="btn btn-default">Submit</button>
                  
</form>

<?php include('includes/footer.php'); ?>
<?php include('includes/admin_header.php'); 

$gr=$group;

?>




        <form method="post" action="admin_category_privilages.php" autocomplete="off">
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">Privilage</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($categorywithgroups as $group) :?>
    <tr>
      <th scope="row"><?php echo $group->group_name; ?></th>
      <td><select class="form-control" name="<?php echo $group->g_id; ?>">
      <?php foreach($rights as $right) : ?>
<option value="<?php echo $right->sor_id ?>" 
<?php
if($right->sor_id==$group->active){
echo 'selected';
}
?>
>
<?php echo $right->description ?></option>
<?php endforeach; ?>

</select>
</td>
</tr>
  

		<?php endforeach; ?>


  </tbody>
</table>


<input type="hidden" name="c_id" value="<?php echo $_GET['id']; ?>">
    
<input type="submit" name="send_privilages" value="Send privilages" class="btn btn-default">
  
    
    </form>






<?php include('includes/admin_footer.php'); ?>

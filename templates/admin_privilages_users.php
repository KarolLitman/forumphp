<?php include('includes/admin_header.php'); 


?>
        <form method="post" action="admin_privilages_users.php" autocomplete="off">
<table class="table">
  <thead>
    <tr>
      <th scope="col">id</th>
      <th scope="col">name</th>
      <th scope="col">Privilage</th>

    </tr>
  </thead>
  <tbody>

		<?php foreach($categories as $maincategory) : ?>


    <tr>
      <th scope="row"><?php echo $maincategory->c_id; ?></th>
      <td><a href="admin_category_privilages.php?id=<?php echo $maincategory->c_id; ?>"><?php echo $maincategory->name; ?></a></td>
      <td><select class="form-control" name="<?php echo $maincategory->c_id; ?>">
 <?php foreach($rights as $right) : ?>
 <option value="<?php echo $right->sor_id ?>" 
<?php

$flaga1=false;

if($right->sor_id==$maincategory->active){
echo 'selected';
$flaga1=true;
}
else{
    $flaga1=false;
    }

?>
>
<?php echo $right->description ?></option>
<?php endforeach; ?>

<?php if($flaga1){
    echo '<option value="0">Inherit from the group</option>';
}
else{
    echo '<option value="0" selected>Inherit from the group</option>';

}
?>

</select>
</td>
</tr>
      <?php foreach(listCategorieswithPrivilageByUser($_GET['id'],$maincategory->c_id) as $category) : ?>
      <tr>
      <th scope="row"><?php echo $category->c_id; ?></th>
      <td><p class="childcategory"><a href="admin_category_privilages.php?id=<?php echo $category->c_id; ?>"><?php echo $category->name; ?></a></p></td>
      <td><select class="form-control" name="<?php echo $category->c_id; ?>">
      <option value="0">Inherit from the group</option>

      <?php foreach($rights as $right) : ?>
<option value="<?php echo $right->sor_id ?>" 
<?php

$flaga2=false;


if($right->sor_id==$category->active){
echo 'selected';
$flaga2=true;
}
else{
    $flaga2=false;
    }
?>
>
<?php echo $right->description ?></option>
<?php endforeach; ?>
<?php if($flaga2){
    echo '<option value="0">Inherit from the group</option>';
}
else{
    echo '<option value="0" selected>Inherit from the group</option>';

}
?>
</select>
</td>
</tr>

    <?php foreach(listCategorieswithPrivilageByUser($_GET['id'],$category->c_id) as $subcategory) : ?>
      <tr>
      <th scope="row"><?php echo $subcategory->c_id; ?></th>
      <td><p class="childchildcategory"><a href="admin_category_privilages.php?id=<?php echo $subcategory->c_id; ?>"><?php echo $subcategory->name; ?></a></p></td>
      <td><select class="form-control" name="<?php echo $subcategory->c_id; ?>">
      <option value="0">Inherit from the group</option>

      <?php foreach($rights as $right) : ?>
<option value="<?php echo $right->sor_id ?>" 
<?php

$flaga3=false;

if($right->sor_id==$subcategory->active){
echo 'selected';
$flaga3=true;
}
else{
    $flaga3=false;
    }
?>
>
<?php echo $right->description ?></option>
<?php endforeach; ?>
<?php if($flaga3){
    echo '<option value="0">Inherit from the group</option>';
}
else{
    echo '<option value="0" selected>Inherit from the group</option>';

}
?>
</select>
</td>
</tr>
    <?php endforeach; ?>

    <?php endforeach; ?>
		<?php endforeach; ?>


  </tbody>
</table>


<input type="hidden" name="u_id" value="<?php echo $_GET['id']; ?>">
    
<input type="submit" name="send_privilages" value="Send privilages" class="btn btn-default">
  
    
    </form>






<?php include('includes/admin_footer.php'); ?>

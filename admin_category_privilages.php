<?php require('core/init.php'); ?>

<?php 

// Create Topic Object


//Create User Object
$category = new Category;
$group = new Group;
$right = new Right;

$privilage = new Privilage;


if(isset($_POST['send_privilages'])){
    foreach($_POST as $key => $value) {
        if(is_numeric($key)){
            

                foreach(CategoryGroupsPrivilage($_GET['id']) as $group) :

                    if($key==$group->g_id){
                        if($value!=$group->main_privilage){
                            $privilage->addPrivilage($key,$_POST['c_id'],$value);

                    }}
                endforeach;



            
        
      }
}

redirect('admin_privilages.php', 'Privilages has been changed.', 'success');


}

//Get Template $ Assign Vars

$template = new Template('templates/admin_category_privilages.php');

$template->category=$category->get($_GET['id']);

$template->categorywithgroups = CategoryGroupsPrivilage($_GET['id']);
$template->title = 'Privilages category '.$template->category->name;

$template->rights=$right->getAllRights();



echo $template;
?>
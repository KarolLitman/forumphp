<?php include('includes/header.php'); ?>

<? $userinfo = getUser(); ?>

<script>
var lastTimeID = 0;

$(document).ready(function() {

getChatText();

  $('#btnSend').click( function() {
    sendChatText();
    $('#chatInput').val("");
  });

  $('#btnDel').click( function() {
    deleteChatText();
  });

  startChat();
});

function startChat(){
  setInterval( function() { getChatText(); }, 20000);
}

function deleteChatText(id){
  $.ajax({
        method: 'DELETE',
        statusCode: {
        200: function (result) {


// var avatar='images/avatars/'+result.avatar;


getChatText();



},
        400: function () {
            }
             
            },
        url: "/shoutbox.php?user_id=<? echo $userinfo['user_id']; ?>&token=<? echo $userinfo['token']; ?>&id="+id,
      })}

function getChatText() {
  $.ajax({
    type: "GET",
    url: "/shoutbox.php"
  }).done( function( data )
  {
    var jsonData = JSON.parse(data);
    var jsonLength = jsonData.length;


    var html = "";
    for (var i = 0; i < jsonLength; i++) {
      var result = jsonData[i];
    html += '<li class="list-group-item custmsg"><div class="profile-avatar tiny pull-left" style="background-image: url(images/avatars/'+result.avatar+')"></div><h5 class="list-group-item-heading"><a style="color:'+result.color+'" href="user.php?id='+result.u_id+'">'+result.username+'</a></h5><p class="message-content"><time>'+result.send_date+' <?php if(hasmod()){?><img onclick="deleteChatText('+result.s_id+')" src="images/icons/delete.png"/><?php } ?></time>'+result.body+' </p></li>'
      
      
    //   <div style="color:#' + result.color + '">(' + result.chattime + ') <b>' + result.usrname +'</b>: ' + result.chattext + '</div>';
    }
    $('#view_ajax').html(html);
    html = '';
  });
}

function sendChatText(){
  var chatInput = $('#chatInput').val();
  if(chatInput != ""){
    $.ajax({
        method: 'POST',
        data: ('user_id=<? echo $userinfo['user_id']; ?>&token=<? echo $userinfo['token']; ?>&message='+encodeURIComponent(chatInput)),
        statusCode: {
        201: function (result) {


// var avatar='images/avatars/'+result.avatar;

result=JSON.parse(result);

getChatText();


// $("#view_ajax").append('<li class="list-group-item custmsg"><div class="profile-avatar tiny pull-left" style="background-image: url(images/avatars/'+result.avatar+')"></div><h5 class="list-group-item-heading"><a href="user.php?id='+result.u_id+'">'+result.username+'</a></h5><p class="message-content"><time>'+result.send_date+'</time>'+result.body+' </p></li>');


},
        400: function () {

            
            }
             
            },
        url: "/shoutbox.php",
      })
  }
}
</script>

    <div class="panel panel-chat shoutbox"><ul id="view_ajax" class="list_group"></ul></div>
    <div id="ajaxForm">
    <div class="row rowshoutbox">
    <?php if(isLoggedIn()){
      ?>
  <div class="col-md-10"><input type="text" class="form-control" id="chatInput" /></div>
  <div class="col-md-2"><input type="button" class="btn btn-primary" value="Send" id="btnSend" /></div>
<?php
}
?>
  </div>
    </div>

    <ul id="categories">
      <?php if($topics) : ?>

<?php foreach(getMainCategories() as $maincategory) : 
if((getPrivilageForUser($userinfo['user_id'],$maincategory->c_id))>1){

?>
<li><h2><?php echo $maincategory->name;?></h2><ul>


        <?php foreach(getCategoriesWithLatestPost($maincategory->c_id) as $category) :
            
            if((getPrivilageForUser($userinfo['user_id'],$category->c_id))>1){

            
            ?>
      
      <li class="topic">
        <div class="row">

          <div class="col-md-1">
            <!-- <img class="avatar pull-left img-responsive" src="images/avatars/<?php echo $topic->avatar; ?>" /> -->
          </div> <!-- /col-md-2 -->

          <div class="col-md-5">
            <div class="topic-content pull-right">
              <h3><a href="topics.php?category=<?php echo $category->c_id; ?>"><?php echo $category->name; ?></a></h3>
              <div class="topic-info">
              <?php echo $category->description; ?>
              <ul class="list-inline">
              <?php foreach(getCategoriesWithLatestPost($category->c_id) as $subcategory) : 
              if((getPrivilageForUser($userinfo['user_id'],$subcategory->c_id))>1){
              ?>

                          <li class="list-inline-item"><h5><a href="topics.php?category=<?php echo $subcategory->c_id; ?>"><?php echo $subcategory->name; ?></a></h5></li>
              <?php } endforeach ; ?>

                          
</ul>
            </div>
            </div>
          </div>
          <div class="col-md-1">
            <div class="pull-right text-center">
              <?php echo topicsCountPerCategory($category->c_id); ?><br>topics
            </div>
          </div>
          <div class="col-md-1">
            <div class="pull-right text-center">
            <?php echo repliesCountPerCategory($category->c_id); ?><br>replies
            </div>
          </div>
          <div class="col-md-3">
            <div class="pull-right">
            <span class="pull-right"><a href="topic.php?id=<?php echo $category->t_id; ?>"><?php echo $category->title; ?></a> <?php if(!empty($category->title)) echo 'by'; ?> <a <?php if(!empty($category->color))echo 'style="color: '.$category->color.'"';?> href="user.php?id=<?php echo $category->u_id; ?>"><?php echo $category->username; ?></a><br><?php echo $category->last_activity; ?></span>
            </div>
          </div> 

        </div> <!-- /row -->
      </li>
      <?php
      }
      endforeach ; ?>
      </ul>
    <?php } endforeach ; ?>

    </ul> <!-- /ul#topic -->

<?php else : ?>
  <p>No Topics To Display</p>
<?php endif; ?>


<h3>Who is online</h3>

<div class="row">
<div class="col-sm-12">

<?php foreach(listOnline15min() as $user) :
$full15min.='<a style="color: '.$user->color.'" href="user.php?id='.$user->u_id.'">'.$user->username.'</a>, ';

endforeach ;
$full15min=substr($full15min, 0, -2);       
echo $full15min;       
?>

</div>
</div>


<h3>Who was online for 24 hours</h3>

<div class="row">
<div class="col-sm-12">

<?php foreach(listOnline24h() as $user) : 
$full24h.='<a style="color: '.$user->color.'" href="user.php?id='.$user->u_id.'">'.$user->username.'</a>, ';

       endforeach ;
$full24h=substr($full24h, 0, -2);       
echo $full24h;       
?>


</div>
</div>

    <h3>Forum Statistics</h3>

<div class="row">
<div class="col-sm-4 text-center">
<p class="lead"><?php echo $totalUsers; ?></p>Total Number of Users
</div>
<div class="col-sm-4 text-center">
<p class="lead"><?php echo $totalTopics; ?></p>Total Number of Topics
</div>
<div class="col-sm-4 text-center">
<p class="lead"><?php echo $totalCategories; ?></p>Total Number of Categories
</div>
</div>



<?php include('includes/footer.php'); ?>
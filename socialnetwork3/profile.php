<?php include'templates/nav.php'; ?>
<?php
$username = $_GET['user'];

$get_user = mysql_query("SELECT * FROM users WHERE username='$username'");
$row = mysql_fetch_assoc($get_user);

if($row != "") {
 $profile_user = $row['username'];
 $firstname = $row['firstname'];
 $lastname = $row['lastname'];
 $bio = $row['bio'];
} else {
  header("location: index.php");
}
?>
<html>
<head>
    
<link rel='stylesheet' type='text/css' href='css/main.css' />
<link rel='stylesheet' type='text/css' href='css/profile/main.css' />
<script src="http://code.jquery.com/jquery-1.10.1.min.js"></script>
<script src="http://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script>
 $(document).ready(function() {   
    function get_posts() {
     $.get('get/post2.php?user=<?php echo $username; ?>',function(data) {
         $(".feed").fadeIn(1100).html(data);
     });
    }
     
    $(".feed").fadeIn(1100).html(get_posts());
     

    
 });
</script>
<script>
$(document).ready(function() {
    $('#follow').click(function() {
    var username = "<?php echo $username; ?>";
    var follower = "<?php echo $user; ?>";
    
    $.post('parse/follow.php',{username: username, follower: follower},function(data) {
       $("#follow").html(data); 
    });
});
  $('#unfollow').click(function() {
    var username = "<?php echo $username; ?>";
    var follower = "<?php echo $user; ?>";
      
    $.post('parse/unfollow.php',{username: username, follower: follower},function() {
        $('#unfollow').html("Follow");
    });
  });
});    
</script>
</head>
<body>  
<div class='profile'>
    <div class='options'>
    <?php
    $user = $_SESSION['username'];
     ?>
        <script type="text/javascript">
            $(document).ready(function(){
                function get_follow_status(){
                    $.get('get/follow_status.php?username=<?php echo $username; ?>&follower=<?php echo $user; ?>',function(data){
                        $("#follow").html(data);
                }
                $("#follow").html(get_follow_status());
            });
        </script>

        <?php
        $query = "SELECT * FROM follows WHERE followe='$username' AND follower=$user";
        $sql = mysql_query($query);
        if ($sql) {
            while ($row = mysql_fetch_assoc($query)) {
                if($row =="") {
                  echo "<button id='follow' class='button'>Follow</button>";
                } else if($row != "") {
                  echo "<button id='unfollow' class='button'>Unfollow</button>";
             }
        }
    }
        ?>
        <button id="follow" class="button">Follow</button>
    </div>
    <div class='feed'>

    </div>
    <?php
      $db_pic = mysql_query("SELECT * FROM users WHERE username='$username'");
      $check_db_pic = mysql_fetch_assoc($db_pic);
      $db_pic2 = $check_db_pic['profile_picture'];
     ?>
<img src='profile_pictures/<?php echo $db_pic2; ?>' height='250' width='200' />
<div class='head'>
     About <?php echo $profile_user; ?>
</div>
<div class='info'>
    <p><?php echo $firstname;?>  <?php echo $lastname; ?></p>
    <p><?php echo $bio; ?></p>
    <p>Status: online</p>
</div>
<div class='head'>
     <?php echo $profile_user; ?> Friends(400)
</div>

    <div class='info'>
        <img src='friends profile picture' height='40' width='40'/>&nbsp; 
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp; 
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp; 
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
</div>
<div class='head'>
    <?php echo $profile_user; ?>Photos(1000)
</div>
<div class='info'>
        <img src='friends profile picture' height='40' width='40'/>&nbsp; 
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp; 
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp; 
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
        <img src='friends profile picture' height='40' width='40'/>&nbsp;
</div>
</div>
</body>
</html>
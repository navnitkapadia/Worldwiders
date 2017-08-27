<?php
$user_id = $_SESSION['userid'];
require 'api/db_config.php';
$sql = "SELECT * FROM users where user_id = $user_id";
$result = $mysqli->query($sql);
while ($row = $result->fetch_assoc()) {
    extract($row);
    ?>
    <div class="col-md-3 static">
        <div class="profile-card">
            <img src=<?php echo "http://graph.facebook.com/$user_id/picture"; ?> alt="user" class="profile-photo" />
            <h5><a href="edit-profile.php" class="text-white"><?php echo $first_name . $last_name; ?></a></h5>
            <a href="" class="text-white"><i class="ion ion-android-person-add"></i>1,299 friends</a>
        </div><!--profile card ends-->
    <?php } ?>    
    <ul class="nav-news-feed">
        <li><i class="icon ion-ios-paper"></i><div><a href="home.php">My Newsfeed</a></div></li>
        <li><i class="icon ion-ios-people"></i><div><a href="user-group.php">Groups</a></div></li>
        <li><i class="icon ion-android-bar"></i><div><a href="user-event.php">Events</a></div></li>
        <li><i class="icon ion-ios-people-outline"></i><div><a href="friends.php">Friends</a></div></li>
        <li><i class="icon ion-chatboxes"></i><div><a href="messages.php">Messages</a></div></li>

    </ul><!--news-feed links ends-->

</div>
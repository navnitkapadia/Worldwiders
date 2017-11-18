<?php 
session_start();
require 'db_config.php';
 
  $user = $_SESSION['userid'];
  $sql = "SELECT U.user_id,C.c_id as conversation_id,R.reply,C.time,U.fb_id,U.first_name,U.last_name
          FROM users U,conversation C, conversation_reply R
          WHERE 
          CASE
          WHEN C.user_one = '$user'
          THEN C.user_two = U.user_id
          WHEN C.user_two = '$user'
          THEN C.user_one= U.user_id
          END
          AND 
          C.time=R.time
          AND
          (C.user_one ='$user' OR C.user_two ='$user') ORDER BY C.time DESC";
  $result = $mysqli->query($sql);
  $count = 0;
  $message = "";
  $active = "";
  if(mysqli_num_rows($result) == 0 ){
   echo '<li>No Conversation</li>';
  }else{
    while($row = $result->fetch_assoc())
    {
      
      extract($row);
          $count++;
         if($count == 1){
			 $active = 'active'; 
		} else {
			$active = "";
		}
				if($reply === 'No messages clean11'){
					$message = 'No new Message';
				} else {
					$message = $reply;
				}
                           $time = time_elapsed_string("@$time");
                 
                 echo "   <li class='$active'>
                      <a id='open-conversation' href='#$first_name' con-id='$conversation_id;' data-toggle='tab'>
                        <div class='contact'>
                        	<img src='http://graph.facebook.com/$fb_id/picture?type=small' alt='' class='profile-photo-sm pull-left'/>
                        	<div class='msg-preview'>
                        		<h6>$first_name $last_name </h6>
                            <p class='text-muted'> $message </p>
                            <small class='text-muted'>$time</small>
                        	</div>
                        </div>
                      </a>
                    </li>";
     }
      }
?>
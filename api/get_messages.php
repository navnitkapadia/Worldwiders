<?php
session_start();
    require 'db_config.php';
    if(isset($_GET['c_id'])){
        $conversation_id = $_GET['c_id'];
        $sql = "SELECT R.cr_id,R.time,R.reply,U.first_name,U.user_id,U.fb_id FROM users U, conversation_reply R 
            WHERE R.user_id_fk=U.user_id AND R.c_id_fk='$conversation_id' ORDER BY R.cr_id LIMIT 50";
        $result = $mysqli->query($sql);
        if(mysqli_num_rows($result) > 0 ){
            while($row = $result->fetch_assoc()){
                extract($row);
                $imgurl = "http://graph.facebook.com/$fb_id/picture?type=large";
                $early = time_elapsed_string("@$time");
                if($reply != "No messages clean11"){ 
                    if($_SESSION['userid'] == $user_id){
                        echo "<li class='left'>
                        <script>resize();</script>
                        <img src=$imgurl  class='profile-photo-sm pull-left' />
                        <div class='chat-item'>
                            <div class='chat-item-header'>
                                <h5>$first_name</h5>
                                <small class='text-muted'>$early</small> 
                            </div>
                            <p>$reply</p>
                        </div>
                    </li>";
                    }else{
                        echo "<li class='right'>
                        <script>resize();</script>
                        <img src=$imgurl  class='profile-photo-sm pull-right' />
                        <div class='chat-item'>
                            <div class='chat-item-header'>
                                <h5>$first_name</h5>
                                <small class='text-muted'>$early</small>
                            </div>
                            <p>$reply</p>
                        </div>
                    </li>"; 
                    }
                }
            }
        }else{
            echo "No Messages";
        }
    }
?>
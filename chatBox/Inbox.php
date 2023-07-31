<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Chat Box</title>
  <link rel="stylesheet" href="../Warning/Modal.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="../NavbarLayout/navbarLayout.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="../Footer/Footer.css?v=<?php echo time() ?>">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  <link rel="stylesheet" href="./inbox.css?v=<?php echo time() ?>">
</head>


<body>
  <?php require_once("../NavbarLayout/Navbar.php");
  include("../connMySQL.php");
  $ReceverID = $_REQUEST["userID"]; //id receiver
  $my_userID = $_SESSION["id_user"]; //id sender (me)
  ?>
  <div class="container-chatbox">
    <div class="friends-list">
      <h2>Chat</h2>
      <ul>
        <?php



        $sql_list_fr = $pdo->prepare("SELECT u.id_user ,u.username,u.avt_user
                                      FROM users_acc u
                                      INNER JOIN messages m ON u.id_user = m.sender_id OR u.id_user = m.receiver_id
                                      WHERE u.id_user != '$my_userID' AND (m.sender_id = '$my_userID' OR m.receiver_id = '$my_userID')
                                      GROUP BY u.username 
                                      ");
        $sql_list_fr->execute();
        $list_fr = $sql_list_fr->fetchAll(PDO::FETCH_ASSOC);

        for ($i = count($list_fr) - 1; $i >= 0; $i--) {
        ?>
          <li>
            <a href="./Inbox.php?userID=<?php echo $list_fr[$i]["id_user"] ?>">
              <div class="friend-avatar">
                <img src="<?php echo $list_fr[$i]["avt_user"] != "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" ?   "../Upload/file_media.php?name=" . $list_fr[$i]["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" ?>" alt="Friend Avatar">
              </div>
              <div class="friend-info">
                <h3><?php echo $list_fr[$i]["username"] ?></h3>
                <p>Online</p>
              </div>
            </a>
          </li>
        <?php } ?>
      </ul>
    </div>
    <div class="chatbox">

      <?php

      $sql_pos_info = $pdo->prepare("SELECT id_user,username ,avt_user
        FROM users_acc 
        where id_user = $ReceverID;
        ");
      $sql_pos_info->execute();
      $pos_info = $sql_pos_info->fetch(PDO::FETCH_ASSOC);

      $sql_chat_data = $pdo->prepare("Select my.id_user as my_id, my.username as my_username,my.avt_user as my_avatar, message, pos.id_user as pos_id, pos.username as pos_username, pos.avt_user as pos_avatar
                                From messages m
                                inner join users_acc as my on my.id_user = m.sender_id 
                                inner join users_acc as pos on pos.id_user = m.receiver_id
                                where (m.sender_id = $my_userID and m.receiver_id=$ReceverID) 
                                or (m.sender_id=$ReceverID and m.receiver_id=$my_userID) 
                                and (m.receiver_id != m.sender_id)");
      $sql_chat_data->execute();
      $chat_data = $sql_chat_data->fetchAll(PDO::FETCH_ASSOC);
      ?>

      <div class="chat-header">
        <div class="profile">
          <div class="profile-avatar">
            <img src="<?php echo $pos_info["avt_user"] != "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" ?   "../Upload/file_media.php?name=" . $pos_info["avt_user"] : "https://antimatter.vn/wp-content/uploads/2022/11/anh-avatar-trang-fb-mac-dinh.jpg" ?>">
          </div>
          <div class="profile-info">
            <h2><?php echo $pos_info["username"] ?></h2>
            <p>Online</p>
          </div>
        </div>
      </div>

      <div class="chat-messages">
        <?php
        for ($i = 0; $i < count($chat_data); $i++) {
          $is_from_me = ($chat_data[$i]["my_id"] == $my_userID);

          echo '<div class="message ' . ($is_from_me ? "message-sender" : "") . '">
                  <p>' . $chat_data[$i]["message"] . '</p>
                </div>';
        } ?>
      </div>


      <form method="post" action="./sending.php?userID=<?php echo $ReceverID ?>" class="input-box">
        <input class="input_mess" type="text" name="textmessage" placeholder="Type a message...">
        <input type="submit" value="Gửi">
      </form>
    </div>
  </div>


  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script>

function getNewMessages() {
  var xhr = new XMLHttpRequest();
  var url = "./getNewMessages.php?userID=<?php echo $ReceverID ?>"
  xhr.open("GET", url, true);
  xhr.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      var chatMessages = document.querySelector('.chat-messages');
      var newMessages = JSON.parse(this.responseText);
      newMessages.reverse();

      // Clear the chat box before appending new messages
      chatMessages.innerHTML = '';

      for (var i = 0; i < newMessages.length; i++) {
        var message = newMessages[i];
        var isFromMe = (message.my_id == <?php echo $my_userID ?>);
        var messageElement = document.createElement('div');
        messageElement.classList.add('message');
        if (isFromMe) {
          messageElement.classList.add('message-sender');
        }
        var messageText = document.createElement('p');
        messageText.innerText = message.message;
        messageElement.appendChild(messageText);
        chatMessages.appendChild(messageElement);
        chatMessages.scrollTop = chatMessages.scrollHeight;
      }
    }
  };
  xhr.send();
}

setInterval(getNewMessages, 1000);


    window.onload = () => {
      document.querySelector(".input_mess").focus(),
      document.querySelector(".chat-messages").scrollTop = document.querySelector(".chat-messages").scrollHeight;
    }
  </script>
</body>


</html>
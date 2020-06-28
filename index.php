<?php
session_start();
require('dbconnect.php');

if (isset($_SESSION['id']) && $_SESSION['time'] + 3600 > time()) {
  // ログインしている
  $_SESSION['time'] = time();

  $members = $db->prepare('SELECT * FROM members WHERE id=?');
  $members->execute(array($_SESSION['id']));
  $member = $members->fetch();
} else {
  // ログインしていない
  header('Location: login.php');
  exit();
}

// 投稿を記録する
if (!empty($_POST)) {
  if ($_POST['message'] != '') {
    $message = $db->prepare('INSERT INTO posts SET member_id=?, message=?, created=NOW()');
    $message->execute(array(
      $member['id'],
      $_POST['message']
    ));

    header('Location: index.php');
    exit();
  }
}
?>
<!DOCTYPE html>
<html lang="ja">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
    <dl>
      <dt><?php echo htmlspecialchars($member['name'], ENT_QUOTES); ?>さん、メッセージをどうぞ</dt>
      <dd><textarea name="message" cols="50" rows="5"></textarea></dd>
    </dl>
    <div>
      <input type="submit" value="投稿する">
    </div>
  </form>

  <div>
    <img src="member_picture/me.jpg" width="48" height="48" alt="makoto">
    <p>こんにちは<span> (makoto) </span></p>
    <p>2018/03/11 2:11</p>
  </div>
</body>
</html>
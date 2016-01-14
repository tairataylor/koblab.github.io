<?php
  session_start();

  $_SESSION = array();
  session_destroy();
?>
<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title>Logout success</title>
  </head>
  <body>
    <div class="article">
      <h2>ログアウトしました</h2>
      <p><a href="index.php">ブログのページに戻る</a></p>
    </div>
  </body>
</html>

<?php
session_start();

if (isset($_GET["username"]) && isset($_GET["passwd"]) && $_GET["username"]!="" && $_GET["passwd"]!="") {
  $username = $_GET["username"];
  $passwd = $_GET["passwd"];

  $pdo = new PDO("sqlite:kobalab.sqlite");
  $pdo -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
  $st = $pdo -> prepare("select * from user where name = ?");
  $st -> execute(array($username));
  $user_on_db = $st -> fetch();

  if(!$user_on_db){
    $result = "指定されたユーザーが存在しません";
  }else if($passwd == $user_on_db[2]){
    $_SESSION["id"] = $user_on_db[0];
    $_SESSION["user"] = $username;
    $_SESSION["img"] = $user_on_db[3];
    header("Location:index.php");
    exit;
  }else{
    $result = "パスワードが違います。";
  }
}

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <title>Login success</title>
</head>
<body>
  <div class="article">
    <h2><?php print $result; ?></h2>
    <p><a href="index.php">ブログのページに戻る</a></p>
  </div>
</body>
</html>

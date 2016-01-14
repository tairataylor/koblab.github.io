<html>
<head>
<title>冷蔵庫</title> <meta charset="UTF-8">
</head>
<body>

<h1>冷蔵庫の中身</h1>

<table border=0 cellpadding=0 cellspacing=0>
<tr bgcolor=#f87820>
<td width=60><br>No</td>
<td width=150><br><b>食品名</b></td>
<td width=100><br><b>名前</b></td>
<td width=200><br><b>購入日</b></td>
<td width=200><br><b>コメント</b></td>

<?php
function h($str){ return htmlspecialchars($str, ENT_QUOTES, "UTF-8");}

if(isset($_GET['No'])) $No=$_GET['No']; 
if(isset($_GET['FName'])) $FName=$_GET['FName']; 
if(isset($_GET['name']))  $name=$_GET['name']; 
if(isset($_GET['day'])) $day=$_GET['day'];
if(isset($_GET['comment'])) $comment=$_GET['comment'];


$db = new PDO("sqlite:fridge.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

if(isset($FName))  {
    $db->query("INSERT INTO fridge VALUES(Null,'$FName','$name','$day','$comment')");
}
if(isset($No))  {
    $db->query("DELETE FROM fridge WHERE No='$No'");
}

$result=$db->query("SELECT * FROM fridge");
  for($i = 0; $row=$result->fetch(); ++$i ){
    echo "<tr valign=center>";
    echo "<td >". h($row['No']). "</td>";
    echo "<td >". h($row['FName']). "</td>";
    echo "<td >". h($row['name']). "</td>";
    echo "<td >". h($row['day']). "</td>";
    echo "<td >". h($row['comment']). "</td>";
    echo "</tr>";
  }
?>
<tr> <td bgcolor=#fb7922 colspan=7>&nbsp</td> </tr>
<tr> <td bgcolor=#fb7922 colspan=6>&nbsp</td> </tr>
</table>


<h2>食品追加</h2>
<form action=fridge.php method=get>
<table border=0 cellpadding=0 cellspacing=0>

 <tr><td>食品名:</td><td><input type=text size=50 name=FName></td></tr>
 <tr><td>名前:</td><td> <input type=text size=50 name=name></td></tr>
 <tr><td>購入日:</td><td> <input type=integer size=20 name=day></td></tr>
　<tr><td>コメント:</td><td><input type=text size=20 name=comment></td></tr>

 <tr><td> </td><td><input type=submit border=0 value="追加"></td></tr>
</table>
</form>

<h2>食品データ削除</h2>
<form action=fridge.php method=get>
<table border=0 cellpadding=0 cellspacing=0>
 <tr><td>No:</td><td><input type=text size=20 name=No></td></tr>
 <tr><td> </td><td><input type=submit border=0 value="削除"></td></tr>
</table>
</form>

<a href= 'index.php'>メインメニューに戻る</a>

</body>
</html>
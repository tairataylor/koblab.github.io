<html>
<head>
<title>Book</title> <meta charset="UTF-8">
</head>
<body>

<h1>研究室にある本</h1>

<table border=0 cellpadding=0 cellspacing=0>
<tr bgcolor=#f87820>
<td width=60><br>No</td>
<td width=150><br><b>本</b></td>
<td width=150><br><b>名前</b></td>
<td width=100><br><b>借りた日</b></td>
<td width=200><br><b>返す予定日</b></td>

<?php
function h($str){ return htmlspecialchars($str, ENT_QUOTES, "UTF-8");}

if(isset($_GET['No'])) $No=$_GET['No']; 
if(isset($_GET['BName'])) $BName=$_GET['BName'];
if(isset($_GET['name'])) $name=$_GET['name']; 
if(isset($_GET['WB'])) $WB=$_GET['WB']; 
if(isset($_GET['WR'])) $WR=$_GET['WR']; 

$db = new PDO("sqlite:book.sqlite");
$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
if(isset($No))	{
		$db->query("UPDATE book SET BName = '$BName' , name = '$name' , WB = '$WB' , WR = '$WR' WHERE No='$No'");
}

$result=$db->query("SELECT * FROM book");
	for($i = 0; $row=$result->fetch(); ++$i ){
		echo "<tr valign=center>";
		echo "<td >". $row['No']. "</td>";
    echo "<td >". $row['BName']. "</td>";
		echo "<td >". $row['name']. "</td>";
		echo "<td >". $row['WB']. "</td>";
		echo "<td >". $row['WR']. "</td>";
		echo "</tr>";
	}
?>
<tr> <td bgcolor=#fb7922 colspan=6>&nbsp</td> </tr>
</table>

<h2>貸し出し本選択</h2>
<form action=book.php method=get>
<table border=0 cellpadding=0 cellspacing=0>
 <tr><td>No:
       </td><td>
 	<select name="No">
   	 <option value="1">1</option>
   	 <option value="2">2</option>
   	 <option value="3">3</option>
   	 <option value="4">4</option>
   	 <option value="5">5</option>
   	 <option value="6">6</option>
     <option value="7">7</option>
     <option value="8">8</option>
     <option value="9">9</option>
     <option value="10">10</option>
    </select>
       </td></tr>
 <tr><td>名前:
       </td><td> 
       <input type=text size=20 name=name></td></tr>

 <tr><td>借りた日:
       </td><td> 
       <input type=text size=20 name=WB></td></tr>

 <tr><td>返す予定日:
       </td><td> 
       <input type=text size=20 name=WR></td></tr>


 <tr><td> </td><td><input type=submit border=0 value="登録"></td></tr>
</table>
</form>

</body>
</html>
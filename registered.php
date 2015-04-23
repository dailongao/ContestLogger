<?php
session_start();
if(!isset($_SESSION["login"]))
	die("please log in");

$db = new SQLite3('zjp2015.db') or die("数据库炸了，找人来修");
$res= $db->query(sprintf('select * from teams where pid is not null')); 
?>
<html>

<body>
<table border=2>
<thead>
<tr><th>关联号</th><th>学校</th><th>队名</th><th>队员一</th><th>队员二</th><th>队员三</th><th>信封号</th> </tr>
</thead>
<tbody>
<?php
while($r = $res->fetchArray()) {
	echo "<tr><td>". $r[0] ."</td><td>". $r[1] ."</td><td>". $r[2] ."</td><td>".$r[3] ."</td><td>". $r[4] ."</td><td>". $r[5] ."</td><td>".$r[6]."</td></tr>";
}
?>
</tbody>
</table>
<body>
</html>

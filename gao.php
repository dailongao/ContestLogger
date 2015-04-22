<?php
session_start();

function wrong_msg($msg){
	echo "<script>";  
    echo "location.href=\"index.php?msg=" . $msg ."\"";  
    echo "</script>"; 
    //echo $msg; 
}

if(!isset($_SESSION['login'])){
	wrong_msg("未登录");
}
if(!isset($_POST['teamcode']) || !isset($_POST['teampos'])){
	wrong_msg("参数不全");
}

$teamcode = (int)$_POST['teamcode'];
$teampos = (int)$_POST['teampos'];

$db = new SQLite3('zjp2015.db') or wrong_msg("数据库炸了，找人来修");

// Check existence
if($result=$db->query(sprintf('select * from teams where id=%d',$teamcode))->fetchArray()){
	wrong_msg("队伍编号不合法！");
}

if($result=$db->query(sprintf('select * from position where id=%d',$teamcode))->fetchArray()){
	wrong_msg("已经登记过！");
}

// 位置重复检查
if($result=$db->query(sprintf('select * from position where pos=%d',$teampos))->fetchArray()){
	wrong_msg("机位已经被占，请重抽或释放该位置！");
}

// Check position
// 这部分应当是一个检查是否相邻的表格

// insert into db
if(!$result=$db->exec(sprintf('insert into position values(%d, %d)',$teamcode, $teampos))){
	wrong_msg($db->lastErrorMsg());  
} else {
	wrong_msg("成功");
}
?>

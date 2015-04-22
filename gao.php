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
if($result=$db->query(sprintf('select * from position where id=%d',$teamcode))->fetchArray()){
	wrong_msg("已经登记过！");
}

// Check position

// insert into db

if(!$result=$db->exec(sprintf('Insert into position values(%d, %d)',$teamcode, $teampos))){
	wrong_msg($db->lastErrorMsg());  
} else {
	wrong_msg("成功");
}
?>
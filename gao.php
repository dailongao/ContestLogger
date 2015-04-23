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
if($teampos <=0 || $teampos >320 ) {
	wrong_msg("编号错误");
}

$db = new SQLite3('zjp2015.db') or wrong_msg("数据库炸了，找人来修");

// Check existence
if(! $result=$db->query(sprintf('select * from teams where id=%d',$teamcode))->fetchArray()){
	wrong_msg("队伍编号不合法！");
}
if( $result["pid"]){
	wrong_msg("该队伍已经持有信封" . $result['pid']. ", 请确认或收回该信封." );
}

if($result=$db->query(sprintf('select * from teams where pid=%d',$teampos))->fetchArray()){
	wrong_msg("信封". $teampos ."已经登记，请检查是否为该队");
}


// Check position
// 这部分应当是一个检查是否相邻的表格


// insert into db
if(!$result=$db->exec(sprintf('update teams set pid=%d where id=%d',$teampos, $teamcode))){
	wrong_msg($db->lastErrorMsg() . "<br> 关联失败请收回信封重抽。");  
} else {
	wrong_msg("成功");
}
?>

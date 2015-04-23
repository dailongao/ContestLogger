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
if(!isset($_POST['teampos'])){
	wrong_msg("参数不全");
}

$teampos = (int)$_POST['teampos'];

$db = new SQLite3('zjp2015.db') or wrong_msg("数据库炸了，找人来修");

if(! $result=$db->query(sprintf('select * from teams where pid=%d',$teampos))->fetchArray()){
	wrong_msg("该信封已无关联，请收回放好");
}


// update db
if(!$result=$db->exec(sprintf('update teams set pid=NULL where pid=%d',$teampos, $teamcode))){
	wrong_msg($db->lastErrorMsg()); 
} else {
	wrong_msg("成功,请将收回的信封放回信封堆中供选手抽取");
}
?>

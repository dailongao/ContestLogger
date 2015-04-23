<?php
function showteam($arr){
	$dict = array(
		'id' => '队伍编号',
		'name' => '队名',
		'school' => '学校',
		'member1' => '成员1',
		'member2' => '成员2',
		'member3' => '成员3',
		'pid' => '座位号',
	);
	echo '<table id="teaminfo" class="table table-bordered">';
	foreach ($arr as $key => $val )
	if(is_string($key)){
		echo "<tr><th>". $dict[$key] ."</th><td>" . $val. "</td></tr>";
	}
	echo '</table>';
}

?>

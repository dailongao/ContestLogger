<?php
function showteam($arr){
	echo '<table id="teaminfo" class="table-bordered">';
	foreach ($arr as $key => $val )
	if(is_string($key)){
		echo "<tr><th>". $key ."</th><td>" . $val. "</td></tr>";
	}
	echo '</table>';
}

?>

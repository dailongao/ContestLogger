<?php
function showteam($arr){
	echo '<table border=2>';
	foreach ($arr as $key => $val )
	if(is_string($key)){
		echo "<tr><th>". $key ."</th><td>" . $val. "</td></tr>";
	}
	echo '</table>';
}
?>

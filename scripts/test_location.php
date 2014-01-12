<?php
$file = "../country_codes.txt";
$lines = file($file, FILE_IGNORE_NEW_LINES);
$lines = preg_replace('#[^a-z0-9.]#i', '', $lines);
for($x=0;$x<960;$x=$x+4) {
	if($lines[$x] == "in")
		echo $lines[$x + 1] . " " . $lines[$x + 2];
}
?>
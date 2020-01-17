<?php

$cats_arr = file(ROOT . "/APIs/magic/from.txt", FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);

$data = [];
foreach ($cats_arr as $cat) {
	$country = explode("/", $cat)[0];
	$league = explode("/", $cat)[1];
	$data[ucwords($country)][] = $league;
}
$json = json_encode($data);

//write to file
$file_path = ROOT . "/APIs/magic/to.json";
$file = fopen($file_path, 'w') or die("Unable to open file!");
if (fwrite($file, $json) > 0) {
	fclose($file);
	jsonResponse(true, HTTP_OK, $data);
} else {
	jsonResponse(false, HTTP_SERVER_ERROR, 'Unable to write to file');
}

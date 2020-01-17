<?php

$json = file_get_contents(ROOT . "/APIs/magic/to.json");
$arr =  json_decode($json, true);

/*$country_id = 1;
foreach ($arr as $key => $cats) {
	foreach ($cats as $category_name) {
		//insert to db
		$dbh = new Connection();
		$sql = "INSERT INTO `classifications` (`parent_id`, `category_name`, `catype`, `cat_tag`) 
			VALUES (31, ?, 11, ?)";
		$stmt = $dbh->mysqli->prepare($sql);
		$stmt->bind_param('si', $category_name, $country_id);
		$executed = $stmt->execute();
	}
	$country_id++;
}*/

jsonResponse(true, HTTP_OK, "Done and dusted");


/*function insert_countries() {
	global $arr;
	$countries = array_keys($arr);
	$countries = array_map("trim", $countries);
	foreach ($countries as $country) {
		//insert to db
		$dbh = new Connection();
		$sql = "INSERT INTO `countries` (`name`) 
			VALUES (?)";
		$stmt = $dbh->mysqli->prepare($sql);
		$stmt->bind_param('s', $country);
		$stmt->execute();
	}
}*/
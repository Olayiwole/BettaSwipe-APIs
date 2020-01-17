<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$data =[];
//tournaments
$tournaments =[];
foreach ($result as $t) {

	//matches
	$match = [];
	foreach ($t->match as $m) {
		$match[] = [
			"id" => (int) $m["id"],
			"datetime" => (String) str_replace (".", "-", $m["date"]) . ' ' . $m["time"],
			"home" => [
				"id" => (int) $m->localteam["id"],
				"name" => (String) $m->localteam["name"],
				"q1" => (int) $m->localteam["q1"],
				"q2" => (int) $m->localteam["q2"],
				"q3" => (int) $m->localteam["q3"],
				"q4" => (int) $m->localteam["q4"],
				"ot" => (int) $m->localteam["ot"],
				"totalcore" => (int) $m->localteam["totalcore"],
			],
			"away" => [
				"id" => (int) $m->awayteam["id"],
				"name" => (String) $m->awayteam["name"],
				"q1" => (int) $m->awayteam["q1"],
				"q2" => (int) $m->awayteam["q2"],
				"q3" => (int) $m->awayteam["q3"],
				"q4" => (int) $m->awayteam["q4"],
				"ot" => (int) $m->awayteam["ot"],
				"totalcore" => (int) $m->awayteam["totalcore"]
			]
		];	
	}

	$tournaments[] =[
		"id" => (int) $m["id"],
		"league" => (String) $m["league"],
		"season" => (String) $m["season"],
		"match" => $match,
	];

	$data["tournaments"] = $tournaments;	
}

//Json response call
jsonResponse(true, HTTP_OK, $data);
<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$data = [];
//tournaments
$tournaments = [];
foreach ($result as $t) {

	//matches
	$matches = [];
	foreach ($t->week->match as $m) {
		$matches[] = [
			"id" => (int) $m["id"],
			"datetime" => (String) str_replace(".", "-", $m["date"]) . ' ' . $m["time"],
			"venue_id" => (int) $m["venue_id"],
			"venue" => (String) $m["venue"],
			"home" => [
				"id" => (int) $m->localteam["id"],
				"name" => (String) $m->localteam["name"]
			],
			"away" => [
				"id" => (int) $m->visitorteam["id"],
				"name" => (String) $m->visitorteam["name"]
			]
		];
	}

	$tournaments[] = [
		"id" => (int) $t["id"],
		"league" => (String) $t["league"],
		"season" => (String) $t["season"],
		"is_current" => (Bool) $t["is_current"],
		"matches" => $matches
	];

	$data["tournaments"] = $tournaments;
}
	
//hala
jsonResponse(true, HTTP_OK, $data);
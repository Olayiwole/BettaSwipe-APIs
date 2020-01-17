<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$data = [];
//tournaments
$tournaments = [];
foreach ($result as $t) {

	//matches
	$matches = [];
	foreach ($t->matches->match as $m) {

		//events
		$events = [];
		foreach ($m->events->event as $e) {
			$events[] = [
				"id" => (int) $e["eventid"],
				"type" => (String) $e["type"],
				"minute" => (int) $e["minute"],
				"team" => (String) $e["team"],
				"player" => (String) $e["player"],
				"player_id" => (int) $e["playerId"],
				"assist" => (String) $e["assist"],
				"assist_id" => (int) $e["assistid"],
				"result" => (String) $e["result"],
				"extra_min" => (Bool) $e["extra_min"]
			];
		}

		//matches
		$matches[] = [
			"id" => (int) $m["id"],
			"datetime" => (String) str_replace(".", "-", $m["formatted_date"]) . ' ' . $m["time"],
			"commentary_available" => (int) $m["commentary_available"],
			"venue" => (String) $m["venue"],
			"venue_id" => (int) $m["v"],
			"fix_id" => (int) $m["fix_id"],
			"home" => [
				"id" => (int) $m->localteam["id"],
				"name" => (String) $m->localteam["name"],
				"goals" => (int) $m->localteam["goals"]
			],
			"away" => [
				"id" => (int) $m->visitorteam["id"],
				"name" => (String) $m->visitorteam["name"],
				"goals" => (int) $m->visitorteam["goals"]
			],
			"half_time" => [
				"score" => (String) $m->ht["score"]
			], 
			"full_time" => [
				"score" => (String) $m->ft["score"]
			], 
			"events" => $events
		];

	}
 
	$tournaments[] = [
		"id" => (int) $t["id"],
		"name" => (String) $t["name"],
		"gid" => (String) $t["gid"],
		"gid" => (int) $t["gid"],
		"file_group" => (String) $t["file_group"],
		"is_cup" => (Bool) $t["iscup"],
		"matches" => $matches
	];

	$data["tournaments"] = $tournaments;
}
	
//hala
jsonResponse(true, HTTP_OK, $data);
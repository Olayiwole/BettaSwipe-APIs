<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);


$data = [];

// team
$team = [];
foreach ($result as $t) {

	// players
	$player = [];

	// fetch player profile
	foreach ($t->player as $p) { 
		$player[] = [
			"id" => (int) $p["id"],
			"name" => (String) $p["name"],
			"position" => (String) $p["position"],
			"age" => (int) $p["age"],
			"height" => (String) $p["height"],
			"weight" => (String) $p["weight"],
			"salary" => (String) $p["salary"],
			"college" => (String) $p["college"]
		]; #end arr players
		
	}

	// fetch team 
	$team[] =[
		"id" => (int) $t["id"],
		"name" => (String) $t["name"],
		"player" => $player
	]; #end arr division

	$data["team"] = $team;
}

//hala
// http_response_code(200)
jsonResponse(true, HTTP_OK, $data);
</<?php 
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$data =[];

//categories
$category =[];
foreach ($result as $c) {

//Scores feeds
	$scores = [];
	foreach ($c->scores->match as $s) {
		$scores[] = [
			"id" => (int) $s["id"],
			"status" => (String) $s["status"],
			"datetime" => (int) str_replace(".", "-", $s["date"]) . ' ' . $s["time"],
			"home" => [
				"id" => (int) $s->localteam["id"],
				"name" => (String) $s->localteam["name"],
				"first-quater" => (int) $s->localteam["q1"],
				"second-quater" => (int) $s->localteam["q2"],
				"third-quater" => (int) $s->localteam["q3"],
				"fourth-quater" => (int) $s->localteam["q4"],
				"overtime" => (int) $s->localteam["ot"],
				"totalscore" => (int) $s->localteam["totalscore"
			],
			"away" => [
				"id" => (int) $s->awayteam["id"],
				"name" => (String) $s->awayteam["name"],
				"first-quater" => (int) $s->awayteam["q1"],
				"second-quater" => (int) $s->awayteam["q2"],
				"third-quater" => (int) $s->awayteam["q3"],
				"fourth-quater" => (int) $s->awayteam["q4"],
				"overtime" => (int) $s->awayteam["ot"],
				"totalscore" => (int) $s->awayteam["totalscore"]

			]

			]
		];
	
	}

	$category [] =[
		"id" => (int) $s["id"],
		"name" => (String) $s["name"]

	];

	// push to "category"
	$data["category"] =$category;

}

// Turn to JSON & output
jsonResponse(true, HTTP_OK, $data);
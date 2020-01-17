<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$pref_bookmaker = [16, 14];

$data = [];
// team category
$category =[];
foreach ($result as $c){


	//games
	$match = [];
	foreach ($c->match as $m) {

			//odds
			$odds = [];
			foreach ($m->odds as $O) {

			//type
			$type = [];
			foreach ($O->type as $t) {

				//bookmaker
				$bookmaker = [];
				$available_bookmakers = [];
				foreach ($t->bookmaker as $b) {
					$available_bookmakers[] = (int) $b["id"];
				}
				$selected_bookmaker = null;
				$read = count($pref_bookmaker) - 1;
				for ($i= $read; $i >=0; $i--) {
					$index = ($read - $i);
					if (in_array(($pref_bookmaker[$index]), $avialable_bookmaker)){
						$selected_bookmaker = $pref_bookmaker[$index];
						break;
					}
				} 
				if ($selected_bookmaker == null)
					continue (1);
				foreach ($t->bookmaker as $b) {
					if ($b["id"] != $selected_bookmaker) continue;

					//odd
					$odd = [];
					foreach ($b->odd as $o) {
						$odd[] = [
							"name" => (String) $o["name"],
							"value" => (int) $o["value"]

						];
					}
						
					//handicap
					$handicap = [];
					foreach ($b->handicap as $h) {
						$handicap[] = [
							"name" => (float) $h["name"],
							"ismain" => (String) $h["ismain"],
							"stop" => (String) $h["stop"],
							"odd" => [
								"name" => (String) $h->odd["name"],
								"value" => (float) $h->odd["value"]
							]
						];	
					}

					//total
					$total = [];
					foreach ($b->total as $T) {
						$handicap[] = [
							"name" => (float) $T["name"],
							"ismain" => (String) $T["ismain"],
							"stop" => (String) $T["stop"],
							"odd" => [
								"name" => (String) $T->odd["name"],
								"value" => (float) $T["value"]
							]
						];
					}

					$bookmaker = [
						"id" => (int) $b["id"],
						"name" => (int) $b["name"],
						"stop" => (int) $b["stop"],
						"totalscore" => (int) $b["ts"],
						"children" => count($handicap) > 0 ? $handicap : $total,
						"total" => $total,
						"odd" => $odd
					];
				}

				$type[] = [
					"id" => (int) $t["id"],
					"value" => (String) $t["value"],
					"stop" => (String) $t["stop"],
					"bookmaker" => $bookmaker
				];
			}

			$odds[] = [
				"ts" => (String) $O["ts"],
				"type" => $type
			];
		}

		$match[] = [
			"date" => (String) $m["formatted_date"],
			"time" => (String) $m["time"],
			"venue" => (String) $m["venue"],
			"home" => [
				"first-quarter" => (int) $m->localteam["q1"],
				"secong-quarter" => (int) $m->localteam["q2"],
				"third-quarter" => (int) $m->localteam["q3"],
				"fourth-quarter" => (int) $m->localteam["q4"],

			],
			"away" => [
				"first-quarter" => (int) $m->awayteam["q1"],
				"secong-quarter" => (int) $m->awayteam["q2"],
				"third-quarter" => (int) $m->awayteam["q3"],
				"fourth-quarter" => (int) $m->awayteam["q4"],
			],
			"team_stats" => [],
			"odds" => $odds
		];
	}

	$category[] = [
		"id" => (int) $c["id"],
		"name" => (int) $c["name"],
		"match" => $match
	];

	$data["category"] = $category;

}

//hala
// http_response_code(200)
jsonResponse(true, 200, $data);


	







<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$data = [];
$teams = [];
foreach ($result as $t) {

	//squad
	$squad = [];
	foreach ($t->squad->player as $p) {
		$squad[] = [
			"id" => (int) $p["id"],
			"name" => (String) $p["name"],
			"number" => (int) $p["number"],
			"position" => (String) $p["position"],
			"injured" => (Bool) $p["injured"],
			"minutes_played" => (int) $p["minutes"],
			"appearences" => (int) $p["appearences"],
			"substitute_in" => (int) $p["substitute_in"],
			"substitute_out" => (int) $p["substitute_out"],
			"is_captain" => (Bool) $p["isCaptain"],
			"is_subtitute" => (Bool) $p["isSubst"],
			"goals" => (int) $p["goals"],
			"assists" => (int) $p["assists"],
			"shots_total" => (int) $p["shotsTotal"],
			"shots_on_goal" => (int) $p["shotsOn"],
			"shots_on_goal" => (int) $p["shots_on_goal"],
			"offsides" => (int) $p["offsides"],
			"fouls_commited" => (int) $p["foulsCommited"],
			"tackles" => (int) $p["tackles"],
			"blocks" => (int) $p["blocks"],
			"interceptions" => (int) $p["interceptions"],
			"total_crosses" => (int) $p["crossesTotal"],
			"clearances" => (int) $p["clearances"],
			"dispossesed" => (int) $p["dispossesed"],
			"saves" => (int) $p["saves"],
			"total_duels" => (int) $p["duelsTotal"],
			"duels_won" => (int) $p["duelsWon"],
			"dribble_attempts" => (int) $p["dribbleAttempts"],
			"dribbles_completed" => (int) $p["dribbleSucc"],
			"yellowcards" => (int) $p["yellowcards"],
			"yellowred" => (int) $p["yellowred"],
			"redcards" => (int) $p["redcards"],
			"pen_scored" => (int) $p["penScored"],
			"pen_missed" => (int) $p["penMissed"],
			"pen_saved" => (int) $p["pen_save"],
			"woordworks" => (int) $p["woordworks"],
			"passes" => (int) $p["passes"],
			"passes_acc" => (int) $p["pAccuracy"],
			"key_passes" => (int) $p["keyPasses"],
			"rating" => (float) $p["rating"]
		];
	}

	//transfers in
	$transfers["in"] = [];
	foreach ($t->transfers->in->player as $p) {
		$transfers["in"][] = [
			"id" => (int) $p["id"],
			"name" => (String) $p["name"],
			"position" => (String) $p["position"],
			"age" => (int) $p["age"],
			"team" => (string) $p["from"],
			"team_id" => (int) $p["team_id"],
			"type" => (string) $p["type"],
			"datetime" => (String) str_replace(".", "-", $p["date"])
		];
	}
	//transfers out
	$transfers["out"] = [];
	foreach ($t->transfers->out->player as $p) {
		$transfers["out"][] = [
			"id" => (int) $p["id"],
			"name" => (String) $p["name"],
			"position" => (String) $p["position"],
			"age" => (int) $p["age"],
			"team" => (string) $p["to"],
			"team_id" => (int) $p["team_id"],
			"type" => (string) $p["type"],
			"datetime" => (String) str_replace(".", "-", $p["date"])
		];
	}

	//statistics => scoring minutes
	$scoring_minutes = [];
	foreach ($t->statistics->scoring_minutes->period as $p) {
		$scoring_minutes[] = [
			"minute" => (String) $p["minute"],
			"pct" => (String) $p["pct"],
			"count" => (int) $p["count"]
		];
	}

	//transfers out
	$sidelined_players = [];
	foreach ($t->sidelined->player as $p) {
		$sidelined_players[] = [
			"id" => (int) $p["id"],
			"name" => (String) $p["name"],
			"start_date" => (String) str_replace(".", "-", $p["startdate"]),
			"end_date" => (String) str_replace(".", "-", $p["enddate"]),
			"description" => (string) $p["description"]
		];
	}
 
	$teams[] = [
		"id" => (int) $t["id"],
		"is_national_team" => (bool) $t["is_national_team"],
		"name" => (string) $t->name,
		"fullname" => (string) $t->fullname,
		"country" => (string) $t->country,
		"founded" => (String) $t->founded,
		"venue" => (String) $t->venue_name,
		"venue_id" => (int) $t->venue_id,
		"venue_capacity" => (int) $t->venue_capacity,
		"venue_image" => (string) $t->venue_image,
		"image" => (string) $t->image,
		"coach_name" => (string) $t->coach["name"],
		"coach_id" => (string) $t->coach["id"],
		"squad" => $squad,
		"transfers" => $transfers,
		"statistics" => [
			"rank" => (int) $t->statistics->rank["total"],
			"wins" => [
				"home" => (int) $t->statistics->win["home"],
				"away" => (int) $t->statistics->win["away"],
				"total" => (int) $t->statistics->win["total"]
			],
			"draws" => [
				"home" => (int) $t->statistics->draw["home"],
				"away" => (int) $t->statistics->draw["away"],
				"total" => (int) $t->statistics->draw["total"]
			],
			"losses" => [
				"home" => (int) $t->statistics->lost["home"],
				"away" => (int) $t->statistics->lost["away"],
				"total" => (int) $t->statistics->lost["total"]
			],
			"goals_for" => [
				"home" => (int) $t->statistics->goals_for["home"],
				"away" => (int) $t->statistics->goals_for["away"],
				"total" => (int) $t->statistics->goals_for["total"]
			],
			"clean_sheets" => [
				"home" => (int) $t->statistics->clean_sheets["home"],
				"away" => (int) $t->statistics->clean_sheets["away"],
				"total" => (int) $t->statistics->clean_sheets["total"]
			],
			"avg_goals_per_game_scored" => [
				"home" => (int) $t->statistics->avg_goals_per_game_scored["home"],
				"away" => (int) $t->statistics->avg_goals_per_game_scored["away"],
				"total" => (int) $t->statistics->avg_goals_per_game_scored["total"]
			],
			"avg_goals_per_game_conceded" => [
				"home" => (int) $t->statistics->avg_goals_per_game_conceded["home"],
				"away" => (int) $t->statistics->avg_goals_per_game_conceded["away"],
				"total" => (int) $t->statistics->avg_goals_per_game_conceded["total"]
			],
			"avg_first_goal_scored" => [
				"home" => (int) $t->statistics->avg_first_goal_scored["home"],
				"away" => (int) $t->statistics->avg_first_goal_scored["away"],
				"total" => (int) $t->statistics->avg_first_goal_scored["total"]
			],
			"avg_first_goal_conceded" => [
				"home" => (int) $t->statistics->avg_first_goal_conceded["home"],
				"away" => (int) $t->statistics->avg_first_goal_conceded["away"],
				"total" => (int) $t->statistics->avg_first_goal_conceded["total"]
			],
			"failed_to_score" => [
				"home" => (int) $t->statistics->failed_to_score["home"],
				"away" => (int) $t->statistics->failed_to_score["away"],
				"total" => (int) $t->statistics->failed_to_score["total"]
			],
			"scoring_minutes" => $scoring_minutes,
			"sidelined_players" => $sidelined_players
		]
	];

	$data["teams"] = $teams;
}
	
//hala
jsonResponse(true, HTTP_OK, $data);
<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

/*$expectedKeys = ['player_id'];
$payload = validateRequest($expectedKeys);*/

$trophies = [];
foreach ($result->player->trophies->trophy as $p) {
	$trophies[] = [
		"country" => (String) $p["country"],
		"league" => (string) $p["league"],
		"status" => (string) $p["status"],
		"seasons" => (String) $p["seasons"],
		"count" => (int) $p["count"]
	];
}

$transfers = [];
foreach ($result->player->transfers->transfer as $p) {
	$transfers[] = [
		"date" => (String) str_replace(".", "-", $p["date"]),
		"from" => (string) $p["from"],
		"from_id" => (int) $p["from_id"],
		"to" => (string) $p["to"],
		"to_id" => (int) $p["to_id"],
		"type" => (string) $p["type"]
	];
}

$sidelined = [];
foreach ($result->player->sidelined->item as $p) {
	$sidelined[] = [
		"type" => (string) $p["type"],
		"start_date" => (String) str_replace(".", "-", $p["date_start"]),
		"end_date" => (String) str_replace(".", "-", $p["date_end"]),
	];
}

$data = [
	"id" => (int) $result->player["id"],
	"common_name" => (string) $result->player["common_name"],
	"name" => (string) $result->player->name,
	"firstname" => (string) $result->player->firstname,
	"lastname" => (string) $result->player->lastname,
	"team" => (string) $result->player->team,
	"team_id" => (int) $result->player->teamid,
	"nationality" => (string) $result->player->nationality,
	"birthdate" => (string) $result->player->birthdate,
	"age" => (int) $result->player->age,
	"birthcountry" => (string) $result->player->birthcountry,
	"birthplace" => (string) $result->player->birthplace,
	"position" => (string) $result->player->position,
	"height" => (string) $result->player->height,
	"weight" => (string) $result->player->weight,
	"image" => (string) $result->player->image,
	"statistic_clubs" => tournament_stats("statistic"),
	"statistic_cups" => tournament_stats("statistic_cups"),
	"statistic_cups_intl" => tournament_stats("statistic_cups_intl"),
	"statistic_intl" => tournament_stats("statistic_intl"),
	"trophies" => $trophies,
	"transfers" => $transfers,
	"sidelined" => $sidelined,
	"overall_club_stats" => [
		"stats" => [
			"appearences" => (int) $result->player->overall_clubs->stats["appearences"],
			"lineups" => (int) $result->player->overall_clubs->stats["lineups"],
			"substitute_in" => (int) $result->player->overall_clubs->stats["substitute_in"],
			"is_captain" => (int) $result->player->overall_clubs->stats["is_captain"],
			"goals" => (int) 23, //supply
			"assists" => (int) $result->player->overall_clubs->stats["assists"],
			"shots_total" => (int) $result->player->overall_clubs->stats["shotsTotal"],
			"shots_on_goal" => (int) $result->player->overall_clubs->stats["shotsOn"],
			"fouls_commited" => (int) $result->player->overall_clubs->stats["foulsCommited"],
			"tackles" => (int) $result->player->overall_clubs->stats["tackles"],
			"blocks" => (int) $result->player->overall_clubs->stats["blocks"],
			"interceptions" => (int) $result->player->overall_clubs->stats["interceptions"],
			"total_crosses" => (int) $result->player->overall_clubs->stats["crossesTotal"],
			"clearances" => (int) $result->player->overall_clubs->stats["clearances"],
			"dispossesed" => (int) $result->player->overall_clubs->stats["dispossesed"],
			"saves" => (int) $result->player->overall_clubs->stats["saves"],
			"total_duels" => (int) $result->player->overall_clubs->stats["duelsTotal"],
			"duels_won" => (int) $result->player->overall_clubs->stats["duelsWon"],
			"dribble_attempts" => (int) $result->player->overall_clubs->stats["dribbleAttempts"],
			"dribbles_completed" => (int) $result->player->overall_clubs->stats["dribbleSucc"],
			"pen_scored" => (int) $result->player->overall_clubs->stats["penScored"],
			"pen_missed" => (int) $result->player->overall_clubs->stats["penMissed"],
			"pen_saved" => (int) $result->player->overall_clubs->stats["penSaved"],
			"woordworks" => (int) $result->player->overall_clubs->stats["woordworks"],
			"passes" => (int) $result->player->overall_clubs->stats["passes"],
			"passes_acc" => (int) $result->player->overall_clubs->stats["pAccuracy"],
			"key_passes" => (int) $result->player->overall_clubs->stats["keyPasses"],
			"minutes_played" => (int) $result->player->overall_clubs->stats["minutesPlayed"],
			"rating" => (float) $result->player->overall_clubs->stats["rating"]
		]
	]
];

function tournament_stats($type) {
	global $result;
	$tournament = [];
	foreach ($result->player->$type->club as $p) {
		$tournament[] = [
			"id" => (int) $p["id"],
			"name" => (String) $p["name"],
			"league" => (string) $p["league"],
			"league_id" => (int) $p["league_id"],
			"season" => (String) $p["season"],
			"minutes_played" => (int) $p["minutes"],
			"appearences" => (int) $p["appearences"],
			"lineups" => (int) $p["lineups"],
			"substitute_in" => (int) $p["substitute_in"],
			"substitute_out" => (int) $p["substitute_out"],
			"is_captain" => (int) $p["isCaptain"],
			"goals" => (int) $p["goals"],
			"assists" => (int) $p["assists"],
			"shots_total" => (int) $p["shotsTotal"],
			"shots_on_goal" => (int) $p["shotsOn"],
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
			"pen_saved" => (int) $p["penSaved"],
			"woordworks" => (int) $p["woordworks"],
			"passes" => (int) $p["passes"],
			"passes_acc" => (int) $p["pAccuracy"],
			"key_passes" => (int) $p["keyPasses"],
			"rating" => (float) $p["rating"]
		];
	}
	return $tournament;
}
	
//hala
jsonResponse(true, HTTP_OK, $data);
<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$matches = [];
foreach ($result->top50->match as $m) {
	$matches[] = [
		"id" => (int) $m["static_id"],
		"date" => (String) str_replace(".", "-", $m["date"]),
		"country" => (string) $m["category"],
		"league" => (string) $m["league"],
		"league_id" => (int) $m["league_id"],
		"team1" => (String) $m["team1"],
		"team1_id" => (int) $m["id1"],
		"team2" => (String) $m["team2"],
		"team2_id" => (int) $m["id2"],
		"score" => (String) '['.$m["team1_score"].'-'.$m["team2_score"].']'
	];
}

$league_stats = [];
foreach ($result->leagues->league as $m) {
	$league_stats[] = [
		"id" => (int) $m["id"],
		"name" => (string) $m["name"],
		"games" => (int) $m["games"],
		"team1_won" => (int) $m["team1_won"],
		"team2_won" => (int) $m["team2_won"],
		"draws" => (int) $m["draws"]
	];
}

$data = [
	"team1_id" => (int) $result["team1"],
	"team2_id" => (int) $result["team2"],
	//"matches" => $matches,
	//"league_stats" => $league_stats,
	"overall" => [
		"total" => [
			"games" => (int) $result->overall->total->total["games"],
			"team1_won" => (int) $result->overall->total->total["team1_won"],
			"team2_won" => (int) $result->overall->total->total["team2_won"],
			"draws" => (int) $result->overall->total->total["draws"]
		],
		"home" => [
			"games" => (int) $result->overall->home->team1["games"],
			"team1" => team_overall_outcomes("home", "team1"),
			"team2" => team_overall_outcomes("home", "team2"),
		],
		"away" => [
			"games" => (int) $result->overall->home->team1["games"],
			"team1" => team_overall_outcomes("away", "team1"),
			"team2" => team_overall_outcomes("away", "team2"),
		]
	],
	"goals" => [
		"total" => team_goal_outcomes("total"),
		"home" => team_goal_outcomes("home"),
		"away" => team_goal_outcomes("away")
	],
	"biggest_victory" => [
		"team1" => team_matches("biggest_victory", "team1"),
		"team2" => team_matches("biggest_victory", "team2")
	],
	"biggest_defeat" => [
		"team1" => team_matches("biggest_defeat", "team1"),
		"team2" => team_matches("biggest_defeat", "team2")
	],
	"last5_home" => [
		"team1" => last5_matches("last5_home", "team1"),
		"team2" => last5_matches("last5_home", "team2")
	], 
	"last5_away" => [
		"team1" => last5_matches("last5_away", "team1"),
		"team2" => last5_matches("last5_away", "team2")
	]
];

function team_overall_outcomes($type, $team) {
	global $result;
	return $arr = [
		"won" => (int) $result->overall->$type->$team["won"],
		"lost" => (int) $result->overall->$type->$team["lost"],
		"draws" => (int) $result->overall->$type->$team["draws"]
	];
}

function team_goal_outcomes($type) {
	global $result;
	return $arr = [
		"team1" => [
			"scored" => (int) $result->goals->$type->$type["team1_scored"],
			"conceded" => (int) $result->goals->$type->$type["team1_conceded"]
		],
		"team2" => [
			"scored" => (int) $result->goals->$type->$type["team2_scored"],
			"conceded" => (int) $result->goals->$type->$type["team2_conceded"]
		]
	];
}

function team_matches($type, $team) {
	global $result;
	return $arr = [
		"id" => (int) $result->$type->$team->match["static_id"],
		"date" => (String) str_replace(".", "-", $result->$type->$team->match["date"]),
		"country" => (string) $result->$type->$team->match["category"],
		"league" => (string) $result->$type->$team->match["league"],
		"league_id" => (int) $result->$type->$team->match["league_id"],
		"team1" => (String) $result->$type->$team->match["team1"],
		"team1_id" => (int) $result->$type->$team->match["id1"],
		"team2" => (String) $result->$type->$team->match["team2"],
		"team2_id" => (int) $result->$type->$team->match["id2"],
		"score" => (String) '['.$result->$type->$team->match["team1_score"].'-'.$result->$type->$team->match["team2_score"].']'
	];
}

function last5_matches($type, $team) {
	global $result;
	$matches = [];
	foreach ($result->$type->$team->match as $m) {
		$matches[] = [
			"id" => (int) $m["static_id"],
			"date" => (String) str_replace(".", "-", $m["date"]),
			"country" => (string) $m["category"],
			"league" => (string) $m["league"],
			"league_id" => (int) $m["league_id"],
			"team1" => (String) $m["team1"],
			"team1_id" => (int) $m["id1"],
			"team2" => (String) $m["team2"],
			"team2_id" => (int) $m["id2"],
			"score" => (String) '['.$m["team1_score"].'-'.$m["team2_score"].']'
		];
	}
	return $matches;
}

//hala
jsonResponse(true, HTTP_OK, $data);
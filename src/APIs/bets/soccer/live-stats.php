<?php
$result = file_get_contents($resourceURL);
$result = new SimpleXMLElement($result);

$data = [];
//tournaments
$tournaments = [];
foreach ($result as $t) {

	//matches
	$matches = [];
	foreach ($t->match as $m) {

		//home players
		$players["home"] = [];
		foreach ($m->teams->localteam->player as $p) {
			$players["home"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"number" => (int) $p["number"],
				"position" => (String) $p["pos"],
				"formation_position" => (String) $p["formation_pos"]
			];
		}
		//away players
		$players["away"] = [];
		foreach ($m->teams->visitorteam->player as $p) {
			$players["away"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"number" => (int) $p["number"],
				"position" => (String) $p["pos"],
				"formation_position" => (String) $p["formation_pos"]
			];
		}

		//home subs
		$substitutes["home"] = [];
		foreach ($m->substitutes->localteam->player as $p) {
			$substitutes["home"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"number" => (int) $p["number"],
				"position" => (String) $p["pos"],
			];
		}
		//away subs
		$substitutes["away"] = [];
		foreach ($m->substitutes->visitorteam->player as $p) {
			$substitutes["away"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"number" => (int) $p["number"],
				"position" => (String) $p["pos"],
			];
		}

		//home substitutions
		$substitutions["home"] = [];
		foreach ($m->substitutions->localteam->player as $p) {
			$substitutions["home"][] = [
				"off_id" => (int) $p["off_id"],
				"off" => (String) $p["off"],
				"on_id" => (int) $p["on_id"],
				"on" => (String) $p["on"],
				"minute" => (int) $p["minute"],
				"injury" => (Bool) $p["injury"]
			];
		}
		//away substitutions
		$substitutions["away"] = [];
		foreach ($m->substitutions->visitorteam->player as $p) {
			$substitutions["away"][] = [
				"off_id" => (int) $p["off_id"],
				"off" => (String) $p["off"],
				"on_id" => (int) $p["on_id"],
				"on" => (String) $p["on"],
				"minute" => (int) $p["minute"],
				"injury" => (Bool) $p["injury"]
			];
		}
		
		//home goal scorers
		$summary["home"]["goals"]["players"] = [];
		foreach ($m->summary->localteam->goals->player as $p) {
			$summary["home"]["goals"]["players"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"assist_id" => (int) $p["assist_id"],
				"assist_name" => (String) $p["assist_name"],
				"minute" => (int) $p["minute"],
				"is_own_goal" => (Bool) $p["owngoal"],
				"is_penalty" => (Bool) $p["penalty"]
			];
		}
		//home yellow cards
		$summary["home"]["yellowcards"]["players"] = [];
		foreach ($m->summary->localteam->yellowcards->player as $p) {
			$summary["home"]["yellowcards"]["players"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"minute" => (int) $p["minute"],
				"comment" => (String) $p["comment"]
			];
		}
		//home red cards
		$summary["home"]["redcards"]["players"] = [];
		foreach ($m->summary->localteam->redcards->player as $p) {
			$summary["home"]["redcards"]["players"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"minute" => (int) $p["minute"],
				"comment" => (String) $p["comment"]
			];
		}
		//away goal scorers
		$summary["away"]["goals"]["players"] = [];
		foreach ($m->summary->visitorteam->goals->player as $p) {
			$away_goals[] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"assist_id" => (int) $p["assist_id"],
				"assist_name" => (String) $p["assist_name"],
				"minute" => (int) $p["minute"],
				"is_own_goal" => (Bool) $p["owngoal"],
				"is_penalty" => (Bool) $p["penalty"]
			];
		}
		//away yellow cards
		$summary["away"]["yellowcards"]["players"] = [];
		foreach ($m->summary->visitorteam->yellowcards->player as $p) {
			$summary["away"]["yellowcards"]["players"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"minute" => (int) $p["minute"],
				"comment" => (String) $p["comment"]
			];
		}
		//away red cards
		$summary["away"]["redcards"]["players"] = [];
		foreach ($m->summary->visitorteam->redcards->player as $p) {
			$summary["away"]["redcards"]["players"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"minute" => (int) $p["minute"],
				"comment" => (String) $p["comment"]
			];
		}

		//home player stats
		$player_stats["home"] = [];
		foreach ($m->player_stats->localteam->player as $p) {
			$player_stats["home"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"number" => (int) $p["num"],
				"position" => (String) $p["pos"],
				"is_captain" => (Bool) $p["isCaptain"],
				"is_subtitute" => (Bool) $p["isSubst"],
				"goals" => (int) $p["goals"],
				"shots_total" => (int) $p["shots_total"],
				"shots_on_goal" => (int) $p["shots_on_goal"],
				"shots_on_goal" => (int) $p["shots_on_goal"],
				"assists" => (int) $p["assists"],
				"offsides" => (int) $p["offsides"],
				"fouls_commited" => (int) $p["fouls_commited"],
				"tackles" => (int) $p["tackles"],
				"blocks" => (int) $p["blocks"],
				"interceptions" => (int) $p["interceptions"],
				"total_crosses" => (int) $p["total_crosses"],
				"clearances" => (int) $p["clearances"],
				"dispossesed" => (int) $p["dispossesed"],
				"saves" => (int) $p["saves"],
				"total_duels" => (int) $p["duelsTotal"],
				"duels_won" => (int) $p["duelsWon"],
				"dribble_attempts" => (int) $p["dribbleAttempts"],
				"dribbles_completed" => (int) $p["dribbleSucc"],
				"yellowcards" => (int) $p["yellowcards"],
				"redcards" => (int) $p["redcards"],
				"pen_scored" => (int) $p["pen_score"],
				"pen_missed" => (int) $p["pen_miss"],
				"pen_saved" => (int) $p["pen_save"],
				"woordworks" => (int) $p["hit_woodwork"],
				"passes" => (int) $p["passes"],
				"passes_acc" => (int) $p["passes_acc"],
				"key_passes" => (int) $p["keyPasses"],
				"minutes_played" => (int) $p["minutes_played"],
				"rating" => (float) $p["rating"]
			];
		}
		//away player stats
		$player_stats["away"] = [];
		foreach ($m->player_stats->visitorteam->player as $p) {
			$player_stats["away"][] = [
				"id" => (int) $p["id"],
				"name" => (String) $p["name"],
				"number" => (int) $p["num"],
				"position" => (String) $p["pos"],
				"is_captain" => (Bool) $p["isCaptain"],
				"is_subtitute" => (Bool) $p["isSubst"],
				"goals" => (int) $p["goals"],
				"shots_total" => (int) $p["shots_total"],
				"shots_on_goal" => (int) $p["shots_on_goal"],
				"shots_on_goal" => (int) $p["shots_on_goal"],
				"assists" => (int) $p["assists"],
				"offsides" => (int) $p["offsides"],
				"fouls_commited" => (int) $p["fouls_commited"],
				"tackles" => (int) $p["tackles"],
				"blocks" => (int) $p["blocks"],
				"interceptions" => (int) $p["interceptions"],
				"total_crosses" => (int) $p["total_crosses"],
				"clearances" => (int) $p["clearances"],
				"dispossesed" => (int) $p["dispossesed"],
				"saves" => (int) $p["saves"],
				"total_duels" => (int) $p["duelsTotal"],
				"duels_won" => (int) $p["duelsWon"],
				"dribble_attempts" => (int) $p["dribbleAttempts"],
				"dribbles_completed" => (int) $p["dribbleSucc"],
				"yellowcards" => (int) $p["yellowcards"],
				"redcards" => (int) $p["redcards"],
				"pen_score" => (int) $p["pen_score"],
				"pen_miss" => (int) $p["pen_miss"],
				"pen_saves" => (int) $p["pen_save"],
				"hit_woodwork" => (int) $p["hit_woodwork"],
				"passes" => (int) $p["passes"],
				"passes_acc" => (int) $p["passes_acc"],
				"key_passes" => (int) $p["keyPasses"],
				"minutes_played" => (int) $p["minutes_played"],
				"rating" => (float) $p["rating"]
			];
		}

		//matches
		$matches[] = [
			"id" => (int) $m["id"],
			"status" => (int) $m["status"],
			"datetime" => (String) str_replace(".", "-", $m["date"]) . ' ' . $m["time"],
			"home" => [
				"id" => (int) $m->localteam["id"],
				"name" => (String) $m->localteam["name"],
				"goals" => (int) $m->localteam["goals"],
				"formation" => (String) $m->teams->localteam["formation"]
			],
			"away" => [
				"id" => (int) $m->visitorteam["id"],
				"name" => (String) $m->visitorteam["name"],
				"goals" => (int) $m->visitorteam["goals"],
				"formation" => (String) $m->teams->visitorteam["formation"]
			],
			"match_info" => [
				"stadium" => (String) $m->matchinfo->stadium["name"],
				"attendance" => (String) $m->matchinfo->attendance["name"],
				"time" => (String) $m->matchinfo->time["name"],
				"referee" => (String) $m->matchinfo->referee["name"]
			], 
			"stats" => [
				"home" => [
					"shots" => [
						"total" => (int) $m->stats->localteam->shots["total"],
						"on_target" => (int) $m->stats->localteam->shots["ongoal"],
						"off_target" => (int) $m->stats->localteam->shots["offgoal"],
						"blocked" => (int) $m->stats->localteam->shots["blocked"],
						"insidebox" => (int) $m->stats->localteam->shots["insidebox"],
						"outsidebox" => (int) $m->stats->localteam->shots["outsidebox"]
					],
					"foul" => [
						"total" => (int) $m->stats->localteam->fouls["total"]
					],
					"corners" => [
						"total" => (int) $m->stats->localteam->corners["total"]
					],
					"offsides" => [
						"total" => (int) $m->stats->localteam->offsides ["total"]
					],
					"possession" => [
						"total" => (String) $m->stats->localteam->possestiontime["total"]
					],
					"yellowcards" => [
						"total" => (int) $m->stats->localteam->yellowcards["total"]
					],
					"redcards" => [
						"total" => (int) $m->stats->localteam->redcards["total"]
					],
					"saves" => [
						"total" => (int) $m->stats->localteam->saves["total"]
					],
					"passes" => [
						"total" => (int) $m->stats->localteam->passes["total"],
						"accurate" => (int) $m->stats->localteam->passes["accurate"],
						"pct" => (int) $m->stats->localteam->passes["pct"]
					],
				],
				"away" => [
					"shots" => [
						"total" => (int) $m->stats->visitorteam->shots["total"],
						"on_target" => (int) $m->stats->visitorteam->shots["ongoal"],
						"off_target" => (int) $m->stats->visitorteam->shots["offgoal"],
						"blocked" => (int) $m->stats->visitorteam->shots["blocked"],
						"insidebox" => (int) $m->stats->visitorteam->shots["insidebox"],
						"outsidebox" => (int) $m->stats->visitorteam->shots["outsidebox"]
					],
					"fouls" => [
						"total" => (int) $m->stats->visitorteam->fouls["total"]
					],
					"corners" => [
						"total" => (int) $m->stats->visitorteam->corners["total"]
					],
					"offsides" => [
						"total" => (int) $m->stats->visitorteam->offsides ["total"]
					],
					"possession" => [
						"total" => (String) $m->stats->visitorteam->possestiontime["total"]
					],
					"yellowcards" => [
						"total" => (int) $m->stats->visitorteam->yellowcards["total"]
					],
					"redcards" => [
						"total" => (int) $m->stats->visitorteam->redcards["total"]
					],
					"saves" => [
						"total" => (int) $m->stats->visitorteam->saves["total"]
					],
					"passes" => [
						"total" => (int) $m->stats->visitorteam->passes["total"],
						"accurate" => (int) $m->stats->visitorteam->passes["accurate"],
						"pct" => (int) $m->stats->visitorteam->passes["pct"]
					],
				]
			],
			"summary" => $summary,
			"players" => $players,
			"substitutes" => $substitutes,
			"substitutions" => $substitutions,
			"player_stats" => $player_stats
		];

	}
 
	$tournaments[] = [
		"id" => (int) $t["id"],
		"name" => (String) $t["name"],
		"matches" => $matches
	];

	$data["tournaments"] = $tournaments;
}
	
//hala
jsonResponse(true, HTTP_OK, $data);
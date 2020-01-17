<?php
$games = [
	"soccer" => [
		"name" => "Soccer",
		"icon" => BASE_URL . "media/soccer.png",
		"APIs" => [
			[
				"name" => "Leagues", 
				"endpoint" => BASE_URL . "bets/soccer/leagues"
			],
			[
				"name" => "Live Score", 
				"endpoint" => BASE_URL . "bets/soccer/livescore"
			],
			[
				"name" => "Live Stats", 
				"endpoint" => BASE_URL . "bets/soccer/live-stats"
			],
			[
				"name" => "Standings", 
				"endpoint" => BASE_URL . "bets/soccer/standings"
			],
			[
				"name" => "Fixtures", 
				"endpoint" => BASE_URL . "bets/soccer/fixtures"
			],
			[
				"name" => "Team Profile", 
				"endpoint" => BASE_URL . "bets/soccer/team-profile"
			],
			[
				"name" => "Player Profile", 
				"endpoint" => BASE_URL . "bets/soccer/player-profile"
			],
			[
				"name" => "Head 2 Head", 
				"endpoint" => BASE_URL . "bets/soccer/head2head"
			]
		]
	],
	"american_football" => [
		"name" => "American Football (NFL)",
		"icon" => BASE_URL . "media/nfl.png",
		"APIs" => [
			[
				"name" => "NFL Live", 
				"endpoint" => BASE_URL . "bets/nfl/nfl-live"
			],
			[
				"name" => "NCAAF Live", 
				"endpoint" => BASE_URL . "bets/nfl/ncaaf-live"
			],
			[
				"name" => "Team Rosters", 
				"endpoint" => BASE_URL . "bets/nfl/team-rosters"
			],
			[
				"name" => "Injuries", 
				"endpoint" => BASE_URL . "bets/nfl/injuries"
			],
			[
				"name" => "Schedules", 
				"endpoint" => BASE_URL . "bets/nfl/schedules"
			],
			[
				"name" => "Odds", 
				"endpoint" => BASE_URL . "bets/nfl/odds"
			],
			[
				"name" => "Standings", 
				"endpoint" => BASE_URL . "bets/nfl/standings"
			],
			[
				"name" => "Season Stats", 
				"endpoint" => BASE_URL . "bets/nfl/season-stats"
			],
		]
	],
	"basketball" => [
		"name" => "Basketball (NBA)",
		"icon" => BASE_URL . "media/nba.png",
		"APIs" => [
			[
				"name" => "NBA Live", 
				"endpoint" => BASE_URL . "bets/nfl/nba-live"
			],
			[
				"name" => "NCAA Live", 
				"endpoint" => BASE_URL . "bets/nba/ncaa-live"
			],
			[
				"name" => "Team Rosters", 
				"endpoint" => BASE_URL . "bets/nba/team-rosters"
			],
			[
				"name" => "Injuries", 
				"endpoint" => BASE_URL . "bets/nba/injuries"
			],
			[
				"name" => "Schedules", 
				"endpoint" => BASE_URL . "bets/nba/schedules"
			],
			[
				"name" => "Odds", 
				"endpoint" => BASE_URL . "bets/nba/odds"
			],
			[
				"name" => "Live Score", 
				"endpoint" => BASE_URL . "bets/nba/livescore"
			],
			[
				"name" => "Season Stats", 
				"endpoint" => BASE_URL . "bets/nba/season-stats"
			],
		]
	],
	"baseball" => [
		"name" => "Baseball (MLB)",
		"icon" => BASE_URL . "media/mlb.png",
		"APIs" => [
			[
				"name" => "MLB Live", 
				"endpoint" => BASE_URL . "bets/mlb/nba-live"
			],
			[
				"name" => "MLB Rosters", 
				"endpoint" => BASE_URL . "bets/mlb/rosters"
			],
			[
				"name" => "Injuries", 
				"endpoint" => BASE_URL . "bets/mlb/injuries"
			],
			[
				"name" => "Schedules", 
				"endpoint" => BASE_URL . "bets/mlb/schedules"
			],
			[
				"name" => "Odds", 
				"endpoint" => BASE_URL . "bets/mlb/odds"
			],
			[
				"name" => "Season Stats", 
				"endpoint" => BASE_URL . "bets/mlb/season-stats"
			]
		]
	],
	"hockey" => [
		"name" => "Hockey",
		"icon" => BASE_URL . "media/hockey.png",
		"APIs" => [
			[
				"name" => "NHL Live", 
				"endpoint" => BASE_URL . "bets/hockey/nhl-live"
			],
			[
				"name" => "KHL Live", 
				"endpoint" => BASE_URL . "bets/hockey/khl-live"
			],
			[
				"name" => "NHL Rosters", 
				"endpoint" => BASE_URL . "bets/hockey/nhl-rosters"
			],
			[
				"name" => "KHL Rosters", 
				"endpoint" => BASE_URL . "bets/hockey/khl-rosters"
			],
			[
				"name" => "Injuries", 
				"endpoint" => BASE_URL . "bets/hockey/injuries"
			],
			[
				"name" => "Odds", 
				"endpoint" => BASE_URL . "bets/hockey/odds"
			],
			[
				"name" => "Finland Liiga", 
				"endpoint" => BASE_URL . "bets/hockey/finland-liiga"
			]
		]
	],
	"tennis" => [
		"name" => "Tennis",
		"icon" => BASE_URL . "media/tennis.png",
		"APIs" => [
			[
				"name" => "Live Score", 
				"endpoint" => BASE_URL . "bets/tennis/livescore"
			],
			[
				"name" => "Player Profiles", 
				"endpoint" => BASE_URL . "bets/tennis/player-profile"
			],
			[
				"name" => "Odds", 
				"endpoint" => BASE_URL . "bets/tennis/odds"
			],
			[
				"name" => "Ranking", 
				"endpoint" => BASE_URL . "bets/tennis/ranking"
			]
		]
	],
	"cricket" => [
		"name" => "Cricket",
		"icon" => BASE_URL . "media/cricket.png",
		"APIs" => [
			[
				"name" => "Live Scorecard", 
				"endpoint" => BASE_URL . "bets/cricket/livescore"
			],
			[
				"name" => "Tours", 
				"endpoint" => BASE_URL . "bets/cricket/tours"
			],
			[
				"name" => "Team Squads", 
				"endpoint" => BASE_URL . "bets/cricket/team-squads"
			],
			[
				"name" => "Fixtures", 
				"endpoint" => BASE_URL . "bets/cricket/fixtures"
			],
			[
				"name" => "Player Profiles", 
				"endpoint" => BASE_URL . "bets/cricket/player-profile"
			]
		]
	],
	"rugby" => [
		"name" => "Rugby",
		"icon" => BASE_URL . "media/rugby.png",
		"APIs" => [
			[
				"name" => "Live Stats", 
				"endpoint" => BASE_URL . "bets/rugby/live-stats"
			],
			[
				"name" => "Standings", 
				"endpoint" => BASE_URL . "bets/rugby/standings"
			],
			[
				"name" => "Team Squads", 
				"endpoint" => BASE_URL . "bets/rugby/team-squads"
			],
			[
				"name" => "Fixtures", 
				"endpoint" => BASE_URL . "bets/rugby/fixtures"
			]
		]
	],
	"horse_racing" => [
		"name" => "Horse Racing",
		"icon" => BASE_URL . "media/horse-racing.png",
		"APIs" => [
			[
				"name" => "US Racing", 
				"endpoint" => BASE_URL . "bets/horse-racing/us-racing"
			],
			[
				"name" => "UK Racing", 
				"endpoint" => BASE_URL . "bets/horse-racing/uk-racing"
			]
		]
	],
	"golf" => [
		"name" => "Golf",
		"icon" => BASE_URL . "media/golf.png",
		"APIs" => [
			[
				"name" => "Live Leaderboard", 
				"endpoint" => BASE_URL . "bets/golf/live-leaderboard"
			],
			[
				"name" => "PGA Ranking", 
				"endpoint" => BASE_URL . "bets/golf/pga-ranking"
			]
		]
	],
	"esports" => [
		"name" => "Esports",
		"icon" => BASE_URL . "media/esports.png",
		"APIs" => [
			[
				"name" => "Live Score", 
				"endpoint" => BASE_URL . "bets/esports/livescore"
			],
			[
				"name" => "Odds", 
				"endpoint" => BASE_URL . "bets/esports/odds"
			]
		]
	],
	"motor_sports" => [
		"name" => "Motor Sports",
		"icon" => BASE_URL . "media/motor-sports.png",
		"APIs" => [
			[
				"name" => "F1 Lap by Lap", 
				"endpoint" => BASE_URL . "bets/motorsports/f1-lap"
			],
			[
				"name" => "NASCAR Live", 
				"endpoint" => BASE_URL . "bets/motorsports/nascar-live"
			],
			[
				"name" => "Fixtures", 
				"endpoint" => BASE_URL . "bets/motorsports/fixtures"
			],
			[
				"name" => "Results", 
				"endpoint" => BASE_URL . "bets/motorsports/results"
			]
		]
	],
	"handball" => [
		"name" => "Handball",
		"icon" => BASE_URL . "media/handball.png",
		"APIs" => [
			[
				"name" => "Live Score", 
				"endpoint" => BASE_URL . "bets/handball/livescore"
			]
		]
	],
	"volleyball" => [
		"name" => "Volleyball",
		"icon" => BASE_URL . "media/volleyball.png",
		"APIs" => [
			[
				"name" => "Live Score", 
				"endpoint" => BASE_URL . "bets/volleyball/livescore"
			]
		]
	],
	"australian_football" => [
		"name" => "Australian Football (AFL)",
		"icon" => BASE_URL . "media/afl.png",
		"APIs" => [
			[
				"name" => "AFL Live Score", 
				"endpoint" => BASE_URL . "bets/afl/livescore"
			],
			[
				"name" => "Fixtures", 
				"endpoint" => BASE_URL . "bets/afl/fixtures"
			]
		]
	]
];
$data["games"] = $games;
//hala
jsonResponse(true, HTTP_OK, $data);
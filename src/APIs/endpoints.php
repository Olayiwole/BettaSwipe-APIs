<?php
$APIs = [
	"auth" => [
		[
			"name" => "Register", 
			"endpoint" => BASE_URL . "auth/register",
			"method" => "POST",
			"headers" => [
				"content_type" => "application/json",
				"API_Key" => "X-API-KEY"
			],
			"expected_payload" => "first_name, last_name, other_name, email, password, c_password"
		],
		[
			"name" => "Login", 
			"endpoint" => BASE_URL . "auth/login",
			"method" => "POST",
			"headers" => [
				"content_type" => "application/json",
				"API_Key" => "X-API-KEY"
			],
			"expected_payload" => "email, password"
		],
		[
			"name" => "Login Check", 
			"endpoint" => BASE_URL . "auth/user_loggedin",
			"method" => "GET, POST",
			"headers" => [
				"content_type" => "application/json",
				"API_Key" => "X-API-KEY"
			],
			"expected_payload" => ""
		],
		[
			"name" => "Logout", 
			"endpoint" => BASE_URL . "auth/logout",
			"method" => "GET, POST",
			"headers" => [
				"content_type" => "application/json",
				"API_Key" => "X-API-KEY"
			],
			"expected_payload" => ""
		],
	],
	"games" => [
		"name" => "[Games]", 
		"endpoint" => BASE_URL . "bets/index",
		"method" => "GET, POST",
		"headers" => [
			"content_type" => "application/json",
			"API_Key" => "X-API-KEY"
		],
		"expected_payload" => "As requested..."
	]
];
$data["APIs"] = $APIs;
//hala
jsonResponse(true, HTTP_OK, $data);
<?php
$expectedKeys = ['first_name', 'last_name', 'email', 'password', 'c_password'];
$payload = validateRequest($expectedKeys);

$dbh = new Connection();
$sql = "SELECT `email` FROM `users` WHERE `email`=? LIMIT 1";
$stmt = $dbh->mysqli->prepare($sql);
$stmt->bind_param('s', $payload["email"]);
$executed = $stmt->execute();
$stmt->bind_result($email);
$exists = [];
while ($stmt->fetch()) {
    $exists = ["email" => $email];
}

//email already exists???
if( ! empty($exists)) {
	jsonResponse(false, HTTP_BAD_REQUEST, 'Email already exists');
}

//password mismatch???
if($payload["password"] !== $payload["c_password"]) {
	jsonResponse(false, HTTP_BAD_REQUEST, 'Passwords do not match');
}

//insert to db
$dbh = new Connection();
$sql = "INSERT INTO `users` (`first_name`, `last_name`, `other_name`, `email`, `password`) 
	VALUES (?, ?, ?, ?, ?)";
$stmt = $dbh->mysqli->prepare($sql);

$first_name = trim(ucwords($payload["first_name"]));
$last_name = trim(ucwords($payload["last_name"]));
$other_name = trim(ucwords($payload["other_name"]));
$email = trim($payload["email"]);
//hash password
$password = trim($payload["password"]);
$password = hash("sha256", $password);

$stmt->bind_param('sssss', $first_name, $last_name, $other_name, $email, $password);
$executed = $stmt->execute();
if ( ! $executed) {
	jsonResponseDB(false, $stmt->error);
}

$stmt->close();
$dbh->mysqli->close();

//hala
jsonResponse(true, HTTP_OK, 'Registration successful');
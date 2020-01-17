<?php
$expectedKeys = ['email', 'password'];
$payload = validateRequest($expectedKeys);

$email = trim($payload['email']);
$password = trim($payload['password']);

$dbh = new Connection();
$sql = "SELECT `first_name`, `last_name`, `email`, `password` 
        FROM `users` 
        WHERE `email`=? AND `active`=1 
        LIMIT 1";
$stmt = $dbh->mysqli->prepare($sql);
$stmt->bind_param('s', $email);
$executed = $stmt->execute();
$stmt->bind_result($first_name, $last_name, $email, $password);
$result = [];
while ($stmt->fetch()) {
    $result = [
        "first_name" => $first_name,
        "last_name" => $last_name,
        "email" => $email,
        "password" => $password
    ];
}

if ( ! $executed) {
	jsonResponseDB(false, $stmt->error);
}
$stmt->close();
$dbh->mysqli->close();

if ( ! $result) {
	$register_url = BASE_URL . 'auth/register';
	jsonResponse(false, HTTP_UNAUTHORIZED, "User account not found. Ping {$register_url} to create account");
} 

if ( hash("sha256", $payload["password"]) !== $result["password"] ) {
	jsonResponse(false, HTTP_UNAUTHORIZED, 'Invalid login credentials');
}

//set login session
$_SESSION['user_loggedin'] = TRUE;
$_SESSION['user_email'] = $result["email"];

//hala
jsonResponse(true, HTTP_OK, 'Login successful');
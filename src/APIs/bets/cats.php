<?php
$dbh = new Connection();
$sql = "SELECT `classifications`,  FROM `classifications`";
$stmt = $dbh->mysqli->prepare($sql);
$stmt->bind_result($email);
$exists = [];
while ($stmt->fetch()) {
    $exists = ["email" => $email];
}

//hala
jsonResponse(true, HTTP_OK, 'Registration successful');
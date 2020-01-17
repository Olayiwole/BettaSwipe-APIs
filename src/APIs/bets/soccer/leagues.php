<?php
$result = file_get_contents($resourceURL);

$data = json_decode($result, true);
	
//hala
jsonResponse(true, HTTP_OK, $data);
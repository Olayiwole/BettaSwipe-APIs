<?php

//unset login session
unset($_SESSION['user_loggedin']);
unset($_SESSION['user_email']);

//hala
jsonResponse(true, HTTP_OK, 'Logout successful');

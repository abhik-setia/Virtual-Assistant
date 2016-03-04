<?php
define('DB_SERVER', 'localhost');
define('DB_USERNAME', 'root');    // DB username
define('DB_PASSWORD', 'itabhik2597');    // DB password
define('DB_DATABASE', 'virtual_assistant');      // DB name
$connection = mysqli_connect(DB_SERVER, DB_USERNAME, DB_PASSWORD,DB_DATABASE) or die( "Unable to connect");
//$database = mysql_select_db(DB_DATABASE) or die( "Unable to select database");
?>
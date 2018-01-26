<?php 

//--- Settings ---//
$host 		= 'localhost';
$username 	= 'root';
$password 	= '';
$database 	= 'test';

//--- DB Connection ---//
$verbindung = mysqli_connect($host, $username, $password, $database);

//--- Errorhandling ---//

if (!$verbindung) {
    echo "Error: Unable to connect to MySQL." . PHP_EOL;
    echo "Debugging errno: " . mysqli_connect_errno() . PHP_EOL;
    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
    exit;
}

if (!$db_test = mysqli_query($verbindung, "SELECT DATABASE()")) {
    echo "Default database not found!";
}
?>
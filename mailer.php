<?php

//--- Includes ---//

include('./connect.php');

//--- Settings ---//
$subject = 'BBS Lunchtime ' . date('d.m.Y');
$headline = 'BBS Lunchtime ' . date('d.m.Y');
$timezone_at = "CET"; // CET or CEST
$timezone_uk = "GMT"; // GMT or BST
$to = 'hhirsch@barracuda.com,h.hirsch@gmx.org';

//--- Mail Headers ---//
$headers = 'From: hhirsch@barracuda.com' . "\r\n" .
    'Reply-To: hhirsch@barracuda.com' . "\r\n" .
	'Content-Type: text/html'; 'charset="UTF-8"' . "\r\n" .	
    'X-Mailer: PHP/' . phpversion();

//--- Mail Body ---//

$message = "<html><body>";
$message .= "<h2>" . $headline . "</h2><h4>11:30 " . $timezone_at . " / 10:30 " . $timezone_uk . "</h4><ul>";

$sql_query = mysqli_query($verbindung,"SELECT * FROM lunchdb WHERE time = '11:30' order by name");
while($row = mysqli_fetch_assoc($sql_query)) {
	$message .= "<li>" . $row["name"] . "</li>";
}
$message .= "</ul>";

$sql_query = mysqli_query($verbindung,"SELECT * FROM lunchdb WHERE time = '12:30' order by name");
$message .= "<h4>12:30 " . $timezone_at . " / 11:30 " . $timezone_uk . "</h4><ul>";
while($row = mysqli_fetch_assoc($sql_query)) {
	$message .= "<li>" . $row["name"] . "</li>";
}
$message .= "</ul>";

$sql_query = mysqli_query($verbindung,"SELECT * FROM lunchdb WHERE time = '13:30' order by name");
$message .= "<h4>13:30 " . $timezone_at . " / 12:30 " . $timezone_uk . "</h4><ul>";
while($row = mysqli_fetch_assoc($sql_query)) {
	$message .= "<li>" . $row["name"] . "</li>";
}
$message .= "</ul>";

//--- Send mail and error handling ---//
$success = mail($to, $subject, $message, $headers);
if (!$success) {
    $errorMessage = error_get_last()['message'];
	print_r($errorMessage);
} 

//--- Close DB Connection ---//
mysqli_close($verbindung);

?>
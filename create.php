<?php
// Cookies kunnen uitstaan en er is geen reden is om je spel van cookies afhankelijk te maken
ini_set('session.use_cookies', false);

// Begin de sessie
session_start();

// prepare
$_SESSION['p1ready'] = false;
$_SESSION['p2ready'] = false;
$_SESSION['p1guess'] = null;
$_SESSION['p2guess'] = null;
$_SESSION['action']	 = 'start';
$_SESSION['score'] 	 = Array(1 => 0, 2 => 0);


// Geef de redirect
header('Location: http://gmchat.blijbol.nl/gc.php?i=' . session_id());
?>
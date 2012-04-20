<?php
// Open de sessie
ini_set('session.use_cookies', false);
session_id($_GET['session']);
session_start();

// set ready
$_SESSION['p'.$_POST['playerid'].'ready'] = true;
$_SESSION['p'.$_POST['playerid'].'guess'] = $_POST['choose'];
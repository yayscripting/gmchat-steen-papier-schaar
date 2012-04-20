<?php
if(empty($_GET['s']) || empty($_GET['i']) || empty($_GET['n1']) || empty($_GET['n2'])){
	exit();
}

// Open de sessie
ini_set('session.use_cookies', false);
session_id($_GET['i']);
session_start();

// set playername
$_SESSION['p'.$_GET['s'].'name'] = $_GET['n'.$_GET['s']];

// check IP
$securFile = 'gamesecur/'.$_GET['i'].'_'.$_GET['s'].'.json';
if(file_exists($securFile)){
	$json = json_decode(file_get_contents($securFile), true);

	if($json['ip'] != $_SERVER['REMOTE_ADDR']){
		exit("Can't join server via IP-adress <i>".$_SERVER['REMOTE_ADDR']."</i>");
	}
}else{
	$handle = fopen($securFile, 'w');
	$toWrite = array('ip' => $_SERVER['REMOTE_ADDR']);
	fwrite($handle, json_encode($toWrite));
	fclose($handle);	
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<script src="script/supermootools.js" type="text/javascript"></script>
	<script src="script/script.js" type="text/javascript"></script>
	<link rel="stylesheet" type="text/css" href="style/style.css" />
	<title>Steen, papier, schaar?</title>
	<script type="text/javascript">
	var session = '<?php echo $_GET['i']; ?>';
	var iam = <?php echo ($_GET['s'] == 1) ? 'true' : 'false'; ?>;
	var playerid = <?php echo $_GET['s']; ?>;
	var playerOne = "<?php echo $_GET['n1']; ?>";
	var playerTwo = "<?php echo $_GET['n2']; ?>";
	</script>
</head>

<body>
	<div class="container">
		<div class="scoreboard">
			<div class="n1"><?php echo $_GET['n1']; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(<span id="score_1">0</span>)</div>
			<div class="n2">(<span id="score_2">0</span>)&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $_GET['n2']; ?></div>
		</div>
		
		<div class="clear"></div>
	
		<div class="info">Maak je keuze!</div>
		<div class="choose">
			<div class="stone"><img width="50" height="50" src="images/stone.png" id="stone" rel="0" alt="Steen"/></div>
			<div class="paper"><img width="50" height="50" src="images/paper.png" id="paper" rel="1" alt="Papier"/></div>
			<div class="scissors"><img width="50" height="50" src="images/scissors.png" id="scissors" rel="2" alt="Schaar"/></div>
		</div>
		
		<div class="wait">
			<img width="50" height="50" src="images/stone.png" id="stone" rel="0" alt="Steen"/>
		</div>
		
		<div class="showdown">
			<div class="p1"><img width="50" height="50" src="images/stone.png" id="p1guess" rel="0" alt="Steen"/></div>
				<div class="vs">VS</div>
			<div class="p2"><img width="50" height="50" src="images/stone.png" id="p2guess" rel="0" alt="Steen"/></div>
		</div>
</body>
</html>
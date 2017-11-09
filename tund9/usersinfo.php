<?php
	
	require("functions.php");
	
		//kui pole sisseloginud, liigume login lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	if(isset($_GET["logout"])){
		session_destroy();
		header("Location: login.php");
		exit();
	}

	$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
	$stmt = $mysqli->prepare("SELECT id, firstname, lastname, email FROM vp_users");

	while($stmt->fetch()){
			<table border="1" style="border: 1px solid black; border-collapse: collapse">
		<tr>
			<th>Eesnimi</th><th>perekonnanimi</th><th>e-posti aadress</th>
		</tr>
		<tr>
			<td>Juku</td><td>Porgand</td><td>juku.porgand@aed.ee</td>
		</tr>
		<tr>
			<td>Mari</td><td>Karus</td><td>mari.karus@aed.ee</td>
		</tr>
		</table>
        }
		echo "<table>";
		
?>
<!DOCKTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Silver Kaugemaa programmerib veebilehte
	
</head>
<body>
	<h1><?php echo $myName ." " .$myFamilyName; ?> </h1>  veebiprogrammerimine
	
	<p>See veebileht on loodud õppetöö raames ning ei sisalda mingisust tõsiseltvõetavat sisu! </p>
	<p>Enda heaolu nime ärge kopeerige siit MITTE MIDAGI! </p>
	
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<h2>Kõik süsteemi kasutajad</h2>
	
	<hr>
	
</body>
</html>
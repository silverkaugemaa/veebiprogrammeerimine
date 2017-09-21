<?php
	//muutujad
	$myName = "Silver";
	$myFamilyName = "Kaugemaa";
	$monthNamesET=["jaanuar", "veebruar", "märts", "aprill", "mai", "juuni", "juuli", "august", "september", "oktoober", "november", "detsember"];
	//var_dump($monthNamesET);
	//echo $monthNamesET[8];
	$monthNow = $monthNamesET[date("n") -1];
	//hindan päeva osa (võrdlemine < > <= >= == !=)
	$hourNow = date("H");
	if ($hourNow < 8){
		$partOfDay = "varajane hommik";
		
	}
	//echo $partOfDay
		if ($hourNow >= 8 and $hourNow < 16){
			$partOfDay = "koolipäev";
		}
		if ($hourNow > 16){
		$partOfDay = "vaba aeg";
		}
		
		//echo $partOfDay;
		//var_dump ($_POST);
		//echo $_POST["birthYear"];
		$myBirthYear;
		$ageNotice = "";
		if ( isset($_POST["birthYear"])  and $_POST["birthYear"] !=0){
			$myBirthYear = $_POST["birthYear"];
			$myAge = date("Y") - $_POST["birthYear"];
			$ageNotice = "<p>Te olete umbkaudu " .$myAge ."aastat vana</p>";
		$ageNotice .="olete elanud järgnevatel aastatel: </p> <ul>";
		for ($i = $myBirthYear; $i <= date("Y"); $i ++){
			$ageNotice .= "<li>" .$i ."</li>";
		}
		$ageNotice .= "</ul>";
		}
		
		/*for ($i = 0; $i < 5; $i ++){
			echo "ha";
		}*/
			?>
<!DOCKTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>Silver Kaugemaa programmerib veebilehte
	</title>
</head>
<body>
	<h1><?php echo $myName ." " .$myFamilyName; ?> </h1>  veebiprogrammerimine
	
	
	<p>See veebileht on loodud õppetöö raames ning ei sisalda mingisust tõsiseltvõetavat sisu! </p>
	<p>Enda heaolu nime ärge kopeerige siit MITTE MIDAGI! </p>
	
	<?php
		echo "<p>algas php õppimine.";
		echo "<p>täna on ";
		echo date("d. ") .$monthNow .date("Y") .", kell oli lehe avamise hetkel " . date("H.i.s");
		echo ", hetkel on  " .$partOfDay .".</p>";
	
	?>
	<h2> Natuke vanusest</h2>
	<form method="POST">
		<label>Teie sünniaasta: </label>
		<input name="birthYear" id="birthYear" type="number" value="<?php echo $myBirthYear; ?>" min="1900" max="2017">
		<input name="submitBirthYear" type="submit" value="Sisesta" >
	</form>
	<?php
		if ($ageNotice != ""){
			echo $ageNotice;
		}
	?>
	

	<p> Meie õpime <a href="http://www.tlu.ee">Tallinna Ülikkolis</a>.</p>
	<p>Minu esimene php leht on <a href="../esimene.php">siin</a>.</p>
	<p>Minu sõbra Caspari leht on <a href="../../../~seppcasp">siin</a>.</p>
	<p>pilte näeb <a href="foto.php">siin</a>.</p>
	
</body>
</html>
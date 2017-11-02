<?php
	require("functions.php");
	$notice = "";
	
	
	//kui pole sisseloginud, siis sisselogimise lehele
	if(!isset($_SESSION["userId"])){
		header("Location: login.php");
		exit();
	}
	
	//kui logib välja
	if (isset($_GET["logout"])){
		//lõpetame sessiooni
		session_destroy();
		header("Location: login.php");
		exit();
	}
	
	//kui soovitakse ideed salvestada
	if(isset($_POST["ideaBtn"])){
		
		if(isset($_POST["idea"]) and !empty($_POST["idea"])){
			//echo $_POST["ideaColor"];
			$notice = saveIdea($_POST["idea"], $_POST["ideaColor"]);
		}
	}
	
	
	
	
?>

<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>
		Silver Kaugemaa programmerib veebilehte
	</title>
</head>
<body>
	<h1>Head mõtted</h1>
	<p>See veebileht on loodud õppetöö raames ning ei sisalda tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja</a>!</p>
	<p><a href="main.php">Pealeht</a></p>
	<hr>
	<form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
		<label>Päeva esimene mõte: </label>
		<input name="idea" type="text">
		<br>
		<label>mõttega seostuv värv: </label>
		<input name="ideaColor" type="color">
		<br>
		<input name="ideaBtn" type="submit" value="Salvesta">
		<span><?php echo $notice; ?></span>
	
	</form>
	<hr>
	<h2>Senised mõtted</h2>
	<div style="width: 40%">
		<?php echo listIdeas(); ?>
	</div>
	
	</body>
</html>
<?php
	require("functions.php");
	require("classes/Photoupload.class.php");
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
	}
	
	//classi esimene näide
	/*$esimene = new Photoupload("Kaval trikk");
	echo $esimene->testPublic;
	$teine=new Photoupload("ja nii juba mitu korda ");*/
	
	//Algab foto laadimise osa
	$target_dir = "../../pics/";
	$target_file = "";
	$uploadOk = 1;
	$maxWidth = 600;
	$maxHeight = 400;
	$marginHor = 10;
	$marginVer = 10;
	$marginBottom = 10;
	$marginRight = 10;
	
	//kas vajutati laadimise nuppu
	if(isset($_POST["submit"])) {
		//kas fail on valitud, failinimi olemas
		if(!empty($_FILES["fileToUpload"]["name"])){
			
			//fikseerin faili nimelaiendi
			$imageFileType = strtolower(pathinfo(basename($_FILES["fileToUpload"]["name"]),PATHINFO_EXTENSION));
			
			//ajatempel
			$timeStamp = microtime(1) * 10000;
			
			//fikseerin nime
			//$target_file = $target_dir . pathinfo(basename($_FILES["fileToUpload"]["name"]))["filename"] ."_" .$timeStamp ."." .$imageFileType;
			$target_file = "hmv_" .$timeStamp ."." .$imageFileType;
			
			//Kas on pildi failitüüp
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) {
				$notice .= "Fail on pilt - " . $check["mime"] . ". ";
				$uploadOk = 1;
			} else {
				$notice .= "See pole pildifail. ";
				$uploadOk = 0;
			}
			
			/*Kas selline pilt on juba üles laetud
			if (file_exists($target_file)) {
				$notice .= "Kahjuks on selle nimega pilt juba olemas. ";
				$uploadOk = 0;
			}*/
			/*Piirame faili suuruse
			if ($_FILES["fileToUpload"]["size"] > 1000000) {
				$notice .= "Pilt on liiga suur! ";
				$uploadOk = 0;
			}*/
			
			//Piirame failitüüpe
			if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif" ) {
				$notice .= "Vabandust, vaid jpg, jpeg, png ja gif failid on lubatud! ";
				$uploadOk = 0;
			}
			
			//Kas saab laadida?
			if ($uploadOk == 0) {
				$notice .= "Vabandust, pilti ei laetud üles! ";
			//Kui saab üles laadida
			} else {		
				
				//kasutame klassi
				$myPhoto = new Photoupload($_FILES["fileToUpload"]["tmp_name"], $imageFileType);
				$myPhoto->resizePhoto($maxWidth, $maxHeight);
				$myPhoto->addWatermark("../../graphics/hmv_logo.png", $marginRight, $marginBottom);
				$myPhoto->addTextWatermark("Heade mõtete veeb");
				$myPhoto->savePhoto($target_dir, $target_file);
				//$myPhoto->saveOriginal($target_dir, $target_file);
				$myPhoto->clearImages();
				unset($myPhoto);
				
				/*if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
					$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
				} else {
					$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
				}*/
				
				//sõltuvalt failitüübist, loon pildiobjekti
				/*if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					$myTempImage = imagecreatefromjpeg($_FILES["fileToUpload"]["tmp_name"]);
				}
				if($imageFileType == "png"){
					$myTempImage = imagecreatefrompng($_FILES["fileToUpload"]["tmp_name"]);
				}
				if($imageFileType == "gif"){
					$myTempImage = imagecreatefromgif($_FILES["fileToUpload"]["tmp_name"]);
				}*/
				
				/*suuruse muutmine
				//teeme kindlaks praeguse suuruse
				$imageWidth = imagesx($myTempImage);
				$imageHeight = imagesy($myTempImage);
				//arvutan suuruse suhte
				if($imageWidth > $imageHeight){
					$sizeRatio = $imageWidth / $maxWidth;
				} else {
					$sizeRatio = $imageHeight / $maxHeight;
				}
				//tekitame uue, sobiva suurusega pikslikogumi
				$myImage = resizeImage($myTempImage, $imageWidth, $imageHeight, round($imageWidth / $sizeRatio), round($imageHeight / $sizeRatio));
				*/
				
				/*lisan vesimärgi
				$stamp = imagecreatefrompng("../../graphics/hmv_logo.png");
				$stampWidth = imagesx($stamp);
				$stampHeight = imagesy($stamp);
				$stampX = imagesx($myImage) - $stampWidth - $marginHor;
				$stampY = imagesy($myImage) - $stampHeight - $marginVer;
				imagecopy($myImage, $stamp, $stampX, $stampY, 0, 0, $stampWidth, $stampHeight);*/
				
				//lisan ka teksti vesimärgina
				//$textToImage = "Heade mõtete veeb";
				//määrata värv
				/*$textColor = imagecolorallocatealpha($myImage, 255,255,255,60);//alpha 0 - 127
				//mis pildile, suurus, nurk vastupäeva, x, y, värv, font, tekst
				imagettftext($myImage, 20, -45, 10, 25, $textColor, "../../graphics/ARIAL.TTF", $textToImage);*/
				
				//salvestame pildi
				/*if($imageFileType == "jpg" or $imageFileType == "jpeg"){
					if(imagejpeg($myImage, $target_file, 90)){
						$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
					}
				}
				if($imageFileType == "png"){
					if(imagepng($myImage, $target_file, 5)){
						$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
					}
				}
				if($imageFileType == "gif"){
					if(imagegif($myImage, $target_file)){
						$notice .= "Fail ". basename( $_FILES["fileToUpload"]["name"]). " laeti üles! ";
					} else {
						$notice .= "Vabandust, üleslaadimisel tekkis tõrge! ";
					}
				}*/
				
				//vabastan mälu
				/*imagedestroy($myTempImage);
				imagedestroy($myImage);
				imagedestroy($stamp);*/
				
			}//saab salvestada lõppeb		
		
		} else {
			$notice = "Palun valige kõigepealt pildifail!";
		}
	}//if submit lõppeb
	
	/*function resizeImage($image, $origW, $origH, $w, $h){
		$newImage = imagecreatetruecolor($w, $h);
		//kuhu, kust, kuhu koordinaatidele x ja y, kust koordinaatidelt x ja y, kui laialt uude kohta, kui kõrgelt uude kohta, kui laialt võtta, kui kõrgelt võtta
		imagecopyresampled($newImage, $image, 0, 0, 0, 0, $w, $h, $origW, $origH);
		return $newImage;
	}*/
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
	<<h1>piltide üleslaadimine</h1>
	<p>See leht on loodud õppetöö raames ning ei sisalda mingit tõsiseltvõetavat sisu.</p>
	<p><a href="?logout=1">Logi välja!</a></p>
	<p><a href="main.php">Tagasi pealehele</a></p>
	<hr>
	<h2>Foto üleslaadimine</h2>
	<form action="photoupload.php" method="post" enctype="multipart/form-data">
		<label>Valige pildifail:</label>
		<input type="file" name="fileToUpload" id="fileToUpload">
		<input type="submit" value="Lae üles" name="submit">
	</form>
	
	<span><?php echo $notice; ?></span>
	<hr>
</body>
</html>
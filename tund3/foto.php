<?php
	//muutujad
	$myName = "Silver";
	$myFamilyName = "Kaugemaa";
	$picDir = "../../pics/";
	$picFileTypes = ["jpg", "jpeg", "png", "gif"];
		$picFiles = [];
		$allFiles = array_slice(scandir($picDir), 2);
		foreach ($allFiles as $file){
			$fileType = pathinfo($file, PATHINFO_EXTENSION);
			if(in_array($fileType, $picFileTypes) == true){
				array_push($picFiles, $file);
			}
		}//foreach lõppeb
		//var_dump($allFiles);
		$picFiles = array_slice($allFiles, 2);
		//var_dump($picFiles);
		$picFilesCount = count($picFiles);
		$picNumber = mt_rand(0, $picFilesCount - 1);
		$picFile = $picFiles[$picNumber];
		
	

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
	

	
	<img src="<?php echo $picDir .$picFile; ?>" alt="Tallinna Ülikool">
	
</body>
</html>
<?php
$database="if17_kaugsilv";

	//aslustama sessiooni
	session_start();
	
	//sisselogimise funktsioon
	function signIn($email, $password){
		$notice ="";
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		$stmt = $mysqli ->prepare("SELCET id, email, password FROM vp_users WHERE email = ?");
		$stmt->bind_param("s",$email);
		$stmt->bind_result($id, $emailFromDB, $passwordFromDb);
		$stmt->execute();
		
		//kontrollime kasutajat
		if($stmt->fetch()){
			$hash = hash("shs512", $password);
			if($hash == $passwordFromDb){
				$notice = "Kõik korras, logisimegi sisse!";
				//salvestan sessioonimuutujad
				$_SESSION["userId"] = $id;
				$_SESSION["userEmail"] = $email;
			
		
				//liigume pealehele
				header("location: main.php");
				exit();
		} else {
				$notice = "Sisestasite vale salasõna!";
			}
	} else {
			$notice = "Sellist kasutajat (" .$email .") ei ole!";
		}
		return $notice;
	}
		
	//uue kasutaja andmebaas ilisamine
	function signup($signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword){
		//loome andmebaasiühenduse
		
		
		$mysqli = new mysqli($GLOBALS["serverHost"], $GLOBALS["serverUsername"], $GLOBALS["serverPassword"], $GLOBALS["database"]);
		//valmistame ette käsu andmebaasiserverile
		$stmt = $mysqli->prepare("INSERT INTO vp_users (firstname, lastname, birthday, gender, email, password) VALUES (?, ?, ?, ?, ?, ?)");
		echo $mysqli->error;
		//s - string
		//i - integer
		//d - decimal
		$stmt->bind_param("sssiss", $signupFirstName, $signupFamilyName, $signupBirthDate, $gender, $signupEmail, $signupPassword);
		//$stmt->execute();
		if ($stmt->execute()){
			echo "\n Õnnestus!";
		} else {
			echo "\n Tekkis viga : " .$stmt->error;
		}
		$stmt->close();
		$mysqli->close();
	}
// sistuse kontrollimine
	function test_input($data){
		$data = trim($data); //eemaldab lõpust tühiku, tab vm asja
		$data = stripslashes($data); //eemaldab "\"
		$data = htmlspecialchars($data); //eemaldab keelatud märgid
		return $data;
	}
		
	/*$x = 8;
	$y = 5;
	echo"esimene summa on" ,($x+$y);
	addValues();
	
	function addValues(){
			$a = 2;
		$b = 1;
		echo"kolmas summa on" ,($a+$b);
	}
	
	echo"neljas summa on" ,($a+$b);*/
	
?>
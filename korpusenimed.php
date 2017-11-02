<?php
	
	$mysqli=new mysqli ("Localhost", "if17", "if17", "if17_keelekorpus");
	$mysqli->query("SET NAMES utf8");
	$stmt=$mysqli->prepare(" SELECT COALESCE(keeletase,'määrmata') AS keeletase, COUNT(*)AS kogus, COUNT(*)/(SELECT COUNT(*) FROM dokmeta) AS suhe FROM dokmeta GROUP BY dokmeta.keeletase");
		if(empty($_REQUEST["emakeel"])){
			$otsiemakeel="soome";
		} else{
			$otsiemakeel=$_REQUEST["emakeel"];
		}
	$stmt->bind_result($tulp1, $tulp2, $tulp3);
	$stmt->execute();
	
?>

<!DOCKTYPE html>
<html>
	<head>
	</head>
	<body>
	<h1>KEELETASEMED</h1>
		
		<table>
			<?php
				while($stmt->fetch()){
				echo "<tr><td>$tulp1</td><td>$tulp2</td><td>$tulp3</td></tr>\n";
			}
			?>
			</table>
		</body>
	</html>
<?php
	$mysqli->close();
?>
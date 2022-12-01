<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Startseite</title>
</head>
<body>
		<h1>Informatik 2 im Web</h1>
		<p>Dies wird eine kleine Webanwendung</p>
		<?php
			/* Einbinden von PHP Dateien:
			   Reihenfolge der Einbindung beachten, 
			   damit die Funktion vorhanden sind, 
			   wenn sie benötigt werden. 
			*/
			include 'includes/functions.inc.php';
			include 'includes/test.inc.php';
			include 'includes/dbconnect.inc.php';
			
		?>
			<form action="index.php" method="post">
				<p><input name="vor">Vorname</p>
				<p><input name="nach">Nachname</p>
				<p><input name="gesendet" type="submit"></p>
			</form>	
		
</body>
</html>

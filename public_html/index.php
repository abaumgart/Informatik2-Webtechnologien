<!doctype html>
<html>
<head>
	<meta charset="UTF-8">
	<title>Startseite</title>
	 <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
		if(isset($_POST["gesendet"]))
			{
				$selektionsdatum = $_POST["tagesauswahl"];
				echo ("Selektiertes Datum: ".$selektionsdatum."<br>");
			}else
			{		
				$selektionsdatum ="2022-06-01";

			}
	
			include 'includes/functions.inc.php';
			
			include 'includes/dbconnect.inc.php';
	
		/* Daten auslesen für den Datumspicker */
	
			$queryDateStartEnd = "SELECT min(date(zeitstempel)) as startdate,
		max(date(zeitstempel)) as enddate from energieverbrauch;";
			$resultStartDate = mysqli_query($con,$queryDateStartEnd);
			while($row=mysqli_fetch_array($resultStartDate))
				{
					echo $row['startdate'].",".$row['enddate'];
				$startdate=$row['startdate'];
				$enddate=$row['enddate'];
			}
		?>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawVisualization);

		
      function drawVisualization() {
        // Some raw data (not necessarily accurate)
        var data = google.visualization.arrayToDataTable([
          ['Zeit', '01.06.2022'],
			<?php
				$queryData = "select 
								date_format(zeitstempel, \"%H\") as 'zeitstempel',
								wert as 'Verbrauch' 
								from energieverbrauch 
								where zeitstempel between '2022-06-01 01:00:00' 
								and '2022-06-01 23:00:00';";
			$queryDataExec= mysqli_query($con,$queryData);
			while($rowData=mysqli_fetch_array($queryDataExec))
			{
				echo "['".$rowData['zeitstempel']."',".$rowData['Verbrauch']."],";
			}
         ?>
        ]);
			
        var options = {
          title : 'Energieverbrauch',
          vAxis: {title: 'Verbrauch'},
          hAxis: {title: 'Uhrzeit'},
          seriesType: 'bars',
          series: {5: {type: 'line'}}
        };

        var chart = new google.visualization.ComboChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
			<form action="index.php" method="post">
			<label for="tagesauswahl">Bitte Startdatum wählen</label>
				<input type="date" name="tagesauswahl" id="tagesauswahl" min="<?php echo $startdate ?>"
					   max="<?php echo $enddate ?>" value="<?php echo$startdate ?>">
				<p><input name="gesendet" type="submit"></p>
			</form>	
	<div id="chart_div" style="width: 900px; height: 500px;"></div>	
</body>
</html>

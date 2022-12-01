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
			include 'includes/functions.inc.php';
			include 'includes/test.inc.php';
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
          ['Month', 'Bolivia', 'Ecuador', 'Madagascar', 'Papua New Guinea', 'Rwanda', 'Average'],
          ['2004/05',  165,      938,         522,             998,           450,      614.6],
          ['2005/06',  135,      1120,        599,             1268,          288,      682],
          ['2006/07',  157,      1167,        587,             807,           397,      623],
          ['2007/08',  139,      1110,        615,             968,           215,      609.4],
          ['2008/09',  136,      691,         629,             1026,          366,      569.6]
        ]);

        var options = {
          title : 'Monthly Coffee Production by Country',
          vAxis: {title: 'Cups'},
          hAxis: {title: 'Month'},
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

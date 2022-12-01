<?php
function begruessung($vorname)
	{
		echo("Nachricht aus der Funktion");
	}







function folgeTageBerechnen($datum, $anzahlTage)
		{
			$zeitstring = "$anzahlTage days";
			$datumObj = date_create($datum);
			$datumPlusNTage = date_add($datumObj,date_interval_create_from_date_string($zeitstring));
			$ergebnis = $datumPlusNTage -> format('Y-m-d');
			//echo("Testausgabe: Datum: $datum FolgeWoche: $ergebnis");
			// Das Ergebnis liegt in einer Form vor, die als Kriterium in der Where-Klausel verwendet wird.
			return $ergebnis;
		}
	
function legendedatum($legendeDatum)
{
	$legendeDatumObject = date_create($legendeDatum);
	return date_format($legendeDatumObject,"d.m.Y");
}
		
		
	
function dbabfrage( $datum, $stunde)
{
	include 'includes/dbconnect.inc.php'; 
	$a = date_create($datum);
	$b = folgeTageBerechnen($datum,1);
	//echo("Datum: ".$datum."Tags drauf: ".$b);
	$kdatum=  ($a -> format('Y-m-d'));
		if($stunde<10)
		{
			$stunde="0".$stunde;
		} else
			{
					$stunde = $stunde;
			}
	//echo("Stunde: ".$stunde);
	
	if($stunde=='00')
		{
			$kriterium = $b." 00:00:00";
		}
		else
			{
				$kriterium = $kdatum." ".$stunde.":00:00";
			}
	
	//echo("Kriterium:".$kriterium);
	$queryeinzelwert = "select 
						wert as wert
						from energieverbrauch
						where  zeitstempel = '$kriterium'";

	 $execEinzelwert = mysqli_query($con,$queryeinzelwert);
		while($rowEinzelwert = mysqli_fetch_array($execEinzelwert))
		{
		 //echo "wert:".$rowEinzelwert['wert'];
		 $wert = $rowEinzelwert['wert'];
		}
	return $wert;
}
?>
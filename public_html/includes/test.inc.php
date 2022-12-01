<?php
	if(isset($_POST["gesendet"]))
				{
					echo"Hallo ".$_POST["vor"]." ".$_POST["nach"];
					begruessung($_POST["vor"]);
				} else
					{
						echo("Noch keine Eingabe erfolgt.");
					}
?>
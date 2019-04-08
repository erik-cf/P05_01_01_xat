<?php include('connexioBD.php'); ?>
<!DOCTYPE html>
<html lang="ca">
 <head>
  <meta charset="UTF-8" />
  <title>xateja-ho!</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
 <section id="titol">
 <h1>xateja-ho!</h1>
 </section>
 <section id="missatges">
<?php


$consulta = "SELECT * FROM missatges ORDER BY id DESC LIMIT 10";
$resultat = mysqli_query($connexio, $consulta);

while ($fila = mysqli_fetch_assoc($resultat)) {
	$missatge = "<p><span>".$fila['hora']." - ".$fila['usuari'].": </span>".$fila['text']."</p>";
	echo $missatge;
}

mysqli_free_result($resultat);
mysqli_close($connexio);
?>
 </section>
 <section id="formulari">
 <form method="post" action="insertar.php">
 <p>Usuari: <input type="text" name="usuari" /></p>
<p>Missatge: <input type="text" name="missatge" /></p>
<p><input type="submit" value="Enviar missatge" /></p>
 </form>
 </section>
 <?php
 	if(isset($_GET['newmsg'])){
 ?>
 <section id="newmsg">
 <p>Missatge inserit correctament</p>
 <?php
 	}
 ?>
 </section>
 <?php
 if(isset($_GET['error'])){ ?>
 <section id="errors">
 <p>ERRORS:</p>
 <?php
 	if($_GET['error'] == 'nouservalue'){
 		echo "ERROR: L'usuari no té valor!";
 	}elseif($_GET['error'] == 'nomsgvalue'){
 		echo "ERROR: El missatge no té valor!";
 	}
 ?>
 </section>
 <?php } ?>
 </body>
</html>
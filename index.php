<?php include('connexioBD.php'); ?>
<!DOCTYPE html>
<html lang="ca">
 <head>
  <meta charset="UTF-8" />
  <title>xateja-ho!</title>
  <link rel="stylesheet" type="text/css" href="css/style.css" />
 </head>
 <body>
 <section id="wrapper">
 <section id="titol">
 <h1>Xateja-Ho!</h1>
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
   <table border=0>
    <tr>
     <td><p>Usuari: </p></td><td><p>
     <?php if(isset($_GET['user'])){
 	    print("<input type='text' name='usuari' value=".$_GET['user']." />");
     }else{
 	    print("<input type='text' name='usuari' />");
     }
     ?>
     </p></td></tr>
    <tr>
     <td><p>Missatge: </p></td><td><p>
     <?php
      if(isset($_GET['msg'])){
 	    print("<input type='text' name='missatge' value=".$_GET['msg']." />");
      }else{
 	    print("<input type='text' name='missatge' />");
      }
     ?>
     </p></td>
    </tr>
    <tr>
     <td colspan="2">
      <p><input type="submit" value="Enviar missatge" /></p>
     </td>
    </tr>
   </table>
  </form>
 </section>
 <?php
 	if(isset($_GET['newmsg'])){
 ?>
 <section id="newmsg">
 <p>Missatge inserit correctament. Si no es veu, actualitza la pàgina.</p>
 </section>
 <?php
 	}
 ?>
 <?php
 if(isset($_GET['error'])){ ?>
 <section id="errors">
 <p>Llistat de errors:</p>
 <?php
  	if(isset($_GET['nouser'])){
 		echo "<p class='errormsg'>ERROR: L'usuari no té valor!</p>";
 	}
 
 	if(isset($_GET['nomsg'])){
 		echo "<p class='errormsg'>ERROR: El missatge no té valor!</p>";
 	}
 
 	if(isset($_GET['noinsert'])){
 		echo "<p class='errormsg'>ERROR: No s'ha pogut insertar les dades: ".$_GET['sqlerr']."</p>";
 	}
 ?>
 </section>
 <?php } ?>
 </section>
 </body>
</html>
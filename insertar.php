<?php
	include('connexioBD.php');
	if(!isset($_POST['usuari']) || empty($_POST['usuari'])){
		if(!empty($_POST['missatge'])){
			header("Location: index.php?error=nouservalue&msg=".$_POST['missatge']);
			exit();
		}else{
			header("Location: index.php?error=nouservalue");
			exit();	
		}
		
	}elseif(!isset($_POST['missatge']) || empty($_POST['missatge'])){
		header("Location: index.php?error=nomsgvalue&user=".$_POST['usuari']);
		exit();
	}else{
		$hora = localtime(time(), false);
		$missatge = mysqli_real_escape_string($connexio, $_POST['missatge']);
		$usuari = $_POST['usuari'];
	
		$insert = "INSERT INTO missatges(usuari, text, hora) VALUES ('".htmlspecialchars($usuari)."', '".htmlspecialchars($missatge)."', '".date("H:i:s")."')";
		if ($connexio->query($insert) === TRUE) {
    		header("Location: index.php?newmsg=true");
		} else {
    		header("Location: index.php?error=noinsert&value=".$connexio->error);
    		echo "No s'ha pogut fer l'insert: " . $insert . "<br />" . $connexio->error;
		}
	}
?>
<?php
	include('connexioBD.php');
	if(!isset($_POST['usuari']) || empty($_POST['usuari'])){
		if(!empty($_POST['missatge'])){
			header("Location: index.php?error=true&nouser=true&msg=".$_POST['missatge']);
			exit();
		}else{
			header("Location: index.php?error=true&nouser=true&nomsg=true");
			exit();	
		}
	}elseif(!isset($_POST['missatge']) || empty($_POST['missatge'])){
		header("Location: index.php?error=true&nomsg=true&user=".$_POST['usuari']);
		exit();
	}else{
		$missatge = mysqli_real_escape_string($connexio, $_POST['missatge']);
		$usuari = mysqli_real_escape_string($connexio, $_POST['usuari']);
		$insert = "INSERT INTO missatges(usuari, text, hora) VALUES ('".htmlspecialchars($usuari)."', '".htmlspecialchars($missatge)."', '".date("H:i:s")."')";
		if ($connexio->query($insert) === TRUE) {
    		header("Location: index.php?newmsg=true");
		} else {
    		header("Location: index.php?error=true&noinsert=".$connexio->error);
		}
	}
?>
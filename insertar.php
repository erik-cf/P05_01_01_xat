<?php
	include('connexioBD.php');
	if(!isset($_POST['usuari']) || empty($_POST['usuari'])){
		if(!empty($_POST['missatge'])){
			header("Location: index.php?error&nouser&msg=".$_POST['missatge']);
			exit();
		}else{
			header("Location: index.php?error&nouser&nomsg");
			exit();	
		}
	}elseif(!isset($_POST['missatge']) || empty($_POST['missatge'])){
		header("Location: index.php?error&nomsg&user=".$_POST['usuari']);
		exit();
	}else{
		$missatge = mysqli_real_escape_string($connexio, $_POST['missatge']);
		$usuari = mysqli_real_escape_string($connexio, $_POST['usuari']);
		$insert = "INSERT INTO missatges(usuari, text, hora) VALUES ('".htmlspecialchars($usuari)."', '".htmlspecialchars($missatge)."', '".date("H:i:s")."')";
		if ($connexio->query($insert) === TRUE) {
    		header("Location: index.php?newmsg");
    		exit();
		} else {
    		header("Location: index.php?error&noinsert=".$connexio->error);
    		exit();
		}
	}
?>
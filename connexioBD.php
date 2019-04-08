<?php
$connexio = mysqli_connect('localhost', 'root', '', 'xat');
if (mysqli_connect_errno()) {
	echo 'Ha fallat la connexió a MySql: '.mysqli_connect_error();
}
?>
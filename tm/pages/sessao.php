<?php
    ob_start();
    @session_start();

	if($_SESSION['id_usuario'] == "")
		header("location: login.php");
?>
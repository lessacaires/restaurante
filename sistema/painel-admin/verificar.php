<?php
@session_start();

if($_SESSION['nivel'] != 'Administrador'){
	echo "<script type='text/javascript'>window.location='../'</script>";
	exit();
}
?>
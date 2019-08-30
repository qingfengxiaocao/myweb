
<?php
	////session_start();
	//unset($_SESSION['user']);
	header("Location: ?logout=$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF']");
?>
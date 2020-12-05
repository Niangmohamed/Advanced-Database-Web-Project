<?php

	$serverName = "MOHAMED\ITS4_2008"; //serverName\instanceName
	$connectionInfo = array( "Database"=>"rgphm5", "UID"=>"sa", "PWD"=>"LEAVEMEALONE1994");
	$conn = sqlsrv_connect( $serverName, $connectionInfo);

	if( $conn ) {
		echo "<p style='display:none'>Connexion établie</p><br />";
	}
	else
	{
		echo "La connexion n'a pu être établie.<br />";
		die( print_r( sqlsrv_errors(), true));
	}
?>
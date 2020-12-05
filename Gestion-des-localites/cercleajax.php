<?php                       				  
	if(isset($_POST['code'])){	
	include('includes/config.php');

	$cercle=sqlsrv_query($conn,"SELECT * FROM cercle WHERE coderegion=".$_POST['code']);

	echo "<option value='-1'>Sélectionner le cercle</option>";
	while ($row=sqlsrv_fetch_array($cercle, SQLSRV_FETCH_NUMERIC)) 
	   { 
		 echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
	   }    

	}	
?>	
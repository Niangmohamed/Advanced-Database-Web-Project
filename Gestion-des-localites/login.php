<?php
session_start ();
$loginOK=false;
include('includes/config.php');
$login = trim($_POST['user']);
$password = trim($_POST['pwd']); 
 
if (empty($_POST['user']) || empty($_POST['pwd'])) { 
echo'<body onLoad="alert(\'Vous devez verifier le formulaire authentification...\')">';
echo '<meta http-equiv="refresh" content="0;URL=login.html">';
}else{
$query = "SELECT * FROM agent where idagent='$login' and motdepasse='$password'";
$results = sqlsrv_query($conn, $query) or die ("echec de l'exécution de la requête<br>."  . sqlsrv_error());
   if($results){
   $data = sqlsrv_fetch_array($results, SQLSRV_FETCH_ASSOC);
   $loginOK=true;
   }else{echo'<body onLoad="alert(\'Cet agent est non reconu dans le systeme...\')">';
   echo '<meta http-equiv="refresh" content="0;URL=login.html">';
   }
}
if($loginOK){
   $_SESSION['idagent']=$data['idagent'];
   $_SESSION['motdepasse']=$data['motdepasse'];
   $_SESSION['prenom_nom']=$data['prenom_nom'];
   $_SESSION['numero_equipe']=$data['numero_equipe'];
   $_SESSION['idrole']=$data['idrole'];
   echo '<meta http-equiv="refresh" content="0;URL=gestion.php">';
}else{
echo'Une erreur est survenue lors de ouverture de la session essayer de nouveau';
}
?>
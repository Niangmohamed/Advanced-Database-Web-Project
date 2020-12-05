<?php
session_start();
include('includes/config.php');
//$recherche=$_GET['recherche'];
if (isset($_SESSION['idagent']) || isset($_SESSION['motdepasse'])){
?>
<html>

<head>
    <title>Gestion des Communes</title>
    <link href="css/stylecommune.css" rel="stylesheet" type="text/css">
</head>

<body>
    <div>
        <div><img src="images/recensement_population.jpg" id="entete" /></div>
        <div style="margin-bottom:3px;"></div>
        <div id="milieu">
            <div class="menugauche">
                <div class="menu a" style="border-bottom-width:1px; border-bottom-style:solid;">
                    <div style="background-color:gray; color:white; padding:8px;  -moz-border-radius: 6px; -webkit-border-radius: 6px; font-size:30px;"><strong><i>M</i>enu</strong>&nbsp;&nbsp;<a
                            href="gestion.php"><img height="40" width="30" src="images/bg-01.jpg" alt="Accueil" /></a></div>
                    <div style="margin-bottom:2px;"></div>
                    <div class="lienmenu"><a href="questionnaire_rgphm5.php">&nbsp;&nbsp;<strong>
                                <center>Enregistrer un questionnaire</center>
                            </strong></a></div>
                    <div style="margin-bottom:2px;"></div>
                    <div class="lienmenu"><a href="creer_equipe.php">&nbsp;&nbsp;<strong>
                                <center>Créer des équipes et ses membres</center>
                            </strong></a></div>
                    <div style="margin-bottom:2px;"></div>
                    <div class="lienmenu"><a href="gestion_import.php">&nbsp;&nbsp;<strong>
                                <center>Importer un fichier contenant la liste des agents</center>
                            </strong></a></div>
                    <div style="margin-bottom:2px;"></div>
                    <div class="lienmenu"><a href="gestion_localite.php">&nbsp;&nbsp;<strong>
                                <center>Gestion des localités</center>
                            </strong></a></div>
                    <div style="margin-bottom:2px;"></div>
                    <div class="lienmenu"><a href="gestion_export.php">&nbsp;&nbsp;<strong>
                                <center>Exporter le contenu d'une vue</center>
                            </strong></a></div>
                    

                </div>
                <div>
					<br />
                    Utilisateur connect&eacute;<br /><br />
                    <span style="color:red; font-family:arial; font-size:16px;">
                        <?php echo ucfirst($_SESSION['prenom_nom']);?></span><br /><br /><br /><br /><br /><br /><br />
                    <a href="logout.php">Deconnexion</a>
                </div>
                <br /><br /><br /><br />
            </div>
            <div id="contenu1">


                <br />
                <div><img src="images/rgph.jpg"/></div>
                <br /><br />
            </div>
        </div>
        <div style="margin-bottom:2px; clear:both"></div>
        <div id="pied">
            D&eacute;v&eacute;lopp&eacute;e par Mohamed NIANG<br />Copyright@ITS 2019. Tout droit reserv&eacute;
        </div>
    </div>
</body>
</html>
<?php
}
else{
	?>
<SCRIPT LANGUAGE="JAVASCRIPT">
alert("Vous etes non reconu, veuillez vous identifier...");
</SCRIPT>
<?php
	echo'<meta http-equiv="refresh" content="0; URL=login.html">';}
?>
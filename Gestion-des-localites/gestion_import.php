<?php
session_start();
include('includes/config.php');
if (isset($_SESSION['idagent']) || isset($_SESSION['motdepasse'])){
?>
<html>

<head>
    <title>Gestion des Communes</title>
    <link href="css/stylecommune.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="css/sweetalert2.min.css">
    <script src="js/sweetalert2.min.js"></script>
    <script src="js/sweetalertall.js"></script>
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
            <div id="contenu1" >
            <br />
              <form class="row" action="?" method="post" enctype="multipart/form-data">
                    <fieldset >
                    <legend class="titrequest">IMPORTER UN FICHIER CSV</legend>
                    <input class="basic-slide" type="file" name="agents" id="agents">
                    </fieldset ><br>
                    <input class="basic-slide" type = "submit" value = "IMPORTER" name="importer" id="importer">
              </form>

              <?php  
                    if(isset($_POST["importer"])) {                        
                        $test=false;
                        $target_dir = "import/";
                        $target_file = $target_dir.basename($_FILES['agents']['name']);
                        $FileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

                        if($FileType !='csv'){
                            echo '<script>sweetalert2();</script>';
                        }
                        else{
                        include('includes/config.php');
                        $row = 1;
                        $Requete="";

                        if (($handle=fopen($target_file, "r"))!==FALSE) {
                            while (($data=fgetcsv($handle,100, ";"))!==FALSE) {
                                if ($row!=1) {
                                  $ligne=count($data);
                                  $Requete="INSERT into agent values";
                                  $Requete.="('";
                                  for ($col=0; $col < $ligne; $col++) {
                                  $Requete.=$data[$col]."','";
                                  }
                                  $Requete=substr($Requete,0,-2);
                                  $Requete.=")";
                                  $ressource=sqlsrv_query($conn,$Requete);
                                }
                                $row++;
                            }
                            fclose($handle);
                                echo '<script>sweetalert2_2();</script>';
                        }
                    }
                    }
                    ?>

            <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
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
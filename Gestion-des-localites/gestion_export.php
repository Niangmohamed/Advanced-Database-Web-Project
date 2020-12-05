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
                <br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br /><br />
            </div>
            <div id="contenu1" >
            <br />
              <form class="row" action="?" method="post" enctype="multipart/form-data">
                    <fieldset >
                    <legend class="titrequest">EXPORTER LA LISTE DES AGENTS</legend>
                    </fieldset >

                    <?php
                $sql = "SELECT * FROM V_AGENT ORDER BY controleur" ;
                $res = sqlsrv_query($conn,$sql);
            
                $tab_idagent = array();
                $tab_pwd = array();
                $tab_agent = array();
                $tab_chef = array();
                $tab_control = array();
                while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_NUMERIC)) {
                    $tab_idagent[]=$row[0];
                    $tab_pwd[]=$row[1];
                    $tab_agent[]=$row[2];
                    $tab_chef[]=$row[3];
                    $tab_control[]=$row[4];
                }
            
                
                $tab="<fieldset>";
                $tab.="<h2 class='lienmenu'><center>LISTE DES AGENTS</center></h2>";
                $tab.="<table width='100%' border='3' style='text-align:center;'><tr><th class='lienmenu'>Identifiant</th><th class='lienmenu'>Mot de passe</th><th class='lienmenu'>Agent</th><th class='lienmenu'>Chef d'équipe</th><th class='lienmenu'>Controleur</th></tr>";
                $req_agent=" SELECT COUNT(*) FROM V_AGENT ";
                $res_agent=sqlsrv_query($conn,$req_agent);
                $nb = sqlsrv_fetch_array($res_agent,SQLSRV_FETCH_NUMERIC);
                for ($i=1; $i <=$nb[0] ; $i++) {
                    $tab.="<tr><td class='lienmenu' width='20%'>".$tab_idagent[$i-1]."</td>";
                    $tab.="<td class='lienmenu' width='20%' >".$tab_pwd[$i-1]."</td>";                      
                    $tab.="<td class='lienmenu' width='20%'>".$tab_agent[$i-1]."</td>";
                    $tab.="<td class='lienmenu' width='20%'>".$tab_chef[$i-1]."</td>";
                    $tab.="<td class='lienmenu' width='20%'>".$tab_control[$i-1]."</td>";
                    $tab.="</tr>"; 
                }
                $tab.="</table></fieldset>";
                echo $tab;
            
            ?>



                    <br>
                    <input class="basic-slide" type = "submit" value = "EXPORTER" name="exporter" id="exporter">
              </form>

              <?php  
                    if(isset($_POST["exporter"])) {
                        $query = "SELECT * FROM v_agent";
                        $result = sqlsrv_query($conn, $query);
                        $fp = fopen('vue_agent/vue_agent.csv', 'w');
                        while($res=sqlsrv_fetch_array($result,SQLSRV_FETCH_NUMERIC)) {
                            fputcsv($fp, $res);
                        }

                        fclose($fp);

                        echo '<script>sweetalert3();</script>';
                    }
                    ?>
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
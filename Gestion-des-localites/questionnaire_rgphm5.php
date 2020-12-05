<?php
	include('includes/config.php');
?>

<!DOCTYPE html>

	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title>RGPHM5 (FICHE COMMUNE)</title>
		<link rel="stylesheet" href="css/stylequest.css">
		<link rel="stylesheet" href="css/sweetalert2.min.css">
		<script type="text/javascript" charset="utf-8" src="ajax.js"></script>
		<script src="js/sweetalert2.min.js"></script>
		<script src="js/sweetalertall.js"></script>

	</head>

	<body>
		<div align="center">
		  <h1><strong>5ème Recensement Généralde la population et de l’Habitat du Mali (RGPH5) <br /></strong></h1>
		  
		  <h2 class="titrequest">QUESTIONNAIRE FICHE COMMUNE</h2>
		</div>

			<center>
			<form class="row" id="form" name="forme" method="post">
				
                <div id="IDENTIFIANTS GEOGRAPHIQUES">
		
					<h2 class="section">IDENTIFIANTS GEOGRAPHIQUES </h2>

					<table width="90%" border="3" >
							<tr>
								<td style="background-color: #7AB893; color: white;" width="35%" align="left" valign="left">RÉGION </td>
								<td width="20%" align = "left">
									
							  
							   
							   <select class='basic-slide' name='region' id='region' onchange='chargement("region", "cercle", "cercleajax.php");chargement("cercle", "commune", "communeajax.php");' required>

							   	<option value=''>Sélectionner la région</option>
							   <?php                       				  
							 	$region=sqlsrv_query($conn,"SELECT * FROM region");
							   
							   while ($row=sqlsrv_fetch_array($region, SQLSRV_FETCH_NUMERIC)) 
								   { 
									 echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
								   }    
														
								?>	
							  </select>
							  </td>
								<td style="background-color: #7AB893; color: white;" width="26%">CERCLE</td>
								<td width="24%" align = "right">
                   				  
							   <select class='basic-slide' name='cercle' id='cercle' onchange='chargement("cercle", "commune", "communeajax.php");' required>
									<option value='-1'>Sélectionner le cercle</option>
							   </select>
						
								</td>
						  </tr>
					</table>

						<table width="90%" border="3" >
							<tr>
								<td style="background-color: #7AB893; color: white;" width="69%">COMMUNE</td>
								<td width="1%" align = "right">
								
								<select class='basic-slide' id="commune" name="commune" onchange='chargement("commune", "localite", "localiteajax.php");' required>
									<option value='-1'>Sélectionner une commune</option>
                    			</select>
							   
								</td>
							</tr>  
						</table>
						
						<table width="90%" border="3" >
							<span>
							<tr>
								<td style="background-color: #7AB893; color: white;" width="25%" align="left" valign="middle">NOM DU REPONDANT</td>
								<td width="20%" align = "right"><input class="basic-slide" name="nom_rep" type="text" placeholder="NOM DU REPONDANT"/></td>
									
								<td style="background-color: #7AB893; color: white;" width="25%">FONCTION</td>
								<td width="14%" align = "right">
									<?php                       				  
							 
							  $fonction=sqlsrv_query($conn,"SELECT * FROM fonction") or die ("Erreur Requête fonction"); 
							   
							   echo "<select class='basic-slide' name='fonction' required>";
							   
							   echo "<option value=''>Sélectionner la fonction</option>";
							   while ($row=sqlsrv_fetch_array($fonction, SQLSRV_FETCH_NUMERIC)) 
								   { 
									 echo "<option value='".$row[0]."'>".$row[1]."</option>"; 
								   }    
							echo "</select>";					
						?>	
								</td>
								<td style="background-color: #7AB893; color: white;" width="38%">AUTRE FONCTION</td>
								<td width="19%" align = "right"><input class='basic-slide' name="autrfonction" type="text" placeholder="AUTRE FONCTION"/></td>
							</tr>
							</span>
						</table>
						
						<table width="90%" border="3" >
							<tr>
								<td style="background-color: #7AB893; color: white;" width="80%">MILIEU</td>
								<td width="15%" align = "right">
									<?php                       				  
							 
							  $milieu=sqlsrv_query($conn,"SELECT * FROM milieu") or die ("Erreur Requête milieu"); 
							   
								   echo "<select class='basic-slide' name='milieu' required>";
							   
                               echo "<option value=''>Sélectionner le milieu</option>";							   
							   while ($row=sqlsrv_fetch_array($milieu, SQLSRV_FETCH_NUMERIC)) 
								   { 
									 echo "<option value='".$row[0]."'>".$row[1]."</option>";  
								   }    
							echo "</select>";					
						?>	
								</td>
							</tr>  
						</table>
						
						<table width="90%" border="3" >
							<tr>
								<td style="background-color: #7AB893; color: white;" width="25%">LATITUDE</td>
								<td width="19%" align = "right"><input class='basic-slide' name="latitude" type="text" placeholder="LATITUDE"/></td>
									
								<td style="background-color: #7AB893; color: white;" width="29%">LONGITUDE</td>
								<td width="19%" align = "right"><input class='basic-slide' name="longitude" type="text" placeholder="LONGITUDE"/></td>
								
								<td style="background-color: #7AB893; color: white;" width="29%">ALTITUDE</td>
								<td width="15%" align = "right"><input class='basic-slide' name="altitude" type="text" placeholder="ALTITUDE"/></td>
							</tr>
						</table>
						
						<table width="90%" border="3">
							<td style="background-color: #7AB893; color: white;" width="40%">Dernière date du recensement</td> 
							<td style="background-color: #7AB893; color: white;" width="10%">MOIS </td> 
							<td width="5%" align="center"><select class='basic-slide' name="mois" size="1" required>
							  <option value="">Sélectionner le mois</option>
							  <option value="01">Janvier</option>
							  <option value="02">Février</option>
							  <option value="03">Mars</option>
							  <option value="04">Avril</option>
							  <option value="05">Mai</option>
							  <option value="06">Juin</option>
							  <option value="07">Juillet</option>
							  <option value="08">Aout</option>
							  <option value="09">Septembre</option>
							  <option value="10">Octobre</option>
							  <option value="11">Novembre</option>
							  <option value="12">Decembre</option>
							</select></td> 
							
							<td style="background-color: #7AB893; color: white;" width="31%">ANNEE</td>
							<td width="19%" align = "right"><input class='basic-slide' name="annee" type="text" placeholder="ANNEE" required/></td>
						  </tr>  
						</table>
		
			</div>
			

		 	<br><br>
		 	<center>
		 	<h2 class="section"> LOCALITES </h2>
            <div id='localite'></div>
            </center>
            <br><br>

        <center>
		<h2 class="section"> AGENT </h2>
			<fieldset>
                <legend>Contrôleur</legend>
                <div>
                    <label style="background-color: #7AB893; color: white;" for="name">Nom</label>
                    <input class="basic-slide" id="nom_cont" type="text" name="nom_cont" required>
                </div><br>
                <div>
                    <label style="background-color: #7AB893; color: white;" for="name">Date</label>
                    <input class='basic-slide' id="date_cont" type="date" name="date_cont" required>
                </div>
            </fieldset>
            <br><br><br>
            <fieldset>
                <legend>Chef d'équipe</legend>
                <div>
                    <label style="background-color: #7AB893; color: white;">Nom</label >
                    <input class='basic-slide' type="text" name="nom_chef" required>
                </div><br>
                <div>
                    <label style="background-color: #7AB893; color: white;" for="name">Date</label>
                    <input class='basic-slide' type="date" name="date_chef" required>
                </div>
            </fieldset>
            </center>
			
			<br>

			<div>
					<center>
					<table class='row' border="2">
						<tr>
							<td id="envoyer"><input class='basic-slide' type="submit" name="enreg" onclick="sweetalert()" value="Envoyer le formulaire saisi"/></td>
						</tr>
					</table>
					</center>
			</div>

			
			
			<?php
                // déclaration des variables pour stocker les réponses
                if (isset($_POST['enreg'])){
                    include('includes/config.php');
                    
                    $region=$_POST['region'];
                    $cercle=$_POST['cercle'];
                    $commune=$_POST['commune'];
                    $milieu=$_POST['milieu'];
                    $repondant=$_POST['nom_rep'];
                    $fonction=$_POST['fonction'];
                    $autrefonction=$_POST['autrfonction'];
                    $latitude=$_POST['latitude'];
                    $longitude=$_POST['longitude'];
                    $altitude=$_POST['altitude'];
                    $mois=$_POST['mois'];
                    $annee=$_POST['annee'];
                    $controleur=$_POST['nom_cont'];
                    $date_control=$_POST['date_cont'];
                    $chef_equip=$_POST['nom_chef'];
                    $date_chef_equip=$_POST['date_chef'];
                    $test=false;
                    $localite=[];
                    $pop_masc=[];
                    $pop_fem=[];
                    $sql_loc=[];
                    $result=[];

                    $req_loc=" SELECT COUNT(*) AS loc_size FROM localite WHERE idcommune=" . $commune;
                    $res_loc=sqlsrv_query($conn,$req_loc);
                    $nb = sqlsrv_fetch_array($res_loc, SQLSRV_FETCH_NUMERIC);

                    for ($i=1; $i <=$nb[0] ; $i++) { 
                        $localite[$i-1]='localite'.$i;
                        $$localite[$i-1]=$_POST['loc'.$i];

                        $pop_masc[$i-1]='pop_masc'.$i;
                        $$pop_masc[$i-1]=$_POST['pop_masc'.$i];

                        $pop_fem[$i-1]='pop_fem'.$i;
                        $$pop_fem[$i-1]=$_POST['pop_fem'.$i];

                        $sql_loc[$i-1]='sql_loc'.$i;
                        $result[$i-1]='result'.$i;
                    }
  
                    // testons si la fiche est dèja enregistrée
                    $sql_commune="SELECT * FROM fiche_commune";
                    $comm=sqlsrv_query( $conn, $sql_commune);
                    
                    while( $row = sqlsrv_fetch_array( $comm, SQLSRV_FETCH_NUMERIC) ) {
                        $comm_id=$row[0];
                        if ($commune==$comm_id){
                            $test=true;
                            break;
                        }
                    }

                    if ($test==true)
                        echo "Cette fiche existe dèja dans la base.";
                    else {
                        // requête remplissage fiche commune
                        $sql_insert= "INSERT INTO FICHE_COMMUNE(idfiche_commune,nomdurepondant,autre_fonction,latitude,longitude,altitude,mois,annee,nom_controleur,date_controleur,nom_chef_equipe,date_chef_equipe,idfonction,idmilieu,idcommune) ";
                        $sql_insert.= "VALUES('".$commune."','".$repondant."','".$autrefonction."','".$latitude."','".$longitude."','".$altitude."','".$mois."','".$annee."','".$controleur."','".$date_control."','".$chef_equip."','".$date_chef_equip."','".$fonction."','".$milieu."','".$commune."')";

                        // requête remplissage localités
                        for ($i=1; $i <=$nb[0] ; $i++) { 
                            if ($$localite[$i-1]!=''){
                                $$sql_loc[$i-1]="INSERT INTO fiche_comm_localite(Id_loc,popmasculin,popfeminin,idlocalite,idfiche_commune) VALUES ";
                                $$sql_loc[$i-1].="('".$$localite[$i-1]."','".$$pop_masc[$i-1]."','".$$pop_fem[$i-1]."','".$$localite[$i-1]."','".$commune."');";
                            }
                        }
                        
                        // exécution des requêtes
                        $resultat1 = sqlsrv_query( $conn, $sql_insert);
                        for ($i=1; $i <=$nb[0] ; $i++) { 
                            if ($$localite[$i-1]!='-1'){
                                $$result[$i-1] = sqlsrv_query( $conn, $$sql_loc[$i-1]);
                            }
                        }

                        if( $resultat1 == false) {
                            die( print_r( sqlsrv_error(), true));
                        }
                        else{
                            echo "Enregistrement réussi"."<br />";
                        }
                    }
                }
            ?>

</form>

<div>
					<center>
					<table class='row' border="2">
						<tr>

							<td id="initialiser"><input class='basic-slide' type="reset" onclick="window.location.href='questionnaire_rgphm5.php';" value="Initialiser le formulaire"/></td>			

							<td id="retouner"><input class='basic-slide' type="submit"  onclick="window.location.href='gestion.php';" value="Retourner à la page de gestion"></td>
						</tr>
					</table>
					</center>
			</div>

</center>
			

		</center>
	</body>
</html>

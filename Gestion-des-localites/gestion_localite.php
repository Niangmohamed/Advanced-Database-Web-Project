<?php
session_start();
include('includes/config.php');
$nom_loc="";
$PopMasc="";
$PopFemm="";
$idloc="";
$reg="";
$cer="";
$comm="";

if(isset($_GET['action'])  && isset($_GET['num']))
{
    if($_GET['action']=="edit")
    {
        $id = $_GET['num'];
        $reg=substr($id,0,2);
        $cer=substr($id,0,3);
        $comm=substr($id,0,5);
        $sql = "SELECT * FROM FICHE_COMM_LOCALITE INNER JOIN LOCALITE ON (FICHE_COMM_LOCALITE.Id_loc=LOCALITE.idlocalite) WHERE FICHE_COMM_LOCALITE.Id_loc='" .$id."'";

        $result = sqlsrv_query($conn,$sql);
        
        if($result)
        {
            while($row = sqlsrv_fetch_array($result, SQLSRV_FETCH_ASSOC)){
                $idloc=$row['Id_loc'];
                $nom_loc=$row['nom_localite'];
                $PopMasc=$row['popmasculin'];
                $PopFemm=$row['popfeminin'];
            }
        }
    }
    else if($_GET['action']=="del"){
        $id = $_GET['num'];
        $result = sqlsrv_query($conn, "DELETE FROM FICHE_COMM_LOCALITE WHERE Id_loc='".$id."'");
    }
        
}
if(isset($_POST['sauver'])){

    if(empty($_POST['idloc']))
    {  
        $idloc=$_POST['id_loc'];
        $idcomm=$_POST['commune'];
        $nom_loc=$_POST['nom_loc'];
        $PopMasc=$_POST['PopMasc'];
        $PopFemm=$_POST['PopFemm'];

        if ($idcomm!="") {
            $insert_loc=sqlsrv_query($conn," INSERT INTO LOCALITE(idlocalite,idcommune,nom_localite) VALUES ('".$idloc."','".$idcomm."','".$nom_loc."')");
            $sql =" INSERT INTO FICHE_COMM_LOCALITE (Id_loc,idlocalite,idfiche_commune,popmasculin,popfeminin) VALUES('".$idloc."','".$idloc."','".$idcomm."','".$PopMasc."','".$PopFemm."')";
            $linkQuery = sqlsrv_query($conn, $sql);
            $nom_loc="";
            $PopMasc="";
            $PopFemm="";
            $idloc="";
        }
        else {
            echo "<p style='color:red;text-align:center;'>Veuillez choisir la commune svp !</p>";
        }
        
    }
    else{
        $idloc=$_POST['idloc'];
        $idcomm=substr($idloc,0,5);
        $nom_loc=$_POST['nom_loc'];
        $PopMasc=$_POST['PopMasc'];
        $PopFemm=$_POST['PopFemm'];

        $sql = "UPDATE FICHE_COMM_LOCALITE set Id_loc='".$idloc."',  idlocalite='".$idloc."',  idfiche_commune='".$idcomm."', popmasculin='".$PopMasc."', popfeminin='$PopFemm' WHERE Id_loc='".$idloc."'";
        $linkQuery = sqlsrv_query($conn, $sql);
        $nom_loc="";
        $PopMasc="";
        $PopFemm="";
        $idloc="";
    }
}
?>

<!DOCTYPE html>

    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>RGPHM5 (GESTION DES LOCALITES)</title>
        <link rel="stylesheet" href="css/stylequest2.css">
        <link rel="stylesheet" href="css/sweetalert2.min.css">
        <script type="text/javascript" charset="utf-8" src="ajax.js"></script>
        <script src="js/sweetalert2.min.js"></script>
        <script src="js/sweetalertall.js"></script>

    </head>

    <body>
        <div class='row' align="center">
          <h1 class="titrequest3"><strong>5ème Recensement Généralde la population et de l’Habitat du Mali (RGPH5) <br /></strong></h1>
          
          <h2 class="titrequest">GESTION DES LOCALITES</h2>
        </div>

<center>
<form class='row' action="?" method="post">
    <table width="100%" border="3">
        <tr>
            <td style="background-color: #7AB893; color: white;" width="35%" align="left" valign="left">
                <label class='basic-slide2'  for="lst_reg">REGION</label>
                <select class='basic-slide' id='lst_reg' name='region' onchange='chargement("lst_reg","lst_cer","cercleajax.php");chargement("lst_cer","lst_comm","communeajax.php");chargement("lst_comm","localite","ajaxgestion.php")'>
                            <option disabled selected>Sélectionner une région</option>
                            <?php
                            $res = sqlsrv_query($conn, "SELECT * FROM REGION ORDER BY nomregion");
                            
                            while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
                                echo "<option value='" . $row['coderegion'] . "'>" . $row['nomregion'] . "</option>";
                            }
                            ?>
                            </select>
            </td>
            
            <td style="background-color: #7AB893; color: white;" width="30%" align="left" valign="left">
                <label class='basic-slide0' for="lst_cer">CERCLE</label>
                <select class='basic-slide' id='lst_cer' name='cercle' onchange='chargement("lst_cer","lst_comm","communeajax.php")'  ></select>
            </td>
            
            <td style="background-color: #7AB893; color: white;" width="40%" align="left" valign="left">
                <label class='basic-slide3' for="lst_comm" >COMMUNE</label>
                <select class='basic-slide' id="lst_comm" name="commune" onchange='chargement("lst_comm","localite","ajaxgestion.php")' ></select>
            </td>
        </tr>
    </table>
    <br><br>
    <table >
        <tr>
            <th class="titrequest2">ID Localité</th>
            <th class="titrequest2">Nom Localité</th>
            <th class="titrequest2">Population masculine</th>
            <th class="titrequest2">Population féminine</th>
        </tr>
        <tr>
            <td><input required type="text" name="id_loc" value="<?php echo $idloc; ?>"></td>
            <td><input required type="text" name="nom_loc" value="<?php echo $nom_loc; ?>"></td>
            <td><input required type="text" name="PopMasc" value="<?php echo $PopMasc; ?>"></td>
            <td><input required type="text" name="PopFemm" value="<?php echo $PopFemm; ?>"></td>
        </tr>
    </table>
    <input id="reg" type="hidden" value="<?php echo $reg; ?>">
    <input id="cer" type="hidden" value="<?php echo $cer; ?>">
    <input id="comm" type="hidden" value="<?php echo $comm; ?>">
    <input type="hidden" id="idloc" name="idloc" value="<?php echo $idloc?>"><br>
    <input class='basic-slide' type='submit' name="sauver" value='Enregistrer' style="width:150px;height:40px;font-size:18px;border-color:#27a832;" onclick="VerifCommune();">
</form>
<br><br>
<center>
<h2 class="section"> LOCALITES </h2>
<div id='localite'>
</center>
<?php
    if(isset($_GET['action'])  && isset($_GET['num'])){
        $id = $_GET['num'];
        $comm=substr($id,0,5);
        include('affiche_loc2.php');
    }
    if(isset($_POST['sauver'])) {
        include('affiche_loc1.php');
    }
?>
       

</div>

</center>
<script>
        function VerifCommune(){
            var loc=document.getElementById('idloc');
            var loc_val=loc.options[loc.selectedIndex].value;
            if (loc=="") {
                alert("Veuillez renseigner la commune");
            }
        }
    </script>

    <div>
                    <center>
                    <table class='row' border="2">
                        <tr>

                            <td id="initialiser"><input class='basic-slide' type="reset" onclick="window.location.href='gestion_localite.php';" value="Initialiser le formulaire"/></td>            

                            <td id="retouner"><input class='basic-slide' type="submit"  onclick="window.location.href='gestion.php';" value="Retourner à la page de gestion"></td>
                        </tr>
                    </table>
                    </center>
            </div>

</body>
</html>
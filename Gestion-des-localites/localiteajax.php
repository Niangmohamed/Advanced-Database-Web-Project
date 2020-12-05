<?php
            

if (isset($_POST["code"])) {
    include('includes/config.php');
    $res = sqlsrv_query($conn,"SELECT * FROM LOCALITE WHERE idcommune=" . $_POST['code']. " ORDER BY nom_localite");
   
    $tab_idloc = array();
    $tab_nomloc = array();
    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
        $tab_idloc[]=$row['idlocalite'];
        $tab_nomloc[]=$row['nom_localite'];
    }

    $tab="<fieldset>";
    $tab.="<table width='100%' border='3'>
    <tr><th width='40%'>Localité</th><th width='30%'>Population masculine</th><th width='30%'>Population féminine</th></tr>";
    $req_loc=" SELECT COUNT(*) AS loc_size FROM LOCALITE WHERE idcommune=" . $_POST['code'];
    $res_loc=sqlsrv_query($conn,$req_loc);
    $nb = sqlsrv_fetch_array($res_loc,SQLSRV_FETCH_ASSOC);
    for ($i=1; $i <=$nb['loc_size'] ; $i++) {
        $tab.="<tr><td style='display:none' width='1%'><input  type='hidden' value='".$tab_idloc[$i-1]."' name='loc".$i."' id='loc".$i."'>";
        $tab.="<td width='40%'>".$tab_nomloc[$i-1]."</td>";                      
        $tab.="<td width='30%'><input class='basic-slide2' type='number' id='pop_masc".$i."' name='pop_masc".$i."'></td>";
        $tab.="<td width='30%'><input class='basic-slide2' type='number' id='pop_fem".$i."' name='pop_fem".$i."'></td>";
        $tab.="</tr>"; 
    }
    $tab.="</table></fieldset>";
    echo $tab;
}


?>
<?php
        include('includes/config.php');
        $sql = "SELECT * FROM FICHE_COMM_LOCALITE INNER JOIN LOCALITE ON (FICHE_COMM_LOCALITE.Id_loc=LOCALITE.idlocalite) WHERE FICHE_COMM_LOCALITE.idfiche_commune='" .$idcomm."'";
        $res = sqlsrv_query($conn,$sql);

        $tab_idloc = array();
        $tab_nomloc = array();
        $tab_pop_masc = array();
        $tab_pop_femm = array();
        while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
            $tab_idloc[]=$row['Id_loc'];
            $tab_nomloc[]=$row['nom_localite'];
            $tab_pop_masc[]=$row['popmasculin'];
            $tab_pop_femm[]=$row['popfeminin'];
        }

        
        $tab="<fieldset>";
        $tab.="<table width='100%' border='3' style='text-align:center;'><tr><th>ID Localité</th><th >Nom Localité</th><th >Population masculine</th><th >Population féminine</th><th>Modifier</th><th>Supprimer</th></tr>";
        $req_loc=" SELECT COUNT(*) AS loc_size FROM FICHE_COMM_LOCALITE WHERE idfiche_commune='" .$idcomm."'";
        $res_loc=sqlsrv_query($conn,$req_loc);
        $nb = sqlsrv_fetch_array($res_loc,SQLSRV_FETCH_ASSOC);
        for ($i=1; $i <=$nb['loc_size'] ; $i++) {
            $tab.="<tr><td width='150px'>".$tab_idloc[$i-1]."</td>";
            $tab.="<td width='150px'>".$tab_nomloc[$i-1]."</td>";                      
            $tab.="<td width='150px'>".$tab_pop_masc[$i-1]."</td>";
            $tab.="<td width='150px'>".$tab_pop_femm[$i-1]."</td>";
            $urlmofifier ="?action=edit&num=".$tab_idloc[$i-1];
            $urlsupression = "?action=del&num=".$tab_idloc[$i-1];
            $tab.="<td width='150px'> <a href='$urlmofifier'> Modifier </a>   </td>";
            $tab.="<td width='150px'> <a href='$urlsupression' onclick=\" return confirm(' confirmer ')  \"> Suprimer  </a> </td>";
            $tab.="</tr>"; 
        }
        $tab.="</table></fieldset>";
        echo $tab;
?>
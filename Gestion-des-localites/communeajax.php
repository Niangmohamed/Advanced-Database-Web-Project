

<?php
if (isset($_POST["code"])) {
    include('includes/config.php');
    $res = sqlsrv_query($conn, "SELECT idcommune,nomcommune FROM COMMUNE 
            WHERE codecercle=" . $_POST["code"] . " ORDER BY nomcommune");

    echo "<option value='-1'>Sélectionner une commune</option>";
    while ($row = sqlsrv_fetch_array($res, SQLSRV_FETCH_ASSOC)) {
        echo "<option value='" . $row["idcommune"] . "'>" . $row["nomcommune"] . "</option>";
    }
}

?>
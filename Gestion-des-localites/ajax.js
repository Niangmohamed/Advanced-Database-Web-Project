function getXhr() {
    var xhr = null;
    if (window.XMLHttpRequest) // Firefox et autres
        xhr = new XMLHttpRequest();
    else if (window.ActiveXObject) { // Internet Explorer 
        try {
            xhr = new ActiveXObject("Msxml2.XMLHTTP");
        } catch (e) {
            xhr = new ActiveXObject("Microsoft.XMLHTTP");
        }
    } else { // XMLHttpRequest non supporté par le navigateur 
        alert("Votre navigateur ne supporte pas les objets XMLHTTPRequest...");
        xhr = false;
    }
    return xhr;
}
/**
 * Méthode qui sera appelée sur le click du bouton
 */

function chargement(NivSup_id, NivInf_id, pagephp) {
    var xhr = getXhr();
    // On défini ce qu'on va faire quand on aura la réponse
    xhr.onreadystatechange = function() {
        // On ne fait quelque chose que si on a tout reçu et que le serveur est ok
        if (xhr.readyState == 4 && xhr.status == 200) {
            leselect = xhr.responseText;
            // On se sert de innerHTML pour rajouter les options a la liste
            document.getElementById(NivInf_id).innerHTML = leselect;
        }
    }

    // Ici on va voir comment faire du post
    xhr.open("POST", pagephp, true);
    // ne pas oublier ça pour le post
    xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    // ne pas oublier de poster les arguments
    // ici, l'idREG de la région
    sel = document.getElementById(NivSup_id);
    id = sel.options[sel.selectedIndex].value;
    xhr.send("code=" + id);
}

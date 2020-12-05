<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>CREATION D'EQUIPE</title>
        <link rel="stylesheet" href="css/stylequest.css">
        <link rel="stylesheet" href="css/sweetalert2.min.css">
        <script type="text/javascript" charset="utf-8" src="ajax.js"></script>
        <script src="js/sweetalert2.min.js"></script>
        <script src="js/sweetalertall.js"></script>

    </head>

    <body>
        <center>
        <form class="row" name="formtest" method="post" action="#" >
            <h2 class="section">CREATION D'EQUIPE</h2>
            <img width="200px" src="images/defaultpict.jpg" alt=""><br>
            <label class="section"><strong>N° équipe</strong></label>
            <input required type="number" id="equip_id" name="num_equipe" ><br><br>
            <table width="100%" border="4">
                <tr>
                    <th width="20%">Login</th>
                    <th width="20%">Prénom et Nom</th>
                    <th width="20%">Mot de passe</th>
                    <th width="20%">Rôle</th>
                </tr>
            </table>
            <br>
            <div id="champs">
                <input class='basic-slide0' required type="text" name="login[]" />
                <input class='basic-slide0' required type="text" name="prenom_nom[]" />
                <input class='basic-slide0' required type="text" name="password[]" />
                <select class='basic-slide0' required name="role[]" id="role">
                    <option value="">Sélectionner le rôle</option>
                    <option value="1">contôleur informaticien</option>
                    <option value="2">Chef d'équipe</option>
                    <option value="3">Agent cartographe</option>
                </select>
                <br><br>
            </div>

            <script>
                var div = document.getElementById('champs');
                // fonction permettant d'ajouter une balise input
                function addInput(name_input,typ){
                    var input = document.createElement("input");
                    input.type=typ;
                    input.name = name_input;
                    input.required=true;
                    div.appendChild(input);
                }
                // fonction permettant d'ajouter une balise select
                function addSelect(name_select) {
                    var select=document.createElement("select");
                    select.name=name_select;
                    select.required = true; 
                    var opt1= new Option("Sélectionner le rôle","");
                    var opt2= new Option("contôleur informaticien","1");
                    var opt3= new Option("Chef d'équipe","2");
                    var opt4= new Option("Agent cartographe","3");
                    select.options[0]=opt1;
                    select.options[1]=opt2;
                    select.options[2]=opt3;
                    select.options[3]=opt4;
                    div.appendChild(select);
                }
                // fonction permettant d'ajouter une ligne correspondant aux infos d'un membre d'une équipe
                function addField() {
                    addInput("login[]","text");
                    div.appendChild(document.createTextNode(" "));
                    addInput("prenom_nom[]","text");
                    div.appendChild(document.createTextNode(" "));
                    addInput("password[]","text");
                    div.appendChild(document.createTextNode(" "));
                    addSelect("role[]");
                    div.appendChild(document.createElement("br"));
                    div.appendChild(document.createElement("br"));
                }
                // fonction permettant de supprimer la dernière ligne ajoutée
                function removeLastLine() {
                    var i=1;
                    // chaque ligne comporte 9 child (enfants) sauf la première ligne (qui en a 12)
                    while (i<=9 && (div.childNodes.length)>12) {
                        div.removeChild(div.lastChild);
                        i+=1;
                    }
                }

                function NbLigne() {
                    var n = document.getElementById("champs").childNodes.length;
                    document.getElementById("demo").value = (n-3)/9;
                }

            </script>

            <button class='basic-slide0' type="button" onclick="addField()" >+</button>
            <button class='basic-slide0' type="button" onclick="removeLastLine()">-</button>
            <input class='basic-slide0' type="submit" name="enreg" onclick="NbLigne();sweetalert4();" />
            <input type="hidden" name="team_size" id="demo" />

        </form>
        </center>

        <center>
            <table class='row' border="2">
                <tr>

                    <td id="initialiser"><input class='basic-slide0' type="reset" onclick="window.location.href='creer_equipe.php';" value="Initialiser le formulaire"/></td>            

                    <td id="retouner"><input class='basic-slide0' type="submit"  onclick="window.location.href='gestion.php';" value="Retourner à la page de gestion"></td>
                </tr>
            </table>
        </center>


        <?php
            if (isset($_POST['enreg'])){
                include('includes/config.php');
                //on récupère le nombre d'agents remplis
                $team_size=$_POST['team_size'];
                for ($i=0; $i <$team_size ; $i++) {
                    $req="";
                    $req.=" INSERT INTO agent(idagent,motdepasse,prenom_nom,numero_equipe,idrole) ";
                    $req.="VALUES('".$_POST['login'][$i]."','".$_POST['password'][$i]."','".$_POST['prenom_nom'][$i]."','".$_POST['num_equipe']."','".$_POST['role'][$i]."')";

                    $res=sqlsrv_query( $conn, $req);
                }
            }
        ?>
       
    </body>
</html>
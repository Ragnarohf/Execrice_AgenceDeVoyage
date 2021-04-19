<?php
require_once("./inc/pdo.php");
// function requetes MySQl
function selectAllVoyages($id)
{
    global $pdo;
    //$order servira a laisser le choix du classement pour mes users
    $rq = " SELECT * from voyages order by $id";
    $query = $pdo->prepare($rq);
    // $query->bindValue(':order', $order, PDO::PARAM_STR);
    $query->execute();
    $result = $query->fetchAll();
    return $result;
}
// functions courantes
$erreur = [];
function verifInput($input, $obligatoire = false, $type = false)
{
    global $erreur; //je récupère le tableau d'erreur
    if (!empty($_POST[$input]) && isset($_POST[$input])) {
        $retour = trim(strip_tags($_POST[$input]));
    } else {
        // je gère ici le champ obligatoire si $obligatoire = true
        if ($obligatoire) {
            $retour = "";
            $erreur[$input] = "Le champ $input n'est pas rempli.";
        }
    }
    // je gère ici le type de ma variable à envoyer dans la base
    if ($type && $retour !== "") {
        // Attention : $_POST renverra TOUJOURS des variables en type string
        switch ($type) {
            case 'integer':
                $patern = "@[0-9]@";
                if (!preg_match($patern, $retour)) {
                    $erreur[$input] = "Le champ $input n'est pas au bon format.";
                } else {
                    $retour = intval($retour);
                }
                break;
            case 'string':
                $retour = strval($retour);
                break;
                // autres case possibles : array,object,boolean,NULL,...
            default:
                # code...
                break;
        }
    }
    return $retour;
}

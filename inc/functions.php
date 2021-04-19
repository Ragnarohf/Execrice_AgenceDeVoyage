<?php
require_once("./inc/pdo.php");
// function requetes MySQl

// functions courantes
$erreur = [];
function verifInput($input, $obligatoire = false, $type = false)
{
    if (!empty($_POST[$input]) && isset($_POST[$input])) {
        $retour =  trim(strip_tags($_POST[$input]));
    }
    if ($type) {
        $needType = gettype($_POST[$input]);
        if ($type !== $needType) {
            $retour = "";
            $erreur[$input] = "le champ $input n'est pas au bon format";
        }
    }
    if ($obligatoire && empty($retour)) {
        $retour = "";
        $erreur[$input] = "le champ $input n'est pas rempli";
    }
}
return $retour;

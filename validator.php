<?php
// pour executer des requetes mysql j'ai besoin dans ce fichier d'appeler ma conexion a la bdd

require_once('./inc/functions.php');
// phpinfo();permet de connaitre les spec dus erveur ex:taille maximal des fichiers uploadés
//$_FILES permet de stocker les fichiers uploadés (input type="files)
require_once("./vendor/autoload.php");

use Gumlet\ImageResize;

$erreur = [];


if (!empty($_POST)) {
    // attendre la foncction de julien
    //VERIF LES DONNES

    // Gestion des données FILES
    //image
    if ($_FILES['photo']["size"] > 0 && $_FILES['photo']["error"] === 0) {
        if ($_FILES["photo"]['type'] === "image/jpeg" || $_FILES["photo"]['type'] === "image/jpg" || $_FILES["photo"]['type'] === "image/gif" || $_FILES["photo"]['type'] === "image/png" || $_FILES["photo"]['type'] === "image/webp") {
            $photo = $_FILES["photo"]['tmp_name'];
        } else {
            $erreur['photo'] = "le fichier photo n'est pas au bon format";
        }
    }
    // var_dump($erreur);

    //je vérifie que mon tableau d'erreur soit vide 
    if (count($erreur) === 0) {
        if (!empty($_FILES['photo'])) {
            $photoName = $_FILES['photo']['name'];
        } else {
            $photoname = Null;
        }

        //var_dump("mp3:", $mp3Name);
        //insertion en base
        $rq = "SELECT id FROM voyages WHERE titre = :titre";
        $query = $pdo->prepare($rq);
        $query->bindValue(':titre', $titre, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch();
        if (!$result) {
            $rq = "INSERT INTO voyages(titre,description,ville, pays,prix_par_personne, distance_depuis_paris,pension,date_de_depart,date_de_retour,photo )
            VALUES (:titre,:description,:ville, :pays,:prix_par_personne, :distance_depuis_paris,:pension,:date_de_depart,:date_de_retour,:photo)";
            $query = $pdo->prepare($rq);
            $query->bindValue(':titre', $titre, PDO::PARAM_STR);
            $query->bindValue(':description', $description, PDO::PARAM_STR);
            $query->bindValue(':ville', $ville, PDO::PARAM_STR);
            $query->bindValue(':pays', $pays, PDO::PARAM_STR);
            $query->bindValue(':prix_par_personne', $prix_par_personne, PDO::PARAM_INT);
            $query->bindValue(':distance_depuis_paris', $distance_depuis_paris, PDO::PARAM_INT);
            $query->bindValue(':pension', $pension, PDO::PARAM_STR);
            $query->bindValue(':date_de_depart', $date_de_depart, PDO::PARAM_STR);
            $query->bindValue(':date_de_retour', $date_de_retour, PDO::PARAM_STR);
            $query->bindValue(':photo', $photoName, PDO::PARAM_STR);
            $query->execute();
            //j'upload mes fichiers


            move_uploaded_file($photo, "./assets/img_voyage/" . $_FILES["photo"]["name"]);

            $newImg = new ImageResize("./assets/img_voyage/" . $_FILES["photo"]["name"]);
            $newImg->resizeToWidth(200);
            $newImg->save("./assets/img_voyage/" . $_FILES["photo"]["name"]);

            $erreur['success'] = "votre voyage a bien été enregistré";
        } else {
            $erreur['titre'] = "Ce voyage exite deja";

            //erreur utilisateur

            //$erreur = serialize($erreur);
            //header("Location:./formulaire.php?er=$erreur");
        };
    }
}

<?php

require_once("./inc/functions.php");
include('./inc/header.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Poke tour </title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>

    <div id="formmp3">
        <h1>Enregistrez vos voyages</h1>
        <div id="success"></div>
        <form class="formulaire" action="./validator.php" method="POST" enctype="multipart/form-data" name="uploadMP3">
            <input type="text" name="titre" placeholder="Titre" id="titre">
            <textarea name="description" placeholder="Description" id="description"></textarea>
            <input type="text" name="ville" placeholder="Ville" id="ville">
            <input type="text" name="pays" placeholder="Pays" id="pays">
            <input type="text" name="prix_par_personne" placeholder="Prix/Personne" id="prix_par_personne">
            <input type="text" name="distance_depuis_paris" placeholder="Distance depuis paris" id="distance_depuis_paris"><select name="pets" id="pet-select">
                <option value="" disabled selected> Pension </option>
                <option value="complete">Complete</option>
                <option value="demi_pension">Demi pension</option>
                <label for="start">Date de depart</label>
                <input type="date" id="date_de_depart" name="date_de_depart" value="2021-04-19" min="2021-04-19" max="2025-12-31">
                <label for="start">Date de retour</label>
                <input type="date" id="date_de_retour" name="date_de_retour" value="2021-04-19" min="2021-04-19" max="2025-12-31">
                <label for="photo">Photo</label>
                <input type="file" name="photo" id="photo">
                <input type="submit" value="Envoyer" name="submit">
        </form>
    </div>

</body>

<?php
include('./inc/footer.php');
?>

</html>
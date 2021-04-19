<?php
session_start();
require_once("./inc/functions.php");
//protection contre un acces direct via l'url 
protectUrl('role_admin');


include('./inc/header.php');
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>formulaire</title>
    <link rel="stylesheet" href="./assets/css/style.css">
</head>

<body>
    <!-- form>(input*5+select>(option)) -->
    <div id="formmp3">
        <h1>Uploadez vos mp3</h1>
        <div id="success"></div>
        <form class="formulaire" action="./validator.php" method="POST" enctype="multipart/form-data" name="uploadMP3">
            <label for="mp3">MP3</label>
            <input type="file" name="mp3" id="mp3">

            <label for="coverImg">Cover</label>
            <input type="file" name="coverImg" id="coverImg">

            <input type="text" name="title" placeholder="Titre" id="title">
            <input type="text" name="artiste" placeholder="Artiste" id="artiste">
            <input type="text" name="genre" placeholder="Genre" id="genre">

            <select name="annee" id="annee">
                <option value="" disabled selected>Choisissez l'année</option>
                <?php
                $i = 1930;
                while ($i >= 1930 && $i <= 2021) {
                    echo "<option value='$i'>$i</option>";
                    $i++;
                }
                ?>
            </select>
            <textarea name="description" placeholder="Description" id="description"></textarea>
            <input type="submit" value="Envoyer" name="submit">
        </form>
    </div>

</body>
<script src="./assets/js/formulaireSend.js"></script>
<?php
include('./inc/footer.php');
?>

</html>
<?php
// if (!empty($_GET['themeSwitch']) || !empty($_SESSION['themeSwitch'])) {
//     //j'insere dans ma session le theme choisie par mon utilisateur
//     $_SESSION['themeSwitch'] = $_GET['themeSwitch'];
//     $themeChecked = $_SESSION['themeSwitch'];
//     //je determine quel theme bootswatch va etre utiliser 
//     if ($_GET['themeSwitch']) {
//         $themeSwitch = "https://bootswatch.com/4/flatly/bootstrap.css";
//     } else {
//         $themeSwitch = "https://bootswatch.com/4/journal/bootstrap.min.css";
//     }
// }
// if (!isset($themeSwitch)) { // si aucun theme definie, je choisie une theme par defaut
//     $themeSwitch = "https://bootswatch.com/4/flatly/bootstrap.css";
//     $themeChecked = false;
// }
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <!-- Script librairies puis script perso  -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous"></script>
    <script src='./assets/js/jquery.color.min.js'></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

    <!-- Styles librairies puis styles perso  -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!-- <link rel="stylesheet" id="linktheme" href=<?php //$themeSwitch 
                                                    ?>> -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.3/css/all.css" integrity="sha384-SZXxX4whJ79/gErwcOYf+zWLeJdY/qpuqC4cAa9rOGUstPomtqpuNWT9wdPEn2fk" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Agence de voyage</title>
</head>

<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="index.php">Agence de voyage</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarColor01">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item active">
                        <a class="nav-link" href="index.php">home
                        </a>
                    </li>
                    <?php if (empty($_SESSION['role'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="registration.php">s'inscrire</a>
                        </li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['role']) && $_SESSION['role'] === 'role_admin') { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="formulaire.php">Formulaires admin</a>
                        </li>
                    <?php } ?>

                    <?php if (empty($_SESSION['role'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                    <?php } ?>

                    <?php if (!empty($_SESSION['role'])) { ?>
                        <li class="nav-item">
                            <a class="nav-link" href="logout.php">logout</a>
                        </li>
                    <?php } ?>

                    <div class="custom-control custom-switch text-light d-inline">
                        <input type="checkbox" class="custom-control-input" id="themeSwitch">
                        <label class="custom-control-label" for="themeSwitch">Nuit/jour</label>

                </ul>
                <form class="form-inline my-lg-0 autoComp">
                    <input class="form-control mr-sm-2" type="text" placeholder="Search" id="recherche">
                    <button class="btn btn-secondary  my-sm-0" type="submit">Search</button>
                    <div class="divAutoComp"></div>
                </form>
            </div>
        </nav>


        </div>
        <?php if (!empty($_SESSION['prenom'])) { ?>
            <div>Bonjour <?= $_SESSION['prenom'] . " " . $_SESSION['nom'] ?></div>
        <?php } else { ?>
            <div>Vous n'êtes pas enregistrés.</div>
        <?php } ?>

        <script src='./assets/js/themeSwitch.js'></script>
        <script src='./assets/js/autocomplete.js'></script>
    </header>
    <main>
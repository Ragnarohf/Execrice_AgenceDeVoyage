<?php



require_once("./inc/functions.php");
include("./inc/header.php");
$order = "title";
if (!empty($_GET)) {
}
$tbVoyages[] = selectAllVoyages();
$voyages = $tbVoyages[0];

?>


<section id='article'>
    <?php
    for ($i = 0; $i < count($voyages); $i++) {

        /*  racourcis pour inserer du code php dans html
            <?= $title ?>
            <?php echo $title; ?>
        */
    ?>

        <div class="card" style="width: 18rem;">
            <img class="card-img-top" src="./assets/img_voyage/<?= $voyages[$i]['photo'] ?>" alt="<?= $voyages[$i]['titre'] . " - " . $voyages[$i]['ville'] ?>">
            <div class="card-body">
                <h5 class="card-title"><?= $voyages[$i]['titre'] ?></h5>
                <p class="card-text"><?= $voyages[$i]['ville'] ?></p>
                <p class="card-text"><?= $voyages[$i]['pays'] ?></p>

            </div>
        </div>
    <?php

    }

    ?>


</section>



<?php
include('./inc/footer.php');
?>
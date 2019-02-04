<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
<section id="cover_photo">
    <div>
        <?php if ($_GET["action"] == "registrovany"){
           ?>
            <h1>Moje Auta</h1>
        <?php
        }else{
            ?>
            <h1>Auta</h1>
        <?php
        }
        ?>
    </div>
</section>
<main>
    <div align="center">
        <?php
        if ($_GET["action"] == "auto") {
            echo "<h2 class='nadpis'>Seznam všech dostupných aut</h2>";

            if ($_GET["action"] == "auto") {
                $conn = Pripojeni::getPdoInstance();
                $userDao = new Auto($conn);
                $udalost = $userDao->getByAuto();
                $datatable = new VypisTabulek($udalost);
                $datatable->addColumn("znacka", "Značka");
                $datatable->addColumn("pocet_mist", "Počet míst");
                $datatable->addColumn("typ", "Typ");
                $datatable->addColumn("email", "Majitel");
                $datatable->addColumn("uprav", "Uprav");
                $datatable->addColumn("odeber", "Odeber");
                $datatable->render_auto();
            }
        }
        ?>
    </div>
    <br>
</main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
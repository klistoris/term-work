<?php if (Autentizace::getInstance()->getIdentity()["role"]=="registrovany"): ?>
    <section id="cover_photo">
        <div>
            <h1>Moje události</h1>
        </div>
    </section>
    <main>
        <div align="center">
            <?php
            if ($_GET["action"] == "zucastnim_se") {
                echo "<h2 class='nadpis'>Zúčastním se níže uvedených událostí</h2>";

                if ($_GET["action"] == "zucastnim_se") {
                    $conn = Pripojeni::getPdoInstance();
                    $userDao = new Udalost($conn);
                    $udalost = $userDao->getByUdalost();
                    $datatable = new VypisTabulek($udalost);
                    $datatable->addColumn("nazev_udalosti", "Název");
                    $datatable->addColumn("datum_konani", "Datum");
                    $datatable->addColumn("cas_konani", "Čas");
                    $datatable->addColumn("misto_konani", "Místo konání");
                    $datatable->addColumn("popis_udalosti", "Popis");
                    $datatable->render_udalost_registrovany_ucast();

                }
            }
            ?>
        </div>
        <br>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>

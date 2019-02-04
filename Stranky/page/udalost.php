<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator" ||
    Autentizace::getInstance()->getIdentity()["role"]=="registrovany"): ?>
<section id="cover_photo">
    <div>
        <h1>Událost</h1>
    </div>
</section>
<main>
    <div align="center">
        <?php
        if ($_GET["action"] == "udalost") {
            echo "<h2 class='nadpis'>Události</h2>";

            if ($_GET["action"] == "udalost") {
                $conn = Pripojeni::getPdoInstance();
                $userDao = new Udalost($conn);
                $udalost = $userDao->getByUdalost();
                $datatable = new VypisTabulek($udalost);
                $datatable->addColumn("nazev_udalosti", "Název");
                $datatable->addColumn("datum_konani", "Datum");
                $datatable->addColumn("cas_konani", "Čas");
                $datatable->addColumn("misto_konani", "Místo konání");
                $datatable->addColumn("popis_udalosti", "Popis");
                $datatable->render_udalost();
                ?>
                <br>
                <hr>
                <?php
                $userDao = new Udalost($conn);
                $udalost = $userDao->getByUdalost();
                $soubor = fopen("./data/exportovany_soubor.json", 'w');
                if ($soubor) {
                    fwrite($soubor, json_encode($udalost, JSON_PRETTY_PRINT));
                    fclose($soubor);
                    echo "<h3>Export všech událostí</h3>";
                    echo "<br>" . "<a class='tlacitko' href=\"http://localhost/iwww/term-work/Stranky/data/exportovany_soubor.json\" download>Exportovat</a><br><br><br><hr>";
                }

                ?>
                <form method="post" enctype="multipart/form-data">
                    <h3>Vyberte soubor k importu</h3>
                    <input type="file" name="jsonFile">
                    <br><br>
                    <input type="submit" value="Import" name="import">
                    <br><hr>
                </form>
                <?php


                if ($_POST) {
                    if (isset($_POST["import"])) {
                        $neco = $_FILES["jsonFile"]['tmp_name'];
                        if ($neco) {
                            $obsah = file_get_contents($neco);
                            $preved_do_pole = json_decode($obsah, true);
                            foreach ($preved_do_pole as $udalost_pruchod) {
                                $udalost = new Udalost($conn);
                                if ($udalost->neexistujeUdalostSID($udalost_pruchod['id_udalost'])) {
                                    $udalost->vlozUdalostID($udalost_pruchod['id_udalost'], $udalost_pruchod['nazev_udalosti'],
                                        $udalost_pruchod['datum_konani'], $udalost_pruchod['cas_konani'],
                                        $udalost_pruchod['misto_konani'],$udalost_pruchod['popis_udalosti']);
                                }
                            }
                        } else {
                            echo "Chyba v importu";
                        }
                    }
                }
            }
        } elseif ($_GET["action"] == "registrovany"){
            echo "<h2 class='nadpis'>Události</h2>";

            if ($_GET["action"] == "registrovany") {
                $conn = Pripojeni::getPdoInstance();
                $userDao = new Udalost($conn);
                $udalost = $userDao->getByUdalost();
                $datatable = new VypisTabulek($udalost);
                $datatable->addColumn("nazev_udalosti", "Název");
                $datatable->addColumn("datum_konani", "Datum");
                $datatable->addColumn("cas_konani", "Čas");
                $datatable->addColumn("misto_konani", "Místo konání");
                $datatable->addColumn("popis_udalosti", "Popis");
                $datatable->render_udalost_registrovany();

            }
        }
        ?>
    </div>
    <br>



</main>

<?php else: include "uvod.php" ?>

<?php endif; ?>

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
                $userDao = new UdalostAdresar($conn);
                $udalost = $userDao->getByUdalost();
                $datatable = new VypisTabulek($udalost);
                $datatable->addColumn("nazev_udalosti", "Název");
                $datatable->addColumn("datum_konani", "Datum");
                $datatable->addColumn("misto_konani", "Místo konání");
                $datatable->addColumn("popis_udalosti", "Popis");
                $datatable->render_udalost();

            }
        }
        ?>
    </div>
    <br>



</main>


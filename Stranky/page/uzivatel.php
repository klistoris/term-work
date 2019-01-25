<section id="cover_photo">
    <div>
        <h1>Uživatelé</h1>
    </div>
</section>
<main>
    <div align="center">
    <?php
    if ($_GET["action"] == "sprava-uzivatelu") {
        echo "<h2 class='nadpis'>Správa uživatelů</h2>";
        $userDao = new UzivatelAdresar(Pripojeni::getPdoInstance());
        $allUsersResult = $userDao->getAllUsers();

        $datatable = new VypisTabulek($allUsersResult);
        $datatable->addColumn("idOsoba", "ID");
        $datatable->addColumn("email", "Email");
        $datatable->addColumn("jmeno", "Jméno");
        $datatable->addColumn("prijmeni", "Příjmení");
        $datatable->addColumn("vek", "Věk");
        $datatable->addColumn("heslo", "Heslo");
        $datatable->addColumn("editace", "Editace");
        $datatable->render_uzivatel();

    } else if ($_GET["action"] == "podle-emailu") {
        echo "<h2 class='nadpis'>Vyhledávání podle emailů</h2>";

        ?>

        <form method="post" class="nadpis">
            <input type="text" name="mail" placeholder="vložte emailovou adresu" >
            <input type="submit" value="Hledat">
        </form>
        <br>

        <?php

        if (!empty($_POST["mail"])) {
            $conn = Pripojeni::getPdoInstance();
            $userDao = new UzivatelAdresar($conn);
            $usersByEmail = $userDao->getByEmail($_POST["mail"]);
            $datatable = new VypisTabulek($usersByEmail);
            $datatable->addColumn("idOsoba", "ID");
            $datatable->addColumn("email", "Email");
            $datatable->addColumn("jmeno", "Jméno");
            $datatable->addColumn("prijmeni", "Příjmení");
            $datatable->addColumn("vek", "Věk");
            $datatable->addColumn("heslo", "Heslo");
            $datatable->render_uzivatel();

        }
    } else if ($_GET["action"] == "podle-emailu") {
        echo "<h2 class='nadpis'>Události</h2>";

        if ($_GET["action"] == "udalost") {
            $conn = Pripojeni::getPdoInstance();
            $userDao = new UzivatelAdresar($conn);
            $udalost = $userDao->getByUdalost();
            $datatable = new VypisTabulek($udalost);
            $datatable->addColumn("id_udalost", "ID");
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


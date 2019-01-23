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
        $userDao = new UserRepository(Connection::getPdoInstance());
        $allUsersResult = $userDao->getAllUsers();

        $datatable = new DataTable($allUsersResult);
        $datatable->addColumn("idUzivatel", "ID");
        $datatable->addColumn("email", "Email");
        $datatable->addColumn("jmeno", "Jméno");
        $datatable->addColumn("heslo", "Heslo");
        $datatable->addColumn("ahoj", "Editace");
        $datatable->render_uzivatel();
        ?>
        <br>
        <a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=pridej_uzivatele" ?>">Přidat uživatele</a>
        <?php

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
            $conn = Connection::getPdoInstance();
            $userDao = new UserRepository($conn);
            $usersByEmail = $userDao->getByEmail($_POST["mail"]);
            $datatable = new DataTable($usersByEmail);
            $datatable->addColumn("idUzivatel", "ID");
            $datatable->addColumn("email", "Email");
            $datatable->addColumn("jmeno", "Jméno");
            $datatable->addColumn("heslo", "Heslo");
            $datatable->render_uzivatel();

        }
    }
    ?>
        </div>
    <br>



</main>


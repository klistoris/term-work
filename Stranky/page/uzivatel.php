<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
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
        $userDao = new Uzivatel(Pripojeni::getPdoInstance());
        $allUsersResult = $userDao->getAllUsers();

        $datatable = new VypisTabulek($allUsersResult);
        $datatable->addColumn("idOsoba", "ID");
        $datatable->addColumn("email", "Email");
        $datatable->addColumn("jmeno", "Jméno");
        $datatable->addColumn("prijmeni", "Příjmení");
        $datatable->addColumn("vek", "Věk");
        $datatable->addColumn("vek", "Věk");
        $datatable->addColumn("telefon", "Telefon");
        $datatable->addColumn("role", "Role");
        $datatable->addColumn("uprav", "Uprav");
        $datatable->addColumn("odeber", "Odeber");
        $datatable->render_uzivatel();
    }

    else if ($_GET["action"] == "podle-emailu") {
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
            $userDao = new Uzivatel($conn);
            $usersByEmail = $userDao->getByEmail($_POST["mail"]);
            $datatable = new VypisTabulek($usersByEmail);
            $datatable->addColumn("idOsoba", "ID");
            $datatable->addColumn("email", "Email");
            $datatable->addColumn("jmeno", "Jméno");
            $datatable->addColumn("prijmeni", "Příjmení");
            $datatable->addColumn("vek", "Věk");
            $datatable->addColumn("heslo", "Heslo");
            $datatable->render_uzivatel_email();

        }
    }
    ?>
        </div>
    <br>



</main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
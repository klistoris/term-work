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
        $datatable->addColumn("heslo", "Heslo");
        $datatable->addColumn("vek", "Věk");
        $datatable->addColumn("telefon", "Telefon");
        $datatable->addColumn("role", "Role");
        $datatable->addColumn("editace", "Editace");
        $datatable->render_uzivatel();

        if ($_GET["action"] == "uprava") {
            $id = $_GET["id"];
            $userDao = new Uzivatel(Pripojeni::getPdoInstance());
            $uzivatel = $userDao->getOneUser($id);
            $jmeno = $uzivatel[0]["jmeno"];
            $prijmeni = $uzivatel[0]["prijmeni"];
            $email = $uzivatel[0]["email"];
            $vek = $uzivatel[0]["vek"];
            $telefon = $uzivatel[0]["telefon"];
            $heslo = $uzivatel[0]["heslo"];
            $role = $uzivatel[0]["role"];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($errors)) {
                $pom = new Uzivatel(Pripojeni::getPdoInstance());
                $pom->upravUzivatele($id, $_POST["jmeno"], $_POST["prijmeni"], $_POST["email"], $_POST["vek"],
                    $_POST["telefon"], $_POST["heslo"], $_POST["role"]);
            }
        }
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
    } else if ($_GET["action"] == "udalost") {
        echo "<h2 class='nadpis'>Události</h2>";

        $conn = Pripojeni::getPdoInstance();
            $userDao = new Uzivatel($conn);
            $udalost = $userDao->getByUdalost();
            $datatable = new VypisTabulek($udalost);
            $datatable->addColumn("id_udalost", "ID");
            $datatable->addColumn("nazev_udalosti", "Název");
            $datatable->addColumn("datum_konani", "Datum");
            $datatable->addColumn("misto_konani", "Místo konání");
            $datatable->addColumn("popis_udalosti", "Popis");
            $datatable->render_udalost();


    }
    ?>
        </div>
    <br>



</main>


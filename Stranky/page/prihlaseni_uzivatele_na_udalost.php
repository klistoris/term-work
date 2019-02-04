<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator" ||
    Autentizace::getInstance()->getIdentity()["role"]=="registrovany"): ?>
    <section id="cover_photo">
        <div>
            <h1>Přehled uživatelů k události</h1>
        </div>
    </section>
    <main>

        <div align="center" id="tisk">
        <?php
        if ($_GET["action"] == "zobraz") {
            ?>
            <h2 class="nadpis">Přehled všech přihlášených osob k události</h2>
            <?php
            $id_udalost = $_GET["id"];
            $conn = Pripojeni::getPdoInstance();
            $osoba_jede = new OsobaJede($conn);
            $osoby = $osoba_jede->vratOsobyUdalosti($id_udalost);
            $datatable = new VypisTabulek($osoby);
            $datatable->addColumn("jmeno", "Jméno");
            $datatable->addColumn("prijmeni", "Příjmení");
            $datatable->addColumn("email", "Email");
            $datatable->addColumn("typ", "Pojedu autem");
            $datatable->addColumn("role", "Role");
            $datatable->addColumn("majitel", "Majitel auta");
            $datatable->render_udalost_prihlaseni();


        }
        ?>
        </div>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
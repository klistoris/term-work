<?php if (Autentizace::getInstance()->getIdentity()["role"] == "registrovany"): ?>
    <section id="cover_photo">
        <div>
            <h1>Příhlášení na turnaj</h1>
        </div>
    </section>
    <main>

        <?php
        if ($_POST) {
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (empty($errors)) {
                    $osoba_jede = new OsobaJede(Pripojeni::getPdoInstance());
                    $id_osoba = $_SESSION['identity']['idOsoba'];
                    $id = $_POST['typ_auta'];
                    $role = $_GET['role'];
                    $id_udalost = $_GET['id_udalost'];
                    $auto_pojede = new AutoJede(Pripojeni::getPdoInstance());
                    $pocet_mist = $auto_pojede->getVratPocetVolnyMist($id, $id_udalost);

                    if ($pocet_mist[0][0] > 0) {
                        if ($role == "spolujezdec_dospely" && $pocet_mist[0][0] >= 1) {
                            $osoba_jede->vlozOsobaJede($id_osoba, $id, $role);
                            $auto_pojede->upravAutoPocetMist($id, ($pocet_mist[0][0] - 1));
                            header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                        } else if ($role == "ridic" && $pocet_mist[0][0] >= 1 && $osoba_jede->existujeRidic($id, "ridic")) {
                            $osoba_jede->vlozOsobaJede($id_osoba, $id, $role);
                            $auto_pojede->upravAutoPocetMist($id, ($pocet_mist[0][0] - 1));
                            header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                        } else if ($role == "spolujezdec_dite" && $pocet_mist[0][0] >= 2) {
                            $osoba_jede->vlozOsobaJede($id_osoba, $id, $role);
                            $auto_pojede->upravAutoPocetMist($id, ($pocet_mist[0][0] - 2));
                            header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                        } else {
                            echo "<br>";
                            echo "Nedostatečná kapacita v automobilu nebo vaše role pro daný automobil už není volná. Zvolte jiné automobil nebo musíte počkat, až bude registrováný nový automobil pro tuto událost.";
                        }
                    }else{
                        echo "<br>";
                        echo "Nedostatečná kapacita v automobilu nebo vaše role pro daný automobil už není volná. Zvolte jiné automobil nebo musíte počkat, až bude registrováný nový automobil pro tuto událost.";
                    }
                }
            }
        }elseif ($_SERVER['REQUEST_METHOD'] == 'POST'){
                echo "<br>";
                echo "Nedostatečná kapacita v automobilu nebo vaše role pro daný automobil už není volná. Zvolte jiné automobil nebo musíte počkat, až bude registrováný nový automobil pro tuto událost.";
        }

        $conn = Pripojeni::getPdoInstance();
        $auto_jede = new AutoJede($conn);
        $id_udalost = $_GET['id_udalost'];

        if ($_GET["action"] == "prirazeni") {
        echo "<h2 class='nadpis'>V jakém autě pojedu: </h2>";
        $auto_jede = $auto_jede->getVolnaAutaNaUdalost($id_udalost);
        ?>
        <div class="form_registrace">
            <form method="post">
                <label for="pocet_mist">Vyber auto:</label>
                <select name="typ_auta">
                    <?php
                    foreach ($auto_jede as $osoba_jede) {
                        echo '<option value="' . $osoba_jede['id'] . '">' . $osoba_jede['typ'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Potvrdit">
            </form>
            <?php
            }
            ?>
        </div>
        <br>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>

<?php if (Autentizace::getInstance()->getIdentity()["role"] == "registrovany"): ?>
    <section id="cover_photo">
        <div>
            <h1>Příhlášení na turnaj</h1>
        </div>
    </section>
    <main>

        <?php
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($errors)) {
                $pom = new OsobaJede(Pripojeni::getPdoInstance());
                $id_osoba = $_SESSION['identity']['idOsoba'];
                $id = $_POST['typ_auta'];
                $role = $_GET['role'];
                $id_udalost = $_GET['id_udalost'];
                $pompom = new AutoJede(Pripojeni::getPdoInstance());
                $pocet_mist = $pompom->getVratPocetVolnyMist($id, $id_udalost);
                if ($pocet_mist[0][0] > 0){
                    if ($role == "spolujezdec_dospely" && $pocet_mist[0][0] >= 1){
                        $pom->vlozOsobaJede($id_osoba, $id, $role);
                        $pompom->upravAutoPocetMist($id, ($pocet_mist[0][0]-1));
                        header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                    }else if ($role == "ridic" && $pocet_mist[0][0] >= 1 && $pom->existujeRidic($id, "ridic")){
                        $pom->vlozOsobaJede($id_osoba, $id, $role);
                        $pompom->upravAutoPocetMist($id, ($pocet_mist[0][0]-1));
                        header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                    }else if ($role == "spolujezdec_dite" && $pocet_mist[0][0] >= 2){
                        $pom->vlozOsobaJede($id_osoba, $id, $role);
                        $pompom->upravAutoPocetMist($id, ($pocet_mist[0][0]-2));
                        header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                    }else{
                        echo "<br>";
                        echo "Nedostatečná kapacita v automobilu nebo vaše role pro daný automobil už není volná. Zvolte jiné automobil nebo musíte počkat, až bude registrováný nový automobil pro tuto událost.";
                    }
                }else{
                    echo "<br>";
                    echo "Nedostatečná kapacita v automobilu nebo vaše role pro daný automobil už není volná. Zvolte jiné automobil nebo musíte počkat, až bude registrováný nový automobil pro tuto událost.";
                }

            }
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
                    foreach ($auto_jede as $pom) {
                        echo '<option value="' . $pom['id'] . '">' . $pom['typ'] . '</option>';
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

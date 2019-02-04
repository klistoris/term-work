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
                $pom = new AutoJede(Pripojeni::getPdoInstance());
                $id_udalost = $_GET['id_udalost'];
                $id_auto = $_GET['id_auto'];
                if ($_GET['action'] == "nechci"){
                    $pom->vlozAutoJede($id_udalost, $id_auto, $_POST['pocet_mist']);
                    header('Location: ?page=udalost_budu_ridit&action=nechci&id_udalost='.$id_udalost);
                }else{
                    $pom->vlozAutoJede($id_udalost, $id_auto, $_POST['pocet_mist']);
                    $pomPom = new OsobaJede(Pripojeni::getPdoInstance());
                    $id_posledniho = $pom->getVratPosledniZaznam();
                    $pomPom->vlozOsobaJedeRidic($_SESSION['identity']['idOsoba'], $id_posledniho[0]['MAX(id)']);
                    header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                }
            }
        }

        if ($_GET['action'] == "druh") {
        echo "<h2 class='nadpis'>Detail dopravy: </h2>";
        ?>
        <div class="form_registrace">
            <?php
            $conn = Pripojeni::getPdoInstance();
            $userDao = new Auto($conn);
            $id_auto = $_GET['id_auto'];
            $pocet_mist = $userDao->getPocetMist($id_auto);
            ?>
            <form method="post">
                <label for="pocet_mist">Počet volných míst v automobilu:</label>
                <select name="pocet_mist">
                    <?php
                    for ($i = 0; $i < $pocet_mist[0]['pocet_mist']; $i++) {
                        echo '<option value="' . $i . '">' . $i . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Potvrdit">
            </form>
            <?php
            }if ($_GET['action'] == "nechci") {
            echo "<h2 class='nadpis'>Detail dopravy: </h2>";
            ?>
            <div class="form_registrace">
                <?php
                $conn = Pripojeni::getPdoInstance();
                $userDao = new Auto($conn);
                $id_auto = $_GET['id_auto'];
                $pocet_mist = $userDao->getPocetMist($id_auto);
                ?>
                <form method="post">
                    <label for="pocet_mist">Počet volných míst v automobilu:</label>
                    <select name="pocet_mist">
                        <?php
                        for ($i = 0; $i < $pocet_mist[0]['pocet_mist']+1; $i++) {
                            echo '<option value="' . $i . '">' . $i . '</option>';
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

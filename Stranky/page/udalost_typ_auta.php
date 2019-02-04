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
                $id_udalost = $_GET["id_udalost"];
                $druh = $_POST['druh'];
                if ($_GET["action"] == "nechci"){
                    header('Location: ?page=udalost_pocet_mist&action=nechci&id_udalost='.$id_udalost.'&id_auto='.$druh);
                }else{
                    header('Location: ?page=udalost_pocet_mist&action=druh&id_udalost='.$id_udalost.'&id_auto='.$druh);
                }

            }
        }


        if ($_GET["action"] == "ano") {
        echo "<h2 class='nadpis'>Detail dopravy: </h2>";
        ?>
        <div class="form_registrace">
            <?php
            $conn = Pripojeni::getPdoInstance();
            $userDao = new Auto($conn);
            $moje_auta = $userDao->getAutaUzivatele();
            ?>
            <form method="post">
                <label for="druh">Auto:</label>
                <select name="druh">
                    <?php
                    foreach ($moje_auta as $pom) {
                        echo '<option value="' . $pom['idauto'] . '">' . $pom['typ'] . '</option>';
                    }
                    ?>
                </select>
                <input type="submit" value="Potvrdit">
            </form>
            <?php
            }else if ($_GET["action"] == "nechci") {
            echo "<h2 class='nadpis'>Detail dopravy: </h2>";
            ?>
            <div class="form_registrace">
                <?php
                $conn = Pripojeni::getPdoInstance();
                $userDao = new Auto($conn);
                $moje_auta = $userDao->getAutaUzivatele();
                ?>
                <form method="post">
                    <label for="druh">Auto:</label>
                    <select name="druh">
                        <?php
                        foreach ($moje_auta as $pom) {
                            echo '<option value="' . $pom['idauto'] . '">' . $pom['typ'] . '</option>';
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

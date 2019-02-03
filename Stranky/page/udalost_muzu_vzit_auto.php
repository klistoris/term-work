<?php if (Autentizace::getInstance()->getIdentity()["role"] == "registrovany"): ?>
    <section id="cover_photo">
        <div>
            <h1>Příhlášení na turnaj</h1>
        </div>
    </section>
    <main>
        <div align="center">
            <?php
            if ($_GET["action"] == "vyber_auto") {
                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                $id_udalost = $_GET["id"];
                if ($auto->mamAuto()) {
                    echo "<h2 class='nadpis'>Vezmu auto ?</h2>";
                    ?>
                    <ul>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=udalost_budu_ridit&action=ano&id_udalost=$id_udalost" ?>">Ano</a>
                        </li>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL . "?page=udalost_budu_ridit&action=ne" ?>">Ne</a>
                        </li>
                    </ul>
                    <br>
                    <?php
                }

            }
            ?>
        </div>
        <br>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>

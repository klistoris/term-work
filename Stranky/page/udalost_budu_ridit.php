<?php if (Autentizace::getInstance()->getIdentity()["role"] == "registrovany"): ?>
    <section id="cover_photo">
        <div>
            <h1>Příhlášení na turnaj</h1>
        </div>
    </section>
    <main>
        <div align="center">
            <?php
            if ($_SERVER['REQUEST_METHOD'] == 'POST') {
                if (empty($errors)) {
                    $role = $_POST["role_v_automobilu"];
                    $id_udalost = $_GET["id_udalost"];
                    header('Location: ?page=udalost_vyber_auto&action=prirazeni&id_udalost='.$id_udalost.'&role='.$role);
                }
            }

            if ($_GET["action"] == "ano") {
                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                $id_udalost = $_GET["id_udalost"];
                if ($auto->mamAuto()) {
                    echo "<h2 class='nadpis'>Budu řídit ?</h2>";
                    ?>
                    <ul>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL .
                            "?page=udalost_typ_auta&action=ano&id_udalost=$id_udalost" ?>">Ano</a>
                        </li>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL .
                            "?page=udalost_budu_ridit&action=nechci" ?>">Ne</a>
                        </li>
                    </ul>
                    <br>
                    <?php
                }

            }else if ($_GET["action"] == "dospely") {
                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                    echo "<h2 class='nadpis'>Jakou budu mít roli ?</h2>";
                    ?>
                    <form class="form_registrace" method="post">
                    <select name="role_v_automobilu">
                        <option value="ridic">Řidič</option>
                        <option value="spolujezdec_dospely">Spolujezdec dospělý</option>
                    </select>
                        <input type="submit" value="Potvrdit">
                    <br>
                    </form>
                    <?php


            } else if ($_GET["action"] == "nechci") {
                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                if ($auto->mamAuto()) {
                    echo "<h2 class='nadpis'>Jakou budu mít roli ?</h2>";
                    ?>
                    <form class="form_registrace" method="post">
                        <select name="role_v_automobilu">
                            <option value="spolujezdec_dospely">Spolujezdec dospělý</option>
                        </select>
                        <input type="submit" value="Potvrdit">
                        <br>
                    </form>
                    <?php
                }
            } else if ($_GET["action"] == "dite") {
                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                    echo "<h2 class='nadpis'>Jakou budu mít roli ?</h2>";
                    ?>
                    <form class="form_registrace" method="post">
                        <select name="role_v_automobilu">
                        <option value="spolujezdec_dite">Spolujezdec dítě</option>
                        </select>
                        <input type="submit" value="Potvrdit">
                        <br>
                    </form>
                    <?php
            }
            ?>

        </div>
        <br>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>

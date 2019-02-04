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
                if (empty($errors)) {{
                        $auto_jede = new AutoJede(Pripojeni::getPdoInstance());
                        $role = $_POST["role_v_automobilu"];
                        $id_udalost = $_GET["id_udalost"];
                        header('Location: ?page=udalost_vyber_auto&action=prirazeni&id_udalost='.$id_udalost.'&role='.$role);
                    }
                }
            }

            if ($_GET["action"] == "ano") {
                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                $id_udalost = $_GET["id_udalost"];
                if ($auto->mamAuto()) {
                    echo "<h2 class='nadpis'>Chci řídit svoje auto ?</h2>";
                    ?>
                    <ul>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL .
                            "?page=udalost_typ_auta&action=ano&id_udalost=$id_udalost" ?>">Ano</a>
                        </li>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL .
                            "?page=udalost_typ_auta&action=nechci&id_udalost=$id_udalost" ?>">Ne</a>
                        </li>
                    </ul>
                    <br>
                    <?php
                }

            }else if ($_GET["action"] == "dospely") {
                $id_udalost = $_GET['id_udalost'];
                $id_osoba = $_SESSION['identity']['idOsoba'];
                $auto_jede = new AutoJede(Pripojeni::getPdoInstance());
                $osoba_jede = new OsobaJede(Pripojeni::getPdoInstance());
                $pocet_mist = $osoba_jede->veKteremJeduAute($id_udalost, $id_osoba);
                $role = $osoba_jede->roleRegistraceNaTurnaj($id_udalost, $id_osoba);
                $id_osoba_jede = $osoba_jede->vratOsobaJedeID($id_udalost, $id_osoba, $role);
                $id_auto_jede = $osoba_jede->vratAutoJedeID($id_udalost, $id_osoba, $role);
                if ($auto_jede->getVratBeruAuto($id_udalost, $id_osoba) && $osoba_jede->jeduVeSvemAute($id_udalost, $id_osoba)){
                    $osoba_jede->odeberOsobaJedeVsechnyVAute($id_auto_jede);
                    $auto_jede->odeberAuto($id_auto_jede);
                }else if($auto_jede->getVratBeruAuto($id_udalost, $id_osoba) && $osoba_jede->jeduVeSvemAute($id_udalost, $id_osoba) == false){
                    $id_meho_auta = $auto_jede->vratIDMehoAuta($id_udalost, $id_osoba);
                    $osoba_jede->odeberOsobaJedeVsechnyVAute($id_meho_auta);
                    $auto_jede->odeberAuto($id_meho_auta);
                    $osoba_jede->odeberOsobaJede($id_osoba_jede);
                    $pocet_mist = $pocet_mist + 1;
                    $auto_jede->upravAutoPocetMist($id_auto_jede, $pocet_mist);
                }
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
                            <option value="ridic">Řidič</option>
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
            }else if ($_GET["action"] == "uprava") {
                $id_udalost = $_GET['id_udalost'];
                $id_osoba = $_SESSION['identity']['idOsoba'];
                $auto_jede = new AutoJede(Pripojeni::getPdoInstance());
                $osoba_jede = new OsobaJede(Pripojeni::getPdoInstance());
                $pocet_mist = $osoba_jede->veKteremJeduAute($id_udalost, $id_osoba);
                $role = $osoba_jede->roleRegistraceNaTurnaj($id_udalost, $id_osoba);
                $id_osoba_jede = $osoba_jede->vratOsobaJedeID($id_udalost, $id_osoba, $role);
                $id_auto_jede = $osoba_jede->vratAutoJedeID($id_udalost, $id_osoba, $role);
                if ($auto_jede->getVratBeruAuto($id_udalost, $id_osoba) && $osoba_jede->jeduVeSvemAute($id_udalost, $id_osoba)){
                    $osoba_jede->odeberOsobaJedeVsechnyVAute($id_auto_jede);
                    $auto_jede->odeberAuto($id_auto_jede);
                }else if($auto_jede->getVratBeruAuto($id_udalost, $id_osoba) && $osoba_jede->jeduVeSvemAute($id_udalost, $id_osoba) == false){
                    $id_meho_auta = $auto_jede->vratIDMehoAuta($id_udalost, $id_osoba);
                    $osoba_jede->odeberOsobaJedeVsechnyVAute($id_meho_auta);
                    $auto_jede->odeberAuto($id_meho_auta);
                    $osoba_jede->odeberOsobaJede($id_osoba_jede);
                    $pocet_mist = $pocet_mist + 1;
                    $auto_jede->upravAutoPocetMist($id_auto_jede, $pocet_mist);
                }

                $conn = Pripojeni::getPdoInstance();
                $auto = new Auto($conn);
                if ($auto->mamAuto()) {
                    echo "<h2 class='nadpis'>Chci řídit svoje auto ?</h2>";
                    ?>
                    <ul>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL .
                            "?page=udalost_typ_auta&action=ano&id_udalost=$id_udalost" ?>">Ano</a>
                        </li>
                        <li style="display: inline"><a class="tabulka_tlacitko" href="<?= BASE_URL .
                            "?page=udalost_typ_auta&action=nechci&id_udalost=$id_udalost" ?>">Ne</a>
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

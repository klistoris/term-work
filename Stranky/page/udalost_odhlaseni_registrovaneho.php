<?php if (Autentizace::getInstance()->getIdentity()["role"]=="registrovany") : ?>
    <section id="cover_photo">
        <div>
            <h1>Odhlášení z události</h1>
        </div>
    </section>
    <main>
        <?php
        if ($_GET["action"] == "odhlas") {
            $id = $_GET["id"];
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($errors)) {
                $id_udalost = $_GET['id'];
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
                    header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                }else if($auto_jede->getVratBeruAuto($id_udalost, $id_osoba) && $osoba_jede->jeduVeSvemAute($id_udalost, $id_osoba) == false){
                    $id_meho_auta = $auto_jede->vratIDMehoAuta($id_udalost, $id_osoba);
                    $osoba_jede->odeberOsobaJedeVsechnyVAute($id_meho_auta);
                    $auto_jede->odeberAuto($id_meho_auta);
                    $osoba_jede->odeberOsobaJede($id_osoba_jede);
                    $pocet_mist = $pocet_mist + 1;
                    $auto_jede->upravAutoPocetMist($id_auto_jede, $pocet_mist);
                    header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                }else{
                    if ($role == "spolujezdec_dospely"){
                        $osoba_jede->odeberOsobaJede($id_osoba_jede);
                        $pocet_mist = $pocet_mist + 1;
                        $auto_jede->upravAutoPocetMist($id_auto_jede, $pocet_mist);
                        header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                    }else if ($role == "ridic"){
                        $osoba_jede->odeberOsobaJede($id_osoba_jede);
                        $pocet_mist = $pocet_mist + 1;
                        $auto_jede->upravAutoPocetMist($id_auto_jede, $pocet_mist);
                        header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                    }else if ($role == "spolujezdec_dite") {
                        $osoba_jede->odeberOsobaJede($id_osoba_jede);
                        $pocet_mist = $pocet_mist + 2;
                        $auto_jede->upravAutoPocetMist($id_auto_jede, $pocet_mist);
                        header('Location: ?page=udalost_moje_udalosti&action=zucastnim_se');
                    }
                }
            }
        }

        ?>
        <div class="form_registrace">
            <h2>Opravdu se chcete odhlásit z události ?</h2>
            <form method="post">
                <input type="submit" value="Odebrat událost">
            </form>
        </div>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
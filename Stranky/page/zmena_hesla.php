<?php if (Autentizace::getInstance()->getIdentity()["role"]=="registrovany") : ?>
    <section id="cover_photo">
        <div>
            <h1>Změna hesla</h1>
        </div>
    </section>
    <main>

        <?php
        if ($_GET["action"] == "zmena_hesla") {
            $id = $_SESSION["identity"]['idOsoba'];
            $userDao = new Uzivatel(Pripojeni::getPdoInstance());
            $uzivatel = $userDao->getOneUzivatelID($id);
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($errors)) {
                $heslo =$_POST["heslo"];
                $heslo_sifrovane = password_hash($heslo,PASSWORD_BCRYPT);
                $pom = new Uzivatel(Pripojeni::getPdoInstance());
                $pom->zmenHeslo($id, $heslo_sifrovane);
                $odhlaseni = Autentizace::getInstance();
                $odhlaseni->logout();
                header('Location: ?page=uvod');
            }
        }
        ?>

        <div class="form_registrace">
            <h2 class="nadpis">Změna hesla</h2>
            <form method="post" >
               <label>Nové heslo:</label>
                <input name="heslo" type="text" placeholder="Vložte nové heslo"/>
                <input type="submit" value="Změň heslo">
            </form>
        </div>
        <br>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
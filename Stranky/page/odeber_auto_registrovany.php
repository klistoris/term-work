<?php if (Autentizace::getInstance()->getIdentity()["role"]=="registrovany") : ?>
    <section id="cover_photo">
        <div>
            <h1>Odeber auto</h1>
        </div>
    </section>
    <main>
        <?php
        if ($_GET["action"] == "odebrat_registrovany") {
            $id = $_GET["id"];

        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($errors)) {
                $pom = new Auto(Pripojeni::getPdoInstance());
                $pom->odeberAuto($id);
                header('Location: ?page=auto_moje_auta&action=registrovany');
            }
        }

        ?>
        <div class="form_registrace">
            <h2>Opravdu chcete odebrat auto ?</h2>
            <form method="post">
                <input type="submit" value="Odebrat auto">
            </form>
        </div>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
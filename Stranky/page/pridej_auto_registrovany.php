<?php if (Autentizace::getInstance()->getIdentity()["role"] == "registrovany") : ?>
    <section id="cover_photo">
        <div>
            <h1>Přidej auto</h1>
        </div>
    </section>
    <main>
        <?php
        $conn = Pripojeni::getPdoInstance();
        $userDao = new Auto($conn);
        $udalost = $userDao->getEmailUzivatelu();

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            if (empty($errors)) {

                $pom = new Auto(Pripojeni::getPdoInstance());
                $pom->vlozAutoBezMajitele($_POST["znacka"], $_POST["mist"], $_POST["typ"]);
            }
        }

        ?>

        <div class="form_registrace">
            <h2 class="nadpis">Přidat auto</h2>
            <form method="post">
                <label>Značka:</label>
                <input name="znacka" type="text" placeholder="Vložte značku" required/>
                <label>Počet míst:</label>
                <input name="mist" type="number" min="0" placeholder="Vložte počet míst" required/>
                <label>Typ:</label>
                <input name="typ" type="text" placeholder="Vložte typ" required/>
                </select>
                <input type="submit" value="Přidat auto">
            </form>
        </div>
        <br>
    </main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
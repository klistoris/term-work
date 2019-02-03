<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
<section id="cover_photo">
    <div>
        <h1>Upravit auto</h1>
    </div>
</section>
<main>
    <?php
    $conn = Pripojeni::getPdoInstance();
    $userDao = new Auto($conn);
    $udalost = $userDao->getEmailUzivatelu();

    if ($_GET["action"] == "uprava") {
        $id = $_GET["id"];
        $userDao = new Auto(Pripojeni::getPdoInstance());
        $auto = $userDao->getOneAuto($id);
        $znacka = $auto[0]["znacka"];
        $mist = $auto[0]["pocet_mist"];
        $typ = $auto[0]["typ"];
        $majitel = $auto[0]["majitel"];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {
            $pom = new Auto(Pripojeni::getPdoInstance());
            $pom->upravAuto($id, $_POST["znacka"], $_POST["mist"], $_POST["typ"], $_POST["majitel"]);
            header('Location: ?page=auto&action=auto');
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Upravit auto</h2>
        <form method="post" >
            <label>Značka:</label>
            <input name="znacka" type="text" required value='<?=$znacka ?>' placeholder=<?php echo $znacka?>/>
            <label>Počet míst:</label>
            <input name="mist" type="text" required value='<?=$mist ?>' placeholder=<?php echo $mist?>/>
            <label>Typ:</label>
            <input name="typ" type="text" required value='<?=$typ ?>' placeholder=<?php echo $typ?>/>
            <label>Majitel:</label>
            <select>
            <?php
            foreach ($udalost as $pom) {
                echo '<option value="' . $pom['majitel'] . '">' . $pom['email'] . '</option>';
            }
            ?>
            </select>
            <input type="submit" value="Upravit auto">
        </form>
    </div>
    <br>
</main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
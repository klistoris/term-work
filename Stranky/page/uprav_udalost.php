<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
<section id="cover_photo">
    <div>
        <h1>Uprav událost</h1>
    </div>
</section>
<main>
    <?php
    if ($_GET["action"] == "uprava") {
        $id = $_GET["id"];
        $userDao = new Udalost(Pripojeni::getPdoInstance());
        $udalost = $userDao->getOneUdalost($id);
        $nazev = $udalost[0]["nazev_udalosti"];
        $datum = $udalost[0]["datum_konani"];
        $cas = $udalost[0]["cas_konani"];
        $misto = $udalost[0]["misto_konani"];
        $popis = $udalost[0]["popis_udalosti"];
    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {
            $pom = new Udalost(Pripojeni::getPdoInstance());
            $pom->upravUdalost($id, $_POST["nazev"], $_POST["datum"], $_POST["cas"], $_POST["misto"], $_POST["popis"]);
            header('Location: ?page=udalost&action=udalost');
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Úprava událost</h2>
        <form method="post" >
            <label>Název:</label>
            <input name="nazev" type="text" required value='<?=$nazev ?>' placeholder=<?php echo $nazev?>/>
            <label>Datum:</label>
            <input name="datum" type="date" required value='<?=$datum ?>' placeholder=<?php echo $datum?>/>
            <label>Čas:</label>
            <input name="cas" type="time" required value='<?=$cas ?>' placeholder=<?php echo $cas?>/>
            <label>Místo konání:</label>
            <input name="misto" type="text" required value='<?=$misto ?>' placeholder=<?php echo $misto?>/>
            <label>Popis:</label>
            <input name="popis" type="text" required value='<?=$popis ?>' placeholder=<?php echo $popis?>/>
            <input type="submit" value="Upravit událost">
        </form>
    </div>
    <br>
</main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
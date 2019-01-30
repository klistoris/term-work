<section id="cover_photo">
    <div>
        <h1>Přidej událost</h1>
    </div>
</section>
<main>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {

            $pom = new Uzivatel(Pripojeni::getPdoInstance());
            $pom->vlozUzivatele($_POST["jmeno"], $_POST["prijmeni"], $_POST["vek"], $_POST["telefon"],
                $_POST["email"], $_POST["heslo"], $_POST["role"]);
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Přidat událost</h2>
        <form method="post" >
            <label>Název:</label>
            <input name="nazev" type="text" placeholder="Vložte název"/>
            <label>Datum:</label>
            <input name="datum" type="text" placeholder="Vložte datum ve formátu: DD-MM-YYYY HH:MM:SS"/>
            <label>Místo konání:</label>
            <input name="misto" type="text" placeholder="Vložte místo"/>
            <label>Popis:</label>
            <input name="popis" type="text" placeholder="Vložte popis"/>
            <input type="submit" value="Přidat událost">
        </form>
    </div>
    <br>
</main>
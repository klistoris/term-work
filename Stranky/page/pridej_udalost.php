<section id="cover_photo">
    <div>
        <h1>Přidej událost</h1>
    </div>
</section>
<main>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {

            $pom = new Udalost(Pripojeni::getPdoInstance());
            $pom->vlozUdalost($_POST["nazev"], $_POST["datum"], $_POST["misto"], $_POST["popis"]);
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Přidat událost</h2>
        <form method="post" >
            <label>Název:</label>
            <input name="nazev" type="text" placeholder="Vložte název"/>
            <label>Datum:</label>
            <input name="datum" type="text" placeholder="Vložte datum ve formátu: YYYY-MM-DD HH:MM:SS"/>
            <label>Místo konání:</label>
            <input name="misto" type="text" placeholder="Vložte místo"/>
            <label>Popis:</label>
            <input name="popis" type="text" placeholder="Vložte popis"/>
            <input type="submit" value="Přidat událost">
        </form>
    </div>
    <br>
</main>
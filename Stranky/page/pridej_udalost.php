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
            $pom->vlozUdalost($_POST["nazev"], $_POST["datum"], $_POST["cas"], $_POST["misto"], $_POST["popis"]);
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Přidat událost</h2>
        <form method="post" >
            <label>Název:</label>
            <input name="nazev" type="text" placeholder="Vložte název" required/>
            <label>Datum:</label><br>
            <input name="datum" type="date" required/><br><br>
            <label>Čas:</label><br>
            <input name="cas" type="time"required/><br><br>
            <label>Místo konání:</label>
            <input name="misto" type="text" placeholder="Vložte místo" required/>
            <label>Popis:</label>
            <input name="popis" type="text" placeholder="Vložte popis" required/>
            <input type="submit" value="Přidat událost">
        </form>
    </div>
    <br>
</main>
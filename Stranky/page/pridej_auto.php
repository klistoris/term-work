<section id="cover_photo">
    <div>
        <h1>Přidej auto</h1>
    </div>
</section>
<main>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {

            $pom = new Auto(Pripojeni::getPdoInstance());
            $pom->vlozauto($_POST["znacka"], $_POST["mist"], $_POST["typ"], $_POST["majitel"]);
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Přidat auto</h2>
        <form method="post" >
            <label>Značka:</label>
            <input name="znacka" type="text" placeholder="Vložte značku"/>
            <label>Počet míst:</label>
            <input name="mist" type="text" placeholder="Vložte počet míst"/>
            <label>Typ:</label>
            <input name="typ" type="text" placeholder="Vložte typ"/>
            <label>Majitel:</label>
            <input name="majitel" type="text" placeholder="Vložte majitele"/>
            <input type="submit" value="Přidat auto">
        </form>
    </div>
    <br>
</main>
<section id="cover_photo">
    <div>
        <h1>Odeber uživatele</h1>
    </div>
</section>
<main>
    <?php
    if ($_GET["action"] == "odebrat") {
        $id = $_GET["id"];

    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {
            $pom = new Uzivatel(Pripojeni::getPdoInstance());
            $pom->odeberUzivatele($id);
        }
    }

    ?>
    <div class="form_registrace">
        <h2>Opravdu chcete odebrat uživatele ?</h2>
        <form method="post">
            <input type="submit" value="Odebrat uživatele">
        </form>
    </div>
</main>


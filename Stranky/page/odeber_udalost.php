<section id="cover_photo">
    <div>
        <h1>Odeber událost</h1>
    </div>
</section>
<main>
    <?php
    if ($_GET["action"] == "odeber") {
        $id = $_GET["id"];

    }

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {
            $pom = new Udalost(Pripojeni::getPdoInstance());
            $pom->odeberUdalost($id);
        }
    }

    ?>
    <div class="form_registrace">
        <h2>Opravdu chcete odebrat událost ?</h2>
        <form method="post">
            <input type="submit" value="Odebrat událost">
        </form>
    </div>
</main>
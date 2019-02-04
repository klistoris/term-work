<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
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
            try {
                $pom = new Udalost(Pripojeni::getPdoInstance());
                $pom->odeberUdalost($id);
                header('Location: ?page=udalost&action=udalost');
            }catch (PDOException $exception){
                echo "<h3>Nelze odebrat událost, protože je na ní někdo přihlášený</h3>";
            }
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

<?php else: include "uvod.php" ?>

<?php endif; ?>
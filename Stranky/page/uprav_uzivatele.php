<?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
<section id="cover_photo">
    <div>
        <h1>Uprav uživatele</h1>
    </div>
</section>
<main>

    <?php
    if ($_GET["action"] == "uprava") {
    $id = $_GET["id"];
    $userDao = new Uzivatel(Pripojeni::getPdoInstance());
    $uzivatel = $userDao->getOneUzivatelID($id);
    $jmeno = $uzivatel[0]["jmeno"];
    $prijmeni = $uzivatel[0]["prijmeni"];
    $email = $uzivatel[0]["email"];
    $vek = $uzivatel[0]["vek"];
    $telefon = $uzivatel[0]["telefon"];
    $heslo = $uzivatel[0]["heslo"];
    $role = $uzivatel[0]["role"];
    }



    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {
            $heslo =$_POST["heslo"];
            $heslo_sifrovane = password_hash($heslo,PASSWORD_BCRYPT);
            $pom = new Uzivatel(Pripojeni::getPdoInstance());
            $pom->upravUzivatele($id, $_POST["jmeno"], $_POST["prijmeni"], $_POST["email"], $_POST["vek"],
                $_POST["telefon"], $heslo_sifrovane, $_POST["role"]);
                header('Location: ?page=uzivatel&action=sprava-uzivatelu');
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Upravit uživatele</h2>
        <form method="post" >
            <label>Jméno:</label>
            <input name="jmeno" type="text" required value='<?=$jmeno ?>' placeholder=<?php echo $jmeno?>/>
            <label>Příjmeni:</label>
            <input name="prijmeni" type="text" required value='<?=$prijmeni ?>' placeholder=<?php echo $prijmeni?>/>
            <label>Email:</label>
            <input name="email" type="text" required value='<?=$email ?>' placeholder=<?php echo $email?>/>
            <label>Věk:</label>
            <input name="vek" type="text" required value='<?=$vek ?>' placeholder=<?php echo $vek?>/>
            <label>Telefon:</label>
            <input name="telefon" type="text" required value='<?=$telefon ?>' placeholder=<?php echo $telefon?>/>
            <label>Heslo:</label>
            <input name="heslo" type="text" required value='<?=$heslo ?>' placeholder=<?php echo $heslo?>/>
            <label>Role:</label>
            <select name="role">
                <option value="administrator">Administrátor</option>
                <option value="registrovany">Registrovaný</option>
            </select>
            <input type="submit" value="Upravit uživatele">
        </form>
    </div>
    <br>
</main>

<?php else: include "uvod.php" ?>

<?php endif; ?>
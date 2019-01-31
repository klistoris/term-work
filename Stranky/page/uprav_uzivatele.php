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
    $uzivatel = $userDao->getOneUzivatel($id);
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
            $pom = new Uzivatel(Pripojeni::getPdoInstance());
            $pom->upravUzivatele($id, $_POST["jmeno"], $_POST["prijmeni"], $_POST["email"], $_POST["vek"],
                $_POST["telefon"], $_POST["heslo"], $_POST["role"]);
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Upravit uživatele</h2>
        <form method="post" >
            <label>Jméno:</label>
            <input name="jmeno" type="text" value='<?=$jmeno ?>' placeholder=<?php echo $jmeno?>/>
            <label>Heslo:</label>
            <input name="prijmeni" type="text" value='<?=$prijmeni ?>' placeholder=<?php echo $prijmeni?>/>
            <label>Email:</label>
            <input name="email" type="text" value='<?=$email ?>' placeholder=<?php echo $email?>/>
            <label>Věk:</label>
            <input name="vek" type="text" value='<?=$vek ?>' placeholder=<?php echo $vek?>/>
            <label>Telefon:</label>
            <input name="telefon" type="text" value='<?=$telefon ?>' placeholder=<?php echo $telefon?>/>
            <label>Heslo:</label>
            <input name="heslo" type="text" value='<?=$heslo ?>' placeholder=<?php echo $heslo?>/>
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
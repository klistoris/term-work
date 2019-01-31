<section id="cover_photo">
    <div>
        <h1>Přidej uživatele</h1>
    </div>
</section>
<main>
    <?php
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (empty($errors)) {


            $heslo =$_POST["heslo"];
            $heslo_sifrovane = password_hash($heslo,PASSWORD_BCRYPT);

            $pom = new Uzivatel(Pripojeni::getPdoInstance());
            $pom->vlozUzivatele($_POST["jmeno"], $_POST["prijmeni"], $_POST["vek"], $_POST["telefon"],
                $_POST["email"], $heslo_sifrovane, $_POST["role"]);
        }
    }

    ?>

    <div class="form_registrace">
        <h2 class="nadpis">Přidat uživatele</h2>
        <form method="post" >
            <label>Jméno:</label>
            <input name="jmeno" type="text" placeholder="Vložte jméno" required/>
            <label>Přijmení:</label>
            <input name="prijmeni" type="text" placeholder="Vložte příjmení" required/>
            <label>Email:</label>
            <input name="email" type="text" placeholder="Vložte email" required/>
            <label>Věk:</label>
            <input name="vek" type="text" placeholder="Vložte věk" required/>
            <label>Telefon:</label>
            <input name="telefon" type="text" placeholder="Vložte telefon" required/>
            <label>Heslo:</label>
            <input name="heslo" type="text" placeholder="Vložte heslo" required/>
            <label>Role:</label>
            <select name="role">
                <option name= "admin" value="administrator">Admin</option>
                <option name= "registrovany" value="registrovany">Registrovaný</option>
            </select>
            <input type="submit" value="Přidat uživatele">
        </form>
    </div>
    <br>
</main>


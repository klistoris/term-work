<section id="cover_photo">
    <div>
        <h1>Přidej uživatele</h1>
    </div>
</section>
<main>
    <div align="center">
        <h2 class="nadpis">Přidání uživatele</h2>
        <form action="./page/prihlaska.php" >
            <label style="padding-right: 22px">Jméno:</label>
            <input name="firstname" type="text" placeholder="Vložte jméno">
            <br>
            <label style="padding-right: 10px;">Heslo:</label>
            <input name="lastname" type="text" placeholder="Vložte příjmení">
            <br>
            <label style="padding-right: 30px">Email:</label>
            <input name="mail" type="text" placeholder="Vložte email">
            <br>
            <label style="padding-right: 21px">Role:</label>
            <select name="rocnik" style="padding-left: 85px">
                <option value="admin">Admin</option>
                <option value="registrovany">Registrovaný</option>
            </select>
            <br>
            <br>
            <input type="submit" value="Přidat uživatele">
        </form>
    </div>
    <br>



</main>


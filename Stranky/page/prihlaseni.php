<section id="cover_photo">
    <div>
        <h1>PřihlášeníFagots</h1>
    </div>
</section>
<main>
    <h1>Přihlášení do systému</h1>
    <hr>
    <?php

    if (!empty($_POST) && !empty($_POST["loginMail"]) && !empty($_POST["loginPassword"])) {
        $authService = Authentication::getInstance();
        if ($authService->login($_POST["loginMail"], $_POST["loginPassword"])) {
            header("Location:" . BASE_URL);
        } else {
            echo "Uživatel nenalezen";
        }
    } else if (!empty($_POST)) {
        echo "Přihlašovací jméno a heslo jsou povinné";
    }

    ?>

    <br>

    <form method="post">
        <label style="padding-right: 10px">Přihlašovací jméno:</label>

        <input type="email" name="loginMail" placeholder="Vložte email">
        <br>
        
        <label style="padding-right: 104px">Heslo:</label>
        <input type="password" name="loginPassword" placeholder="Vložte heslo">
        <br><br>
        <input type="submit" value="Přihlásit">

    </form>

    <br><br>

</main>
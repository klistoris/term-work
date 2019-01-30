<section id="cover_photo">
    <div>
        <h1>Přihlášení</h1>
    </div>
</section>
<main>
    <h1>Přihlášení do systému</h1>
    <?php

    if (!empty($_POST) && !empty($_POST["loginMail"]) && !empty($_POST["loginPassword"])) {
        $authService = Autentizace::getInstance();
        if ($authService->login($_POST["loginMail"], $_POST["loginPassword"])) {
            header("Location:" . BASE_URL);
        } else {
            echo "Uživatel nenalezen";
        }
    } else if (!empty($_POST)) {
        echo "Přihlašovací jméno a heslo jsou povinné";
    }

    ?>

    <div class="form_registrace">
    <form method="post">
        <label for="login">Přihlašovací jméno:</label>
        <input type="email" name="loginMail" fname="login" placeholder="Vložte email">
        <label>Heslo:</label>
        <input type="password" name="loginPassword" placeholder="Vložte heslo">
        <input type="submit" value="Přihlásit">

    </form>
    </div>
</main>
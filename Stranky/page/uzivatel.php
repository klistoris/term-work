
<section id="cover_photo">
    <div>
        <h1>Uživatelé</h1>
    </div>
</section>
<main>
    <?php
    if ($_GET["action"] == "sprava-uzivatelu") {
        echo "<h2>Správa uživatelů</h2>";
        $userDao = new UserRepository(Connection::getPdoInstance());
        $allUsersResult = $userDao->getAllUsers();

        $datatable = new DataTable($allUsersResult);
        $datatable->addColumn("idUzivatel", "ID");
        $datatable->addColumn("email", "Email");
        $datatable->addColumn("jmeno", "Jmeno");
        $datatable->render();


    } else if ($_GET["action"] == "podle-emailu") {
        echo "<h2>Vyhledávání podle emailů</h2>";

        ?>

        <form method="post">
            <input type="text" name="mail" placeholder="insert email address" >
            <input type="submit" value="Find by email">
        </form>

        <?php

        if (!empty($_POST["mail"])) {
            $conn = Connection::getPdoInstance();
            $userDao = new UserRepository($conn);
            $usersByEmail = $userDao->getByEmail($_POST["mail"]);
            $datatable = new DataTable($usersByEmail);
            $datatable->addColumn("idUzivatel", "ID");
            $datatable->addColumn("email", "Email");
            $datatable->addColumn("jmeno", "Jmeno");
            $datatable->render();
        }

    }
    ?>
    <br>



</main>


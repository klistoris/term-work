<div id="header-web-title"><img id="header-logo" src="./obrazky/logo.png" alt="Smiley face"></div>

<nav>
    <a href="<?= BASE_URL . "?page=uvod" ?>">Úvod</a>
    <a href="<?= BASE_URL . "?page=historie" ?>">Historie</a>
    <a href="<?= BASE_URL . "?page=tymy" ?>">Týmy</a>
    <a href="<?= BASE_URL . "?page=partneri" ?>">Partneři</a>
    <a href="<?= BASE_URL . "?page=kontakty"?>">Kontakt</a>
    <?php if (Autentizace::getInstance()->getIdentity()["role"]=="administrator") : ?>
        <a href="<?= BASE_URL . "?page=uzivatel&action=sprava-uzivatelu" ?>">Uživatelé</a>
        <a href="<?= BASE_URL . "?page=uzivatel&action=podle-emailu" ?>">Vyhledávání uživatelů</a>
        <a href="<?= BASE_URL . "?page=udalost&action=udalost" ?>">Události</a>
        <a href="<?= BASE_URL . "?page=auto&action=auto" ?>">Auta</a>
        <a href="<?= BASE_URL . "?page=logout" ?>">Odhlášení</a>
    <?php elseif (Autentizace::getInstance()->getIdentity()["role"]=="registrovany") :?>
        <a href="<?= BASE_URL . "?page=udalost&action=registrovany" ?>">Události</a>
        <a href="<?= BASE_URL . "?page=udalost_moje_udalosti&action=zucastnim_se" ?>">Moje události</a>
        <a href="<?= BASE_URL . "?page=auto_moje_auta&action=registrovany" ?>">Moje auta</a>
        <a href="<?= BASE_URL . "?page=zmena_hesla&action=zmena_hesla" ?>">Změna hesla</a>
        <a href="<?= BASE_URL . "?page=logout" ?>">Odhlášení</a>
    <?php else: ?>
        <a href="<?= BASE_URL . "?page=prihlaseni" ?>">Přihlášení</a>
    <?php endif; ?>

</nav>

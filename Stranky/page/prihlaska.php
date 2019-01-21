<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" type="text/css" href="../layout.css">
    <title>FBC Letohrad</title>
</head>
<body>
<header>
    <?php
    include 'header.php'
    ?>
</header>
<section id="cover_photo">
    <div>
        <h1>Přihláška</h1>
    </div>
</section>
<main>
<div class="formular">
    <h1>Přihlášení</h1>
    <hr>
    <div>
        <form action="./page/prihlaska.php" >
            Jméno:
            <input name="firstname" type="text">
            <br>
            Příjmení:
            <input name="lastname" type="text">
            <br>
            Email:
            <input name="mail" type="text">
            <br>
            Ročník:
            <select name="rocnik">
                <option value="1980">1980</option>
                <option value="1981">1981</option>
                <option value="1982">1982</option>
                <option value="1983">1983</option>
                <option value="1984">1984</option>
                <option value="1985">1985</option>
                <option value="1986">1986</option>
                <option value="1987">1987</option>
                <option value="1988">1988</option>
                <option value="1989">1989</option>
                <option value="1990">1990</option>
                <option value="1991">1991</option>
                <option value="1992">1992</option>
                <option value="1993">1993</option>
                <option value="1994">1994</option>
                <option value="1995">1995</option>
                <option value="1996">1996</option>
                <option value="1997">1997</option>
                <option value="1998">1998</option>
                <option value="1999">1999</option>
                <option value="2000">2000</option>
                <option value="2001">2001</option>
                <option value="2002">2002</option>
                <option value="2003">2003</option>
                <option value="2004">2004</option>
                <option value="2005">2005</option>
                <option value="2006">2006</option>
                <option value="2007">2007</option>
                <option value="2008">2008</option>
                <option value="2009">2009</option>
                <option value="2010">2010</option>
            </select>
            <br>
            Kategorie:
            <select name="kategorie">
                <option value="mladsi">Mladší žáci</option>
                <option value="starsi">Starší žáci</option>
                <option value="dorost">Dorostenci</option>
                <option value="muzi">Muži</option>
            </select>
            <br>
            Držení hole:
            <select name="drzeni_hole">
                <option value="vpravo">Vpravo</option>
                <option value="vlevo">Vlevo</option>
            </select>
            <br>
            Pozice:
            <select name="pozice">
                <option value="brankar">Brankář</option>
                <option value="obrance">Obránce</option>
                <option value="centr">Centr</option>
                <option value="utocnik">Útočník</option>
            </select>
            <br><hr><br>
            <input type="submit">
        </form>
        <br>
    </div>
</div>

</main>
<footer>
    <?php
    include 'footer.php'
    ?>
</footer>
</body>
</html>
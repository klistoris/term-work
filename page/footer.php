<div class="full-width-wrapper">
    <div class="flex-wrap">
        <section>
            <h4>About me</h4>
            <ul>
                <li><a href="#">Work with me</a> </li>
                <li><a href="#">References</a> </li>
                <li><a href="#">Contact</a> </li>
                <li><a href="#">Authors</a> </li>
                <li><a href="#">Login</a> </li>
            </ul>
        </section>

        <section>
            <h4>Blog news</h4>
            <ol>
                <li><a href="#">New article #1</a></li>
                <li><a href="#">New article #2</a></li>
                <li><a href="#">New article #3</a></li>
                <li><a href="#">New article #4</a></li>
                <li><a href="#">New article #5</a></li>
            </ol>
        </section>

        <section>
            <h4>Contact</h4>
            <address>
                Edyho, s. r. o.<br>
                2345 Pacific Coast Highway <br>
                USA<br>
                +420 123 456 789<br>
                Email: <a href="mailto:edy@iwww.cz"> edy@iwww.cz</a><br>
            </address>
        </section>

        <section id="footer-newsletter">
            <h4>Newsletter</h4>
            <p><?php
                if(!empty($message)){
                    echo $message;
                    $message = "";
                }
                ?></p>
            <form method="POST" action="<?=CURRENT_URL;?>">
                <div>
                    <label>
                        Enter your email address:
                    </label>
                </div>
                <div>
                    <input type="text" name="email">
                </div>
                <div>
                    <input type="submit" name="newsletter" value="Subscribe">
                </div>
            </form>
        </section>

        <section>
            <p>
                Copyleft
                <?= date("Y", strtotime("-1 year")); ?>
                -
                <?php echo date("Y"); ?>
                <a href="https://github.com">
                    Edy
                </a>
            </p>
        </section>
    </div>
</div>
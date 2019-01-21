<?php
/**
 * Created by PhpStorm.
 * User: edwardzarecky
 * Date: 21/01/2019
 * Time: 20:56
 */

Authentication::getInstance()->logout();
header("Location:" . BASE_URL);

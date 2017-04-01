<?php
/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

/**
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 *
 * Created by PhpStorm.
 * User: igor
 * Date: 30/03/17
 * Time: 19.42
 *
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/loader.php");

//define page default name
$title = "Login";

if (isset($_POST['username']) && isset($_POST['password'])) {
    if (count((new Login(new Database()))->doLogin($_POST['username'], $_POST['password'])) == 1) {
        //session_start();
        //header()... TODO: crea pagina principale
        setcookie("login", time(), time() + 120);
        $messaggi = "Login ok";

    } else {
        //TODO:manca controllo già loggato
        $messaggi = "riprova";
    }
} else {
    $messaggi = "prova login";
}

include_once(__APP__ . "view/index.html");

?>



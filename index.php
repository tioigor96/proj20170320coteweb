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
 *
 * Created by PhpStorm.
 * User: igor
 * Date: 30/03/17
 * Time: 19.42
 *
 * This file provide to show login page
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/loader.php");

session_start();

//define page default name
$title = "Login";

if (isset($_SESSION['user'])) { //i'm already logged
    header("Location: " . __URL__ . "ricerca.php");
} else {
    if (isset($_POST['username']) && isset($_POST['password'])) {   //i've try to login?
        try {
            $user = (new Login(new Database()))->doLogin($_POST['username'], $_POST['password']);
        } catch (PDOException $e) {
            die($e->getCode() . ":" . $e->getMessage());
        }

        if (count($user) == 1) {
            $user = new User($user->PK_id, $user->username);
            $_SESSION['user'] = $user;
            header("Location: " . __URL__ . "ricerca.php");
        } else {
            session_destroy();
            $messaggi = "Credenziali errate!";
        }
    } else {
        $messaggi = "Login";
    }
}

include_once(__VIEW__ . "index.html");

?>
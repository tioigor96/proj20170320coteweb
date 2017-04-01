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
 * Date: 01/04/17
 * Time: 17.44
 *
 * This file provide to control and show search on db.
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/loader.php");

session_start();

$title = "Ricerca studente";

if (!isset($_SESSION['user'])) { //i'm not logged
    header("Location: " . __URL__);
    die("Redirect to login");
}

include_once(__VIEW__ . "ricerca.html");

?>
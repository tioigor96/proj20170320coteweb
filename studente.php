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
 * Date: 04/04/17
 * Time: 0.45
 *
 * This page provide to show student information.
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/loader.php");

session_start();

$title = "Informazioni studente";

if (!isset($_SESSION['user'])) {                                //i'm not logged
    header("Location: " . __URL__);
    die("Redirect to login");
}

if (!isset($_GET['id'])) {                                       //Am I visiting this page correctly?
    header("Refresh: 5; url=" . __URL__ . "ricerca.php");
    die("Per accedere a questa pagina deve essere settata una ricerca!");
}

try {
    $search = new StudentControl(new Database());

    $student = $search->searchStudent($_GET['id']);
    $student = $student[0];

    $exams = $search->searchStudentExams($_GET['id']);

    $course = $search->searchStudentCourse($_GET['id']);
    $course = $course['nome'];
} catch (PDOException $e) {
    die($e->getCode() . ":" . $e->getMessage());
}

include_once(__VIEW__ . "studente.html");

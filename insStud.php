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
 * Date: 05/04/17
 * Time: 0.07
 *
 * This page add a student in db.
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/loader.php");

session_start();

$title = "Inserimento studente";

if (!isset($_SESSION['user'])) {                                //i'm not logged
    header("Location: " . __URL__);
    die("Redirect to login");
}

/**
 * @var Database
 */
$db = null;

/**
 * @var array stdClass
 */
$courses = null;

$result = null;

try {                       //get all courses
    $db = new Database();
    $courses = (new CourseController($db))->searchCourse();
} catch (PDOException $e) {
    die($e->getCode() . ":" . $e->getMessage());
}

if (isset($_POST['id'])) {  //need to add a student?
    if (strlen($_POST['name']) > 0 && strlen($_POST['surname']) > 0 &&
        preg_match('/[~!@#\$%\^&\*\(\)=\+\|\[\]\{\};\\:\",\.\<\>\?\/]+/', $_POST['name']) == 0 &&
        preg_match('/[~!@#\$%\^&\*\(\)=\+\|\[\]\{\};\\:\",\.\<\>\?\/]+/', $_POST['surname']) == 0
    ) {
        $studentId = strlen($_POST['id']) > 0 ? intval($_POST['id']) : -1;
        if ($studentId !== 0) {
            try {
                $scontrol = new StudentControl($db);
                $scontrol->insertStudent($_POST['name'], $_POST['surname'], $_POST['date'], $_POST['course'], $studentId);

                $result = "Inserimento completato con successo! Matr.: " . sprintf("%06d", $scontrol->getMaxID());
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $result = "Errore nell'inserimento! &Egrave; presente almeno un campo errato! (Es.: matricola, corso, data)";
                } else {
                    die($e->getCode() . ":" . $e->getMessage());
                }
            }
        } else {
            $result = "Errore! La matricola inserita non è corretta!";
        }
    } else {
        $result = "Errore! Nome e cognome devono essere non vuoti e non contenere simboli speciali!";
    }
}

include_once(__VIEW__ . "insStud.html");
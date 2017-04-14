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
 * Date: 14/04/17
 * Time: 12.32
 *
 * This page add an exam in db.
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/loader.php");

session_start();

$title = "Inserimento esame";

if (!isset($_SESSION['user'])) {                                //i'm not logged
    header("Location: " . __URL__);
    die("Redirect to login");
}

/**
 * @var Database
 */
$db = null;

/**
 * @var ExamControl;
 */
$examController = null;

$students = null;
$subjects = null;
$result = null;

try {
    $db = new Database();

    $examController = new ExamControl($db);

    $students = $examController->getAllStudents();
    $subjects = $examController->getAllSubjects();
} catch (PDOException $e) {
    die($e->getCode() . ":" . $e->getMessage());
}

if (isset($_POST['student'])) {
    if (!$examController->examExists($_POST['student'], $_POST['subject'])) {

        if ($_POST['degree'] < 18 || $_POST['degree'] > 30) {
            $result = "Errore! Il voto deve essere compreso tra 18 e 30 (estremi inclusi)!";
        } else {
            $lode = isset($_POST['lode']) ? 1 : 0;

            try {
                $examController->insertExam($_POST['subject'], $_POST['student'], $_POST['degree'],
                    $lode, $_POST['date'], $_SESSION['user']->getId());

                $result = "Esame registrato correttamente!";
            } catch (PDOException $e) {
                if ($e->getCode() == 23000) {
                    $result = "Errore nell'inserimento! &Egrave; presente almeno un campo errato!";
                } else {
                    die($e->getCode() . ":" . $e->getMessage());
                }
            }

        }
    } else {
        $result = "Errore! L'esame che si cerca di inserire è già stato inserito!";
    }
}

include_once(__VIEW__ . "insExam.html");
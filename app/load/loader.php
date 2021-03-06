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
 * Date: 31/03/17
 * Time: 0.32
 *
 * Autoload all classes and constants
 */

require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/constant.php");
require_once($_SERVER['DOCUMENT_ROOT'] . "/app/load/options.php");

// CONFIGURATION
require_once(__APP__ . "resources/Configuration.php");

//CONTROLLERS
require_once(__CONTROLLER__ . "Database.php");
require_once(__CONTROLLER__ . "Login.php");
require_once(__CONTROLLER__ . "StudentControl.php");
require_once(__CONTROLLER__ . "CourseController.php");
require_once(__CONTROLLER__ . "ExamControl.php");

//MODELS
require_once(__MODEL__ . "Exam.php");
require_once(__MODEL__ . "Student.php");
require_once(__MODEL__ . "User.php");
require_once(__MODEL__ . "Course.php");
require_once(__MODEL__ . "Teacher.php");
require_once(__MODEL__ . "Subject.php");

//VIEWS, NEVER REQUIRE OR INCLUDE HERE, INCLUDE ONLY IN DELEGATED PAGE.
/*
 * require_once(__VIEW__ . "index.html");
 * require_once(__VIEW__ . "footer.html");
 * require_once(__VIEW__ . "menu.html");
 * require_once(__VIEW__ . "header.html");
 * require_once(__VIEW__ . "ricerca.html");
 * require_once(__VIEW__ . "studente.html");
 * require_once(__VIEW__ . "insStud.html");
 * require_once(__VIEW__ . "insExam.html");
 */




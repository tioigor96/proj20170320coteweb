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
 * Time: 20.35
 *
 * This class define <<Student>> table on db.
 */
class Student
{
    /**
     * @var string
     */
    public $id;
    /**
     * @var string
     */
    public $name;
    /**
     * @var string
     */
    public $surname;

    /**
     * @var string
     */
    public $course;

    /**
     * Student constructor.
     * @param string $id
     * @param string $name
     * @param string $surname
     * @param string $course DEFAULT "N/D"
     */
    public function __construct($id, $name, $surname, $course = "N/D")
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
        $this->course = $course;
    }


    /**
     * Select Student(s) from db with id || name || username.
     * @return string
     */
    public static function sq_SelectStudent()
    {
        return "SELECT * FROM studenti 
                WHERE studenti.nome LIKE :name
                      AND studenti.cognome LIKE :surname 
                      AND studenti.matricola LIKE :id";
    }

    /**
     * Select laurea name for student from id.
     * @return string
     */
    public static function sq_SelectStudentCourse()
    {
        return "SELECT lauree.nome
                FROM lauree INNER JOIN studenti ON lauree.PK_id = studenti.FK_laurea
                WHERE studenti.matricola LIKE :id";
    }

    /**
     * Insert new student in <<studenti>> table.
     * Need :id, :name, :surname, :date, :fk_course.
     * @return string
     */
    public static function sq_InsertStudent()
    {
        return "INSERT INTO studenti(matricola, nome, cognome, data_nascita, FK_laurea)
                VALUES(:id, :name, :surname, :date, :fk_course)";
    }

    /**
     * Get maximum id in <<studenti>> table.
     * @return string
     */
    public static function sq_MaxID()
    {
        return "SELECT matricola FROM studenti ORDER BY matricola DESC LIMIT 1";
    }

    /**
     * Get "studenti.matricola, studenti.nome, studenti.cognome, lauree.nome AS c_name",
     * NEED PARAM: :id, :name, :surname, :c_name.
     * @return string
     */
    public static function sq_selectStudentEtCourse()
    {
        return "SELECT studenti.matricola, studenti.nome, studenti.cognome, lauree.nome AS c_name " .
            "FROM studenti INNER JOIN lauree ON studenti.FK_laurea = lauree.PK_id WHERE " .
            "studenti.matricola LIKE :id AND studenti.nome LIKE :name " .
            "AND studenti.cognome LIKE :surname AND lauree.nome LIKE :c_name";
    }

    /**
     * Student toString.
     * @return string
     */
    public function __toString()
    {
        return $this->surname . " " . $this->name . " (" . $this->course . ")";
    }
}
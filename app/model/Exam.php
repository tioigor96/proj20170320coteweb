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
 * Time: 1.03
 *
 * This class define <<esami>> table on db.
 */
class Exam
{
    /**
     * @var string
     */
    public $subject;
    /**
     * @var string
     */
    public $teacher;
    /**
     * @var string
     */
    public $course;
    /**
     * @var int
     */
    public $CFU;
    /**
     * @var string
     */
    public $degree;
    /**
     * @var string
     */
    public $date;
    /**
     * @var string
     */
    public $registerBy;

    /**
     * Exam constructor.
     * @param string $subject
     * @param string $teacher
     * @param string $course
     * @param int $CFU
     * @param string $degree
     * @param string $date
     * @param string $registerBy
     */
    public function __construct($subject, $teacher, $course, $CFU, $degree, $date, $registerBy)
    {
        $this->subject = $subject;
        $this->teacher = $teacher;
        $this->course = $course;
        $this->CFU = $CFU;
        $this->degree = $degree;
        $this->date = $date;
        $this->registerBy = $registerBy;
    }


    /**
     * Select exams for student from id.
     * @return string
     */
    public static function sq_searchExamStudent()
    {
        return "SELECT corsi.nome AS c_name, docenti.nome AS t_name, docenti.cognome AS t_sname,
                       lauree.nome AS l_name, corsi.cfu, esami.voto, esami.lode, esami.data,
                       admin.nome AS a_name, admin.cognome AS a_sname
                FROM esami INNER JOIN admin ON esami.FK_admin = admin.PK_id
                      INNER JOIN studenti ON esami.FK_studente = studenti.matricola
                      INNER JOIN corsi ON esami.FK_corso = corsi.PK_id
                      INNER JOIN docenti ON corsi.FK_docente1 = docenti.PK_id
                      INNER JOIN lauree ON corsi.FK_laurea = lauree.PK_id
                WHERE studenti.matricola LIKE :id
                ORDER BY esami.data ASC";
    }

    /**
     * Select exams. NEED parameters :s_id (studenti.matricola) and :fks_id(esami.FK_corso)
     * @return string
     */
    public static function sq_searchExamStudentSubject()
    {
        return "SELECT * FROM esami WHERE FK_studente LIKE :s_id AND esami.FK_corso = :fks_id";
    }

    /**
     * Insert exam. NEED parameters :fks_id, :s_id, :degree, :lode, :date, :fka_id.
     * @return string
     */
    public static function sq_insertExam()
    {
        return "INSERT INTO esami(FK_corso, FK_studente, voto, lode, data, FK_admin)
                VALUE(:fks_id, :s_id, :degree, :lode, :date, :fka_id)";
    }
}
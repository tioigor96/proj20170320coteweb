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
 * Time: 20.55
 *
 * This class manipulate <<studenti>> table.
 */
class StudentControl
{
    /**
     * @var Database
     */
    private $db;

    /**
     * Login constructor.
     * @param $db : PDO Object initialized and connected to DB.
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Search a student from ID or NAME or SURNAME. Return stdObj array.
     * @param string $id ; DEFAULT "%"
     * @param string $name ; DEFAULT "%"
     * @param string $surname ; DEFAULT "%"
     * @return stdClass[]
     */
    public function searchStudent($id = "%", $name = "%", $surname = "%")
    {
        $id = strlen($id) > 0 ? $id : "%";
        $name = strlen($name) > 0 ? $name : "%";
        $surname = strlen($surname) > 0 ? $surname : "%";

        $sth = $this->db->prepareQuery(Student::sq_SelectStudent());

        $sth->bindParam(":id", $id, PDO::PARAM_STR);
        $sth->bindParam(":name", $name, PDO::PARAM_STR);
        $sth->bindParam(":surname", $surname, PDO::PARAM_STR);

        $sth->execute();
        return $sth->fetchAll(PDO::FETCH_OBJ);
    }

    /**
     * Search student's exams from his id. Return stdClass array.
     * @param $id string
     * @return stdClass[]
     */
    public function searchStudentExams($id)
    {
        $sth = $this->db->prepareQuery(Exam::sq_searchExamStudent());

        $sth->bindParam(":id", $id, PDO::PARAM_STR);

        $sth->execute();

        $exams = array();
        while ($exam = $sth->fetch()) {
            $exams[] = new Exam($exam['c_name'],
                $exam['t_name'] . " " . $exam['t_sname'],
                $exam['l_name'], $exam['cfu'],
                $exam['voto'] . ($exam['lode'] == 1 ? " e lode" : ""),
                date('d/m/Y', strtotime($exam['data'])),
                $exam['a_name'] . " " . $exam['a_sname']);
        }

        return $exams;
    }

    /**
     * Search student's course from id.
     * @param $id
     * @return string
     */
    public function searchStudentCourse($id)
    {
        $sth = $this->db->prepareQuery(Student::sq_SelectStudentCourse());

        $sth->bindParam(":id", $id, PDO::PARAM_STR);
        $sth->execute();

        return $sth->fetch();
    }

    /**
     * @param string $name
     * @param string $surname
     * @param string $date
     * @param string $fk_course
     * @param string $id
     */
    public function insertStudent($name, $surname, $date, $fk_course, $id)
    {
        if (intval($id) <= 0) {
            $id = $this->getMaxID() + 1;
        }

        $id = sprintf("%06d", $id);

        $sth = $this->db->prepareQuery(Student::sq_InsertStudent());

        $sth->bindValue(":id", $id, PDO::PARAM_STR);
        $sth->bindValue(":name", $name, PDO::PARAM_STR);
        $sth->bindValue(":surname", $surname, PDO::PARAM_STR);
        $sth->bindValue(":date", $date, PDO::PARAM_STR);
        $sth->bindValue(":fk_course", $fk_course, PDO::PARAM_INT);

        $sth->execute();
    }

    /**
     * Get current max id number for students.
     * @return int
     */
    public function getMaxID()
    {
        $sth = $this->db->prepareQuery(Student::sq_MaxID());

        $sth->execute();
        $sth = $sth->fetch();
        $val = $sth['matricola'];

        return intval($val);
    }
}
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
 * This class manipulate Student.
 */
class SearchStudent
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
     * @return array
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
     * Search student's exams from his id. Return stdObj array.
     * @param $id string
     * @return array
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
                $exam['voto'] . ($exam['lode']==1 ? " e lode" : ""),
                date('d/m/Y', strtotime($exam['data'])),
                $exam['a_name'] . " " . $exam['a_sname']);
        }

        return $exams;
    }
}
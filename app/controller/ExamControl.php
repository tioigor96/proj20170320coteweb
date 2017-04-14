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
 * Date: 14/04/17
 * Time: 10.51
 *
 * This class manipulate <<esami>> table
 */
class ExamControl
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
     * Get all teachers.
     * @return Teacher[]
     */
    public function getAllTeachers()
    {
        $sth = $this->db->prepareQuery(Teacher::sq__selectTeachers());

        $sth->execute();

        $teachers = array();

        while ($teacher = $sth->fetch()) {
            $teachers[] = new Teacher($teacher['PK_id'], $teacher['nome'] . " " . $teacher['cognome']);
        }

        return $teachers;
    }

    /**
     * Get all subjects.
     * @return Subject[]
     */
    public function getAllSubjects()
    {
        $sth = $this->db->prepareQuery(Subject::sq_selectSubjectsCourse());

        $sth->execute();

        $subjects = array();

        while ($subject = $sth->fetch()) {
            $subjects[] = new Subject($subject['PK_id'], $subject['c_name'], $subject['l_name']);
        }

        return $subjects;
    }

    /**
     * Get all students in db and relatuve course.
     * @return Student[]
     */
    public function getAllStudents()
    {
        $sth = $this->db->prepareQuery(Student::sq_selectStudentEtCourse());

        $sth->bindValue(":id", "%", PDO::PARAM_STR);
        $sth->bindValue(":name", "%", PDO::PARAM_STR);
        $sth->bindValue(":surname", "%", PDO::PARAM_STR);
        $sth->bindValue(":c_name", "%", PDO::PARAM_STR);

        $sth->execute();

        $students = array();

        while ($student = $sth->fetch()) {
            $students[] = new Student($student['matricola'], $student['nome'], $student['cognome'], $student['c_name']);
        }

        return $students;
    }

    /**
     * Decide if an exam for student and subject is already registered.
     * @param $s_id string
     * @param $fks_id int
     * @return bool
     */
    public function examExists($s_id, $fks_id)
    {
        $sth = $this->db->prepareQuery(Exam::sq_searchExamStudentSubject());

        $sth->bindParam(":s_id", $s_id, PDO::PARAM_STR);
        $sth->bindParam(":fks_id", $fks_id, PDO::PARAM_INT);

        $sth->execute();

        return count($sth->fetchAll(PDO::FETCH_OBJ)) > 0 ? TRUE : FALSE;
    }

    /**
     * Insert new exam on <<esami>> table. NEED RECORD VALUE FOR TABLE.
     * @param $subject int
     * @param $stud_id string
     * @param $degree int
     * @param $lode int
     * @param $date string
     * @param $admin int
     */
    public function insertExam($subject, $stud_id, $degree, $lode, $date, $admin)
    {
        $sth = $this->db->prepareQuery(Exam::sq_insertExam());

        $sth->bindValue(":fks_id", $subject, PDO::PARAM_INT);
        $sth->bindValue(":s_id", $stud_id, PDO::PARAM_STR);
        $sth->bindValue(":degree", $degree, PDO::PARAM_INT);
        $sth->bindValue(":lode", $lode, PDO::PARAM_INT);
        $sth->bindValue(":date", $date, PDO::PARAM_INT);
        $sth->bindValue(":fka_id", $admin, PDO::PARAM_INT);

        $sth->execute();
    }
}
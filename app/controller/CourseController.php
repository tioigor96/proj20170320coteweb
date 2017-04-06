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
 * Date: 06/04/17
 * Time: 23.08
 *
 * This Class manipulate <<lauree>> table.
 */
class CourseController
{

    /**
     * @var Database
     */
    private $db;

    /**
     * CourseController constructor.
     * @param $db
     */
    public function __construct($db)
    {
        $this->db = $db;
    }

    /**
     * Select all courses with that name (or part name).
     * @param string $name DEFAULT "%"
     * @param int $partial DEFAULT 1: if equals "1" this means query will be "%$name%", otherwise $name
     * @return array stdClass
     */
    public function searchCourse($name = "%", $partial = 1)
    {
        if ($partial == 1 && $name !== "%") {
            $name = "%" . $name . "%";
        }

        $stm = $this->db->prepareQuery(Course::sq_SelectCourses());

        $stm->bindParam(":name", $name, PDO::PARAM_STR);

        $stm->execute();

        return $stm->fetchAll(PDO::FETCH_OBJ);
    }

}
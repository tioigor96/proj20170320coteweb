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
     * @var PDO
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
     * Search a student from ID or NAME or SURNAME
     * @param string $id; DEFAULT "%"
     * @param string $name; DEFAULT "%"
     * @param string $surname; DEFAULT "%"
     * @return stdObj array
     */
    public function doSearch($id = "%", $name = "%", $surname = "%")
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
}
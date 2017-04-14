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
 * Time: 11.51
 *
 * This class define <<corsi>> table.
 */
class Subject
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $name;

    /**
     * @var string
     */
    public $course;

    /**
     * Subject constructor.
     * @param int $id
     * @param string $name
     */
    public function __construct($id, $name, $course)
    {
        $this->id = $id;
        $this->name = $name;
        $this->course = $course;
    }

    /**
     * Select all subjects from table (corsi.PK_id, corsi.nome AS c_name, lauree.nome AS l_name). No parameters need.
     * @return string
     */
    public static function sq_selectSubjectsCourse()
    {
        return "SELECT corsi.PK_id, corsi.nome AS c_name, lauree.nome AS l_name
                FROM corsi INNER JOIN lauree ON corsi.FK_laurea = lauree.PK_id";
    }

    /**
     * Subject toString.
     * @return string
     */
    public function __toString()
    {
        return $this->name . " (" . $this->course . ")";
    }
}
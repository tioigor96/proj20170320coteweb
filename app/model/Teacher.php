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
 * Time: 10.56
 *
 * This class define <<docenti>> table on db.
 */
class Teacher
{
    /**
     * @var int
     */
    public $id;
    /**
     * @var string
     */
    public $nome;

    /**
     * Teacher constructor.
     * @param int $id
     * @param string $nome
     */
    public function __construct($id, $nome)
    {
        $this->id = $id;
        $this->nome = $nome;
    }


    /**
     * Select all Teachers. no parameters need.
     * @return string
     */
    public static function sq__selectTeachers()
    {
        return "SELECT * FROM docenti";
    }
}
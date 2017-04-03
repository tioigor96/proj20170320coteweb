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
 * Time: 15.41
 *
 *This class define <<User>> table on db.
 */
class User
{
    /**
     * @var int userID on db.user
     */
    private $id;

    /**
     * @var string Username column for UserID on db.user
     */
    private $username;

    public function __construct($id, $username)
    {
        $this->id = $id;
        $this->username = $username;
    }

    /**
     * Return Standard Query for select one user from Username and password.
     * The param must bind on ":username" and ":password".
     *
     * @return string
     */
    public static function sq_SelectUser()
    {
        return "SELECT * FROM admin " .
            "WHERE admin.username LIKE :username " .
            "AND admin.password LIKE :password";
    }

    /**
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }
}
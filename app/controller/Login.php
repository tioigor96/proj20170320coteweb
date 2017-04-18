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
 * Date: 30/03/17
 * Time: 21.09
 *
 * This class control User table and definition methods
 */
class Login
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
     * @param $username
     * @param $password
     * @return mixed
     */
    public function doLogin($username, $password)
    {
        $sth = $this->db->prepareQuery(User::sq_SelectUser());
        $sth->bindValue(":username", $username, PDO::PARAM_STR);
        $sth->bindValue(":password", md5($password), PDO::PARAM_STR);

        $sth->execute();
        return $sth->fetch(PDO::FETCH_OBJ);
    }
}
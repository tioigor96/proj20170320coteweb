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
 */
class Login
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function doLogin($username, $password)
    {
        $sth = $this->db->prepareQuery("SELECT * FROM admin WHERE admin.username LIKE :admin AND admin.password LIKE :password");
        $sth->bindParam(":admin", $username, PDO::PARAM_STR);
        $sth->bindParam(":password", md5($password), PDO::PARAM_STR);

        $sth->execute();
        return count($sth->fetch(PDO::FETCH_OBJ)) == 1 ? true : false;
    }
}
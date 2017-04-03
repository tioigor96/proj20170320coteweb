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
 * Time: 19.26
 *
 * This class get connection information and std dirs.
 */
class Configuration
{
    /**
     * @var contain db connection info
     */
    private $configuration;

    /**
     * configurationClass constructor. Init all attributes
     */
    public function __construct()
    {
        $file = file_get_contents(__CONFJSON__);
        $this->configuration = json_decode($file, TRUE);
    }

    /**
     * return standard domain connection to db
     * @return string
     */
    public function getDSN()
    {
        return 'mysql:host=' . $this->configuration['DATABASE_HOST'] .
            ';dbname=' . $this->configuration['DATABASE_NAME'];
    }

    /**
     * return user for connection to db
     * @return mixed
     */
    public function getDB_User()
    {
        return $this->configuration['DATABASE_USER'];
    }

    /**
     * return password for connection to db
     * @return mixed
     */
    public function getDB_Pass()
    {
        return $this->configuration['DATABASE_PASS'];
    }
}
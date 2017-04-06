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
 * Time: 19.40
 *
 * This class manage the PDO's Connection.
 */
class Database
{
    /**
     * @var PDO
     */
    private $connection;
    /**
     * @var Configuration
     */
    private $configuration;

    /**
     * Database constructor.
     * @param int $attribute; DEFAULT PDO::ATTR_DEFAULT_FETCH_MODE
     * @param int $value; DEFAULT PDO::FETCH_ASSOC
     */
    public function __construct($attribute = PDO::ATTR_DEFAULT_FETCH_MODE, $value = PDO::FETCH_ASSOC)
    {
        $this->configuration = new Configuration();
        $this->connection = new PDO($this->configuration->getDSN(),
            $this->configuration->getDB_User(),
            $this->configuration->getDB_Pass());

        $this->connection->setAttribute($attribute, $value);

        //enable exception in PDO if there is errors in queries.
        $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    /**
     * Return PDO::statement for query
     * @param $query
     * @return PDOStatement
     */
    public function prepareQuery($query)
    {
        return $this->connection->prepare($query);
    }
}
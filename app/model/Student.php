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
 * Time: 20.35
 *
 * This class define <<Student>> table on db.
 */
class Student
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string;
     */
    private $name;
    /**
     * @var string
     */
    private $surname;

    public function __construct($id, $name, $surname)
    {
        $this->id = $id;
        $this->name = $name;
        $this->surname = $surname;
    }

    /**
     * Select Student(s) from db with id || name || username.
     * @return string
     */
    public static function sq_SelectStudent()
    {
        return "SELECT * FROM studenti 
                WHERE studenti.nome LIKE :name
                      AND studenti.cognome LIKE :surname 
                      AND studenti.matricola LIKE :id";
    }

    /**
     * Select exams for student from id.
     * @return string
     */
    public static function sq_SelectExams()
    {
        return "SELECT corsi.nome, docenti.nome, docenti.cognome, lauree.nome, corsi.cfu,
                       esami.voto, esami.lode, esami.data, admin.nome, admin.cognome
                FROM esami
                      INNER JOIN admin ON esami.FK_admin = admin.PK_id
                      INNER JOIN studenti ON esami.FK_studente = studenti.matricola
                      INNER JOIN corsi ON esami.FK_corso = corsi.PK_id
                      INNER JOIN docenti ON corsi.FK_docente1 = docenti.PK_id
                      INNER JOIN lauree ON corsi.FK_laurea = lauree.PK_id
                WHERE studenti.matricola LIKE :id
                ORDER BY esami.data ASC";
    }

    /**
     * @return string
     */
    public function getId(): string
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSurname(): string
    {
        return $this->surname;
    }

}
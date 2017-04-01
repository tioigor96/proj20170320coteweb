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
 * Date: 31/03/17
 * Time: 0.38
 *
 * This class define all constants on project
 */

//################  HOST    ################
/**
 * __ADDR__: Server DNS name
 */
define(__ADDR__, $_SERVER['HTTP_HOST']);

/**
 * __URL__: default url for this site
 */

define(__URL__, (stripos($_SERVER['SERVER_PROTOCOL'], 'https') === true ?
        'https://' : 'http://')
    . $_SERVER['HTTP_HOST'] . "/");


//################  FILES   ################
/**
 * __BASEPATH__ path definition
 */
define(__BASEPATH__, $_SERVER['DOCUMENT_ROOT'] . "/");

/**
 * __APP__ path definition
 */
define(__APP__, __BASEPATH__ . "app/");

/**
 * __RESOURCES__ path definition
 */
define(__RESOURCES__, __APP__ . "resources/");

/**
 * __CONFJSON__ path definition
 */
define(__CONFJSON__, __RESOURCES__ . "config.json");

/**
 * __MODEL__ path definition
 */
define(__MODEL__, __APP__ . "model/");

/**
 * __CONTROL__ path definition
 */
define(__CONTROLLER__, __APP__ . "controller/");

/**
 * __VIEW__ path definition
 */
define(__VIEW__, __APP__ . "view/");

/**
 * __HEADER__ view path definition
 */
define(__HEADER__, __VIEW__ . "header.html");

/**
 * __MENU__ view path definition
 */
define(__MENU__, __VIEW__ . "menu.html");

/**
 * __FOOTER__ view path definition
 */
define(__FOOTER__, __VIEW__ . "footer.html");
<?php
// $Id$
// ----------------------------------------------------------------------
// PostNuke Content Management System
// Copyright (C) 2001 by the PostNuke Development Team.
// http://www.postnuke.com/
// ----------------------------------------------------------------------
// Based on:
// PHP-NUKE Web Portal System - http://phpnuke.org/
// Thatware - http://thatware.org/
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Hinrich Donner
// changed to pn_bbcode: larsneo
// ----------------------------------------------------------------------

/**
 * @package PostNuke_Utility_Modules
 * @subpackage pn_bbcode
 * @license http://www.gnu.org/copyleft/gpl.html
*/

/**
 * main funcion
 * The main function is not used in the pn_bbcode module, we just rediret to index.php
 *
 */
function pn_bbode_user_main()
{
    pnRedirect('index.php');
    return true;
}

/**
 * whatisbbcode
 * The only relevant funtion here displays some help for bbcode tags
 * no parameters needed
 *
 */
function pn_bbcode_user_whatisbbcode()
{
    $pnr =& new pnRender('pn_bbcode');
    return $pnr->fetch('pn_bbcode_user_whatisbbcode.html');
}

?>
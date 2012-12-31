<?php

/**
 * BBCode
 *
 * @license http://www.gnu.org/copyleft/gpl.html
 * @package Zikula_Utility_Modules
 * @subpackage BBCode
 *
 * Please see the NOTICE file distributed with this source code for further
 * information regarding copyright and licensing.
 */
class BBCode_Controller_User extends Zikula_AbstractController
{

    /**
     * main function
     * The main function is not used in the BBCode module, we just redirect to index.php
     *
     */
    public function main()
    {
        return System::redirect(System::getVar('entrypoint', 'index.php'));
    }

    /**
     * whatisBBCode
     * The only relevant funtion here displays some help for BBCode tags
     * no parameters needed
     *
     */
    public function whatisbbcode()
    {
        return $this->view->fetch('user/whatisbbcode.tpl');
    }

}
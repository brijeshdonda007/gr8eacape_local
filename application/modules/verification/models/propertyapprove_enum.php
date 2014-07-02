<?php

/**
* Enum for approving status in property table
*
* @category Enum
* @author Eftakhairul Islam <eftakhairul@gmail.com> (http://eftakhairul.com)
*/
class PropertyApprove_enum extends CI_Model
{
    const UNAPPROVED    = 0;
    const ACCEPTED      = 1;

    /**
     * Return all statuses
     */
    static function findAll()
    {
       return array(
           self::UNAPPROVED  => "UNAPPROVED",
           self::ACCEPTED    => "ACCEPTED",
       );
    }
}

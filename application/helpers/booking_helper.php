<?php
/**
 * Some Utility helper function for Booking process
 *
 * @author: Eftakhairul Islam <eftakhairul@gmail.com>
 */

/**
 * Calculate everything and return the final value
 *
 * @param int|null $cleaning_amount
 * @param int|null $bond_amount
 *
 * @return String
 */
function totalCalc($total, $cleaning_amount = null, $bond_amount = null, $gst = false)
{
    if(empty($total)) return 0;

    if(!empty($cleaning_amount))  $total =  $total + $cleaning_amount;
    if(!empty($bond_amount))      $total =  $total + $bond_amount;
    if($gst)                      $total =  $total + ((15/100) * $total);

    return empty($total)? 0:  $total;
}

/**
 * Calculated GST based on provided total
 *
 * @param int $total
 * @return float|int
 */
function calculateGST($total = 0)
{
    if(empty($total)) return 0;
    return ((15/100) * $total);
}
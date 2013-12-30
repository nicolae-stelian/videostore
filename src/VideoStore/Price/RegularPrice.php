<?php


namespace VideoStore\Price;


class RegularPrice extends Price
{
    /**
     * @param $daysRented
     *
     * @return int
     */
    public function calculateCharge($daysRented)
    {
        $amount = 2;
        if ($daysRented > 2) {
            $amount += ($daysRented - 2) * 1.5;
        }
        return $amount;
    }
}
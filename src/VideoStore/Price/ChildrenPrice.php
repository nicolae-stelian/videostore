<?php


namespace VideoStore\Price;


class ChildrenPrice extends Price
{

    /**
     * @param $daysRented
     *
     * @return float|int
     */
    public function calculateCharge($daysRented)
    {
        $amount = 1.5;
        if ($daysRented > 3) {
            $amount += ($daysRented - 3) * 1.5;
        }
        return $amount;
    }
}
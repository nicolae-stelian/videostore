<?php


namespace VideoStore\Price;


class NewReleasePrice extends Price
{

    /**
     * @param $daysRented
     *
     * @return int
     */
    public function calculateCharge($daysRented)
    {
        return $daysRented * 3;
    }

    /**
     * @param $daysRented
     *
     * @return int
     */
    public function calculateFrequentRenterPoints($daysRented)
    {
        if ($daysRented > 1) {
            return 2;
        }
        return 1;
    }
}
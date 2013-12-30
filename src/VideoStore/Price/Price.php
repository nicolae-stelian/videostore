<?php


namespace VideoStore\Price;


abstract class Price
{
    /**
     * @param $daysRented
     *
     * @return int
     */
    abstract public function calculateCharge($daysRented);

    /**
     * @param $daysRented
     *
     * @return int
     */
    public function calculateFrequentRenterPoints($daysRented) {
        return 1;
    }
}
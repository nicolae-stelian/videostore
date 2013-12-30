<?php


namespace VideoStore;


use VideoStore\Statement\TextStatement;

class Customer
{
    private $name = '';
    private $rentals = array();

    /**
     * @param $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param Rental $rental
     */
    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    public function getRentals()
    {
        return $this->rentals;
    }

    /**
     * @return string
     */
    public function txtStatement()
    {
        $txt = new TextStatement($this);
        return $txt->statement();
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function calculateTotalFrequentRenterPoints()
    {
        $totalPoints = 0;
        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $totalPoints += $rental->calculateFrequentRenterPoints();
        }

        return $totalPoints;
    }

    /**
     * @return int
     */
    public function calculateTotalCharge()
    {
        $totalAmount = 0;
        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->calculateCharge();
            $totalAmount += $thisAmount;
        }
        return $totalAmount;
    }
}
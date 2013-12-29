<?php


namespace VideoStore;


class Customer
{
    private $name = '';
    private $rentals = array();

    public function __construct($name)
    {
        $this->name = $name;
    }

    public function addRental(Rental $rental)
    {
        $this->rentals[] = $rental;
    }

    public function txtStatement()
    {
        $result = "Rental Record for " . $this->getName() . "\n";

        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->calculateCharge();
            //show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "\n";
        }

        $frequentRenterPoints = $this->calculateTotalFrequentRenterPoints();
        $totalAmount = $this->calculateTotalCharge();

        //add footer lines
        $result .= "You owed " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";
        return $result;
    }

    public function getName()
    {
        return $this->name;
    }

    protected function calculateTotalFrequentRenterPoints()
    {
        $totalPoints = 0;
        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $totalPoints += $rental->calculateFrequentRenterPoints();
        }

        return $totalPoints;
    }

    protected function calculateTotalCharge()
    {
        $totalAmount = 0;
        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->calculateCharge();
            $totalAmount += $thisAmount;
        }
        return $totalAmount;
    }
} 
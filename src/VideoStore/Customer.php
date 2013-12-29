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

    public function getName()
    {
        return $this->name;
    }

    public function txtStatement()
    {
        $result = "Rental Record for " . $this->getName() . "\n";

        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $thisAmount = $this->calculateCharge($rental);
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

    /**
     * @param $rental
     *
     * @return float|int
     */
    protected function calculateCharge(Rental $rental)
    {
        $amount = 0;
        switch ($rental->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $amount += 2;
                if ($rental->getDaysRented() > 2) {
                    $amount += ($rental->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $amount += $rental->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $amount += 1.5;
                if ($rental->getDaysRented() > 3) {
                    $amount += ($rental->getDaysRented() - 3) * 1.5;
                }
                break;
        }
        return $amount;
    }

    /**
     * @param $rental
     *
     * @return mixed
     */
    protected function calculateFrequentRenterPoints(Rental $rental)
    {
        $frequentRenterPoints = 1;

        if ($rental->getMovie()->getPriceCode() == Movie::NEW_RELEASE
            && $rental->getDaysRented() > 1
        ) {
            $frequentRenterPoints += 1;
            return $frequentRenterPoints;
        }

        return $frequentRenterPoints;
    }

    protected function calculateTotalCharge()
    {
        $totalAmount = 0;
        foreach ($this->rentals as $rental) {
            $thisAmount = $this->calculateCharge($rental);
            $totalAmount += $thisAmount;
        }
        return $totalAmount;
    }

    protected function calculateTotalFrequentRenterPoints()
    {
        $totalPoints = 0;
        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $totalPoints += $this->calculateFrequentRenterPoints($rental);
        }

        return $totalPoints;
    }
} 
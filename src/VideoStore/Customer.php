<?php


namespace VideoStore;


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

    /**
     * @return string
     */
    public function txtStatement()
    {
        $result = $this->txtHeader();
        $result .= $this->txtBody();
        $result .= $this->txtFooter();
        return $result;
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
    protected function calculateTotalFrequentRenterPoints()
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
    protected function calculateTotalCharge()
    {
        $totalAmount = 0;
        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->calculateCharge();
            $totalAmount += $thisAmount;
        }
        return $totalAmount;
    }

    /**
     * @return string
     */
    protected function txtHeader()
    {
        $result = "Rental Record for " . $this->getName() . "\n";
        return $result;
    }

    /**
     *
     * @return string
     */
    protected function txtBody()
    {
        $result = '';
        /** @var Rental $rental */
        foreach ($this->rentals as $rental) {
            $thisAmount = $rental->calculateCharge();
            //show figures for this rental
            $result .= "\t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "\n";
        }
        return $result;
    }

    /**
     *
     * @return string
     */
    protected function txtFooter()
    {
        $frequentRenterPoints = $this->calculateTotalFrequentRenterPoints();
        $totalAmount = $this->calculateTotalCharge();

        //add footer lines
        $result = "You owed " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";
        return $result;
    }
} 
<?php


namespace VideoStore;


class Rental
{
    /**
     * @var Movie
     */
    private $movie;
    private $daysRented;

    public function __construct(Movie $movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    public function calculateCharge()
    {
        $amount = 0;
        switch ($this->getMovie()->getPriceCode()) {
            case Movie::REGULAR:
                $amount += 2;
                if ($this->getDaysRented() > 2) {
                    $amount += ($this->getDaysRented() - 2) * 1.5;
                }
                break;
            case Movie::NEW_RELEASE:
                $amount += $this->getDaysRented() * 3;
                break;
            case Movie::CHILDRENS:
                $amount += 1.5;
                if ($this->getDaysRented() > 3) {
                    $amount += ($this->getDaysRented() - 3) * 1.5;
                }
                break;
        }
        return $amount;
    }

    public function getMovie()
    {
        return $this->movie;
    }

    public function getDaysRented()
    {
        return $this->daysRented;
    }

    public function calculateFrequentRenterPoints()
    {
        $frequentRenterPoints = 1;

        if ($this->getMovie()->getPriceCode() == Movie::NEW_RELEASE
            && $this->getDaysRented() > 1
        ) {
            $frequentRenterPoints += 1;
            return $frequentRenterPoints;
        }

        return $frequentRenterPoints;
    }
} 
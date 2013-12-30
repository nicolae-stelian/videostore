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
        return $this->getMovie()->calculateCharge($this->getDaysRented());
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
        /** @var Price $movieType */
        $movieType = $this->getMovie()->getPriceType();
        return $movieType->calculateFrequentRenterPoints($this->getDaysRented());
    }
} 
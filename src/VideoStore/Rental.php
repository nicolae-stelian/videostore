<?php


namespace VideoStore;


class Rental
{
    /**
     * @var Movie
     */
    private $movie;
    private $daysRented;

    /**
     * @param Movie $movie
     * @param int   $daysRented
     */
    public function __construct(Movie $movie, $daysRented)
    {
        $this->movie = $movie;
        $this->daysRented = $daysRented;
    }

    /**
     * @return int
     */
    public function calculateCharge()
    {
        return $this->getMovie()->calculateCharge($this->getDaysRented());
    }

    /**
     * @return int
     */
    public function calculateFrequentRenterPoints()
    {
        return $this->getMovie()->calculateFrequentRenterPoints($this->getDaysRented());
    }

    /**
     * @return Movie
     */
    public function getMovie()
    {
        return $this->movie;
    }

    /**
     * @return int
     */
    public function getDaysRented()
    {
        return $this->daysRented;
    }

} 
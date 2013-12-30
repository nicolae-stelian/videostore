<?php


namespace VideoStore;


use VideoStore\Price\ChildrenPrice;
use VideoStore\Price\NewReleasePrice;
use VideoStore\Price\Price;
use VideoStore\Price\RegularPrice;

class Movie
{
    const REGULAR = 0;
    const NEW_RELEASE = 1;
    const CHILDREN = 2;

    private $title;

    /** @var  Price $movieType */
    private $priceType;

    /**
     * @param $title
     * @param $priceCode
     */
    public function __construct($title, $priceCode)
    {
        $this->title = $title;
        $this->setPriceType($priceCode);
    }

    /**
     * @param $priceCode
     */
    public function setPriceCode($priceCode)
    {
        $this->setPriceType($priceCode);
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param $daysRented
     *
     * @return int
     */
    public function calculateCharge($daysRented)
    {
        return $this->priceType->calculateCharge($daysRented);
    }

    /**
     * @return Price
     */
    public function getPriceType()
    {
        return $this->priceType;
    }

    /**
     * @param $priceCode
     */
    protected function setPriceType($priceCode)
    {
        switch ($priceCode) {
            case self::REGULAR:
                $this->priceType = new RegularPrice();
                break;
            case self::NEW_RELEASE:
                $this->priceType = new NewReleasePrice();
                break;
            case self::CHILDREN:
                $this->priceType = new ChildrenPrice();
                break;
        }
    }

} 
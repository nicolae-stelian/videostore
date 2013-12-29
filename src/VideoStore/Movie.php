<?php


namespace VideoStore;


class Movie
{
    const CHILDRENS = 2;
    const REGULAR = 0;
    const NEW_RELEASE = 1;

    public $title;
    public $priceCode;

    public function __construct($title, $priceCode)
    {
        $this->title = $title;
        $this->priceCode = $priceCode;
    }

    public function getPriceCode()
    {
        return $this->priceCode;
    }

    public function setPriceCode($priceCode)
    {
        $this->priceCode = $priceCode;
    }

    public function getTitle()
    {
        return $this->title;
    }

} 
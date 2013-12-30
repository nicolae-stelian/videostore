<?php


namespace VideoStore\Statement;


use VideoStore\Customer;
use VideoStore\Rental;

class TextStatement
{
    /**
     * @var Customer
     */
    protected $customer;

    public function __construct(Customer $customer)
    {
        $this->customer = $customer;
    }

    public function statement()
    {
        return $this->textHeader() . $this->textBody() . $this->textFooter();
    }

    /**
     * @return string
     */
    protected function textHeader()
    {
        $result = "Rental Record for " . $this->customer->getName() . "\n";
        return $result;
    }

    /**
     *
     * @return string
     */
    protected function textBody()
    {
        $result = '';
        /** @var Rental $rental */
        foreach ($this->customer->getRentals() as $rental) {
            $result .= $this->textRentalLine($rental);
        }
        return $result;
    }

    /**
     *
     * @return string
     */
    protected function textFooter()
    {
        $frequentRenterPoints = $this->customer->calculateTotalFrequentRenterPoints();
        $totalAmount = $this->customer->calculateTotalCharge();

        $result = "You owed " . $totalAmount . "\n";
        $result .= "You earned " . $frequentRenterPoints . " frequent renter points\n";
        return $result;
    }

    /**
     * @param $rental
     *
     * @return string
     */
    protected function textRentalLine(Rental $rental)
    {
        $thisAmount = $rental->calculateCharge();
        $result = "\t" . $rental->getMovie()->getTitle() . "\t" . $thisAmount . "\n";
        return $result;
    }
} 
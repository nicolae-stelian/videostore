<?php


namespace VideoStore;

require_once __DIR__ . '/../../src/VideoStore/bootstrap.php';

class CustomerTest extends \PHPUnit_Framework_TestCase
{

    public static function provideTestProgram()
    {
        return array(
            array(
                Movie::REGULAR,
                'days'         => 1,
                'amount'       => 2,
                'renterPoints' => 1
            ),
            array(
                Movie::REGULAR,
                'days'         => 3,
                'amount'       => 3.5,
                'renterPoints' => 1
            ),

            array(
                Movie::CHILDRENS,
                'days'         => 1,
                'amount'       => 1.5,
                'renterPoints' => 1
            ),
            array(
                Movie::CHILDRENS,
                'days'         => 4,
                'amount'       => 3,
                'renterPoints' => 1
            ),

            array(
                Movie::NEW_RELEASE,
                'days'         => 1,
                'amount'       => 3,
                'renterPoints' => 1
            ),
            array(
                Movie::NEW_RELEASE,
                'days'         => 3,
                'amount'       => 9,
                'renterPoints' => 2
            ),
        );
    }

    public function testStatement_WithNoRentals()
    {
        $customer = new Customer('Customer Name');
        $result = $customer->txtStatement();
        $expected = "Rental Record for Customer Name\n";
        $expected .= "You owed 0\n";
        $expected .= "You earned 0 frequent renter points\n";
        $this->assertEquals($expected, $result);
    }

    /**
     *  * @dataProvider provideTestProgram
     */
    public function testStatementWithRentals($movieType, $rentalDays, $expectedAmount, $expectedRenterPoints)
    {
        $customer = new Customer('Customer Name');
        $movie = new Movie('Movie', $movieType);
        $rental = new Rental($movie, $rentalDays);
        $customer->addRental($rental);
        $result = $customer->txtStatement();

        $expected = "Rental Record for Customer Name\n";
        $expected .= "\t%s\t%s\n";
        $expected .= "You owed %s\n";
        $expected .= "You earned %s frequent renter points\n";
        $expected = sprintf(
            $expected,
            $movie->getTitle(),
            $expectedAmount,
            $expectedAmount,
            $expectedRenterPoints
        );

        $this->assertEquals($expected, $result);
    }

    public function testStatementWithTwoRentals()
    {
        $customer = new Customer('Customer Name');

        $movie = new Movie('Regular 1', Movie::REGULAR);
        $rental = new Rental($movie, 1);
        $customer->addRental($rental);

        $movie = new Movie('Regular 2', Movie::REGULAR);
        $rental = new Rental($movie, 3);
        $customer->addRental($rental);

        $result = $customer->txtStatement();

        $expected = "Rental Record for Customer Name\n";
        $expected .= "\tRegular 1\t2\n";
        $expected .= "\tRegular 2\t3.5\n";
        $expected .= "You owed 5.5\n";
        $expected .= "You earned 2 frequent renter points\n";

        $this->assertEquals($expected, $result);
    }
}
 
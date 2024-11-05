<?php

use App\MultipleChecker;
use PHPUnit\Framework\Attributes\Test;
use PHPUnit\Framework\TestCase;

class MultipleCheckerTest extends TestCase
{
    private MultipleChecker $sut;

    #[Test]
    public function given_a_multiple_of_three__should_return_Fizz()
    {
        $multiple = 3;
        $expcetedResult = 'Fizz';
        $this->sut = new MultipleChecker();

        $result = $this->sut->check($multiple);

        $this->assertSame($expcetedResult, $result);
    }

    #[Test]
    public function given_a_multiple_of_five__should_return_Buzz()
    {
        $multiple = 5;
        $expcetedResult = 'Buzz';
        $this->sut = new MultipleChecker();

        $result = $this->sut->check($multiple);

        $this->assertSame($expcetedResult, $result);
    }

    #[Test]
    public function given_a_multiple_of_three_and_five__should_return_FizzBuzz()
    {
        $multiple = 15;
        $expcetedResult = 'FizzBuzz';
        $this->sut = new MultipleChecker();

        $result = $this->sut->check($multiple);

        $this->assertSame($expcetedResult, $result);
    }

    #[Test]
    public function given_a_non_multiple_of_three_or_five__should_return_same_number()
    {
        $multiple = 1;
        $expcetedResult = '1';
        $this->sut = new MultipleChecker();

        $result = $this->sut->check($multiple);

        $this->assertSame($expcetedResult, $result);
    }
}

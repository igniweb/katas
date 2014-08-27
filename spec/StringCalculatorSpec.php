<?php namespace spec;

use InvalidArgumentException;
use PhpSpec\ObjectBehavior;

class StringCalculatorSpec extends ObjectBehavior {

    public function it_is_initializable()
    {
        $this->shouldHaveType('StringCalculator');
    }

    public function it_translates_an_empty_string_into_zero()
    {
        $this->add('')->shouldReturn(0);
    }

    public function it_finds_the_sum_of_one_number()
    {
        $this->add('5')->shouldReturn(5);
    }

    public function it_finds_the_sum_of_any_amount_of_numbers()
    {
        $this->add('1,2,3,4,5')->shouldReturn(15);   
    }

    public function it_disallows_negative_numbers()
    {
        $this->shouldThrow(new InvalidArgumentException('Invalid number provided: -2'))->duringAdd('3,-2');
    }

    public function it_ignores_any_number_that_is_one_thousand_or_greater()
    {
        $this->add('2, 2, 1000')->shouldReturn(4);
    }

    public function it_allows_for_new_line_delimiters()
    {
        $this->add('2,2\n2')->shouldReturn(6);
    }

    public function it_does_not_fail_with_unumeric_string()
    {
        $this->add('2,2\n2feef')->shouldReturn(6);
    }
    
}

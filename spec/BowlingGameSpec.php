<?php namespace spec;

use PhpSpec\ObjectBehavior;

class BowlingGameSpec extends ObjectBehavior {

    public function it_is_initializable()
    {
        $this->shouldHaveType('BowlingGame');
    }

    public function it_scores_a_gutter_game_as_zero()
    {
        $this->rollTimes(20, 0);

        $this->score()->shouldReturn(0);
    }

    public function it_scores_the_sum_of_all_knocked_down_pins_for_a_game()
    {
        $this->rollTimes(20, 1);

        $this->score()->shouldBe(20);
    }

    public function it_awards_a_one_roll_bonus_for_every_spare()
    {
        $this->rollSpare();
        $this->roll(5);
        $this->rollTimes(17, 0);

        $this->score()->shouldBe(20);
    }

    public function it_awards_a_two_roll_bonus_for_a_strike_in_the_previous_frame()
    {
        $this->rollStrike();
        $this->roll(7);
        $this->roll(2);
        $this->rollTimes(17, 0);

        $this->score()->shouldBe(28);
    }

    public function it_scores_a_perfect_game()
    {
        $this->rollTimes(12, 10);

        $this->score()->shouldBe(300);
    }

    public function it_takes_exception_with_invalid_rolls()
    {
        $this->shouldThrow('InvalidArgumentException')->duringRoll(-10);
    }

    private function rollTimes($times, $roll)
    {
        for ($i = 0 ; $i < $times ; $i++)
        {
            $this->roll($roll);
        }
    }

    private function rollSpare()
    {
        $this->roll(2);
        $this->roll(8);
    }

    private function rollStrike()
    {
        $this->roll(10);
    }
    
}

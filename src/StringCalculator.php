<?php

class StringCalculator {

    const MAX_NUMBER_ALLOWED = 1000;

    public function add($string)
    {
        if (empty($string))
        {
            return 0;
        }

        $numbers = explode(',', str_replace('\n', ',', $string));
        $numbers = array_map([$this, 'clean'], $numbers);

        return array_sum($numbers);
    }

    private function clean($number)
    {
        $number = intval($number);

        if ($number < 0)
        {
            throw new InvalidArgumentException('Invalid number provided: ' . $number);
        }
        if ($number >= static::MAX_NUMBER_ALLOWED)
        {
            $number = 0;
        }

        return $number;
    }

}

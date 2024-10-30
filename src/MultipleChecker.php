<?php

namespace App;

class MultipleChecker
{

    public function check(int $multiple): string
    {
        $response = "";
        if($multiple % 3 === 0){
            $response .= "Fizz";
        }
        if($multiple % 5 === 0){
            $response .= "Buzz";
        }
        if($response === "") {
            $response = $multiple;
        }

        return $response;
    }
}
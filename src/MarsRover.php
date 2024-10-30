<?php

namespace App;

class MarsRover
{

    private int $xPos;
    private int $yPos;
    private string $dir;

    public function __construct(int $xPos, int $yPos, string $dir)
    {
        $this->xPos = $xPos;
        $this->yPos = $yPos;
        $this->dir = $dir;
    }

    public function getPos(): string
    {
        return "$this->xPos:$this->yPos:$this->dir";
    }

    public function execute(string $string)
    {
        if($string == "L")
        {
            $this->dir = "W";
        }

        if($string == "R")
        {
            $this->dir = "E";
        }
    }
}
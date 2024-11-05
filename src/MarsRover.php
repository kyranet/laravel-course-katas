<?php

namespace App;

use UnexpectedValueException;

class MarsRover
{
    private const MAP_GRID_WIDTH = 10;
    private const MAP_GRID_HEIGHT = 10;

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

    public function execute(string $commands): void
    {
        for ($i = 0; $i < strlen($commands); $i++) {
            $command = $commands[$i];

            match ($command) {
                "M" => $this->move(),
                "L" => $this->rotateLeft(),
                "R" => $this->rotateRight(),
                default => throw new UnexpectedValueException("Expected $command to be one of 'M', 'L', or 'R'")
            };
        }
    }

    private function move(): void
    {
        [$offsetX, $offsetY] = match ($this->dir) {
            "N" => [0, -1],
            "W" => [-1, 0],
            "S" => [0, 1],
            "E" => [1, 0]
        };

        $x = $this->xPos + $offsetX;
        $x = $this->transformMoveCoordinatesBetween($x, 0, MarsRover::MAP_GRID_WIDTH - 1);

        $y = $this->yPos + $offsetY;
        $y = $this->transformMoveCoordinatesBetween($y, 0, MarsRover::MAP_GRID_HEIGHT - 1);

        // Collision detection not implemented

        $this->xPos = $x;
        $this->yPos = $y;
    }

    private function transformMoveCoordinatesBetween($current, $first, $last): int
    {
        return match (true) {
            // If the calculated coordinate ends up outside the map, on the lower end,
            // then update the position to the upper end:
            $current < $first => $last,
            // If the calculated coordinate ends up outside the map, on the upper end,
            // then update the position to the lower end:
            $current > $last => $first,
            // Otherwise it's within the map and no transformation is required:
            default => $current
        };
    }

    private function rotateLeft(): void
    {
        $this->dir = match ($this->dir) {
            "N" => "W",
            "W" => "S",
            "S" => "E",
            "E" => "N",
        };
    }

    private function rotateRight(): void
    {
        $this->dir = match ($this->dir) {
            "N" => "E",
            "E" => "S",
            "S" => "W",
            "W" => "N",
        };
    }
}

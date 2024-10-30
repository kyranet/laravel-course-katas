<?php

use App\MarsRover;

class MarsRoverTest extends \PHPUnit\Framework\TestCase
{
    private MarsRover $sut;

    /** @test */
    public function given_an_initial_position__should_return_the_position()
    {
        $xPos = 3;
        $yPos = 3;
        $dir = "N";
        $expectedResult = "3:3:N";
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $response = $this->sut->getPos();

        $this->assertSame($expectedResult, $response);
    }

    /** @test */
    public function given_a_right_turn__should_face_to_its_right_side()
    {
        $xPos = 3;
        $yPos = 3;
        $dir = "N";
        $expectedResult = "3:3:E";
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("R");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }

    /** @test */
    public function given_a_left_turn__should_face_to_its_left_side()
    {
        $xPos = 3;
        $yPos = 3;
        $dir = "N";
        $expectedResult = "2:3:N";
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("MMRMMLM");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }
}
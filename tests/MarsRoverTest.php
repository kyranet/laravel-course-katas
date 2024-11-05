<?php

use App\MarsRover;
use PHPUnit\Framework\TestCase;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\Attributes\Test;

class MarsRoverTest extends TestCase
{
    #region providers
    public static function rotateLeftProvider(): array
    {
        return [
            ['N', 'W'],
            ['W', 'S'],
            ['S', 'E'],
            ['E', 'N']
        ];
    }

    public static function rotateRightProvider(): array
    {
        return [
            ['N', 'E'],
            ['E', 'S'],
            ['S', 'W'],
            ['W', 'N']
        ];
    }

    public static function directionProvider(): array
    {
        return [['N'], ['E'], ['S'], ['W']];
    }
    #endregion

    private MarsRover $sut;

    #[Test]
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

    #[Test]
    #[DataProvider('rotateLeftProvider')]
    public function given_a_left_turn__should_face_to_its_left_side(string $dir, string $expectedDir)
    {
        $xPos = 0;
        $yPos = 0;
        $expectedResult = "0:0:" . $expectedDir;
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("L");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }

    #[Test]
    #[DataProvider('rotateRightProvider')]
    public function given_a_right_turn__should_face_to_its_right_side(string $dir, string $expectedDir)
    {
        $xPos = 3;
        $yPos = 3;
        $expectedResult = "3:3:" . $expectedDir;
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("R");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }

    #[Test]
    public function given_a_set_of_movements__should_end_up_at_correct_position_and_facing_side()
    {
        $xPos = 0;
        $yPos = 0;
        $dir = "S";
        $expectedResult = "2:3:S";
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("MMLMMRM");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }

    #[Test]
    #[DataProvider('directionProvider')]
    public function given_ten_consecutive_moves__should_move_to_its_original_position(string $dir)
    {
        $xPos = 0;
        $yPos = 0;
        $expectedResult = "0:0:" . $dir;
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("MMMMMMMMMM");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }

    #[Test]
    public function given_an_invalid_command__should_throw_an_exception()
    {
        $this->expectException(UnexpectedValueException::class);
        $this->expectExceptionMessage("Expected S to be one of 'M', 'L', or 'R'");

        $xPos = 0;
        $yPos = 0;
        $dir = "S";
        $expectedResult = "0:0:S";
        $this->sut = new MarsRover($xPos, $yPos, $dir);

        $this->sut->execute("S");

        $this->assertSame($expectedResult, $this->sut->getPos());
    }
}

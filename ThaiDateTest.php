<?php

require_once 'ThaiDate.php';

use PHPUnit\Framework\TestCase;

class ThaiDateTest extends TestCase
{
    private $thaiDate;

    protected function setUp(): void
    {
        $this->thaiDate = new ThaiDate(19, 3, 2023);
    }

    public function testGetWeekday()
    {
        $this->assertEquals('วันอาทิตย์', $this->thaiDate->getWeekday());
    }

    public function testGetThaiMonth()
    {
        $this->assertEquals('มีนาคม', $this->thaiDate->getThaiMonth());
    }

    public function testToString()
    {
        $this->assertEquals('วันอาทิตย์ ที่ 19 มีนาคม ค.ศ. 2023', (string) $this->thaiDate);
    }

    public function testInvalidDate()
    {
        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid date');
        $this->thaiDate = new ThaiDate(32, 2, 2022);
    }
}

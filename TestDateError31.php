<?php

require_once 'ThaiDate.php';

use Facebook\WebDriver\Remote\DesiredCapabilities;
use Facebook\WebDriver\Remote\RemoteWebDriver;
use Facebook\WebDriver\WebDriverBy;
use PHPUnit\Framework\TestCase;

class TestDateError31 extends TestCase
{
    private $driver;

    protected function setUp(): void
    {
        $this->driver = RemoteWebDriver::create('http://localhost:4444/wd/hub', DesiredCapabilities::chrome());
        $this->driver->manage()->window()->maximize();
    }

    protected function tearDown(): void
    {
        $this->driver->quit();
    }

    public function testDateError31()
    {
        $this->driver->get("http://localhost/...");

        $dayDropdown = $this->driver->findElement(WebDriverBy::id("day"));
        $monthDropdown = $this->driver->findElement(WebDriverBy::id("month"));
        $yearInput = $this->driver->findElement(WebDriverBy::id("year"));

        $dayDropdown->sendKeys("10");
        $monthDropdown->sendKeys("เมษายน");
        $yearInput->sendKeys("2023");

        $this->driver->findElement(WebDriverBy::cssSelector("input[type='submit']"))->click();

        $result = $this->driver->findElement(WebDriverBy::tagName("body"));
        $dateString = trim($result->getText());

        $formatter = "วันl ที่j F ค.ศ. Y";
        $date = DateTime::createFromFormat($formatter, $dateString);

        if ($date !== false) {
            echo "Weekday: " . $date->format('l') . PHP_EOL;
            echo "Day: " . $date->format('j') . PHP_EOL;
            echo "Month: " . $date->format('F') . PHP_EOL;
            echo "Year: " . $date->format('Y') . PHP_EOL;
        } else {
            echo "Error parsing date: " . $dateString . PHP_EOL;
        }

        $title = $this->driver->getTitle();
        echo $title . PHP_EOL;

        sleep(5);
    }
}

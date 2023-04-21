<?php

class ThaiDate {
    private $day;
    private $month;
    private $year;

    public function __construct($day, $month, $year) {
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
    }

    public function getWeekday() {
        $weekdays = ["วันจันทร์", "วันอังคาร", "วันพุธ", "วันพฤหัสบดี", "วันศุกร์", "วันเสาร์", "วันอาทิตย์"];
        $date = DateTime::createFromFormat('Y-m-d', "$this->year-$this->month-$this->day");
        $weekday = $date->format("N") - 1;
        return $weekdays[$weekday];
    }

    public function getThaiMonth() {
        $thaiMonths = ["มกราคม", "กุมภาพันธ์", "มีนาคม", "เมษายน", "พฤษภาคม", "มิถุนายน", "กรกฎาคม", "สิงหาคม", "กันยายน", "ตุลาคม", "พฤศจิกายน", "ธันวาคม"];
        return $thaiMonths[$this->month - 1];
    }

    public function __toString() {
        return $this->getWeekday() . " ที่ " . $this->day . " " . $this->getThaiMonth() . " ค.ศ. " . $this->year;
    }
}

?>

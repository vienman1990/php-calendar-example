<?php
class Day{
    public $day;
    public $month;
    public $year;
    public $class;

    function __construct($day, $month, $year, $class = ''){
        $this->day = $day;
        $this->month = $month;
        $this->year = $year;
        $this->class = $class;
        if(
            date('j') == $day && 
            date('n') == $month &&
            date('Y') == $year
        ){
            $this->class .= ' current';
        }
    }
}
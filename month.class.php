<?php
class Month {
    public $month;
    public $year;
    public $daysOnMonth;
    public $daysOnMonthArr;
    public $dayFirst;
    public $timeOfDay = 86400;
    public $week_arr = array('Sun', 'Mon', 'Tue', 'Web', 'Thu', 'Fri', 'Sat');

    function __construct($month, $year) {
        $this->year = $year;
        $this->month = $month;
        $this->daysOnMonth = cal_days_in_month( 0, $month, $year);
        $this->dayFirst = mktime(0, 0, 0, $month  , 1, $year);
        $this->dayLast = mktime(0, 0, 0, $month  , $this->daysOnMonth, $year);
        $this->daysOnMonthArr = $this->get_days();
    }

    public function get_days_before(){
        $result = array();
        $firstDayOfWeek = (int)date('w', $this->dayFirst);
        for ($i=1; $i < $firstDayOfWeek + 1 ; $i++) {
            $result[] = new Day(
                date('j', $this->dayFirst - $i*$this->timeOfDay ),
                date('n', $this->dayFirst - $i*$this->timeOfDay ),
                date('Y', $this->dayFirst - $i*$this->timeOfDay ),
                'month-before'
            );
        }
        return array_reverse($result);
    }

    public function get_days_after(){
        $result = array();
        $lastDayOfWeek = (int)date('w', $this->dayLast);
        $j = 1;
        for ($i=$lastDayOfWeek; $i < 6 ; $i++) {
            $result[] = new Day(
                date('j', $this->dayLast + $j*$this->timeOfDay ),
                date('n', $this->dayLast + $j*$this->timeOfDay ),
                date('Y', $this->dayLast + $j*$this->timeOfDay ),
                'month-after'
            );
            $j++;
        }
        return $result;
    }

    public function get_days(){
        $days = array();

        $days = array_merge($days, $this->get_days_before());

        for ($day = 1; $day <= $this->daysOnMonth; $day++) { 
            $days[] = new Day($day, $this->month, $this->year);
        }

        $days = array_merge($days, $this->get_days_after());

        return $days;
    }

    public function get_calendar_wapper(){
        return '<table>';
    }

    public function get_calendar_wapper_close(){
        return '</table>';
    }

    public function get_calendar_header(){
        $result = '';
        $result .= '<tr>';
        foreach ($this->week_arr as $key => $value) {
            $result .= '<th>'.$value.'</th>';
        }
        $result .= '</tr>';
        return $result;
    }

    public function get_calendar_week($num){
        return array_slice($this->daysOnMonthArr, $num*7, 7);
    }

    public function get_calendar_week_show($num){
        $result = '';
        $result .= '<tr>';
            foreach ($this->get_calendar_week($num) as $key => $value) {
                $result .= $this->get_day_show($value);
            }
        $result .= '</tr>';
        return $result;
    }

    public function get_day_show($day){
        return '<td class="'.$day->class.'"><span>'.$day->day.'</span></td>';
    }

    public function get_calendar_body(){
        $result = '';
        $num_week = ceil(count($this->daysOnMonthArr)/7);

        for ($num=0; $num < $num_week ; $num++) { 
            $result .= $this->get_calendar_week_show($num);
        }
        return $result;
    }

    public function get_calendar(){
        $result = '';
        $result .= $this->get_calendar_wapper();
        $result .= $this->get_calendar_header();
        $result .= $this->get_calendar_body();
        $result .= $this->get_calendar_wapper_close();
        return $result;
    }

}
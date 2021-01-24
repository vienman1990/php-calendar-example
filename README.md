# php-calendar-example
Build calendar with php example

Include Class 

    include 'day.class.php';
    include 'month.class.php';

Show Calendar

    $calendar = new Month($i, 2021);
    echo $calendar->get_calendar();

Done.
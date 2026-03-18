<?php

require_once 'myFunctions.php';

function correctDate(string $date): bool {

    $len = myLen($date);
    if ($len === 0) {
        return false;
    }
    return true;
}

function searchForDelimiter(string $str): string {
    if (mySearchChar($str, ' ')) {
        return ' ';
    }
    if (mySearchChar($str, '.')) {
        return '.';
    }
    if (mySearchChar($str, '-')) {
        return '-';
    }
    if (mySearchChar($str, '/')) {
        return '/';
    }
    return 'no';
}

function WordToNumber(string $str): int {
    $digits = match ($str) {
       'January' => 1,
       'February' => 2,
       'March' => 3,
       'April' => 4,
       'May' => 5,
       'June' => 6,
       'July' => 7,
       'August' => 8,
       'September' => 9,
       'October' => 10,
       'November' => 11,
       'December' => 12,
        default => (int)$str
    };
    return $digits;
}

function stringToNumberInArray(array $arr): array {
    for ($i = 0; $i < 3; $i++) {
        $arr[$i] = WordToNumber($arr[$i]);
    }
    return $arr;
}

function searchOfTheDay(int $first, int $second) {
    if (myLen($first) === 4) {
        return $second;
    }
    return $first;
}

function horoscope(int $day, int $month): string {
    if ((($day >= 21) && ($month === 3)) || (($day <= 20) && ($month === 4))) {
        return 'Овен';
    }
    if ((($day >= 21) && ($month === 4)) || (($day <= 20) && ($month === 5))) {
        return 'Телец';
    }
    if ((($day >= 21) && ($month === 5)) || (($day <= 21) && ($month === 6))) {
        return 'Близнецы';
    }
    if ((($day >= 22) && ($month === 6)) || (($day <= 22) && ($month === 7))) {
        return 'Рак';
    }
    if ((($day >= 23) && ($month === 7)) || (($day <= 23) && ($month === 8))) {
        return 'Лев';
    }
    if ((($day >= 24) && ($month === 8)) || (($day <= 23) && ($month === 9))) {
        return 'Дева';
    }
    if ((($day >= 24) && ($month === 9)) || (($day <= 23) && ($month === 10))) {
        return 'Весы';
    }
    if ((($day >= 24) && ($month === 10)) || (($day <= 22) && ($month === 11))) {
        return 'Скорпион';
    }
    if ((($day >= 23) && ($month === 11)) || (($day <= 21) && ($month === 12))) {
        return 'Стрелец';
    }
    if ((($day >= 22) && ($month === 12)) || (($day <= 20) && ($month === 1))) {
        return 'Козерог';
    }
    if ((($day >= 21) && ($month === 1)) || (($day <= 20) && ($month === 2))) {
        return 'Водолей';
    }
    if ((($day >= 21) && ($month === 2)) || (($day <= 20) && ($month === 3))) {
        return 'Рыбы';
    }
}

if (isset($_POST['date']) && correctDate($_POST['date'])) {
    $date = myDeletChar($_POST['date'], ',');
    $delimiter = searchForDelimiter($date);
    $dateArray = [];
    if ($delimiter !== 'no') {
        $dateArray = mySplit($date, $delimiter);
    }
    else {
        $dateArray = [mySubStr($date, 0, 4), mySubStr($date, 4, 6), mySubStr($date, 6, 8)];
    }
    $dateArray = stringToNumberInArray($dateArray);
    if ($dateArray[1] <= 12) {
        $month = $dateArray[1];
        $day = searchOfTheDay($dateArray[0], $dateArray[2]);
    }
    else {
        $month = searchOfTheDay($dateArray[0], $dateArray[2]);
        $day = $dateArray[1];
    }
    echo horoscope($day, $month);
}
else {
    echo 'Введённые данные некорректны';
}

?>
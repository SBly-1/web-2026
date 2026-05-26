<?php
    
require_once 'myFunctions.php';

function correctYear(string $year): bool {

    $len = myLen($year);
    if ($len === 0) {
        return false;
    }

    for ($i = 0; $i < $len; $i++) {
        if ($year[$i] < '0' || $year[$i] > '9') {
            return false;
        }
    }

    $year = (int)$year;
    if (($year <= 30000) && ($year >= 0)) {
        return true;
    } 
    return false;
}

function leapYear(int $year): bool {
    #Год является високосным, если он делится на 4 без остатка (например, 2024, 2028). 
    #Если год делится на 100, он не високосный, но если при этом делится на 400 — то високосный.
    if ($year % 4 == 0) {
        if (($year % 100 == 0) && ($year % 400 != 0)) {
            return false;
        }
        return true;
    }
    return false;
}

if (isset($_POST['year']) && correctYear($_POST['year'])) {
    $year = (int)$_POST['year'];
    if (leapYear($year)) {
        echo 'YES';
    }
    else {
        echo 'NO';
    }
}
else {
    echo 'Введённые данные некорректны';
}
?>
<?php

require_once 'myFunctions.php';

function correctYear(string $number): bool {
    $len = myLen($number);
    if ($len === 0) {
        return false;
    }

    for ($i = 0; $i < $len; $i++) {
        if ($number[$i] < '0' || $number[$i] > '9') {
            return false;
        }
    }

    $number = (int)$number;
    if (($number <= 170) && ($number >= 0)) {
        return true;
    } 
    return false;
}

function factorial(float $number): float {
    if ($number > 1) {
        return $number*factorial($number - 1);
    }
    return 1;
}

if (isset($_POST['number']) && correctYear($_POST['number'])) {
    $number = (float)$_POST['number'];
    if ($number !== 0) {
        echo factorial($number);
    }
    else {
        echo 0;
    }
}
else {
    echo 'Введённые данные некорректны или число слишком большое';
}
?>
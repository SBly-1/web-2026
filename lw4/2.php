<?php

require_once 'myFunctions.php';

function correctDigit(string $digit): bool {

    $len = myLen($digit);
    if ($len !== 1) {
        return false;
    }

    if ($digit < '0' || $digit > '9') {
        return false;
    }

    return true;
}

function digitInWord(int $digit): string {
    $digits = match ($digit) {
        0 => 'Ноль',
        1 => 'Один',
        2 => 'Два',
        3 => 'Три',
        4 => 'Четыре',
        5 => 'Пять',
        6 => 'Шесть',
        7 => 'Семь',
        8 => 'Восемь',
        9 => 'Девять'
    };
    return $digits;
}

if (isset($_POST['digit']) && correctDigit($_POST['digit'])) {
    $digit = (int)$_POST['digit'];
    echo digitInWord($digit);
}
else {
    echo 'Введённые данные некорректны';
}
?>
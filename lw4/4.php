<?php
    
require_once 'myFunctions.php';

function correctNumber(string $number): bool {

    $len = myLen($number);
    if ($len !== 6) {
        return false;
    }

    for ($i = 0; $i < $len; $i++) {
        if ($number[$i] < '0' || $number[$i] > '9') {
            return false;
        }
    }
    return true;
}

function correctEnter(string $startingNumber, string $finalNumber): bool {
    if (!correctNumber($startingNumber) || !correctNumber($finalNumber)) {
        return false;
    }
    if ((int)$startingNumber > (int)$finalNumber) {
        return false;
    }
    return true;
}

function happy(string $leftNumber, string $rightNumber): bool {
    if (sumOfThree($leftNumber) === sumOfThree($rightNumber)) {
        return true;
    }
    return false;
}

function sumOfThree(string $str): int {
    $a = (int)mySubStr($str, 0, 1);
    $b = (int)mySubStr($str, 1, 2);
    $c = (int)mySubStr($str, 2, 3);
    return $a + $b + $c;
}

function addZeros(int $number): string {
    $strNumber = (string)$number;
    if (myLen($strNumber) === 6) {
        return $strNumber;
    }
    if (myLen($strNumber) === 5) {
        return '0' . $strNumber;
    }
    if (myLen($strNumber) === 4) {
        return '00' . $strNumber;
    }
    if (myLen($strNumber) === 3) {
        return '000' . $strNumber;
    }
    if (myLen($strNumber) === 2) {
        return '0000' . $strNumber;
    }
    if (myLen($strNumber) === 1) {
        return '00000' . $strNumber;
    }
}

if (isset($_POST['startingNumber']) && isset($_POST['finalNumber']) && correctEnter($_POST['startingNumber'], $_POST['finalNumber'])) {
    $startingNumber = (int)$_POST['startingNumber'];
    $finalNumber = (int)$_POST['finalNumber'];
    for ($number = $startingNumber; $number <= $finalNumber; $number++) {
        $strNumber = addZeros($number);
        $leftNumber = mySubStr($strNumber, 0, 3);
        $rightNumber = mySubStr($strNumber, 3, myLen($strNumber));
        if (happy($leftNumber, $rightNumber) === true) {
            echo $strNumber, ' ';
        }
    }
} 
else {
    echo 'Введённые данные некорректны';
}
?>
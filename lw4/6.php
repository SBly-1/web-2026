<?php
    
require_once 'myFunctions.php';

function correctEnter(string $postfixNotation): bool {

    $len = myLen($postfixNotation);
    if ($len === 0) {
        return false;
    }

    for ($i = 0; $i < $len; $i++) {
        if ($postfixNotation[$i] === ' ' || $postfixNotation[$i] === '+' || 
            $postfixNotation[$i] === '-' || $postfixNotation[$i] === '*') {
        }
        elseif ($postfixNotation[$i] < '0' || $postfixNotation[$i] > '9') {
            return false;
        }
    }
    return true;
}

if (isset($_POST['postfixNotation']) && correctEnter($_POST['postfixNotation'])) {
    $postfixNotation = $_POST['postfixNotation'];
    $notationArray = mySplit($postfixNotation, ' ');
    $tempArr = [];
    $correct = true;
    foreach ($notationArray as $elem) {
        if ($elem === '+' || $elem === '-' || $elem === '*') {
            if ($elem === '+' && isset($tempArr[count($tempArr) - 2])) {
                $tempElem = $tempArr[count($tempArr) - 2] + $tempArr[count($tempArr) - 1];
            }
            elseif ($elem === '-' && isset($tempArr[count($tempArr) - 2])) {
                $tempElem = $tempArr[count($tempArr) - 2] - $tempArr[count($tempArr) - 1];
            }
            elseif (isset($tempArr[count($tempArr) - 2])) {
                $tempElem = $tempArr[count($tempArr) - 2] * $tempArr[count($tempArr) - 1];
            }
            else {
                $correct = false;
                break;
            }
            array_splice($tempArr, count($tempArr) - 2, 2);
            $tempArr[] = $tempElem;
        }
        else {
            $tempArr[] = (int)$elem;
        }
    }
    if ($correct && !isset($tempArr[1])) {
        myPrintArray($tempArr);
    }
    else {
        echo 'Введённые данные некорректны';
    }
}
else {
    echo 'Введённые данные некорректны';
}

?>
<?php
    
require_once 'myFunctions.php';

if (isset($_POST['postfixNotation']) && $_POST['postfixNotation'] !== '') {
    $postfixNotation = $_POST['postfixNotation'];
    $notationArray = mySplit($postfixNotation, ' ');
    $tempArr = [];
    foreach ($notationArray as $elem) {
        if ($elem === '+' || $elem === '-' || $elem === '*') {
            if ($elem === '+') {
                $tempElem = $tempArr[count($tempArr) - 2] + $tempArr[count($tempArr) - 1];
            }
            elseif ($elem === '-') {
                $tempElem = $tempArr[count($tempArr) - 2] - $tempArr[count($tempArr) - 1];
            }
            else {
                $tempElem = $tempArr[count($tempArr) - 2] * $tempArr[count($tempArr) - 1];
            }
            array_splice($tempArr, count($tempArr) - 2, 2);
            $tempArr[] = $tempElem;
        }
        else {
            $tempArr[] = (int)$elem;
        }
    }
    myPrintArray($tempArr);
}
else {
    echo 'Введённые данные некорректны';
}

?>
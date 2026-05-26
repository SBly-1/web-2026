<?php
function choiceOfEnding(int $number, array $unitsOfMeasurement): string {
    $lastDigit = $number % 10; 
    $lastDigits = $number % 100;
    if ($lastDigits === 11 || $lastDigits === 12 || $lastDigits === 13 || $lastDigits === 14) {
        return $unitsOfMeasurement[2];
    }
    elseif ($lastDigit === 1) {
        return $unitsOfMeasurement[0];
    }
    elseif ($lastDigit === 2 || $lastDigit === 3 || $lastDigit === 4) {
        return $unitsOfMeasurement[1];
    }
    return $unitsOfMeasurement[2];
}

function timeOutput(int $timestamp): string {
    $difference = time() - $timestamp;
     if ($difference < 1) {
        return 'только что';
    }
    elseif ($difference < 60) {
        return (string)$difference . ' ' . choiceOfEnding($difference, ['секунда', 'секунды', 'секунд']) . ' назад';
    }
    elseif ($difference < 60 * 60) {
        $difference = (int)($difference / 60);
        return (string)$difference . ' ' . choiceOfEnding($difference, ['минута', 'минуты', 'минут']) . ' назад';
    }
    elseif ($difference < 60 * 60 * 24) {
        $difference = (int)($difference / (60 * 60));
        return (string)$difference . ' ' . choiceOfEnding($difference, ['час', 'часа', 'часов']) . ' назад';
    }
    elseif ($difference < 60 * 60 * 24 * 7) {
        $difference = (int)($difference / (60 * 60 * 24));
        return (string)$difference . ' ' . choiceOfEnding($difference, ['день', 'дня', 'дней']) . ' назад';
    }
    elseif ($difference < 60 * 60 * 24 * 30) {
        $difference = (int)($difference / (60 * 60 * 24 * 7));
        return (string)$difference . ' ' . choiceOfEnding($difference, ['неделя', 'недели', 'недель']) . ' назад';
    }
    elseif ($difference < 60 * 60 * 24 * 365) {
        $difference = (int)($difference / (60 * 60 * 24 * 30));
        return (string)$difference . ' ' . choiceOfEnding($difference, ['месяц', 'месяца', 'месяцев']) . ' назад';
    }
    else {
        $difference = (int)($difference / (60 * 60 * 24 * 365));
        return (string)$difference . ' ' . choiceOfEnding($difference, ['год', 'года', 'лет']) . ' назад';
    }
}
?>
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

function happy(string $startingNumber, string $finalNumber) {
    $xBegin = (int)mySubStr($startingNumber, 0, 1);
    $xEnd = (int)mySubStr($finalNumber, 0, 1);
    $yBegin = (int)mySubStr($startingNumber, 1, 2);
    $yEnd = (int)mySubStr($finalNumber, 1, 2);
    $zBegin = (int)mySubStr($startingNumber, 2, 3);
    $zEnd = (int)mySubStr($finalNumber, 2, 3);
    $iBegin = (int)mySubStr($startingNumber, 3, 4);
    $iEnd = (int)mySubStr($finalNumber, 3, 4);
    $jBegin = (int)mySubStr($startingNumber, 4, 5);
    $jEnd = (int)mySubStr($finalNumber, 4, 5);
    $kBegin = (int)mySubStr($startingNumber, 5, 6);
    $kEnd = (int)mySubStr($finalNumber, 5, 6);
    $numberEnd = (int)$finalNumber;

    for ($xBegin; $xBegin <= $xEnd; $xBegin++) {
        for ($yBegin; $yBegin <= 9; $yBegin++) {
            for ($zBegin; $zBegin <= 9; $zBegin++) {
                for ($iBegin; $iBegin <= 9; $iBegin++) {
                    for ($jBegin; $jBegin <= 9; $jBegin++) {
                        for ($kBegin; $kBegin <= 9; $kBegin++) {
                            if ($xBegin + $yBegin + $zBegin === $iBegin + $jBegin + $kBegin) {
                                echo $xBegin, $yBegin, $zBegin, $iBegin, $jBegin, $kBegin, ' ';
                            }
                            if ($xBegin*100000 + $yBegin*10000 + $zBegin*1000 + $iBegin*100 + $jBegin*10 + $kBegin === $numberEnd) {
                                return;
                            }
                        }
                        $kBegin = 0;
                    }
                    $jBegin = 0;
                }
                $iBegin = 0;
            }
            $zBegin = 0;
        }
        $yBegin = 0;
    }
    return;
}


if (isset($_POST['startingNumber']) && isset($_POST['finalNumber']) && correctNumber($_POST['startingNumber']) && correctNumber($_POST['finalNumber'])) {
    $startingNumber = $_POST['startingNumber'];
    $finalNumber = $_POST['finalNumber'];
    happy($startingNumber, $finalNumber);
}

?>
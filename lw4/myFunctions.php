<?php

function myLen(string $str): int {
    $i = 0;
    while (isset($str[$i])) {
        $i++;
    }
    return $i;
}

function mySubStr(string $str, int $begin, int $end): string {
    $newStr = '';
    for ($i = $begin; $i < $end; $i++) {
        $newStr .= $str[$i];
    }
    return $newStr;
}

function mySplit(string $str, string $char): array {
    $elems = [];
    $m = 0;
    for ($i = 0; $i < myLen($str); $i++) {
        if ($str[$i] === $char) {
            $elems[] =  mySubStr($str, $m, $i);
            $m = $i + 1;
        }
    }
    $elems[] = mySubStr($str, $m, myLen($str));
    return $elems;
}

function mySearchChar(string $str, string $char): bool {
    for ($i = 0; $i < myLen($str); $i++) {
        if ($str[$i] === $char) {
            return true;
        }
    }
    return false;
}

function myPrintArray(array $arr) {
    foreach ($arr as $elem) {
        echo $elem, "\n"; 
    }
}

function myDeletChar(string $str, string $char): string {
    $newStr = '';
    for ($i = 0; $i < myLen($str); $i++) {
        if ($str[$i] !== $char) {
            $newStr .= $str[$i]; 
        }
    }
    return $newStr;
}

?>
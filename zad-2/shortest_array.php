<?php

function findShortestArray(int $input): array {
    $result = [];
    $maxDigit = 8;

    while ($input > 0) {
        $digit = min($input, $maxDigit);
        $result[] = $digit;
        $input -= $digit;
    }

    return $result;
}
